<?php $this->load->view('themes/header');?>

<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" >
                <div class="panel-heading">
                    <div class="panel-title pull-left">
                        <a href="<?php echo base_url();?>admin/dashboard">
                            <h4>Profile</h4>
                        </a>
                    </div>
                    <div class="panel-title pull-right">
                        <a href="<?php echo base_url('auth/logout');?>" title="Logout">
                            <div class="btn">
                                <span class="glyphicon glyphicon-off" style="color: #FC0004"></span>
                            </div>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body" >

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                    <form class="form-horizontal" id="submit">

                        <div class="col-md-5">
                            <div class="btn-group btn-group-justified">
                                <a href="#" class="btn btn-default" onClick="$('#img-gravatar').hide(); $('#img-local').show()">Local</a>
                                <a href="#" class="btn btn-default" onClick="$('#img-local').hide(); $('#img-gravatar').show()">Gravatar</a>
                            </div>
                            <div id="img-local">
                                <center>
                                    <img src="<?php if( $foto != '' ){ echo $foto;}?>" class="img-circle" alt="Cinque Terre" height="100" width="100" style="margin:20px 0;" >
                                    <h4><?php echo $this->session->userdata('username');?></h4>
                                </center>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="file" name="file">
                                    </div>
                                </div>
                            </div>
                            <div id="img-gravatar" style="display:none">
                                <center>
                                    <a href="http://www.gravatar.com/" title="Clik for Change Gravatar" target="_blank">
                                        <img class="img-circle"  height="100" width="100" style="margin:20px 0;" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y">
                                    </a>
                                </center>
                            </div>

                            <div class="form-group">
                                <!-- Button -->
                                <div class="col-md-12">
                                    <button class="btn btn-block btn-success" id="btn_upload" type="submit">Update</button>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-7" style="border-left:1px solid #f2f2f2;">
                            <div class="form-group">
                                <label for="username" class="col-md-4 control-label">Username</label>
                                <div class="col-md-8">
                                    <input type="username" class="form-control" name="username" placeholder="Username" disabled value="<?php echo $username;?>">
                                </div>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
        </div>


    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){

        $('#submit').submit(function(e){
            e.preventDefault();
            $.ajax({
                url:'<?php echo base_url();?>index.php/auth/do_upload',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                processData :false,
                contentType :false,
                cache :false,
                async :false,
                success: function(data){
                    //console.log(data);
                    alert(data.pesan);

                    if(data.ok == 1){

                        window.location.assign("<?php echo base_url();?>index.php/auth/profile");

                    }
                }
            });
        });


    });

</script>

<?php $this->load->view('themes/footer');?>