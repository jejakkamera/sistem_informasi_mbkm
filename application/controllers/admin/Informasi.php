<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {

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

	public function index()
	{
		if($this->session->userdata('isLogin')==TRUE){
			$this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->list_ta();

            //print_r($data_master);
            $this->header();
            
            $this->load->view('master/master_list',
                [
                    'data_detail'=>$data_master['data_detail'],
                    'data_isi'=>$data_master['data_isi'],
                ]
            );
            //$this->load->view('baak/mahasiswa_filter');
            $this->footer();
		}else{
			redirect('/welcome/login', 'refresh');
		}
		
    }
    


}
