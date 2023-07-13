<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
	
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


        $data["have_tags"] = $this->_have_tags($id);
        $data["have_posts"] = $this->_have_posts($id);

        $this->load->view('themes/gallery',$data);
    }



    private function _have_tags($id){
        $data = array();

        $q1 = $this->db->select("*")->from("gallery")->where("gallery_tags != ''")->group_by("gallery_tags")->limit(10);

        if($id > 0){
            $q1 = $q1->where("gallery_id",$id);
        }

        foreach ($q1->get()->result() as $item){
            array_push($data, array("tag" => $item->gallery_tags) );
        }

        return $data;

    }



    private function _have_posts($id){
        $data = array();

        $q1 = $this->db->select("*")->from("gallery");

        if($id > 0){
            $q1 = $q1->where("gallery_id",$id);
        }
        $q1 = $q1->order_by("gallery_id","desc");

        foreach ($q1->get()->result() as $item){

            $the_thumbnail = $item->gallery_filename;
            if($id > 0){
                $q1 = $q1->where("gallery_id",$id);
            }

            array_push($data,array(
                "the_id" => $item->gallery_id,
                "the_title" => $item->gallery_title,
                "the_permalink" => base_url() . "gallery?id=" . $item->gallery_id,
                //"the_permalink_author" => base_url() . "gallery?author=" . $item->gallery_author,
                //"the_author_name" => $item->gallery_author,
                "the_posted" => $item->gallery_tanggal,
                "the_thumbnail" => $item->gallery_type == "video" ? "https://img.youtube.com/vi/".$item->gallery_filename."/maxresdefault.jpg" : $the_thumbnail,
                "the_tags" => $item->gallery_tags,
                "the_type" => $item->gallery_type,
                "the_filename" => $item->gallery_filename,
            ));

        }

        return $data;

    }

}
