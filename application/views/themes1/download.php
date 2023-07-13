<?php $this->load->view('themes/header'); ?>
<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-xs-12 col-sm-12 col-md-8">

            <!-- Title -->
            <h1>Download</h1>

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

                <div class="list-group">

                    <?php foreach ($have_posts as $the_post) : ?>
                        <a target="_blank" href="<?php echo $the_post['the_permalink']; ?>" class="list-group-item">                            

                            <h4 class="list-group-item-heading"><i class="fa fa-file"></i> <?php echo $the_post["the_title"]; ?></h4>
                            <i>Ukuran 12MB, Dipublikasikan pada Senin, 27 Okt 2019</i>

                        </a>
                    <?php endforeach; ?>
                </div>




            </div>


        </div>

        <?php $this->load->view('themes/sidebar'); ?>
    </div>
</div>
<?php $this->load->view('themes/footer'); ?>


<style type="text/css">
    .download-title {
        font-size: 36px;
        color: #42B32F;
        text-align: center;
        font-weight: 500;
        margin-bottom: 70px;
    }

    .download-title:after {
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

    .download_product {
        margin-bottom: 30px;
    }
</style>

<script type="text/javascript" language="javascript">
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