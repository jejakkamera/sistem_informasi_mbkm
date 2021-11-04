<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelajaran extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
		$this->load->model('Baak_model');

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
    
	public function set_periode(){
        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->set_periode();

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

    public function set_periode_action(){
        $this->form_validation->set_rules('id_periode', 'id_periode', 'trim|required|xss_clean');
        if(($this->form_validation->run() == TRUE)){
            $id_periode=$this->input->post('id_periode',TRUE);
            $this->session->set_userdata(
                array(
                    'set_periode' => array(
                        'periode'=>$id_periode,	
                    )
                )
            );
            $text = $this->alert->success('Periode Set');
            $this->session->set_flashdata('message', $text);
            redirect('baak/pembelajaran/set_periode/', 'refresh');
        }else{
            $text = $this->alert->danger('Error');
            $this->session->set_flashdata('message', $text);
            redirect('baak/pembelajaran/set_periode/', 'refresh');
        }
    }

    public function presensi_dosen_list_prodi(){
        if($this->session->userdata('set_periode')['periode']){
            $this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->prodi_presensi_dosen();

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
        }else{
            $text = $this->alert->danger('Select Periode');
            $this->session->set_flashdata('message', $text);
            redirect('baak/pembelajaran/set_periode/', 'refresh');
        }
    }

	public function presensi_jadwal_prodi($kode_prodi){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->presensi_jadwal_prodi($kode_prodi);

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

	public function presensi_dosen_list($id_trx_jadwal){
        $cek_=$this->Master_model->master_get(['id_trx_jadwal'=>$id_trx_jadwal],'v_jadwal');
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->presensi_dosen_list($id_trx_jadwal,$cek_);

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

    public function presensi_dosen_add($id_trx)
	{
        $this->load->model('form/Dosen_f', 'dosen_form');
        $cek_=$this->Master_model->master_get(['id_trx_jadwal'=>$id_trx],'v_jadwal');
        $data_master=$this->dosen_form->presensi_dosen_add($id_trx,$cek_);

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

    public function presensi_dosen_add_action($id){
        $this->form_validation->set_rules('tanggal_masuk', 'tanggal_masuk', 'trim|required|xss_clean');
        $this->form_validation->set_rules('materi', 'materi', 'trim|required|xss_clean');
        $this->form_validation->set_rules('methode', 'methode', 'trim|required|xss_clean');
        $cek_=$this->Master_model->master_get(['id_trx_jadwal'=>$id],'mata_kuliah_jadwal');
        if($cek_){
            if(($this->form_validation->run() == TRUE)){
                $this->load->model('Dosen_model');
                    $cek_presensi=$this->Dosen_model->last_presensi_dosen($id);
                    $pertemuan=$cek_presensi->pertemuan+1;
                    if($pertemuan>15){
                        $text = $this->alert->danger('Maximal transaksi pertemuan 14.');
                        $this->session->set_flashdata('message', $text);
                        redirect(site_url('baak/pembelajaran/presensi_dosen_list/'.$id));
                    }
                    // echo $pertemuan;
                    $data=array(
                        'id_trx_jadwal'=>$id,
                        'id_matkul'=>$cek_presensi->id_matkul,
                        'periode'=>$cek_presensi->periode,
                        'id_kelas'=>$cek_presensi->id_kelas,
                        'pertemuan'=>$pertemuan,
                        'email'=>$this->session->userdata('username'),
                        'tanggal_masuk'=>$this->input->post('tanggal_masuk',TRUE),
                        'materi'=>$this->input->post('materi',TRUE),
                        'methode'=>$this->input->post('methode',TRUE),
                    );
                    // print_r($data);
                    $this->Master_model->insert_query('presensi_dosen',$data);
                    
                    $text = $this->alert->success('Data successfully Add');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/pembelajaran/presensi_dosen_list/'.$id));
            }else{
                $this->presensi_dosen_add($id_trx);
            }
        }else{
                $text = $this->alert->danger('Record Not Found');
				$this->session->set_flashdata('message', $text);
                redirect(site_url('baak/pembelajaran/presensi_dosen_list/'.$id));
        }
    }

    public function presensi_mahasiswa_list_prodi(){
        if($this->session->userdata('set_periode')['periode']){

            $this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->prodi_presensi_mahasiswa();

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
        }else{
            $text = $this->alert->danger('Select Periode');
            $this->session->set_flashdata('message', $text);
            redirect('baak/pembelajaran/set_periode/', 'refresh');
        }
    }

    public function presensi_matakuliah_prodi($kode_prodi){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->presensi_matakuliah_prodi($kode_prodi);

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

    public function presensi_mahasiswa_list($id_trx){
        $this->load->model('tabel/Dosen_t', 'dosen_tabel');
        $cek_=$this->Master_model->master_get(['id_trx_jadwal'=>$id_trx],'v_jadwal');
        if(!$cek_){
                    $text = $this->alert->danger('Record not found');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/pembelajaran/presensi_mahasiswa_list_prodi'));
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

    public function rekap_presensi_dosen(){
        if($this->session->userdata('set_periode')['periode']){
            $this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->rekap_presensi_dosen();

                //print_r($data_master);
                $this->header();
            
                $this->load->view('master/master_list',
                    [
                        'data_detail'=>$data_master['data_detail'],
                        'data_isi'=>$data_master['data_isi'],
                    ]
                );
                $this->footer();
        }else{
            $text = $this->alert->danger('Select Periode');
            $this->session->set_flashdata('message', $text);
            redirect('baak/pembelajaran/set_periode/', 'refresh');
        }
    }

    public function rekap_presensi_dosen_detail($id_rekap){
    $this->load->model('tabel/Baak_t', 'baak_tabel');
    $data_master=$this->baak_tabel->rekap_presensi_dosen_detail($id_rekap);

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

    public function json_rekap_presensi_dosen_detail_akademik($id_rekap){
    $this->load->model('tabel/Baak_t', 'baak_tabel');
    $data_master=$this->baak_tabel->json_rekap_presensi_dosen_detail_akademik($id_rekap);

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

    public function json_rekap_presensi_dosen_detail_keuangan($id_rekap){
    $this->load->model('tabel/Baak_t', 'baak_tabel');
    $data_master=$this->baak_tabel->json_rekap_presensi_dosen_detail_keuangan($id_rekap);

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

    public function rekap_presensi_dosen_add()
	{
        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->rekap_presensi_dosen_add();

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

    public function rekap_presensi_dosen_add_action(){
        $this->form_validation->set_rules('tanggal_akhir', 'tanggal_akhir', 'trim|required|xss_clean');
        $this->form_validation->set_rules('minggu', 'minggu', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nama_rekap', 'nama_rekap', 'trim|required|xss_clean');

            if(($this->form_validation->run() == TRUE)){
                $id_rekap = preg_replace("/[^A-Za-z0-9.]/", '', $this->input->post('nama_rekap',TRUE));
                $id_rekap = $id_rekap."_".date('Ymdhis');
                $periode=$this->Baak_model->json_id_periode_aktif('');
                    $data=array(
                        'tanggal_akhir'=>$this->input->post('tanggal_akhir',TRUE),
                        'minggu'=>$this->input->post('minggu',TRUE),
                        'nama_rekap'=>$this->input->post('nama_rekap',TRUE),
                        'id_rekap'=>$id_rekap,
                        'periode'=>$periode->kode,
                    );
                    $this->Master_model->insert_query('rekap_presensi_dosen',$data);
                    $periode=$this->Baak_model->rekap_presensi_dosen_add_action($id_rekap,$this->input->post('tanggal_akhir',TRUE));

                    $text = $this->alert->success('Data successfully Add');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/pembelajaran/rekap_presensi_dosen/'));
            }else{
                $this->rekap_presensi_dosen_add();
            }
    }

    public function rekap_aktivitas_mahasiswa(){
        if($this->session->userdata('set_periode')['periode']){

            $where=array(
                'aktivitas_perkuliahan_siakad.id_periode'=>$this->session->userdata('set_periode')['periode']
            );
            $list_aktivitas_mahasiswa=$this->Baak_model->list_aktivitas_mahasiswa($where);
            $rekap_aktivitas=$this->Baak_model->rekap_aktivitas_mahasiswa($where);
            // print_r($rekap_aktivitas);
            $this->header();
            
            $this->load->view('baak/rekap_aktivitas_mahasiswa',
                [
                    'list_aktivitas_mahasiswa'=>$list_aktivitas_mahasiswa,
                    'rekap_aktivitas'=>$rekap_aktivitas,
                    'periode'=>$this->session->userdata('set_periode')['periode'],
                ]
            );
            //$this->load->view('baak/mahasiswa_filter');
            $this->footer();

        }else{
            $text = $this->alert->danger('Select Periode');
            $this->session->set_flashdata('message', $text);
            redirect('baak/pembelajaran/set_periode/', 'refresh');
        }
    }

    public function presensi_dosen_delete($id){
        $cek_=$this->Master_model->master_get(['id'=>$id],'presensi_dosen');
        if($cek_){
            $cek_s=$this->Master_model->master_get(['id_trx_absen'=>$id],'rekap_presensi_dosen_detail');
            if($cek_s){
                $text = $this->alert->danger('Error : Cannot Delete, TRX has recapitulated');
                $this->session->set_flashdata('message', $text);
                redirect(site_url('baak/pembelajaran/presensi_dosen_list/'.$cek_->id_trx_jadwal));
            }else{
                    $data_history=json_encode($cek_);
                    log_message('info', 'Delete - data to presensi dosen, data :'.$data_history);
                    $this->Master_model->insert_history('delete','presensi_dosen',json_encode($cek_) );
                    
                    $this->Master_model->delete_query(['id' => $id],'presensi_dosen');
                    $text = $this->alert->success('Data Successfully Delete');
                    $this->session->set_flashdata('message', $text);
                    redirect(site_url('baak/pembelajaran/presensi_dosen_list/'.$cek_->id_trx_jadwal));
            }
        }else{
            $text = $this->alert->danger('TRX not found');
            $this->session->set_flashdata('message', $text);
            redirect('baak/pembelajaran/presensi_dosen_list_prodi', 'refresh');
        }
    }

    public function rekap_administrasi_mahasiswa(){
        if($this->session->userdata('set_periode')['periode']){
            $this->url=url_siku;
            $this->output->set_header('Access-Control-Allow-Origin: *');
            $url =$this->url.'api/report_tunggakan_mahasiswa/'.$this->session->userdata('set_periode')['periode'];

            $data = array('key' => key_siku );
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
                            
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $result =  json_decode($result);
            $this->header();
            
            $this->load->view('baak/rekap_administrasi_mahasiswa',
                [
                    'list_aktivitas_mahasiswa'=>$result->data,
                    'periode'=>$this->session->userdata('set_periode')['periode'],
                ]
            );
            $this->footer();

        }else{
            $text = $this->alert->danger('Select Periode');
            $this->session->set_flashdata('message', $text);
            redirect('baak/pembelajaran/set_periode/', 'refresh');
        }
    }
    
}