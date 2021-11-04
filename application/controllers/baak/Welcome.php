<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
			redirect('/welcome/dashboard', 'refresh');
		}else{
			redirect('/welcome/login', 'refresh');
		}
		
	}

	public function login()
	{
		if($this->session->userdata('isLogin')==TRUE){
			redirect('/welcome/dashboard', 'refresh');
		}else{
			$this->load->view('login');
			$this->footer();
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('','refresh');
	}

	public function login_proses()
	{
		$id = $this->input->post("uname_id",TRUE);
		$pass = $this->input->post("pass",TRUE);
		
        $this->form_validation->set_rules('uname_id', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $kembali='Pastikan Username Dan Password di Isi Dengan Benar';
            $data=array(
                'text'=>$kembali,
                'kode'=>0,
            );
			echo json_encode($data);
			
        } else {

			$this->load->model('m_login');
			$pass=md5($pass);
			$cek = $this->m_login->cek_user($id,$pass);

			if(count($cek) == 1){ //cek data berdasarkan username & pass

				foreach ($cek as $cek) {
					$username = $cek['username'];
					$password = $cek['password'];
					$role = $cek['role'];
					$user_status = $cek['user_status'];
					//mengambil data(level/hak akses) dari database
				}

				$this->session->set_userdata(array(
					'isLogin'   => TRUE, 
					'username'  => $username, 
					'role'      => $role,
					'user_status'      => $user_status,
					//set session hak akses
				));
			
				$kembali='Selamat Datang '.$username;
				$data=array(
					'text'=>$kembali,
					'kode'=>1,
				);
				echo json_encode($data);

			}else {
				
				$kembali=' Username Dan Password Tidak Ditemukan / Belum aktif';
				$data=array(
					'text'=>$kembali,
					'kode'=>0,
				);
				echo json_encode($data);
			}

        }
	}

	public function dashboard()
	{
		$this->header();
		$this->load->view('dashboard');
		$this->footer();
	}

	public function profile(){
		$this->header();
		$this->load->view('mahasiswa/profile');
		$this->footer();
	}

}
