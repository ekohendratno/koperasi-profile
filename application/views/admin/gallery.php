<div class="container-flex">

    <div class="col-sm-12 col-md-12">


        <h4><i class='fa fa-file fa-fw'></i> GALLERY<i class='fa fa-angle-right fa-fw'></i> DATA GALLERY</h4>
        <hr />
        <div class="panel-title-button pull-right">
            <a href="#formSearch" data-toggle="modal" class="btn btn-sm" title="Search"><span class="fas fa-search"></span> Cari</a>
            <a href="#formFilter" data-toggle="modal" class="btn btn-sm" title="Filter"><span class="fas fa-filter"></span> Filter</a>
            <a title="Tambah Gallery Baru" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog(0)" class="btn btn-sm btn-success" style="color: #fff;"><i class="fas fa-plus"></i> Tambah Gallery</a>
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-8">
        <div>
            <div style="min-height:800px;">



                <ul class="nav nav-tabs" style="margin-bottom: 8px">
                    <li class="active"><a data-toggle="tab" href="#foto">Foto</a></li>
                    <li><a data-toggle="tab" href="#video">Video</a></li>
                </ul>

                <div class="tab-content">
                    <div id="foto" class="tab-pane fade in active">

                        <div id="postList0" class="list-group" style="font-size: 18px"></div>
                        <div id='pagination0'></div>

                    </div>
                    <div id="video" class="tab-pane fade in">

                        <div id="postList1" class="list-group" style="font-size: 18px"></div>
                        <div id='pagination1'></div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">

        <div class="row">
            <div class="col-md-12">
                <div class="small-box bg-light">
                    <div class="inner">
                        <h3><?php echo $total_gallery; ?></h3>
                        <p>Total Gallery</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $total_gallery_today; ?></h3>
                        <p>Gallery Hari ini</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $total_gallery_tomorow; ?></h3>
                        <p>Gallery Kemarin</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>



    </div>


</div>


