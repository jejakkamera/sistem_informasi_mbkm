<?php
class Matakuliah_f extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
        // $this->db = $this->load->database('default', TRUE);
        // $this->nmdb =$this->db1->database;

    }

    function matakuliah_update($id){
        $form_detail=array(
            'action'=> base_url('baak/matakuliah/set_update_matakuliah/'.$id),
            'form_detail'=>'Update Data Matakuliah',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'kode_mata_kuliah',
                'nama_form'=>'Kode Matakuliah',
                'tipe'=>'text',
                'placeholder'=>'Kode Matakuliah',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'nama_mata_kuliah',
                'nama_form'=>'Nama Matakuliah',
                'tipe'=>'text',
                'placeholder'=>'Nama Matakuliah',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'nama_mata_kuliah_ing',
                'nama_form'=>'Nama Matakuliah ing',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_matkul_prasyarat',
                'nama_form'=>'id_matkul_prasyarat',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_matkul'),
                'placeholder'=>'id_matkul_prasyarat',
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
