<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	
	function __construct(){
		parent::__construct();	
		
		$this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');
        $this->load->helpers('text');

		
	}

    public function index(){
        $data = array();
        $id = $this->input->get("id");

        if( empty($id) ) $id = 0;


        $data["have_posts"] = $this->_have_posts($id);

        $this->load->view('themes/page',$data);
    }



    private function _have_posts($id){
        $data = array();

        $q1 = $this->db->select("*")->from("artikel")->where("artikel_ketegori","Page");

        if($id > 0){
            $q1 = $q1->where("artikel_id",$id);
        }

        foreach ($q1->get()->result() as $item){

            $the_content = word_limiter( strip_tags($item->artikel_konten),30);
            if($id > 0){
                $q1 = $q1->where("artikel_id",$id);
                $the_content = $item->artikel_konten;
            }

            array_push($data,array(
                "the_title" => $item->artikel_title,
                "the_permalink" => base_url() . "page?id=" . $item->artikel_id,
                "the_permalink_author" => base_url() . "page?author=" . $item->artikel_author,
                "the_author_name" => $item->artikel_author,
                "the_posted" => $item->artikel_tanggal,
                "the_content" => $the_content,
                "the_tags" => $item->artikel_tags,
            ));

        }

        return $data;

    }

}
