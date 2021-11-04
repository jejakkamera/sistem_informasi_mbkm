<?php
class Dosen_model extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
	}

	function last_presensi_dosen($id)
    {
		$this->db->select('max(pertemuan) as pertemuan,mata_kuliah_jadwal.id_matkul,mata_kuliah_jadwal.periode,mata_kuliah_jadwal.id_kelas');
		$this->db->join('presensi_dosen','presensi_dosen.id_trx_jadwal=mata_kuliah_jadwal.id_trx_jadwal');
        $this->db->where('mata_kuliah_jadwal.id_trx_jadwal',$id);
        return $this->db->get('mata_kuliah_jadwal')->row();
	}
	function presensi_mahasiswa_pertemuan_list($cek_)
    {
		$this->db->select('v_frs.nim,v_frs.nama,v_frs.periode,v_frs.id_matkul,
		presensi_status_1,
		presensi_status_2,
		presensi_status_3,
		presensi_status_4,
		presensi_status_5,
		presensi_status_6,
		presensi_status_7,
		presensi_status_8,
		presensi_status_9,
		presensi_status_10,
		presensi_status_11,
		presensi_status_12,
		presensi_status_13,
		presensi_status_14,
		presensi_status_15,
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
		');
		$this->db->join('presensi_mahasiswa','presensi_mahasiswa.id_matkul = v_frs.id_matkul and presensi_mahasiswa.periode = v_frs.periode and presensi_mahasiswa.nim = v_frs.nim','left');
        $this->db->where('v_frs.id_matkul',$cek_->id_matkul);
        $this->db->where('v_frs.periode',$cek_->periode);
        return $this->db->get('v_frs')->result();
	}

	function input_nilai_list($cek_,$komponen)
    {
		$this->db->select('v_frs.nim,v_frs.nama,v_frs.periode,v_frs.id_matkul,v_frs.id_trx,nilai,if(update_date is null,insert_date,update_date ) as date_info');
		$this->db->join('frs_mhs_nilai','frs_mhs_nilai.id_trx_frs=v_frs.id_trx and frs_mhs_nilai.id_komponen='.$komponen,'left');
		$this->db->where('v_frs.id_matkul',$cek_->id_matkul);
        $this->db->where('v_frs.periode',$cek_->periode);
        return $this->db->get('v_frs')->result();
	}

	function report_nilai($cek_, $coloum)
    {
		$this->db->select('v_frs.nim,v_frs.nama,v_frs.periode,v_frs.id_matkul,
		'.$coloum.'v_frs.id_trx,nilai_angka,nilai_huruf
		');
		$this->db->join('frs_mhs_nilai','frs_mhs_nilai.id_trx_frs=v_frs.id_trx','left');
		$this->db->where('v_frs.id_matkul',$cek_->id_matkul);
		$this->db->where('v_frs.periode',$cek_->periode);
		$this->db->order_by('id_trx_frs,id_komponen', 'asc');
		$this->db->group_by('nim');
        return $this->db->get('v_frs')->result();
	}

	function daftar_yudisium($id_trx)
	{
		$this->db->select('id_trx, nim, nama, status_mahasiswa, kode_program_studi, nama_program_studi, periode, id_yudisium, progres, berkas, tgl_daftar, total_sks_lulus, ipk_lulus, no_ijasah, no_transkrip, judul_indo, judul_ing, pin, ket');
		$this->db->where('v_yudisium_mhs.id_trx',$id_trx);
		return $this->db->get('v_yudisium_mhs')->row();
	}

	function report_presensi($id_matkul,$periode)
	{
        $this->db->select('v_frs.nim ,
        (sum(if(presensi_status_1="hadir",1,0)+
        if(presensi_status_2="hadir",1,0)+
        if(presensi_status_3="hadir",1,0)+
        if(presensi_status_4="hadir",1,0)+
        if(presensi_status_5="hadir",1,0)+
        if(presensi_status_6="hadir",1,0)+
        if(presensi_status_7="hadir",1,0)+
        if(presensi_status_9="hadir",1,0)+
        if(presensi_status_10="hadir",1,0)+
        if(presensi_status_11="hadir",1,0)+
        if(presensi_status_12="hadir",1,0)+
        if(presensi_status_13="hadir",1,0)+
        if(presensi_status_14="hadir",1,0)+
        if(presensi_status_15="hadir",1,0))/14) * 100 as nilai
        ');
		$this->db->join('presensi_mahasiswa','presensi_mahasiswa.id_matkul = v_frs.id_matkul and presensi_mahasiswa.periode = v_frs.periode and presensi_mahasiswa.nim = v_frs.nim','left');
        $this->db->where('v_frs.id_matkul',$id_matkul);
        $this->db->where('v_frs.periode',$periode);
        $this->db->group_by('v_frs.nim');
		return $this->db->get('v_frs')->result();
    }

}
