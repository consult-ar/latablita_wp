<?php
/*
Template Name: mantenimiento-plantilla
*/
?>
<html lang="es-AR">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <title>Bienvenido</title>           

        <link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Raleway:300" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <style type="text/css">
            body { font-family: 'Raleway', sans-serif;overflow: hidden;}

            .homepage-hero-module {border-right: none;border-left: none;position: relative;}
            .no-video .video-container video,
            .touch .video-container video {display: none;}
            .no-video .video-container .poster,
            .touch .video-container .poster {display: block !important;}
            .video-container {position: relative;bottom: 0%;left: 0%;height: 100%;width: 100%;overflow: hidden;background: #000;}
            .video-container .poster img {width: 100%;bottom: 0;position: absolute;}
            .video-container .filter {z-index: 100;position: absolute;background: rgba(0, 0, 0, 0.4);width: 100%;}
            .video-container video {position: absolute;z-index: 0;bottom: 0;}
            .video-container video.fillWidth {width: 100%;}

            #msj { position: fixed;left: 0;top: 40%;right: 0;background: #fff;background: rgba(255, 255, 255, 0.64);text-align: center; text-transform: uppercase;padding: 10px 0 15px;-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);-moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);box-shadow: 0 1px 2px rgba(0,0,0,.2);}
            #msj h1 {}
            
            #logo {position: fixed;bottom: 30px;width: 170px;left: 50%;margin-left: -85px;display: block;}

        </style>
    </head>
    <body>

        <div class="homepage-hero-module">
            <div class="video-container">
                <div class="filter"></div>
                <video autoplay loop class="fillWidth">
                    <source src="https://storage.googleapis.com/coverr-main/mp4/Spacious.mp4" type="video/mp4" />
                    <source src="https://storage.googleapis.com/coverr-main/mp4/Spacious.webm" type="video/webm" />
                </video>
                <div class="poster hidden">
                    <img src="https://storage.googleapis.com/coverr-public/poster/Spacious.jpg" alt="">
                </div>
            </div>
        </div>

        <div id="msj">
            <h1>
                Estamos trabajando para mejorar su experiencia
            </h1>
        </div>
        <img src="https://consult-ar.info/images/logo_header.png" id="logo"/>



        <script type="text/javascript">
            $(document).ready(function () {

                scaleVideoContainer();

                initBannerVideoSize('.video-container .poster img');
                initBannerVideoSize('.video-container .filter');
                initBannerVideoSize('.video-container video');

                $(window).on('resize', function () {
                    scaleVideoContainer();
                    scaleBannerVideoSize('.video-container .poster img');
                    scaleBannerVideoSize('.video-container .filter');
                    scaleBannerVideoSize('.video-container video');
                });

            });

            function scaleVideoContainer() {

                var height = $(window).height() + 5;
                var unitHeight = parseInt(height) + 'px';
                $('.homepage-hero-module').css('height', unitHeight);

            }

            function initBannerVideoSize(element) {

                $(element).each(function () {
                    $(this).data('height', $(this).height());
                    $(this).data('width', $(this).width());
                });

                scaleBannerVideoSize(element);

            }

            function scaleBannerVideoSize(element) {

                var windowWidth = $(window).width(),
                        windowHeight = $(window).height() + 5,
                        videoWidth,
                        videoHeight;
                // console.log(windowHeight);

                $(element).each(function () {
                    var videoAspectRatio = $(this).data('height') / $(this).data('width');
                    $(this).width(windowWidth);
                    if (windowWidth < 1000) {
                        videoHeight = windowHeight;
                        videoWidth = videoHeight / videoAspectRatio;
                        $(this).css({'margin-top': 0, 'margin-left': -(videoWidth - windowWidth) / 2 + 'px'});
                        $(this).width(videoWidth).height(videoHeight);
                    }

                    $('.homepage-hero-module .video-container video').addClass('fadeIn animated');
                });
            }
        </script>
    </body>
</html>