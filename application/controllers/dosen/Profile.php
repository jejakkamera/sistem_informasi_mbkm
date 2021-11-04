<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
		$this->load->model('Baak_model');
		$this->load->model('Dosen_model');

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('dosen_perkuliahan',$level,$action);
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

	 public function set_dosen_update()
	{
        $email=$this->session->userdata('username');
        $this->form_validation->set_rules('nama','nama','xss_clean');
        $this->form_validation->set_rules('nidn','nidn','xss_clean');
        $this->form_validation->set_rules('jenjang_didik','jenjang_didik','xss_clean');
        $this->form_validation->set_rules('password','password','xss_clean|required');

        if(($this->form_validation->run() == TRUE)){

            $data = array(
                'nama' =>  $this->input->post('nama',TRUE),
                'nidn' =>  $this->input->post('nidn',TRUE),
                'id_jenjang_didik' =>  $this->input->post('jenjang_didik',TRUE),
            );
            $this->Master_model->update_query(['email'=>$email], $data, 'pegawai');

            $data_p = array(
                'password' =>md5($this->input->post('password',TRUE)),
            );

            $data2 = $this->Master_model->master_get(['username'=>trim($email)],'user');
            if($data2->password != $this->input->post('password',TRUE) ){
                $this->Master_model->update_query(['username'=>trim($email)], $data_p, 'user');
            }            

            $text = $this->alert->success('success Data Update');
            $this->session->set_flashdata('message', $text);
            redirect("dosen/profile/dosen_update");
        }else{
            $this->dosen_update();
        }

    }
    

	 public function dosen_update()
	{
        $email=$this->session->userdata('username');
        $this->load->model('form/Dosen_f', 'dosen_form');

        $data_master=$this->dosen_form->dosen_profile($email);
        $data_masters=get_object_vars($this->Master_model->master_get(['email' => $email],'v_dosen'));

		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>$data_masters,
                'status'=>'update',
            ]
        );
		$this->footer();
		
    }

}