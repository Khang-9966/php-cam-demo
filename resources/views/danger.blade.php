<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">
    <title>FTI</title>
    <link rel="icon" href="favicon.png" type="image/png">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/linecons.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link href="css/sweetalert2.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="js/jquery.1.8.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery-scrolltofixed.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/jquery.isotope.js"></script>
    <script type="text/javascript" src="js/wow.js"></script>
    <script type="text/javascript" src="js/classie.js"></script>
    <script type="text/javascript" src="js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="js/capture.js"></script>
</head>
<body>
<section id="top_content">
    <div class="container">
        <h2>Theo dõi</h2>
    </div>
</section>
<!--Top_content-->
<section id="service" class="top_cont_outer">
    <div class="top_cont_inner">
        <div class="container">
            <div class="top_content">
                <div class="row">
                    <div class="col-md-12">
                        <div id="capture" class="text-center">
                            <img id="frame_follow" src="" width="100%" height="auto" crossorigin="anonymous">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button class="btn btn-lg btn-info" onclick="stopDetect()">Dừng</button>
                </div>
            </div>
        </div>
    </div>
    <div id="hidden" style="display: none">
        <canvas id="canvas_hidden" style="overflow: auto"></canvas>
    </div>
</section>
<!--Top_content-->
<footer class="footer_section" id="contact_footer">
    <div class="container">
        <div class="footer_bottom"><span>&#0169; CÔNG TY TNHH MTV VIỄN THÔNG QUỐC TẾ FPT</span>
        </div>
    </div>
</footer>
<script>
    function init() {
        let url = localStorage.getItem('follow_url');
        if (url != null) {
            $('#frame_follow').attr('src', url);
        } else {
           toast('error', 'Chưa khoanh vùng để theo dõi!');
        }
    }

    init();
</script>
</body>
</html>
