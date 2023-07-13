<?php
defined('BASEPATH') or exit();

class Mymodel extends CI_Model{
	
	
	function getpengaturan($pengaturan_key){
		$pengaturan = $this->db->get_where('pengaturan',array(
			'pengaturan_key'=>$pengaturan_key
		))->result();

		if(!$pengaturan) return null;

		return $pengaturan[0]->pengaturan_value;
	}
	
	function getdata($tabel){
		return $this->db->get($tabel)->result();
	}
	
	function tambahdata($data,$tabel){
		$this->db->insert($tabel,$data);
	}
	
	function ambilbyid($where,$tabel){
		return $this->db->get_where($tabel,$where);
	}
	
	function simpanbyid($data,$where,$tabel){
		$this->db->where($where);
		$this->db->update($tabel,$data);
	}
	
	function hapusbyid($where,$tabel){
		$this->db->where($where);		
		$this->db->delete($tabel);
	}



    public static function slugify($text, $divider = '-'){
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}

?>