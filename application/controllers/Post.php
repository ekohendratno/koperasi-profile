<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {
	
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

        $have_posts = $this->_have_posts($id);
        $data["have_posts"] = $have_posts;

        if(count($have_posts) > 0){

            if( $id > 0 ){

                $data["disqus_url"] = $this->m->getpengaturan("DisqusURL");

                $this->load->view('themes/single',$data);
            }else{
                $this->load->view('themes/post',$data);
            }

        }else{
            $this->load->view('themes/404',$data);
        }


    }

    private function _have_posts($id){
        $data = array();

        $author = $this->input->get("author");
        $archive = $this->input->get("archive");
        $topik = $this->input->get("topik");
        $cari = $this->input->get("cari");
        $preview = $this->input->get("preview");

        $q1 = "";
        if($id > 0){

            $q1 = $this->db->select("*")->from("artikel")->where("artikel_ketegori","Blog");
            $q1 = $q1->where("artikel_id",$id);

            if(!$preview) $q1 = $q1->where("artikel_status","publish");

            $q1 = $q1->order_by("artikel_tanggal","desc");
            $q1 = $q1->get();

        }elseif(!empty($cari)){

            $q1 = $this->db->select("*")->from("artikel")->where("artikel_ketegori","Blog");

            if(!$preview) $q1 = $q1->where("artikel_status","publish");

            $q1 = $q1->where("`artikel_title` LIKE '%$cari%' OR `artikel_konten` LIKE '%$cari%'");
            $q1 = $q1->order_by("artikel_tanggal","desc");
            $q1 = $q1->get();

        }elseif(!empty($author)){

            $q1 = $this->db->select("*")->from("artikel")->where("artikel_ketegori","Blog");

            if(!$preview) $q1 = $q1->where("artikel_status","publish");

            $q1 = $q1->where("artikel_author",$author);
            $q1 = $q1->order_by("artikel_tanggal","desc");
            $q1 = $q1->get();
        }elseif(!empty($topik)){

            $q1 = $this->db->select("*")->from("artikel")->where("artikel_ketegori","Blog");

            if(!$preview) $q1 = $q1->where("artikel_status","publish");

            $q1 = $q1->where("artikel_topik",$topik);
            $q1 = $q1->order_by("artikel_tanggal","desc");
            $q1 = $q1->get();
        }elseif(!empty($archive)){

            if(!$preview) $query_q1 = " AND  `artikel_status`='publish'";

            if(count(explode('-',$archive)) > 1){
                $date = explode('-',$archive);

                $bulan  = $date[1];
                $tahun 	= $date[0];
                $q1		= $this->db->query("SELECT * FROM `artikel` WHERE `artikel_ketegori`='Blog' $query_q1 AND month(`artikel_tanggal`) = '$bulan' AND year(`artikel_tanggal`) = '$tahun' ORDER BY `artikel_tanggal` DESC");


            }else{
                $q1		= $this->db->query("SELECT * FROM `artikel` WHERE `artikel_ketegori`='Blog' $query_q1 AND year(`artikel_tanggal`) = '$archive' ORDER BY `artikel_tanggal` DESC");


            }
        }else{

            $q1 = $this->db->select("*")->from("artikel")->where("artikel_ketegori","Blog");

            if(!$preview) $q1 = $q1->where("artikel_status","publish");

            $q1 = $q1->order_by("artikel_tanggal","desc");
            $q1 = $q1->get();

        }




        if($q1 != ""){

            foreach ($q1->result() as $item){

                $the_relations = array();

                $the_content = word_limiter( strip_tags($item->artikel_konten),30);
                if($id > 0){
                    $the_content = $item->artikel_konten;

                    $this->db->where("artikel_id",$id);
                    $this->db->update("artikel",array("artikel_hits" =>($item->artikel_hits+1)));
                }

                if(!empty($item->artikel_topik)){
                    $q2 = $this->db->select("*")->from("artikel")->where("artikel_ketegori","Blog");

                    if(!$preview) $q2 = $q2->where("artikel_status","publish");

                    $q2 = $q2->where("artikel_topik",$item->artikel_topik);
                    $q2 = $q2->where("artikel_id !=$id");
                    $q2 = $q2->order_by("artikel_tanggal","desc");
                    $q2 = $q2->limit(3);
                    $q2 = $q2->get();
                    foreach ($q2->result() as $item2){
                        array_push($the_relations,array(
                            "the_title" => $item2->artikel_title,
                            "the_permalink" => base_url() . "post?id=" . $item2->artikel_id,
                            "the_permalink_author" => base_url() . "post?author=" . $item2->artikel_author,
                            "the_author_name" => $item2->artikel_author,
                            "the_posted" => $item2->artikel_tanggal,
                            "the_topik" => $item2->artikel_topik,
                            "the_tags" => $item2->artikel_tags,
                            "the_thumbnail" => $item2->artikel_foto,
                            "the_relations" => $the_relations
                        ));
                    }
                }

                array_push($data,array(
                    "the_title" => $item->artikel_title,
                    "the_permalink" => base_url() . "post?id=" . $item->artikel_id,
                    "the_permalink_author" => base_url() . "post?author=" . $item->artikel_author,
                    "the_author_name" => $item->artikel_author,
                    "the_posted" => $item->artikel_tanggal,
                    "the_content" => $the_content,
                    "the_topik" => $item->artikel_topik,
                    "the_tags" => $item->artikel_tags,
                    "the_thumbnail" => $item->artikel_foto,
                    "the_relations" => $the_relations
                ));

            }
        }

        return $data;

    }

}
