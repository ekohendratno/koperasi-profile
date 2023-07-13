<?php $this->load->view('themes/header');?>
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-xs-12 col-sm-12 col-md-8">

                <!-- Blog Post -->
                <?php foreach( $have_posts as $the_post):?>
                    <?php
                    $posted = explode(" ",$the_post["the_posted"]);
                    $posted = explode("-",$posted[0]);

                    $year = sprintf("%04d", $posted[0]);
                    $month = sprintf("%02d", $posted[1]);

                    $the_thumbnail = base_url('assets/images/900x300.png');
                    if( !empty($the_post['the_thumbnail']) && file_exists(FCPATH . 'uploads/posts/' .$year."/".$month."/". $the_post['the_thumbnail']) ) {
                        $the_thumbnail = base_url('uploads/posts/' .$year."/".$month."/". $the_post['the_thumbnail']);
                    }

                    ?>


                    <!-- Preview Image -->
                    <img class="img-responsive" src="<?php echo $the_thumbnail;?>" alt="" style="border:1px solid #ddd">
                    <!-- Title -->
                    <h1><?php echo $the_post["the_title"];?></h1>

                    <!-- Author -->
                    <p class="lead">
                        by <a href="<?php echo $the_post["the_permalink_author"];?>"><?php echo $the_post["the_author_name"];?></a>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date("l, d M Y H:i", strtotime($the_post["the_posted"]));?></p>


                    <!-- Post Content -->
                    <div class="the_content">
                        <?php echo $the_post["the_content"];?>

                    </div>
                    <hr>
                    Tags: <?php echo $the_post["the_tags"];?>
                    <hr>

                    <h4>Artikel terkait:</h4>
                    <hr>
                    <div class="row">

                        <?php foreach( $the_post["the_relations"] as $the_relation):?>
                            <?php
                            $posted = explode(" ",$the_relation["the_posted"]);
                            $posted = explode("-",$posted[0]);

                            $year = sprintf("%04d", $posted[0]);
                            $month = sprintf("%02d", $posted[1]);

                            $the_thumbnail = base_url('assets/images/350x150.png');
                            if( !empty($the_relation['the_thumbnail']) && file_exists(FCPATH . 'uploads/posts/' .$year."/".$month."/". $the_relation['the_thumbnail']) ) {
                                $the_thumbnail = base_url('thumb.php?size=350x350&src=./uploads/posts/' .$year."/".$month."/". $the_relation['the_thumbnail']);
                            }

                            ?>
                            <div class="col-sm-4">
                                <div class="card">
                                    <a href="<?php echo $the_relation["the_permalink"];?>">
                                        <img src="<?php echo $the_thumbnail;?>" width="100%" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text" style="margin-top: 8px"><small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?php echo date("l, d M Y ", strtotime($the_relation["the_posted"]) );?></small></p>
                                            <h5 class="card-title"><?php echo $the_relation["the_title"];?></h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach;?>

                    </div>
                    <hr>

                    <!-- Blog Comments -->
                    <?php $this->load->view('themes/comments');?>

                <?php endforeach;?>
            </div>

            <?php $this->load->view('themes/sidebar');?>
        </div>
    </div>
<?php $this->load->view('themes/footer');?>