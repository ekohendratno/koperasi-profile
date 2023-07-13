<?php $this->load->view('themes/header'); ?>

<style>
    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }
</style>


<link href="assets/css/style.css" rel="stylesheet" />


<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top: -60px;">

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

        <div class="item active">
            <img src="<?php echo base_url('assets/images/cover1.jpg'); ?>" alt="Slide 1" style="width:100%;">
            <div class="carousel-caption">
                <div class="carousel-caption d-none d-md-block">

                    <h3>Label satu</h3>
                    <p>Keterangan label satu</p>

                </div>
            </div>
        </div>

        <div class="item">
            <img src="<?php echo base_url('assets/images/cover2.jpg'); ?>" alt="Slide 2" style="width:100%;">
            <div class="carousel-caption">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Label kedua</h3>
                    <p>Keterangan label kedua</p>
                </div>
            </div>
        </div>

        <div class="item">
            <img src="<?php echo base_url('assets/images/cover3.jpg'); ?>" alt="Slide 3" style="width:100%;">
            <div class="carousel-caption">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Label ketiga</h3>
                    <p>Keterangan label ketiga</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="jumbotron" style="margin-top: -120px; display:none;">
    <div class="container">


        <div class="container-flex">

            <div class="col-md-12  text-center">
                <a href="#">
                    <img src="<?php echo base_url('assets/images/koperasi.png'); ?>" width="275" alt="...">
                </a>
                <h1 class="judul"><?php echo $title; ?></h1>
                <h4 class="judul"><?php echo $desc; ?></h3>
            </div>


            <div class="clearfix" style="margin-bottom: 20px"></div>

        </div>

    </div>
</div>

<section id="about" class="about">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="col-md-12">

            <div class="section-title">
                <h2>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Tentang kami</font>
                    </font>
                </h2>
            </div>
            <div class="row">



                <?php
                $query     = $this->db->query("SELECT * FROM artikel WHERE artikel_ketegori='Page' AND artikel_id=10");
                foreach ($query->result_array() as $row) {
                ?>
                    <p><?php echo $row['artikel_konten']; ?></p>
                <?php
                }
                ?>


            </div>
        </div>
    </div>
</section>

<section id="services" class="services section-bg">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
            <h2>Layanan Kami</h2>
            <p>Yuk gunakan layanan yang ada di Kopdit Mekar Sai. Menjadi Sahabat dan Melayani</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 icon-box aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon"><i class="fa fa-handshake-o"></i></div>
                <h4 class="title"><a href="http://mekarsai.org/berita/layanan/pinjaman">Pinjaman</a></h4>
                <p class="description">Penuhi kebutuhan dengan pinjaman yang mudah dan bunga yang kompetitif</p>
            </div>
            <div class="col-lg-4 col-md-6 icon-box aos-init aos-animate" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon"><i class="fa fa-credit-card"></i></div>
                <h4 class="title"><a href="http://mekarsai.org/berita/layanan/simpan">Simpan</a></h4>
                <p class="description">produk simpanan disediakan berdasarkan tahap kehidupan dan kebutuhan hidup manusia</p>
            </div>
            <div class="col-lg-4 col-md-6 icon-box aos-init aos-animate" data-aos="zoom-in" data-aos-delay="300">
                <div class="icon"><i class="fa fa-heart"></i></div>
                <h4 class="title"><a href="http://mekarsai.org/berita/layanan/solidaritas">Solidaritas</a></h4>
                <p class="description">Membantu manusia menolong dirinya sendiri</p>
            </div>
        </div>

    </div>
</section>


