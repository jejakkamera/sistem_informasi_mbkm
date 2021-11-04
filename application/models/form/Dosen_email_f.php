<?php
class Dosen_email_f extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
        // $this->db = $this->load->database('default', TRUE);
        // $this->nmdb =$this->db1->database;

    }
    
    function dosen_email($id){
        $form_detail=array(
            'action'=> base_url('baak/dosen/set_dosen_email_update/'.$id),
            'form_detail'=>'Udpdate Data dosen',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'email',
                'nama_form'=>'email',
                'tipe'=>'text',
                'placeholder'=>'email',
                'required'=>'1',
                'readonly'=>'0',
            ],

        );
        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;

    }
}
