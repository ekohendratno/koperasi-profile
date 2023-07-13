<?php $this->load->view('themes/header');?>
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-xs-12 col-sm-12 col-md-8">

                <!-- Blog Post -->
                <?php foreach( $have_posts as $the_post):?>
                    <!-- Title -->
                    <h1><?php echo $the_post["the_title"];?></h1>

                    <hr>

                    <!-- Post Content -->
                    <?php echo $the_post["the_content"];?>
                    <hr>

                    <!-- Blog Comments -->
                    <?php $this->load->view('themes/comments');?>

                <?php endforeach;?>
            </div>

            <?php $this->load->view('themes/sidebar');?>
        </div>
    </div>
<?php $this->load->view('themes/footer');?>