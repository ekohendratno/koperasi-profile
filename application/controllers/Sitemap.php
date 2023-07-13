<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {
	
	function __construct(){
		parent::__construct();

        $this->load->model('Mymodel','m');
		$this->load->helpers('form');
		$this->load->helpers('url');
        $this->load->helpers('text');
		
	}
	
	public function index(){
        $this->output->set_header('Content-type: application/xml; charset="ISO-8859-1"',true);
        ?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            <url>
                <loc><?php echo base_url();?></loc>
                <lastmod><?php echo date('d-m-Y H:i:s') ?></lastmod>
                <changefreq>daily</changefreq>
                <priority>0.1</priority>
            </url>
        <?php foreach( $this->_have_posts() as $the_post):?>
                <url>
                    <loc><?php echo $the_post["the_permalink"];?></loc>
                    <lastmod><?php echo $the_post["the_posted"];?></lastmod>
                    <changefreq>daily</changefreq>
                    <priority>0.1</priority>
                </url>
        <?php endforeach;?>
        </urlset>
        <?php

    }

	private function _have_posts(){
	    $data = array();

        $q1 = $this->db->select("*")->from("artikel");
        $q1 = $q1->order_by("artikel_tanggal","desc");
        $q1 = $q1->limit(50);
	    foreach ($q1->get()->result() as $item){

            $the_permalink = base_url() . "post?id=" . $item->artikel_id;
            if($item->artikel_ketegori == "Page"){
                $the_permalink = base_url() . "page?id=" . $item->artikel_id;
            }

            array_push($data,array(
                "the_title" => $item->artikel_title,
                "the_permalink" => $the_permalink,
                "the_permalink_author" => base_url() . "post?author=" . $item->artikel_author,
                "the_author_name" => $item->artikel_author,
                "the_posted" => $item->artikel_tanggal,
                "the_content" => word_limiter( strip_tags($item->artikel_konten),30),
                "the_tags" => $item->artikel_tags,
                "the_thumbnail" => $item->artikel_foto
            ));

        }

	    return $data;

    }

}
