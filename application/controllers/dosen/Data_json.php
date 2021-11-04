<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_json extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
        $this->load->model('Baak_model');
        $this->load->model('datatable/Baak_dt','Baak_dt');
    }

    public function cek_role($module)
    {
        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses($module,$level,$action);
        if($access==0){
            $text = $this->alert->danger('You do not have access');
			$this->session->set_flashdata('message', $text);
			redirect("welcome/dashboard");
		}
    }

    public function json_jadwal_dosen($periode)
    {
        $this->load->model('datatable/Dosen_dt', 'Dosen_dt');
        
        header('Content-Type: application/json');
        //echo $this->session->userdata('username');
        echo $this->Dosen_dt->json_jadwal_dosen($periode);
    }

    public function json_presensi_dosen($id_trx)
    {
        $this->load->model('datatable/Dosen_dt', 'Dosen_dt');
        
        header('Content-Type: application/json');
        echo $this->Dosen_dt->json_presensi_dosen($id_trx);
    }

    public function presensi_mahasiswa($id_trx)
    {
        $this->load->model('datatable/Dosen_dt', 'Dosen_dt');
        
        header('Content-Type: application/json');
        echo $this->Dosen_dt->presensi_mahasiswa($id_trx);
    }

    public function presensi_mahasiswa_pertemuan($id_trx)
    {
        $this->load->model('datatable/Dosen_dt', 'Dosen_dt');
        
        header('Content-Type: application/json');
        echo $this->Dosen_dt->presensi_mahasiswa_pertemuan($id_trx);
    }

    public function presensi_mahasiswa_pertemuan_report($id_trx)
    {
        $this->load->model('datatable/Dosen_dt', 'Dosen_dt');
        $cek_=$this->Master_model->master_get(['id_trx_jadwal'=>$id_trx],'v_jadwal');
        header('Content-Type: application/json');
        echo $this->Dosen_dt->presensi_mahasiswa_pertemuan_report($cek_);
    }

    public function json_input_nilai($id_trx)
    {
        $this->load->model('datatable/Dosen_dt', 'Dosen_dt');
        
        header('Content-Type: application/json');
        echo $this->Dosen_dt->json_input_nilai($id_trx);
    }

}