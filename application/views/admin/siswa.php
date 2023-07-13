<div class="container-flex">

    <div class="col-sm-12 col-md-12">


        <h4><i class='fa fa-file fa-fw'></i> SISWA & ORANG TUA <i class='fa fa-angle-right fa-fw'></i> DATA SISWA</h4>
        <hr/>
        <div class="panel-title-button pull-right">
            <a href="#formSearch" data-toggle="modal" class="btn btn-sm" title="Search"><span class="fas fa-search"></span> Cari</a>
            <a href="#formFilter" data-toggle="modal" class="btn btn-sm" title="Filter"><span class="fas fa-filter"></span> Filter</a>
            <a data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="submit('tambah')" class="btn btn-sm btn-success" style="color: #fff;" title="Tambah Siswa"><span class="fas fa-plus"></span> Tambah Siswa</a>
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-8">
        <div>
            <div style="min-height:800px;">


                <div id="postList0" class="list-group"></div>
                <div id='pagination'></div>


            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">

        <div class="row">
            <div class="col-md-12">
                <div class="small-box bg-light">
                    <div class="inner">
                        <h3 class="jumlah_siswa"><?php echo 0;?></h3>
                        <p>Total Artikel</p>
                    </div>
                    <div class="inner">
                        <h3 class="jumlah_siswa_hariini"><?php echo 0;?></h3>
                        <p>Artikel Hari ini</p>
                    </div>
                    <div class="inner">
                        <h3 class="jumlah_siswa_kemarin"><?php echo 0;?></h3>
                        <p>Artikel Kemarin</p>
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
                        <a href="<?php echo base_url(). "admin/siswa/index"; ?>" class="btn btn-primary">Atur Ulang</a>
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
                <h4 class="modal-title">SISWA
                    <div class="pull-right">
                        <a href="#" onclick="submitSimpan()" class="btn btn-primary">Simpan</a>
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>
                </h4>
            </div>
            <div class="modal-body">



                <div class="container">

                    <div class="modal-status"></div>

                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIS Siswa <span style="color: red">*</span> :</label>
                                <input  class="form-control" placeholder="Masukkan NIS Siswa" id="siswa_nis" name="siswa_nis" value="" />
                            </div>
                            <div class="form-group">
                                <label>Nama Siswa <span style="color: red">*</span> :</label>
                                <input  class="form-control" placeholder="Masukkan Nama Siswa" id="siswa_nama" name="siswa_nama" value="" />
                            </div>

                            <div class="form-group">
                                <label>Kelas <span style="color: red">*</span> :</label>
                                <input class="form-control" type="number" name="siswa_kelas" id="siswa_kelas" placeholder="Masukan Kelas" value="" />
                            </div>

                            <div class="form-group">
                                <label>Jurusan <span style="color: red">*</span> :</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="siswa_jurusan" id="siswa_jurusan" placeholder="Masukan Jurusan" value="" />
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Semester <span style="color: red">*</span> :</label>
                                <input class="form-control" type="number" name="siswa_semester" id="siswa_semester" placeholder="Masukan Semester" value="" />
                            </div>


                            <div class="form-group">
                                <label>Jenis kelamin <span style="color: red">*</span> :</label>
                                <input class="form-control" type="text" name="siswa_alamat" id="siswa_alamat" placeholder="Masukan jenis kelamin" value="" />
                            </div>
                            <div class="form-group">
                                <label>Tempat lahir <span style="color: red">*</span> :</label>
                                <input class="form-control" type="text" name="siswa_lahir_tempat" id="siswa_lahir_tempat" placeholder="Masukan tempat lahir" value="" />
                            </div>
                            <div class="form-group">
                                <label>Tanggal lahir <span style="color: red">*</span> :</label>
                                <input class="form-control" type="text" name="siswa_lahir_tanggal" id="siswa_lahir_tanggal" placeholder="Masukan tanggal lahir" value="" />
                            </div>
                            <div class="form-group">
                                <label>No telp <span style="color: red">*</span> :</label>
                                <input class="form-control" type="text" name="siswa_alamat" id="siswa_alamat" placeholder="Masukan Alamat" value="" />
                            </div>

                            <div class="form-group">
                                <label>Alamat <span style="color: red">*</span> :</label>
                                <input class="form-control" type="text" name="siswa_alamat" id="siswa_alamat" placeholder="Masukan Alamat" value="" />
                            </div>

                            <div class="form-group">
                                <label>Username <span style="color: red">*</span> :</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="siswa_username" id="siswa_username" placeholder="Masukan Username" value="" />
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Password <span style="color: red">*</span> :</label>
                                <input class="form-control" type="number" name="siswa_password" id="siswa_password" placeholder="Masukan Password" value="" />
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>NIK Ortu <span style="color: red">*</span> :</label>
                                <input class="form-control" type="text" name="orangtua_nik" id="orangtua_nik" placeholder="Masukan NIK Ortu" value="" />
                            </div>
                            <div class="form-group">
                                <label>Nama Ortu <span style="color: red">*</span> :</label>
                                <input class="form-control" type="text" name="orangtua_nama" id="orangtua_nama" placeholder="Masukan Nama Ortu" value="" />
                            </div>
                            <div class="form-group">
                                <label>No Telp Ortu <span style="color: red">*</span> :</label>
                                <input class="form-control" type="text" name="orangtua_no_telp" id="orangtua_no_telp" placeholder="Masukan No Telp Ortu" value="" />
                            </div>
                            <div class="form-group">
                                <label>Alamat Ortu <span style="color: red">*</span> :</label>
                                <input class="form-control" type="text" name="orangtua_alamat" id="orangtua_alamat" placeholder="Masukan Alamat Ortu" value="" />
                            </div>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </div>
