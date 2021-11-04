<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frs extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
        $this->load->model('Baak_model');

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('frs_baak',$level,$action);
        if($access==0){
            $text = $this->alert->danger('You do not have access');
			$this->session->set_flashdata('message', $text);
			redirect("welcome/dashboard");
		}
	}

	public function cek_akses($action){
        $level=$this->session->userdata('role');
        $access = $this->Master_model->cek_akses('frs_baak',$level,$action);
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
	
	public function list_ta()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_ta();

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
    
    public function set_frs()
	{
        $this->cek_akses('put');
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->set_frs();
        $data_masters=get_object_vars($this->Baak_model->master_get_set_frs());

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

    public function set_input_nilai()
	{
        $this->cek_akses('put');
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->set_input_nilai();
        $data_masters=get_object_vars($this->Baak_model->master_get_set_input_nilai());

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

    public function set_input_nilai_update()
	{
        $this->cek_akses('put');
        $this->form_validation->set_rules('id_periode', 'id_periode', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pengisian_frs', 'pengisian_frs', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tgl_pengisian', 'tgl_pengisian', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tgl_penutupan', 'tgl_penutupan', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ( ($this->form_validation->run() == TRUE)   ) {
            $data = array(
                'id_periode' => $this->input->post('id_periode',TRUE),
                'pengisian_frs' => $this->input->post('pengisian_frs',TRUE),
                'tgl_pengisian' => $this->input->post('tgl_pengisian',TRUE),
                'tgl_penutupan' => $this->input->post('tgl_penutupan',TRUE),
                'last_edit' => date('Y-m-d'),
                'user_edit' => $this->session->userdata('username'),
            );
            $this->Master_model->update_query(['id'=>'1'], $data, 'frs_set');
            log_message('info', 'Update - data to input_nilai_set, data :');
            
            $text = $this->alert->success('Data successfully update');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/frs/set_input_nilai/'));
        }else{
            $this->connector();
        }
        
    }

    public function set_frs_update()
	{
        $this->cek_akses('put');
        $this->form_validation->set_rules('id_periode', 'id_periode', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pengisian_frs', 'pengisian_frs', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tgl_pengisian', 'tgl_pengisian', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tgl_penutupan', 'tgl_penutupan', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ( ($this->form_validation->run() == TRUE)   ) {
            $data = array(
                'id_periode' => $this->input->post('id_periode',TRUE),
                'pengisian_frs' => $this->input->post('pengisian_frs',TRUE),
                'tgl_pengisian' => $this->input->post('tgl_pengisian',TRUE),
                'tgl_penutupan' => $this->input->post('tgl_penutupan',TRUE),
                'last_edit' => date('Y-m-d'),
                'user_edit' => $this->session->userdata('username'),
            );
            $this->Master_model->update_query(['id'=>'0'], $data, 'frs_set');
            log_message('info', 'Update - data to frs_set, data :');
            
            $text = $this->alert->success('Data successfully update');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/frs/set_frs/'));
        }else{
            $this->connector();
        }
        
    }
    
    public function list_pengisian_frs_mhs()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_pengisian_frs_mhs();

        //print_r($data_master);
        $this->header();
        
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->list_pengisian_frs_mhs_filter('mhs');
		
		$this->load->view('master/master_filter',
			[
				'data_detail'=>$data_master['form_detail'],
				'data_isi'=>$data_master['data_isi'],
				'data_filter'=>$this->session->userdata('frs_filter')['id_periode_masuk'],
				'kode_prodi'=>$this->session->userdata('frs_filter')['kode_prodi']
				// 'data_master'=>$data_masters,
            ]);
            
		$this->footer();	
    }

    public function list_pengisian_frs_mk()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_pengisian_frs_mk();

        //print_r($data_master);
        $this->header();
        
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->list_pengisian_frs_mhs_filter('mk');
		
		$this->load->view('master/master_filter',
			[
				'data_detail'=>$data_master['form_detail'],
				'data_isi'=>$data_master['data_isi'],
				'data_filter'=>$this->session->userdata('frs_filter')['id_periode_masuk']
				// 'data_master'=>$data_masters,
            ]);
            
		$this->footer();	
    }

    public function set_kurikulum($report=null)
	{
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        if($report){
            if($this->session->userdata('set_periode')['periode']){
                $data_masters['id_periode']=$this->session->userdata('set_periode')['periode'];
            }else{
                $text = $this->alert->danger('Select Periode');
                $this->session->set_flashdata('message', $text);
                redirect('baak/pembelajaran/set_periode/', 'refresh');
            }
            
        }else{
            $data_masters=get_object_vars($this->Baak_model->master_get_set_frs());
            
        }
        
        
        $data_master=$this->baak_tabel->set_kurikulum($data_masters['id_periode'],$report);

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

    public function list_pengisian_frs_prodi()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_pengisian_frs_prodi();

        //print_r($data_master);
        $this->header();
        
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );

        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->list_pengisian_frs_mhs_filter('prodi');
		
		$this->load->view('master/master_filter',
			[
				'data_detail'=>$data_master['form_detail'],
				'data_isi'=>$data_master['data_isi'],
				'data_filter'=>$this->session->userdata('frs_filter')['id_periode_masuk']
				// 'data_master'=>$data_masters,
            ]);
            
		$this->footer();	
    }

    public function filter($link){
		$id_periode_masuk=$this->input->post('id_periode_masuk',TRUE);
		$kode_prodi=$this->input->post('kode_prodi',TRUE);
		$this->session->set_userdata(
			array(
				'frs_filter' => array(
					'id_periode_masuk'=>$id_periode_masuk,	
					'kode_prodi'=>$kode_prodi,	
				)
			)
        );
        if($link=='mhs'){
            redirect('baak/frs/list_pengisian_frs_mhs/', 'refresh');
        }else 
        if($link=='mk'){
            redirect('baak/frs/list_pengisian_frs_mk/', 'refresh');
        }else 
        if($link=='prodi'){
            redirect('baak/frs/list_pengisian_frs_prodi/', 'refresh');
        }
		
    }
    
    public function plot_set_kurikulum_action($id_kurikulum,$periode){
        $duallistbox_demo1=$this->input->post('duallistbox_demo2',TRUE);
		$data=array();
		$data_tmp=array();
		if($duallistbox_demo1){
			foreach($duallistbox_demo1 as $row){
				$data_tmp=array(
					'id_matkul'=>$row,
					'periode'=>$periode,
					'id_kurikulum'=>$id_kurikulum,
				);
				array_push($data,$data_tmp);
	
			}
			//print_r($data);
			
		}
		$this->Baak_model->plot_set_kurikulum_action($id_kurikulum,$periode,$data);
		
		print_r($data);
    }

    public function plot_set_kurikulum($id_kurikulum,$periode){
        
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->Baak_model->plot_set_kurikulum($id_kurikulum,$periode);

        //print_r($data_master);
        $this->header();
        $this->load->view('baak/plot_set_kurikulum',[
			'data_master'=>$data_master,
			'id_kurikulum'=>$id_kurikulum,
			'action'=>base_url('baak/frs/plot_set_kurikulum_action/'.$id_kurikulum.'/'.$periode),
			'periode'=>$periode
		]);
		$this->footer();
		
    }
    
    public function jadwal_dosen($id_kurikulum,$periode,$report=null)
	{
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        // $data_master=$this->Baak_model->kurikulum_saji($id_kurikulum,$periode);
        // print_r($data_master);
        $data_master=$this->baak_tabel->jadwal_dosen($id_kurikulum,$periode,$report);

        // //print_r($data_master);
        $this->header();
        
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
            
		$this->footer();	
    }

    public function jadwal_dosen_all($periode)
	{
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        // $data_master=$this->Baak_model->kurikulum_saji($id_kurikulum,$periode);
        // print_r($data_master);
        $data_master=$this->baak_tabel->jadwal_dosen_all($periode);

        // //print_r($data_master);
        $this->header();
        
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
            
		$this->footer();	
    }

    public function plot_jadwal_dosen($id_trx)
	{
        
        // $kurikulum=($this->Baak_model->mahasiswa_list_kurikulum($nim));
        $master_saji=$this->Baak_model->master_matakuliah_saji($id_trx);
        $master_jadwal=$this->Baak_model->master_matakuliah_jadwal($master_saji[0]->id_matkul,$master_saji[0]->periode);
        //print_r($master_jadwal);
        $this->header();
        $this->load->view('baak/plot_jadwal_dosen',
            [
                'master_saji'=>$master_saji[0],
                'id_trx'=>$id_trx,
                'master_jadwal'=>$master_jadwal
            ]
        );
        $this->footer();
    }


    public function master_jadwal_dosen_edit($id_trx)
	{
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->master_jadwal_dosen_edit($id_trx);
        $master_saji=get_object_vars($this->Baak_model->master_matakuliah_saji($id_trx)[0]);
        // print_r($master_saji);
		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>$master_saji,
                'status'=>'update',
            ]
        );
		$this->footer();
		
    }

    public function master_jadwal_dosen_edit_action($id_trx)
	{
        $this->form_validation->set_rules('dosen', 'dosen', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bahasan', 'bahasan', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        $master_saji=$this->Baak_model->master_matakuliah_saji($id_trx);
        if($master_saji){
            if ( ($this->form_validation->run() == TRUE)   ) {
                $data = array(
                    'bahasan' => $this->input->post('bahasan',TRUE),
                    'id_dosen_pengampu' => $this->input->post('dosen',TRUE),
                );
                $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'mata_kuliah_saji');
                log_message('info', 'Update - data to frs_set, data :'.json_encode($data));
                
                $text = $this->alert->success('Data successfully update');
                $this->session->set_flashdata('message', $text);
                redirect(site_url('baak/frs/plot_jadwal_dosen/'.$id_trx));
            }else{
                $this->master_jadwal_dosen_edit($id_trx);
            }
        }else{
            $text = $this->alert->danger('Data Not Found');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/frs/set_kurikulum/'));
        }
    }

    public function plot_jadwal_dosen_add($id_trx)
	{
        $this->load->model('form/Baak_f', 'baak_form');

        $master_saji=get_object_vars($this->Baak_model->master_matakuliah_saji($id_trx)[0]);
        $data_master=$this->baak_form->plot_jadwal_dosen_add($id_trx,$master_saji);
        
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

    public function plot_jadwal_dosen_edit($id_trx)
	{
        $this->load->model('form/Baak_f', 'baak_form');

        $master_saji=get_object_vars($this->Baak_model->jadwal_dosen($id_trx));
        //print_r($master_saji);
        $data_master=$this->baak_form->plot_jadwal_dosen_edit($id_trx,$master_saji);
        
        // print_r($master_saji);
		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>$master_saji,
                'status'=>'update',
            ]
        );
		$this->footer();
		
    }
    
    public function plot_jadwal_dosen_delete($id_trx_jadwal,$trx)
	{
        $master_saji=get_object_vars($this->Baak_model->jadwal_dosen($id_trx_jadwal));
        if($master_saji){   
            $this->Master_model->delete_query(['id_trx_jadwal' => $id_trx_jadwal],'mata_kuliah_jadwal');
            $text = $this->alert->success('success Hapus Data Dosen');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('baak/frs/plot_jadwal_dosen/'.$trx));

        }else{
            $text = $this->alert->danger('Data Not Found');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('baak/frs/set_kurikulum/'));
        }  
		
    }


    public function plot_jadwal_dosen_edit_action($id_trx)
	{
        $this->form_validation->set_rules('id_dosen', 'id_dosen', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ruang', 'ruang', 'trim|required|xss_clean');
        $this->form_validation->set_rules('hari', 'hari', 'trim|required|xss_clean');
        $this->form_validation->set_rules('waktu', 'waktu', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        $master_saji=$this->Baak_model->jadwal_dosen($id_trx);
        if($master_saji){
            if ( ($this->form_validation->run() == TRUE)   ) {
               
                    $data = array(
                        'id_dosen' => $this->input->post('id_dosen',TRUE),
                        'ruang' => $this->input->post('ruang',TRUE),
                        'waktu' => $this->input->post('waktu',TRUE),
                        'hari' => $this->input->post('hari',TRUE),
                    );
                    //print_r($data);
                   
                    $this->Master_model->update_query(['id_trx_jadwal'=>$id_trx], $data, 'mata_kuliah_jadwal');//insert_query('mata_kuliah_jadwal',$data);
                    log_message('info', 'Update - data to frs_set, data :'.json_encode($data));
                   
                    $redirect=$this->Master_model->master_get(['id_matkul'=> $master_saji->id_matkul,'periode'=> $master_saji->periode ],'mata_kuliah_saji');//insert_query('mata_kuliah_jadwal',$data);
                   //echo $redirect->id_trx;
                    $text = $this->alert->success('Data successfully Edit');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/frs/plot_jadwal_dosen/'.$redirect->id_trx));

               
            }else{
                $this->plot_jadwal_dosen_edit($id_trx);
            }
        }else{
            $text = $this->alert->danger('Data Not Found');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/frs/set_kurikulum/'));
        }
    }

    public function plot_jadwal_dosen_add_action($id_trx)
	{
        $this->form_validation->set_rules('dosen', 'dosen', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kelas', 'kelas', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ruang', 'ruang', 'trim|required|xss_clean');
        $this->form_validation->set_rules('hari', 'hari', 'trim|required|xss_clean');
        $this->form_validation->set_rules('waktu', 'waktu', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        $master_saji=$this->Baak_model->master_matakuliah_saji($id_trx);
        if($master_saji){
            if ( ($this->form_validation->run() == TRUE)   ) {
                $where_=array(
                    'id_matkul' => $master_saji[0]->id_matkul,
                    'periode' => $master_saji[0]->periode,
                    'id_kelas' => $this->input->post('kelas',TRUE),
                );
                $cek_=$this->Master_model->master_get($where_,'mata_kuliah_jadwal');
                if($cek_){
                    $text = $this->alert->danger('data already exists');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/frs/plot_jadwal_dosen_add/'.$id_trx));
                }else{
                    $data = array(
                        'id_matkul' => $master_saji[0]->id_matkul,
                        'periode' => $master_saji[0]->periode,
                        'id_dosen' => $this->input->post('dosen',TRUE),
                        'id_kelas' => $this->input->post('kelas',TRUE),
                        'ruang' => $this->input->post('ruang',TRUE),
                        'waktu' => $this->input->post('waktu',TRUE),
                        'hari' => $this->input->post('hari',TRUE),
                    );
                    //print_r($data);
                   
                    $this->Master_model->insert_query('mata_kuliah_jadwal',$data);
                    log_message('info', 'Update - data to frs_set, data :'.json_encode($data));
                    
                    $text = $this->alert->success('Data successfully Add');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/frs/plot_jadwal_dosen/'.$id_trx));

                }
               
            }else{
                $this->plot_jadwal_dosen_add($id_trx);
            }
        }else{
            $text = $this->alert->danger('Data Not Found');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/frs/set_kurikulum/'));
        }
    }

    public function peserta_kelas($id_trx)
	{
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        // $data_master=$this->Baak_model->kurikulum_saji($id_kurikulum,$periode);
        // print_r($data_master);
        $data_master=$this->baak_tabel->peserta_kelas($id_trx);

        // //print_r($data_master);
        $this->header();
        
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
            
		$this->footer();	
    }

    public function kehadiran_mahasiswa_report_mk($id_matkul,$periode){
        $cek_=$this->Master_model->master_get(['id_matkul'=>$id_matkul,'periode'=>$periode],'mata_kuliah_saji');
        if($cek_->id_trx){
            redirect(site_url('baak/frs/kehadiran_mahasiswa_report/'.$cek_->id_trx));
        }else{
            $text = $this->alert->danger('Jadwal Not Found');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/frs/list_pengisian_frs_mk/'));
        }
        
    }

    public function kehadiran_mahasiswa_report($id_trx)
	{
        $this->load->model('tabel/Dosen_t', 'dosen_tabel');
        $cek_=$this->Master_model->master_get(['id_trx'=>$id_trx],'mata_kuliah_saji');
        $cek_=$this->Master_model->master_get(['id_matkul'=>$cek_->id_matkul,'periode'=>$cek_->periode],'v_jadwal');
        if(!$cek_){
                    $text = $this->alert->danger('Record not found');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/frs/set_kurikulum/'));
        }
        $data_master=$this->dosen_tabel->presensi_mahasiswa_pertemuan_report($cek_);

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

    public function kehadiran_mahasiswa_report_jadwal($id_trx_jadwal)
	{
        $this->load->model('tabel/Dosen_t', 'dosen_tabel');
        $cek_=$this->Master_model->master_get(['id_trx_jadwal'=>$id_trx_jadwal],'v_jadwal');
        $cek_=$this->Master_model->master_get(['id_matkul'=>$cek_->id_matkul,'periode'=>$cek_->periode],'v_jadwal');
        if(!$cek_){
                    $text = $this->alert->danger('Record not found');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/frs/set_kurikulum/'));
        }
        $data_master=$this->dosen_tabel->presensi_mahasiswa_pertemuan_report($cek_);

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

    public function nilai_mahasiswa_report($id_trx){
        $this->load->model('Dosen_model');
        $cek_=$this->Master_model->master_get(['id_trx'=>$id_trx],'v_mata_kuliah_saji');
        if($cek_){
            $v_jadwal=$this->Master_model->master_get(['id_matkul'=>$cek_->id_matkul,'periode'=>$cek_->periode,'kode_prodi'=>$cek_->kode_prodi],'v_jadwal');

            $cek_s=$this->Master_model->master_result(['id_matkul'=>$cek_->id_matkul,'periode'=>$cek_->periode,'kode_prodi'=>$cek_->kode_prodi],'nilai_komponen');
            $nilai_skala=$this->Master_model->master_result_order_asc(['periode'=>$cek_->periode,'kode_prodi'=>$cek_->kode_prodi],'nilai_skala','nilai_index');
            $coloum='';
            foreach($cek_s as $rows){
                $coloum=$coloum.'MAX(case when id_komponen = '.$rows['id'].' then nilai END) '.$rows['komponen'].', ';
            }
            $list_mhs=$this->Dosen_model->report_nilai($cek_,$coloum);
           
            $this->header();
            $this->load->view('dosen/report_nilai',
                [
                    'nilai_komponen'=>$cek_s,
                    'list_mhs'=>$list_mhs,
                    'id_trx'=>$v_jadwal->id_trx_jadwal,
                    'cek_'=>$v_jadwal,
                    'nilai_skala'=>$nilai_skala

                ]
            );
            $this->footer();
        }else{
            $text = $this->alert->success('Record not found');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('dosen/perkuliahan/input_nilai'));
        }
    }

    public function nilai_mahasiswa_report_jadwal($id_trx_jadwal){
        $this->load->model('Dosen_model');
        $cek_=$this->Master_model->master_get(['id_trx_jadwal'=>$id_trx_jadwal],'v_jadwal');
        if($cek_){

            $cek_s=$this->Master_model->master_result(['id_matkul'=>$cek_->id_matkul,'periode'=>$cek_->periode,'kode_prodi'=>$cek_->kode_prodi],'nilai_komponen');
            $nilai_skala=$this->Master_model->master_result_order_asc(['periode'=>$cek_->periode,'kode_prodi'=>$cek_->kode_prodi],'nilai_skala','nilai_index');
            $coloum='';
            foreach($cek_s as $rows){
                $coloum=$coloum.'MAX(case when id_komponen = '.$rows['id'].' then nilai END) '.$rows['komponen'].', ';
            }
            $list_mhs=$this->Dosen_model->report_nilai($cek_,$coloum);
           
            $this->header();
            $this->load->view('dosen/report_nilai',
                [
                    'nilai_komponen'=>$cek_s,
                    'list_mhs'=>$list_mhs,
                    'id_trx'=>$id_trx_jadwal,
                    'cek_'=>$cek_,
                    'nilai_skala'=>$nilai_skala

                ]
            );
            $this->footer();
        }else{
            $text = $this->alert->success('Record not found');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('dosen/perkuliahan/input_nilai'));
        }
    }



}
