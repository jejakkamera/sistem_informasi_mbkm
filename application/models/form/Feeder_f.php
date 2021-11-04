<?php
class Feeder_f extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
        // $this->db = $this->load->database('default', TRUE);
        // $this->nmdb =$this->db1->database;

    }

    function set_periode()
    {
        $form_detail=array(
            'action'=> base_url('admin/feeder/set_periode_action'),
            'form_detail'=>'Set Periode. Periode set : '.$this->session->userdata('set_periode')['periode'],
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode/'),
                'placeholder'=>'Periode',
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
    
    function connector()
    {
        $form_detail=array(
            'action'=> base_url('admin/feeder/connector_update'),
            'form_detail'=>'Feeder Connector check',
            'add_action'=>'Get Token',
            'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'kode_pt',
                'nama_form'=>'Kode PT',
                'tipe'=>'text',
                'placeholder'=>'Kode PT',
                'required'=>'1',
                'readonly'=>'1',
            ],
            [
                'kode_form'=>'nm_lemb',
                'nama_form'=>'Nama PT',
                'tipe'=>'text',
                'placeholder'=>'Nama PT',
                'required'=>'0',
                'readonly'=>'1',
            ],
            [
                'kode_form'=>'username',
                'nama_form'=>'Username',
                'tipe'=>'text',
                'placeholder'=>'Username',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'password',
                'nama_form'=>'Password',
                'tipe'=>'text',
                'placeholder'=>'Password',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'url',
                'nama_form'=>'Url',
                'tipe'=>'text',
                'placeholder'=>'Url',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'port',
                'nama_form'=>'Port',
                'tipe'=>'text',
                'placeholder'=>'port',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'live',
                'nama_form'=>'Live',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'live','value'=>'live'],
                    ['id'=>'sanbox','value'=>'sanbox'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'status_connected',
                'nama_form'=>'status connected',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'n','value'=>'Not Connected'],
                    ['id'=>'y','value'=>'Connected'],
                ],
                'placeholder'=>'status_connected',
                'required'=>'0',
                'readonly'=>'1',
            ],
            [
                'kode_form'=>'token',
                'nama_form'=>'Token',
                'tipe'=>'text',
                'placeholder'=>'Token',
                'required'=>'0',
                'readonly'=>'1',
            ],
            [
                'kode_form'=>'last_connection',
                'nama_form'=>'Last Connection',
                'tipe'=>'text',
                'placeholder'=>'Last Conection',
                'required'=>'0',
                'readonly'=>'1',
            ],
            [
                'kode_form'=>'info_conection',
                'nama_form'=>'Info Connection',
                'tipe'=>'text',
                'placeholder'=>'Info Conection',
                'required'=>'0',
                'readonly'=>'1',
            ],
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }


    function update_user($user)
    {
        $form_detail=array(
            'action'=> base_url('admin/super/update_user_action/'.$user),
            'form_detail'=>'User Login',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'username',
                'nama_form'=>'User Name',
                'tipe'=>'text',
                'placeholder'=>'Kode PT',
                'required'=>'1',
                'readonly'=>'1',
            ],
            [
                'kode_form'=>'password',
                'nama_form'=>'Password',
                'tipe'=>'password',
                'placeholder'=>'Nama PT',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
            [
                'kode_form'=>'user_status',
                'nama_form'=>'Stuatus User',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'aktif','value'=>'aktif'],
                    ['id'=>'tidak aktif','value'=>'tidak aktif'],
                ],
                'placeholder'=>'live',
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