<div class="modal fade" id="formSearch" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">


                    <div class="col-md-12">
                        <div class="input-group input-group-lg">
                            <div class="input-group-addon"><i class="fas fa-search"></i></div>
                            <input type="text" class="form-control token" name="keywords" id="keywords" placeholder="Type keywords to filter posts" onkeyup="searchFilter()">
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="formFilter" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Filter
                    <div class="pull-right">
                        <a href="<?php echo base_url() . "admin/gallery/index"; ?>" class="btn btn-primary">Atur Ulang Setingan</a>
                        <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                    </div>
                </h4>
            </div>
            <div class="modal-body">

                <div class="container container-small">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="col-md-6">
                                <label>Urutkan</label><br />
                                <select class="form-control" id="sortBy" onchange="searchFilter()">
                                    <option value="">Sort By</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>


                            </div>
                            <div class="col-md-6">

                                <label>Jumlah ditampilkan</label><br />
                                <select class="form-control" id="limitBy" onchange="searchFilter()">
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="150">150</option>
                                    <option value="200">200</option>
                                </select>
                            </div>


                        </div>

                    </div>


                </div>


            </div>


        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="formDialog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">
            <form role="form" name="_form" id="_form" novalidate>

                <input type="hidden" id="id" name="id" value="0" />
                <input type="hidden" name="gallery_title_slug" value="" />

                <div class="modal-header">
                    <h4 class="modal-title">Upload File Gallery
                        <div class="pull-right">
                            <a href="#" onclick="submitSimpan()" class="btn btn-primary submitsimpan">Simpan</a>
                            <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        </div>
                    </h4>
                </div>
                <div class="modal-body">

                    <div class="col-md-6 col-md-offset-3">


                        <label>Tanggal</label><br />
                        <div class="form-group">
                            <div class='input-group date' id='datetimePicker'>
                                <input type='text' name="gallery_tanggal" class="form-control" />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>

                        <label>Tipe</label><br />
                        <div class="form-group">
                            <select class="form-control" id="gallery_type" name="gallery_type">
                                <option value="">Pilih Tipe Gallery</option>
                                <option value="foto">Foto</option>
                                <option value="video">Video</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Title :</label>
                            <input class="form-control" placeholder="Masukkan Title" id="gallery_title" name="gallery_title" value="" />
                        </div>


                        <div class="gallery_title_slug"></div>


                        <div class="form-group">
                            <label>Tags :</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="gallery_tags" id="gallery_tags" placeholder="Masukan Tags" value="" />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="display: none;">
                            <label>Parent :</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="gallery_parent" id="gallery_parent" placeholder="Masukan Parent" value="" />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="form-group" style="display: none;">
                            <label>Order :</label>
                            <input class="form-control" type="number" name="gallery_order" id="gallery_order" value="0" />
                        </div>

                        <div class="form-group" id="foto_show">
                            <label>Image Thumbnail</label><br />
                            <input type="file" class="form-control" name="gallery_filename" accept=".jpg,.jpeg,.png" />
                            <br />
                            <img id="thumbnail" src="<?php echo base_url() . 'assets/images/900x300.png'; ?>" width="100%" />
                            <br><br />
                        </div>

                        <div class="form-group" id="video_show">
                            <label>ID Video Youtube : </label> https://www.youtube.com/watch?v=<strong>7DiP5FESDwQ</strong>
                            <input class="form-control" placeholder="Masukkan ID Youtube" id="gallery_filename2" name="gallery_filename2" value="" />
                        </div>


                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {

        $('[name="gallery_parent"]').autocomplete({
            minLength: 0,
            source: "<?php echo site_url('admin/gallery/data2/?'); ?>",
            focus: function(event, ui) {
                $('[name="gallery_parent"]').val(ui.item.label);
                return false;
            },
            select: function(event, ui) {
                $('[name="gallery_parent"]').val(ui.item.label2);

                return false;
            }
        });

        $('[name="gallery_tags"]').autocomplete({
            minLength: 0,
            source: "<?php echo site_url('admin/gallery/data3/?'); ?>",
            focus: function(event, ui) {
                $('[name="gallery_tags"]').val(ui.item.label);
                return false;
            },
            select: function(event, ui) {
                $('[name="gallery_tags"]').val(ui.item.label);

                return false;
            }
        });

        $('#_form').submit(function(e) {
            var form = new FormData(this);

            e.preventDefault();
            $.ajax({
                type: 'POST',
                data: form,
                url: '<?php echo base_url('index.php/admin/gallery/simpan'); ?>',
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(hasil) {
                    $('#loading_ajax').fadeOut("slow");
                    $('#Notifikasi').html('<p class="alert alert-success">' + hasil.pesan + '</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                    $("#formDialog").modal('hide');

                    location.assign("<?php echo base_url('index.php/admin/gallery'); ?>");

                }
            });
        });
    });


    $('[name="gallery_title"]').bind("keyup", function(event, ui) {

        var id = $('#id').val();
        var title = $('[name="gallery_title"]').val();

        if (id == 0) {
            $.ajax({
                type: "GET",
                data: 'term=' + title,
                url: "<?php echo site_url('admin/gallery/slug'); ?>",
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('[name="gallery_title_slug"]').val(data.response);
                        $('.gallery_title_slug').html("<p style=\"padding-top:4px;padding-bottom:4px\"><b>Link:</b> <?php echo base_url(); ?>gallery/" + data.response + "</p>");
                    }
                }
            });

        }

    });

    $('#datetimePicker').datetimepicker({
        // dateFormat: 'dd-mm-yy',
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });


    $('#formSearch').on('shown.bs.modal', function() {
        $('#keywords').trigger('focus');
    });


    $('#gallery_type').change(function() {
        var type = $(this).val();


        $("#foto_show").removeAttr("style").hide();
        $("#video_show").removeAttr("style").hide();

        if(type == "video"){
            $("#video_show").show();
        }
        
        if(type == "foto"){
            $("#foto_show").show();
        }
    });



    searchFilterFoto(0);

    function searchFilterFoto(page_num) {
        page_num = page_num ? page_num : 0;

        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limitBy = $('#limitBy').val();



        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/gallery/ajaxPaginationData/' + page_num,
            data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&limitBy=' + limitBy + '&typeBy=foto',
            dataType: 'json',
            beforeSend: function() {
                $('#loading_ajax').show();
            },
            success: function(responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);
                $('#pagination').html(responseData.pagination);
                paginationData('#postList0', responseData.empData);
            },
            complete: function() {
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }
    searchFilterVideo(0);

    function searchFilterVideo(page_num) {
        page_num = page_num ? page_num : 0;

        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limitBy = $('#limitBy').val();



        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/gallery/ajaxPaginationData/' + page_num,
            data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&limitBy=' + limitBy + '&typeBy=video',
            dataType: 'json',
            beforeSend: function() {
                $('#loading_ajax').show();
            },
            success: function(responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);
                $('#pagination').html(responseData.pagination);
                paginationData('#postList1', responseData.empData);
            },
            complete: function() {
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }




    function paginationData(id, data) {

        $(id).empty();
        var nomor = 0;

        if (data.length < 1 || !data) {

            var empRow = '' +
                '<div class="row">' +
                '<div class="col-md-12">' +
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">' +
                '<h4>Tidak ada daftar gallery</h4>' +
                '<p>Daftar gallery akan terlihat ketika data tersedia!.</p>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="clearfix"></div>' +
                '';
            $(id).append(empRow);

        } else {

            for (emp in data) {





                var empRow = '<div class="list-group-item">' +

                    '<div class="col-md-2" style="text-align:center;"><div class="row">' +
                    '<img class="img-responsive" src="' + data[emp].thumbnail + '">' +
                    '<br/><br/>' +
                    '<div class="clearfix"></div>' +
                    '</div></div>' +

                    '<div class="col-md-6"><div class="row">' +

                    '<p class="list-group-item-text title">' +
                    ' <span class="label label-default">' + data[emp].gallery_tanggal + '</span>' +
                    ' <span class="label label-default">' + data[emp].gallery_parent + '</span>' +
                    ' <span class="label label-default">' + data[emp].gallery_order + '</span>' +
                    '</p><br/>' +

                    '<h4 class="list-group-item-heading name">' + data[emp].gallery_title + '</h4>' +

                    '</div></div>' +
                    '<div class="col-md-4" style="text-align:center;"><div class="row">' +

                    '<a title="Ubah Data" title="Ubah" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog(' + data[emp].gallery_id + ')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>' +
                    '<a title="Hapus" onclick="submitHapus(' + data[emp].gallery_id + ')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>' +


                    '</div></div>' +


                    '<div class="clearfix"></div>' +
                    '</div>';
                nomor++;
                $(id).append(empRow);
            }

        }

    }




    function submitSimpan() {
        $('.buttonload').show();
        $('#loading_ajax').show();
        setTimeout(function() {
            $("#_form").submit();
        }, 3000);
    }


    function formDialog(id) {
        $('#id').val(0);
        $('[name="gallery_title"]').val("");
        $('[name="gallery_tags]').val("");
        $('[name="gallery_parent"]').val("");
        $('[name="gallery_order"]').val(0);
        $('[name="gallery_filename"]').val("");
        $('[name="gallery_filename2"]').val("");
        $("#thumbnail").attr("src", "");
        $("#foto_show").css("display", "none");
        $("#video_show").css("display", "none");

        $('[name="gallery_title_slug"]').val("");
        $('.gallery_title_slug').html("<p style=\"padding-top:4px;padding-bottom:4px\"><b>Link:</b> </p>");

        $('.submitsimpan').html("");
        $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Publikasi");
        if (id > 0) {

            $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Perbaharui");

            $.ajax({
                type: "POST",
                data: 'id=' + id,
                url: "<?php echo site_url('admin/gallery/ambildatabyid'); ?>",
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#loading_ajax').show();
                },
                success: function(data) {
                    $('#id').val(id);
                    $('[name="gallery_title"]').val(data.gallery_title);
                    $('[name="gallery_tags"]').val(data.gallery_tags);
                    $('[name="gallery_parent"]').val(data.gallery_parent);
                    $('[name="gallery_order"]').val(data.gallery_order);

                    $('[name="gallery_type"]').val(data.gallery_type);

                    if (data.gallery_type == "video") {
                        $("#video_show").css("display", "block");
                        $('[name="gallery_filename2"]').val(data.gallery_filename);
                    }else{
                        $("#foto_show").css("display", "block");
                    }

                    if (data.gallery_tanggal != "0000-00-00 00:00:00") {
                        $('[name="gallery_tanggal"]').val(data.gallery_tanggal);
                    }

                    $("#thumbnail").attr("src", data.thumbnail);

                    $('[name="gallery_title_slug"]').val(data.gallery_title_slug);
                    $('.gallery_title_slug').html("<p style=\"padding-top:4px;padding-bottom:4px\"><b>Link:</b> <?php echo base_url(); ?>gallery/" + data.gallery_title_slug + "</p>");

                },
                complete: function() {
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }

    }


    function submitHapus(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if (tanya) {
            $.ajax({
                type: 'POST',
                data: 'id=' + id,
                url: '<?php echo base_url('admin/gallery/hapus'); ?>',
                cache: false,
                dataType: 'json',
                success: function(hasil) {
                    $('#Notifikasi').html('<p class="alert alert-success">' + hasil.pesan + '</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    searchFilter(0);
                }
            });
        }
    }
</script>