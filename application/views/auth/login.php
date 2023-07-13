<?php $this->load->view('themes/header');?>

    <script type="text/javascript">
        function signin() {

            $('.status').empty();
            var username = $('#username').val();
            var password = $('#password').val();
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/auth/signin',
                data:'u='+username+'&p='+password,
                dataType:'json',
                beforeSend: function () {
                    $("input").attr('disabled','disabled');
                    $("button").attr('disabled','disabled');

                    $('.status').html('<div class="alert alert-warning" role="alert">Loading ...</div>');
                    $('#loading_ajax').show();
                },
                success: function (hasil) {
                    console.log(hasil);
                    $('.status').empty();

                    $('#loading_ajax').fadeOut("slow");

                    $('.status').html(hasil.pesan);
                    if(hasil.success){
                        window.location.assign("<?php echo base_url();?>index.php/"+hasil.redirect);
                    }else{
                        $("input").removeAttr('disabled');
                        $("button").removeAttr('disabled');
                    }
                }
            });
        }
    </script>
    <div class="container" style="padding-top:60px;">
        <div class="row">


            <div class="col-lg-4 col-lg-offset-4 px-0">
                <div class="py-4 of-login-container of-show">
                    <h3 class="pt-2">Login</h3>
                    <p class="of-form-description">Masukkan Akun Kamu disini</p>

                    <div class="status"></div>



                    <div class="form-group">

                        <label>Username</label><br/>
                        <input type="text"  name="username" class="form-control" id="username" placeholder="Username">
                        <label>Password</label><br/>
                        <input type="text"  name="password" class="form-control" id="password" placeholder="Password">
                        <br/>

                        <button onclick="signin()" type="button" id="btn-tambah" class="btn btn-block btn-primary">MASUK</button>
                    </div>

                    <br class="clear"/>
                    <!--<a class="of-signup-link of-toggle-link pb-2" href="#">Don't have an account yet? Sign Up!</a>-->
                </div>
            </div> <!--End .col-lg-6 -->

        </div>
    </div>
<?php $this->load->view('themes/footer');?>