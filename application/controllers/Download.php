<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class download extends CI_Controller {
	
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

        $this->load->view('themes/download',$data);
    }

    public function file($id)
    {
        $this->load->helper('download');
        
        $q1 = $this->db->select("*")->from("download")->where('download_id',$id);
        foreach ($q1->get()->result_array() as $row){
            
            $posted = explode("-",$row["download_tanggal"]);

            $year = sprintf("%04d", $posted[0]);
            $month = sprintf("%02d", $posted[1]);

            $the_thumbnail = "";
            if( !empty($row['download_filename']) && file_exists(FCPATH . 'uploads/download/' .$year."/".$month."/". $row['download_filename']) ) {
                $the_thumbnail = FCPATH .'uploads/download/' .$year."/".$month."/". $row['download_filename'];
            }

            force_download( $the_thumbnail  , NULL);
        }

    }



    private function _have_tags($id){
        $data = array();

        $q1 = $this->db->select("*")->from("download")->where("download_tags != ''")->group_by("download_tags")->limit(10);

        if($id > 0){
            $q1 = $q1->where("download_id",$id);
        }

        foreach ($q1->get()->result() as $item){
            array_push($data, array("tag" => $item->download_tags) );
        }

        return $data;

    }


    
      


    private function _have_posts($id){
        $data = array();

        $q1 = $this->db->select("*")->from("download");

        if($id > 0){
            $q1 = $q1->where("download_id",$id);
        }
        $q1 = $q1->order_by("download_id","desc");

        foreach ($q1->get()->result() as $item){

            $the_thumbnail = $item->download_filename;
            if($id > 0){
                $q1 = $q1->where("download_id",$id);
            }

            array_push($data,array(
                "the_id" => $item->download_id,
                "the_title" => $item->download_title,
                "the_permalink" => base_url() . "download/file/" . $item->download_id,
                //"the_permalink_author" => base_url() . "download?author=" . $item->download_author,
                //"the_author_name" => $item->download_author,
                "the_posted" => $item->download_tanggal,
                "the_thumbnail" => $the_thumbnail,
                "the_tags" => $item->download_tags,
            ));

        }

        return $data;

    }

}
