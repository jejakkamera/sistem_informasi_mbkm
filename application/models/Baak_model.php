<?php
class Baak_model extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
	

	}

    function rekap_aktivitas_mahasiswa($where)
    {
        $this->db->select('avg(aktivitas_perkuliahan_siakad.ips) as rerata_ips, avg(aktivitas_perkuliahan_siakad.ipk) as rerata_ipk, max(aktivitas_perkuliahan_siakad.ips) as max_ips, max(aktivitas_perkuliahan_siakad.ipk) as max_ipk, min(aktivitas_perkuliahan_siakad.ips) as min_ips, min(aktivitas_perkuliahan_siakad.ipk) as min_ipk,
        count(IF(ipk = 0, 1, null)) AS zero,
        count(IF(ipk > 0 and ipk <= 1, 1, null)) AS zero_one,
        count(IF(ipk > 1 and ipk <= 2, 1, null)) AS one_two,
        count(IF(ipk > 2 and ipk <= 3, 1, null)) AS two_tree,
        count(IF(ipk > 3 and ipk <= 3.5, 1, null)) AS tree_tree_h,
        count(IF(ipk > 3.5 and ipk <= 4, 1, null))  AS tree_h_four,count(*) as total,
        count(IF(id_status_mahasiswa="AKTIF", 1, null))  AS total_aktif');
        $this->db->from('aktivitas_perkuliahan_siakad');
        $this->db->where($where);
        $this->db->where('id_status_mahasiswa','AKTIF');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

    function get_nilai_skala($periode,$kode_prodi,$nilai)
    {
        $this->db->select('nilai_huruf,nilai_index');
        $this->db->from('nilai_skala');
        $this->db->where('periode',$periode);
        $this->db->where('kode_prodi',$kode_prodi);
        $this->db->where('bobot_minimum <=',$nilai);
        $this->db->where('bobot_maximum >=',$nilai);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->row();
     
     else
     
            return null;
    }
    
    function history_nilai($id_trx)
    {
        $this->db->select('nilai_asal,nilai_berubah,date,komponen,log');
        $this->db->from('history_nilai');
        $this->db->join('nilai_komponen','nilai_komponen.id=history_nilai.id_komponen');
        $this->db->where('id_trx_frs',$id_trx);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }


    function list_aktivitas_mahasiswa($where)
    {
        $this->db->select('*');
        $this->db->from('aktivitas_perkuliahan_siakad');
        $this->db->join('v_mahasiswa','v_mahasiswa.nim=aktivitas_perkuliahan_siakad.nim');
        $this->db->join('dikti_semester','dikti_semester.id_semester=aktivitas_perkuliahan_siakad.id_periode');
        $this->db->where($where);
        $this->db->where('id_status_mahasiswa','AKTIF');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

	function InsertPesertaKelasKuliah()
    {
        $this->db->select(' v_jadwal.id_kelas_feeder,frs_mhs_mk.id_registrasi_mahasiswa,frs_mhs_mk.id_trx');
        $this->db->from('v_jadwal');
        $this->db->join('frs_mhs_mk','v_jadwal.id_matkul=frs_mhs_mk.id_matkul and v_jadwal.periode=frs_mhs_mk.periode');
        $this->db->where('v_jadwal.periode',$this->session->userdata('set_periode')['periode']);
        $this->db->where('v_jadwal.id_kelas_feeder is  NOT NULL');
        $this->db->where('frs_mhs_mk.id_kelas is NULL');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

	function DosenPengajarKelasKuliah()
    {
        $this->db->select(' id_kelas_feeder, sks_mata_kuliah,id_feeder_dosen,id_matkul,id_trx_jadwal,id_registrasi_dosen');
        $this->db->from('v_jadwal');
        $this->db->join('dikti_prodi','dikti_prodi.kode_program_studi=v_jadwal.kode_prodi');
        $this->db->join('dikti_penugasan_dosen','dikti_penugasan_dosen.id_dosen=v_jadwal.id_feeder_dosen and dikti_penugasan_dosen.id_tahun_ajaran = v_jadwal.tahun');
      
        $this->db->where('v_jadwal.periode',$this->session->userdata('set_periode')['periode']);
        $this->db->where('v_jadwal.id_kelas_feeder is  NOT NULL');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

	function kelas_perkuliahan()
    {
        
        $this->db->select('periode, id_matkul, id_kelas, id_kelas_feeder, kode_mata_kuliah, nama_mata_kuliah, kode_prodi,id_prodi,   dikti_prodi.nama_program_studi, nama_kelas,id_trx_jadwal,sks_mata_kuliah');
        $this->db->from('v_jadwal');
        $this->db->join('dikti_prodi','dikti_prodi.kode_program_studi=v_jadwal.kode_prodi');
      
        $this->db->where('v_jadwal.periode',$this->session->userdata('set_periode')['periode']);

        // $this->db->select('periode, id_matkul,  v_frs.id_kelas, status_feeder_id_kelas, kode_mata_kuliah, nama_mata_kuliah, v_frs.kode_prodi,id_prodi, id_kurikulum, semester, nama_program_studi, nama_kelas, if(id_kelas_perkuliahan is null,id_kelas_kuliah_mhs,id_kelas_perkuliahan) as id_kelas_kuliah,v_frs.id_kelas');
        // $this->db->from('v_frs');
        // $this->db->join('dikti_prodi','dikti_prodi.kode_program_studi=v_frs.kode_prodi');
        // $this->db->join('kelas','kelas.id_kelas= if(id_kelas_perkuliahan is null,id_kelas_kuliah_mhs,id_kelas_perkuliahan)','left');
        // $this->db->where('v_frs.periode',$this->session->userdata('set_periode')['periode']);
        // $this->db->where('v_frs.id_kelas is null');
        // $this->db->group_by('id_matkul,v_frs.kode_prodi,nama_kelas');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

	function get_krs($periode)
    {
        $this->db->select('*');
        $this->db->from('v_frs_total_sks');
        $this->db->join('mahasiswa','v_frs_total_sks.id_registrasi_mahasiswa=mahasiswa.id_registrasi_mahasiswa');
        $this->db->where('terakhir_krs',$periode);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

	function jadwal_dosen($id_trx)
    {
        $this->db->select('*');
        $this->db->from('v_jadwal');
        $this->db->where('id_trx_jadwal',$id_trx);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->row();
     
     else
     
            return null;
    }

	function master_matakuliah_jadwal($id_matkul,$periode)
    {
        $this->db->select('*');
        $this->db->from('v_jadwal');
        $this->db->where('id_matkul',$id_matkul);
        $this->db->where('periode',$periode);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

	function waktu_kuliah_get($id_trx)
    {
        $this->db->select('*,status as nama_status');
        $this->db->from('waktu_kulia');
        $this->db->where('id',$id_trx);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

	function master_matakuliah_saji($id_trx)
    {
        $this->db->select('*,id as dosen,nama as nama_dosen');
        $this->db->from('mata_kuliah_saji');
        
        $this->db->join('mata_kuliah','mata_kuliah.id_matkul=mata_kuliah_saji.id_matkul');
        $this->db->join('v_dosen','v_dosen.id=mata_kuliah_saji.id_dosen_pengampu','left');
        $this->db->where('mata_kuliah_saji.id_trx',$id_trx);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

	function mahasiswa_list($where)
    {
        $this->db->select('v_mahasiswa.nim, v_mahasiswa.nama, v_mahasiswa.id_mahasiswa, v_mahasiswa.id_registrasi_mahasiswa, v_mahasiswa.id_periode_masuk, v_mahasiswa.kode_prodi, v_mahasiswa.nama_program_studi, v_mahasiswa.nama_jenjang_pendidikan, v_mahasiswa.status_mahasiswa, v_mahasiswa.id_kurikulum, v_mahasiswa.nama_kurikulum, v_mahasiswa.info, v_mahasiswa.id_kelas, v_mahasiswa.nama_kelas, v_mahasiswa.angkatan');
        $this->db->from('v_mahasiswa');
        $this->db->where($where);
        // $this->db->limit(1);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

	function master_akademik_mhs($nim)
    {
        $this->db->select('v_mahasiswa.nim, v_mahasiswa.nama, v_mahasiswa.id_mahasiswa, v_mahasiswa.id_registrasi_mahasiswa, v_mahasiswa.id_periode_masuk, v_mahasiswa.kode_prodi, v_mahasiswa.nama_program_studi, v_mahasiswa.nama_jenjang_pendidikan, v_mahasiswa.status_mahasiswa, v_mahasiswa.id_kurikulum, v_mahasiswa.nama_kurikulum, v_mahasiswa.info, v_mahasiswa.id_kelas, v_mahasiswa.nama_kelas, v_mahasiswa.angkatan,v_prodi.nama as nama_k_prodi,pegawai.nama as nama_wali_dosen,pegawai.nidn,pegawai.email as email_wali');
        $this->db->from('v_mahasiswa');
        $this->db->join('v_prodi','v_prodi.kode_program_studi=v_mahasiswa.kode_prodi','left');
        $this->db->join('mahasiswa_dosen_wali','mahasiswa_dosen_wali.nim=v_mahasiswa.nim','left');
        $this->db->join('pegawai','mahasiswa_dosen_wali.id_dosen=pegawai.id','left');
        $this->db->where('v_mahasiswa.nim',$nim);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->row();
     
     else
     
            return null;
    }

	function master_get_set_frs()
    {
		$this->db->select('id, id_periode,nama_semester as nama_id_periode, pengisian_frs, tgl_pengisian, tgl_penutupan, last_edit, user_edit');
        $this->db->join('dikti_semester','dikti_semester.id_semester=frs_set.id_periode');
        $this->db->where('id',0);
        return $this->db->get('frs_set')->row();
    }

	function master_get_set_input_nilai()
    {
		$this->db->select('id, id_semester as kode,nama_semester as nama,id_periode,nama_semester as nama_id_periode, pengisian_frs, tgl_pengisian, tgl_penutupan, last_edit, user_edit');
        $this->db->join('dikti_semester','dikti_semester.id_semester=frs_set.id_periode');
        $this->db->where('id',1);
        return $this->db->get('frs_set')->row();
    }
    
	function json_select_dosen($mk)
    {
        $this->db->select('id as kode,concat(nama," - ",nidn) as nama');
        $this->db->from('v_dosen');
        $this->db->like('nama',$mk);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }
    
	function json_id_periode_aktif($mk)
    {
		$this->db->select('id_semester as kode,nama_semester as nama');
        $this->db->join('dikti_semester','dikti_semester.id_semester=frs_set.id_periode');
        $this->db->where('id',0);
        $this->db->like('nama_semester',$mk);
        return $this->db->get('frs_set')->row();
	}
    
	
	function json_select_kelas($mk,$prodi) {
        $this->db->select('id_kelas as kode,concat(angkatan,"-",nama_kelas) as nama');
        $this->db->from('kelas');
        $this->db->like('nama_kelas',$mk);
        $this->db->like('angkatan',$mk);
        $this->db->like('kode_prodi',$prodi);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

	function json_id_periode($mk) {
        $this->db->select('id_semester as kode,nama_semester as nama');
        $this->db->from('dikti_semester');
        $this->db->like('nama_semester',$mk);
        if($this->session->userdata('role')!='pegawai_baak'){
            $this->db->where_in('a_periode_aktif',[1,0]);
        }
        

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

	function json_id_periode_all($mk) {
        $this->db->select('id_semester as kode,nama_semester as nama');
        $this->db->from('dikti_semester');
        $this->db->like('nama_semester',$mk);
        

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

    function json_dosen($mk) {
        $this->db->select('id_dosen as kode,nama as nama');
        $this->db->from('pegawai');
        $this->db->like('id_dosen',$mk);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

	function json_prodi_kode($mk,$jenjang) {
        $this->db->select('kode_program_studi as kode,concat(nama_jenjang_pendidikan,"-",nama_program_studi) as nama');
        $this->db->from('dikti_prodi');
        $this->db->like('nama_program_studi',$mk);
        $this->db->where('status','A');
        if($jenjang!=null){
            $this->db->where('id_jenjang_pendidikan',$jenjang);
        }
        $this->db->order_by('nama_jenjang_pendidikan','asc');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

    function json_id_matkul($mk) {
        $this->db->select('kode_mata_kuliah as kode,concat(kode_mata_kuliah,"-",nama_mata_kuliah) as nama');
        $this->db->from('v_matkul_prasyarat');
        $this->db->like('nama_mata_kuliah',$mk);
        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

    function json_jenjang_didik($mk){
        $this->db->select('id_jenjang_didik as kode,nama_jenjang_didik as nama');
        $this->db->from('dikti_jenjang_pendidikan');
        $this->db->like('nama_jenjang_didik',$mk);
        $this->db->order_by('id_jenjang_didik','asc');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

    function json_prodi_homebase($mk) {
        $this->db->select('kode_program_studi as kode,concat(nama_jenjang_pendidikan,"-",nama_program_studi) as nama');
        $this->db->from('dikti_prodi');
        $this->db->like('nama_program_studi',$mk);
        $this->db->where('status','A');
        $this->db->order_by('nama_jenjang_pendidikan','asc');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

	function json_prodi_id($mk) {
        $this->db->select('kode_program_studi as kode,concat(nama_jenjang_pendidikan,"-",nama_program_studi) as nama');
        $this->db->from('dikti_prodi');
        $this->db->like('nama_program_studi',$mk);
        $this->db->where('status','A');
        $this->db->order_by('nama_jenjang_pendidikan','asc');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

	function plot_dosen_wali($id,$homebase) {
        $this->db->select('mahasiswa.nim,  mahasiswa.kode_prodi, nama, status_mahasiswa,id_dosen ');
        $this->db->from('mahasiswa');
        $this->db->join('mahasiswa_dosen_wali','mahasiswa.nim=mahasiswa_dosen_wali.nim','left');
        //$this->db->join('nama_program_studi','mahasiswa.kode_prodi=dikti_prodi.kode_program_studi');
        //$this->db->where('mahasiswa.kode_prodi',$homebase);
        $this->db->group_start();
            $this->db->where('mahasiswa_dosen_wali.id_dosen IS NULL', null, false);
            $this->db->or_where('mahasiswa_dosen_wali.id_dosen', $id);
        $this->db->group_end();
        //$this->db->where(array('mahasiswa.id_kurikulum'=>null));
        //$this->db->where_in('mahasiswa_dosen_wali.id_dosen',[$id_dosen,'',NULL] );

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

	function plot_set_kurikulum($id_kurikulum,$periode) {
        $this->db->select('v_matakuliah_kurikulum.id_matkul, semester,kode_mata_kuliah,nama_mata_kuliah,sks_mata_kuliah,v_matakuliah_kurikulum.id_kurikulum,mata_kuliah_saji.id_matkul as id_saji,mata_kuliah_saji.id_kurikulum as id_kurikulum_saji,mata_kuliah_saji.periode as periode');
        $this->db->from('v_matakuliah_kurikulum');
        $this->db->join('mata_kuliah_saji','mata_kuliah_saji.id_matkul=v_matakuliah_kurikulum.id_matkul and mata_kuliah_saji.periode='.$periode,'left');
        $this->db->where('v_matakuliah_kurikulum.id_kurikulum',$id_kurikulum);
        $this->db->order_by('semester', 'asc');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

	function plot_kelas($id_kelas,$kode_prodi) {
        $this->db->select('*');
        $this->db->from('v_mahasiswa');
        $this->db->where('v_mahasiswa.kode_prodi',$kode_prodi);
        $this->db->group_start();
            $this->db->where('v_mahasiswa.id_kelas IS NULL', null, false);
            $this->db->or_where('v_mahasiswa.id_kelas', $id_kelas);
            $this->db->or_where('v_mahasiswa.id_kelas', '');
        $this->db->group_end();

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

	function mahasiswa_kurikulum($id_kurikulum) {
        $this->db->select('nim,  mahasiswa.kode_prodi, nama, status_mahasiswa, info_feeder, mahasiswa.id_kurikulum as kurikulum_mhs,kurikulum.id_kurikulum as id_kurikulum,nama_kurikulum');
        $this->db->from('kurikulum');
        $this->db->join('mahasiswa','mahasiswa.kode_prodi=kurikulum.kode_prodi');
        $this->db->where('kurikulum.id_kurikulum',$id_kurikulum);
        //$this->db->where(array('mahasiswa.id_kurikulum'=>null));
        $this->db->group_start();
            $this->db->where('mahasiswa.id_kurikulum IS NULL', null, false);
            $this->db->or_where('mahasiswa.id_kurikulum', $id_kurikulum);
            $this->db->or_where('mahasiswa.id_kurikulum', '');
        $this->db->group_end();

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

	function mahasiswa_list_kurikulum_saji($nim,$periode) {
        $this->db->select('*,frs_mhs_mk.periode as periode_ambil,mata_kuliah_saji.id_matkul as id_matkul,frs_mhs_mk.status_frs as status_frs_');
        $this->db->from('mahasiswa');
        $this->db->join('mata_kuliah_saji','mata_kuliah_saji.id_kurikulum=mahasiswa.id_kurikulum');
        $this->db->join('mata_kuliah','mata_kuliah_saji.id_matkul=mata_kuliah.id_matkul');
        $this->db->join('matakuliah_kurikulum','matakuliah_kurikulum.id_matkul=mata_kuliah_saji.id_matkul and matakuliah_kurikulum.id_kurikulum=mata_kuliah_saji.id_kurikulum');
        $this->db->join('frs_mhs_mk','mahasiswa.id_registrasi_mahasiswa=frs_mhs_mk.id_registrasi_mahasiswa and matakuliah_kurikulum.id_matkul=frs_mhs_mk.id_matkul and frs_mhs_mk.transfer="tidak"','left');
        $this->db->where('mahasiswa.nim',$nim);
        $this->db->where('mata_kuliah_saji.periode',$periode);
        // $this->db->where('frs_mhs_mk.transfer','tidak');
        $this->db->order_by('semester,mata_kuliah.id_matkul', 'asc');
        // $this->db->limit(1);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

	function mahasiswa_list_kurikulum($nim) {
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->join('matakuliah_kurikulum','matakuliah_kurikulum.id_kurikulum=mahasiswa.id_kurikulum');
        $this->db->join('mata_kuliah','matakuliah_kurikulum.id_matkul=mata_kuliah.id_matkul');
        $this->db->where('mahasiswa.nim',$nim);
        $this->db->order_by('semester', 'asc');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
      
    }

	function plot_kelas_action($id_kelas,$duallistbox_demo1) {

        $this->db->query("UPDATE mahasiswa SET id_kelas=null WHERE nim in (SELECT * FROM( SELECT nim FROM mahasiswa WHERE mahasiswa.id_kelas = '".$id_kelas."') tblTmp) ");

        if($duallistbox_demo1){
            $this->db->where_in('nim',$duallistbox_demo1);
            $this->db->update('mahasiswa', ['id_kelas'=>$id_kelas]);
        }
      
    }

	function plot_kurikulum_action($id_kurikulum,$duallistbox_demo1) {

        $this->db->query("UPDATE mahasiswa SET id_kurikulum='' WHERE nim in (SELECT * FROM( SELECT nim FROM kurikulum JOIN mahasiswa on mahasiswa.kode_prodi=kurikulum.kode_prodi WHERE mahasiswa.id_kurikulum = '".$id_kurikulum."') tblTmp) ");
        if($duallistbox_demo1){
            $this->db->where_in('nim',$duallistbox_demo1);
            $this->db->update('mahasiswa', ['id_kurikulum'=>$id_kurikulum]);
        }
        
        // $this->db->query("UPDATE mahasiswa SET id_kurikulum='".$id_kurikulum."' WHERE nim in ".$duallistbox_demo1."  ");
      
    }
    
	function plot_dosen_wali_action($id_dosen,$data) {

        $this->db->query("DELETE FROM `mahasiswa_dosen_wali` WHERE mahasiswa_dosen_wali.nim in (SELECT * FROM( SELECT mahasiswa.nim FROM mahasiswa JOIN mahasiswa_dosen_wali on mahasiswa.nim=mahasiswa_dosen_wali.nim WHERE mahasiswa_dosen_wali.id_dosen = '".$id_dosen."') tblTmp) ");
        if($data){
            $this->db->insert_batch('mahasiswa_dosen_wali', $data);
        }
        
        // $this->db->query("UPDATE mahasiswa SET id_kurikulum='".$id_kurikulum."' WHERE nim in ".$duallistbox_demo1."  ");
      
    }

	function plot_set_kurikulum_action($id_kurikulum,$periode,$data) {

        $this->db->query("DELETE FROM `mata_kuliah_saji` WHERE mata_kuliah_saji.id_kurikulum ='".$id_kurikulum."' and periode = '".$periode."' ");
        if($data){
            $this->db->insert_batch('mata_kuliah_saji', $data);
        }
        
        // $this->db->query("UPDATE mahasiswa SET id_kurikulum='".$id_kurikulum."' WHERE nim in ".$duallistbox_demo1."  ");
      
    }

	function copy_skala_nilai_action($periode,$periode_copy) {

        $this->db->query("DELETE FROM `nilai_skala` WHERE nilai_skala.periode ='".$periode."'");
        $this->db->query("INSERT INTO `nilai_skala`( `periode`, `kode_prodi`, `nilai_huruf`, `nilai_index`, `bobot_minimum`, `bobot_maximum`) 
        SELECT  '".$periode."', `kode_prodi`, `nilai_huruf`, `nilai_index`, `bobot_minimum`, `bobot_maximum` FROM `nilai_skala` WHERE periode='".$periode_copy."'");
      
        
        // $this->db->query("UPDATE mahasiswa SET id_kurikulum='".$id_kurikulum."' WHERE nim in ".$duallistbox_demo1."  ");
      
    }

    function json_waktu_kuliah_select($mk)
    {
        $this->db->select('id as kode,nama_id as nama');
        $this->db->from('waktu_kulia');
        $this->db->like('nama_id',$mk);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

    function f_GetRiwayatNilaiMahasiswa_update() {
        $this->db->query("UPDATE `frs_mhs_mk` SET `nilai_angka`=`feeder_nilai`,`nilai_huruf`=`feeder_nilai_huruf` WHERE `periode`='".$this->session->userdata('set_periode')['periode']."' and `feeder_nilai`!=`nilai_angka`");
    }

    function f_GetRiwayatNilaiMahasiswa_history() {
        $this->db->query("INSERT INTO `history_nilai`( id_trx_history,`id_trx_frs`, `id_komponen`, `nilai_asal`, `nilai_berubah`, `log`)
        SELECT concat(DATE_FORMAT(now(),'%y%m%d%H%i%s'),'_0_',`id_trx`),`id_trx`,0,`nilai_angka`,`feeder_nilai`,'feeder nilai update' FROM `frs_mhs_mk` WHERE `periode`='".$this->session->userdata('set_periode')['periode']."' and `feeder_nilai`!=`nilai_angka`");
    }

    function rekap_presensi_dosen_add_action($id_rekap,$tanggal) {

        $this->db->query(' 
        INSERT INTO rekap_presensi_dosen_detail( 
            id_rekap, 
            id_trx_absen, 
            id_trx_jadwal, 
            id_matkul, 
            id_kelas,
            id_dosen, 
            pertemuan, 
            tanggal_presensi, 
            tanggal_masuk, 
            materi, 
            methode )
        select 
        "'.$id_rekap.'", 
        presensi_dosen.id,
        presensi_dosen.id_trx_jadwal,
        presensi_dosen.id_matkul,
        presensi_dosen.id_kelas,
        mata_kuliah_jadwal.id_dosen,
        pertemuan,
        presensi_dosen.tanggal_presensi,
        presensi_dosen.tanggal_masuk,
        materi,
        methode 
        from presensi_dosen join mata_kuliah_jadwal on mata_kuliah_jadwal.id_trx_jadwal=presensi_dosen.id_trx_jadwal WHERE presensi_dosen.tanggal_masuk <="'.$tanggal.'" AND presensi_dosen.status_rekap = "input" ');
       
        
        // $this->db->query("UPDATE mahasiswa SET id_kurikulum='".$id_kurikulum."' WHERE nim in ".$duallistbox_demo1."  ");
      
    }

    function v_frs_index($periode)
    {
        $this->db->select('*,frs_mhs_mk.id_kelas as id_kelas_kuliah_feeder');
        $this->db->from('frs_mhs_mk');
        $this->db->join('mahasiswa','mahasiswa.id_registrasi_mahasiswa=frs_mhs_mk.id_registrasi_mahasiswa');
        $this->db->join('nilai_skala','mahasiswa.kode_prodi=nilai_skala.kode_prodi and nilai_skala.nilai_huruf=frs_mhs_mk.nilai_huruf and nilai_skala.periode=frs_mhs_mk.periode','left');
        $this->db->where('frs_mhs_mk.periode',$periode);
        $this->db->where('frs_mhs_mk.status_frs','setujui');
        $this->db->where('frs_mhs_mk.transfer','tidak');
        $this->db->where('frs_mhs_mk.id_kelas is not null',null);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

    function json_frs_mhs($periode,$mk,$nim)
    {
        $this->db->select('id_trx as kode,concat(nama_mata_kuliah,"-",kode_mata_kuliah) as nama');
        $this->db->from('v_frs');
        $this->db->like('nama_mata_kuliah',$mk);
        $this->db->like('kode_mata_kuliah',$mk);
        $this->db->where('status_frs','setujui');
        $this->db->where('nim',$nim);
        $this->db->where('periode',$periode);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

    function wisuda_report($id_wisuda)
    {
        $this->db->select('wisuda_mhs.nim,wisuda_mhs.nama,nama_program_studi,nama_jenjang_pendidikan,berkas,tempat_lahir,tanggal_lahir,telepon');
        $this->db->from('wisuda_mhs');
        $this->db->join('mahasiswa','mahasiswa.nim=wisuda_mhs.nim');
        $this->db->join('mahasiswa_profile','mahasiswa_profile.nim=wisuda_mhs.nim');
        $this->db->join('dikti_prodi','mahasiswa.kode_prodi=dikti_prodi.kode_program_studi');
        $this->db->where('id_wisuda',$id_wisuda);
        $this->db->order_by('nim,nama_program_studi');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result();
     
     else
     
            return null;
    }

    function transkript($nim)
	{
        $data = $this->db->query("CALL khs_mhs(".$nim.")");
				$hasil = $data->result_array();
				   /*if ($hasil->num_rows()>0)
					   {
						   $data=$hasil;
						   return $data;

					   }
					   $data= $hasil->free_result();*/
					   return $hasil;
    }

    function daftar_yudisium($id_trx)
	{
		$this->db->select('id_trx, v_yudisium_mhs.nim, nama, status_mahasiswa, kode_program_studi, nama_program_studi, periode, id_yudisium, progres, berkas, tgl_daftar, total_sks_lulus, ipk_lulus, no_ijasah, no_transkrip, judul_indo, judul_ing, pin, ket, jenis_kelamin, alamat, kelurahan, kode_pos, nisn, nik, mahasiswa_profile.tempat_lahir, mahasiswa_profile.tanggal_lahir, nama_ayah, tanggal_lahir_ayah, nik_ayah, no_hp_ayah, tempat_lahir_ayah, id_jenjang_pendidikan_ayah, id_pekerjaan_ayah, id_penghasilan_ayah, id_kebutuhan_khusus_ayah, nama_ibu_kandung, tanggal_lahir_ibu, nik_ibu, no_hp_ibu, tempat_lahir_ibu, id_jenjang_pendidikan_ibu, id_pekerjaan_ibu, id_penghasilan_ibu, id_kebutuhan_khusus_ibu, nama_wali, nik_wali, no_hp_wali, tempat_lahir_wali, tanggal_lahir_wali, id_jenjang_pendidikan_wali, id_pekerjaan_wali, id_penghasilan_wali, id_kebutuhan_khusus_mahasiswa, telepon, mahasiswa_profile.handphone, email, penerima_kps, no_kps, npwp, id_wilayah, id_jenis_tinggal, id_agama, id_alat_transportasi, foto, id_provinsi, id_kabupaten_kota, id_negara, kewarganegaraan, rt, rw, kecamatan');
		$this->db->join('mahasiswa_profile','mahasiswa_profile.nim=v_yudisium_mhs.nim');
        $this->db->where('v_yudisium_mhs.id_trx',$id_trx);
		return $this->db->get('v_yudisium_mhs')->row();
	}

    function cetak_trankript_data($nim)
	{
		$this->db->select('*');
        $this->db->from('v_yudisium_mhs');
        $this->db->join('v_yudisium','v_yudisium.id=v_yudisium_mhs.id_yudisium');
        $this->db->join('mahasiswa_profile','mahasiswa_profile.nim=v_yudisium_mhs.nim');
        $this->db->where('v_yudisium_mhs.nim',$nim);
        $this->db->where('progres','disetujui');

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->row();
     
     else
     
            return null;
	}

    function cetak_trankript_nilai($nim)
	{
		$this->db->select('*');
        $this->db->from('transkip_nilai');
        $this->db->where('nim',$nim);

        $query=$getData=$this->db->get();
     
            if($getData->num_rows() > 0)
     
            return $query->result_array();
     
     else
     
            return null;
	}

    



}
