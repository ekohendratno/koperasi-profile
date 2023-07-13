<?php

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
		
		$this->load->model('Mymodel','m');
        $this->load->library('upload');
		
    }

    function index(){		
		
		$level = $this->session->userdata('level');
		if ( $level == 'admin' ) redirect('admin/dashboard');
        elseif ( $level == 'guru' ) redirect('guru/dashboard');
		else $this->load->view('auth/login');
		
    }
	
	function profile(){		
		
		if(!$this->session->userdata('level')){
			redirect('auth');
		}
		
		$users_data = $this->session->userdata();
		
		$this->load->view('auth/profile',$users_data);
	}
	
	function sandi(){		
		
		if(!$this->session->userdata('user_level')){
			redirect('auth');
		}
		
		$users_data = $this->session->userdata();
		
		$this->load->view('auth/sandi',$users_data);
	}


    function signin(){
        $username = $this->input->get('u');
        $password = $this->input->get('p');

        $response = array();
        $response["response"] = array();
        if(empty($username) || empty($password)){
            $response['redirect'] = 'auth';
            $response['response'] = '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> Username dan Password kosong!</div>';
            $response['success'] = false;
        }else{

            $admin = $this->db->get_where('admin',array('admin_username'=>$username,'admin_password'=>$password))->row_array();

            if ( !empty($admin) ) {

                $userdata = array();
                $userdata['uid']        = $admin['admin_id'];
                $userdata['username']   = $admin['admin_username'];
                $userdata['password']   = $admin['admin_password'];
                $userdata['nama']       = $admin['admin_username'];
                $userdata['foto']       = base_url('thumb.php?size=70x70&src=./assets/images/avatar.png');
                $userdata['level']      = "admin";


                $response['redirect'] = '/admin/dashboard';
                $response['response'] = $userdata;
                $response['success'] = true;

                $this->session->set_userdata($userdata);
            }else{
                $guru = $this->db->get_where('guru',array('guru_username'=>$username,'guru_password'=>$password))->row_array();
                if ( !empty($guru) ) {

                    $userdata = array();
                    $userdata['uid']        = $guru['guru_id'];
                    $userdata['username']   = $guru['guru_username'];
                    $userdata['password']   = $guru['guru_password'];
                    $userdata['nama']       = $guru['guru_nama'];
                    $userdata['foto']       = base_url('thumb.php?size=70x70&src=./assets/images/avatar.png');
                    $userdata['level']      = "guru";

                    $response['redirect'] = '/guru/dashboard';
                    $response['response'] = $userdata;
                    $response['success'] = true;

                    $this->session->set_userdata($userdata);

                }else{
                    $orangtua = $this->db->get_where('orangtua',array('orangtua_nik'=>$username, 'orangtua_password'=>$password))->row_array();
                    if ( !empty($orangtua) ) {

                        $userdata = array();
                        $userdata['uid']        = $orangtua['orangtua_nik'];
                        $userdata['username']   = $orangtua['orangtua_nik'];
                        $userdata['password']   = $orangtua['orangtua_password'];
                        $userdata['nama']       = $orangtua['orangtua_nama'];
                        $userdata['foto']       = base_url('thumb.php?size=70x70&src=./assets/images/avatar.png');
                        $userdata['level']      = "orangtua";

                        $response['redirect'] = '/orangtua/dashboard';
                        $response['response'] = $userdata;
                        $response['success'] = true;

                        $this->session->set_userdata($userdata);

                    }else{
                        $siswa = $this->db->select("*")->from('siswa')
                            ->where('siswa_username',$username)
                            ->where('siswa_password',$password)
                            ->get()->row_array();
                        if ( !empty($siswa) ) {

                            $userdata = array();
                            $userdata['uid']        = $siswa['siswa_username'];
                            $userdata['username']   = $siswa['siswa_username'];
                            $userdata['password']   = $siswa['siswa_password'];
                            $userdata['nama']       = $siswa['siswa_nama'];
                            $userdata['foto']       = base_url('thumb.php?size=70x70&src=./assets/images/avatar.png');
                            $userdata['level']      = "siswa";

                            $response['redirect'] = '/siswa/dashboard';
                            $response['response'] = $userdata;
                            $response['success'] = true;


                            $this->session->set_userdata($userdata);

                        }else{
                            $response['redirect'] = 'auth';
                            $response['response'] = '<div class="alert alert-danger" role="alert"><strong>Maaf!</strong> Username dan Password tidak sesuai!</div>';
                            $response['success'] = false;
                        }
                    }
                }
            }

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);

    }

    function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }


    function do_upload(){
        $config['upload_path'] = './uploads/users/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload
        $config['file_name'] = $this->session->userdata('user_id');
        $config['overwrite'] = true;
        $config['max_size'] = 1024; // 1MB

        $hasil['pesan'] = '';
        $this->upload->initialize($config);
        if(!empty($_FILES['file']['name'])){

            if ($this->upload->do_upload('file')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./uploads/users/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 300;
                $config['height']= 300;
                $config['new_image']= './uploads/users/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar = $gbr['file_name'];
                $this->simpan_upload($gambar);
                $hasil['pesan'] = "Image berhasil diupload";
                $hasil['ok'] = 1;
            }

        }else{
            $hasil['pesan'] = "Image yang diupload kosong";
            $hasil['ok'] = 0;
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($hasil);
    }

    function simpan_upload($image){
        $where = array( 'user_id' => $this->session->userdata('user_id') );
        $data = array( 'user_foto' => $image );

        $users = $this->db->get_where('users',$where)->result();

        unlink('uploads/users/' . $users[0]->user_foto);

        $this->db->where($where);
        $result = $this->db->update('users',$data);
        $this->session->set_userdata(array('user_foto' => $image));

        return $result;
    }
}