<div class="container-flex">

    <div class="col-sm-12 col-md-12">


        <h4><i class='fa fa-file fa-fw'></i> TOPIK</h4>
        <hr />
        <div class="panel-title-button pull-right">
            <a data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="submit('tambah')" class="btn btn-sm btn-success" style="color: #fff;" title="Tambah Topik"><span class="fas fa-plus"></span> Tambah Topik</a>
        </div>

    </div>
    <!-- Blog Entries Column -->
    <div class="col-sm-12 col-md-12">
        <div>
            <div style="min-height:800px;">

                <link rel="stylesheet" href="<?php echo base_url("assets/admin/css/menu.css") ?>">


                <div class="padding">
                    <?php
                    $CI = &get_instance();



                    $get_group_id = 0;

                    $get_menu = $CI->_dynamic_menus_data($get_group_id);

                    $group_menu_ul = '<ul id="dragbox_easymn"></ul>';
                    if ($get_menu) {

                        include APPPATH . 'third_party/class-tree.php';

                        $tree = new Tree;

                        foreach ($get_menu as $row) {

                            $querymax    = $this->db->query("SELECT MAX(`topik_order`) FROM `topik` WHERE topik_parent = '" . $row['topik_parent'] . "' AND topik_group = '$get_group_id'");
                            $alhasil     = $querymax->result_array();
                            $numbers    = $alhasil[0];

                            $tree->add_row(
                                $row['topik_id'],
                                $row['topik_parent'],
                                ' id="menu-' . $row['topik_id'] . '" class="sortable_easymn"',
                                $CI->_dynamic_menus_label($row, $numbers)
                            );
                        }
                        $group_menu_ul = $tree->generate_list('id="dragbox_easymn"', true, 1);
                    }

                    echo $group_menu_ul;
                    ?>
                </div>


            </div>
        </div>
    </div>

</div>



<div class="modal fade modal-fullscreen" id="formDialog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-scroll">
            <div class="modal-header">
                <h4 class="modal-title">TOPIK
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

                        <form role="form" name="_form" id="_form" novalidate>
                            <input type="hidden" id="id" name="id" value="0" />

                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label>Topik Title <span style="color: red">*</span> :</label>
                                    <input class="form-control" placeholder="Masukkan Title" id="topik_title" name="topik_title" value="" />
                                </div>

                                <div class="form-group">
                                    <label>Topik Parent <span style="color: red">*</span> :</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="topik_parent" id="topik_parent" placeholder="Masukan Parent" value="" />
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Topik Link <span style="color: red">*</span> :</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="topik_link" id="topik_link" placeholder="Masukan Topik Link" value="" />
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Order <span style="color: red">*</span> :</label>
                                    <input class="form-control" type="number" name="topik_order" id="topik_order" value="0" />
                                </div>

                                <div class="form-group" style="display: none;">
                                    <label>Group <span style="color: red">*</span> :</label>
                                    <input class="form-control" type="number" name="topik_group" id="topik_group" value="0" />
                                </div>

                                <div class="form-group" style="display: none;">
                                    <label>Class <span style="color: red">*</span> :</label>
                                    <input class="form-control" placeholder="Masukkan Class" id="topik_class" name="topik_class" value="" />
                                </div>

                            </div>

                        </form>
                    </div>

                </div>


            </div>

        </div>

    </div>
</div>


<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $('[name="topik_parent"]').autocomplete({
            minLength: 0,
            source: "<?php echo site_url('admin/topik/data2/?'); ?>",
            focus: function(event, ui) {
                $('[name="topik_parent"]').val(ui.item.label);
                return false;
            },
            select: function(event, ui) {
                $('[name="topik_parent"]').val(ui.item.label2);

                return false;
            }
        });
        $('[name="topik_link"]').autocomplete({
            minLength: 0,
            source: "<?php echo site_url('admin/topik/data1/?'); ?>",
            focus: function(event, ui) {
                $('[name="topik_link"]').val(ui.item.label);
                return false;
            },
            select: function(event, ui) {
                $('[name="topik_link"]').val(ui.item.label2);

                return false;
            }
        });

        $('#_form').submit(function(e) {
            var form = new FormData(this);

            e.preventDefault();
            $.ajax({
                type: 'POST',
                data: form,
                url: '<?php echo base_url('index.php/admin/topik/simpan'); ?>',
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

                    location.assign("<?php echo base_url('index.php/admin/topik'); ?>");

                }
            });
        });
    });


    function formDialog(id) {
        $('#id').val(0);
        $('[name="topik_title"]').val("");
        $('[name="topik_link"]').val("");
        $('[name="topik_parent"]').val("");
        $('[name="topik_order"]').val("");
        $('[name="topik_group"]').val("");
        $('[name="topik_class"]').val("");

        if (id > 0) {
            $.ajax({
                type: "POST",
                data: 'id=' + id,
                url: "<?php echo site_url('admin/topik/ambildatabyid'); ?>",
                cache: false,
                dataType: 'json',
                success: function(data) {
                    $('#id').val(id);
                    $('[name="topik_title"]').val(data.topik_title);
                    $('[name="topik_link"]').val(data.topik_link);
                    $('[name="topik_parent"]').val(data.topik_parent);
                    $('[name="topik_order"]').val(data.topik_order);
                    $('[name="topik_group"]').val(data.topik_group);
                    $('[name="topik_class"]').val(data.topik_class);

                }
            });
        }

    }


    function submitSimpan() {
        $("#_form").submit();
    }



    function submitHapus(id) {
        var tanya = confirm('Apakah yakin mau hapus data?');
        if (tanya) {
            $.ajax({
                type: 'POST',
                data: 'id=' + id,
                url: '<?php echo base_url('admin/topik/hapus'); ?>',
                cache: false,
                dataType: 'json',
                success: function(hasil) {
                    $('#Notifikasi').html('<p class="alert alert-success">' + hasil.pesan + '</p>');
                    $("#Notifikasi").fadeIn('fast').show().delay(3000).fadeOut('fast');

                    window.location.href = "<?php echo site_url('admin/topik'); ?>";
                    //searchFilter(0);
                }
            });
        }
    }


    function topicDown(id) {

    }


    function topicUp(id) {

    }
    
</script>