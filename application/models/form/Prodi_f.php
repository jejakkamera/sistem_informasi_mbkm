<?php
class Prodi_f extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
        // $this->db = $this->load->database('default', TRUE);
        // $this->nmdb =$this->db1->database;

    }

    function prodi_update($id){
        $form_detail=array(
            'action'=> base_url('baak/prodi/post_update_prodi/'.$id),
            'form_detail'=>'Udpdate Data prodi',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'nama_program_studi',
                'nama_form'=>'nama program studi',
                'tipe'=>'text',
                'placeholder'=>'nama_program_studi',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'status',
                'nama_form'=>'status',
                'tipe'=>'text',
                'placeholder'=>'status',
                'required'=>'1',
                'readonly'=>'0',
            ],
            // [
            //     'kode_form'=>'nidn',
            //     'nama_form'=>'NIDN',
            //     'tipe'=>'text',
            //     'placeholder'=>'nidn',
            //     'required'=>'0',
            //     'readonly'=>'0',
            // ],
            // [
            //     'kode_form'=>'jabatan_struktural',
            //     'nama_form'=>'Jabatan Struktural',
            //     'tipe'=>'text',
            //     'placeholder'=>'',
            //     'required'=>'0',
            //     'readonly'=>'0',
            // ],
            // [
            //     'kode_form'=>'nama',
            //     'nama_form'=>'nama',
            //     'tipe'=>'select',
            //     'select_data'=>[
            //         ['id'=>'id_dosen','value'=>'nama'],
                    
            //     ],
            //     'placeholder'=>'jenis kelamin',
            //     'required'=>'0',
            //     'readonly'=>'0',
            // ],
            [
                'kode_form'=>'id_dosen',
                'nama_form'=>'dosen',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen'),
                'placeholder'=>'dosen',
                'required'=>'0',
                'readonly'=>'0',
            ],
            // [
            //     'kode_form'=>'jenjang_didik',
            //     'nama_form'=>'jenjang_didik',
            //     'tipe'=>'select2',
            //     'select_data'=>base_url('baak/data_json/json_jenjang_didik'),
            //     'placeholder'=>'id_jenjang_didik',
            //     'required'=>'1',
            //     'readonly'=>'0',
            // ],
            
        );
        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;

    }

    function prodi_password($id){
        $form_detail=array(
            'action'=> base_url('baak/prodi/set_prodi_password_update/'.$id),
            'form_detail'=>'Update Password Prodi',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'password',
                'nama_form'=>'password',
                'tipe'=>'text',
                'placeholder'=>'password',
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
