<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Magang extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
		$this->load->model('Baak_model');
        $this->load->model('form/Baak_f', 'baak_form');

        $this->url=url_siku;
		$this->key=key_siku;

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('baak_magang',$level,$action);
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

    public function json_list_periode_magang(){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_periode_magang();
    }

    public function json_periode_rule($periode){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_periode_rule($periode);
    }

    public function json_sidang_rule($periode){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_sidang_rule($periode);
    }

    public function json_list_pendaftar_magang($periode){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_pendaftar_magang($periode);
    }

    public function json_all_data_magang($periode){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_all_data_magang($periode);
    }

    public function json_list_sidang_magang($periode){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_sidang_magang($periode);
    }

    public function json_list_jadwal_sidang_magang($id_trx){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_jadwal_sidang_magang($id_trx);
    }

    public function periode_magang_edit_action($periode){
        $this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('buka_daftar', 'buka_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tutup_daftar', 'tutup_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('periode_akhir', 'periode_akhir', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

            if ( ($this->form_validation->run() == TRUE)   ) {

                $data = array(
					'status' => $this->input->post('status',TRUE),
					'buka_daftar' => $this->input->post('buka_daftar',TRUE),
					'tutup_daftar' => $this->input->post('tutup_daftar',TRUE),
					'periode_akhir' => $this->input->post('periode_akhir',TRUE),
				);
				$this->Master_model->update_query(['periode'=>$periode], $data, 'magang_list');

                $text = $this->alert->success('success edit : periode magang');
				$this->session->set_flashdata('message', $text);
				redirect("baak/magang/list_periode");
            }else{
                $this->periode_edit($periode);
            }
    }

    public function periode_magang_add_action(){

        $this->form_validation->set_rules('id_periode', 'id_periode', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('buka_daftar', 'buka_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tutup_daftar', 'tutup_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('periode_akhir', 'periode_akhir', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

            if ( ($this->form_validation->run() == TRUE)   ) {

                $data = array(
					'periode' => $this->input->post('id_periode',TRUE),
					'status' => $this->input->post('status',TRUE),
					'buka_daftar' => $this->input->post('buka_daftar',TRUE),
					'tutup_daftar' => $this->input->post('tutup_daftar',TRUE),
					'periode_akhir' => $this->input->post('periode_akhir',TRUE),
				);
				$this->Master_model->insert_query('magang_list',$data);

                $text = $this->alert->success('success add : periode magang');
				$this->session->set_flashdata('message', $text);
				redirect("baak/magang/list_periode");
            }else{
                $this->periode_magang_add();
            }
    }

    public function periode_edit($periode){
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->periode_magang_edit($periode);
        $data_masters=get_object_vars($this->Master_model->master_get(['periode'=>$periode],'magang_list'));
		if(!$data_masters){
			$text = $this->alert->danger('Periode not found');
			$this->session->set_flashdata('message', $text);
			redirect("baak/magang/list_periode");
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

    public function periode_rule_add($periode){
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->periode_rule_add($periode);
        
        // print_r($master_saji);
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

    public function periode_rule_add_action($periode){
        $this->form_validation->set_rules('id_periode', 'id_periode', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

            if ( ($this->form_validation->run() == TRUE)   ) {

                $this->output->set_header('Access-Control-Allow-Origin: *');
                $url =$this->url.'api/get_rule_administrasi_byid';
                $data = array('key' => $this->key, 'id_rule' =>  $this->input->post('id_periode',TRUE) );
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
                if($result->status_code!='000'){

                    $text = $this->alert->danger('cannot get data from siku');
                    $this->session->set_flashdata('message', $text);
                    redirect("baak/magang/periode_rule_add/".$periode);
                }  
                $result = ($result->data);
                

                $data = array(
					'periode' => $periode,
					'id_rule' => $result->kode,
					'name' => $result->nama,
					'step' => 'daftar',
				);
				$this->Master_model->insert_query('magang_rule',$data);

                $text = $this->alert->success('success add : magang rule');
				$this->session->set_flashdata('message', $text);
				redirect("baak/magang/periode_rule/".$periode);
            }else{
                $this->periode_rule_add($periode);
            }
    }

    public function periode_magang_add(){
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->periode_magang_add();
        
        // print_r($master_saji);
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

    public function periode_rule($periode){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->periode_rule($periode);

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

    public function sidang_rule($id_trx,$periode){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->sidang_rule($id_trx,$periode);

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

    public function list_periode(){
      
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

    public function rule_list(){
        $this->output->set_header('Access-Control-Allow-Origin: *');
		$frs_set=$this->Master_model->master_get(['id'=>0],'frs_set');
        $kec = $this->input->post('kec');
        $url =$this->url.'api/get_rule_administrasi';
		$data = array('key' => $this->key, 'periode' => $frs_set->id_periode,'kec'=>$kec );
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
        echo json_encode($result->data);
        
    }

    public function delete_rule($id){
        $data_file = $this->Master_model->master_get(['id_trx'=>$id], 'magang_rule');
        if($data_file){
            $this->Master_model->delete_query(['id_trx'=> $id],'magang_rule');

            $text = $this->alert->warning('Data successfully Delete');
				$this->session->set_flashdata('message', $text);
				redirect("baak/magang/periode_rule/".$data_file->periode);
        }else{
            $text = $this->alert->warning('TRX not found');
				$this->session->set_flashdata('message', $text);
				redirect("baak/magang/list_periode");
        }
    }

    public function pendaftar($periode){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $this->header();
        $this->load->view('baak/magang/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_master=$this->baak_tabel->list_pendaftar_magang($periode);
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->footer();
    }

    public function plot_dosen_action($id_trx){
        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_magang_mhs');
        if($data_file){
            $this->form_validation->set_rules('id_dosen', 'id_dosen', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    
                if ( ($this->form_validation->run() == TRUE)   ) {
                    $data=array(
                        'id_dosen_bimbing'=>$this->input->post('id_dosen',TRUE),
                        'tgl_pembimbing'=>date('Y-m-d'),
                        'progres'=>'bimbingan',
                    );

                    $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'magang_mhs_list');
                    $text = $this->alert->success('data update');
                    $this->session->set_flashdata('message', $text);
                    redirect("baak/magang/pendaftar/".$data_file->periode);

                }else{
                    $this->plot_dosen($id_trx,$data_file->periode);
                }

        }else{
            $text = $this->alert->danger('Record not found');
				$this->session->set_flashdata('message', $text);
				redirect("baak/magang/list_periode");
        }
    }

    public function plot_dosen($id_trx,$periode){
        $this->header();
        $this->load->view('baak/magang/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_magang_mhs');

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->magang_plot_dosen($id_trx,$data_file);
        
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

    public function list_sidang($periode){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $this->header();
        $this->load->view('baak/magang/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_master=$this->baak_tabel->list_sidang_magang($periode);
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->footer();
    }

    public function all_data($periode){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $this->header();
        $this->load->view('baak/magang/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_master=$this->baak_tabel->all_data_magang($periode);
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->footer();
    }

    public function dashboard($periode){
      
        $this->header();
        $this->load->view('baak/magang/dashboard',
            [
                'periode'=>$periode,
            ]
        );
        $this->footer();
        
    }

    public function sidang_magang_edit($id_trx,$periode){
        $this->header();
        $this->load->view('baak/magang/dashboard',
            [
                'periode'=>$periode,
            ]
        );


        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->sidang_magang_edit($id_trx,$periode);
        $data_masters=get_object_vars($this->Master_model->master_get(['id_trx'=>$id_trx],'magang_jadwal_sidang'));

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

    public function sidang_magang_add($periode){
        $this->header();
        $this->load->view('baak/magang/dashboard',
            [
                'periode'=>$periode,
            ]
        );


        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->sidang_magang_add($periode);
        
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

    public function sidang_magang_edit_action($id_trx,$periode){
        $this->form_validation->set_rules('buka_daftar', 'buka_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tutup_daftar', 'tutup_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tanggal_sidang', 'tanggal_sidang', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required|xss_clean');
        $this->form_validation->set_rules('id_rule', 'id_rule', 'trim|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

            if ( ($this->form_validation->run() == TRUE)   ) {
                $result->kode=null;
                $result->nama=null;
                if($this->input->post('id_rule')){
                    $this->output->set_header('Access-Control-Allow-Origin: *');
                    $url =$this->url.'api/get_rule_administrasi_byid';
                    $data = array('key' => $this->key, 'id_rule' =>  $this->input->post('id_rule',TRUE) );
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
                    if($result->status_code!='000'){
    
                        $text = $this->alert->danger('cannot get data from siku');
                        $this->session->set_flashdata('message', $text);
                        redirect("baak/magang/sidang_magang_edit/".$id_trx.'/'.$periode);
                    }  
                    $result = ($result->data);
                }
                
                $data = array(
					'buka_daftar' => $this->input->post('buka_daftar'),
					'tutup_daftar' => $this->input->post('tutup_daftar'),
					'tanggal_sidang' => $this->input->post('tanggal_sidang'),
					'ket' => $this->input->post('ket'),
                    'id_rule' => $result->kode,
					'nama_id_rule' => $result->nama,
				);
                $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'magang_jadwal_sidang');

                $text = $this->alert->success('success edit : jadwal sidang');
				$this->session->set_flashdata('message', $text);
				redirect("baak/magang/list_sidang/".$periode);
            }else{
                $this->sidang_magang_edit($id_trx,$periode);
            }
    }

    public function sidang_magang_add_action($periode){
        $this->form_validation->set_rules('buka_daftar', 'buka_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tutup_daftar', 'tutup_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tanggal_sidang', 'tanggal_sidang', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kode_prodi', 'kode_prodi', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required|xss_clean');
        $this->form_validation->set_rules('id_rule', 'id_rule', 'trim|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

            if ( ($this->form_validation->run() == TRUE)   ) {        
                $this->output->set_header('Access-Control-Allow-Origin: *');
                $url =$this->url.'api/get_rule_administrasi_byid';
                $data = array('key' => $this->key, 'id_rule' =>  $this->input->post('id_rule',TRUE) );
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
                if($result->status_code!='000'){

                    $text = $this->alert->danger('cannot get data from siku');
                    $this->session->set_flashdata('message', $text);
                    redirect("baak/tugas_akhir/ta_s1/yudusium_add/".$periode);
                }  
                $result = ($result->data);

                $data = array(
					'periode' => $periode,
					'buka_daftar' => $this->input->post('buka_daftar'),
					'tutup_daftar' => $this->input->post('tutup_daftar'),
					'tanggal_sidang' => $this->input->post('tanggal_sidang'),
					'kode_prodi' => $this->input->post('kode_prodi'),
					'ket' => $this->input->post('ket'),
                    'id_rule' => $result->kode,
					'nama_id_rule' => $result->nama,
				);
				$this->Master_model->insert_query('magang_jadwal_sidang',$data);

                $text = $this->alert->success('success add : jadwal sidang');
				$this->session->set_flashdata('message', $text);
				redirect("baak/magang/list_sidang/".$periode);
            }else{
                $this->sidang_magang_add($periode);
            }
    }

    public function plot_jadwal_sidang($id_trx,$periode){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $this->header();
        $this->load->view('baak/magang/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_master=$this->baak_tabel->list_jadwal_sidang_magang($id_trx);
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->footer();
    }

    public function plot_sidang_magang($id_trx,$periode){
        $this->header();
        $this->load->view('baak/magang/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_magang_mhs');

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->plot_sidang_magang($id_trx,$data_file);
        
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

    public function tolak_sidang_magang($id_trx,$periode){
        $this->header();
        $this->load->view('baak/magang/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_magang_mhs');

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->tolak_sidang_magang($id_trx,$data_file);
        
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

    public function tolak_sidang_magang_action($id_trx){
        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_magang_mhs');
        if($data_file){
            $this->form_validation->set_rules('ket', 'ket', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            if ( ($this->form_validation->run() == TRUE)   ) {
                $data=array(
                    'ket'=>$this->input->post('ket',TRUE),
                    'progres'=>'pendaftaran ditolak',
                );

                $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'magang_mhs_list');
                $text = $this->alert->success('data update');
                $this->session->set_flashdata('message', $text);
                redirect("baak/magang/plot_jadwal_sidang/".$data_file->id_sidang."/".$data_file->periode);
            }else{
                $this->tolak_sidang_magang($id_trx,$data_file->periode);
            }
        }else{
            $text = $this->alert->danger('Record not found');
				$this->session->set_flashdata('message', $text);
				redirect("baak/magang/list_periode");
        }
    }

    public function penilaian($id_trx,$periode){
        $data_masters=($this->Master_model->master_get(['id_trx' => $id_trx],'v_magang_mhs'));
        if($data_masters){
           
            $nim=$data_masters->nim;
            $this->load->model('Mahasiswa_model');
            $this->load->model('Baak_model');
            $mahasiswa=($this->Master_model->master_get(['nim' => $nim],'mahasiswa'));

            $magang_nilai=($this->Master_model->master_result(['id_trx_magang' => $id_trx],'magang_nilai'));

            $jadwal_sidang=($this->Mahasiswa_model->jadwal_sidang_magang($periode,$mahasiswa->kode_prodi));
    
            // var_dump($info_akademik);
            // die;
            //print_r($kurikulum[0]);
            $this->header();
            $this->load->view('baak/magang/dashboard',
                [
                    'periode'=>$periode,
                ]
            );
            $this->load->view('mahasiswa/magang/dashboard',
                 ['id_trx'=>$id_trx,'periode'=>$periode,'data_masters'=>$data_masters,'jadwal_sidang'=>$jadwal_sidang,'magang_nilai'=>$magang_nilai]
            );
            $this->footer();
        }else{
            $text = $this->alert->warning('NIM not registered');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('baak/magang/list_periode'));
        }
    }

    public function plot_sidang_magang_action($id_trx){
        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_magang_mhs');
        if($data_file){
            $this->form_validation->set_rules('id_dosen_ketua', 'id_dosen_ketua', 'trim|required|xss_clean');
            $this->form_validation->set_rules('id_dosen_penguji_1', 'id_dosen_penguji_1', 'trim|required|xss_clean');
            $this->form_validation->set_rules('id_dosen_penguji_2', 'id_dosen_penguji_2', 'trim|xss_clean');
            $this->form_validation->set_rules('id_dosen_penguji_3', 'id_dosen_penguji_3', 'trim|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    
                if ( ($this->form_validation->run() == TRUE)   ) {
                    $data=array(
                        'id_dosen_ketua'=>$this->input->post('id_dosen_ketua',TRUE),
                        'id_dosen_penguji_1'=>$this->input->post('id_dosen_penguji_1',TRUE),
                        'id_dosen_penguji_2'=>$this->input->post('id_dosen_penguji_2',TRUE),
                        'id_dosen_penguji_3'=>$this->input->post('id_dosen_penguji_3',TRUE),
                        'progres'=>'sidang',
                        'ket'=>''
                    );

                    $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'magang_mhs_list');
                    $text = $this->alert->success('data update');
                    $this->session->set_flashdata('message', $text);
                    redirect("baak/magang/plot_jadwal_sidang/".$data_file->id_sidang."/".$data_file->periode);

                }else{
                    $this->plot_sidang_magang($id_trx,$data_file->periode);
                }

        }else{
            $text = $this->alert->danger('Record not found');
				$this->session->set_flashdata('message', $text);
				redirect("baak/magang/list_periode");
        }
    }

    public function input_penilaian_action($id_trx,$periode){
        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_magang_mhs');
        if($data_file){
            $this->form_validation->set_rules('nilai_sidang', 'nilai_sidang', 'trim|required|xss_clean');
            $this->form_validation->set_rules('keterangan_sidang', 'keterangan_sidang', 'trim|required|xss_clean');
            $this->form_validation->set_rules('progres', 'progres', 'trim|xss_clean');
            $this->form_validation->set_rules('tgl_lulus', 'tgl_lulus', 'trim|xss_clean');
            $this->form_validation->set_rules('id_frs', 'id_frs', 'trim|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    
                if ( ($this->form_validation->run() == TRUE)   ) {
                    $cek_=$this->Master_model->master_get(['id_trx'=>$this->input->post('id_frs',TRUE)],'frs_mhs_mk');
                    if(!$cek_){
                        $text = $this->alert->danger('Record FRS not found');
                        $this->session->set_flashdata('message', $text);
                        redirect("baak/magang/list_periode");
                    }

                    $data=array(
                        'nilai_sidang'=>$this->input->post('nilai_sidang',TRUE),
                        'keterangan_sidang'=>$this->input->post('keterangan_sidang',TRUE),
                        'progres'=>$this->input->post('progres',TRUE),
                        'tgl_lulus'=>$this->input->post('tgl_lulus',TRUE),
                        'id_frs'=>$this->input->post('id_frs',TRUE),
                    );
                    $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'magang_mhs_list');

                    $get_nilai_skala=$this->Baak_model->get_nilai_skala($data_file->periode,$data_file->kode_program_studi,$this->input->post('nilai_sidang',TRUE));
                    if(!$get_nilai_skala){
                        $text = $this->alert->danger('Skala nilai not found');
                        $this->session->set_flashdata('message', $text);
                        redirect("baak/magang/input_penilaian/".$id_trx.'/'.$periode);
                    }

                    $data=array(
                        'feeder_update_nilai'=>'belum',
                        'nilai_angka'=>$this->input->post('nilai_sidang',TRUE),
                        'nilai_huruf'=>$get_nilai_skala->nilai_huruf,
                        'last_edit'=>date('Y-m-d H:i:s')
                    );
                    $where_array=array(
                        'id_trx'=>$this->input->post('id_frs',TRUE)
                    );
                    
                    $this->Master_model->update_query($where_array, $data, 'frs_mhs_mk');
                    $this->Master_model->insert_history('approve_nilai','frs_mhs_mk',json_encode($data) );

                    $datas=array(
                        'id_trx_history'=>date('ymdhsi').'_magang_'.$this->input->post('id_frs',TRUE),
                        'id_komponen'=>'magang',
                        'id_trx_frs'=>$this->input->post('id_frs',TRUE),
                        'nilai_asal'=>$cek_->nilai_angka,
                        'nilai_berubah'=>$this->input->post('nilai_sidang',TRUE),
                        'log'=>$this->Master_model->user_cek_ident()
                    );
                    $this->Master_model->insert_query('history_nilai',$datas);
                    $text = $this->alert->success('Nilai Update');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/magang/penilaian/'.$id_trx.'/'.$periode));
                }else{
                    $this->input_penilaian($id_trx,$periode);
                }
        }else{
            $text = $this->alert->danger('Record not found');
				$this->session->set_flashdata('message', $text);
				redirect("baak/magang/list_periode");
        } 
    }

    public function input_penilaian($id_trx,$periode){
        $data_masters=get_object_vars($this->Master_model->master_get(['id_trx' => $id_trx],'v_magang_mhs'));  
        if($data_masters){

            $data_master=$this->baak_form->input_penilaian($id_trx,$data_masters,$periode);
            // $data_masters=get_object_vars($this->Master_model->master_get(['periode'=>$periode],'magang_list'));
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
            $text = $this->alert->warning('NIM not registered');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('baak/magang/list_periode'));
        }

    }


}