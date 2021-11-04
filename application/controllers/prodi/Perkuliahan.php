<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perkuliahan extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
        $this->load->model('Baak_model');

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('frs_prodi',$level,$action);
        if($access==0){
            $text = $this->alert->danger('You do not have access');
			$this->session->set_flashdata('message', $text);
			redirect("welcome/dashboard");
		}
    }

    public function header(){
		if($this->session->userdata('isLogin')==TRUE){
			$this->load->view('master/header');
		}else{
			redirect('/welcome/login', 'refresh');
		}
		
	}

	public function footer(){
			$this->load->view('master/footer');
    }

    public function frs(){
		$this->load->model('tabel/Dosen_t', 'dosen_tabel');
		$periode=$this->Baak_model->json_id_periode_aktif('');
        $data_master=$this->dosen_tabel->frs($periode);

        //print_r($data_master);
        $this->header();
       
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
		);
		$this->footer();
	}

}