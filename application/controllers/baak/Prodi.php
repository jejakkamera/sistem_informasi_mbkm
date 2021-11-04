<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('baak_mahasiswa',$level,$action);
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

	public function index()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->prodi();

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
		
	}
	
	function update_prodi($id){

		$this->load->model('form/Prodi_f', 'Prodi_form');

        $data_master=$this->Prodi_form->prodi_update($id);
        $data_masters=get_object_vars($this->Master_model->master_get(['id_prodi' => $id],'v_prodi'));

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
    
    public function post_update_prodi($id){
        

        $this->form_validation->set_rules('nama_program_studi','nama_program_studi','xss_clean|required');
        $this->form_validation->set_rules('status','status','xss_clean|required');

        if(($this->form_validation->run() == TRUE)){
            $data = array(
                'nama_program_studi' => $this->input->post('nama_program_studi',TRUE),
                'status' => $this->input->post('status',TRUE),
                'id_dosen' => $this->input->post('id_dosen',TRUE),
            );
            $this->Master_model->update_query(['id_prodi'=>$id], $data, 'dikti_prodi');
            $text = $this->alert->success('Data successfully update');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/prodi/'));
        }
    }

    public function prodi_info($id){
        

        $data = $this->Master_model->master_get(['id_prodi'=>$id],'dikti_prodi');

        if($data2 = $this->Master_model->master_get(['username'=>$data->kode_program_studi],'user')){
            
            $this->load->model('form/prodi_f', 'prodi_form');
                $data_master=$this->prodi_form->prodi_password($id);
                
		        $this->header();
                $this->load->view('master/master_form',
                [
                    'data_detail'=>$data_master['form_detail'],
                    'data_isi'=>$data_master['data_isi'],
                    
                    'status'=>'',
                ]
              );
                $this->footer();

        }else{
            $data = array(
                'username' => $data->kode_program_studi,
                'password' => md5('123123123'),
                'role' => "prodi",
            );
            $this->Master_model->insert_query('user',$data);
            redirect(site_url('baak/dosen/prodi_info/'.$id));
        }
    }


    public function set_prodi_password_update($id){
        $this->form_validation->set_rules('password','password','xss_clean|required');
        if(($this->form_validation->run() == TRUE)){
            $data = array(
                'password' =>md5($this->input->post('password',TRUE)),
            );

        $data2 = $this->Master_model->master_get(['id_prodi'=>$id],'dikti_prodi');
        $this->Master_model->update_query(['username'=>$data2->kode_program_studi], $data, 'user');
        $text = $this->alert->success('Data successfully update');
        $this->session->set_flashdata('message', $text);
        redirect(site_url('baak/prodi/'));
        }else{
            $text = $this->alert->success('Data failed update');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('baak/prodi/'));
        }
    }

}
