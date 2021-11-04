<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feeder_dt extends CI_Model {

    function __construct()
	{
        parent::__construct();
        $this->load->library('datatables');
    }

    function json_master($tabel,$where)
	{
        $data = $this->db->list_fields($tabel);
        $coloum = implode(",",$data);

        $this->datatables->select($coloum);
		$this->datatables->from($tabel);
		$this->datatables->where($where);
        return $this->datatables->generate();
    }

    function user_list()
	{
        $this->datatables->select('username, password, last_login, create_at, update_at, role, user_status');
        $this->datatables->from('user');
       
        $this->datatables->add_column('action',
		
        anchor(
			site_url('admin/super/update_user/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Login Info" class="btn btn-warning"')
			
		, 'username');
        return $this->datatables->generate();
    }

    function json_GetNilaiTransferPendidikanMahasiswa_list()
	{
        $this->datatables->select('id_trx, feeder_nilai_huruf, feeder_nilai, feeder_update_nilai, nim, id_mahasiswa, nama, periode, id_matkul, id_registrasi_mahasiswa, id_kelas_kuliah_mhs, id_kelas, status_feeder_id_kelas, nilai_angka, nilai_huruf, status_frs, ulang, last_edit, status_feeder, input_trx, kode_mata_kuliah, nama_mata_kuliah, nama_mata_kuliah_ing, kode_prodi, id_jenis_mata_kuliah, id_kelompok_mata_kuliah, sks_mata_kuliah, sks_praktek, id_kurikulum, semester, id_matkul_prasyarat, id_kelas_perkuliahan, transfer');
        $this->datatables->from('v_frs');
        $this->datatables->where('transfer','ya');
       
        return $this->datatables->generate();
    }

    

}
