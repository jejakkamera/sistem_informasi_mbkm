<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baak_dt extends CI_Model {

    function __construct()
	{
        parent::__construct();
        $this->load->library('datatables');
    }

    function json_kurikulum()
	{
        $this->datatables->select('kode_program_studi, nama_program_studi, nama_jenjang_pendidikan, id_kurikulum, nama_kurikulum, id_semester');
        $this->datatables->from('v_kurikulum');
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('kode_program_studi',$this->session->userdata('username'));
        }
        $this->datatables->add_column('action',
		anchor(
			site_url('baak/matakuliah/kurikulum_matakuliah/$1'),'<i class="fa fa-eye"></i>','data-toggle="tooltip" data-html="true" title="List Matakuliah Kurikulum" class="btn btn-success"').
        anchor(
			site_url('baak/matakuliah/update_kurikulum/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Update Kurikulum" class="btn btn-warning"')
			
		, 'id_kurikulum');
        
        return $this->datatables->generate();
    }

    function json_matakuliah_kurikulum()
	{
        $this->datatables->select('kode_prodi, semester, apakah_wajib, id_semester, id_matkul, kode_mata_kuliah, nama_mata_kuliah, nama_mata_kuliah_ing, id_jenis_mata_kuliah, id_kelompok_mata_kuliah, sks_mata_kuliah, id_kurikulum ');
        $this->datatables->from('v_matakuliah_kurikulum');
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('kode_prodir',$this->session->userdata('username'));
        }
        return $this->datatables->generate();
    }

    function json_matakuliah()
	{
        $this->datatables->select('id_matkul, kode_mata_kuliah, nama_mata_kuliah, nama_mata_kuliah_ing, id_matkul_prasyarat, kode_prodi, id_jenis_mata_kuliah, id_kelompok_mata_kuliah, sks_mata_kuliah');
        $this->datatables->from('mata_kuliah');
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('kode_prodir',$this->session->userdata('username'));
        }
        return $this->datatables->generate();
    }

    function json_kurikulum_mahasiswa()
	{
        $this->datatables->select('kode_program_studi, nama_program_studi, nama_jenjang_pendidikan, v_kurikulum.id_kurikulum, nama_kurikulum, id_semester,count(nim) as total_mhs');
        $this->datatables->from('v_kurikulum');
        $this->datatables->join('mahasiswa','mahasiswa.id_kurikulum=v_kurikulum.id_kurikulum','left');
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('kode_program_studi',$this->session->userdata('username'));
        }
        $this->datatables->group_by('v_kurikulum.id_kurikulum');
        $this->datatables->add_column('action',
		anchor(
			site_url('baak/mahasiswa/plot_kurikulum/$1'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="Plot Kurikulum mahasiswa" class="btn btn-success"')
			
		, 'id_kurikulum');
        return $this->datatables->generate();
    }

    function json_kurikulum_mahasiswa_set($periode,$report)
	{
        $this->datatables->select('kode_program_studi, nama_program_studi, nama_jenjang_pendidikan, v_kurikulum.id_kurikulum, nama_kurikulum,v_kurikulum.id_semester,
            (select count(nim) from mahasiswa where status_mahasiswa="AKTIF" and mahasiswa.id_kurikulum=v_kurikulum.id_kurikulum ) as total_mhs, 
            (select count(mata_kuliah_saji.id_matkul) from mata_kuliah_saji join matakuliah_kurikulum on mata_kuliah_saji.id_matkul=matakuliah_kurikulum.id_matkul and mata_kuliah_saji.id_kurikulum=matakuliah_kurikulum.id_kurikulum  where matakuliah_kurikulum.id_kurikulum=v_kurikulum.id_kurikulum  and mata_kuliah_saji.periode = '.$periode.' ) as total_mk,'.$periode.' as periode_ini'
        );
        $this->datatables->from('v_kurikulum');
        $this->datatables->group_by('v_kurikulum.id_kurikulum');
        $this->datatables->add_column('action',
		anchor(
			site_url('baak/frs/plot_set_kurikulum/$1/$2'),'<i class="fa fa-random"></i> MK','data-toggle="tooltip" data-html="true" title="Matakuliah Saji" class="btn btn-success"')." ".
		anchor(
			site_url('baak/frs/jadwal_dosen/$1/$2/'.$report),'<i class="fa fa-graduation-cap"></i> Jadwal','data-toggle="tooltip" data-html="true" title="Jadwal Dosen" class="btn btn-info"')
			
		, 'id_kurikulum,periode_ini');
        return $this->datatables->generate();
    }

    function json_kurikulum_matakuliah($id_kurikulum)
	{
        $this->datatables->select('kode_prodi, semester, apakah_wajib, id_semester, id_matkul, kode_mata_kuliah, nama_mata_kuliah, nama_mata_kuliah_ing, id_jenis_mata_kuliah, id_kelompok_mata_kuliah, sks_mata_kuliah');
        $this->datatables->from('v_matakuliah_kurikulum');
        $this->datatables->where('id_kurikulum',$id_kurikulum);
        $this->datatables->add_column('action',
        anchor(
			site_url('baak/matakuliah/update_matakuliah/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Update Mata Kuliah" class="btn btn-warning"')
			
		, 'id_matkul');
        return $this->datatables->generate();
    }

    function json_prodi()
	{
        $this->datatables->select('id_prodi, kode_program_studi, nama_program_studi, status, nama_jenjang_pendidikan, id_dosen, nidn, nama');
        $this->datatables->from('v_prodi');
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('v_prodi.kode_program_studi',$this->session->userdata('username'));
        }
        $this->datatables->add_column('action',
		anchor(
			site_url('baak/prodi/prodi_info/$1'),'<i class="fa fa-eye"></i>','data-toggle="tooltip" data-html="true" title="Login Info" class="btn btn-success"').
        anchor(
			site_url('baak/prodi/update_prodi/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Login Info" class="btn btn-warning"')
			
		, 'id_prodi');
        return $this->datatables->generate();
    }

    function json_prodi_presensi_dosen()
	{
        $this->datatables->select('id_prodi, kode_program_studi, nama_program_studi, status, nama_jenjang_pendidikan, id_dosen, nidn, nama');
        $this->datatables->from('v_prodi');
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('v_prodi.kode_program_studi',$this->session->userdata('username'));
        }
        $this->datatables->add_column('action',
		anchor(
			site_url('baak/pembelajaran/presensi_jadwal_prodi/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Presensi Dosen" class="btn btn-success"')
			
		, 'kode_program_studi');
        return $this->datatables->generate();
    }

    function json_prodi_presensi_mahasiswa()
	{
        $this->datatables->select('id_prodi, kode_program_studi, nama_program_studi, status, nama_jenjang_pendidikan, id_dosen, nidn, nama');
        $this->datatables->from('v_prodi');
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('v_prodi.kode_program_studi',$this->session->userdata('username'));
        }
        $this->datatables->add_column('action',
		anchor(
			site_url('baak/pembelajaran/presensi_matakuliah_prodi/$1'),'<i class="fa fa-user"></i>','data-toggle="tooltip" data-html="true" title="Presensi Dosen" class="btn btn-info"')
			
		, 'kode_program_studi');
        return $this->datatables->generate();
    }

    function json_dosen()
	{
        $this->datatables->select('nip, id_dosen, nama, nidn, jabatan_struktural, id_status_aktif, id_sdm, created_at, email, status_pegawai, id, homebase, foto, nama_homebase,if(email is NULL,0,email) as status_email');
        $this->datatables->from('v_dosen');
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('v_dosen.homebase',$this->session->userdata('username'));
        }
        $this->datatables->add_column('action',
		anchor(
            site_url('baak/dosen/dosen_info/$1'),'<i class="fa fa-eye"></i>','data-toggle="tooltip" data-html="true" title="Login Info" class="btn btn-success"')." ".
        anchor(
            site_url('baak/dosen/dosen_update/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Login Info" class="btn btn-warning"')." ".
			anchor(
                site_url('baak/dosen/dosen_hapus/$1'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="Hapus Data Dosen" class="btn btn-danger"')
		, 'id');
        return $this->datatables->generate();
    }

    function json_dosen_wali_mahasiswa()
	{
        $this->datatables->select('nip, v_dosen.id_dosen, nama, nidn, jabatan_struktural, id_status_aktif, id_sdm, created_at, email, status_pegawai, id, homebase, foto, nama_homebase,count(nim) as total_mhs');
        $this->datatables->from('v_dosen');
        $this->datatables->join('mahasiswa_dosen_wali','mahasiswa_dosen_wali.id_dosen=v_dosen.id','left');
        $this->datatables->group_by('v_dosen.id_dosen');
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('homebase',$this->session->userdata('username'));
        }
        $this->datatables->add_column('action',
		anchor(
			site_url('baak/mahasiswa/plot_dosen_wali/$1/$2/$3'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="Plot Dosen Wali" class="btn btn-success"')
		, 'id,homebase,nama');
        return $this->datatables->generate();
    }

    function json_mahasiswa()
	{
        $this->datatables->select('v_mahasiswa.nim, v_mahasiswa.nama, id_mahasiswa, id_registrasi_mahasiswa, id_periode_masuk, kode_prodi, nama_program_studi, nama_jenjang_pendidikan, status_mahasiswa, id_kurikulum,nama_kurikulum, info,concat(nama_program_studi,"-",univ) as nama_program_studi_univ');
        $this->datatables->from('v_mahasiswa');
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('kode_prodi',$this->session->userdata('username'));
        }
        if($this->session->userdata('role')=='dosen'){
            $this->datatables->join('mahasiswa_dosen_wali','mahasiswa_dosen_wali.nim=v_mahasiswa.nim');
            $this->datatables->join('pegawai','mahasiswa_dosen_wali.id_dosen=pegawai.id');
            $this->datatables->where('email',$this->session->userdata('username'));
        }
        $this->datatables->like('status_mahasiswa',$this->session->userdata('mahasiswa_filter')['status_mahasiswa']);
        $this->datatables->like('id_periode_masuk',$this->session->userdata('mahasiswa_filter')['id_periode_masuk']);
        $this->datatables->add_column('action',
        anchor(
            site_url('baak/mahasiswa/mahasiswa_info/$1'),'<i class="fa fa-eye"></i>','data-toggle="tooltip" data-html="true" title="Login Info" class="btn btn-warning"')." ".
		anchor(
			site_url('baak/mahasiswa/profile/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="profil Mahasiswa" class="btn btn-success"')." ".
		anchor(
			site_url('baak/mahasiswa/transkrip_akademik/$1'),'<i class="fa fa-graduation-cap"></i>','data-toggle="tooltip" data-html="true" title="KHS & FRS" class="btn btn-info"')." ".
		anchor(
			site_url('baak/mahasiswa/mahasiswa_hapus_action/$1'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="KHS & FRS" class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure Delete $1 ? all data will be deleted \')"')
		, 'nim');
        return $this->datatables->generate();
    }

    function json_list_pengisian_frs_mhs()
	{
        if($this->session->userdata('frs_filter')['id_periode_masuk']){
            $this->datatables->select('periode,id_trx,nim,id_mahasiswa,nama,status_frs,status_feeder,nilai_huruf,nilai_angka,kode_mata_kuliah,nama_mata_kuliah,semester');
            $this->datatables->from('v_frs ');
            
            $this->datatables->like('periode',$this->session->userdata('frs_filter')['id_periode_masuk']);
            $this->datatables->like('kode_prodi',$this->session->userdata('frs_filter')['kode_prodi']);
            return $this->datatables->generate();
        }else{
            $this->datatables->from('t_kosong');
            return $this->datatables->generate();
        }
        
    }

    function peserta_kelas($id_trx)
	{
        
            $this->datatables->select('v_frs.periode,nim,id_mahasiswa,nama,status_frs,status_feeder,nilai_huruf,nilai_angka,kode_mata_kuliah,nama_mata_kuliah,semester');
            $this->datatables->from('mata_kuliah_saji');
            $this->datatables->join('v_frs','v_frs.id_matkul=mata_kuliah_saji.id_matkul and v_frs.periode=mata_kuliah_saji.periode');
            $this->datatables->where('mata_kuliah_saji.id_trx',$id_trx);
            return $this->datatables->generate();
    
        
    }

    function json_list_pengisian_frs_mk()
	{
        if($this->session->userdata('frs_filter')['id_periode_masuk']){
            $this->datatables->select('periode,id_matkul,kode_mata_kuliah,nama_mata_kuliah,semester,count(id_trx) as total,nama_program_studi' );
            $this->datatables->from('v_frs');
            $this->datatables->join('dikti_prodi','v_frs.kode_prodi=dikti_prodi.kode_program_studi');
            $this->datatables->like('periode',$this->session->userdata('frs_filter')['id_periode_masuk']);
            $this->datatables->like('kode_prodi',$this->session->userdata('frs_filter')['kode_prodi']);
            if($this->session->userdata('role')=='prodi'){
                $this->datatables->where('v_frs.kode_prodi',$this->session->userdata('username'));
            }
            $this->datatables->group_by('id_matkul');
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/frs/kehadiran_mahasiswa_report_mk/$1/$2'),'<i class="fa fa-list"></i>','data-toggle="tooltip" data-html="true" title="List Mahasiswa" class="btn btn-success"')
            , 'id_matkul,periode');
            return $this->datatables->generate();
        }else{
            $this->datatables->from('t_kosong');
            return $this->datatables->generate();
        }
        
    }

    function json_list_pengisian_frs_prodi()
	{
        if($this->session->userdata('frs_filter')['id_periode_masuk']){
            $this->datatables->select('periode,kode_mata_kuliah,nama_mata_kuliah,semester,count(id_trx) as total,nama_program_studi,nama_jenjang_pendidikan');
            $this->datatables->from('v_frs_gn');
            $this->datatables->join('dikti_prodi','v_frs_gn.kode_prodi=dikti_prodi.kode_program_studi');
            $this->datatables->like('periode',$this->session->userdata('frs_filter')['id_periode_masuk']);
            $this->datatables->like('kode_prodi',$this->session->userdata('frs_filter')['kode_prodi']);
            if($this->session->userdata('role')=='prodi'){
                $this->datatables->where('v_frs_gn.kode_prodi',$this->session->userdata('username'));
            }
            $this->datatables->group_by('id_prodi');
            return $this->datatables->generate();
        }else{
            $this->datatables->from('t_kosong');
            return $this->datatables->generate();
        }
        
    }

    function json_kelas()
	{
            $this->datatables->select('kelas.id_kelas,nama_kelas,kelas.kode_prodi,angkatan,nama_program_studi,nama_jenjang_pendidikan,count(nim) as total');
            $this->datatables->from('kelas');
            $this->datatables->join('dikti_prodi','kelas.kode_prodi=dikti_prodi.kode_program_studi');
            $this->datatables->join('mahasiswa','kelas.id_kelas=mahasiswa.id_kelas','left');
            if($this->session->userdata('role')=='prodi'){
                $this->datatables->where('kelas.kode_prodi',$this->session->userdata('username'));
            }
            $this->datatables->group_by('kelas.id_kelas');
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/mahasiswa/plot_kelas/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="Plot Kelas" class="btn btn-success"').' || '.
            anchor(
                site_url('baak/mahasiswa/delete_kelas/$1/$2'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="Delete Kelas" class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure Copy $1 ? all your data will be deleted \')"')
            , 'id_kelas,kode_prodi');
            //$this->datatables->group_by('id_prodi');
            return $this->datatables->generate();
    }

    function json_skala_nilai()
	{
            $this->datatables->select('id_semester,count(nilai_skala.periode) as total');
            $this->datatables->from('dikti_semester');
            $this->datatables->join('nilai_skala','nilai_skala.periode=dikti_semester.id_semester','left');
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/baak/list_skala_nilai_detail/$1'),'<i class="fa fa-plus"></i>','data-toggle="tooltip" data-html="true" title="List Skala" class="btn btn-success"')." ".
            anchor(
                site_url('baak/baak/copy_skala_nilai/$1'),'<i class="fa fa-copy"></i>','data-toggle="tooltip" data-html="true" title="Copy skala" class="btn btn-info" onclick="javasciprt: return confirm(\'Are You Sure Copy $1 ? all your data will be deleted \')"')
            , 'id_semester');
            $this->datatables->group_by('dikti_semester.id_semester');
            return $this->datatables->generate();
    }

    function json_skala_nilai_detail($periode)
	{
            $this->datatables->select('id, periode, kode_prodi, nilai_huruf, nilai_index, nama_program_studi, nama_jenjang_pendidikan,bobot_minimum,bobot_maximum');
            $this->datatables->from('v_skala_nilai ');
            $this->datatables->where('periode',$periode);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/baak/skala_nilai_delete/$1'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="Copy skala" class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure Delete $1  ?\')"')
            , 'id');
            return $this->datatables->generate();
    }

    function json_kurikulum_saji_jadwal($id_kurikulum,$periode) {
        $this->datatables->select('count(id_trx_jadwal) as total_kelas,id_trx,v_matakuliah_kurikulum.id_matkul, semester,kode_mata_kuliah,nama_mata_kuliah,sks_mata_kuliah,v_matakuliah_kurikulum.id_kurikulum,mata_kuliah_saji.id_matkul as id_saji,mata_kuliah_saji.id_kurikulum as id_kurikulum_saji,mata_kuliah_saji.periode as periode');
        $this->datatables->from('v_matakuliah_kurikulum');
        $this->datatables->join('mata_kuliah_saji','mata_kuliah_saji.id_matkul=v_matakuliah_kurikulum.id_matkul and mata_kuliah_saji.periode='.$periode);
        $this->datatables->join('mata_kuliah_jadwal','mata_kuliah_jadwal.id_matkul=mata_kuliah_saji.id_matkul and mata_kuliah_jadwal.periode=mata_kuliah_saji.periode','left');
        $this->datatables->where('v_matakuliah_kurikulum.id_kurikulum',$id_kurikulum);
        $this->datatables->group_by('mata_kuliah_saji.id_trx');
        $this->datatables->add_column('action',
            anchor(
                site_url('baak/frs/plot_jadwal_dosen/$1'),'<i class="fa fa-eye"></i>','data-toggle="tooltip" data-html="true" title="Jadwal" class="btn btn-danger" ')." | ".
            anchor(
                site_url('baak/frs/nilai_mahasiswa_report/$1'),'<i class="fa fa-book"></i> ','target="_blank" data-toggle="tooltip" data-html="true" title="Report nilai" class="btn btn-warning" ')." | ".
            anchor(
                site_url('baak/frs/kehadiran_mahasiswa_report/$1'),'<i class="fa fa-list"></i>','data-toggle="tooltip" data-html="true" title="Report Kehadiran mahasiswa" class="btn btn-info" ')
            , 'id_trx');
        return $this->datatables->generate();
      
    }

    function json_jadwal_dosen_all($periode) {
        $this->datatables->select('id_trx_jadwal,nama_program_studi,kode_mata_kuliah,nama_mata_kuliah,hari,nama_waktu,ruang,nama_kelas,angkatan,nama_id_dosen');
        $this->datatables->from('v_jadwal');
        $this->datatables->where('periode',$periode);
        $this->datatables->add_column('action',
            anchor(
                site_url('baak/frs/nilai_mahasiswa_report_jadwal/$1'),'<i class="fa fa-book"></i> ','target="_blank" data-toggle="tooltip" data-html="true" title="Report nilai" class="btn btn-warning" ')." | ".
            anchor(
                site_url('baak/frs/kehadiran_mahasiswa_report_jadwal/$1'),'<i class="fa fa-list"></i>','data-toggle="tooltip" data-html="true" title="Report Kehadiran mahasiswa" class="btn btn-info" ')
            , 'id_trx_jadwal');
        return $this->datatables->generate();
        // $this->datatables->select('count(id_trx_jadwal) as total_kelas,id_trx,v_matakuliah_kurikulum.id_matkul, semester,kode_mata_kuliah,nama_mata_kuliah,sks_mata_kuliah,v_matakuliah_kurikulum.id_kurikulum,mata_kuliah_saji.id_matkul as id_saji,mata_kuliah_saji.id_kurikulum as id_kurikulum_saji,mata_kuliah_saji.periode as periode,nama_program_studi');
        // $this->datatables->from('v_matakuliah_kurikulum');
        // $this->datatables->join('dikti_prodi','dikti_prodi.kode_program_studi=v_matakuliah_kurikulum.kode_prodi');
        // $this->datatables->join('mata_kuliah_saji','mata_kuliah_saji.id_matkul=v_matakuliah_kurikulum.id_matkul and mata_kuliah_saji.periode='.$periode);
        // $this->datatables->join('mata_kuliah_jadwal','mata_kuliah_jadwal.id_matkul=mata_kuliah_saji.id_matkul and mata_kuliah_jadwal.periode=mata_kuliah_saji.periode','left');
        // $this->datatables->group_by('mata_kuliah_saji.id_trx');
        // $this->datatables->add_column('action',
        //     anchor(
        //         site_url('baak/frs/plot_jadwal_dosen/$1'),'<i class="fa fa-eye"></i>','data-toggle="tooltip" data-html="true" title="Jadwal" class="btn btn-danger" ')." | ".
        //     anchor(
        //         site_url('baak/frs/nilai_mahasiswa_report/$1'),'<i class="fa fa-book"></i> ','target="_blank" data-toggle="tooltip" data-html="true" title="Report nilai" class="btn btn-warning" ')." | ".
        //     anchor(
        //         site_url('baak/frs/kehadiran_mahasiswa_report/$1'),'<i class="fa fa-list"></i>','data-toggle="tooltip" data-html="true" title="Report Kehadiran mahasiswa" class="btn btn-info" ')
        //     , 'id_trx');
        // return $this->datatables->generate();
      
    }

    function json_waktu_kuliah() {
        $this->datatables->select('id, waktu, nama_id,status');
        $this->datatables->from('waktu_kulia');
        $this->datatables->add_column('action',
            anchor(
                site_url('baak/baak/waktu_kuliah_edit/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Edit Waktu Kuliah" class="btn btn-warning" ')." | ".
            
            anchor(
                site_url('baak/baak/waktu_kuliah_delete/$1'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="Waktu Kuliah" class="btn btn-danger" ')
            , 'id');
        return $this->datatables->generate();
      
    }

    function json_presensi_jadwal_prodi($kode_prodi) {
        $this->datatables->select('v_jadwal.id_trx_jadwal,concat(kode_mata_kuliah,"-",nama_mata_kuliah) as matakuliah, nama_id_dosen, concat(angkatan,"-",nama_kelas) as kelas,hari,ruang,waktu_jam,max(pertemuan) as last_pertemuan,dikti_prodi.nama_program_studi,presensi_dosen.id');
        $this->datatables->from('v_jadwal');
        // $this->datatables->join('v_jadwal','frs_set.id_periode=v_jadwal.periode');
        $this->datatables->join('dikti_prodi','v_jadwal.kode_prodi=dikti_prodi.kode_program_studi');
        $this->datatables->join('presensi_dosen','presensi_dosen.id_trx_jadwal=v_jadwal.id_trx_jadwal','left');
        $this->datatables->group_by('v_jadwal.id_trx_jadwal');
        $this->datatables->where('v_jadwal.kode_prodi',$kode_prodi);
        $this->datatables->where('v_jadwal.periode',$this->session->userdata('set_periode')['periode']);
        $this->datatables->add_column('action',
            
            anchor(
                site_url('baak/pembelajaran/presensi_dosen_list/$1'),'<i class="fa fa-eye"></i>','data-toggle="tooltip" data-html="true" title="Presensi Dosen" class="btn btn-info" ')
            , 'id_trx_jadwal');
        return $this->datatables->generate();
      
    }

    function json_presensi_dosen_list($id_trx_jadwal) {
        $this->datatables->select('id, id_trx_jadwal, id_matkul, periode, email, id_kelas, pertemuan, tanggal_presensi, materi, methode, status_rekap, tanggal_masuk, last_edit');
        $this->datatables->from('presensi_dosen');
        $this->datatables->where('presensi_dosen.id_trx_jadwal',$id_trx_jadwal);
        $this->datatables->add_column('action',
            
        anchor(
            site_url('baak/pembelajaran/presensi_dosen_delete/$1'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="Presensi Dosen" class="btn btn-danger" ')
        , 'id');
        return $this->datatables->generate();
    }
    
    function json_presensi_matakuliah_prodi($kode_prodi) {
        $this->datatables->select('id_trx_jadwal, id_matkul, periode, id_dosen, id_kelas, ruang, waktu, nama_waktu, waktu_jam, hari,  kode_mata_kuliah, nama_mata_kuliah, kode_prodi, nama_id_dosen, id_status_aktif, email, status_pegawai, nama_kelas, prodi_kelas, angkatan');
        $this->datatables->from('v_jadwal');
        // $this->datatables->join('v_jadwal','frs_set.id_periode=v_jadwal.periode');
        $this->datatables->group_by('v_jadwal.id_matkul');
        $this->datatables->where('v_jadwal.kode_prodi',$kode_prodi);
        $this->datatables->where('v_jadwal.periode',$this->session->userdata('set_periode')['periode']);
        $this->datatables->add_column('action',
            anchor(
                site_url('baak/pembelajaran/presensi_mahasiswa_list/$1'),'<i class="fa fa-list"></i>','data-toggle="tooltip" data-html="true" title="Report Presensi mahasiswa" class="btn btn-info" ')
            , 'id_trx_jadwal');
        return $this->datatables->generate();
      
    }

    function json_rekap_presensi_dosen() {
        $this->datatables->select('id_rekap, minggu, tanggal_akhir, status_rekap, nama_rekap, waktu_rekap,periode ');
        $this->datatables->from('rekap_presensi_dosen');
        $this->datatables->where('rekap_presensi_dosen.periode',$this->session->userdata('set_periode')['periode']);
        $this->datatables->add_column('action',
            anchor(
                site_url('baak/pembelajaran/rekap_presensi_dosen_up/$1'),'<i class="fa fa-level-up"></i>','data-toggle="tooltip" data-html="true" title="Update Rekap" class="btn btn-danger" ').' '.
            anchor(
                site_url('baak/pembelajaran/rekap_presensi_dosen_detail/$1'),'<i class="fa fa-list"></i>','data-toggle="tooltip" data-html="true" title="Detail Rekap" class="btn btn-info" ')
            , 'id_rekap');
        return $this->datatables->generate();
    }

    function json_rekap_presensi_dosen_detail($id_periode) {
        $this->datatables->select('id_trx_detail, id_rekap, id_trx_absen, id_trx_jadwal, id_matkul, id_kelas, pertemuan, tanggal_presensi, materi, methode, tanggal_masuk, id_dosen,concat(kode_mata_kuliah,"-",nama_mata_kuliah) as matakuliah,nama,nama_kelas');
        $this->datatables->from('v_rekap_presensi_dosen_detail');
        
        $this->datatables->where('v_rekap_presensi_dosen_detail.id_rekap',$id_periode);
        return $this->datatables->generate();
    }

    function json_json_rekap_presensi_dosen_detail_akademik($id_periode) {
        $this->datatables->select('id_rekap, id_matkul, nama_mata_kuliah, kode_mata_kuliah, id_dosen, nama, total_rekap,concat(kode_mata_kuliah,"-",nama_mata_kuliah) as matakuliah');
        $this->datatables->from('v_rekap_presensi_dosen_detail_akademik');
        
        $this->datatables->where('v_rekap_presensi_dosen_detail_akademik.id_rekap',$id_periode);
        return $this->datatables->generate();
    }

    function json_rekap_presensi_dosen_detail_keuangan($id_periode) {
        $this->datatables->select('*');
        $this->datatables->from('v_rekap_presensi_dosen_detail_keuangan');
        $this->datatables->join('dikti_prodi','dikti_prodi.kode_program_studi=v_rekap_presensi_dosen_detail_keuangan.homebase');
        $this->datatables->where('v_rekap_presensi_dosen_detail_keuangan.id_rekap',$id_periode);
        return $this->datatables->generate();
    }

    function json_kelas_perkuliahan() {
        
        $this->datatables->select('periode, id_matkul, id_kelas, id_kelas_feeder, kode_mata_kuliah, nama_mata_kuliah, kode_prodi,id_prodi,   dikti_prodi.nama_program_studi, nama_kelas,feeder_info,nama_id_dosen');
        $this->datatables->from('v_jadwal');
        $this->datatables->join('dikti_prodi','dikti_prodi.kode_program_studi=v_jadwal.kode_prodi');
      
        $this->datatables->where('v_jadwal.periode',$this->session->userdata('set_periode')['periode']);
        return $this->datatables->generate();

        // $this->datatables->select('periode, id_matkul,  v_frs.id_kelas, status_feeder_id_kelas, kode_mata_kuliah, nama_mata_kuliah, v_frs.kode_prodi,id_prodi, id_kurikulum, semester, nama_program_studi, nama_kelas, if(id_kelas_perkuliahan is null,id_kelas_kuliah_mhs,id_kelas_perkuliahan) as id_kelas_kuliah,v_frs.id_kelas');
        // $this->datatables->from('v_frs');
        // $this->datatables->join('dikti_prodi','dikti_prodi.kode_program_studi=v_frs.kode_prodi');
        // $this->datatables->join('kelas','kelas.id_kelas= if(id_kelas_perkuliahan is null,id_kelas_kuliah_mhs,id_kelas_perkuliahan)','left');
        
        // $this->datatables->where('v_frs.periode',$this->session->userdata('set_periode')['periode']);
        // $this->datatables->group_by('id_matkul,v_frs.kode_prodi,nama_kelas');
        // return $this->datatables->generate();
    }

    function json_dosen_wali_list()
	{
        $this->datatables->select('nip, v_dosen.id_dosen, v_dosen.nama as nama_dosen, nidn, jabatan_struktural, id_status_aktif, id_sdm, created_at, status_pegawai, id, homebase, foto, nama_homebase,mahasiswa.nim,mahasiswa.nama as nama_dmahasiswa,dikti_prodi.nama_program_studi as nama_program_studi_mhs,status_mahasiswa ');
        $this->datatables->from('v_dosen');
        $this->datatables->join('mahasiswa_dosen_wali','mahasiswa_dosen_wali.id_dosen=v_dosen.id');
        $this->datatables->join('mahasiswa','mahasiswa_dosen_wali.nim=mahasiswa.nim');
        $this->datatables->join('dikti_prodi','mahasiswa.kode_prodi=dikti_prodi.kode_program_studi');
       
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('homebase',$this->session->userdata('username'));
        }
       
        return $this->datatables->generate();
    }

    function json_list_history_magang()
	{
            $this->datatables->select('*,v_magang_mhs.periode');
            $this->datatables->from('magang_list');
            $this->datatables->join('dikti_semester','dikti_semester.id_semester=magang_list.periode');
            $this->datatables->join('v_magang_mhs','v_magang_mhs.periode=magang_list.periode');
            $this->datatables->where('nim',$this->session->userdata('username')); $this->datatables->add_column('action',
            
            anchor(
                site_url('mahasiswa/magang/dashboard/$1'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="dashboard" class="btn btn-info" ')
            , 'periode');
            return $this->datatables->generate();
    }

    function json_list_periode_magang_mhs()
	{
            $this->datatables->select('*,magang_list.periode');
            $this->datatables->from('magang_list');
            $this->datatables->join('dikti_semester','dikti_semester.id_semester=magang_list.periode');
            $this->datatables->where('status','open');
            $this->datatables->where('periode_akhir >=',date('Y-m-d'));
            $this->datatables->add_column('action',
            anchor(
                site_url('mahasiswa/magang/daftar/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="daftar" class="btn btn-warning" ')." ".
            anchor(
                site_url('mahasiswa/magang/dashboard/$1'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="dashboard" class="btn btn-info" ')
            , 'periode');
            return $this->datatables->generate();
    }

    function json_all_data_magang($periode)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('v_magang_mhs');
            $this->datatables->where('periode',$periode);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/magang/penilaian/$1/$2'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Penilaian" class="btn btn-primary" ')." ".
            anchor(
                site_url('baak/magang/plot_dosen/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="plot pembimbing" class="btn btn-warning" ')
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_list_sidang_magang($periode)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('magang_jadwal_sidang');
            $this->datatables->join('dikti_prodi','dikti_prodi.kode_program_studi=magang_jadwal_sidang.kode_prodi');
            $this->datatables->where('periode',$periode);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/magang/sidang_magang_edit/$1/$2'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Edit" class="btn btn-info" ').' | '.
            anchor(
                site_url('baak/magang/plot_jadwal_sidang/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="plot Jadwal Sidang" class="btn btn-warning" ')
            
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_list_pendaftar_magang($periode)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('v_magang_mhs');
            $this->datatables->where('periode',$periode);
            $this->datatables->where('progres',"daftar");
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/magang/plot_dosen/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="plot pembimbing" class="btn btn-warning" ')
            
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_list_jadwal_sidang_magang($id_trx)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('v_magang_mhs');
            $this->datatables->where('id_sidang',$id_trx);
            $this->datatables->where_in('progres',["daftar sidang","sidang"]);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/magang/plot_sidang_magang/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="plot jadwal sidang" class="btn btn-warning" ')." | ".
            anchor(
                site_url('baak/magang/penilaian/$1/$2'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Penilaian" class="btn btn-primary" ')
            
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_list_periode_magang()
	{
            $this->datatables->select('*,periode');
            $this->datatables->from('magang_list');
            $this->datatables->join('dikti_semester','dikti_semester.id_semester=magang_list.periode');
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/magang/periode_edit/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Edit" class="btn btn-warning" ').' '.
            anchor(
                site_url('baak/magang/periode_rule/$1'),'<i class="fa fa-key"></i>','data-toggle="tooltip" data-html="true" title="rule" class="btn btn-info" ').' '.
            anchor(
                site_url('baak/magang/dashboard/$1'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="dasboard" class="btn btn-info" ')
            , 'periode');
            return $this->datatables->generate();
    }

    function json_periode_rule($periode)
	{
            $this->datatables->select('periode,id_rule,name,id_trx');
            $this->datatables->from('magang_rule');
            $this->datatables->where('periode',$periode);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/magang/delete_rule/$1'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="Delete" class="btn btn-danger" ')
            , 'id_trx');
            return $this->datatables->generate();
    }

    function json_sidang_rule($periode)
	{
            $this->datatables->select('periode,id_rule,name,id_trx');
            $this->datatables->from('magang_rule');
            $this->datatables->where('periode',$periode);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/magang/delete_rule/$1'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="Delete" class="btn btn-danger" ')
            , 'id_trx');
            return $this->datatables->generate();
    }

    function json_periode_rule_ta_s1($periode)
	{
            $this->datatables->select('periode,id_rule,name,id_trx');
            $this->datatables->from('ta_s1_rule');
            $this->datatables->where('periode',$periode);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_s1/delete_rule/$1'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="Delete" class="btn btn-danger" ')
            , 'id_trx');
            return $this->datatables->generate();
    }

    function json_periode_rule_wisuda($id_trx)
	{
            $this->datatables->select('id_wisuda_rule,id_trx,name,id_rule');
            $this->datatables->from('wisuda_rule');
            $this->datatables->where('id_trx',$id_trx);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/wisuda/delete_rule/$1'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="Delete" class="btn btn-danger" ')
            , 'id_wisuda_rule');
            return $this->datatables->generate();
    }

    function json_list_periode_s1()
	{
            $this->datatables->select('*,periode');
            $this->datatables->from('ta_s1_list');
            $this->datatables->join('dikti_semester','dikti_semester.id_semester=ta_s1_list.periode');
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_s1/periode_edit/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Edit" class="btn btn-warning" ').' '.
            anchor(
                site_url('baak/tugas_akhir/ta_s1/periode_rule/$1'),'<i class="fa fa-key"></i>','data-toggle="tooltip" data-html="true" title="rule" class="btn btn-info" ').' '.
            anchor(
                site_url('baak/tugas_akhir/ta_s1/dashboard/$1'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="dasboard" class="btn btn-info" ')
            , 'periode');
            return $this->datatables->generate();
    }

    function json_list_periode_d3()
	{
            $this->datatables->select('*,periode');
            $this->datatables->from('ta_d3_list');
            $this->datatables->join('dikti_semester','dikti_semester.id_semester=ta_d3_list.periode');
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_d3/periode_edit/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Edit" class="btn btn-warning" ').' '.
            anchor(
                site_url('baak/tugas_akhir/ta_d3/periode_rule/$1'),'<i class="fa fa-key"></i>','data-toggle="tooltip" data-html="true" title="rule" class="btn btn-info" ').' '.
            anchor(
                site_url('baak/tugas_akhir/ta_d3/dashboard/$1'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="dasboard" class="btn btn-info" ')
            , 'periode');
            return $this->datatables->generate();
    }

    function json_list_pendaftar_ta_s1($periode)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('v_ta_s1_mhs_list');
            $this->datatables->where('periode',$periode);
            $this->datatables->where('progres',"daftar");
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_s1/plot_dosen/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="plot pembimbing" class="btn btn-warning" ')
            
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_all_data_ta_s1($periode)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('v_ta_s1_mhs_list');
            $this->datatables->where('periode',$periode);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_s1/plot_dosen/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="plot pembimbing" class="btn btn-warning" ')
            
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_all_data_ta_d3($periode)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('v_ta_d3_mhs_list');
            $this->datatables->where('periode',$periode);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_d3/plot_dosen/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="plot pembimbing" class="btn btn-warning" ')
            
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_list_periode_s1_mhs()
	{
            $this->datatables->select('*,ta_s1_list.periode');
            $this->datatables->from('ta_s1_list');
            $this->datatables->join('dikti_semester','dikti_semester.id_semester=ta_s1_list.periode');
            $this->datatables->where('status','open');
            $this->datatables->where('periode_akhir >=',date('Y-m-d'));
            $this->datatables->add_column('action',
            anchor(
                site_url('mahasiswa/ta_s1/daftar/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="daftar" class="btn btn-warning" ')." ".
            anchor(
                site_url('mahasiswa/ta_s1/dashboard/$1'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="dashboard" class="btn btn-info" ')
            , 'periode');
            return $this->datatables->generate();
    }

    function json_list_periode_wisuda_mhs()
	{
            $this->datatables->select('*,id_trx');
            $this->datatables->from('wisuda_periode');
            $this->datatables->where('status','open');
            $this->datatables->where('tutup_daftar >=',date('Y-m-d'));
            $this->datatables->add_column('action',
            anchor(
                site_url('mahasiswa/wisuda/daftar/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="daftar" class="btn btn-warning" ')." ".
            anchor(
                site_url('mahasiswa/wisuda/dashboard/$1'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="dashboard" class="btn btn-info" ')
            , 'id_trx');
            return $this->datatables->generate();
    }

    function json_list_sidang_ta_s1($sidang,$periode)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('ta_s1_jadwal_sidang');
            $this->datatables->join('dikti_prodi','dikti_prodi.kode_program_studi=ta_s1_jadwal_sidang.kode_prodi');
            $this->datatables->where('periode',$periode);
            $this->datatables->where('sidang',$sidang);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_s1/sidang_ta_s1_edit/$1/$2'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Edit" class="btn btn-info" ').' | '.
            anchor(
                site_url('baak/tugas_akhir/ta_s1/plot_jadwal_sidang/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="plot Jadwal Sidang" class="btn btn-warning" ')
            
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_list_sidang_ta_d3($sidang,$periode)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('ta_d3_jadwal_sidang');
            $this->datatables->join('dikti_prodi','dikti_prodi.kode_program_studi=ta_d3_jadwal_sidang.kode_prodi');
            $this->datatables->where('periode',$periode);
            $this->datatables->where('sidang',$sidang);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_d3/sidang_ta_d3_edit/$1/$2'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Edit" class="btn btn-info" ').' | '.
            anchor(
                site_url('baak/tugas_akhir/ta_d3/plot_jadwal_sidang/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="plot Jadwal Sidang" class="btn btn-warning" ')
            
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_list_jadwal_sidang_ta_s1($id_trx)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('v_ta_s1_mhs_sidang');
            $this->datatables->where('id_sidang',$id_trx);
            // $this->datatables->where_in('progres',["daftar","sidang"]);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_s1/plot_sidang_ta_s1/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="plot jadwal sidang" class="btn btn-warning" ')." | ".
            anchor(
                site_url('baak/tugas_akhir/ta_s1/penilaian/$1/$2'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Penilaian" class="btn btn-primary" ')
            
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_list_yudusium_s1($periode)
	{
            $this->datatables->select('*,id,periode');
            $this->datatables->from('yudisium');
            $this->datatables->join('dikti_prodi','dikti_prodi.kode_program_studi=yudisium.kode_prodi');
            $this->datatables->where('periode',$periode);
            // $this->datatables->where_in('progres',["daftar","sidang"]);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_s1/yudisium_edit/$1/$2'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="edit yudisium" class="btn btn-warning" ')." | ".
            anchor(
                site_url('baak/tugas_akhir/ta_s1/yudisium_daftar/$1/$2'),'<i class="fa fa-user"></i>','data-toggle="tooltip" data-html="true" title="pendaftar" class="btn btn-primary" ')
            
            , 'id,periode');
            return $this->datatables->generate();
    }

    function json_list_yudisium_daftar($id_trx)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('v_yudisium_mhs');
            $this->datatables->where('id_yudisium',$id_trx);
            // $this->datatables->where_in('progres',["daftar","sidang"]);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_s1/daftar_yudisium/$1/$2'),'<i class="fa fa-eye"></i>','data-toggle="tooltip" data-html="true" title="Riwayat perkuliahan" class="btn btn-warning" ')
            
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_list_periode_wisuda()
	{
            $this->datatables->select('*,id_trx');
            $this->datatables->from('wisuda_periode');
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/wisuda/periode_wisuda_edit/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Edit" class="btn btn-warning" ').' '.
            anchor(
                site_url('baak/wisuda/periode_rule/$1'),'<i class="fa fa-key"></i>','data-toggle="tooltip" data-html="true" title="rule" class="btn btn-info" ').' '.
            anchor(
                site_url('baak/wisuda/list_pendaftar/$1'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="dasboard" class="btn btn-info" ')
            , 'id_trx');
            return $this->datatables->generate();
    }

    function json_list_pendaftar_wisuda($id_wisuda)
	{
        $img= '<img height=\"60px\" width=\"40px\" src=\"'.base_url('assets/berkas/wisuda/');
        $img2='\" />';
            $this->datatables->select('*,wisuda_mhs.nim,wisuda_mhs.nama,concat("'.$img.'",berkas,"'.$img2.'") as foto');
            $this->datatables->from('wisuda_mhs');
            $this->datatables->join('mahasiswa','mahasiswa.nim=wisuda_mhs.nim');
            $this->datatables->join('dikti_prodi','mahasiswa.kode_prodi=dikti_prodi.kode_program_studi');
            $this->datatables->where('id_wisuda',$id_wisuda);
            // $this->datatables->add_column('action',
            // anchor(
            //     site_url('baak/wisuda/list_pendaftar/$1'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="dasboard" class="btn btn-info" ')
            // , 'id_trx');
            return $this->datatables->generate();
    }

    function json_list_trankript()
	{
            $this->datatables->select('*,mahasiswa.nim,"i" as file_backup');
            $this->datatables->from('yudisium_mhs');
            $this->datatables->join('mahasiswa','yudisium_mhs.nim=mahasiswa.nim');
            $this->datatables->join('dikti_prodi','mahasiswa.kode_prodi=dikti_prodi.kode_program_studi');
            
            $this->datatables->where('progres','disetujui');
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/transkript/cetak_trankript/$1'),'Transkrip','target="_blank" data-toggle="tooltip" data-html="true" title="Cetak Transkript" class="btn btn-warning" ').' '.
            anchor(
                site_url('baak/wisuda/periode_rule/$1'),'Ijazah','target="_blank" data-toggle="tooltip" data-html="true" title="Cetak Ijazah" class="btn btn-warning" ').' '.
            anchor(
                site_url('baak/wisuda/list_pendaftar/$1'),'<i class="fa fa-upload"></i>','data-toggle="tooltip" data-html="true" title="upload" class="btn btn-info" ')
            , 'nim');
            return $this->datatables->generate();
    }

    function json_periode_rule_ta_d3($periode)
	{
            $this->datatables->select('periode,id_rule,name,id_trx');
            $this->datatables->from('ta_d3_rule');
            $this->datatables->where('periode',$periode);
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_d3/delete_rule/$1'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="Delete" class="btn btn-danger" ')
            , 'id_trx');
            return $this->datatables->generate();
    }

    function json_list_pendaftar_ta_d3($periode)
	{
            $this->datatables->select('*,id_trx,periode');
            $this->datatables->from('v_ta_d3_mhs_list');
            $this->datatables->where('periode',$periode);
            $this->datatables->where('progres',"daftar");
            $this->datatables->add_column('action',
            anchor(
                site_url('baak/tugas_akhir/ta_d3/plot_dosen/$1/$2'),'<i class="fa fa-random"></i>','data-toggle="tooltip" data-html="true" title="plot pembimbing" class="btn btn-warning" ')
            
            , 'id_trx,periode');
            return $this->datatables->generate();
    }

    function json_list_periode_d3_mhs()
	{
            $this->datatables->select('*,ta_d3_list.periode');
            $this->datatables->from('ta_d3_list');
            $this->datatables->join('dikti_semester','dikti_semester.id_semester=ta_d3_list.periode');
            $this->datatables->where('status','open');
            $this->datatables->where('periode_akhir >=',date('Y-m-d'));
            $this->datatables->add_column('action',
            anchor(
                site_url('mahasiswa/ta_d3/daftar/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="daftar" class="btn btn-warning" ')." ".
            anchor(
                site_url('mahasiswa/ta_d3/dashboard/$1'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="dashboard" class="btn btn-info" ')
            , 'periode');
            return $this->datatables->generate();
    }

 
}
