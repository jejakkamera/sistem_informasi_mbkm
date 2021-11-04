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

    public function json_mahasiswa()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_mahasiswa();
    }
    
    public function json_prodi()
    {      
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_prodi();
    }

    public function json_prodi_presensi_dosen()
    {      
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_prodi_presensi_dosen();
    }

    public function json_prodi_presensi_mahasiswa()
    {      
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_prodi_presensi_mahasiswa();
    }

    public function json_presensi_jadwal_prodi($kode_prodi)
    {      
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_presensi_jadwal_prodi($kode_prodi);
    }
    public function json_presensi_matakuliah_prodi($kode_prodi)
    {      
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_presensi_matakuliah_prodi($kode_prodi);
    }

    public function json_rekap_presensi_dosen()
    {      
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_rekap_presensi_dosen();
    }

    public function json_rekap_presensi_dosen_detail($id_rekap)
    {      
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_rekap_presensi_dosen_detail($id_rekap);
    }

    public function json_json_rekap_presensi_dosen_detail_akademik($id_rekap)
    {      
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_json_rekap_presensi_dosen_detail_akademik($id_rekap);
    }

    public function json_rekap_presensi_dosen_detail_keuangan($id_rekap)
    {      
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_rekap_presensi_dosen_detail_keuangan($id_rekap);
    }

    public function json_presensi_dosen_list($id_trx_jadwal)
    {      
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_presensi_dosen_list($id_trx_jadwal);
    }

    public function json_kurikulum()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_kurikulum();
    }

    public function json_kurikulum_mahasiswa()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_kurikulum_mahasiswa();
    }

    public function json_kurikulum_mahasiswa_set($periode,$report=null)
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_kurikulum_mahasiswa_set($periode,$report);
    }

    public function json_kurikulum_matakuliah($id_kurikulum)
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_kurikulum_matakuliah($id_kurikulum);
    }

   
    
    public function json_list_ta()
    {
        $this->load->model('datatable/Master_dt', 'Master_dt');
        
        header('Content-Type: application/json');
        echo $this->Master_dt->json_master('dikti_semester');
    }

    public function json_list_pengisian_frs_mhs()
    {
        $this->load->model('datatable/Master_dt', 'Master_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_pengisian_frs_mhs();
    }
    public function peserta_kelas($id_trx)
    {
        $this->load->model('datatable/Master_dt', 'Master_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->peserta_kelas($id_trx);
    }

    public function json_list_pengisian_frs_mk()
    {
        $this->load->model('datatable/Master_dt', 'Master_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_pengisian_frs_mk();
    }

    public function json_list_pengisian_frs_prodi()
    {
        $this->load->model('datatable/Master_dt', 'Master_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_pengisian_frs_prodi();
    }

    // public function json_dosen()
    // {
    //     $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
    //     header('Content-Type: application/json');
    //     echo $this->Baak_dt->json_dosen();
    // }

    public function json_dosen_wali_mahasiswa()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_dosen_wali_mahasiswa();
    }

    public function json_kelas()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_kelas();
    }
    
    public function json_select_kelas($prodi='')
    {     
		$mk = $this->input->post('kec');
        header('Content-Type: application/json');
	    $data_dosen=$this->Baak_model->json_select_kelas($mk,$prodi);
	    echo json_encode($data_dosen);
    }

    public function json_id_periode()
    {
        
		$mk = $this->input->post('kec');
        header('Content-Type: application/json');
	    $data_dosen=$this->Baak_model->json_id_periode($mk);
	    echo json_encode($data_dosen);
    }
    public function json_id_periode_all()
    {
        
		$mk = $this->input->post('kec');
        header('Content-Type: application/json');
	    $data_dosen=$this->Baak_model->json_id_periode_all($mk);
	    echo json_encode($data_dosen);
    }

    public function json_select_dosen()
    {
        
		$mk = $this->input->post('kec');
        header('Content-Type: application/json');
	    $data_dosen=$this->Baak_model->json_select_dosen($mk);
	    echo json_encode($data_dosen);
    }

    public function json_id_periode_aktif()
    {
        
		$mk = $this->input->post('kec');
        header('Content-Type: application/json');
	    $data_dosen=$this->Baak_model->json_id_periode_aktif($mk);
	    echo json_encode($data_dosen);
    }

    public function json_prodi_kode($jenajng=null)
    {
		$mk = $this->input->post('kec');
        header('Content-Type: application/json');
	    $data_dosen=$this->Baak_model->json_prodi_kode($mk,$jenajng);
	    echo json_encode($data_dosen);
    }

    public function json_id_matkul()
    {
		$mk = $this->input->post('kec');
        header('Content-Type: application/json');
	    $data_matkul=$this->Baak_model->json_id_matkul($mk);
	    echo json_encode($data_matkul);
    }

    public function json_jenjang_didik()
    {
        
		$mk = $this->input->post('kec');
        header('Content-Type: application/json');
	    $data_jenjang_didik=$this->Baak_model->json_jenjang_didik($mk);
	    echo json_encode($data_jenjang_didik);
    }

    public function json_dosen()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_dosen();
    }
    
    public function json_skala_nilai()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_skala_nilai();
    }

    public function json_skala_nilai_detail($periode)
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_skala_nilai_detail($periode);
    }

    public function json_frs_mahasiswa($periode)
    {
        $this->load->model('datatable/Dosen_dt', 'Dosen_dt');
        
        header('Content-Type: application/json');
        echo $this->Dosen_dt->json_frs_mahasiswa($periode);
    }

    public function json_jadwal_dosen($id_kurikulum,$periode)
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_kurikulum_saji_jadwal($id_kurikulum,$periode);
    }

    public function json_jadwal_dosen_all($periode)
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_jadwal_dosen_all($periode);
    }

    public function json_waktu_kuliah()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_waktu_kuliah();
    }

    public function json_dosen_wali_list()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_dosen_wali_list();
    }

    public function json_waktu_kuliah_select()
    {
        $mk = $this->input->post('kec');
        header('Content-Type: application/json');
	    $json_waktu_kuliah_select=$this->Baak_model->json_waktu_kuliah_select($mk);
	    echo json_encode($json_waktu_kuliah_select);
    }

    public function json_frs_mhs($periode,$nim)
    {
        $mk = $this->input->post('kec');
        header('Content-Type: application/json');
	    $json_frs_mhs=$this->Baak_model->json_frs_mhs($periode,$mk,$nim);
	    echo json_encode($json_frs_mhs);
    }
    


}
