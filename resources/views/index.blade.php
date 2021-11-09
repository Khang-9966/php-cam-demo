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
        <h2>Virtual Stream</h2>
    </div>
</section>
<!--Top_content-->
<section id="service" class="top_cont_outer">
    <div class="top_cont_inner">
        <div class="container">
            <div class="top_content">
                <div class="row">
                    <div class="col-md-8">
                        <div id="capture" class="text-center">
                            <img id="frame_img" src="" width="100%" height="auto" crossorigin="anonymous">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div id="output" style="height: 500px; overflow: scroll; overflow-x: hidden;">
                            <canvas id="canvas_1" style="overflow: auto"></canvas>
                        </div>
                        <button class="btn btn-info" onclick="openRegister()">Gửi</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button class="btn btn-lg btn-info" onclick="getStream()">Mở Camera</button>
                    <button class="btn btn-lg btn-info" onclick="takeshot()">Chụp ảnh</button>
                    <button class="btn btn-lg btn-info" onclick="dangerZone()">Vẽ vùng</button>
                    <a class="btn btn-lg btn-info" href="follow" target="_blank">Theo dõi</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal modal-style fade" id="register_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Họ tên</label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" name="full_name" placeholder="Họ tên">
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn btn-info" onclick="sendRegister()">Gửi</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-style fade" id="danger_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="row">
                        <canvas id="canvas_danger"></canvas>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <input id="x1" type="text" class="form-control" placeholder="X1" readonly>
                        </div>
                        <div class="col-md-3">
                            <input id="y1" type="text" class="form-control" placeholder="Y1" readonly>
                        </div>
                        <div class="col-md-3">
                            <input id="x2" type="text" class="form-control" placeholder="X2" readonly>
                        </div>
                        <div class="col-md-3">
                            <input id="y2" type="text" class="form-control" placeholder="Y2" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn btn-info" onclick="sendDangerZone()">Gửi</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Top_content-->
<footer class="footer_section" id="contact_footer">
    <div class="container">
        <div class="footer_bottom"><span>&#0169; CÔNG TY TNHH MTV VIỄN THÔNG QUỐC TẾ FPT</span>
        </div>
    </div>
</footer>
</body>
</html>
