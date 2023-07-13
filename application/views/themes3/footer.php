<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="footer-info">
                        <h3>Kopdit Mekar Sai</h3>
                        <p>
                            Jl. Ir Juanda No. 74, Pahoman&nbsp;Bandarlampung, Lampung,&nbsp;Indonesia <br>
                            <strong>Phone:</strong> 0721-259212<br>
                            <strong>Email:</strong> kopditmekarsai@yahoo.co.id<br>
                        </p>
                        <div class="social-links mt-3">
                            <a href="http://twitter.com/" class="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/mekarsai" class="facebook"><i class="fab fa-facebook"></i></a>
                            <a href="https://instagram.com/mekarsai" class="instagram"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/channel/UCaZut6JlT-r6KG-mvKoJgsA" class="google-plus"><i class="fab fa-youtube"></i></a>

                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>About Us</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://mekarsai.org/berita/profil/sejarah-kopdit-mekar-sai">Sejarah Kopdit Mekar Sai</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://mekarsai.org/berita/profil/profil-kopdit-mekar-sai">Profil Kopdit Mekar Sai</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://mekarsai.org/berita/profil/visi-misi-kodit-mekar-sai">Visi Misi Kodit Mekar Sai</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://mekarsai.org/berita/profil/profil">profil</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://mekarsai.org/staff">Staff &amp; Team Kami</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://mekarsai.org/berita/layanan/pinjaman">Pinjaman</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://mekarsai.org/berita/layanan/simpan">Simpan</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="http://mekarsai.org/berita/layanan/solidaritas">Solidaritas</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Find Us on Map</h4>
                    <style type="text/css" media="screen">
                        iframe {
                            width: 100%;
                            height: 200px;
                        }
                    </style>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15887.702888972128!2d105.2701676!3d-5.4282546!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x615a73ba414fc193!2sKopdit%20Mekarsai!5e0!3m2!1sid!2sid!4v1656399768939!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            © Copyright <strong><span>Mekar Sai</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medicio-free-bootstrap-theme/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer>
<!-- /.container -->

<!-- jQuery -->
<script src="<?php echo base_url("assets") ?>/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url("assets") ?>/js/bootstrap.min.js"></script>

<script type="text/javascript" language="javascript">
    function submitKirim() {
        var name = $('#name').val();
        var from = $('#from').val();
        var message = $('#message').val();


        if (name == "") {
            alert("Nama Kosong!");
        } else if (from == "") {
            alert("Email Kosong!");
        } else if (message == "") {
            alert("Pesan Kosong!");
        } else {

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index/sendmail',
                data: 'name=' + name + '&from=' + from + '&message=' + message,
                dataType: 'json',
                beforeSend: function() {
                    $('#loading_ajax').show();
                },
                success: function(responseData) {

                    if (responseData.success) {
                        alert("Email berhasil dikirim!");

                        $('#name').val("");
                        $('#from').val("");
                        $('#message').val("");

                    }
                },
                complete: function() {
                    $('#loading_ajax').fadeOut("slow");
                }
            });

        }
    }
</script>

</body>

</html>