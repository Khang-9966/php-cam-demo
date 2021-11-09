var i = 1;
var array_image = [];

const _camera_url = 'http://192.168.2.130';
const _get_raw_stream = 'http://192.168.2.130:5000/get_rawstream';
const _registry_face = 'http://192.168.2.130:5000/face_registry';
const _kill_stream = 'http://192.168.2.130:5000/kill_rawstream'
const _start_detect = 'http://192.168.2.130:5000/start_detect_stream';
const _kill_detect = 'http://192.168.2.130:5000/kill_detect_stream';

var stream_url = '';

function getStream() {
    Swal.fire({
        title: "Camera",
        text: "Nhập đường link đến camera",
        input: 'text',
        showCancelButton: true
    }).then((result) => {
        if (result.value) {

            stream_url = result.value;

            $.ajax({
                url: _get_raw_stream,
                data: {
                    url: result.value
                },
                type: 'POST',
                dataType: "JSON",
                success: function (data) {
                    setTimeout(function () {
                        $('#frame_img').attr('src', _camera_url + data.stream_port);
                    }, 2000);
                },
                error: function (xhr, desc, err) {
                    console.log(err);
                }
            });
        }
    });
}

function takeshot() {
    let canvas = document.getElementById('canvas_' + i);
    let image = document.getElementById('frame_img');

    canvas.width = image.clientWidth / 2;
    canvas.height = image.clientHeight / 2;
    canvas.getContext('2d').drawImage(image, 0, 0, image.clientWidth / 2, image.clientHeight / 2);

    array_image.push(dataURLtoFile(canvas.toDataURL(), 'image_' + i + '.png'));
    i++;

    $('#output').append('<canvas id="canvas_' + i + '" style="overflow: auto"></canvas>')
}

function dataURLtoFile(dataUrl, filename) {
    var arr = dataUrl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);

    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }

    return new File([u8arr], filename, {type: mime});
}

function dangerZone() {
    let video = document.getElementById('frame_img');
    let canvas = document.getElementById('canvas_danger');
    canvas.width = video.clientWidth / 1.5;
    canvas.height = video.clientHeight / 1.5;
    let ctx = canvas.getContext('2d');
    var x1, y1, x2, y2;

    ctx.drawImage(video, 0, 0, video.clientWidth / 1.5, video.clientHeight / 1.5);

    canvas.onmousedown = function (e) {
        var pos = getMousePos(this, e),
            x = pos.x,
            y = pos.y
        x1 = x;
        y1 = y;
        $('#x1').val(fixNum(x / canvas.width));
        $('#y1').val(fixNum(y / canvas.height));
    }

    canvas.onmouseup = function (e) {
        var pos = getMousePos(this, e),
            x = pos.x,
            y = pos.y
        x2 = x;
        y2 = y;
        $('#x2').val(fixNum(x / canvas.width));
        $('#y2').val(fixNum(y / canvas.height));
        ctx.beginPath();
        ctx.drawImage(video, 0, 0, video.clientWidth / 1.5, video.clientHeight / 1.5);
        ctx.rect(x1, y1, x2 - x1, y2 - y1);
        ctx.strokeStyle = 'red';
        ctx.lineWidth = 5;
        ctx.stroke();
    }

    $('#danger_modal').modal('show').on('hidden.bs.modal', function () {
        $('#x1').val("");
        $('#y1').val("");
        $('#x2').val("");
        $('#y2').val("");
    });
}

function getMousePos(canvas, e) {
    var rect = canvas.getBoundingClientRect();
    return {x: e.clientX - rect.left, y: e.clientY - rect.top};
}

function openRegister() {
    $('#register_modal').modal('show');
}

function sendRegister() {
    let data = new FormData();
    array_image.forEach(function (image, i) {
        data.append('file', image);
    });

    let name = $('input[name="full_name"]').val();
    data.append('name', name);

    $.ajax({
        type: 'post',
        url: _registry_face,
        data: data,
        contentType: false,
        processData: false,
        success: function (data) {
            var msg = data;
            $.post(_kill_stream, {url: stream_url})
                .done(function (text) {
                    $('#register_modal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Đăng ký thành công!',
                        text: msg
                    }).then(function () {
                        location.reload();
                    });
                })
        }, error: function (xhr, desc, err) {
            console.log(err);
        }
    });
}

function sendDangerZone() {
    $.ajax({
        type: 'POST',
        url: _start_detect,
        data: {
            url : stream_url,
            xmin : $('#x1').val().toString(),
            ymin : $('#y1').val().toString(),
            xmax : $('#x2').val().toString(),
            ymax : $('#y2').val().toString()
        },
        success: function (data) {
            localStorage.setItem('follow_url', _camera_url + data.stream_port);
            localStorage.setItem('stream_url', stream_url);

            $('#danger_modal').modal('hide');
            $.post(_kill_stream, {url: stream_url})
                .done(function (text) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Khoanh vùng thành công!',
                    }).then(function () {
                        location.reload();
                    });
                });
        }
    });
}

function stopDetect(){
    let stream = localStorage.getItem('stream_url');
    $.post(_kill_detect, {url: stream})
        .done(function (data) {
            localStorage.removeItem('stream_url');
            localStorage.removeItem('follow_url');
            window.close();
        });
}

function toast(icon, message) {
    Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    }).fire({
        icon: icon,
        title: message
    });
}

function fixNum(num) {
    return (Math.round(num * 100) / 100).toFixed(2);
}
