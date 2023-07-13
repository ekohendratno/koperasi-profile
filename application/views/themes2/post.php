<?php $this->load->view('themes/header');?>
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-xs-12 col-sm-12 col-md-8">

                <?php
                $author = $this->input->get("author");
                $archive = $this->input->get("archive");
                $topik = $this->input->get("topik");
                $cari = $this->input->get("cari");

                if(!empty($author)){
                    echo '<p class="lead">Author : '.$author.'</p>';

                }
                if(!empty($topik)){
                    echo '<p class="lead">Topik : '.$topik.'</p>';

                }
                if(!empty($archive)){
                    echo '<p class="lead">Arsip : '.$archive.'</p>';
                }
                if(!empty($cari)){
                    echo '<p class="lead">Pencarian : '.$cari.'</p>';
                }
                ?>


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
                    <a href="<?php echo $the_post["the_permalink"];?>"><img class="img-responsive" src="<?php echo $the_thumbnail;?>" alt="" width="900" height="300"></a>
                    <h2>
                        <a href="<?php echo $the_post["the_permalink"];?>"><?php echo $the_post["the_title"];?></a>
                    </h2>
                    <p class="lead">
                        by <a href="<?php echo $the_post["the_permalink_author"];?>"><?php echo $the_post["the_author_name"];?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date("l, d M Y H:i", strtotime($the_post["the_posted"]));?></p>
                    <?php echo $the_post["the_content"];?>
                    <hr>
                <?php endforeach;?>
                <?php //get_paging_nav('<ul class="pager">','</ul>');?>


            </div>

            <?php $this->load->view('themes/sidebar');?>
        </div>
    </div>
<?php $this->load->view('themes/footer');?>