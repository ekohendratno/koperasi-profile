<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function dynamic_meta($args = array()) {
    $CI =& get_instance();
    $CI->load->helpers('url');
    $CI->load->helpers('text');

    $title = "";
    $description = "";
    $keywords = "";
    $author = "";


    $query = $CI->db->query("SELECT * FROM pengaturan WHERE pengaturan_key = 'Titles'")->result_array();
    $title = $query[0]['pengaturan_value'];

    $query = $CI->db->query("SELECT * FROM pengaturan WHERE pengaturan_key = 'Description'")->result_array();
    $description = $query[0]['pengaturan_value'];

    $query = $CI->db->query("SELECT * FROM pengaturan WHERE pengaturan_key = 'Keywords'")->result_array();
    $keywords = $query[0]['pengaturan_value'];

    $query = $CI->db->query("SELECT * FROM pengaturan WHERE pengaturan_key = 'Author'")->result_array();
    $author = $query[0]['pengaturan_value'];




    if ($CI->uri->segment(1) == "post" || $CI->uri->segment(1) == "page") {
        $id = $CI->input->get("id");
        $query 	= $CI->db->query("SELECT * FROM artikel WHERE artikel_id = '$id'");
        foreach ($query->result_array() as $row){
            $title = $row['artikel_title'];
            $description = word_limiter( strip_tags($row['artikel_konten']),15);

            if(!empty( $row['artikel_tags']))
            $keywords = $row['artikel_tags'];

            $author = $row['artikel_author'];
        }
    }

    ?>
    <meta name="description" content="<?php echo $description;?>">
    <meta name="keywords" content="<?php echo $keywords;?>">
    <meta name="author" content="<?php echo $author;?>">
    <title><?php echo $title;?></title>
    <?php

}


function dynamic_head() {
    $CI =& get_instance();
    $CI->load->helpers('url');
    $CI->load->helpers('text');

    $CI->load->view("themes/function");
    /**
    if(file_exists(APPPATH.'view/themes/function.php')){
        include APPPATH.\'view/themes/function.php\';
    }*/

}

function dynamic_menus($group_id, $attr = '', $ul = true) {
    $CI =& get_instance();

    if( !class_exists('Tree') )
        include APPPATH.'third_party/class-tree.php';

    $tree = new Tree;

    $menu 	= array();
    $query 	= $CI->db->query("SELECT * FROM topik WHERE topik_group = '$group_id' ORDER BY topik_parent, topik_order");

    foreach ($query->result_array() as $row){

        $li_attr = '';
        if ($row['topik_class']) {
            $li_attr = ' class="'.$row['topik_class'].'"';
        }

        $label = '<a'.$li_attr.' href="'.base_url() . $row['topik_link'].'">';
        $label .= $row['topik_title'];
        $label .= '</a>';

        $tree->add_row($row['topik_id'], $row['topik_parent'], $li_attr, $label);
    }
    $menu = $tree->generate_list($attr, $ul);
    return $menu;
}

function dynamic_nav_menu( $args = array(), $echo = true ){
    $CI =& get_instance();


    $group_id = 0;



    include APPPATH.'third_party/class-tree.php';

    $tree = new Tree;

    $group_menu_ul = '<ul class="nav"></ul>';

    $query 	= $CI->db->query("SELECT * FROM topik WHERE topik_group = '$group_id' ORDER BY topik_parent, topik_order");
    foreach ($query->result_array() as $row){

        $querymax	= $CI->db->query("SELECT MAX(`topik_order`) FROM `topik` WHERE topik_parent = '".$row['topik_parent']."' AND topik_group = '$group_id'");
        $alhasil 	= $querymax->result_array();
        $numbers	= $alhasil[0];

        $label = '<a href="'. base_url() . $row['topik_link'].'">'.$row['topik_title'].'</a>';
        if($row['topik_link'] == "#"){
            $label = '<a href="#">'.$row['topik_title'].'</a>';
        }

        $li_attr = '';
        if ($row['topik_class']) {
            $li_attr = ' class="'.$row['topik_class'].'"';
        }

        //if($row['topik_order'] == 0) $li = ' class="dropdown dropdown-submenu"';

        $tree->add_row( $row['topik_id'], $row['topik_parent'], $li_attr, $label );
    }

    if ($args['li']) {
        if(is_array($args['li'])){
            foreach ($args['li'] as $li){
                $tree->add_row(100, 0, '', $li);
            }
        }else{
            $tree->add_row(100, 0, '', $args['li']);
        }
    }

    $group_menu_ul = $tree->generate_list('class="nav '.$args["menu_class"].'"',true,2);

    echo $group_menu_ul;

}

