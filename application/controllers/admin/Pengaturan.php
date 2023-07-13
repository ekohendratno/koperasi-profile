<?php
defined('BASEPATH') or exit();

class Pengaturan extends CI_Controller{
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
		$data['title'] = "Pangaturan";
        $data['titles'] = $this->_dynamic_social('Titles');
        $data['description'] = $this->_dynamic_social('Description');
        $data['keywords'] = $this->_dynamic_social('Keywords');
        $data['author'] = $this->_dynamic_social('Author');
        $data["email"] = $this->_dynamic_social("Email");
        $data["telp"] = $this->_dynamic_social("Telp");
        $data["alamat"] = $this->_dynamic_social("Alamat");
        $data["maps"] = $this->_dynamic_social("Maps");
        $data["disqus_url"] = $this->_dynamic_social("DisqusURL");
        $data["social_youtube"] = $this->_dynamic_social("SocialYoutube");
        $data["social_facebook"] = $this->_dynamic_social("SocialFacebook");
        $data["social_instagram"] = $this->_dynamic_social("SocialInstagram");
        $data["social_twitter"] = $this->_dynamic_social("SocialTwitter");
		
        $this->template->load('template','admin/pengaturan',$data);
	}


    function simpandata(){
        $titles = $this->input->post('titles');
        $description = $this->input->post('description');
        $keywords = $this->input->post('keywords');
        $author = $this->input->post('author');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $maps = $this->input->post('maps');
        $disqus_url = $this->input->post('disqus_url');
        $social_youtube = $this->input->post('social_youtube');
        $social_facebook = $this->input->post('social_facebook');
        $social_instagram = $this->input->post('social_instagram');
        $social_twitter = $this->input->post('social_twitter');

        $result['pesan'] = "";
        $this->db->where('pengaturan_key','Titles')->update('pengaturan',array(
            'pengaturan_value'=>$titles,
        ));
        $this->db->where('pengaturan_key','Description')->update('pengaturan',array(
            'pengaturan_value'=>$description,
        ));
        $this->db->where('pengaturan_key','Keywords')->update('pengaturan',array(
            'pengaturan_value'=>$keywords,
        ));
        $this->db->where('pengaturan_key','Author')->update('pengaturan',array(
            'pengaturan_value'=>$author,
        ));
        $this->db->where('pengaturan_key','Alamat')->update('pengaturan',array(
            'pengaturan_value'=>$alamat,
        ));
        $this->db->where('pengaturan_key','Telp')->update('pengaturan',array(
            'pengaturan_value'=>$telp,
        ));
        $this->db->where('pengaturan_key','Email')->update('pengaturan',array(
            'pengaturan_value'=>$email,
        ));
        $this->db->where('pengaturan_key','Maps')->update('pengaturan',array(
            'pengaturan_value'=>$maps,
        ));
        $this->db->where('pengaturan_key','DisqusURL')->update('pengaturan',array(
            'pengaturan_value'=>$disqus_url,
        ));
        $this->db->where('pengaturan_key','SocialYoutube')->update('pengaturan',array(
            'pengaturan_value'=>$social_youtube,
        ));
        $this->db->where('pengaturan_key','SocialFacebook')->update('pengaturan',array(
            'pengaturan_value'=>$social_facebook,
        ));
        $this->db->where('pengaturan_key','SocialInstagram')->update('pengaturan',array(
            'pengaturan_value'=>$social_instagram,
        ));
        $this->db->where('pengaturan_key','SocialTwitter')->update('pengaturan',array(
            'pengaturan_value'=>$social_twitter,
        ));

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }

    function resetdataall(){

        $this->db->truncate('artikel');
        $this->db->truncate('topik');
        $this->db->truncate('komentar');
        $this->db->truncate('siswa');
        $this->db->truncate('guru');
        $this->db->truncate('orangtua');
        $this->db->truncate('pengaturan');
        
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Titles',
            'pengaturan_value' => ''
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Description',
            'pengaturan_value' => ''
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Keywords',
            'pengaturan_value' => ''
        ));
        $this->db->insert('pengaturan',array(
            'pengaturan_key'  => 'Author',
            'pengaturan_value' => ''
        ));


        $result['pesan'] = "";
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }


    function _dynamic_social($index = "") {


        $query = $this->db->query("SELECT * FROM pengaturan WHERE pengaturan_key = '$index'")->result_array();

        return !empty($query[0]['pengaturan_value']) ? $query[0]['pengaturan_value'] : "#";
    }

}
