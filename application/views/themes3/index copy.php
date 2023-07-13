<?php $this->load->view('themes/header');?>


    <div class="jumbotron" style="margin-top: -120px;margin-bottom: 40px">
        <div class="container">


            <div class="container-flex">

                <div class="col-md-12  text-center">
                    <a href="#">
                    <img src="<?php echo base_url('assets/images/koperasi.png');?>" width="275" alt="...">
                    </a>
                    <h1 class="judul"><?php echo $title;?></h1>
                    <h3 class="judul"><?php echo $desc;?></h3>
                </div>


                <div class="clearfix" style="margin-bottom: 20px"></div>

            </div>

        </div>
    </div>


    <div class="container">
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-xs-12 col-sm-12 col-md-8">

                <!-- First Blog Post -->
                <?php foreach( $have_posts as $the_post):?>

                    <?php
                    $posted = explode(" ",$the_post["the_posted"]);
                    $posted = explode("-",$posted[0]);

                    $year = sprintf("%04d", $posted[0]);
                    $month = sprintf("%02d", $posted[1]);

                    $the_thumbnail = base_url('assets/images/900x300.png');
                    if( !empty($the_post['the_thumbnail']) && file_exists(FCPATH . 'uploads/posts/' .$year."/".$month."/". $the_post['the_thumbnail']) ) {
                        $the_thumbnail = base_url('thumb.php?size=900x600&src=./uploads/posts/' .$year."/".$month."/". $the_post['the_thumbnail']);
                    }

                    ?>
                    <a href="<?php echo $the_post["the_permalink"];?>" class="img-responsive">
                        <img class="img-responsive" src="<?php echo $the_thumbnail;?>" alt="" width="900" height="300">
                    </a>
                    <h2>
                        <a href="<?php echo $the_post["the_permalink"];?>"><?php echo $the_post["the_title"];?></a>
                    </h2>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date("l, d M Y H:i", strtotime($the_post["the_posted"]));?></p>
            

                <!--
                    <style type="text/css">
                        /* Image zoom on hover + Overlay colour */
                        .parent {
                            width: 45%;
                            margin: 20px;
                            height: 300px;
                            border: 1px solid blue;
                            overflow: hidden;
                            position: relative;
                            float: left;
                            display: inline-block;
                            cursor: pointer;
                        }

                        .child {
                            height: 100%;
                            width: 100%;
                            background-size: cover;
                            background-repeat: no-repeat;
                            -webkit-transition: all .5s;
                            -moz-transition: all .5s;
                            -o-transition: all .5s;
                            transition: all .5s;
                        }

                        .parent:hover .child, .parent:focus .child {
                            -ms-transform: scale(1.2);
                            -moz-transform: scale(1.2);
                            -webkit-transform: scale(1.2);
                            -o-transform: scale(1.2);
                            transform: scale(1.2);
                        }

                        .parent:hover .child:before, .parent:focus .child:before {
                            display: block;
                        }

                        .parent:hover a, .parent:focus a {
                            display: block;
                        }

                        .child:before {
                            content: "";
                            display: none;
                            height: 100%;
                            width: 100%;
                            position: absolute;
                            top: 0;
                            left: 0;
                            background-color: rgba(52,73,94,0.75);
                        }

                        /* Media Queries */
                        @media screen and (max-width: 960px) {
                            .parent {width: 100%; margin: 20px 0px}
                        }

                        /* Several different images */
                        .bg-one {background-image: url(<?php echo $the_thumbnail;?>);}
                    </style>
                        <div class="parent" onclick="">
                            <div class="child bg-one">
                                <a href="#">Los Angeles</a>
                            </div>
                        </div>-->


                    <?php echo $the_post["the_content"];?>
                    <hr>
                <?php endforeach;?>
                <?php if(!$have_posts):?>
                    <h2>Oops! Maaf tidak ada halaman yang di posting</h2>
                    <p class="lead">
                        by sistem
                    </p>
                    <hr>
                    <p>Tidak ada postingan dihalaman ini, tulis postingan untuk menghapus pesan ini.</p>
                    <hr>
                <?php endif;?>
                <?php //get_paging_nav('<ul class="pager">','</ul>');?>

            </div>


            <?php $this->load->view('themes/sidebar');?>

        </div>
    </div>
<?php $this->load->view('themes/footer');?>