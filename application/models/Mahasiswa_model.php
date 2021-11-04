<?php
class Mahasiswa_model extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
	}

	function hasil_studi_detail($id_trx_frs)
    {
        $this->db->select('*');
        $this->db->from('frs_mhs_nilai');
        $this->db->join('nilai_komponen','nilai_komponen.id=frs_mhs_nilai.id_komponen');
        $this->db->where('id_trx_frs',$id_trx_frs);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

    function jadwal_sidang_magang($periode,$kode_prodi)
    {
        $this->db->select('*');
        $this->db->from('magang_jadwal_sidang');
        $this->db->where('periode',$periode);
        $this->db->where('kode_prodi',$kode_prodi);
        $this->db->where('tutup_daftar >=',date('Y-m-d'));
        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

    function jadwal_sidang_ta_s1($periode,$kode_prodi)
    {
        $this->db->select('*');
        $this->db->from('ta_s1_jadwal_sidang');
        // $this->db->where('periode',$periode);
        $this->db->where('kode_prodi',$kode_prodi);
        $this->db->where('tutup_daftar >=',date('Y-m-d'));
        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

    function jadwal_sidang_ta_d3($periode,$kode_prodi)
    {
        $this->db->select('*');
        $this->db->from('ta_d3_jadwal_sidang');
        // $this->db->where('periode',$periode);
        $this->db->where('kode_prodi',$kode_prodi);
        $this->db->where('tutup_daftar >=',date('Y-m-d'));
        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

    function jadwal_yudisium($periode,$kode_prodi)
    {
        $this->db->select('*');
        $this->db->from('yudisium');
        // $this->db->where('periode',$periode);
        $this->db->where('kode_prodi',$kode_prodi);
        $this->db->where('tanggal_penutupan >=',date('Y-m-d'));
        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

}
