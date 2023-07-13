<?php
class Dashboard extends CI_Controller{
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
        $data['title'] = 'Dashboard Admin';
        $data['jumlah_pengunjung'] = $this->_jumlah_pengunjung();
        $data['jumlah_postingan'] = $this->_jumlah_postingan();
        $data['jumlah_subscriber'] = $this->_jumlah_subscriber();

        $this->template->load('template','admin/dashboard',$data);

        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($data);
    }

    function _jumlah_pengunjung(){
        $tanggal = date("Y-m-d");
        $bataswaktu       = time() - 300;


        //online
        $this->db->select("*");
        $this->db->from("statistik");
        $this->db->where("statistik_tanggal", $tanggal);
        $this->db->where("statistik_online > $bataswaktu");

        $hits1 = 0;
        foreach ($this->db->get()->result() as $item1){
            $hits1 += $item1->statistik_hits;
        }


        //hari ini
        $this->db->select("*");
        $this->db->from("statistik");
        $this->db->where("statistik_tanggal", $tanggal);
        $this->db->group_by("statistik_ip");

        $hits2 = 0;
        foreach ($this->db->get()->result() as $item2){
            $hits2 += $item2->statistik_hits;
        }


        //total
        $this->db->select("*");
        $this->db->from("statistik");

        $hits3 = 0;
        foreach ($this->db->get()->result() as $item3){
            $hits3 += $item3->statistik_hits;
        }

        return $hits1 . "/" .$hits2 . "/" .$hits3;
    }


    function _jumlah_postingan(){
        $tanggal = date("Y-m-d");

        $s = $this->db->query("SELECT COUNT(artikel_tanggal) as jumlah FROM artikel WHERE DATE(artikel_tanggal)='$tanggal'");

        $hits = 0;
        foreach ($s->result() as $item){
            $hits = $item->jumlah;
        }



        $s2 = $this->db->query("SELECT COUNT(artikel_tanggal) as jumlah FROM artikel");

        $hits2 = 0;
        foreach ($s2->result() as $item2){
            $hits2 = $item2->jumlah;
        }

        return $hits . "/" .$hits2;
    }

    function _jumlah_subscriber(){
        return 0;
    }


}
?>