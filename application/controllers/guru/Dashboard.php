<?php
class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model('Mymodel','m');

        $this->load->helpers('form');
        $this->load->helpers('url');
        $this->load->helpers('text');

        if($this->session->userdata('level') != 'guru'){
            redirect('auth');
        }

        $this->user_id = $this->session->userdata('user_id');
    }


    function index(){
        $data['title'] = 'Dashboard Guru';
        $data['total_artikel'] = 0;//$this->_jumlah_artikel(0);
        $data['total_artikel_today'] = 0;//$this->_jumlah_artikel(1);
        $data['total_artikel_tomorow'] = 0;//$this->_jumlah_artikel(2);

        $this->template->load('template','guru/dashboard',$data);
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
        $totalRec = count($this->listOfQuery($conditions));

        //pagination configuration
        $config['target']      = '#postList0';
        $config['base_url']    = base_url().'guru/dashboard/ajaxPaginationData';
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
        $data['empData'] = $this->listOfQuery($conditions);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->ajax_pagination->create_links();

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    function listOfQuery($params = array()){

        $data = array();
        $this->db->select('YEAR(artikel_tanggal) AS `year`, MONTH(artikel_tanggal) AS `month`,artikel.*');
        $this->db->from('artikel');
        $this->db->where('artikel_ketegori',"Blog");

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('artikel_title',$params['search']['keywords']);
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('artikel_tanggal',$params['search']['sortBy']);
        }else{
            $this->db->order_by('artikel_tanggal','desc');
        }




        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $artikel = $this->db->get();

        foreach ($artikel->result_array() as $row){
            $baris['artikel_id']        = $row['artikel_id'];
            $baris['artikel_title']     = $row['artikel_title'];
            $baris['artikel_title_slug']     = $row['artikel_title_slug'];
            $baris['artikel_konten']    = word_limiter( strip_tags($row['artikel_konten']),30);
            $baris['artikel_ketegori']  = $row['artikel_ketegori'];
            $baris['artikel_topik']     = $row['artikel_topik'];
            $baris['artikel_tags']  	= $row['artikel_tags'];
            $baris['artikel_tanggal']  	= $row['artikel_tanggal'];
            $baris['artikel_author']  	= $row['artikel_author'];
            $baris['artikel_hits']  	= $row['artikel_hits'];
            $baris['artikel_foto']     = $row['artikel_foto'];

            $posted = explode(" ",$row["artikel_tanggal"]);
            $posted = explode("-",$posted[0]);

            $year = sprintf("%04d", $posted[0]);
            $month = sprintf("%02d", $posted[1]);

            $the_thumbnail = base_url('assets/images/64x64.png');
            if( !empty($row['artikel_foto']) && file_exists(FCPATH . 'uploads/posts/' .$year."/".$month."/". $row['artikel_foto']) ) {
                $the_thumbnail = base_url('thumb.php?size=64x64&src=./uploads/posts/' .$year."/".$month."/". $row['artikel_foto']);
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
        $artikel_title		= $this->input->post('artikel_title');
        $artikel_title_slug	= $this->input->post('artikel_title_slug');
        $artikel_konten	    = $this->input->post('artikel_konten');
        $artikel_topik	    = $this->input->post('artikel_topik');
        $artikel_tags	    = $this->input->post('artikel_tags');
        $artikel_tanggal	= $this->input->post('artikel_tanggal');

        $tanggal	= date('Y-m-d H:i:s');

        if(empty($artikel_title))
        {
            $this->query_error("Judul Artikel Kosong");
        }
        else
        {

            $baris = array();
            $baris['artikel_title'] = $artikel_title;
            $baris['artikel_title_slug'] = $artikel_title_slug;
            $baris['artikel_konten'] = $artikel_konten;
            $baris['artikel_topik'] = $artikel_topik;
            $baris['artikel_tags'] = $artikel_tags;
            $baris['artikel_tanggal'] = $artikel_tanggal;

            $foto = $this->artikel_foto($artikel_tanggal,$artikel_title_slug);
            if( !empty($foto) ) $baris['artikel_foto'] = $foto;

            $baris['artikel_ketegori'] = "Blog";
            $baris['artikel_author'] = $this->session->userdata('username');

            if($id > 0){
                $baris['artikel_tanggal_diperbaharui'] = $tanggal;
                $this->db->where('artikel_id', $id);
                $master = $this->db->update('artikel', $baris);
            }else{
                $baris['artikel_tanggal_diperbaharui'] = $artikel_tanggal;
                $baris['artikel_title_slug'] = $this->m->slugify( $artikel_title );
                $master = $this->db->insert('artikel', $baris);
            }

            if($master){
                $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
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
        $level = $this->session->userdata('user_level');
        if($level !== 'admin')
        {
            exit();
        }
        else
        {
            $id = $this->input->post('id');
            $this->db->where('artikel_id',$id);
            $hapus = $this->db->delete('artikel');
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
        $users = $this->db->get_where('artikel', array('artikel_id'=>$id));


        $baris = array();

        foreach ($users->result_array() as $row){
            $baris['artikel_id'] = $row['artikel_id'];
            $baris['artikel_title'] = $row['artikel_title'];
            $baris['artikel_konten'] = $row['artikel_konten'];
            $baris['artikel_topik'] = $row['artikel_topik'];
            $baris['artikel_tags'] = $row['artikel_tags'];
            $baris['artikel_tanggal'] = $row['artikel_tanggal'];
            $baris['artikel_title_slug']     = $row['artikel_title_slug'];
            $baris['artikel_foto']     = $row['artikel_foto'];

            $posted = explode(" ",$row["artikel_tanggal"]);
            $posted = explode("-",$posted[0]);

            $year = sprintf("%04d", $posted[0]);
            $month = sprintf("%02d", $posted[1]);

            $the_thumbnail = base_url('assets/images/350x150.png');
            if( !empty($row['artikel_foto']) && file_exists(FCPATH . 'uploads/posts/' .$year."/".$month."/". $row['artikel_foto']) ) {
                $the_thumbnail = base_url('thumb.php?size=350x150&src=./uploads/posts/' .$year."/".$month."/". $row['artikel_foto']);
            }

            $baris['thumbnail']     = $the_thumbnail;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }



    function data1(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('artikel');
        $this->db->group_by('artikel_topik');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('artikel_topik',$q);
        }

        $this->db->order_by('artikel_topik','asc');
        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();

            $data['label'] = $row->artikel_topik;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    function data2(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('artikel');
        $this->db->group_by('artikel_tags');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('artikel_tags',$q);
        }
        $this->db->order_by('artikel_tags','asc');

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();


            $data['label'] = $row->artikel_tags;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }




    function artikel_foto($tanggal, $id){
        $posted = explode(" ",$tanggal);
        $posted = explode("-",$posted[0]);

        $year = sprintf("%04d", $posted[0]);
        $month = sprintf("%02d", $posted[1]);


        $imageFolder = "uploads/posts/".$year."/".$month;

        if (!file_exists($imageFolder)) {
            mkdir($imageFolder, 0777, true);
        }

        $namafile = $id;

        //reset($_FILES);
        $temp = $_FILES['artikel_foto'];

        if(empty($temp['name'])) return '';
        elseif(is_uploaded_file($temp['tmp_name'])){

            $filetowrite = $imageFolder . '/' . $namafile .'.jpg';

            if (file_exists($filetowrite)) {
                unlink($filetowrite);
            }

            move_uploaded_file($temp['tmp_name'], $filetowrite);

            return $namafile .'.jpg';

        }
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

}
?>