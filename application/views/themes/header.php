<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php dynamic_meta(array()); ?>

    <link rel="icon" type="image/ico" href="<?php echo base_url("assets/images/koperasi.ico") ?>" />
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css") ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/css/blog-home.css") ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.css" />
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        body {
            font-family: sans-serif;
            font-size: 1.5em;
            font-weight: 400;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-font-smoothing: subpixel-antialiased;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        /**
        Custom height navbar
         */
        .navbar {
            min-height: 60px;

        }

        .navbar-shadow {
            -webkit-box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.1);

            /* the rest of your styling */
        }

        .navbar-brand {
            padding: 1px 15px;
            height: 60px;
            line-height: 60px;
        }


        .navbar-toggle {
            /* (80px - button height 34px) / 2 = 23px */
            margin-top: 13px;
            padding: 9px 10px !important;
        }

        @media (min-width: 768px) {
            .navbar-nav>li>a {
                /* (80px - line-height of 27px) / 2 = 26.5px */
                padding-top: 16.5px;
                padding-bottom: 16.5px;
                line-height: 27px;
            }
        }


        h1.judul {
            font-size: 46px;
            font-weight: bold;
        }

        h1.judul,
        h2.judul,
        h3.judul,
        h4.judul {
            color: #f9f8f8;
        }

        .jumbotron .container-flex {
            margin-top: 240px;
        }

        @media (max-width: 990px) {
            .jumbotron .container-flex {
                margin-top: 190px;
            }
        }

        @media (max-width: 768px) {
            .jumbotron .container-flex {
                margin-top: 140px;
            }
        }

        @media (max-width: 568px) {
            h1.judul {
                font-size: 32px;
            }

            .jumbotron .container-flex {
                margin-top: 70px;
            }
        }

        /**
        Card
         */

        .card a:hover {
            text-decoration: none;
        }

        .card .card-body {}

        .card .card-body .card-text {}

        .card .card-body .card-title {}

        .img-responsive {
            width: 100%;
            text-align: center;
        }


        .navbar.navbar-inverse {
            background-color: rgb(255 90 45);
            border-bottom: 1px solid rgb(255 90 45);
            color: #fff;
            border-bottom: 1px;
        }


        .navbar.navbar-inverse li>a {
            color: #fff;
        }


        .navbar.navbar-inverse>li>a {
            color: #fff;
        }

        .navbar.navbar-inverse a.navbar-brand {
            color: #fff;
        }

        .navbar.navbar-inverse .dropdown-menu>li>a {
            color: #000;
        }

        .navbar ul.nav li.btn.btn-sm.btn-success {}


        .jumbotron {
            margin-bottom: 0;
            min-height: 50%;
            height: 700px;

            background: #6DB571;
            background: -webkit-linear-gradient(rgba(0, 146, 249, 0.8), rgba(109, 181, 113, 0.8)), url('<?php echo base_url() ?>assets/images/cover1.jpg') no-repeat center center fixed;
            background: linear-gradient(rgba(0, 146, 249, 0.8), rgba(109, 181, 113, 0.8)), url('<?php echo base_url() ?>assets/images/cover1.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;



        }

        .jumbotron {
            margin-bottom: 0;
            min-height: 50%;
            height: 768px;
            background: #fb3939;
            background: -webkit-linear-gradient(rgb(246 250 63 / 80%), rgb(252 50 50 / 94%)), url('<?php echo base_url() ?>assets/images/cover1.jpg') no-repeat center center fixed;
            background: linear-gradient(rgb(234 235 95 / 80%), rgb(225 78 47 / 80%)), url('<?php echo base_url() ?>assets/images/cover1.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .sm-icons {
            flex-direction: row;
        }

        .sm-icons .fa {
            padding-right: 20px;
        }

        @media only screen and (max-width: 960px) {
            .sm-icons .nav-item {
                padding-right: 1em;
            }
        }

        .dropdown-menu>li.kopie>a {
            padding-left: 5px;
        }

        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            -webkit-border-radius: 0 6px 6px 6px;
            -moz-border-radius: 0 6px 6px 6px;
            border-radius: 0 6px 6px 6px;
        }

        .dropdown-submenu>a:after {
            border-color: transparent transparent transparent #333;
            border-style: solid;
            border-width: 5px 0 5px 5px;
            content: " ";
            display: block;
            float: right;
            height: 0;
            margin-right: -10px;
            margin-top: 5px;
            width: 0;
        }

        .dropdown-submenu:hover>a:after {
            border-left-color: #555;
        }

        .dropdown-menu>li>a:hover,
        .dropdown-menu>.active>a:hover {
            text-decoration: underline;
        }

        @media (min-width: 768px) {
            ul.nav li:hover>ul.dropdown-menu {
                display: block;
            }

            #navbar {
                text-align: center;
            }
        }



        /**
        NavTop
         */

        @media (max-width: 765px) {
            #topnav {
                display: none;
            }
        }

        #topnav {
            width: 100%;
            background-color: #16bbff;
            margin: 0;
            color: #fff;
        }

        #topnav i {
            color: #fff;
        }

        #topnav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        #topnav li {
            float: left;
        }

        #topnav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 5px;
            margin-left: 20px;
            text-decoration: none;
        }

        small {
            font-size: 11px;
            color: #ddd;
            position: relative;
            top: 4px;
        }

        .navbar-link {
            color: #fff;
            font-size: 16px;
            padding: 40px 0;
        }

        .navbar-link a {
            font-weight: bold;
        }

        .navbar-link a:hover,
        .navbar-link a:active {}

        /**
        DIRGAHAYU
         */
        .utamapost .image {
            border: 8px solid var(--white-mode);
            -webkit-box-shadow: 0 10px 20px -10px rgb(0 0 0 / 25%);
            -moz-box-shadow: 0 10px 20px -10px rgba(0, 0, 0, 0.25);
            box-shadow: 0 10px 20px -10px rgb(0 0 0 / 25%);
            display: block;
            margin: auto;
            overflow: hidden;
        }

        .utamapost .image img {
            -o-object-fit: cover;
            object-fit: cover;
            -o-object-position: top;
            object-position: top;
            display: block;
            width: 275px;
        }



        h1.judul {
            font-size: 36px;
        }

        .the_content {
            font-size: 18px;
            line-height: 26px;
        }

        .the_content p {
            margin-bottom: 10px;
        }

        .the_content p br {
            margin-bottom: 20px;
        }

        /**CUSTOM HEADER */

        #header.fixed-top {
            background: #575757a8;
        }

        small.timex {
            color: #fff;
        }
    </style>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {

                /*
                if (window.scrollY > 50) {
                    $('.navbar.navbar-inverse').css("background-color", "rgb(255 90 45)");
                    $('.navbar.navbar-inverse').css("border-bottom", "1px solid rgb(255 90 45)");
                    $('.navbar.navbar-inverse').css("color", "#fff");
                    $('.navbar.navbar-inverse li>a').css("color", "#fff");
                    $('.navbar.navbar-inverse > li >a').css("color", "#fff");
                    $('.navbar').addClass('navbar-shadow');

                    $('.navbar-nav>li>.dropdown-menu').css("background-color", "rgb(255 90 45)");
                    $('.navbar.navbar-inverse .dropdown-menu li > a').css("color", "#fff");


                } else {
                    $('.navbar.navbar-inverse').css("background-color", "rgba(76, 76, 76, 0)");
                    $('.navbar.navbar-inverse').css("border-bottom", "1px solid rgba(76, 76, 76, 0)");
                    $('.navbar.navbar-inverse > li >a').css("color", "#000");
                    $('.navbar.navbar-inverse > .dropdown-menu > li > a').css("color", "#000");
                    $('.navbar').removeClass('navbar-shadow');
                }*/

            });
        });
    </script>
    <?php

    dynamic_head();

    ?>


