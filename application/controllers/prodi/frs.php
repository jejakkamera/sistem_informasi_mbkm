<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frs extends CI_Controller {

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
    
    public function list_pengisian_frs_mhs()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_pengisian_frs_mhs();

        //print_r($data_master);
        $this->header();
        
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->list_pengisian_frs_mhs_filter('mhs');
		
		$this->load->view('master/master_filter',
			[
				'data_detail'=>$data_master['form_detail'],
				'data_isi'=>$data_master['data_isi'],
				'data_filter'=>$this->session->userdata('frs_filter')['id_periode_masuk']
				// 'data_master'=>$data_masters,
            ]);
            
		$this->footer();	
    }

    public function list_pengisian_frs_prodi()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_pengisian_frs_prodi();

        //print_r($data_master);
        $this->header();
        
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->list_pengisian_frs_mhs_filter('prodi');
		
		$this->load->view('master/master_filter',
			[
				'data_detail'=>$data_master['form_detail'],
				'data_isi'=>$data_master['data_isi'],
				'data_filter'=>$this->session->userdata('frs_filter')['id_periode_masuk']
				// 'data_master'=>$data_masters,
            ]);
            
		$this->footer();	
    }

    public function list_pengisian_frs_mk()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_pengisian_frs_mk();

        //print_r($data_master);
        $this->header();
        
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->list_pengisian_frs_mhs_filter('mk');
		
		$this->load->view('master/master_filter',
			[
				'data_detail'=>$data_master['form_detail'],
				'data_isi'=>$data_master['data_isi'],
				'data_filter'=>$this->session->userdata('frs_filter')['id_periode_masuk']
				// 'data_master'=>$data_masters,
            ]);
            
		$this->footer();	
    }

    public function filter($link){
		$id_periode_masuk=$this->input->post('id_periode_masuk',TRUE);
		$this->session->set_userdata(
			array(
				'frs_filter' => array(
					'id_periode_masuk'=>$id_periode_masuk,	
				)
			)
        );
        if($link=='mhs'){
            redirect('prodi/frs/list_pengisian_frs_mhs/', 'refresh');
        }else 
        if($link=='mk'){
            redirect('prodi/frs/list_pengisian_frs_mk/', 'refresh');
        }else 
        if($link=='prodi'){
            redirect('prodi/frs/list_pengisian_frs_prodi/', 'refresh');
        }
		
    }
    
}