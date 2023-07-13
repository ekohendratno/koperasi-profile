<?php
$CI =& get_instance();

$CI->load->helper('url');
?>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-xs-12 col-sm-12 col-md-4">

                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home/Page Left') ) : ?>
                <?php endif; ?>

            </div>