</head>

<body>

    <script>
        window.setTimeout("waktu()", 1000);

        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);
            var year = waktu.getFullYear()
            var month = waktu.getMonth() + 1;
            var day = waktu.getDate();

            var tanggal = day + "/" + month + "/" + year;
            var pukul = waktu.getHours() + ":" + waktu.getMinutes() + ":" + waktu.getSeconds();

            $("small.timex").html("Sekarang Tanggal " + tanggal + " Pukul " + pukul);
        }
    </script>

    <!-- Navigation -->
    <nav id="navbar_top" class="navbar<?php if ($this->uri->segment(1) != null) {
                                            echo " navbar-inverse navbar-shadow";
                                        } else {
                                            echo " navbar-inverse navbar-shadow";
                                        } ?> navbar-fixed-top">
        <div id="topnav" class="container-fluid">
            <div class="container">

                <small class="timex"></small>
                <ul class="navbar-right">
                    <li class="nav-item"><a class="nav-link" href="<?php echo dynamic_setting("SocialYoutube"); ?>"><i class="fa fa-youtube"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo dynamic_setting("SocialFacebook"); ?>"><i class="fa fa-facebook-f"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo dynamic_setting("SocialInstagram"); ?>"><i class="fa fa-instagram"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo dynamic_setting("SocialTwitter"); ?>"><i class="fa fa-twitter"></i></a></li>
                </ul>

            </div>
        </div>
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#exampleNavComponents" aria-expanded"false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <img alt="KOPERASI" src="<?php echo base_url(); ?>assets/images/koperasi.png" style="margin-top: 10px; height: 40px">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="exampleNavComponents">

                <?php
                $li = '<a href="' . base_url() . 'auth"><button class="btn btn-default" style="padding: 0 12px;">Masuk</button></a>';
                if ($this->session->userdata("username") != null) {
                    $li = '<a href="' . base_url() . $this->session->userdata("level") . '/dashboard"><button class="btn btn-default" style="padding: 0 12px;">Dashboard</button></a>';
                }

                if ($this->uri->segment(1) == "auth") {
                    $li = "";
                }

                /**
            $li = array(
                    '<a href="#">aaa</a>',
                    '<a href="#">bbc</a>',
                    '<a href="#">ccc</a>',
            );*/

                dynamic_nav_menu(array(
                    'menu_class' => 'nav navbar-nav mx-auto  navbar-right',
                    'li' => $li
                )); ?>

                <ul class="nav navbar-nav navbar-right" style="display: none;">
                    <li class="nav-item"><a class="nav-link" href="/auth" ; ?>"><button class="btn btn-sm btn-default">Login</button></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Page Content -->
    <div style="margin-bottom: 100px"></div>