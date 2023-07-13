<?php $this->load->view('themes/header'); ?>
<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-xs-12 col-sm-12 col-md-8">

            <!-- Title -->
            <h1>Gallery</h1>

            <hr>

            <!-- Post Content -->

            <div>


                <div align="center">
                    <button class="btn btn-sm btn-default filter-button" data-filter="all">Semua</button>

                    <?php foreach ($have_tags as $the_tag) : ?>
                        <button class="btn btn-sm btn-default filter-button" data-filter="<?php echo $the_tag["tag"]; ?>"><?php echo $the_tag["tag"]; ?></button>
                    <?php endforeach; ?>
                </div>
                <br />


                    <?php foreach ($have_posts as $the_post) : ?>
                        <?php
                        $posted = explode("-", $the_post["the_posted"]);

                        $year = sprintf("%04d", $posted[0]);
                        $month = sprintf("%02d", $posted[1]);

                        $the_thumbnail = base_url('assets/images/365x365.png');
                        if (!empty($the_post['the_thumbnail']) && file_exists(FCPATH . 'uploads/gallery/' . $year . "/" . $month . "/" . $the_post['the_thumbnail'])) {
                            $the_thumbnail = base_url('thumb.php?size=365x365&src=./uploads/gallery/' . $year . "/" . $month . "/" . $the_post['the_thumbnail']);
                        }

                        ?>

                        <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter <?php echo $the_post["the_tags"]; ?>">
                            <a href="javascript:void()" onclick="clickgallery('<?php echo $the_thumbnail; ?>','<?php echo $the_post['the_title']; ?>')"><img src="<?php echo $the_thumbnail; ?>" class="img-responsive" title="<?php echo $the_post["the_title"]; ?>"></a>
                        </div>

                    <?php endforeach; ?>




            </div>


        </div>

        <?php $this->load->view('themes/sidebar'); ?>
    </div>
</div>
<?php $this->load->view('themes/footer'); ?>



<div class="modal fade modal-fullscreen" id="galleryDialog" role="dialog">
    <div class="modal-dialog dialog-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lihat Gallery
                    <div class="pull-right">
                        <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                    </div>
                </h4>
            </div>
            <div class="modal-body text-center">


                <div id="gallery-show"></div>


            </div>


        </div>
    </div>
</div>

<style type="text/css">
    .gallery-title {
        font-size: 36px;
        color: #42B32F;
        text-align: center;
        font-weight: 500;
        margin-bottom: 70px;
    }

    .gallery-title:after {
        content: "";
        position: absolute;
        width: 7.5%;
        left: 46.5%;
        height: 45px;
        border-bottom: 1px solid #5e5e5e;
    }

    .filter-button {
        border: 1px solid #42B32F;
        border-radius: 5px;
        text-align: center;
        color: #42B32F;
        margin-bottom: 30px;

    }

    .filter-button:hover {
        border: 1px solid #42B32F;
        border-radius: 5px;
        text-align: center;
        color: #ffffff;
        background-color: #42B32F;

    }

    .btn-default:active .filter-button:active {
        background-color: #42B32F;
        color: white;
    }

    .port-image {
        width: 100%;
    }

    .gallery_product {
        margin-bottom: 30px;
    }
</style>

<script type="text/javascript" language="javascript">
    function clickgallery(link, title) {

        $('#gallery-show').html(
            '<img class="img-responsive" src="' + link + '" width="100%" /><br/><h5>' + title + '</h5>'
        );

        $('#galleryDialog').modal({
            show: 'false'
        });

    }

    $(document).ready(function() {

        $(".filter-button").click(function() {
            var value = $(this).attr('data-filter');

            if (value == "all") {
                //$('.filter').removeClass('hidden');
                $('.filter').show('1000');
            } else {
                //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
                //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                $(".filter").not('.' + value).hide('3000');
                $('.filter').filter('.' + value).show('3000');

            }
        });

        if ($(".filter-button").removeClass("active")) {
            $(this).removeClass("active");
        }
        $(this).addClass("active");


    });
</script>