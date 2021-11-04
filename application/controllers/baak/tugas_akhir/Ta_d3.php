<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ta_d3 extends CI_Controller {


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
        $access = $this->Master_model->cek_akses('baak_ta_d3',$level,$action);
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

    public function json_list_periode_d3(){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_periode_d3();
    }

    public function list_periode(){
      
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_periode_d3();

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

    public function periode_tugas_akhir_add(){
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->periode_tugas_akhir_d3_add();
        
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

    public function periode_tugas_akhir_add_action(){

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
				$this->Master_model->insert_query('ta_d3_list',$data);

                $text = $this->alert->success('success add : periode Tugas Akhir');
				$this->session->set_flashdata('message', $text);
				redirect("baak/tugas_akhir/ta_d3/list_periode");
            }else{
                $this->periode_tugas_akhir_add();
            }
    }

    public function periode_edit($periode){
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->periode_ta_d3_edit($periode);
        $data_masters=get_object_vars($this->Master_model->master_get(['periode'=>$periode],'ta_d3_list'));
		if(!$data_masters){
			$text = $this->alert->danger('Periode not found');
			$this->session->set_flashdata('message', $text);
			redirect("baak/tugas_akhir/ta_d3/list_periode");
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

    public function periode_edit_action($periode){
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
				$this->Master_model->update_query(['periode'=>$periode], $data, 'ta_d3_list');

                $text = $this->alert->success('success edit : periode Tugas Akhir');
				$this->session->set_flashdata('message', $text);
				redirect("baak/tugas_akhir/ta_d3/list_periode");
            }else{
                $this->periode_edit($periode);
            }
    }

    public function json_periode_rule($periode){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_periode_rule_ta_d3($periode);
    }

    public function periode_rule($periode){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->periode_rule_ta_d3($periode);

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

    public function periode_rule_add($periode){
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->periode_rule_add_ta_d3($periode);
        
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
                    redirect("baak/tugas_akhir/ta_d3/periode_rule_add/".$periode);
                }  
                $result = ($result->data);
                

                $data = array(
					'periode' => $periode,
					'id_rule' => $result->kode,
					'name' => $result->nama,
				);
				$this->Master_model->insert_query('ta_d3_rule',$data);

                $text = $this->alert->success('success add : TA rule');
				$this->session->set_flashdata('message', $text);
				redirect("baak/tugas_akhir/ta_d3/periode_rule/".$periode);
            }else{
                $this->periode_rule_add($periode);
            }
    }

    public function dashboard($periode){
      
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );
        $this->footer();
        
    }

    public function pendaftar($periode){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_master=$this->baak_tabel->list_pendaftar_ta_d3($periode);
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->footer();
    }

    public function json_list_pendaftar_ta_d3($periode){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_pendaftar_ta_d3($periode);
    }

   

    public function plot_dosen($id_trx,$periode){
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_ta_d3_mhs_list');

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->ta_d3_plot_dosen($id_trx,$data_file);
        
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

    public function plot_dosen_action($id_trx){
        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_ta_d3_mhs_list');
        if($data_file){
            $this->form_validation->set_rules('id_dosen_bimbing_1', 'id_dosen_bimbing_1', 'trim|required|xss_clean');
            $this->form_validation->set_rules('id_dosen_bimbing_2', 'id_dosen_bimbing_2', 'trim|xss_clean');
            $this->form_validation->set_rules('id_dosen_bimbing_3', 'id_dosen_bimbing_3', 'trim|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    
                if ( ($this->form_validation->run() == TRUE)   ) {
                    $data=array(
                        'id_dosen_bimbing_1'=>$this->input->post('id_dosen_bimbing_1',TRUE),
                        'id_dosen_bimbing_2'=>$this->input->post('id_dosen_bimbing_2',TRUE),
                        'id_dosen_bimbing_3'=>$this->input->post('id_dosen_bimbing_3',TRUE),
                        'tgl_pembimbing'=>date('Y-m-d'),
                        'progres'=>'bimbingan',
                    );

                    $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'ta_d3_mhs_list');
                    $text = $this->alert->success('data update');
                    $this->session->set_flashdata('message', $text);
                    redirect("baak/tugas_akhir/ta_d3/pendaftar/".$data_file->periode);

                }else{
                    $this->plot_dosen($id_trx,$data_file->periode);
                }

        }else{
            $text = $this->alert->danger('Record not found');
				$this->session->set_flashdata('message', $text);
				redirect("baak/tugas_akhir/ta_d3/list_periode");
        }
    }

    public function all_data($periode){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_master=$this->baak_tabel->all_data_ta_d3($periode);
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->footer();
    }

    public function json_all_data_ta_d3($periode){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_all_data_ta_d3($periode);
    }

    public function list_sidang($sidang,$periode){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_master=$this->baak_tabel->list_sidang_ta_d3($sidang,$periode);
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->footer();
    }

    public function json_list_sidang_ta_d3($sidang,$periode){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_sidang_ta_d3($sidang,$periode);
    }

   

    public function sidang_add($sidang,$periode){
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );


        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->sidang_ta_d3_add($sidang,$periode);
        
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

    public function sidang_ta_d3_add_action($sidang,$periode){
        $this->form_validation->set_rules('buka_daftar', 'buka_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tutup_daftar', 'tutup_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tanggal_sidang', 'tanggal_sidang', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kode_prodi', 'kode_prodi', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

            if ( ($this->form_validation->run() == TRUE)   ) {        
            
                $data = array(
					'periode' => $periode,
					'sidang' => $sidang,
					'buka_daftar' => $this->input->post('buka_daftar'),
					'tutup_daftar' => $this->input->post('tutup_daftar'),
					'tanggal_sidang' => $this->input->post('tanggal_sidang'),
					'kode_prodi' => $this->input->post('kode_prodi'),
					'ket' => $this->input->post('ket'),
				);
				$this->Master_model->insert_query('ta_d3_jadwal_sidang',$data);

                $text = $this->alert->success('success add : jadwal sidang');
				$this->session->set_flashdata('message', $text);
				redirect("baak/tugas_akhir/ta_d3/list_sidang/".$sidang.'/'.$periode);
            }else{
                $this->sidang_add($sidang,$periode);
            }
    }

    public function sidang_ta_d3_edit($id_trx,$periode){
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );


        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->sidang_ta_d3_edit($id_trx,$periode);
        $data_masters=get_object_vars($this->Master_model->master_get(['id_trx'=>$id_trx],'ta_d3_jadwal_sidang'));

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

    public function sidang_ta_d3_edit_action($id_trx,$periode){
        $data_masters=$this->Master_model->master_get(['id_trx'=>$id_trx],'ta_d3_jadwal_sidang');
        if(!$data_masters){
            $text = $this->alert->danger('Record not found');
            $this->session->set_flashdata('message', $text);
            redirect("baak/tugas_akhir/ta_d3/list_periode");
        }
        $this->form_validation->set_rules('buka_daftar', 'buka_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tutup_daftar', 'tutup_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tanggal_sidang', 'tanggal_sidang', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

            if ( ($this->form_validation->run() == TRUE)   ) {   
                $data = array(
					'buka_daftar' => $this->input->post('buka_daftar'),
					'tutup_daftar' => $this->input->post('tutup_daftar'),
					'tanggal_sidang' => $this->input->post('tanggal_sidang'),
					'ket' => $this->input->post('ket'),
				);
                $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'ta_d3_jadwal_sidang');

                $text = $this->alert->success('success edit : jadwal sidang');
				$this->session->set_flashdata('message', $text);
				redirect("baak/tugas_akhir/ta_d3/list_sidang/".$data_masters->sidang.'/'.$periode);
            }else{
                $this->sidang_ta_d3_edit($id_trx,$periode);
            }
    }

    public function plot_jadwal_sidang($id_trx,$periode){
        $data_masters=$this->Master_model->master_get(['id_trx'=>$id_trx],'ta_d3_jadwal_sidang');
        if(!$data_masters){
            $text = $this->alert->danger('Record not found');
            $this->session->set_flashdata('message', $text);
            redirect("baak/tugas_akhir/ta_d3/list_periode");
        }
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_master=$this->baak_tabel->list_jadwal_sidang_ta_d3($id_trx,$data_masters);
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->footer();
    }

    public function json_list_jadwal_sidang_ta_d3($id_trx){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_jadwal_sidang_ta_d3($id_trx);
    }

    public function plot_sidang_ta_d3($id_trx,$periode){
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_ta_d3_mhs_sidang');

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->plot_sidang_ta_d3($id_trx,$data_file);
        
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

    public function plot_sidang_ta_d3_action($id_trx){
        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_ta_d3_mhs_sidang');
        if($data_file){
            $this->form_validation->set_rules('id_dosen_ketua', 'id_dosen_ketua', 'trim|required|xss_clean');
            $this->form_validation->set_rules('id_dosen_penguji_1', 'id_dosen_penguji_1', 'trim|required|xss_clean');
            $this->form_validation->set_rules('id_dosen_penguji_2', 'id_dosen_penguji_2', 'trim|xss_clean');
            $this->form_validation->set_rules('id_dosen_penguji_3', 'id_dosen_penguji_3', 'trim|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    
                if ( ($this->form_validation->run() == TRUE)   ) {
                    $data=array(
                        'id_dosen_ketua'=>$this->input->post('id_dosen_ketua',TRUE),
                        'id_dosen_penguji1'=>$this->input->post('id_dosen_penguji_1',TRUE),
                        'id_dosen_penguji2'=>$this->input->post('id_dosen_penguji_2',TRUE),
                        'id_dosen_penguji3'=>$this->input->post('id_dosen_penguji_3',TRUE),
                        'progres'=>'sidang',
                        'ket'=>''
                    );

                    $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'ta_d3_mhs_sidang');


                    $data=array(
                        'progres'=>'progres sidang '.$data_file->sidang,
                    );
                    $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'ta_d3_mhs_list');

                    $text = $this->alert->success('data update');
                    $this->session->set_flashdata('message', $text);
                    redirect("baak/tugas_akhir/ta_d3/plot_jadwal_sidang/".$data_file->id_sidang."/".$data_file->periode);

                }else{
                    $this->plot_sidang_ta_d3($id_trx,$data_file->periode);
                }

        }else{
            $text = $this->alert->danger('Record not found');
				$this->session->set_flashdata('message', $text);
				redirect("baak/tugas_akhir/ta_d3/list_periode");
        }
    }

    public function tolak_sidang($id_trx,$periode){
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_ta_d3_mhs_sidang');

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->tolak_sidang($id_trx,$data_file);
        
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

    public function tolak_sidang_action($id_trx){
        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'v_ta_d3_mhs_sidang');
        if($data_file){
            $this->form_validation->set_rules('ket', 'ket', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
            if ( ($this->form_validation->run() == TRUE)   ) {
                $data=array(
                    'ket'=>$this->input->post('ket',TRUE),
                    'progres'=>'ditolak',
                );

                $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'ta_d3_mhs_sidang');
                $text = $this->alert->success('data update');
                $this->session->set_flashdata('message', $text);
                redirect("baak/tugas_akhir/ta_d3/plot_jadwal_sidang/".$data_file->id_sidang."/".$data_file->periode);
            }else{
                $this->tolak_sidang($id_trx,$data_file->periode);
            }
        }else{
            $text = $this->alert->danger('Record not found');
				$this->session->set_flashdata('message', $text);
				redirect("baak/tugas_akhir/ta_d3/list_periode");
        }
    }
    
    public function penilaian($id_trx,$periode){
        $data_masters=($this->Master_model->master_get(['id_trx' => $id_trx],'v_ta_d3_mhs_sidang'));
        if($data_masters){
           
            $nim=$data_masters->nim;
            $this->load->model('Mahasiswa_model');
            $this->load->model('Baak_model');

            $magang_nilai=($this->Master_model->master_result(['id_trx_sidang' => $id_trx],'ta_d3_nilai'));
    
            // var_dump($info_akademik);
            // die;
            //print_r($kurikulum[0]);
            $this->header();
            $this->load->view('baak/tugas_akhir_d3/dashboard',
                [
                    'periode'=>$periode,
                ]
            );
            $this->load->view('baak/tugas_akhir_d3/penilaian',
                 ['id_trx'=>$id_trx,'periode'=>$periode,'data_masters'=>$data_masters,'magang_nilai'=>$magang_nilai]
            );
            $this->footer();
        }else{
            $text = $this->alert->warning('NIM not registered');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('baak/tugas_akhir/ta_d3/list_periode'));
        }
    }

    public function input_penilaian($id_trx,$periode){
        $data_masters=get_object_vars($this->Master_model->master_get(['id_trx' => $id_trx],'v_ta_d3_mhs_sidang'));  
        if($data_masters){

            $data_master=$this->baak_form->input_penilaian_sidang_d3($id_trx,$data_masters,$periode);
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
            redirect(site_url('baak/tugas_akhir/ta_d3/list_periode'));
        }

    }

    public function input_penilaian_action($id_trx,$periode){
        $data_file = $this->Master_model->master_get(['id_trx'=>$id_trx], 'ta_d3_mhs_sidang');
        if($data_file){
            $this->form_validation->set_rules('nilai', 'nilai', 'trim|required|xss_clean');
            $this->form_validation->set_rules('ket', 'ket', 'trim|required|xss_clean');
            $this->form_validation->set_rules('progres', 'progres', 'trim|xss_clean');
            $this->form_validation->set_rules('tgl_lulus', 'tgl_lulus', 'trim|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    
                if ( ($this->form_validation->run() == TRUE)   ) {
               
                    $data=array(
                        'nilai'=>$this->input->post('nilai',TRUE),
                        'ket'=>$this->input->post('ket',TRUE),
                        'progres'=>$this->input->post('progres',TRUE),
                        'tgl_lulus'=>$this->input->post('tgl_lulus',TRUE),
                    );
                    $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'ta_d3_mhs_sidang'); 

                     $data=array(
                        'progres'=>'penilaian sidang '.$data_file->sidang,

                    );
                    $this->Master_model->update_query(['id_trx'=>$data_file->id_list], $data, 'ta_d3_mhs_list');
                    
                    if($data_file->sidang=='ta' ){
                        $cek_=$this->Master_model->master_get(['id_trx'=>$this->input->post('id_frs',TRUE)],'frs_mhs_mk');
                        if(!$cek_){
                            $text = $this->alert->danger('Record FRS not found');
                            $this->session->set_flashdata('message', $text);
                            redirect("baak/tugas_akhir/ta_d3/list_periode");
                        }

                        $mahasiswa = $this->Master_model->master_get(['nim'=>$data_file->nim], 'mahasiswa');

                        $get_nilai_skala=$this->Baak_model->get_nilai_skala($data_file->periode,$mahasiswa->kode_prodi,$this->input->post('nilai',TRUE));
                        if(!$get_nilai_skala){
                            $text = $this->alert->danger('Skala nilai not found');
                            $this->session->set_flashdata('message', $text);
                            redirect("baak/tugas_akhir/ta_d3/input_penilaian/".$id_trx.'/'.$periode);
                        }

                        $data=array(
                            'feeder_update_nilai'=>'belum',
                            'nilai_angka'=>$this->input->post('nilai',TRUE),
                            'nilai_huruf'=>$get_nilai_skala->nilai_huruf,
                            'last_edit'=>date('Y-m-d H:i:s')
                        );
                        $where_array=array(
                            'id_trx'=>$this->input->post('id_frs',TRUE)
                        );
                        
                        $this->Master_model->update_query($where_array, $data, 'frs_mhs_mk');
                        $this->Master_model->insert_history('approve_nilai','frs_mhs_mk',json_encode($data) );
    
                        $datas=array(
                            'id_trx_history'=>date('ymdhsi').'_ta_'.$this->input->post('id_frs',TRUE),
                            'id_komponen'=>'ta',
                            'id_trx_frs'=>$this->input->post('id_frs',TRUE),
                            'nilai_asal'=>$cek_->nilai_angka,
                            'nilai_berubah'=>$this->input->post('nilai',TRUE),
                            'log'=>$this->Master_model->user_cek_ident()
                        );
                        $this->Master_model->insert_query('history_nilai',$datas);
                    }
             
                    $text = $this->alert->success('Nilai Update');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/tugas_akhir/ta_d3/penilaian/'.$id_trx.'/'.$periode));
                }else{
                    $this->input_penilaian($id_trx,$periode);
                }
        }else{
            $text = $this->alert->danger('Record not found');
				$this->session->set_flashdata('message', $text);
				redirect("baak/tugas_akhir/ta_d3/list_periode");
        } 
    }

    public function list_yudusium($periode){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_master=$this->baak_tabel->list_yudusium($periode);
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->footer();
    }

    public function json_list_yudusium_d3($periode){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_yudusium_d3($periode);
    }

   

    public function yudusium_add($periode){
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );


        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->yudusium_add($periode);
        
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

    
    
    public function yudusium_add_action($periode){
        $this->form_validation->set_rules('tanggal_penutupan', 'tanggal_penutupan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kode_prodi', 'kode_prodi', 'trim|required|xss_clean');
        $this->form_validation->set_rules('no_sk', 'no_sk', 'trim|xss_clean');
        $this->form_validation->set_rules('tanggal_sk', 'tanggal_sk', 'trim|xss_clean');
        $this->form_validation->set_rules('no_akreditasi', 'no_akreditasi', 'trim|xss_clean');
        $this->form_validation->set_rules('nama_ketua', 'nama_ketua', 'trim|xss_clean');
        $this->form_validation->set_rules('nama_ketua_prodi', 'nama_ketua_prodi', 'trim|xss_clean');
        $this->form_validation->set_rules('tanggal_ttd', 'tanggal_ttd', 'trim|xss_clean');
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
                    redirect("baak/tugas_akhir/ta_d3/yudusium_add/".$periode);
                }  
                $result = ($result->data);
                

                $datas = array(
					'periode' => $periode,
                    'kode_prodi'=>$this->input->post('kode_prodi',TRUE),
                    'tanggal_penutupan'=>$this->input->post('tanggal_penutupan',TRUE),
                    'no_sk'=>$this->input->post('no_sk',TRUE),
                    'tanggal_sk'=>$this->input->post('tanggal_sk',TRUE),
                    'no_akreditasi'=>$this->input->post('no_akreditasi',TRUE),
                    'nama_ketua'=>$this->input->post('nama_ketua',TRUE),
                    'nama_ketua_prodi'=>$this->input->post('nama_ketua_prodi',TRUE),
                    'tanggal_ttd'=>$this->input->post('tanggal_ttd',TRUE),
					'id_rule' => $result->kode,
					'nam_rule' => $result->nama,
				);
                $this->Master_model->insert_query('yudisium',$datas);
                $text = $this->alert->success('Yudisium Create');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/tugas_akhir/ta_d3/list_yudusium/'.$periode));

            }else{
                $this->yudusium_add($periode);
            }
    }

    public function yudisium_edit($id,$periode){

        $data_masters=get_object_vars($this->Master_model->master_get(['id'=>$id],'v_yudisium'));
        if($data_masters){
            $this->header();
            $this->load->view('baak/tugas_akhir_d3/dashboard',
                [
                    'periode'=>$periode,
                ]
            );
    
    
            $this->load->model('form/Baak_f', 'baak_form');
            $data_master=$this->baak_form->yudisium_edit($id,$periode);
            
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
            $text = $this->alert->danger('id trx not found');
                    $this->session->set_flashdata('message', $text);
                    redirect("baak/tugas_akhir/ta_d3/yudusium_add/".$periode);
        }

       
    }

    public function yudisium_edit_action($id,$periode){
        $this->form_validation->set_rules('tanggal_penutupan', 'tanggal_penutupan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('no_sk', 'no_sk', 'trim|xss_clean');
        $this->form_validation->set_rules('tanggal_sk', 'tanggal_sk', 'trim|xss_clean');
        $this->form_validation->set_rules('no_akreditasi', 'no_akreditasi', 'trim|xss_clean');
        $this->form_validation->set_rules('nama_ketua', 'nama_ketua', 'trim|xss_clean');
        $this->form_validation->set_rules('nama_ketua_prodi', 'nama_ketua_prodi', 'trim|xss_clean');
        $this->form_validation->set_rules('tanggal_ttd', 'tanggal_ttd', 'trim|xss_clean');
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
                    redirect("baak/tugas_akhir/ta_d3/yudusium_add/".$periode);
                }
                $result = ($result->data);  

                $data_masters=get_object_vars($this->Master_model->master_get(['id'=>$id],'v_yudisium'));
                if(!$data_masters){
                    $text = $this->alert->danger('id trx not found');
                    $this->session->set_flashdata('message', $text);
                    redirect("baak/tugas_akhir/ta_d3/yudusium_add/".$periode);
                }

                $datas = array(
                    'tanggal_penutupan'=>$this->input->post('tanggal_penutupan',TRUE),
                    'no_sk'=>$this->input->post('no_sk',TRUE),
                    'tanggal_sk'=>$this->input->post('tanggal_sk',TRUE),
                    'no_akreditasi'=>$this->input->post('no_akreditasi',TRUE),
                    'nama_ketua'=>$this->input->post('nama_ketua',TRUE),
                    'nama_ketua_prodi'=>$this->input->post('nama_ketua_prodi',TRUE),
                    'tanggal_ttd'=>$this->input->post('tanggal_ttd',TRUE),
					'id_rule' => $result->kode,
					'nam_rule' => $result->nama,
				);
                $this->Master_model->update_query(['id'=>$id], $datas, 'yudisium');
                $text = $this->alert->success('Yudisium Update');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/tugas_akhir/ta_d3/list_yudusium/'.$periode));

            }else{
                    $this->yudisium_edit($id,$periode);
            }
    }

    public function yudisium_daftar($id_trx,$periode){
        $data_masters=$this->Master_model->master_get(['id'=>$id_trx],'yudisium');
        if(!$data_masters){
            $text = $this->alert->danger('Record not found');
            $this->session->set_flashdata('message', $text);
            redirect("baak/tugas_akhir/ta_d3/list_periode");
        }
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $this->header();
        $this->load->view('baak/tugas_akhir_d3/dashboard',
            [
                'periode'=>$periode,
            ]
        );

        $data_master=$this->baak_tabel->list_yudisium_daftar($id_trx,$data_masters);
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->footer();
    }

    public function json_list_yudisium_daftar($id_trx){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_yudisium_daftar($id_trx);
    }

    
    public function daftar_yudisium_action(){
        $this->form_validation->set_rules('id_trx', 'id_trx', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nim', 'nim', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required|xss_clean');
        $this->form_validation->set_rules('periode', 'periode', 'trim|xss_clean');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'trim|required|xss_clean');
        $this->form_validation->set_rules('handphone', 'handphone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('no_ijasah', 'no_ijasah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('no_transkrip', 'no_transkrip', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pin', 'pin', 'trim|required|xss_clean');
        $this->form_validation->set_rules('judul_indo', 'judul_indo', 'trim|required|xss_clean');
        $this->form_validation->set_rules('judul_ing', 'judul_ing', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ipk', 'ipk', 'trim|required|xss_clean');
        $this->form_validation->set_rules('total_sks', 'total_sks', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        if ( ($this->form_validation->run() == TRUE)   ) {
            $nim = ($this->input->post("nim",TRUE));
            $id_trx = ($this->input->post("id_trx",TRUE));
            $data_profile=array(
                'tanggal_lahir'=>$this->input->post('tanggal_lahir'),
                'tempat_lahir'=>$this->input->post('tempat_lahir'),
                'handphone'=>$this->input->post('handphone'),
            );
            $this->Master_model->update_query(['nim'=>$nim], $data_profile, 'mahasiswa_profile');
            $data_profile=array(
                'nama'=>$this->input->post('nama'),
            );
            $this->Master_model->update_query(['nim'=>$nim], $data_profile, 'mahasiswa');

                    $data=array(
                        
                        'judul_indo'=>$this->input->post('judul_indo'),
                        'judul_ing'=>$this->input->post('judul_ing'),
                        'pin'=>$this->input->post('pin'),
                        'no_ijasah'=>$this->input->post('no_ijasah'),
                        'total_sks_lulus'=>$this->input->post('total_sks'),
                        'ipk_lulus'=>$this->input->post('ipk'),
                        'progres'=>'disetujui',
                    );
                    $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'yudisium_mhs');

            $datas = json_decode($this->input->post("datas",TRUE));
            
            $data_singel=array();
					$array_multi=array();
					$total_sks=0;
					$total_e=0;
					$total_d=0;
					$user_info=$this->Master_model->user_cek_ident();
					$i=-1;
					foreach($datas as $row){

						/*if( $row->value==''){
							$array_multi=null;
							break; 
						}*/

						if($row->name=='kode_mk' && $row->value){                             
							array_push($array_multi,$data_singel);
							$data_singel=array();

							$data=array(
								'nim'=>$nim,
								'last_edit_info'=>$user_info
							);
							$data_singel=$data_singel+$data;
							
						}
						if($row->name=='sks_mk'){
							$total_sks=$total_sks+$row->value;
						}
						if($row->name=='grade' && $row->value=='E' ){
							$total_e=$total_e+1;
						}
						if($row->name=='grade' && $row->value=='D' ){
							$total_d=$total_d+1;
						}
						$data=array(
							$row->name=>$row->value
						);
						$data_singel=$data_singel+$data;
					}
                    array_push($array_multi,$data_singel);

                    if($array_multi  && $total_e==0 ){
                    // if($array_multi && $total_sks>=140 && $total_e==0 ){
						unset($array_multi[0]);

					$this->Master_model->delete_query(['nim'=>$nim], 'transkip_nilai');
					$this->Master_model->insert_batch_query('transkip_nilai',$array_multi);
					$kembali='Data successfully add';
					$data=array(
						'status'=>'200',
						'error'=>false,
						'message'=>$kembali
					);
					echo json_encode($data);
					//print_r(($array_multi));
					}else{
						$text='';
						if($total_sks<144){
							$text=$text.'SKS Kurang kurang dari 144,';
						}
						if($total_e==0 or $total_d<2){
							$text=$text.'Huruf mutu tidak memenuhi syarat,';
						}
						$kembali='Data not valid. ('.$text.')';
						$data=array(
							'status'=>'502',
							'error'=>false,
							'message'=>$kembali
						);
						echo json_encode($data);
					}

          
        }else{
            
            $kembali='Data cannot be null.'.validation_errors();
						$data=array(
							'status'=>'502',
							'error'=>false,
							'message'=>$kembali
						);
						echo json_encode($data);
        }

        // $datas = json_decode($this->input->post("datas",TRUE));
        // $nim = ($this->input->post("nim",TRUE));
        // $periode = ($this->input->post("periode",TRUE));
        // $tanggal_lahir = ($this->input->post("tanggal_lahir",TRUE));
        // $tempat_lahir = ($this->input->post("tempat_lahir",TRUE));
        // $jenis_kelamin = ($this->input->post("jenis_kelamin",TRUE));
        // $handphone = ($this->input->post("handphone",TRUE));
        // $no_ijasah = ($this->input->post("no_ijasah",TRUE));
        // $no_transkrip = ($this->input->post("no_transkrip",TRUE));
        // $pin = ($this->input->post("pin",TRUE));
        // $judul_indo = ($this->input->post("judul_indo",TRUE));
        // $judul_ing = ($this->input->post("judul_ing",TRUE));


    }

    public function daftar_yudisium($id_trx,$periode){

        $data_master=$this->Baak_model->daftar_yudisium($id_trx);
        $transkript=$this->Baak_model->transkript($data_master->nim);
        
		if(!$data_master){
			$text = $this->alert->danger('data yudisium not found');
			$this->session->set_flashdata('message', $text);
			redirect("baak/tugas_akhir/ta_d3/list_periode");
		}

		if(!$transkript){
			$text = $this->alert->danger('Transkript not found');
			$this->session->set_flashdata('message', $text);
			redirect("baak/tugas_akhir/ta_d3/yudisium_daftar/".$data_master->id_yudisium.'/'.$periode);
		}

		$this->header();
        $this->load->view('baak/daftar_yudisium',
            [
                'data_master'=>$data_master,
                'transkript'=>$transkript,
                'id_trx'=>$id_trx,
                'periode'=>$periode,
                'id_yudisium'=>$data_master->id_yudisium,
            ]
        );
		$this->footer();
    }

    public function delete_rule($id){
        $data_file = $this->Master_model->master_get(['id_trx'=>$id], 'ta_d3_rule');
        if($data_file){
            $this->Master_model->delete_query(['id_trx'=> $id],'ta_d3_rule');

            $text = $this->alert->warning('Data successfully Delete');
				$this->session->set_flashdata('message', $text);
				redirect("baak/tugas_akhir/ta_d3/periode_rule/".$data_file->periode);
        }else{
            $text = $this->alert->warning('TRX not found');
				$this->session->set_flashdata('message', $text);
				redirect("baak/tugas_akhir/ta_d3/list_periode");
        }
    }

   
   

}

