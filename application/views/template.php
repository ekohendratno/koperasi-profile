<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title><?php echo $title?></title>

	
    <script src="<?php echo base_url('assets/admin/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/jquery-ui.js') ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/bootstrap-tagsinput.min.js') ?>"></script>
    <script defer src="<?php echo base_url('assets/admin/js/fontawesome/js/all.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/sweetalert/sweetalert.min.js'); ?>"></script>

    <link rel="icon" type="image/ico" href="<?php echo base_url('assets/admin/img/logo.ico') ?>"><link rel='dns-prefetch' href='<?php echo base_url();?>' />

	<link href="<?php echo base_url('assets/admin/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/admin/css/jquery-ui.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/admin/css/custom.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/admin/css/bootstrap-tagsinput.css') ?>" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/moment-with-locales.min.js') ?>"></script>
    <link href="<?php echo base_url('assets/admin/css/bootstrap-datetimepicker.css') ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/bootstrap-datetimepicker.min.js') ?>"></script>

    <script src="<?php echo base_url('assets/admin/js/tinymce/tinymce.min.js');?>"></script>


    <style type="text/css">

        .navbar-inverse{background-color:  #3c4b59;}

        .inset {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-top: 7px;
            margin-left: 0px;
            margin-right: 0px;
            background-color: transparent !important;
            z-index: 999;
        }

        .inset img {
            border-radius: inherit;
            width: inherit;
            height: inherit;
            display: block;
            position: relative;
            z-index: 998;
        }

        .control-sidebar {
            top: 0;
            right: -300px;
            width: 300px;
        }

        .control-sidebar.fix {
            z-index: 101;
        }

        ul.nav.nav-pills.nav-stacked {
            padding-top: 74px;
        }

        .empty-placeholder {
            padding: 20px;
        }


        /**
        MODAL DIALOG CUSTOM
         */
        .modal-title {
            line-height: 2;
        }

        .modal-fullscreen .modal-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 17px;
            z-index: 10;
            background: white;
        }

        .modal-fullscreen .modal-body {
            padding-top: 80px;
        }

        .modal-fullscreen {
            padding: 0 !important;
        }
        .modal-fullscreen .modal-dialog {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .modal-fullscreen .modal-content {
            position:relative;
            height: 100%;
            min-height: 100%;
            border: 0 none;
            border-radius: 0;
            box-shadow: none;
        }

        .modal-fullscreen .modal-footer {
            bottom: 0;
            position: absolute;
            width: 100%;
        }

        .modal-content-scroll{
            overflow-y: auto;
        }

        @media (min-height: 500px) {
            .modal-content-scroll { height: 1000px; }
        }

        @media (min-height: 800px) {
            .modal-content-scroll { height: 1600px; }
        }


        .btn-circle {
            border-radius: 40px;
            width: 40px;
            height: 40px;
            line-height: 2;
            margin-left: 5px;
        }

        #Notifikasi {
            cursor: pointer;
            position: fixed;
            bottom:10px;
            right: 0px;
            z-index: 9999;
            margin-bottom: 22px;
            margin-right: 15px;
            min-width: 300px;
            max-width: 800px;
        }
    </style>
    <style id="jsbin-css">
        .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover{
            background: transparent;
            color: #fff;

        }

        .navbar-nav.nav .dropdown-menu {
        }

        .navbar-nav.nav .dropdown-menu > li > a {
        }




    </style>

	<script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";




        tinyEditor();
        function tinyEditor(){
            //tinymce 5
            tinyMCE.init({
                selector: "textarea#tinyEditor",
                content_style: "body {font-size: 14pt;}",
                height: 100,
                max_height: 500,
                min_height: 500,
                menubar: false,
                statusbar:false,
                plugins: 'autoresize print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help code',
                toolbar: 'image media styleselect forecolor alignleft aligncenter alignright alignjustify  bullist numlist table removeformat  code codesample help',
                image_advtab: true,
                convert_fonts_to_spans: true,
                paste_webkit_styles: "color font-size",
                paste_word_valid_elements: "b,strong,i,em,h1,h2,u,p,ol,ul,li,a[href],span,color,font-size,font-color,font-family,mark",
                paste_retain_style_properties: "all",
                paste_data_images: true,
                images_upload_url: '<?php echo base_url();?>admin/artikel/uploadfile',

                //relative_urls: true,
                relative_urls: false,
                remove_script_host: false,

                // override default upload handler to simulate successful upload
                images_upload_handler: function (blobInfo, success, failure) {

                    var xhr, formData;

                    xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', '<?php echo base_url();?>admin/artikel/uploadfile');

                    xhr.onload = function() {
                        var json;

                        if (xhr.status != 200) {
                            failure('HTTP Error: ' + xhr.status);
                            return;
                        }

                        json = JSON.parse(xhr.responseText);

                        if (!json || typeof json.location != 'string') {
                            failure('Invalid JSON: ' + xhr.responseText);
                            return;
                        }

                        success(json.location);
                    };

                    formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    xhr.send(formData);
                },
                file_picker_types: 'media',
                file_picker_callback: function(callback, value, meta) {
                    // File type
                    if ( meta.filetype =="media" ) {

                        // Trigger click on file element
                        jQuery("#fileupload").trigger("click");
                        $("#fileupload").unbind('change');
                        // File selection
                        jQuery("#fileupload").on("change", function() {
                            var file = this.files[0];
                            var reader = new FileReader();

                            // FormData
                            var fd = new FormData();
                            var files = file;
                            fd.append("file",files);
                            fd.append('filetype',meta.filetype);

                            var filename = "";

                            // AJAX
                            jQuery.ajax({
                                url: "<?php echo base_url();?>admin/artikel/uploadfile",
                                type: "post",
                                data: fd,
                                contentType: false,
                                processData: false,
                                async: false,
                                success: function(response){
                                    filename = response;
                                }
                            });

                            reader.onload = function(e) {
                                callback(filename);
                            };
                            reader.readAsDataURL(file);
                        });
                    }

                }
            });
        }
    </script>
