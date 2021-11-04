<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
		$this->url=url_siku;
		$this->key=key_siku;

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('feeder',$level,$action);
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
		$this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->user_list();

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

	public function update_user_action($user)
    {
		$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_status', 'user_status', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ( ($this->form_validation->run() == TRUE)   ) {
				$data_masters=($this->Master_model->master_get(['username'=>$user],'user'));
				if($data_masters->password != $this->input->post('password',TRUE) ){
					$data = array(
						'password' => md5($this->input->post('password',TRUE)),
						'user_status' => $this->input->post('user_status',TRUE),
					);
					$this->Master_model->update_query(['username'=>$user], $data, 'user');
					log_message('info', 'Update - data to user, data :'.$data);

					$text = $this->alert->success('Data successfully update');
					$this->session->set_flashdata('message', $text);
					redirect(site_url('admin/super'));
				}else{
					$data = array(
						'user_status' => $this->input->post('user_status',TRUE),
					);
					$this->Master_model->update_query(['username'=>$user], $data, 'user');
					log_message('info', 'Update - data to user, data :'.$data);

					$text = $this->alert->success('No data edit');
					$this->session->set_flashdata('message', $text);
					redirect(site_url('admin/super'));
				}
			

		}else{
			$this->update_user($user);
		}
	}

	public function update_user($user)
    {
		$this->load->model('form/Feeder_f', 'feeder_form');

        $data_master=$this->feeder_form->update_user($user);
        $data_masters=get_object_vars($this->Master_model->master_get(['username'=>$user],'user'));
		if(!$data_masters){
			$text = $this->alert->danger('User not found');
			$this->session->set_flashdata('message', $text);
			redirect("admin/super");
		}
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

	public function upload_siku_select()
    {
		$this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->upload_siku_select();

		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>null,
                'status'=>null,
            ]
        );
		$this->footer();
	}

	public function upload_alumni_select()
    {
		$this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->upload_alumni_select();

		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>null,
                'status'=>null,
            ]
        );
		$this->footer();
	}

	public function upload_siku_select_action()
    {
		$data_masters=($this->Master_model->master_result(['id_periode_masuk'=>$this->input->post('id_periode',TRUE)],'v_mahasiswa'));
		if($data_masters){
			$data_masters=json_encode($data_masters);
			// print_r($data_masters);die();

			$this->output->set_header('Access-Control-Allow-Origin: *');
			$url =$this->url.'api/post_mahasiswa';
			$data = array('key' => $this->key, 'data_masters' => $data_masters );
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
				)
			);
							
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$data_json=json_decode($result);		
			if($data_json->status_code=='000'){
					$text = $this->alert->success($data_json->messages);
					$this->session->set_flashdata('message', $text);
					redirect('/admin/feeder/mahasiswa','refresh');
			}else{
					$text = $this->alert->danger($data_json->messages);
					$this->session->set_flashdata('message', $text);
					redirect('/admin/feeder/mahasiswa','refresh');
			}
		}else{
			$text = $this->alert->warning('No data');
            $this->session->set_flashdata('message', $text);
            redirect('/admin/feeder/mahasiswa', 'refresh');
		}
	}

	public function upload_alumni_select_action()
    {
		$data_masters=($this->Master_model->master_result(['id_periode_masuk'=>$this->input->post('id_periode',TRUE),'status_mahasiswa'=>'Lulus'],'v_mahasiswa'));
		if($data_masters){
			print_r();
			// $data_masters=json_encode($data_masters);
			// $this->output->set_header('Access-Control-Allow-Origin: *');
			// $url =$this->url_alumni.'api/post_mahasiswa';
			// $data = array('key' => $this->key, 'data_masters' => $data_masters );
			// $options = array(
			// 	'http' => array(
			// 		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			// 		'method'  => 'POST',
			// 		'content' => http_build_query($data)
			// 	)
			// );
							
			// $context  = stream_context_create($options);
			// $result = file_get_contents($url, false, $context);
			// $data_json=json_decode($result);		
			// if($data_json->status_code=='000'){
			// 		$text = $this->alert->success($data_json->messages);
			// 		$this->session->set_flashdata('message', $text);
			// 		redirect('/admin/feeder/mahasiswa','refresh');
			// }else{
			// 		$text = $this->alert->danger($data_json->messages);
			// 		$this->session->set_flashdata('message', $text);
			// 		redirect('/admin/feeder/mahasiswa','refresh');
			// }
		}else{
			$text = $this->alert->warning('No data');
            $this->session->set_flashdata('message', $text);
            redirect('/admin/feeder/mahasiswa', 'refresh');
		}
	}

	public function user_list()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->user_list();
    }
    


}