</div>

<script type="text/javascript" language="javascript" >

    searchFilter(0);
    function searchFilter(page_num) {
        page_num = page_num?page_num:0;

        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limitBy = $('#limitBy').val();



        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/siswa/ajaxPaginationData/'+page_num,
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
                '<h4>Tidak ada daftar siswa</h4>'+
                '<p>Daftar siswa akan terlihat ketika data tersedia!.</p>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="clearfix"></div>'+
                '';
            $('#postList0').append(empRow);
        }else{

            for(emp in data){


                var empRow = '<div class="list-group-item">'+
                    '<p class="list-group-item-text title" style="text-align:center;">'+
                    ' <span class="label label-default">'+data[emp].siswa_kelas+'</span>'+
                    ' <span class="label label-default">'+data[emp].siswa_jurusan+'</span>'+
                    ' <span class="label label-default">'+data[emp].siswa_semester+'</span>'+
                    '</p><br/>'+
                    '<div class="col-md-8"><div class="row">'+
                    '<h4 class="list-group-item-heading name"><a data-backdrop="static" data-keyboard="false" href="#formtampil" data-toggle="modal" onclick="tampilData('+data[emp].siswa_id+')">'+data[emp].siswa_nama+'</a></h4>'+
                    '<p><i style="color:#999">'+data[emp].siswa_alamat+'</i></p>'+
                    '</div></div>'+
                    '<div class="col-md-4" style="text-align:center;"><div class="row">'+

                    '<a title="Ubah Data" title="Ubah" data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog('+data[emp].siswa_id+')" class="btn btn-circle btn-default" style="color: #5cb85c;" ><span class="fas fa-pen"></span></a>'+
                    '<a title="Hapus" onclick="submitHapus('+data[emp].siswa_id+')" class="btn btn-circle btn-default" style="color: #d9534f;"><span class="fas fa-trash"></span></a>'+



                    '</div></div>'+


                    '<div class="clearfix"></div>'+
                    '</div>';
                nomor++;
                $('#postList0').append(empRow);
            }

        }

    }



    function formDialog(id) {
        if(id > 0){
            $.ajax({
                type: "POST",
                data: 'id='+id,
                url: "<?php echo site_url('admin/siswa/ambildatabyid'); ?>",
                cache: false,
                dataType:'json',
                success: function(data){
                    $('#id').val(id);
                    $('#siswa_nis').val(data.siswa_nis);
                    $('#siswa_nama').val(data.siswa_nama);
                    $('#siswa_jurusan').val(data.siswa_jurusan);
                    $('#siswa_kelas').val(data.siswa_kelas);
                    $('#siswa_semester').val(data.siswa_semester);
                    $('#siswa_alamat').val(data.siswa_alamat);
                    $('#siswa_lahir_tempat').val(data.siswa_lahir_tempat);
                    $('#siswa_lahir_tanggal').val(data.siswa_lahir_tanggal);
                    $('#siswa_agama').val(data.siswa_agama);
                    $('#siswa_jenis_kelamin').val(data.siswa_jenis_kelamin);
                    $('#siswa_no_telp').val(data.siswa_no_telp);
                    $('#siswa_username').val(data.siswa_username);
                    $('#siswa_password').val(data.siswa_password);
                    $('#siswa_foto').val(data.siswa_foto);
                    $('#orangtua_nik').val(data.orangtua_nik);
                }
            });
        }

    }


    function submitTambah(){

        var FormData = "id="+$('#id').val();
        FormData += "&siswa_nama="+$('#siswa_nama').val();
        FormData += "&siswa_jurusan="+$('#siswa_jurusan').val();
        FormData += "&siswa_semester="+$('#siswa_semester').val();
        FormData += "&siswa_username="+$('#siswa_username').val();
        FormData += "&siswa_password="+$('#siswa_password').val();
        FormData += "&siswa_mac="+$('#siswa_mac').val();

        $.ajax({
            url: "<?php echo site_url('admin/siswa/simpan'); ?>",
            type: "POST",
            cache: false,
            data: FormData,
            dataType:'json',
            success: function(data){
                if(data.status == 1)
                {
                    alert(data.pesan);
                    window.location.href="<?php echo site_url('admin/siswa'); ?>";
                }
                else
                {
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('#ModalHeader').html('Oops !');
                    $('#ModalContent').html(data.pesan);
                    $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
                    $('#ModalGue').modal('show');
                }
            }
        });
    }


    function submitEdit() {
        submitTambah();
    }


    function submitHapus(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if(tanya){
            $.ajax({
                type:'POST',
                data: 'id='+id,
                url:'<?php echo base_url('admin/siswa/hapus') ;?>',
                cache: false,
                dataType:'json',
                success: function(data){
                    $('#Notifikasi').html(data.pesan);
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');
                    $('#my-grid').DataTable().ajax.reload( null, false );
                }
            });
        }
    }
</script>