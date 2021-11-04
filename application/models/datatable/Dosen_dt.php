<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_dt extends CI_Model {

    function __construct()
	{
        parent::__construct();
        $this->load->library('datatables');
    }

    function json_list_mahasiswa_magang()
	{
        $this->datatables->select('*,nim,periode');
        $this->datatables->from('v_magang_mhs');
        $this->datatables->where('v_magang_mhs.email_dosen',$this->session->userdata('username'));
        $this->datatables->add_column('action',
		anchor(
			site_url('dosen/magang/dashboard_mhs/$1/$2'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="Dashboard" class="btn btn-warning"')
		, 'nim,periode');
        return $this->datatables->generate();
    }

    function json_list_mahasiswa_ta_s1()
	{
        $this->datatables->select('*,nim,periode');
        $this->datatables->from('v_ta_s1_mhs_list');
        $this->datatables->where('v_ta_s1_mhs_list.email_p1',$this->session->userdata('username'));
        $this->datatables->or_where('v_ta_s1_mhs_list.email_p2',$this->session->userdata('username'));
        $this->datatables->or_where('v_ta_s1_mhs_list.email_p3',$this->session->userdata('username'));
        $this->datatables->add_column('action',
		anchor(
			site_url('dosen/ta_s1/dashboard_mhs/$1/$2'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="Dashboard" class="btn btn-warning"')
		, 'nim,periode');
        return $this->datatables->generate();
    }

    function json_list_mahasiswa_ta_d3()
	{
        $this->datatables->select('*,nim,periode');
        $this->datatables->from('v_ta_d3_mhs_list');
        $this->datatables->where('v_ta_d3_mhs_list.email_p1',$this->session->userdata('username'));
        $this->datatables->or_where('v_ta_d3_mhs_list.email_p2',$this->session->userdata('username'));
        $this->datatables->or_where('v_ta_d3_mhs_list.email_p3',$this->session->userdata('username'));
        $this->datatables->add_column('action',
		anchor(
			site_url('dosen/ta_d3/dashboard_mhs/$1/$2'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="Dashboard" class="btn btn-warning"')
		, 'nim,periode');
        return $this->datatables->generate();
    }

    function json_jadwal_dosen($periode)
	{
        $this->datatables->select('id_trx_jadwal, id_matkul, periode, v_jadwal.id_dosen, id_kelas, ruang, waktu, nama_waktu, waktu_jam, hari, last_edit, kode_mata_kuliah, nama_mata_kuliah, kode_prodi, nama_id_dosen, id_status_aktif, email, status_pegawai, nama_kelas, prodi_kelas, angkatan,nama_program_studi');
        $this->datatables->from('v_jadwal');
        // $this->datatables->join('dikti_prodi','v_jadwal.kode_prodi=dikti_prodi.kode_program_studi');
        $this->datatables->where('v_jadwal.periode',$periode);
        $this->datatables->where('v_jadwal.email',$this->session->userdata('username'));
        $this->datatables->add_column('action',
		anchor(
			site_url('dosen/perkuliahan/presensi_dosen/$1'),'<i class="fa fa-user"></i>','data-toggle="tooltip" data-html="true" title="Kehadiran Dosen" class="btn btn-warning"')
		, 'id_trx_jadwal');
        return $this->datatables->generate();
    }

    function json_presensi_dosen($id_trx)
	{
        $this->datatables->select('*,id_trx_jadwal,presensi_dosen.id as presensi_dosen_id');
        $this->datatables->from('presensi_dosen');
        $this->datatables->where('presensi_dosen.id_trx_jadwal',$id_trx);
        $this->datatables->add_column('action',
		anchor(
			site_url('dosen/perkuliahan/presensi_dosen_edit/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Kehadiran mahasiswa" class="btn btn-info"')
        //     ." | ".
        // anchor(
        //     site_url('dosen/perkuliahan/presensi_dosen_delete/$1'),'<i class="fa fa-trash"></i>','data-toggle="tooltip" data-html="true" title="Delete Kelas" class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure Delete $1 ? all your data will be deleted \')"')
		, 'presensi_dosen_id');
        return $this->datatables->generate();
    }

    function presensi_mahasiswa($periode)
	{
        $this->datatables->select('id_trx_jadwal, id_matkul, periode, id_dosen, id_kelas, ruang, waktu, nama_waktu, waktu_jam, hari, last_edit, kode_mata_kuliah, nama_mata_kuliah, kode_prodi, nama_id_dosen, id_status_aktif, email, status_pegawai, nama_kelas, prodi_kelas, angkatan');
        $this->datatables->from('v_jadwal');
        $this->datatables->where('v_jadwal.periode',$periode);
        $this->datatables->where('v_jadwal.email',$this->session->userdata('username'));
        $this->datatables->group_by('v_jadwal.id_matkul');
        $this->datatables->add_column('action',
		anchor(
			site_url('dosen/perkuliahan/presensi_mahasiswa_pertemuan/$1'),'<i class="fa fa-user"></i>','data-toggle="tooltip" data-html="true" title="Kehadiran mahasiswa" class="btn btn-warning"')." | ".
		anchor(
			site_url('dosen/perkuliahan/presensi_mahasiswa_pertemuan_report/$1'),'<i class="fa fa-list"></i>','data-toggle="tooltip" data-html="true" title="Report Kehadiran mahasiswa" class="btn btn-info"')
		, 'id_trx_jadwal');
        return $this->datatables->generate();
    }

    function json_frs_mahasiswa($periode)
	{
        $this->datatables->select($periode.' as periode_a, v_mahasiswa.nim, v_mahasiswa.nama, id_mahasiswa, v_mahasiswa.id_registrasi_mahasiswa, id_periode_masuk, kode_prodi, nama_program_studi, nama_jenjang_pendidikan, status_mahasiswa, id_kurikulum,nama_kurikulum, info,terakhir_krs,status_pilih');
        $this->datatables->from('v_mahasiswa');
        $this->datatables->join('v_frs_las','v_frs_las.id_registrasi_mahasiswa=v_mahasiswa.id_registrasi_mahasiswa');
        if($this->session->userdata('role')=='dosen'){
            $this->datatables->join('mahasiswa_dosen_wali','mahasiswa_dosen_wali.nim=v_mahasiswa.nim');
            $this->datatables->join('pegawai','mahasiswa_dosen_wali.id_dosen=pegawai.id');
            $this->datatables->where('email',$this->session->userdata('username'));
        }
        if($this->session->userdata('role')=='prodi'){
            $this->datatables->where('v_mahasiswa.kode_prodi',$this->session->userdata('username'));
        }
        $this->datatables->like('status_mahasiswa','AKTIF');
        $this->datatables->add_column('action',
		anchor(
			site_url('mahasiswa/profile/detail/$1'),'<i class="fa fa-user"></i>','data-toggle="tooltip" data-html="true" title="Profile" class="btn btn-warning"')." ".
		anchor(
			site_url('dosen/mahasiswa/transkrip_akademik/$1'),'<i class="fa fa-book"></i>','data-toggle="tooltip" data-html="true" title="Aktivitas Akademik" class="btn btn-success"')." ".
		anchor(
			site_url('dosen/mahasiswa/frs_mhs/$1/$2'),'<i class="fa fa-check-square"></i>','data-toggle="tooltip" data-html="true" title="FRS" class="btn btn-info"')
		, 'nim,periode_a');
        return $this->datatables->generate();
    }

    function presensi_mahasiswa_pertemuan($id_trx)
	{
        $this->datatables->select('pertemuan,'.$id_trx.' as id_trx');
        $this->datatables->from('list_pertemuan');
        $this->datatables->add_column('action',
		anchor(
			site_url('dosen/perkuliahan/presensi_mahasiswa_pertemuan_list/$1/$2'),'<i class="fa fa-user"></i>','data-toggle="tooltip" data-html="true" title="Kehadiran mahasiswa" class="btn btn-warning"')
		, 'id_trx,pertemuan');
        return $this->datatables->generate();
    }

    function presensi_mahasiswa_pertemuan_report($cek_)
	{
        $this->datatables->select('v_frs.nim ,v_frs.nama,v_frs.periode,v_frs.id_matkul,
		presensi_status_1 as p1,
		presensi_status_2 as p2,
		presensi_status_3 as p3,
		presensi_status_4 as p4,
		presensi_status_5 as p5,
		presensi_status_6 as p6,
		presensi_status_7 as p7,
		presensi_status_8 as p8,
		presensi_status_9 as p9,
		presensi_status_10 as p10,
		presensi_status_11 as p11,
		presensi_status_12 as p12,
		presensi_status_13 as p13,
		presensi_status_14 as p14,
		presensi_status_15 as p15,
		tanggal_absen_1,
		tanggal_absen_2,
		tanggal_absen_3,
		tanggal_absen_4,
		tanggal_absen_5,
		tanggal_absen_6,
		tanggal_absen_7,
		tanggal_absen_8,
		tanggal_absen_9,
		tanggal_absen_10,
		tanggal_absen_11,
		tanggal_absen_12,
		tanggal_absen_13,
		tanggal_absen_14,
        tanggal_absen_15,
        sum(if(presensi_status_1="hadir",1,0)+
        if(presensi_status_2="hadir",1,0)+
        if(presensi_status_3="hadir",1,0)+
        if(presensi_status_4="hadir",1,0)+
        if(presensi_status_5="hadir",1,0)+
        if(presensi_status_6="hadir",1,0)+
        if(presensi_status_7="hadir",1,0)+
        if(presensi_status_8="hadir",1,0)+
        if(presensi_status_9="hadir",1,0)+
        if(presensi_status_10="hadir",1,0)+
        if(presensi_status_11="hadir",1,0)+
        if(presensi_status_12="hadir",1,0)+
        if(presensi_status_13="hadir",1,0)+
        if(presensi_status_14="hadir",1,0)) as total_hadir
        ');
        $this->datatables->from('v_frs');
		$this->datatables->join('presensi_mahasiswa','presensi_mahasiswa.id_matkul = v_frs.id_matkul and presensi_mahasiswa.periode = v_frs.periode and presensi_mahasiswa.nim = v_frs.nim','left');
        $this->datatables->where('v_frs.id_matkul',$cek_->id_matkul);
        $this->datatables->where('v_frs.periode',$cek_->periode);
        $this->datatables->group_by('v_frs.nim');
        return $this->datatables->generate();
    }

    function json_input_nilai($periode)
	{
        $this->datatables->select('id_trx_jadwal, id_matkul, periode, v_jadwal.id_dosen, id_kelas, ruang, waktu, nama_waktu, waktu_jam, hari, last_edit, kode_mata_kuliah, nama_mata_kuliah, kode_prodi, nama_id_dosen, id_status_aktif, email, status_pegawai, nama_kelas, prodi_kelas, angkatan,"x/x" as total_mhs,nama_program_studi');
        $this->datatables->from('v_jadwal');
        // $this->datatables->join('dikti_prodi','dikti_prodi.kode_program_studi=v_jadwal.kode_prodi');

        $this->datatables->where('v_jadwal.periode',$periode);
        $this->datatables->where('v_jadwal.email',$this->session->userdata('username'));
        $this->datatables->group_by('v_jadwal.id_matkul');
        $this->datatables->add_column('action',
		anchor(
			site_url('dosen/perkuliahan/input_nilai_select/$1'),'<i class="fa fa-pencil"></i>','data-toggle="tooltip" data-html="true" title="Input nilai" class="btn btn-warning"')." | ".
		anchor(
			site_url('dosen/perkuliahan/report_nilai/$1'),'<i class="fa fa-list"></i>','data-toggle="tooltip" data-html="true" title="Report Nilai Perkuliahan" class="btn btn-info"')
		, 'id_trx_jadwal');
        return $this->datatables->generate();
    }


    function json_list_jadwal_sidang_magang()
	{
        $this->datatables->select('*,v_magang_mhs.id_trx,v_magang_mhs.berkas,magang_nilai.berkas as nilai_berkas,if(magang_nilai.berkas is NULL,"Belum ada berkas","Download") as status_berkas',false);
        $this->datatables->from('v_magang_mhs');
        $this->datatables->join('magang_jadwal_sidang','magang_jadwal_sidang.id_trx=v_magang_mhs.id_sidang');
        $this->datatables->join('magang_nilai','magang_nilai.id_trx_magang=v_magang_mhs.id_trx and magang_nilai.email_input="'.$this->session->userdata('username').'"','left');
        $this->datatables->where('progres','sidang');
        $this->datatables->where('email_ketua',$this->session->userdata('username'));
        $this->datatables->or_where('email_penguji_1',$this->session->userdata('username'));
        $this->datatables->or_where('email_penguji_2',$this->session->userdata('username'));
        $this->datatables->or_where('email_penguji_3',$this->session->userdata('username'));
        $this->datatables->add_column('status_berkas_',
		anchor(
			site_url('/assets/berkas/magang/$2'),'<i class="fa fa-download"> $1 </i>','target="_blank" data-toggle="tooltip" data-html="true" title="Upload Nilai" class="btn btn-primary"')
		, 'status_berkas,nilai_berkas');
        $this->datatables->add_column('action',
		anchor(
			site_url('dosen/magang/upload_nilai_sidang/$1'),'<i class="fa fa-upload"></i>','data-toggle="tooltip" data-html="true" title="Upload Nilai" class="btn btn-warning"')." | ".
        anchor(
                site_url('/assets/berkas/magang/$2'),'<i class="fa fa-book"></i>',' target="_blank" data-toggle="tooltip" data-html="true" title="Dokumen Laporan" class="btn btn-info"')
		, 'id_trx,berkas');
        return $this->datatables->generate();
    }

    function json_list_jadwal_sidang_ta_s1()
	{
        $this->datatables->select('*,v_ta_s1_mhs_sidang.id_trx,ta_s1_nilai.berkas as nilai_berkas,if(ta_s1_nilai.berkas is NULL,"Belum ada berkas","Download") as status_berkas,concat("(p1)",nama_p1,"-(p2)",nama_p2,"-(p3)",nama_p3) as pembimbing,v_ta_s1_mhs_sidang.berkas',false);
        $this->datatables->from('v_ta_s1_mhs_sidang');
        $this->datatables->join('ta_s1_nilai','ta_s1_nilai.id_trx_sidang=v_ta_s1_mhs_sidang.id_trx and ta_s1_nilai.email_penginput="'.$this->session->userdata('username').'"','left');
        $this->datatables->where('progres','sidang');
        $this->datatables->where('email_ketua',$this->session->userdata('username'));
        $this->datatables->or_where('email_penguji1',$this->session->userdata('username'));
        $this->datatables->or_where('email_penguji2',$this->session->userdata('username'));
        $this->datatables->or_where('email_penguji3',$this->session->userdata('username'));
        $this->datatables->add_column('status_berkas_',
		anchor(
			site_url('/assets/berkas/ta/$2'),'<i class="fa fa-download"> $1 </i>','target="_blank" data-toggle="tooltip" data-html="true" title="Upload Nilai" class="btn btn-primary"')
		, 'status_berkas,nilai_berkas');
        $this->datatables->add_column('action',
		anchor(
			site_url('dosen/ta_s1/upload_nilai_ta_s1/$1'),'<i class="fa fa-upload"></i>','data-toggle="tooltip" data-html="true" title="Upload Nilai" class="btn btn-warning"')." | ".
        anchor(
                site_url('/assets/berkas/ta/$2'),'<i class="fa fa-book"></i>',' target="_blank" data-toggle="tooltip" data-html="true" title="Dokumen Laporan" class="btn btn-info"')
		, 'id_trx,berkas');
        return $this->datatables->generate();
    }

    function json_list_jadwal_sidang_ta_d3()
	{
        $this->datatables->select('*,v_ta_d3_mhs_sidang.id_trx,ta_d3_nilai.berkas as nilai_berkas,if(ta_d3_nilai.berkas is NULL,"Belum ada berkas","Download") as status_berkas,concat("(p1)",nama_p1,"-(p2)",nama_p2,"-(p3)",nama_p3) as pembimbing,v_ta_d3_mhs_sidang.berkas',false);
        $this->datatables->from('v_ta_d3_mhs_sidang');
        $this->datatables->join('ta_d3_nilai','ta_d3_nilai.id_trx_sidang=v_ta_d3_mhs_sidang.id_trx and ta_d3_nilai.email_penginput="'.$this->session->userdata('username').'"','left');
        $this->datatables->where('progres','sidang');
        $this->datatables->where('email_ketua',$this->session->userdata('username'));
        $this->datatables->or_where('email_penguji1',$this->session->userdata('username'));
        $this->datatables->or_where('email_penguji2',$this->session->userdata('username'));
        $this->datatables->or_where('email_penguji3',$this->session->userdata('username'));
        $this->datatables->add_column('status_berkas_',
		anchor(
			site_url('/assets/berkas/ta/$2'),'<i class="fa fa-download"> $1 </i>','target="_blank" data-toggle="tooltip" data-html="true" title="Upload Nilai" class="btn btn-primary"')
		, 'status_berkas,nilai_berkas');
        $this->datatables->add_column('action',
		anchor(
			site_url('dosen/ta_d3/upload_nilai_ta_d3/$1'),'<i class="fa fa-upload"></i>','data-toggle="tooltip" data-html="true" title="Upload Nilai" class="btn btn-warning"')." | ".
        anchor(
                site_url('/assets/berkas/ta/$2'),'<i class="fa fa-book"></i>',' target="_blank" data-toggle="tooltip" data-html="true" title="Dokumen Laporan" class="btn btn-info"')
		, 'id_trx,berkas');
        return $this->datatables->generate();
    }

}