<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
        $this->load->model('Baak_model');

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('dosen_baak',$level,$action);
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
        $data_master=$this->baak_tabel->dosen();

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

    public function dosen_update($id)
	{
        $this->load->model('form/Dosen_f', 'dosen_form');

        $data_master=$this->dosen_form->dosen_update($id);
        $data_masters=get_object_vars($this->Master_model->master_get(['id' => $id],'v_dosen'));

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



    public function set_dosen_update($id){
        
        $this->form_validation->set_rules('nip.','nip','xss_clean');
        $this->form_validation->set_rules('nama.','nama','xss_clean');
        $this->form_validation->set_rules('nidn.','nidn','xss_clean');
        $this->form_validation->set_rules('jabatan_struktural.','jabatan_struktural','xss_clean');
        $this->form_validation->set_rules('status_pegawai.','status_pegawai','xss_clean');
        $this->form_validation->set_rules('jenjang_didik.','jenjang_didik','xss_clean');

        if(($this->form_validation->run() == TRUE)){
            $data = array(
                'nip' => $this->input->post('nip',TRUE),
                'nama' =>  $this->input->post('nama',TRUE),
                'nidn' =>  $this->input->post('nidn',TRUE),
                'jabatan_struktural' =>  $this->input->post('jabatan_struktural',TRUE),
                'status_pegawai' =>  $this->input->post('status_pegawai',TRUE),
                'id_jenjang_didik' =>  $this->input->post('jenjang_didik',TRUE),
            );
            $this->Master_model->update_query(['id'=>$id], $data, 'pegawai');

            
            $text = $this->alert->success('success Data Update');
            $this->session->set_flashdata('message', $text);
            redirect("baak//dosen");
        }

    }

    public function set_dosen_update2($id){

        
        $this->form_validation->set_rules('tempat_lahir.','tempat_lahir','xss_clean');
        $this->form_validation->set_rules('tanggal_lahir.','tanggal_lahir','xss_clean');
        $this->form_validation->set_rules('jenis_kelamin.','jenis_kelamin','xss_clean');
        $this->form_validation->set_rules('id_agama','id_agama','xss_clean');
        $this->form_validation->set_rules('npwp.','npwp','xss_clean');
        $this->form_validation->set_rules('no_sk_pengangkatan.','no_sk_pengangkatan','xss_clean');
        $this->form_validation->set_rules('mulai_sk_pengangkatan.','mulai_sk_pengangkatan','xss_clean');
        $this->form_validation->set_rules('alamat.','alamat','xss_clean');
        $this->form_validation->set_rules('kode_pos.','kode_pos','xss_clean');
        $this->form_validation->set_rules('id_wilayah','id_wilayah','xss_clean');
        $this->form_validation->set_rules('telepon.','telepon','xss_clean');
        $this->form_validation->set_rules('status_pernikahan','status_pernikahan','xss_clean');
        $this->form_validation->set_rules('nama_suami_istri.','nama_suami_istri','xss_clean');
        $this->form_validation->set_rules('ktp_suami_istri.','ktp_suami_istri','xss_clean');
        $this->form_validation->set_rules('id_pekerjaan_suami_istri','id_pekerjaan_suami_istri','xss_clean');
        $this->form_validation->set_rules('no_rekening.','no_rekening','xss_clean');
        $this->form_validation->set_rules('handle_kebutuhan_khusus','handle_kebutuhan_khusus','xss_clean');
        $this->form_validation->set_rules('handle_braile','handle_braile','xss_clean');
        $this->form_validation->set_rules('handle_bahasa_isyarat','handle_bahasa_isyarat','xss_clean');
        $this->form_validation->set_rules('ktp.','ktp','xss_clean');
        $this->form_validation->set_rules('tanggal_masuk_kerja.','tanggal_masuk_kerja','xss_clean');
        $this->form_validation->set_rules('kecamatan.','kecamatan','xss_clean');

        $this->form_validation->set_rules('nip.','nip','xss_clean');
        $this->form_validation->set_rules('nama.','nama','xss_clean');
        $this->form_validation->set_rules('nidn.','nidn','xss_clean');
        $this->form_validation->set_rules('jabatan_struktural','jabatan_struktural','xss_clean');
        $this->form_validation->set_rules('id_status_aktif','id_status_aktif','xss_clean');
        $this->form_validation->set_rules('id_sdm','id_sdm','xss_clean');
        $this->form_validation->set_rules('email','email','xss_clean');
        $this->form_validation->set_rules('status_pegawai','status_pegawai','xss_clean');
        $this->form_validation->set_rules('homebase','homebase','xss_clean');

        if(($this->form_validation->run() == TRUE)){
            $data = array(
                'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
                'id_agama' => $this->input->post('id_agama',TRUE),
                'npwp' => $this->input->post('npwp',TRUE),
                'no_sk_pengangkatan' => $this->input->post('no_sk_pengangkatan',TRUE),
                'mulai_sk_pengangkatan' => $this->input->post('mulai_sk_pengangkatan',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'kode_pos' => $this->input->post('kode_pos',TRUE),
                'id_wilayah' => $this->input->post('id_wilayah',TRUE),
                'telepon' => $this->input->post('telepon',TRUE),
                'status_pernikahan' => $this->input->post('status_pernikahan',TRUE),
                'nama_suami_istri' => $this->input->post('nama_suami_istri',TRUE),
                'ktp_suami_istri' => $this->input->post('ktp_suami_istri',TRUE),
                'id_pekerjaan_suami_istri' => $this->input->post('id_pekerjaan_suami_istri',TRUE),
                'no_rekening' => $this->input->post('no_rekening',TRUE),
                'handle_kebutuhan_khusus' => $this->input->post('handle_kebutuhan_khusus',TRUE),
                'handle_braile' => $this->input->post('handle_braile',TRUE),
                'handle_bahasa_isyarat' => $this->input->post('handle_bahasa_isyarat',TRUE),
                'ktp' => $this->input->post('ktp',TRUE),
                'tanggal_masuk_kerja' => $this->input->post('tanggal_masuk_kerja',TRUE),
                'kecamatan' => $this->input->post('kecamatan',TRUE),
                
                'nip' => $this->input->post('nip',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'nidn' => $this->input->post('nidn',TRUE),
                'jabatan_struktural' => $this->input->post('jabatan_struktural',TRUE),
                'id_status_aktif' => $this->input->post('id_status_aktif',TRUE),
                'id_sdm' => $this->input->post('id_sdm',TRUE),
                'email' => $this->input->post('email',TRUE),
                'status_pegawai' => $this->input->post('status_pegawai',TRUE),
                'homebase' => $this->input->post('homebase',TRUE),

            );

            // $this->Master_model->update_query(['nim'=>'20190153102182'], $data, 'mahasiswa_profile');
            // return redirect(base_url("/baak/mahasiswa/profile"));
        }
    }

    public function add_dosen(){
        $this->load->model('form/dosen_f', 'dosen_form');
		$data_master=$this->dosen_form->dosen_add();
		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'status'=>'',
            ]
        );
		$this->footer();
    }

    public function dosen_info($id){
        

        $data = $this->Master_model->master_get(['id'=>$id],'pegawai');
        if($data->email == null){
                $this->load->model('form/dosen_email_f', 'dosen_email_form');
                $data_master=$this->dosen_email_form->dosen_email($id);
                $data_masters=get_object_vars($this->Master_model->master_get(['id' => $id],'v_dosen'));
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
        }else{
            if($data2 = $this->Master_model->master_get(['username'=>trim($data->email)],'user')){
                $this->load->model('form/dosen_f', 'dosen_form');
                $data_master=$this->dosen_form->dosen_password($id,$data->email);
                
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
                    'username' => trim($data->email),
                    'password' => md5('dosenrosma'),
                    'role' => "dosen",
                );
                $this->Master_model->insert_query('user',$data);
                redirect(site_url('baak/dosen/dosen_info/'.$id));
            }
        }
    }

    public function set_dosen_email_update($id){
        $this->form_validation->set_rules('email','email','xss_clean|required');
        if(($this->form_validation->run() == TRUE)){
            $cek=$this->Master_model->master_get(['username'=>trim($this->input->post('email',TRUE))],'user');
            $cek_2=$this->Master_model->master_get(['email'=>trim($this->input->post('email',TRUE))],'pegawai');
            if($cek){
                $text = $this->alert->warning('Email sudah ada di tabel login');
                $this->session->set_flashdata('message', $text);
                redirect(site_url('baak/dosen/dosen_info/'.$id));
            }else{
                $cek_2=$this->Master_model->master_get(['email'=>trim($this->input->post('email',TRUE))],'pegawai');
                if($cek_2){
                    $text = $this->alert->warning('Email sudah digunakan oleh dosen lain');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/dosen/dosen_info/'.$id));
                }else{
                    $data = array(
                        'email' => str_replace("'","",trim($this->input->post('email',TRUE))),
                    );
                    
                    $this->Master_model->update_query(['id'=>$id], $data, 'pegawai');
                    redirect(site_url('baak/dosen/dosen_info/'.$id));
                }
            }
        }
    }


    public function set_dosen_password_update($id){


        $this->form_validation->set_rules('password','password','xss_clean|required');
        if(($this->form_validation->run() == TRUE)){
           
        
            $data = array(
                'password' =>md5($this->input->post('password',TRUE)),
            );
            $data2 = $this->Master_model->master_get(['id'=>$id],'pegawai');
        $this->Master_model->update_query(['username'=>trim($data2->email)], $data, 'user');
        $text = $this->alert->success('success Data Update');
        $this->session->set_flashdata('message', $text);
        redirect(site_url('baak/dosen/'));
        }
    }

    public function add_dosen_action(){
        var_dump($this->input->post());

        $this->form_validation->set_rules('nip','nip','xss_clean');
        $this->form_validation->set_rules('nama','nama','xss_clean|required');
        $this->form_validation->set_rules('nidn','nidn','xss_clean');
        $this->form_validation->set_rules('jabatan_struktural','jabatan_struktural','xss_clean');
        $this->form_validation->set_rules('status_pegawai','status_pegawai','xss_clean');
        $this->form_validation->set_rules('homebase','homebase','xss_clean|required');
        $this->form_validation->set_rules('jenjang_didik','jenjang_didik','xss_clean|required');

        if(($this->form_validation->run() == TRUE)){
            $data = array(
                'nip' => $this->input->post('nip',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'nidn' => $this->input->post('nidn',TRUE),
                'jabatan_struktural' => $this->input->post('namajabatan_struktural_kelas',TRUE),
                'status_pegawai' => $this->input->post('status_pegawai',TRUE),
                'homebase' => $this->input->post('homebase',TRUE),
                'id_jenjang_didik' => $this->input->post('jenjang_didik',TRUE),
            );
            $this->Master_model->insert_query('pegawai',$data);

            $text = $this->alert->success('success add : Dosen');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('baak/dosen/'));

        }else{
            $this->add_dosen();
        }
    }


    public function dosen_hapus($id){

        $this->load->model('form/Dosen_f', 'dosen_form');
        $data2 = $this->Master_model->master_get(['id'=>$id],'pegawai');
        $data_master=$this->dosen_form->dosen_hapus($id,$data2->nama);
        $data_masters=get_object_vars($this->Master_model->master_get(['id' => $id],'v_dosen'));

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


    public function set_dosen_hapus($id){
            $this->Master_model->delete_query(['id' => $id],'pegawai');
            $text = $this->alert->danger('success Hapus Data Dosen');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('baak/dosen/'));
    }






    


}
