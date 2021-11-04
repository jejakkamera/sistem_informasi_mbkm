<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Magang extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
        $this->load->model('Mahasiswa_model');
        $this->url=url_siku;
		$this->key=key_siku;
		
        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('mahasiswa_magang',$level,$action);
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

	public function index(){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->list_periode_magang();

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

	public function history(){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->list_history_magang();

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

    public function daftar($periode){
        $rule_date=$this->Master_model->master_get(['periode'=>$periode],'magang_list');
       
        $start = strtotime($rule_date->buka_daftar);
        $close = strtotime($rule_date->tutup_daftar);
        $now = strtotime(date('Y-m-d'));
                if($start < $now and $now <$close and $rule_date->status=='open' ){
                }else{
                    $text = $this->alert->warning('registration has closed');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/magang/");
                }
        $rules=$this->Master_model->master_result(['periode'=>$periode],'magang_rule');
        if($rules){
            $rule=$this->Master_model->master_result(['periode'=>$periode,'nim'=>$this->session->userdata('username')],'magang_mhs_rule');
            if(!$rule){
                $text = $this->alert->warning('anda belum melakukan pembayaran');
                $this->session->set_flashdata('message', $text);
                redirect("mahasiswa/magang/cek_rule/".$periode);
            }
        }
        $this->load->model('form/Mhs_f', 'mahasiswa_form');

        $data_master=$this->mahasiswa_form->daftar_magang($periode);

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

    public function cek_rule($periode){
        $rule=$this->Master_model->master_result(['periode'=>$periode,'step'=>'daftar'],'magang_rule');
        if(!$rule){
            $text = $this->alert->success('rule ok');
            $this->session->set_flashdata('message', $text);
            redirect("mahasiswa/magang/daftar/".$periode); 
        }
        foreach($rule as $row){
            $this->output->set_header('Access-Control-Allow-Origin: *');
            
            $url =$this->url.'api/cek_rule';
            $data = array('key' => $this->key, 'id_rule' => $row['id_rule'],'nim'=>$this->session->userdata('username') );
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
                            
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $result = json_decode($result);
            if($result->status_code=='000'){
                $data=$result->data;
                if($data->status_bayar=='sudah'){
                    $data = array(
                        'periode' => $periode,
                        'nim' => $this->session->userdata('username'),
                    );
                    $this->Master_model->insert_query('magang_mhs_rule',$data);

                    $text = $this->alert->success('rule ok');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/magang/daftar/".$periode);
                }
            }
            
        }
        $text = $this->alert->warning('anda belum melakukan pembayaran');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/magang/");

      
    }

    public function dashboard($periode){
        $data_masters=($this->Master_model->master_get(['periode' => $periode,'nim' => $this->session->userdata('username')],'v_magang_mhs'));
        if($data_masters){
           
            $this->load->model('Baak_model');
            $nim = $this->session->userdata('username');
            $mahasiswa=($this->Master_model->master_get(['nim' => $this->session->userdata('username')],'mahasiswa'));

            $jadwal_sidang=($this->Mahasiswa_model->jadwal_sidang_magang($periode,$mahasiswa->kode_prodi));
            $history_bimbingan=$this->Master_model->master_result(['nim'=>$nim],'history_bimbingan_magang');
            // var_dump($info_akademik);
            // die;
            //print_r($kurikulum[0]);
            $this->header();
            $this->load->view('mahasiswa/magang/dashboard',
                [
                    'data_masters'=>$data_masters,
                    'history_bimbingan'=>$history_bimbingan,
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

    public function daftar_magang_action($periode){
        // $nama_pt = $this->input->post('nama_pt');
        $this->form_validation->set_rules('nama_pt','nama_pt','trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		if (($this->form_validation->run() == TRUE)   ) {
            $data_masters=($this->Master_model->master_get(['periode' => $periode,'nim' => $this->session->userdata('username')],'magang_mhs_list'));
            if($data_masters){
                $text = $this->alert->warning('you have registered in : '.$data_masters->nama_pt);
                $this->session->set_flashdata('message', $text);
                redirect(site_url('mahasiswa/magang/'));
            }

            $data=array(
                'periode'=>$periode,
                'nama_pt'=>$this->input->post('nama_pt'),
                'nim'=>$this->session->userdata('username'),
            );
            $this->Master_model->insert_query('magang_mhs_list',$data);

            $text = $this->alert->success('saved successfully, registered in : '.$this->input->post('nama_pt'));
            $this->session->set_flashdata('message', $text);
            redirect(site_url('mahasiswa/magang/'));

        }else{
            $this->daftar($periode);
        }
        
    }

    public function json_list_periode_magang(){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_periode_magang_mhs();
    }

    public function json_list_history_magang(){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_history_magang();
    }

    public function pendaftar_sidang_magang($id_trx){
        $rule_date=$this->Master_model->master_get(['id_trx'=>$id_trx],'magang_jadwal_sidang');
        if(!$rule_date){
            $text = $this->alert->warning('schedule not found');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/magang/"); 
        }
        $start = strtotime($rule_date->buka_daftar);
        $close = strtotime($rule_date->tutup_daftar);
        $now = strtotime(date('Y-m-d'));

                if($start < $now and $now <$close  ){
                }else{
                    $text = $this->alert->warning('registration has closed');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/magang/");
                }
        
        $cek_rule_byid=$this->Master_model->master_get(['nim'=>$this->session->userdata('username'),'id_rule'=>$rule_date->id_rule],'magang_mhs_rule');
        if(!$cek_rule_byid){
            $this->cek_rule_byid($rule_date->periode,$rule_date->id_rule,'mahasiswa/magang/dashboard/'.$rule_date->periode);
        }

        $this->load->model('form/Mhs_f', 'mahasiswa_form');

        $data_master=$this->mahasiswa_form->pendaftar_sidang_magang($id_trx);

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

    public function pendaftar_sidang_magang_action($id_trx){
        $rule_date=$this->Master_model->master_get(['id_trx'=>$id_trx],'magang_jadwal_sidang');
        if(!$rule_date){
            $text = $this->alert->warning('schedule not found');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/magang/"); 
        }

        $this->form_validation->set_rules('judul','judul','trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		if (($this->form_validation->run() == TRUE)   ) {
            $config['upload_path']          = './assets/berkas/magang/';
            $config['allowed_types']        = 'pdf';
            $new_name = time().'_'.$this->session->userdata('username').'_magang.pdf';
		    $config['file_name'] = $new_name;

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('berkas'))
            {
                $text = $this->alert->danger('Data failed Added. Info :'.$this->upload->display_errors());
                    $this->session->set_flashdata('message', $text);
                    return redirect("mahasiswa/magang/pendaftar_sidang_magang/".$id_trx);
            }
            else
            {
                $rule_date=$this->Master_model->master_get(['id_trx'=>$id_trx],'magang_jadwal_sidang');
                $magang_mhs_list=$this->Master_model->master_get(['periode'=>$rule_date->periode,'nim'=>$this->session->userdata('username')],'magang_mhs_list');

                if(in_array($magang_mhs_list->progres,['sidang','penilaian'])){
                    $text = $this->alert->warning('You do not have access. you progres : '.$magang_mhs_list->progres);
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/magang/dashboard/".$magang_mhs_list->periode); 
                }

                if(!$magang_mhs_list){
                    $text = $this->alert->warning('id trx registration not found');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/magang/"); 
                }

                $nama_berkas = $this->upload->data("file_name");
                $data=array(
                    'berkas'=>$nama_berkas,
                    'id_sidang'=>$id_trx,
                    'judul'=>$this->input->post('judul'),
                    'tgl_berkas'=>(date('Y-m-d H:i:s')),
                    'progres'=>'daftar sidang',
                );

                $this->Master_model->update_query(['id_trx'=>$magang_mhs_list->id_trx,'nim'=>$this->session->userdata('username')], $data, 'magang_mhs_list');

                $text = $this->alert->success('registration was update');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/magang/dashboard/".$magang_mhs_list->periode); 
            }
        }else{
            $this->pendaftar_sidang_magang($id_trx);
        }

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
                        return redirect("mahasiswa/magang/add_bimbingan/".$nim);
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
                    redirect("mahasiswa/magang/dashboard/".$data_masters->periode); 
            

        }else{
            $this->add_bimbingan($nim);
        }
    }

    public function cek_rule_byid($periode,$id_rule,$link){
            $this->output->set_header('Access-Control-Allow-Origin: *');
            
            $url =$this->url.'api/cek_rule';
            $data = array('key' => $this->key, 'id_rule' => $id_rule,'nim'=>$this->session->userdata('username') );
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
                            
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $result = json_decode($result);
            if($result->status_code=='000'){
                $data=$result->data;
                if($data->status_bayar=='sudah'){
                    $data = array(
                        'periode' => $periode,
                        'id_rule' => $id_rule,
                        'nim' => $this->session->userdata('username'),
                    );
                    $this->Master_model->insert_query('magang_mhs_rule',$data);

                    return ok;
                    // $text = $this->alert->success('rule ok');
                    // $this->session->set_flashdata('message', $text);
                    // redirect($link);
                }
            }
            
        
        $text = $this->alert->warning('anda belum melakukan pembayaran');
                    $this->session->set_flashdata('message', $text);
                    redirect($link);

      
    }


}