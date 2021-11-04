<?php
class Kurikulum_f extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
        // $this->db = $this->load->database('default', TRUE);
        // $this->nmdb =$this->db1->database;

    }

    function kurikulum_update($id){
        $form_detail=array(
            'action'=> base_url('baak/matakuliah/set_update_kurikulum/'.$id),
            'form_detail'=>'Update Data Kurikulum',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'nama_kurikulum',
                'nama_form'=>'Nama Kurikulum',
                'tipe'=>'text',
                'placeholder'=>'nama_kurikulum',
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
