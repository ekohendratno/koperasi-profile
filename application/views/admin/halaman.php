<div class="container-flex">

    <div class="col-sm-12 col-md-12">


        <h4><i class='fa fa-file fa-fw'></i> HALAMAN <i class='fa fa-angle-right fa-fw'></i> DATA HALAMAN TERBARU</h4>
        <hr/>
        <div class="panel-title-button pull-right">
            <a href="#formSearch" data-toggle="modal" class="btn btn-sm" title="Search"><span class="fas fa-search"></span> Cari</a>
            <a href="#formFilter" data-toggle="modal" class="btn btn-sm" title="Filter"><span class="fas fa-filter"></span> Filter</a>
            <a data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog(0)" class="btn btn-sm btn-success" style="color: #fff;" title="Buat Halaman"><span class="fas fa-plus"></span> Buat Halaman</a>
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-8">
        <div>
            <div style="min-height:800px;">

                <ul class="nav nav-tabs" style="margin-bottom: 8px">
                    <li class="active"><a data-toggle="tab" href="#artikelpublish">Publish</a></li>
                    <li><a data-toggle="tab" href="#artikeldraf">Draf</a></li>
                    <li><a data-toggle="tab" href="#artikeltrash">Trash</a></li>
                </ul>

                <div class="tab-content">
                    <div id="artikelpublish" class="tab-pane fade in active">

                        <div id="postList0" class="list-group" style="font-size: 18px"></div>
                        <div id='pagination0'></div>

                    </div>
                    <div id="artikeldraf" class="tab-pane fade in">

                        <div id="postList1" class="list-group" style="font-size: 18px"></div>
                        <div id='pagination1'></div>

                    </div>
                    <div id="artikeltrash" class="tab-pane fade in">

                        <div id="postList2" class="list-group" style="font-size: 18px"></div>
                        <div id='pagination2'></div>

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
                        <h3 class="jumlah_artikel"><?php echo $total_artikel;?></h3>
                        <p>Total Halaman</p>
                    </div>
                    <div class="inner">
                        <h3 class="jumlah_artikel_hariini"><?php echo $total_artikel_today;?></h3>
                        <p>Halaman Hari ini</p>
                    </div>
                    <div class="inner">
                        <h3 class="jumlah_artikel_kemarin"><?php echo $total_artikel_tomorow;?></h3>
                        <p>Halaman Kemarin</p>
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
                        <a href="<?php echo base_url(). "admin/halaman/index"; ?>" class="btn btn-primary">Atur Ulang</a>
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>
                </h4>
            </div>
            <div class="modal-body">


                <div class="row">

                    <div class="col-md-8 col-md-offset-4">

                        <div class="col-md-4">
                            <label>Urutkan</label><br/>
                            <select class="form-control"  id="sortBy" onchange="searchFilter()">
                                <option value="">Sort By</option>
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>

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


<div class="modal fade modal-fullscreen" id="formDialog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">
            <div class="modal-header">
                <h4 class="modal-title">HALAMAN
                    <div class="pull-right">
                        <a href="#" onclick="submitSimpan()" class="btn btn-primary submitsimpan">Simpan</a>
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>
                </h4>
            </div>
            <div class="modal-body">



                <div class="container">

                    <div class="modal-status"></div>

                    <div class="row">


                        <form role="form" name="_form"  id="_form" novalidate>
                            <div class="row">
                                <div class="col-md-8 ">
                                    <input type="hidden" id="id" name="id" value="0"/>
                                    <input type="hidden" name="artikel_title_slug" value="" />


                                    <label>Judul</label><br/>
                                    <div class="input-group">
                                        <textarea style="font-size: 16pt" type="text" name="artikel_title" class="form-control"  required></textarea>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
                                    </div>
                                    <div class="artikel_title_slug"></div>

                                    <label>Konten</label><br/>
                                    <textarea style="font-size: 16pt; min-height:300px;" class="form-control" name="artikel_konten" id="tinyEditor"></textarea>

                                </div>
                                <div class="col-md-4">

                                    <label>Status Halaman</label><br/>
                                    <div class="form-group">
                                        <select class="form-control"  id="artikel_status" name="artikel_status">
                                            <option value="publish">Publish</option>
                                            <option value="draf">Draf</option>
                                            <option value="trash">Trash</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                        </form>


                    </div>


                </div>

            </div>

        </div>
    </div>
</div>

