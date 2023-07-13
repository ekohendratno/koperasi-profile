<?php
class Download extends CI_Controller{
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
        $data['title'] = 'Download';
        $data['total_download'] = $this->_jumlah_download(0);
        $data['total_download_today'] = $this->_jumlah_download(1);
        $data['total_download_tomorow'] = $this->_jumlah_download(2);

        $this->template->load('template','admin/download',$data);

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


        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }

        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->cobaQuery($conditions));

        //pagination configuration
        $config['target']      = '#postList0 tbody';
        $config['base_url']    = base_url().'download/ajaxPaginationData';
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
        $this->db->from('download');

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('download_title',$params['search']['keywords']);
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('download_id',$params['search']['sortBy']);
        }else{
            $this->db->order_by('download_id','desc');
        }


        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $download = $this->db->get();

        foreach ($download->result_array() as $row){
            $baris['download_id'] = $row['download_id'];
            $baris['download_tanggal']  	= $row['download_tanggal'];
            $baris['download_title'] = $row['download_title'];
            $baris['download_slug']     = $row['download_title_slug'];
            $baris['download_parent'] = $row['download_parent'];
            $baris['download_order'] = $row['download_order'];
            $baris['download_tags'] = $row['download_tags'];


            $posted = explode("-",$row["download_tanggal"]);

            $year = sprintf("%04d", $posted[0]);
            $month = sprintf("%02d", $posted[1]);

            $the_thumbnail = base_url('assets/images/64x64.png');
            if( !empty($row['download_filename']) && file_exists(FCPATH . 'uploads/download/' .$year."/".$month."/". $row['download_filename']) ) {
                $the_thumbnail = base_url('thumb.php?size=64x64&src=./uploads/download/' .$year."/".$month."/". $row['download_filename']);
            }

            $baris['thumbnail']     = $the_thumbnail;

            array_push($data, $baris);
        }

        return $data;
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }



    public function simpan(){

        $id 	            = $this->input->post('id');
        $download_title		= $this->input->post('download_title');
        $download_title_slug = $this->input->post('download_title_slug');
        $download_parent	    = $this->input->post('download_parent');
        $download_order	    = $this->input->post('download_order');
        $download_tanggal   = $this->input->post('download_tanggal');
        $download_tags   = $this->input->post('download_tags');

        if(empty($download_title))
        {
            $this->query_error("Judul Download Kosong");
        }
        else
        {

            $baris = array();
            $baris['download_title'] = $download_title;
            $baris['download_title_slug'] = $download_title_slug;
            $baris['download_parent'] = $download_parent;
            $baris['download_order'] = $download_order;
            $baris['download_tags'] = $download_tags;


            $file = $this->_download_file($download_tanggal,$download_title_slug);
            if( !empty($file) ) $baris['download_filename'] = $file;

            if($id > 0){

                $this->db->where('download_id', $id);
                $master = $this->db->update('download', $baris);
            }else{
                $baris['download_tanggal'] = $download_tanggal;

                $master = $this->db->insert('download', $baris);
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


            $users = $this->db->get_where('download', array('download_id'=>$id));

            foreach ($users->result_array() as $row) {

                $posted = explode("-", $row["download_tanggal"]);

                $year = sprintf("%04d", $posted[0]);
                $month = sprintf("%02d", $posted[1]);

                if (!empty($row['download_filename']) && file_exists(FCPATH . 'uploads/download/' . $year . "/" . $month . "/" . $row['download_filename'])) {
                    unlink(FCPATH . 'uploads/download/' . $year . "/" . $month . "/" . $row['download_filename']);
                }

            }




            $this->db->where('download_id',$id);
            $hapus = $this->db->delete('download');
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
        $users = $this->db->get_where('download', array('download_id'=>$id));


        $baris = array();

        foreach ($users->result_array() as $row){
            $baris['download_id'] = $row['download_id'];
            $baris['download_tanggal']  	= $row['download_tanggal'];
            $baris['download_title'] = $row['download_title'];
            $baris['download_title_slug'] = $row['download_title_slug'];
            $baris['download_parent'] = $row['download_parent'];
            $baris['download_order'] = $row['download_order'];
            $baris['download_tags'] = $row['download_tags'];
            $baris['download_filename'] = $row['download_filename'];

            $posted = explode("-",$row["download_tanggal"]);

            $year = sprintf("%04d", $posted[0]);
            $month = sprintf("%02d", $posted[1]);

            $the_thumbnail = "";
            if( !empty($row['download_filename']) && file_exists(FCPATH . 'uploads/download/' .$year."/".$month."/". $row['download_filename']) ) {
                $the_thumbnail = base_url('uploads/download/' .$year."/".$month."/". $row['download_filename']);
            }

            $baris['thumbnail']     = $the_thumbnail;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }



    function data2(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('download');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('download_title',$q);
        }

        $this->db->order_by('download_title','asc');
        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();

            $data['label'] = $row->download_title;
            $data['label2'] = $row->download_id;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    function data3(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('download');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('download_tags',$q);
        }

        $this->db->order_by('download_tags','asc');
        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();

            $data['label'] = $row->download_tags;
            $data['label2'] = $row->download_id;


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


    function _download_file($tanggal, $id){
        $posted = explode("-",$tanggal);

        $year = sprintf("%04d", $posted[0]);
        $month = sprintf("%02d", $posted[1]);


        $imageFolderRoot = "uploads/download";
        $imageFolder1 = $imageFolderRoot . "/".$year;
        $imageFolder2 = $imageFolderRoot . "/".$year."/".$month;

        if(!file_exists($imageFolderRoot)){
            if (!mkdir($imageFolderRoot, 0777, true)) {
                die('Failed to create folders...');
            }        
        }

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
        $temp = $_FILES['download_filename'];
        $ext = substr($temp['name'], strrpos($temp['name'], '.') + 1);

        if(empty($temp['name'])) return '';
        elseif(is_uploaded_file($temp['tmp_name'])){

            $filetowrite = $imageFolder2 . '/' . $namafile .'.'. $ext;

            if (file_exists($filetowrite)) {
                unlink($filetowrite);
            }

            move_uploaded_file($temp['tmp_name'], $filetowrite);

            return $namafile .'.'. $ext;

        }

        return $namafile .'.'. $ext;
    }



    function _jumlah_download($today){

        $ikut = $this->db->select('*')->from('download');


        if($today == 1){
            $ikut = $ikut->where("download_tanggal = CURDATE()");
        }elseif($today == 2){
            $ikut = $ikut->where("download_tanggal = CURDATE() - INTERVAL 1 DAY");
        }

        $ikut = $ikut->get();
        return $ikut->num_rows();
    }


    function query_error($text){
        echo json_encode(array('status' => 0, 'pesan' => $text));
    }

}
?>