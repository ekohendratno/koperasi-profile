<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="footer-info">
                        <h3><?php echo dynamic_setting("Titles"); ?></h3>
                        <p>
                            <strong>Alamat:</strong> <?php echo dynamic_setting("Alamat"); ?><br>
                            <strong>Phone:</strong> <?php echo dynamic_setting("Telp"); ?><br>
                            <strong>Email:</strong> <?php echo dynamic_setting("Email"); ?><br>
                        </p>
                        <div class="social-links mt-3">
                            <a href="<?php echo dynamic_setting("SocialTwitter"); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
                            <a href="<?php echo dynamic_setting("SocialFacebook"); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="<?php echo dynamic_setting("SocialInstagram"); ?>" class="instagram"><i class="fa fa-instagram"></i></a>
                            <a href="<?php echo dynamic_setting("SocialYoutube"); ?>" class="google-plus"><i class="fa fa-youtube"></i></a>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Tenatang kami dan layanannya</h4>
                    <ul class="list-unstyled">


                        <?php
                        $query     = $this->db->query("SELECT * FROM artikel WHERE artikel_ketegori='Page'");
                        foreach ($query->result_array() as $row) {
                        ?>
                            <li class="page_item page-item-<?php echo $row['artikel_id']; ?>"><a href="<?php echo base_url() . "page?id=" . $row['artikel_id']; ?>"><?php echo $row['artikel_title']; ?></a></li>
                        <?php
                        }
                        ?>
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
                    <iframe src="<?php echo dynamic_setting("Maps"); ?><" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            © Copyright <strong><span><?php echo dynamic_setting("Titles"); ?></span></strong>. All Rights Reserved
        </div>
        <div class="credits" style="display: none;">
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
    /*
    $("body").on('click', '#kirimpesan', function(e) {

        var name = $('#name').val();
        var from = $('#from').val();
        var subject = $('#subject').val();
        var message = $('#message').val();

        if (name == undefined) {
            alert("Nama Kosong!");
        } else if (from == undefined) {
            alert("Email Kosong!");
        } else if (subject == undefined) {
            alert("Subject Kosong!");
        } else if (message == undefined) {
            alert("Pesan Kosong!");
        } else {
            alert("Save Event Fired "+message);
        }

    });


    function submitKirim() {
        var name = $('#name').val();
        var from = $('#from').val();
        var subject = $('#subject').val();
        var message = $('#message').val();


        if (name == "") {
            alert("Nama Kosong!");
        } else if (from == "") {
            alert("Email Kosong!");
        } else if (subject == "") {
            alert("Subject Kosong!");
        } else if (message == "") {
            alert("Pesan Kosong!");
        } else {

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index/sendmail',
                data: 'name=' + name + '&from=' + from + '&subject=' + subject + '&message=' + message,
                dataType: 'json',
                beforeSend: function() {
                    $('#loading_ajax').show();
                },
                success: function(responseData) {

                    if (responseData.success) {
                        alert("Email berhasil dikirim!");

                        $('#name').val("");
                        $('#from').val("");
                        $('#subject').val("");
                        $('#message').val("");

                    }
                },
                complete: function() {
                    $('#loading_ajax').fadeOut("slow");
                }
            });

        }
    }*/
</script>

</body>

</html>