<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');

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

	public function index()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->prodi();

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
	
	public function kurikulum()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->kurikulum();

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
    
    public function set_update_kurikulum($id){
        $this->form_validation->set_rules('nama_kurikulum','nama_kurikulum','xss_clean|required');

        if(($this->form_validation->run() == TRUE)){
            $data = array(
                'nama_kurikulum' => $this->input->post('nama_kurikulum',TRUE),
            );
            $this->Master_model->update_query(['id_kurikulum'=>$id], $data, 'kurikulum');
            $text = $this->alert->success('Data successfully update');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/matakuliah/kurikulum'));
        }
    }
	
	public function kurikulum_matakuliah($id)
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
		$data_kurikulum=$this->Master_model->master_get(['id_kurikulum'=>$id],'v_kurikulum');
        $data_master=$this->baak_tabel->kurikulum_matakuliah($data_kurikulum);

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

    public function update_kurikulum($id){
        
        $this->load->model('form/kurikulum_f', 'kurikulum_form');

        $data_master=$this->kurikulum_form->kurikulum_update($id);
        $data_masters=get_object_vars($this->Master_model->master_get(['id_kurikulum' => $id],'kurikulum'));

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

    public function set_update_prodi($id){
        var_dump($this->input->post());
    }


    public function update_matakuliah($id){
        
        $this->load->model('form/matakuliah_f', 'matakuliah_form');

        $data_master=$this->matakuliah_form->matakuliah_update($id);
        $data_masters=get_object_vars($this->Master_model->master_get(['id_matkul' => $id],'mata_kuliah'));

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

    public function set_update_matakuliah($id){
        $this->form_validation->set_rules('kode_mata_kuliah','kode_mata_kuliah','xss_clean|required');
        $this->form_validation->set_rules('nama_mata_kuliah','nama_mata_kuliah','xss_clean|required');
        $this->form_validation->set_rules('nama_mata_kuliah_ing','nama_mata_kuliah_ing','xss_clean');
        $this->form_validation->set_rules('id_matkul_prasyarat','id_matkul_prasyarat','xss_clean');

        if(($this->form_validation->run() == TRUE)){
            $data = array(
                'kode_mata_kuliah' => $this->input->post('kode_mata_kuliah',TRUE),
                'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah',TRUE),
                'nama_mata_kuliah_ing' => $this->input->post('nama_mata_kuliah_ing',TRUE),
                'id_matkul_prasyarat' => $this->input->post('id_matkul_prasyarat',TRUE),

            );
            $this->Master_model->update_query(['id_matkul'=>$id], $data, 'mata_kuliah');
            $text = $this->alert->success('Data successfully update');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/matakuliah/kurikulum'));
        }
    }
    


}