function dynamic_sidebar($index = 1) {
    $CI =& get_instance();

    $CI->load->helper('url');

    $registered_sidebars = array();


    if ( is_int($index) ) {
        $index = "sidebar-$index";
    } else {
        $index = isset($index);
        foreach ( (array) $registered_sidebars as $key => $value ) {
            if ( isset($value['name']) == $index ) {
                $index = $key;
                break;
            }
        }
    }

    //echo $index;
    ?>

    <?php if($CI->uri->segment(1) != "page"):?>

        <!--
    <div class="well">
        <h4>SOSIAL MEDIA</h4>
        <div class="row" style="text-align: -webkit-center;">
            <div style="width: 340px;">

                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fsmkn1candipuro&tabs=&width=340&height=500&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=false&appId" width="100%" height="100%" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>

            </div>
        </div>
    </div>-->

    <?php endif;?>
    <?php if($CI->uri->segment(1) != null && $CI->uri->segment(1) != "page"):?>


        <!-- Blog Search Well -->
        <div class="well">
            <h4>Pencarian</h4>
            <form action="<?php echo base_url();?>post" method="get">
                <div class="input-group">
                    <input name="cari" type="text" class="form-control" value="<?php echo $CI->input->get('cari');?>">
                    <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        	</button>
                        </span>
                </div>
            </form>
            <!-- /.input-group -->
        </div>

        <div class="well">
            <h4>Populer Post</h4>
            <div class="row">
                <div class="col-lg-12">

                        <?php
                        $query 	= $CI->db->query("SELECT * FROM artikel WHERE artikel_ketegori='Blog'  AND `artikel_status`='publish' ORDER BY artikel_hits DESC LIMIT 10");
                        foreach ($query->result_array() as $row){
                        ?>

                            <?php
                            $posted = explode(" ",$row["artikel_tanggal"]);
                            $posted = explode("-",$posted[0]);

                            $year = sprintf("%04d", $posted[0]);
                            $month = sprintf("%02d", $posted[1]);

                            $the_thumbnail = base_url('assets/images/64x64.png');
                            if( !empty($row["artikel_foto"]) && file_exists(FCPATH . 'uploads/posts/' .$year."/".$month."/". $row["artikel_foto"]) ) {
                                $the_thumbnail = base_url('thumb.php?size=64x64&src=./uploads/posts/' .$year."/".$month."/". $row["artikel_foto"]);
                            }

                            ?>
                            <div class="media">
                                <a href="<?php echo base_url() ."post?id=". $row['artikel_id'];?>">
                                    <div class="media-left">
                                        <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="<?php echo $the_thumbnail;?>" style="width: 64px; height: 64px;">

                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo $row['artikel_title'];?></h4>
                                        <p><?php echo date("M d, Y", strtotime($row["artikel_tanggal"]));?></p>
                                    </div>
                                </a>
                            </div>


                        <?php
                        }
                        ?>

                </div>
            </div>
        </div>

    <?php else:?>


        <div class="well">
            <h4>Menu Halaman</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">


                        <?php
                        $query 	= $CI->db->query("SELECT * FROM artikel WHERE artikel_ketegori='Page'");
                        foreach ($query->result_array() as $row){
                            ?>
                            <li class="page_item page-item-<?php echo $row['artikel_id'];?>"><a href="<?php echo base_url() ."page?id=". $row['artikel_id'];?>"><?php echo $row['artikel_title'];?></a></li>
                            <?php
                        }
                        ?>
                    </ul></div></div></div>

                    <!--
        <div class="well">
            <h4>Meta</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url("auth")?>">Login</a></li>
                        <li><a href="<?php echo base_url("auth/register")?>">Register</a></li>
                    </ul></div></div></div>-->

        <div class="well">
            <h4>Kategori</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">
                        <?php
                        $query 	= $CI->db->query("SELECT * FROM artikel WHERE artikel_ketegori='Blog' AND `artikel_status`='publish' GROUP BY artikel_topik ORDER BY artikel_topik ASC ");
                        foreach ($query->result_array() as $row){
                            ?>
                            <li class="page_item page-item-<?php echo $row['artikel_topik'];?>"><a href="<?php echo base_url() ."post?topik=". $row['artikel_topik'];?>"><?php echo $row['artikel_topik'];?></a></li>
                            <?php
                        }
                        ?>
                    </ul></div></div></div>

        <div class="well">
            <h4>Arsip</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">

                        <?php

                        $query 	= $CI->db->query("SELECT YEAR(artikel_tanggal) AS `year`,COUNT(artikel_id) AS artikel_jumlah FROM artikel WHERE `artikel_ketegori`='Blog' AND `artikel_status`='publish' GROUP BY YEAR(artikel_tanggal) ORDER BY YEAR(artikel_tanggal) DESC");
                        foreach ($query->result() as $arcresult){
                            $year_now = (int)date("Y");
                            $year_text = (int)$arcresult->year;

                            if ( $year_now == $year_text) {
                                $query2 	= $CI->db->query("SELECT YEAR(artikel_tanggal) AS `year`, MONTH(artikel_tanggal) AS `month`,COUNT(artikel_id) AS artikel_jumlah FROM artikel WHERE YEAR(artikel_tanggal)='$year_text' AND `artikel_ketegori`='Blog' AND `artikel_status`='publish' GROUP BY YEAR(artikel_tanggal), MONTH(artikel_tanggal)  ORDER BY artikel_tanggal DESC");
                                foreach ($query2->result() as $arcresult2) {
                                    $year_text = $arcresult2->year .'-'.$arcresult2->month;
                                    ?>
                                    <li class="page_item page-item-<?php echo $year_text; ?>"><a
                                                href="<?php echo base_url() . "post?archive=" . $year_text; ?>">Arsip <?php echo $year_text. "(".$arcresult2->artikel_jumlah;?>)</a>
                                    </li>
                                    <?php
                                }
                            }else{
                                ?>
                                <li class="page_item page-item-<?php echo $year_text;?>"><a href="<?php echo base_url() ."post?archive=". $year_text;?>">Arsip <?php echo $year_text. "(".$arcresult->artikel_jumlah;?>)</a></li>
                                <?php
                            }


                        }
                        ?>

                    </ul></div></div></div>

    <?php endif;?>


<?php
}



function dynamic_setting($index = "") {
    $CI =& get_instance();
    $CI->load->helpers('url');
    $CI->load->helpers('text');


    $query = $CI->db->query("SELECT * FROM pengaturan WHERE pengaturan_key = '$index'")->result_array();

    return !empty($query[0]['pengaturan_value']) ? $query[0]['pengaturan_value'] : "#";
}
?>

