<?php
class Siswa extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helpers('form');
        $this->load->helpers('url');

        if($this->session->userdata('level') != 'admin'){
            redirect('auth');
        }

        $this->uid = $this->session->userdata('uid');
    }


    function index(){
        $data['title'] = 'Semua Siswa';

        $this->template->load('template','admin/siswa',$data);

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
        $config['target']      = '#postList tbody';
        $config['base_url']    = base_url().'siswa/ajaxPaginationData';
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
        $this->db->from('siswa');

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('siswa_nama',$params['search']['keywords']);
        }

        $this->db->order_by('siswa_jurusan','asc');
        $this->db->order_by('siswa_kelas','asc');
        $this->db->order_by('siswa_semester','asc');
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('siswa_nama',$params['search']['sortBy']);
        }else{
            $this->db->order_by('siswa_nama','asc');
        }


        if(!empty($params['search']['kelasBy'])){
            $this->db->where('siswa_kelas',$params['search']['kelasBy']);
        }


        if(!empty($params['search']['jurusanBy'])){
            $this->db->where('siswa_jurusan',$params['search']['jurusanBy']);
        }


        if(!empty($params['search']['semesterBy'])){
            $this->db->where('siswa_semester',$params['search']['ruangBy']);
        }


        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $siswa = $this->db->get();

        foreach ($siswa->result_array() as $row){
            $baris['siswa_id'] = $row['siswa_id'];
            $baris['siswa_nis'] = $row['siswa_nis'];
            $baris['siswa_nama'] = $row['siswa_nama'];
            $baris['siswa_jenis_kelamin'] = $row['siswa_jenis_kelamin'];
            $baris['siswa_agama']  	= $row['siswa_agama'];
            $baris['siswa_alamat']  	= $row['siswa_alamat'];

            $baris['siswa_foto'] = base_url('assets/img/avatar.png');
            if( !empty($row['siswa_foto']) && file_exists(FCPATH . 'uploads/siswa/' . $row['siswa_foto']) ) {
                $baris['siswa_foto'] = base_url('thumb.php?size=70x100&src=./uploads/siswa/' . $row['siswa_foto']);
            }

            $baris['siswa_kelas'] = $row['siswa_kelas'];
            $baris['siswa_jurusan'] = $row['siswa_jurusan'];
            $baris['siswa_semester'] = $row['siswa_semester'];

            $baris['siswa_username'] = $row['siswa_username'];
            $baris['siswa_password'] = $row['siswa_password'];

            array_push($data, $baris);
        }

        return $data;
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }



    public function simpan(){

        $id 	= $this->input->post('id');
        $siswa_nama		= $this->input->post('siswa_nama');
        $siswa_jurusan		= $this->input->post('siswa_jurusan');
        $siswa_semester			= $this->input->post('siswa_semester');
        $siswa_username			= $this->input->post('siswa_username');
        $siswa_password			= $this->input->post('siswa_password');
        $siswa_mac			= $this->input->post('siswa_mac');

        if(empty($siswa_nama))
        {
            $this->query_error("Nama Mahasiswa Kosong");
        }
        else
        {
            //insert nota
            $baris = array();

            $baris['siswa_nama'] = $siswa_nama;
            $baris['siswa_jurusan'] = $siswa_jurusan;
            $baris['siswa_semester'] = $siswa_semester;
            $baris['siswa_username'] = $siswa_username;
            $baris['siswa_password'] = $siswa_password;
            $baris['siswa_mac'] = $siswa_mac;

            if($id > 0){
                $this->db->where('siswa_id', $id);
                $master = $this->db->update('siswa', $baris);
            }else{
                $master = $this->db->insert('siswa', $baris);
            }

            if($master){
                echo json_encode(array('status' => 1, 'pesan' => "Barang berhasil disimpan !"));
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
            $this->db->where('siswa_id',$id);
            $hapus = $this->db->delete('siswa');
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
        $users = $this->db->get_where('siswa', array('siswa_id'=>$id));


        $baris = array();

        foreach ($users->result_array() as $row){
            $baris['siswa_id'] = $row['siswa_id'];
            $baris['siswa_nis'] = $row['siswa_nis'];
            $baris['siswa_nama'] = $row['siswa_nama'];
            $baris['siswa_jurusan'] = $row['siswa_jurusan'];
            $baris['siswa_kelas'] = $row['siswa_kelas'];
            $baris['siswa_semester'] = $row['siswa_semester'];
            $baris['siswa_alamat'] = $row['siswa_alamat'];
            $baris['siswa_lahir_tempat'] = $row['siswa_lahir_tempat'];
            $baris['siswa_lahir_tanggal'] = $row['siswa_lahir_tanggal'];
            $baris['siswa_agama'] = $row['siswa_agama'];
            $baris['siswa_jenis_kelamin'] = $row['siswa_jenis_kelamin'];
            $baris['siswa_no_telp'] = $row['siswa_no_telp'];
            $baris['siswa_username'] = $row['siswa_username'];
            $baris['siswa_password'] = $row['siswa_password'];
            $baris['siswa_foto'] = $row['siswa_foto'];
            $baris['orangtua_nik'] = $row['orangtua_nik'];

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }



    function data1(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('siswa');
        $this->db->group_by('siswa_jurusan');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('siswa_jurusan',$q);
        }

        $this->db->order_by('siswa_jurusan','asc');
        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();

            $data['label'] = $row->siswa_jurusan;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    function data2(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('siswa');
        $this->db->group_by('siswa_username');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('siswa_username',$q);
        }
        $this->db->order_by('siswa_username','asc');

        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();


            $data['label'] = $row->siswa_username;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }



    function query_error($text){
        echo json_encode(array('status' => 0, 'pesan' => $text));
    }

}
?>