<section id="team" class="team">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title">
            <h2>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Tim kita</font>
                </font>
            </h2>
            <p>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Ini adalah tim kecil yang bekerja dibalik perusahaan, perkenalkan</font>
                </font>
            </p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="member aos-init aos-animate" data-aos="fade-up">
                    <div class="member-img"> <img src="assets/images/team-1.jpg" class="img-fluid" alt="">
                        <div class="social"> <a href=""><i class="glyphicon glyphicon-twitter"></i></a> <a href=""><i class="glyphicon glyphicon-facebook"></i></a> <a href=""><i class="glyphicon glyphicon-instagram"></i></a> <a href=""><i class="glyphicon glyphicon-linkedin"></i></a></div>
                    </div>
                    <div class="member-info">
                        <h4>Team 1</h4> <span>Jabatan 1</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="member aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="member-img"> <img src="assets/images/team-2.jpg" class="img-fluid" alt="">
                        <div class="social"> <a href=""><i class="glyphicon glyphicon-twitter"></i></a> <a href=""><i class="glyphicon glyphicon-facebook"></i></a> <a href=""><i class="glyphicon glyphicon-instagram"></i></a> <a href=""><i class="glyphicon glyphicon-linkedin"></i></a></div>
                    </div>
                    <div class="member-info">
                        <h4>Team 2</h4> <span>Jabatan 1</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="member aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <div class="member-img"> <img src="assets/images/team-3.jpg" class="img-fluid" alt="">
                        <div class="social"> <a href=""><i class="glyphicon glyphicon-twitter"></i></a> <a href=""><i class="glyphicon glyphicon-facebook"></i></a> <a href=""><i class="glyphicon glyphicon-instagram"></i></a> <a href=""><i class="glyphicon glyphicon-linkedin"></i></a></div>
                    </div>
                    <div class="member-info">
                        <h4>Team 3</h4> <span>Jabatan 1</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="member aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <div class="member-img"> <img src="assets/images/team-4.jpg" class="img-fluid" alt="">
                        <div class="social"> <a href=""><i class="glyphicon glyphicon-twitter"></i></a> <a href=""><i class="glyphicon glyphicon-facebook"></i></a> <a href=""><i class="glyphicon glyphicon-instagram"></i></a> <a href=""><i class="glyphicon glyphicon-linkedin"></i></a></div>
                    </div>
                    <div class="member-info">
                        <h4>Team 4</h4> <span>Jabatan 1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="berita" class="berita section-bg">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
            <h2>Berita Terbaru</h2>
            <hr>
        </div>
        <div class="row">

            <?php
            $author = $this->input->get("author");
            $archive = $this->input->get("archive");
            $topik = $this->input->get("topik");
            $cari = $this->input->get("cari");

            if (!empty($author)) {
                echo '<p class="lead">Author : ' . $author . '</p>';
            }
            if (!empty($topik)) {
                echo '<p class="lead">Topik : ' . $topik . '</p>';
            }
            if (!empty($archive)) {
                echo '<p class="lead">Arsip : ' . $archive . '</p>';
            }
            if (!empty($cari)) {
                echo '<p class="lead">Pencarian : ' . $cari . '</p>';
            }
            ?>


            <!-- First Blog Post -->
            <?php foreach ($have_posts as $the_post) : ?>
                <?php
                $posted = explode(" ", $the_post["the_posted"]);
                $posted = explode("-", $posted[0]);

                $year = sprintf("%04d", $posted[0]);
                $month = sprintf("%02d", $posted[1]);

                $the_thumbnail = base_url('assets/images/900x300.png');
                if (!empty($the_post['the_thumbnail']) && file_exists(FCPATH . 'uploads/posts/' . $year . "/" . $month . "/" . $the_post['the_thumbnail'])) {
                    $the_thumbnail = base_url('thumb.php?size=900x600&src=./uploads/posts/' . $year . "/" . $month . "/" . $the_post['the_thumbnail']);
                }

                ?>

                <div class="col-md-4">
                    <div class="card" style="margin-bottom: 20px;">
                        <img src="<?php echo $the_thumbnail; ?>" class="img-fluid">
                        <div class="card-body">
                            <h3> <a href="<?php echo $the_post["the_permalink"]; ?>"><?php echo $the_post["the_title"]; ?></a></h3>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php //get_paging_nav('<ul class="pager">','</ul>');
            ?>


        </div>
    </div>
</section>

<section id="kontak" class="contact">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title">
            <h2>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Hubungi kami</font>
                </font>
            </h2>
            <p>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">Silahkan hubungi Kami untuk menanyakan segalanya tentang koperasi ini</font>
                </font>
            </p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="info">
                    <div> <i class="glyphicon glyphicon-globe"></i>
                        <p>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;"><?php echo dynamic_setting("Alamat"); ?></font>
                            </font>
                        </p>
                    </div>
                    <div> <i class="glyphicon glyphicon-envelope"></i>
                        <p><?php echo dynamic_setting("Email"); ?></p>
                    </div>
                    <div> <i class="glyphicon glyphicon-phone"></i>
                        <p>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;"><?php echo dynamic_setting("Telp"); ?></font>
                            </font>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <form method="post" role="form" class="php-email-form" action="<?php echo base_url( "/email" ); ?>">
                    <div class="form-group"> <input type="text" name="name" class="form-control" id="name" placeholder="Namamu" required=""></div>
                    <div class="form-group mt-3"> <input type="email" class="form-control" name="from" id="from" placeholder="Email mu" required=""></div>
                    <div class="form-group mt-3"> <input type="text" class="form-control" name="subject" id="subject" placeholder="Subjek" required=""></div>
                    <div class="form-group mt-3"><textarea class="form-control" name="message" rows="5" placeholder="Pesan" required=""></textarea></div>
                    <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div><button class="btn btn-success" type="submit" id="kirimpesan">Mengirim pesan</button></div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="map section-bg"> <iframe src="<?php echo dynamic_setting("Maps"); ?>" frameborder="0" style="border:0;" allowfullscreen=""></iframe></section>


<?php $this->load->view('themes/footer'); ?>