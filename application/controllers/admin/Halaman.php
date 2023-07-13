<?php
class Halaman extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helpers('form');
        $this->load->helpers('url');
        $this->load->helpers('text');

        $this->load->model('Mymodel','m');

        if($this->session->userdata('level') != 'admin'){
            redirect('auth');
        }

        $this->uid = $this->session->userdata('uid');
    }


    function index(){
        $data['title'] = 'Semua Halaman';
        $data['total_artikel'] = $this->_jumlah_artikel(0);
        $data['total_artikel_today'] = $this->_jumlah_artikel(1);
        $data['total_artikel_tomorow'] = $this->_jumlah_artikel(2);

        $this->template->load('template','admin/halaman',$data);

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
        $statusBy = $this->input->post('statusBy');


        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        if(!empty($statusBy)){
            $conditions['search']['statusBy'] = $statusBy;
        }


        if(!empty($limitBy)){
            $this->perPage = (int) $limitBy;
        }


        //total rows count
        $totalRec = count($this->listOfQuery($conditions));

        //pagination configuration
        $config['target']      = '#postList0';
        $config['base_url']    = base_url().'halaman/ajaxPaginationData';
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
        $this->db->select('*');
        $this->db->from('artikel');
        $this->db->where('artikel_ketegori',"Page");

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('artikel_title',$params['search']['keywords']);
        }

        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('artikel_tanggal_diperbaharui',$params['search']['sortBy']);
        }else{
            $this->db->order_by('artikel_tanggal_diperbaharui','desc');
        }



        if(!empty($params['search']['statusBy'])){

            $this->db->like('artikel_status',$params['search']['statusBy']);
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
            $baris['artikel_konten']    = word_limiter( strip_tags($row['artikel_konten']),30);
            $baris['artikel_ketegori']  = $row['artikel_ketegori'];
            $baris['artikel_topik']     = $row['artikel_topik'];
            $baris['artikel_tags']  	= $row['artikel_tags'];
            $baris['artikel_tanggal']  	= $row['artikel_tanggal'];
            $baris['artikel_author']  	= $row['artikel_author'];
            $baris['artikel_hits']  	= $row['artikel_hits'];
            $baris['artikel_status']  	= $row['artikel_status'];

            $baris['artikel_foto'] = base_url('assets/img/avatar.png');
            if( !empty($row['artikel_foto']) && file_exists(FCPATH . 'uploads/artikel/' . $row['artikel_foto']) ) {
                $baris['artikel_foto'] = base_url('thumb.php?size=70x100&src=./uploads/artikel/' . $row['artikel_foto']);
            }


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
        $artikel_status	    = $this->input->post('artikel_status');

        $tanggal	= date('Y-m-d H:i:s');

        if(empty($artikel_title))
        {
            $this->query_error("Judul Halaman Kosong");
        }
        else
        {
            $baris = array();
            $baris['artikel_title'] = $artikel_title;
            $baris['artikel_title_slug'] = $artikel_title_slug;
            $baris['artikel_konten'] = $artikel_konten;
            $baris['artikel_tanggal'] = $tanggal;
            $baris['artikel_ketegori'] = "Page";
            $baris['artikel_author'] = $this->session->userdata('username');
            $baris['artikel_status'] = $artikel_status;

            if($id > 0){
                $baris['artikel_tanggal_diperbaharui'] = $tanggal;
                $this->db->where('artikel_id', $id);
                $master = $this->db->update('artikel', $baris);
            }else{
                $baris['artikel_tanggal_diperbaharui'] = $tanggal;
                $baris['artikel_title_slug'] = $this->m->slugify( $artikel_title );
                $baris['artikel_tanggal'] = $tanggal;
                $master = $this->db->insert('artikel', $baris);
                $id = $this->db->insert_id();
            }

            if($master){
                $this->output->set_header('Content-Type: application/json; charset=utf-8,Access-Control-Allow-Origin: *');
                echo json_encode(array('id' => $id,'status' => 1, 'pesan' => "Data berhasil disimpan!"));
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


            $id = $this->input->post('id');
            $artikel = $this->db->get_where('artikel', array('artikel_id'=>$id));

            $status = "";
            foreach ($artikel->result_array() as $row){
                $status = $row['artikel_status'];
            }

            if($status != "trash"){

                $this->db->where('artikel_id', $id);
                $update = $this->db->update('artikel', array('artikel_status' => "trash"));
                if($update)
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

            }else{


                $this->db->where('artikel_id',$id);
                $hapus = $this->db->delete('artikel');
                if($hapus)
                {
                    echo json_encode(array(
                        "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus selamanya!</font>
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
            $baris['artikel_title_slug']     = $row['artikel_title_slug'];
            $baris['artikel_status']  	= $row['artikel_status'];

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }



    function data1(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('topik');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('topik_title',$q);
        }

        $this->db->order_by('topik_title','asc');
        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();

            $data['label'] = $row->topik_title;
            $data['label_slug'] = $row->topik_title_slug;


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

    function _jumlah_artikel($today){

        $ikut = $this->db->select('*')->from('artikel')->where("artikel_ketegori","Page");


        if($today == 1){
            $ikut = $ikut->where("artikel_tanggal = CURDATE()");
        }elseif($today == 2){
            $ikut = $ikut->where("artikel_tanggal = CURDATE() - INTERVAL 1 DAY");
        }

        $ikut = $ikut->get();
        return $ikut->num_rows();
    }

    function query_error($text){
        echo json_encode(array('status' => 0, 'pesan' => $text));
    }
}
?>