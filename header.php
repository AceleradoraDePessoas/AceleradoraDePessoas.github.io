<!DOCTYPE html>
<html lang="pt-br">
    <head>
        
        <meta charset="utf-8">
        <title><?php if(isset($title)) { echo $title; } else { echo "Aceleradora de Pessoas - Empreendedorismo como Solu&ccedil;&atilde;o Social"; } ?> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Aceleradora de Pessoas">

        <!-- Le styles -->
        <link href="/css/main.css" rel="stylesheet" >
        <link href="/css/bootstrap.css" rel="stylesheet">
        <link href="/css/bootstrap-responsive.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <style>

            /* GLOBAL STYLES
            -------------------------------------------------- */
            /* Padding below the footer and lighter body text */

            body {
                padding-bottom: 40px;
                color: #5a5a5a;
            }



            /* CUSTOMIZE THE NAVBAR
            -------------------------------------------------- */

            /* Special class on .container surrounding .navbar, used for positioning it into place. */
            .navbar-wrapper {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                z-index: 20;
                margin-top: 20px;
                margin-bottom: -90px; /* Negative margin to pull up carousel. 90px is roughly margins and height of navbar. */
            }
            .navbar-wrapper .navbar {

            }

            /* Remove border and change up box shadow for more contrast */
            .navbar .navbar-inner {
                border: 0;
                -webkit-box-shadow: 0 2px 10px rgba(0,0,0,.25);
                -moz-box-shadow: 0 2px 10px rgba(0,0,0,.25);
                box-shadow: 0 2px 10px rgba(0,0,0,.25);
            }

            /* Downsize the brand/project name a bit */
            .navbar .brand {
                padding: 14px 20px 16px; /* Increase vertical padding to match navbar links */
                font-size: 16px;
                font-weight: bold;
                text-shadow: 0 -1px 0 rgba(0,0,0,.5);
            }

            /* Navbar links: increase padding for taller navbar */
            .navbar .nav > li > a {
                padding: 15px 20px;
            }

            /* Offset the responsive button for proper vertical alignment */
            .navbar .btn-navbar {
                margin-top: 10px;
            }



            /* CUSTOMIZE THE CAROUSEL
            -------------------------------------------------- */

            /* Carousel base class */
            .carousel {
                margin-bottom: 30px;
            }

            .carousel .container {
                position: relative;
                z-index: 9;
            }

            .carousel-control {
                height: 80px;
                margin-top: 0;
                font-size: 120px;
                text-shadow: 0 1px 1px rgba(0,0,0,.4);
                background-color: transparent;
                border: 0;
                z-index: 10;
            }

            .carousel .item {
                height: 500px;
            }
            .carousel img {
                position: absolute;
                top: 0;
                left: 0;
                min-width: 100%;
                height: 500px;
            }

            .carousel-caption {
                background-color: transparent;
                position: static;
                max-width: 650px;
                padding: 0 20px;
                margin-top: 200px;
            }
            .carousel-caption h1,
            .carousel-caption .lead {
                margin: 0;
                line-height: 1.25;
                color: #fff;
                text-shadow: 0 1px 1px rgba(0,0,0,.4);
            }
            .carousel-caption .btn {
                margin-top: 10px;
            }



            /* MARKETING CONTENT
            -------------------------------------------------- */

            /* Center align the text within the three columns below the carousel */
            .marketing .span4 {
                text-align: center;
            }
            .marketing h2 {
                font-weight: normal;
            }
            .marketing .span4 p {
                margin-left: 10px;
                margin-right: 10px;
            }


            /* Featurettes
            ------------------------- */

            .featurette-divider {
                margin: 60px 0; /* Space out the Bootstrap <hr> more */
            }
            .featurette {
                padding-top: 50px; /* Vertically center images part 1: add padding above and below text. */
                overflow: hidden; /* Vertically center images part 2: clear their floats. */
            }
            .featurette-image {
                margin-top: -120px; /* Vertically center images part 3: negative margin up the image the same amount of the padding to center it. */
            }

            /* Give some space on the sides of the floated elements so text doesn't run right into it. */
            .featurette-image.pull-left {
                margin-right: 40px;
            }
            .featurette-image.pull-right {
                margin-left: 40px;
            }

            /* Thin out the marketing headings */
            .featurette-heading {
                font-size: 50px;
                font-weight: 300;
                line-height: 1;
                letter-spacing: -1px;
            }
            
            .featurette-video {
                width="640"; 
                height="360";
            }



            /* RESPONSIVE CSS
            -------------------------------------------------- */

            @media (max-width: 979px) {

                .container.navbar-wrapper {
                    margin-bottom: 0;
                    width: auto;
                }
                .navbar-inner {
                    border-radius: 0;
                    margin: -20px 0;
                }

                .carousel .item {
                    height: 500px;
                }
                .carousel img {
                    width: auto;
                    height: 500px;
                }

                .featurette {
                    height: auto;
                    padding: 0;
                }
                .featurette-image.pull-left,
                .featurette-image.pull-right {
                    display: block;
                    float: none;
                    max-width: 100%;
                    margin: 0 auto 20px;
                }
            }


            @media (max-width: 767px) {

                .navbar-inner {
                    margin: -20px;
                }

                .carousel {
                    margin-left: -20px;
                    margin-right: -20px;
                }
                .carousel .container {

                }
                .carousel .item {
                    height: 300px;
                }
                .carousel img {
                    height: 300px;
                }
                .carousel-caption {
                    width: 65%;
                    padding: 0 70px;
                    margin-top: 100px;
                }
                .carousel-caption h1 {
                    font-size: 16px;
                    line-height: 1.1;
                }
                .carousel-caption .lead,
                .carousel-caption .btn {
                    font-size: 16px;
                }

                .marketing .span4 + .span4 {
                    margin-top: 40px;
                }

                .featurette-heading {
                    font-size: 30px;
                }
                .featurette .lead {
                    font-size: 18px;
                    line-height: 1.5;
                }
                
                 .featurette-video {
                width="100%"; 
                height="auto";
            }

            }
        </style>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="/js/html5shiv.js"></script>
        <![endif]-->

        
        <?php echo $header_script; ?>
    </head>

    <body>



        <div class="navbar-wrapper">
            <div class="container">
                <div class="navbar navbar-inverse">
                    <div class="navbar-inner">
                        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="brand" href="#"><img src="/img/monograma-fundo-escuro-60px.png"></a>
                        <div class="nav-collapse collapse">
                            <ul class="nav">
                                <li class="active"><a href="index.php">Início</a></li>
                                <li><a href="index.php#sobre">Sobre</a></li>
                                <li><a href="comofunciona.php">Como Funciona</a></li>
                                <li><a href="index.php#valores">Nossos Valores</a></li> 
                                <li><a href="grupo.php">Grupo de Email</a></li> 
                                <li><a href="transparencia.php">Transpar&ecirc;ncia</a></li>
                                <li><a href="parceiros.php">Parceiros</a></li>
                                
                                <?php
                                /*
                                  Menu Dropdown ainda não implementado

                                  <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                  <ul class="dropdown-menu">
                                  <li><a href="#">Action</a></li>
                                  <li><a href="#">Another action</a></li>
                                  <li><a href="#">Something else here</a></li>
                                  <li class="divider"></li>
                                  <li class="nav-header">Nav header</li>
                                  <li><a href="#">Separated link</a></li>
                                  <li><a href="#">One more separated link</a></li>
                                  </ul>
                                  </li>

                                 */
                                ?>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div><!-- /.navbar-inner -->
                </div><!-- /.navbar -->

            </div> <!-- /.container -->
        </div><!-- /.navbar-wrapper -->
