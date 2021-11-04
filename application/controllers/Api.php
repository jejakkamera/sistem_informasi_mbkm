<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->load->helper('security');
        
    }

    public function get_mahasiswa()
    {
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $key = $this->input->post('key');
        // $periode = $this->input->post('periode');
        $periode = '20201';
        
        $action='get';
        $access = $this->Master_model->cek_key('mahasiswa',$key,$action);
        if($access==0){
            $data=array(
                'status_code'=>'999',
                'messages'=>'You do not have access',
                'data'=>null,
            );
            echo json_encode($data);
            die();
        }
            
            $get_mahasiswa=$this->Master_model->master_result(['id_periode_masuk'=>$periode],'mahasiswa');
            $data=array(
                'status_code'=>'000',
                'messages'=>'Get Data',
                'data'=>$get_mahasiswa,
            );
            echo json_encode($data);
            die();
       
    }

    public function get_krs()
    {
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $key = $this->input->post('key');
        
        
        $action='get';
        $access = $this->Master_model->cek_key('mahasiswa',$key,$action);
        if($access==0){
            $data=array(
                'status_code'=>'999',
                'messages'=>'You do not have access',
                'data'=>null,
            );
            echo json_encode($data);
            die();
        }
        $periode = $this->input->post('periode');
            $this->load->model('Baak_model');
            $krs=$this->Baak_model->get_krs($periode);
            $data=array(
                'status_code'=>'000',
                'messages'=>'Get Data',
                'data'=>$krs,
            );
            echo json_encode($data);
            die();
       
    }

    public function respone_additional()
    {
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $key = $this->input->post('key');
        
        
        $action='get';
        $access = $this->Master_model->cek_key('payment',$key,$action);
        if($access==0){
            $data=array(
                'status_code'=>'999',
                'messages'=>'You do not have access',
                'data'=>null,
            );
            echo json_encode($data);
            die();
        }

            $id_rule = $this->input->post('id_rule');
            $nim = $this->input->post('nim');
            $no_kw = $this->input->post('no_kw');

            $this->Master_model->update_query(['nim'=>$nim,'id_rule'=>$id_rule], 
                    [
                        'no_kwitansi'=>$no_kw,
                        'bayar'=>'sudah',
                        'tanggal_bayar'=>date('Y-m-d H:i:s'),
                    ]
                    , 'wisuda_mhs');
            
            $data=array(
                'status_code'=>'000',
                'messages'=>'Get Data',
                'data'=>null,
            );
            echo json_encode($data);
            die();
       
    }

}