<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Mymodel', 'm');
        $this->load->helpers('form');
        $this->load->helpers('url');
        $this->load->helpers('text');

    }

    public function index()
    {
        $data = array();

        $data["title"] = $this->m->getpengaturan("Titles");
        $data["desc"] = $this->m->getpengaturan("Description");
        $data["maps"] = $this->m->getpengaturan("Maps");

        $data["have_posts"] = $this->_have_posts();
        $this->load->view('themes/index', $data);
    }

    public function sendmail()
    {
        $data = array();
        $data['success'] = false;

        $this->load->library('email');

        $this->email->from( $this->input->post('from') , $this->input->post('name'));
        $this->email->to(  $this->m->getpengaturan("Email") );

        $this->email->subject( "Email Kontak Pelanggan "  . $this->input->post('subject') );
        $this->email->message( $this->input->post('message') );

        if( $this->email->send() ){
            $data['success'] = true;
            $data['response'] = "Pesan berhasil dikirim!";

        }
        

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    private function _have_posts()
    {
        $data = array();

        $q1 = $this->db->select("*")->from("artikel")->where("artikel_ketegori", "Blog")->where("artikel_status", "publish");
        $q1 = $q1->order_by("artikel_tanggal", "desc");
        $q1 = $q1->limit(3);
        foreach ($q1->get()->result() as $item) {

            array_push($data, array(
                "the_title" => $item->artikel_title,
                "the_permalink" => base_url() . "post?id=" . $item->artikel_id,
                "the_permalink_author" => base_url() . "post?author=" . $item->artikel_author,
                "the_author_name" => $item->artikel_author,
                "the_posted" => $item->artikel_tanggal,
                "the_content" => word_limiter(strip_tags($item->artikel_konten), 30),
                "the_tags" => $item->artikel_tags,
                "the_thumbnail" => $item->artikel_foto
            ));
        }

        return $data;
    }
}
