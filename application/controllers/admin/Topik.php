<?php
class Topik extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helpers('form');
        $this->load->helpers('url');

        if($this->session->userdata('level') != 'admin'){
            redirect('auth');
        }

        $this->uid = $this->session->userdata('uid');
    }


    function index(){
        $data['title'] = 'Semua Siswa';

        $this->template->load('template','admin/topik',$data);

    }



    function _dynamic_menus_data($group_id) {
        $data 	= array();
        $query 	= $this->db->query("SELECT * FROM topik WHERE topik_group = '$group_id' ORDER BY topik_parent, topik_order");

        foreach ($query->result_array() as $row){
            $data[] = $row;
        }

        return $data;
    }

    function _dynamic_menus_label( $row, $numbers ) {
        $label =
            '<div class="ns-row">' .
            '<div class="ns-title">'.$row['topik_title'].'</div>' .
            '<div class="ns-url">'.$row['topik_link'].'</div>' .
            '<div class="ns-class">'.$row['topik_class'].'</div>' .
            '<div class="ns-actions">'.
            '<a data-backdrop="static" data-keyboard="false" href="#formDialog" data-toggle="modal" onClick="formDialog('.$row['topik_id'].')"   class="edit" title="edit">edit</a>' .
            '<a href="javascript:void();" onClick="submitHapus('.$row['topik_id'].')" class="delete" title="delete">delete</a>'.
            '<input type="hidden" name="menu_id" value="'.$row['topik_id'].'">' .
            '</div>' .
            '<div class="ns-orders">';

        $ordering_down = '<a href="javascript:void();" onclick="topicDown('.$row['topik_id'].')" class="down" title="down">⬇</a>';
        $ordering_up = '<a href="javascript:void();" onclick="topicUp('.$row['topik_id'].')" class="up" title="up">⬆</a>';

        if ($row['topik_order'] == 0) $ordering_up = '';
        if ($row['topik_order'] == $numbers) $ordering_down = '';

        $label.= $ordering_up.'  '.$ordering_down .
            '</div>' .
            '</div>';
        return $label;
    }



    public function simpan(){

        $id 	            = $this->input->post('id');
        $topik_title		= $this->input->post('topik_title');
        $topik_link	        = $this->input->post('topik_link');
        $topik_parent	    = $this->input->post('topik_parent');
        $topik_order	    = $this->input->post('topik_order');
        $topik_group	    = $this->input->post('topik_group');
        $topik_class	    = $this->input->post('topik_class');

        if(empty($topik_title))
        {
            $this->query_error("Judul Topik Kosong");
        }
        else
        {
            $baris = array();
            $baris['topik_title'] = $topik_title;
            $baris['topik_link'] = $topik_link;
            $baris['topik_parent'] = $topik_parent;
            $baris['topik_order'] = $topik_order;
            $baris['topik_group'] = $topik_group;
            $baris['topik_class'] = $topik_class;

            if($id > 0){
                $this->db->where('topik_id', $id);
                $master = $this->db->update('topik', $baris);
            }else{
                $master = $this->db->insert('topik', $baris);
            }

            if($master){
                echo json_encode(array('status' => 1, 'pesan' => "Data berhasil disimpan!"));
            }
            else
            {
                $this->query_error();
            }
        }

    }


    public function ambildatabyid(){
        $id = $this->input->post('id');
        $users = $this->db->get_where('topik', array('topik_id'=>$id));


        $baris = array();

        foreach ($users->result_array() as $row){
            $baris['topik_id'] = $row['topik_id'];
            $baris['topik_title'] = $row['topik_title'];
            $baris['topik_link'] = $row['topik_link'];
            $baris['topik_parent'] = $row['topik_parent'];
            $baris['topik_order']     = $row['topik_order'];
            $baris['topik_group']     = $row['topik_group'];
            $baris['topik_class']     = $row['topik_class'];

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($baris);
    }

    function data1(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('artikel');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('artikel_title',$q);
        }

        $this->db->order_by('artikel_title','asc');
        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();

            $data['label'] = $row->artikel_title;
            if($row->artikel_ketegori == "Page"){
                $data['label2'] = "page?id=".$row->artikel_id;
            }else{
                $data['label2'] = "post?id=".$row->artikel_id;
            }


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }


    function data2(){
        $q = $this->input->get('term');

        $this->db->select('*')->from('topik');

        //filter data by searched keywords
        if(!empty($q)){
            $this->db->like('topik_title',$q);
        }

        $this->db->order_by('topik_title','asc');
        //get records
        $query = $this->db->get();

        $items = array();
        foreach($query->result() as $row){
            $data = array();

            $data['label'] = $row->topik_title;
            $data['label2'] = $row->topik_id;


            array_push($items, $data);

        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($items);

    }

    public function hapus()
    {
        $level = $this->session->userdata('level');
        if($level !== 'admin')
        {
            exit();
        }
        else
        {
            $id = $this->input->post('id');
            $this->db->where('topik_id',$id);
            $hapus = $this->db->delete('topik');
            if($hapus)
            {
                echo json_encode(array(
                    "pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>
					"));
            }
            else
            {
                echo json_encode(array(
                    "pesan" => "<font color='red'><i class='fa fa-warning'></i> Terjadi kesalahan, coba lagi !</font>
					"));
            }
        }
    }

    function query_error($text){
        echo json_encode(array('status' => 0, 'pesan' => $text));
    }

}
?>