</head>
<body id="body">

<div id="Notifikasi"></div>
<div id="loading_ajax"><center style="padding:20px;"><div class="_ani_loading"><span style="clear:both">Memuat...</span></center></div></div>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">

            <div class="navbar-header" style="padding-left:20px;">

                <?php if($this->uri->segment(2) == 'dashboard'){?>
                    <a class="navbar-brand" href="<?php echo base_url().$this->uri->segment(1);?>/dashboard">
                    Dashboard
                    </a>
                <?php }?>

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if($this->uri->segment(2) != 'dashboard'){?>
                        <li><a href="<?php echo base_url().$this->uri->segment(1);?>/dashboard"><span class="fas fa-arrow-left"></span></a></li>
                    <?php }else{?>

                        <?php if($this->session->userdata('level') == "admin"){?>



                            <li><a href="<?php echo base_url();?>admin/topik"><i class='fa fa-link fa-fw'></i> Topik</a></li>
                            <li><a href="<?php echo base_url();?>admin/halaman"><i class='fa fa-file fa-fw'></i> Halaman</a></li>
                            <li><a href="<?php echo base_url();?>admin/artikel"><i class='fa fa-file-alt fa-fw'></i> Artikel</a></li>
                            <li><a href="<?php echo base_url();?>admin/gallery"><i class='fa fa-image fa-fw'></i> Gallery</a></li>
                            <li><a href="<?php echo base_url();?>admin/download"><i class='fa fa-file fa-fw'></i> Download</a></li>

                        <?php }?>

                        <?php if($this->session->userdata('level') == "guru"){?>
                            <li><a href="<?php echo base_url();?>guru/artikel"><i class='fa fa-file-alt fa-fw'></i> Artikel</a></li>
                        <?php }?>

                    <?php }?>
                </ul>


                <ul class="nav navbar-nav navbar-right" style="padding-right:20px;">
                    <li>
                        <div class="inset">
                            <img src="<?php echo $this->session->userdata('foto');?>">
                        </div>
                    </li>
                    <li><a href="<?php echo base_url().'index.php/auth/profile';?>">Hallo, <?php echo $this->session->userdata('username');?></a></li>

                    <?php if($this->session->userdata('level') == "admin"){?>
                    <li><a href="<?php echo base_url().'index.php/admin/pengaturan'; ?>" title="Pengaturan"><span class="fas fa-cog"></span></li></a>
                    <?php }?>

                    <li><a href="<?php echo base_url().'index.php'; ?>" target="_blank" title="Lihat Situs"><span class="fas fa-share-alt"></span></li></a>
                    <li onclick="aksiLogout()"><a href="javascript:void(0);" title="Logout"><span class="fas fa-power-off"></span></a></li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
<?php echo $contents ?>


    <footer class="footer container">

        <section class="col-sm-12" style="margin-top: 50px;">
            <div class="col-lg-10 col-lg-offset-1 text-center">
                <hr class="medium">
                <p class="text-muted" style="font-size: 12px;">Copyright &copy; 2018. Versi 1.0.0. Powered by <a href="https://berkarya.kopas.id/">@KopasProjects</a></p>
            </div>
        </section>
    </footer>
    <script src="<?php echo base_url('assets/admin/js/bootstrap.min.js') ?>"></script>
    <script id="jsbin-javascript">

        function aksiLogout() {
            swal({
                title: "Keluar?",
                text: "Kamu yakin mau keluar?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.assign("<?php echo base_url();?>auth/logout");
                    }

                });
        }

        $('.dropdown-toggle').click(function () {

            if (!$(this).parent().hasClass('open')) {

                $('html').addClass('menu-open');

            } else {

                $('html').removeClass('menu-open');


            }

        });


        <?php if($this->uri->segment(2) != 'dashboard'){?>
        $('.navbar-right').attr("style", "display:none;");
        $('.panel-title-button').attr("style", "display:block; margin-top:8px;margin-right:15px;");
        $('.panel-title-button').detach().prependTo( $('#bs-example-navbar-collapse-1') );


        $('.panel-footer-button').detach().prependTo( $('.modal__footer') );
        //$('.panel-heading').remove();
        <?php }?>


        $(document).on('click touchstart', function (a) {
            if ($(a.target).parents().index($('.navbar-nav')) == -1) {
                $('html').removeClass('menu-open');
            }
        });


    </script>

    <div class="modal" id="ModalGue" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class='fa fa-times'></i></button>
                    <h4 class="modal-title" id="ModalHeader"></h4>
                </div>
                <div class="modal-body" id="ModalContent"></div>
                <div class="modal-footer" id="ModalFooter"></div>
            </div>
        </div>
    </div>

</body>
</html>