<script type="text/javascript" language="javascript" >

    $('[name="artikel_title"]').bind("keyup", function(event, ui) {

        var id = $('#id').val();
        var title = $('[name="artikel_title"]').val();

        if(id == 0){
            $.ajax({
                type: "GET",
                data: 'term='+title,
                url: "<?php echo site_url('admin/halaman/slug'); ?>",
                cache: false,
                dataType:'json',
                success: function(data){
                    if(data.success){
                        $('[name="artikel_title_slug"]').val(data.response);
                        $('.artikel_title_slug').html("<p style=\"padding-top:4px;padding-bottom:4px\"><b>Link:</b> <?php echo base_url();?>page/"+data.response+"</p>");
                    }
                }
            });

        }

    });

    searchFilter(0);
    function searchFilter(page_num) {
        page_num = page_num?page_num:0;

        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limitBy = $('#limitBy').val();
        var statusBy = "publish";//$('#statusBy').val();



        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/halaman/ajaxPaginationData/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy+'&statusBy='+statusBy,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);

                $('#pagination0').html(responseData.pagination);
                paginationData('#postList0',responseData.empData);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }


    searchFilterDraf(0);
    function searchFilterDraf(page_num) {
        page_num = page_num?page_num:0;

        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limitBy = $('#limitBy').val();
        var statusBy = "draf";



        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/halaman/ajaxPaginationData/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy+'&statusBy='+statusBy,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);

                $('#pagination1').html(responseData.pagination);
                paginationData('#postList1',responseData.empData);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }


    searchFilterTrash(0);
    function searchFilterTrash(page_num) {
        page_num = page_num?page_num:0;

        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limitBy = $('#limitBy').val();
        var statusBy = "trash";



        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/halaman/ajaxPaginationData/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&limitBy='+limitBy+'&statusBy='+statusBy,
            dataType:'json',
            beforeSend: function () {
                $('#loading_ajax').show();
            },
            success: function (responseData) {
                //console.log(responseData);
                //$('#paginationTop').html(responseData.pagination);

                $('#pagination2').html(responseData.pagination);
                paginationData('#postList2',responseData.empData);
            },
            complete: function(){
                $('#loading_ajax').fadeOut("slow");
            }
        });
    }

    function paginationData(id,data) {

        $(id).empty();
        var nomor = 0;

        if(data.length < 1 || !data){

            var empRow = ''+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">'+
                '<h4>Tidak ada daftar halaman</h4>'+
                '<p>Daftar halaman akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $(id).append(empRow);
        }else{

            for(emp in data){


                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].artikel_tanggal+'</span>'+
                    '</p><br/>'+
                    '<div class="col-md-8"><div class="row">'+
                    '<h4 class="list-group-item-heading name"><a data-backdrop="static" data-keyboard="false" href="#formtampil" data-toggle="modal" onclick="tampilData('+data[emp].artikel_id+')">'+data[emp].artikel_title+'</a></h4>'+
                    '<p><i style="color:#999">'+data[emp].artikel_konten+'</i></p>'+
                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<a title="Lihat Data" title="Lihat" target="_blank" href="<?php echo base_url();?>page?id='+data[emp].artikel_id+'" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-link"></span></a>'+
                    '<a title="Ubah Data" title="Ubah" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog('+data[emp].artikel_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                    '<a title="Hapus" onclick="submitHapus('+data[emp].artikel_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $(id).append(empRow);
            }

        }

    }



    function formDialog(id) {
        $('#id').val(0);
        $('[name="artikel_title"]').val("");
        tinyMCE.get('tinyEditor').setContent('<p><p>');
        $('[name="artikel_status"]').val("publish");

        $('[name="artikel_title_slug"]').val("");
        $('.artikel_title_slug').html("<p style=\"padding-top:4px;padding-bottom:4px\"><b>Link:</b> </p>");

        $('.submitsimpan').html("");
        $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Publikasi");
        if(id > 0){

            $('.submitsimpan').html("<i class=\"fa fa-circle-notch fa-spin buttonload\" style=\"display: none\"></i> Perbaharui");

            $.ajax({
                type: "POST",
                data: 'id='+id,
                url: "<?php echo site_url('admin/halaman/ambildatabyid'); ?>",
                cache: false,
                dataType:'json',
                success: function(data){
                    $('#id').val(id);
                    $('[name="artikel_title"]').val(data.artikel_title);
                    tinyMCE.get('tinyEditor').setContent(data.artikel_konten);

                    $('[name="artikel_status"]').val(data.artikel_status);


                    $('[name="artikel_title_slug"]').val(data.artikel_title_slug);
                    $('.artikel_title_slug').html("<p style=\"padding-top:4px;padding-bottom:4px\"><b>Link:</b> <?php echo base_url();?>page/"+data.artikel_title_slug+"</p>");



                }
            });
        }

    }


    $(document).ready(function(){
        $('#_form').submit(function(e){
            var form = new FormData(this);

            form.append('artikel_konten', tinyMCE.get("tinyEditor").getContent());
            // Attach file
            //form.append('artikel_foto', $('input[type=file]')[0].files[0]);

            e.preventDefault();
            $.ajax({
                type:'POST',
                data: form,
                url:'<?php echo base_url('index.php/admin/halaman/simpan') ;?>',
                dataType:'json',
                processData :false,
                contentType :false,
                cache :false,
                async :false,
                beforeSend: function () {
                    $('#loading_ajax').show();
                },
                success: function(hasil){
                    $('.buttonload').fadeOut("slow");
                    $('#loading_ajax').fadeOut("slow");
                    $('#Notifikasi').html('<p class="alert alert-success">'+hasil.pesan+'</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                    searchFilter(0);
                    searchFilterDraf(0);
                    searchFilterTrash(0);

                    formDialog(hasil.id);

                    //$("#formDialog").modal('hide');

                },
                complete: function(){
                    $('#loading_ajax').fadeOut("slow");
                }
            });
        });
    });

    function submitSimpan() {
        $('.buttonload').show();
        $('#loading_ajax').show();

        setTimeout(function(){
            $("#_form").submit();
        }, 3000);
    }



    function submitHapus(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'id='+id,
                url:'<?php echo base_url('admin/halaman/hapus') ;?>',
                cache: false,
                dataType:'json',
                success: function(hasil){
                    $('#Notifikasi').html('<p class="alert alert-success">'+hasil.pesan+'</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    searchFilter(0);
                    searchFilterDraf(0);
                    searchFilterTrash(0);
                }
            });
        }
    }
</script>