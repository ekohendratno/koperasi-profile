<div class="wrapper" style="height: auto; min-height: 100%;">
    <div class="container container-medium">


        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title text-center" style="padding-top: 7.5px;">DATA PENGATURAN</h4>
                        <div class="panel-title-button pull-right">
                            <button onclick="resetDataAll()" class="btn btn-danger">Reset Semua Data</button>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">
                                <label>Title</label>
                                <input class="form-control" name="titles" id="titles" value="<?php echo $titles; ?>">
                            </div>
                            <div class="col-md-12">
                                <label>Desciption</label>
                                <input class="form-control" name="description" id="description" value="<?php echo $description; ?>">
                            </div>
                            <div class="col-md-12">
                                <label>Keywords</label>
                                <input class="form-control" name="keywords" id="keywords" value="<?php echo $keywords; ?>">
                            </div>
                            <div class="col-md-12">
                                <label>Author</label>
                                <input class="form-control" name="author" id="author" value="<?php echo $author; ?>">
                            </div>
                            <div class="col-md-12">
                                <label>Email</label>
                                <input class="form-control" name="email" id="email" value="<?php echo $email; ?>">
                            </div>
                            <div class="col-md-12">
                                <label>Telp</label>
                                <input class="form-control" name="telp" id="telp" value="<?php echo $telp; ?>">
                            </div>
                            <div class="col-md-12">
                                <label>Alamat</label>
                                <input class="form-control" name="alamat" id="alamat" value="<?php echo $alamat; ?>">
                            </div>
                            <div class="col-md-12">
                                <label>Disqus URL (silahkan daftarkan situs ke <a href="https://disqus.com/" target="_blank">Disqus.com</a>)</label>
                                <input class="form-control" name="disqus_url" id="disqus_url" value="<?php echo $disqus_url; ?>">
                            </div>
                            <div class="col-md-12">
                                <label>Social Youtube </label>
                                <textarea class="form-control" name="social_youtube" id="social_youtube" ><?php echo $social_youtube; ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label>Social Facebook</label>
                                <textarea class="form-control" name="social_facebook" id="social_facebook" ><?php echo $social_facebook; ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label>Social Instgram</label>
                                <textarea class="form-control" name="social_instagram" id="social_instagram" ><?php echo $social_instagram; ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label>Social Twitter</label>
                                <textarea class="form-control" name="social_twitter" id="social_twitter" ><?php echo $social_twitter; ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label>Maps</label>
                                <textarea class="form-control" name="maps" id="maps" rows="6"><?php echo $maps; ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <br />
                                <button class="btn btn-success" onclick="submitPengaturan()">Simpan Pengaturan</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function submitPengaturan() {
        var titles = $('#titles').val();
        var description = $('#description').val();
        var keywords = $('#keywords').val();
        var author = $('#author').val();
        var email = $('#email').val();
        var alamat = $('#alamat').val();
        var telp = $('#telp').val();
        var disqus_url = $('#disqus_url').val();
        var social_youtube = $('#social_youtube').val();
        var social_facebook = $('#social_facebook').val();
        var social_instagram = $('#social_instagram').val();
        var social_twitter = $('#social_twitter').val();
        var maps = $('#maps').val();
        $.ajax({
            type: 'POST',
            data: 'titles=' + titles + 
            '&description=' + description + 
            '&keywords=' + keywords + 
            '&author=' + author +
            '&email=' + email +
            '&alamat=' + alamat +
            '&telp=' + telp +
            '&disqus_url=' + disqus_url +
            '&social_youtube=' + social_youtube + 
            '&social_facebook=' + social_facebook + 
            '&social_instagram=' + social_instagram + 
            '&social_twitter=' + social_twitter + 
            '&maps=' + maps ,
            url: '<?php echo base_url(); ?>admin/pengaturan/simpandata',
            dataType: 'json',
            beforeSend: function() {
                $('#loading_ajax').show();
            },
            success: function() {
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }


    function resetDataAll() {

        $('#loading_ajax').show();
        var tanya = confirm('Apakah yakin mau hapus semua data dalam website ini?');
        if (tanya) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('admin/pengaturan/resetdataall'); ?>',
                beforeSend: function() {
                    $('#loading_ajax').show();
                },
                success: function(respon) {
                    $('#loading_ajax').fadeOut("slow");

                    if (respon.pesan == '') {
                        window.location.assign("<?php echo base_url(); ?>auth/logout");
                    }
                }
            });
        }


    }
</script>