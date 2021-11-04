<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Magang extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
        $this->load->model('Dosen_model');
		
        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('dosen_magang',$level,$action);
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

    public function list_mahasiswa(){
		$this->load->model('tabel/Dosen_t', 'dosen_tabel');

        $data_master=$this->dosen_tabel->list_mahasiswa_magang();

        
        $this->header();
       
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
		);
		$this->footer();
	}

    public function list_sidang(){
		$this->load->model('tabel/Dosen_t', 'dosen_tabel');

        $data_master=$this->dosen_tabel->list_sidang_magang();

        
        $this->header();
       
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
		);
		$this->footer();
	}

    public function json_list_mahasiswa_magang(){
        $this->load->model('datatable/Dosen_dt', 'Dosen_dt');
        
        header('Content-Type: application/json');
        echo $this->Dosen_dt->json_list_mahasiswa_magang();
    }

  

    public function json_list_jadwal_sidang_magang(){
        $this->load->model('datatable/Dosen_dt', 'Dosen_dt');
        
        header('Content-Type: application/json');
        echo $this->Dosen_dt->json_list_jadwal_sidang_magang();
    }

    public function dashboard_mhs($nim,$periode){
        $data_masters=($this->Master_model->master_get(['periode' => $periode,'nim' => $nim],'v_magang_mhs'));
        if($data_masters){
            $this->load->model('Mahasiswa_model');
            $this->load->model('Baak_model');
            $mahasiswa=($this->Master_model->master_get(['nim' => $nim],'mahasiswa'));

            $jadwal_sidang=($this->Mahasiswa_model->jadwal_sidang_magang($periode,$mahasiswa->kode_prodi));
            $history_bimbingan=$this->Master_model->master_result(['nim'=>$nim],'history_bimbingan_magang');
            $magang_nilai=($this->Master_model->master_result(['id_trx_magang' => $data_masters->id_trx],'magang_nilai'));

            // var_dump($info_akademik);
            // die;
            //print_r($kurikulum[0]);
            $this->header();
            $this->load->view('mahasiswa/magang/dashboard',
                [
                    'data_masters'=>$data_masters,
                    'history_bimbingan'=>$history_bimbingan,
                    'magang_nilai'=>$magang_nilai,
                    'jadwal_sidang'=>$jadwal_sidang
                ]
            );
            $this->footer();
        }else{
            $text = $this->alert->warning('you not registered');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('mahasiswa/magang/'));
        }

    }

    public function upload_nilai_sidang_action($id_trx){
        $config['upload_path']          = './assets/berkas/magang/';
        $config['allowed_types']        = 'pdf';
        $new_name = time().'_'.$id_trx.'_nilai_magang.pdf';
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('berkas'))
        {
            $text = $this->alert->danger('Data failed Added. Info :'.$this->upload->display_errors());
                $this->session->set_flashdata('message', $text);
                return redirect("dosen/magang/upload_nilai_sidang/".$id_trx);
        }
        else
        {
            $magang_mhs_list=$this->Master_model->master_get(['id_trx'=>$id_trx],'magang_mhs_list');
            if(!$magang_mhs_list){
                $text = $this->alert->warning('id trx registration not found');
                $this->session->set_flashdata('message', $text);
                redirect("dosen/magang/list_sidang"); 
            }

            $magang_nilai=$this->Master_model->master_get(['id_trx_magang'=>$id_trx,'email_input'=>$this->session->userdata('username')],'magang_nilai');

            if($magang_nilai){
                $data=array(
                    'berkas'=>$this->upload->data("file_name"),
                    'date'=>date('Y-m-d'),
                );
                $this->Master_model->update_query(['id_trx_magang'=>$id_trx,'email_input'=>$this->session->userdata('username')], $data, 'magang_nilai');

            }else{
                $data=array(
                    'berkas'=>$this->upload->data("file_name"),
                    'id_trx_magang'=>$id_trx,
                    'date'=>date('Y-m-d'),
                    'email_input'=>$this->session->userdata('username'),
                );
                $this->Master_model->insert_query('magang_nilai',$data);
            }

            $text = $this->alert->success('saved successfully');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('dosen/magang/list_sidang'));
        }
    }

    public function upload_nilai_sidang($id_trx){
        $this->header();

        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_magang_mhs');

        $this->load->model('form/Dosen_f', 'dosen_from');
        $data_master=$this->dosen_from->upload_nilai_sidang($id_trx,$data_file);
        
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

    public function add_bimbingan($nim){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');

        $data_master=$this->mahasiswa_form->add_bimbingan_magang($nim);

		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'status'=>null,
            ]
        );
		$this->footer();
    }

    public function add_bimbingan_action($nim){
        $this->form_validation->set_rules('keterangan','keterangan','trim|required|xss_clean');
        if(($this->form_validation->run() == TRUE)){
            $new_name=null;
           
            if(!empty($_FILES['berkas']['name'])){
                $config['upload_path']          = './assets/berkas/history_bimbingan/';
                $config['allowed_types']        = 'pdf';
                $new_name = time().'_'.$nim.'_bimbingan.pdf';
                $config['file_name'] = $new_name;
    
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('berkas'))
                {
                    $text = $this->alert->danger('Data failed Added. Info :'.$this->upload->display_errors());
                        $this->session->set_flashdata('message', $text);
                        return redirect("dosen/magang/add_bimbingan/".$nim);
                }
            }

                if($this->session->userdata('role')=='mhs'){
                    $data=array(
                        'nim'=>$nim,
                        'email_dosen'=>null,
                        'file'=>$new_name,
                        'keterangan'=>$this->input->post('keterangan',TRUE),
                        'user_create'=>$this->Master_model->user_cek_ident(),
                    );
                }else{
                    $data=array(
                        'nim'=>$nim,
                        'email_dosen'=>$this->session->userdata('username'),
                        'file'=>$new_name,
                        'keterangan'=>$this->input->post('keterangan',TRUE),
                        'user_create'=>$this->Master_model->user_cek_ident(),
                    );
                }
                $this->Master_model->insert_query('history_bimbingan_magang',$data);

                $data_masters=($this->Master_model->master_get_max(['nim' => $nim],'magang_mhs_list','periode'));
                $text = $this->alert->success('History Bimbingan add');
                    $this->session->set_flashdata('message', $text);
                    redirect("dosen/magang/dashboard_mhs/".$nim.'/'.$data_masters->periode); 
            

        }else{
            $this->add_bimbingan($nim);
        }
    }

}