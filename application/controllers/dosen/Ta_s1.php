<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ta_s1 extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
        $this->load->model('Dosen_model');
		
        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('dosen_ta',$level,$action);
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

        $data_master=$this->dosen_tabel->list_mahasiswa_ta_s1();

        
        $this->header();
       
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
		);
		$this->footer();
	}

    public function json_list_mahasiswa_ta_s1(){
        $this->load->model('datatable/Dosen_dt', 'Dosen_dt');
        
        header('Content-Type: application/json');
        echo $this->Dosen_dt->json_list_mahasiswa_ta_s1();
    }

   

    public function dashboard_mhs($nim,$periode){
        $data_masters=($this->Master_model->master_get(['periode' => $periode,'nim' => $nim],'v_ta_s1_mhs_list'));
        if($data_masters){
           
            $this->load->model('Baak_model');
            $this->load->model('Mahasiswa_model');

            $jadwal_sidang=($this->Mahasiswa_model->jadwal_sidang_ta_s1($periode,$data_masters->kode_prodi));
            $history_sidang=$this->Master_model->master_result(['periode'=>$periode,'nim'=>$nim],'v_ta_s1_mhs_sidang');
            $history_bimbingan=$this->Master_model->master_result(['nim'=>$nim],'history_bimbingan');
            // var_dump($info_akademik);
            // die;
            //print_r($kurikulum[0]);
            $this->header();
            $this->load->view('mahasiswa/ta_s1/dashboard',
                [
                    'data_masters'=>$data_masters,
                    'jadwal_sidang'=>$jadwal_sidang,
                    'history_bimbingan'=>$history_bimbingan,
                    'history_sidang'=>$history_sidang
                ]
            );
            $this->footer();
        }else{
            $text = $this->alert->warning('you not registered');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('mahasiswa/ta_s1/'));
        }
    }

    public function list_sidang(){
		$this->load->model('tabel/Dosen_t', 'dosen_tabel');

        $data_master=$this->dosen_tabel->list_sidang_ta_s1();

        
        $this->header();
       
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
		);
		$this->footer();
	}

    public function json_list_jadwal_sidang_ta_s1(){
        $this->load->model('datatable/Dosen_dt', 'Dosen_dt');
        
        header('Content-Type: application/json');
        echo $this->Dosen_dt->json_list_jadwal_sidang_ta_s1();
    }

    public function upload_nilai_ta_s1($id_trx){
        $this->header();

        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_ta_s1_mhs_sidang');

        $this->load->model('form/Dosen_f', 'dosen_from');
        $data_master=$this->dosen_from->upload_nilai_ta_s1($id_trx,$data_file);
        
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

    public function upload_nilai_ta_s1_action($id_trx){
        $config['upload_path']          = './assets/berkas/ta/';
        $config['allowed_types']        = 'pdf';
        $new_name = time().'_'.$id_trx.'_nilai_ta.pdf';
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('berkas'))
        {
            $text = $this->alert->danger('Data failed Added. Info :'.$this->upload->display_errors());
                $this->session->set_flashdata('message', $text);
                return redirect("dosen/ta_s1/upload_nilai_ta_s1/".$id_trx);
        }
        else
        {
            $magang_mhs_list=$this->Master_model->master_get(['id_trx'=>$id_trx],'v_ta_s1_mhs_sidang');
            if(!$magang_mhs_list){
                $text = $this->alert->warning('id trx registration not found');
                $this->session->set_flashdata('message', $text);
                redirect("dosen/ta_s1/list_sidang"); 
            }

            $magang_nilai=$this->Master_model->master_get(['id_trx_sidang'=>$id_trx,'email_penginput'=>$this->session->userdata('username')],'ta_s1_nilai');

            if($magang_nilai){
                $data=array(
                    'berkas'=>$this->upload->data("file_name"),
                );
                $this->Master_model->update_query(['id_trx_sidang'=>$id_trx,'email_penginput'=>$this->session->userdata('username')], $data, 'ta_s1_nilai');

            }else{
                $data=array(
                    'berkas'=>$this->upload->data("file_name"),
                    'id_trx_sidang'=>$id_trx,
                    'date'=>date('Y-m-d'),
                    'email_penginput'=>$this->session->userdata('username'),
                );
                $this->Master_model->insert_query('ta_s1_nilai',$data);
            }

            $text = $this->alert->success('saved successfully');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('dosen/ta_s1/list_sidang'));
        }
    }

    public function add_bimbingan($nim){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');

        $data_master=$this->mahasiswa_form->add_bimbingan_s1($nim);

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
                $new_name = time().'_'.$this->session->userdata('username').'_bimbingan.pdf';
                $config['file_name'] = $new_name;
    
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('berkas'))
                {
                    $text = $this->alert->danger('Data failed Added. Info :'.$this->upload->display_errors());
                        $this->session->set_flashdata('message', $text);
                        return redirect("dosen/ta_s1/add_bimbingan/".$nim);
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
                $this->Master_model->insert_query('history_bimbingan',$data);

                $data_masters=($this->Master_model->master_get(['nim' => $nim],'v_ta_s1_mhs_list'));
                $text = $this->alert->success('History Bimbingan add');
                    $this->session->set_flashdata('message', $text);
                    redirect("dosen/ta_s1/dashboard_mhs/".$nim.'/'.$data_masters->periode); 
            

        }else{
            $this->add_bimbingan($nim);
        }
    }
}