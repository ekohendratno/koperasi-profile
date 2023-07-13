<div class="container-flex">

    <div class="col-sm-12 col-md-12">


        <h4><i class='fa fa-file fa-fw'></i> DOWNLOAD<i class='fa fa-angle-right fa-fw'></i> DATA DOWNLOAD</h4>
        <hr/>
        <div class="panel-title-button pull-right">
            <a href="#formSearch" data-toggle="modal" class="btn btn-sm" title="Search"><span class="fas fa-search"></span> Cari</a>
            <a href="#formFilter" data-toggle="modal" class="btn btn-sm" title="Filter"><span class="fas fa-filter"></span> Filter</a>
            <a title="Tambah Download Baru" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog(0)" class="btn btn-sm btn-success" style="color: #fff;"><i class="fas fa-plus"></i> Tambah Download</a>
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-8">
        <div>
            <div style="min-height:800px;">


                <div id="postList0" class="list-group" style="font-size: 18px"></div>
                <div id='pagination'></div>


            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">

        <div class="row">
            <div class="col-md-12">
                <div class="small-box bg-light">
                    <div class="inner">
                        <h3><?php echo $total_download;?></h3>
                        <p>Total download</p>
                    </div>
                    <div class="inner">
                        <h3 ><?php echo $total_download_today;?></h3>
                        <p>Download Hari ini</p>
                    </div>
                    <div class="inner">
                        <h3><?php echo $total_download_tomorow;?></h3>
                        <p>Download Kemarin</p>
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
                        <a href="<?php echo base_url(). "admin/download/index"; ?>" class="btn btn-primary">Atur Ulang Setingan</a>
                        <a href="#" class="btn btn-danger btn-sm btn-circle" data-dismiss="modal"><i class="fas fa-times"></i></a>
                    </div>
                </h4>
            </div>
            <div class="modal-body">

                <div class="container container-small">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="col-md-6">
                                <label>Urutkan</label><br/>
                                <select class="form-control"  id="sortBy" onchange="searchFilter()">
                                    <option value="">Sort By</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>


                            </div>
                            <div class="col-md-6">

                                <label>Jumlah ditampilkan</label><br/>
                                <select class="form-control"  id="limitBy" onchange="searchFilter()">
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
            <form role="form" name="_form"  id="_form" novalidate>

                <input type="hidden" id="id" name="id" value="0"/>
                <input type="hidden" name="download_title_slug" value="" />
                
                <div class="modal-header">
                    <h4 class="modal-title">Upload File Download
                        <div class="pull-right">
                            <a href="#" onclick="submitSimpan()" class="btn btn-primary submitsimpan">Simpan</a>
                            <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        </div>
                    </h4>
                </div>
                <div class="modal-body">

                    <div class="col-md-6 col-md-offset-3">


                        <label>Tanggal</label><br/>
                        <div class="form-group">
                            <div class='input-group date' id='datetimePicker'>
                                <input type='text' name="download_tanggal" class="form-control" />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Title :</label>
                            <input  class="form-control" placeholder="Masukkan Title" id="download_title" name="download_title" value="" />
                        </div>


                        <div class="download_title_slug"></div>


                        <div class="form-group">
                            <label>Tags :</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="download_tags" id="download_tags" placeholder="Masukan Tags" value="" />
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
                                <input class="form-control" type="text" name="download_parent" id="download_parent" placeholder="Masukan Parent" value="" />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="form-group" style="display: none;">
                            <label>Order :</label>
                            <input class="form-control" type="number" name="download_order" id="download_order" value="0" />
                        </div>

                        <div class="form-group">
                            <label>File</label><br/>
                            <input type="file" class="form-control" name="download_filename"/>
                        </div>
                        
                        
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" language="javascript" >

    $(document).ready(function(){

        $('[name="download_parent"]').autocomplete({
            minLength: 0,
            source: "<?php echo site_url('admin/download/data2/?');?>",
            focus: function (event, ui) {
                $('[name="download_parent"]').val(ui.item.label);
                return false;
            },
            select: function (event, ui) {
                $('[name="download_parent"]').val(ui.item.label2);

                return false;
            }
        });

        $('[name="download_tags"]').autocomplete({
            minLength: 0,
            source: "<?php echo site_url('admin/download/data3/?');?>",
            focus: function (event, ui) {
                $('[name="download_tags"]').val(ui.item.label);
                return false;
            },
            select: function (event, ui) {
                $('[name="download_tags"]').val(ui.item.label);

                return false;
            }
        });

        $('#_form').submit(function(e){
            var form = new FormData(this);

            e.preventDefault();
            $.ajax({
                type:'POST',
                data: form,
                url:'<?php echo base_url('index.php/admin/download/simpan') ;?>',
                dataType:'json',
                processData :false,
                contentType :false,
                cache :false,
                async :false,
                success: function(hasil){
                    $('#loading_ajax').fadeOut("slow");
                    $('#Notifikasi').html('<p class="alert alert-success">'+hasil.pesan+'</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                    $("#formDialog").modal('hide');

                    location.assign("<?php echo base_url('index.php/admin/download') ;?>");

                }
            });
        });
    });


    $('[name="download_title"]').bind("keyup", function(event, ui) {

        var id = $('#id').val();
        var title = $('[name="download_title"]').val();

        if(id == 0){
            $.ajax({
                type: "GET",
                data: 'term='+title,
                url: "<?php echo site_url('admin/download/slug'); ?>",
                cache: false,
                dataType:'json',
                success: function(data){
                    if(data.success){
                        $('[name="download_title_slug"]').val(data.response);
                        $('.download_title_slug').html("<p style=\"padding-top:4px;padding-bottom:4px\"><b>Link:</b> <?php echo base_url();?>download/"+data.response+"</p>");
                    }
                }
            });

        }

    });

    $('#datetimePicker').datetimepicker({
        // dateFormat: 'dd-mm-yy',
        defaultDate: new Date(),
        format:'YYYY-MM-DD'
    });


    $('#formSearch').on('shown.bs.modal', function() {
        $('#keywords').trigger('focus');
    });

    searchFilter(0);
    function searchFilter(page_num) {
        page_num = page_num?page_num:0;

        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limitBy = $('#limitBy').val();



        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/download/ajaxPaginationData/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);
                $('#pagination').html(responseData.pagination);
                paginationData(responseData.empData);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }



    function paginationData(data) {

        $('#postList0').empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar download</h4>'+
                '<p>Daftar download akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postList0').append(empRow);
        }else{

            for(emp in data){





                var empRow = '<div class="list-group-item">'+
                    '<div class="col-md-8"><div class="row">'+

                    '<p class="list-group-item-text title">'+
                    ' <span class="label label-default">'+data[emp].download_tanggal+'</span>'+
                    ' <span class="label label-default">'+data[emp].download_parent+'</span>'+
                    ' <span class="label label-default">'+data[emp].download_order+'</span>'+
                    '</p><br/>'+

                    '<h4 class="list-group-item-heading name">'+data[emp].download_title+'</h4>'+

                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<a title="Ubah Data" title="Ubah" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog('+data[emp].download_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                    '<a title="Hapus" onclick="submitHapus('+data[emp].download_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+


                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postList0').append(empRow);
            }

        }

    }




    function submitSimpan() {
        $('.buttonload').show();
        $('#loading_ajax').show();
        setTimeout(function(){
            $("#_form").submit();
        }, 3000);
    }


    function formDialog(id) {
        $('#id').val(0);
        $('[name="download_title"]').val("");
        $('[name="download_tags]').val("");
        $('[name="download_parent"]').val("");
        $('[name="download_order"]').val(0);
        $('[name="download_filename"]').val("");

        $('[name="download_title_slug"]').val("");
        $('.download_title_slug').html("<p style=\"padding-top:4px;padding-bottom:4px\"><b>Link:</b> </p>");

        $('.submitsimpan').html("");
        $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Publikasi");
        if(id > 0){

            $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Perbaharui");

            $.ajax({
                type: "POST",
                data: 'id='+id,
                url: "<?php echo site_url('admin/download/ambildatabyid'); ?>",
                cache: false,
                dataType:'json',
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(data){
                    $('#id').val(id);
                    $('[name="download_title"]').val(data.download_title);
                    $('[name="download_tags"]').val(data.download_tags);
                    $('[name="download_parent"]').val(data.download_parent);
                    $('[name="download_order"]').val(data.download_order);

                    if(data.download_tanggal != "0000-00-00 00:00:00"){
                        $('[name="download_tanggal"]').val(data.download_tanggal);
                    }


                    $('[name="download_title_slug"]').val(data.download_title_slug);
                    $('.download_title_slug').html("<p style=\"padding-top:4px;padding-bottom:4px\"><b>Link:</b> <?php echo base_url();?>download/"+data.download_title_slug+"</p>");

                },
                complete: function(){
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        }

    }


    function submitHapus(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'id='+id,
                url:'<?php echo base_url('admin/download/hapus') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){
                    $('#Notifikasi').html('<p class="alert alert-success">'+hasil.pesan+'</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    searchFilter(0);
                }
            });
        }
    }

</script>