<?php
class Gallery extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model('Mymodel','m');
        $this->load->helpers('form');
        $this->load->helpers('url');

        if($this->session->userdata('level') != 'admin'){
            redirect('auth');
        }

        $this->uid = $this->session->userdata('uid');
    }


    function index(){
        $data['title'] = 'Gallery';
        $data['total_gallery'] = $this->_jumlah_gallery(0);
        $data['total_gallery_today'] = $this->_jumlah_gallery(1);
        $data['total_gallery_tomorow'] = $this->_jumlah_gallery(2);

        $this->template->load('template','admin/gallery',$data);

    }




    function ajaxPaginationData(){

        $this->perPage = 10;
        $conditions = array();

        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        $limitBy = $this->input->post('limitBy');
        $typeBy = $this->input->post('typeBy');


        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        if(!empty($typeBy)){
            $conditions['search']['typeBy'] = $typeBy;
        }

        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->cobaQuery($conditions));

        //pagination configuration
        $config['target']      = '#postList0 tbody';
        $config['base_url']    = base_url().'gallery/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';


        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        //get posts data
        $data['empData'] = $this->cobaQuery($conditions);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->ajax_pagination->create_links();

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function cobaQuery($params = array()){

        $data = array();
        $this->db->select('*');
        $this->db->from('gallery');

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('gallery_title',$params['search']['keywords']);
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('gallery_id',$params['search']['sortBy']);
        }else{
            $this->db->order_by('gallery_id','desc');
        }

        if(!empty($params['search']['typeBy'])){
            $this->db->like('gallery_type',$params['search']['typeBy']);
        }


        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $gallery = $this->db->get();

        foreach ($gallery->result_array() as $row){
            $baris['gallery_id'] = $row['gallery_id'];
            $baris['gallery_tanggal']  	= $row['gallery_tanggal'];
            $baris['gallery_title'] = $row['gallery_title'];
            $baris['gallery_slug']     = $row['gallery_title_slug'];
            $baris['gallery_parent'] = $row['gallery_parent'];
            $baris['gallery_order'] = $row['gallery_order'];
            $baris['gallery_tags'] = $row['gallery_tags'];
            $baris['gallery_type'] = $row['gallery_type'];
            $baris['gallery_filename'] = $row['gallery_filename'];


            $posted = explode("-",$row["gallery_tanggal"]);

            $year = sprintf("%04d", $posted[0]);
            $month = sprintf("%02d", $posted[1]);

            $the_thumbnail = base_url('assets/images/64x64.png');
            if( !empty($row['gallery_filename']) && file_exists(FCPATH . 'uploads/gallery/' .$year."/".$month."/". $row['gallery_filename']) ) {
                $the_thumbnail = base_url('thumb.php?size=64x64&src=./uploads/gallery/' .$year."/".$month."/". $row['gallery_filename']);
            }



            $baris['thumbnail']     =  $row['gallery_type'] == "video" ? "https://img.youtube.com/vi/". $row['gallery_filename']."/sddefault.jpg" : $the_thumbnail;

            array_push($data, $baris);
        }

        return $data;
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }



    public function simpan(){

        $id 	            = $this->input->post('id');
        $gallery_title		= $this->input->post('gallery_title');
        $gallery_title_slug = $this->input->post('gallery_title_slug');
        $gallery_parent	    = $this->input->post('gallery_parent');
        $gallery_order	    = $this->input->post('gallery_order');
        $gallery_tanggal   = $this->input->post('gallery_tanggal');
        $gallery_tags   = $this->input->post('gallery_tags');
        $gallery_type   = $this->input->post('gallery_type');

        if(empty($gallery_title))
        {
            $this->query_error("Judul Gallery Kosong");
        }
        else
        {

            $baris = array();
            $baris['gallery_title'] = $gallery_title;
            $baris['gallery_title_slug'] = $gallery_title_slug;
            $baris['gallery_parent'] = $gallery_parent;
            $baris['gallery_order'] = $gallery_order;
            $baris['gallery_tags'] = $gallery_tags;
            $baris['gallery_type'] = $gallery_type;

            if($gallery_type == 'video'){
                $baris['gallery_filename'] = $this->input->post('gallery_filename2');

            }else{


                $foto = $this->_gallery_foto($gallery_tanggal,$gallery_title_slug);
                if( !empty($foto) ) $baris['gallery_filename'] = $foto;

            }

            if($id > 0){

                $this->db->where('gallery_id', $id);
                $master = $this->db->update('gallery', $baris);
            }else{
                $baris['gallery_tanggal'] = $gallery_tanggal;

                $master = $this->db->insert('gallery', $baris);
            }

            if($master){
                echo json_encode(array('status' => 1, 'pesan' => "Data berhasil disimpan!"));
            }
            else
            {
                $this->query_error();
            }
        }

    }

    public function hapus()
    {
        $level = $this->session->userdata('level');
        if($level !== 'admin')
        {
            exit();
        }
        else
        {
            $id = $this->input->post('id');


            $users = $this->db->get_where('gallery', array('gallery_id'=>$id));

            foreach ($users->result_array() as $row) {

                $posted = explode("-", $row["gallery_tanggal"]);

                $year = sprintf("%04d", $posted[0]);
                $month = sprintf("%02d", $posted[1]);

                if (!empty($row['gallery_filename']) && file_exists(FCPATH . 'uploads/gallery/' . $year . "/" . $month . "/" . $row['gallery_filename'])) {
                    unlink(FCPATH . 'uploads/gallery/' . $year . "/" . $month . "/" . $row['gallery_filename']);
                }

            }




            $this->db->where('gallery_id',$id);
            $hapus = $this->db->delete('gallery');
            if($hapus)
            {
                echo json_encode(array(
                    "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>
					"));
            }
            else
            {
                echo json_encode(array(
                    "pesan" => "<font color='red'><i class='fa fa-warning'></i> Terjadi kesalahan, coba lagi !</font>
					"));
            }
        }
    }


    public function ambildatabyid(){
        $id = $this->input->post('id');
        $users = $this->db->get_where('gallery', array('gallery_id'=>$id));


        $baris = array();

        foreach ($users->result_array() as $row){
            $baris['gallery_id'] = $row['gallery_id'];
            $baris['gallery_tanggal']  	= $row['gallery_tanggal'];
            $baris['gallery_title'] = $row['gallery_title'];
            $baris['gallery_title_slug'] = $row['gallery_title_slug'];
            $baris['gallery_parent'] = $row['gallery_parent'];
            $baris['gallery_order'] = $row['gallery_order'];
            $baris['gallery_tags'] = $row['gallery_tags'];
            $baris['gallery_type'] = $row['gallery_type'];
            $baris['gallery_filename'] = $row['gallery_filename'];

            $posted = explode("-",$row["gallery_tanggal"]);

            $year = sprintf("%04d", $posted[0]);
            $month = sprintf("%02d", $posted[1]);

            $the_thumbnail = base_url('assets/images/365x365.png');
            if( !empty($row['gallery_filename']) && file_exists(FCPATH . 'uploads/gallery/' .$year."/".$month."/". $row['gallery_filename']) ) {
                $the_thumbnail = base_url('thumb.php?size=365x365&src=./uploads/gallery/' .$year."/".$month."/". $row['gallery_filename']);
            }

            $baris['thumbnail']     = $the_thumbnail;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }



    function data2(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('gallery');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('gallery_title',$q);
        }

        $this->db->order_by('gallery_title','asc');
        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();

            $data['label'] = $row->gallery_title;
            $data['label2'] = $row->gallery_id;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    function data3(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('gallery');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('gallery_tags',$q);
        }

        $this->db->order_by('gallery_tags','asc');
        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();

            $data['label'] = $row->gallery_tags;
            $data['label2'] = $row->gallery_id;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }


    function slug(){
        $q = $this->input->get('term');

        $data = array();
        $data['success'] = false;
        $data['response'] = "";

        if( !empty($q) ){

            $data['response'] = $this->m->slugify( $q );
            $data['success'] = true;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    function _gallery_foto($tanggal, $id){
        $posted = explode("-",$tanggal);

        $year = sprintf("%04d", $posted[0]);
        $month = sprintf("%02d", $posted[1]);


        $imageFolder1 = "uploads/gallery/".$year;
        $imageFolder2 = "uploads/gallery/".$year."/".$month;

        if(!file_exists($imageFolder1)){
            if (!mkdir($imageFolder1, 0777, true)) {
                die('Failed to create folders...');
            }        
        }

        if(!file_exists($imageFolder2)){
            if (!mkdir($imageFolder2, 0777, true)) {
                die('Failed to create folders...');
            }        
        }

        $namafile = $id;

        //reset($_FILES);
        $temp = $_FILES['gallery_filename'];

        if(empty($temp['name'])) return '';
        elseif(is_uploaded_file($temp['tmp_name'])){

            $filetowrite = $imageFolder2 . '/' . $namafile .'.jpg';

            if (file_exists($filetowrite)) {
                unlink($filetowrite);
            }

            move_uploaded_file($temp['tmp_name'], $filetowrite);

            return $namafile .'.jpg';

        }
    }



    function _jumlah_gallery($today){

        $ikut = $this->db->select('*')->from('gallery');


        if($today == 1){
            $ikut = $ikut->where("gallery_tanggal = CURDATE()");
        }elseif($today == 2){
            $ikut = $ikut->where("gallery_tanggal = CURDATE() - INTERVAL 1 DAY");
        }

        $ikut = $ikut->get();
        return $ikut->num_rows();
    }


    function query_error($text){
        echo json_encode(array('status' => 0, 'pesan' => $text));
    }

}
?>