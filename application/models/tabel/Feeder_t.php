<?php
class Feeder_t extends CI_Model{//baku
	function __construct()
	{
        parent::__construct();
        $this->load->library('Master_lib');
    }
    
    function kelas_perkuliahan()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_kelas_perkuliahan'),
                'header'=>'Master Data Kelas Perkuliahan',
                'tabel_detail'=>'Master Data Kelas Perkuliahan',
                
                'button_name'=>'1. Push Data Kelas',
                'button_action_link'=>base_url('admin/feeder/f_InsertKelasKuliah'),
                'button_icon'=>'fa fa-upload',
                
                'button_name2'=>'2. Push Data pengajar',
                'button_action_link2'=>base_url('admin/feeder/f_InsertDosenPengajarKelasKuliah'),
                'button_icon2'=>'fa fa-upload',

                'button_name3'=>'3. Push Data Peserta (mahasiswa)',
                'button_action_link3'=>base_url('admin/feeder/f_InsertPesertaKelasKuliah'),
                'button_icon3'=>'fa fa-upload',

                'button_name4'=>'4. Push Data Nilai',
                'button_action_link4'=>base_url('admin/feeder/f_UpdateNilaiPerkuliahanKelas'),
                'button_icon4'=>'fa fa-upload',
            );

            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'kode_mata_kuliah',
                    'nama'=>'kode_mata_kuliah',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mata_kuliah',
                    'nama'=>'nama_mata_kuliah',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_id_dosen',
                    'nama'=>'dosen',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_kelas',
                    'nama'=>'nama_kelas',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_kelas_feeder',
                    'nama'=>'id Kelas Feeder',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'feeder_info',
                    'nama'=>'Info Feeder',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function matakuliah()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_matakuliah'),
                'header'=>'Master Data matakuliah',
                'tabel_detail'=>'Master Data matakuliah',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetListmatakuliah'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'kode_mata_kuliah',
                    'nama'=>'kode_mata_kuliah',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mata_kuliah',
                    'nama'=>'nama_mata_kuliah',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_jenis_mata_kuliah',
                    'nama'=>'id_jenis_mata_kuliah',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_kelompok_mata_kuliah',
                    'nama'=>'id_kelompok_mata_kuliah',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function kurikulum()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_kurikulum'),
                'header'=>'Master Data kurikulum',
                'tabel_detail'=>'Master Data kurikulum',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetListKurikulum'),
                'button_icon'=>'fa fa-download',
               
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_kurikulum',
                    'nama'=>'id_kurikulum',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_kurikulum',
                    'nama'=>'nama_kurikulum',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_semester',
                    'nama'=>'id_semester',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'kode_program_studi',
                    'nama'=>'kode_prodi',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function matakuliah_kurikulum()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_matakuliah_kurikulum'),
                'header'=>'Master Data matakuliah_kurikulum',
                'tabel_detail'=>'Master Data matakuliah_kurikulum',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetMatkulKurikulum'),
                'button_icon'=>'fa fa-download',
              
            );

            $data_isi=array(
                [
                    'code_nama'=>'semester',
                    'nama'=>'semester',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_matkul',
                    'nama'=>'id_matkul',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_kurikulum',
                    'nama'=>'id_kurikulum',
                    'orderable'=>'1',
                ],
                
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function mahasiswa()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_mahasiswa'),
                'header'=>'Master Data Mahasiswa',
                'tabel_detail'=>'Master Data Mahasiswa',
                
                'button_name'=>'Download Data from feeder',
                'button_action_link'=>base_url('admin/feeder/f_GetListMahasiswa_select'),
                'button_icon'=>'fa fa-download',

                'button_name2'=>'Upload SIKU',
                'button_action_link2'=>base_url('admin/super/upload_siku_select'),
                'button_icon2'=>'fa fa-upload',

                // 'button_name3'=>'Upload Alumni',
                // 'button_action_link3'=>base_url('admin/super/upload_alumni_select'),
                // 'button_icon3'=>'fa fa-upload',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'NIM',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_periode_masuk',
                    'nama'=>'id_periode_masuk',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function dosen()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_dosen'),
                'header'=>'Master Data dosen',
                'tabel_detail'=>'Master Data dosen',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetListDosen'),
                'button_icon'=>'fa fa-download',

                'button_name2'=>'Download Penugasan Dosen',
                'button_action_link2'=>base_url('admin/feeder/f_GetListPenugasanDosen'),
                'button_icon2'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nip',
                    'nama'=>'nip',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nidn',
                    'nama'=>'nidn',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status_pegawai',
                    'nama'=>'status_pegawai',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'homebase',
                    'nama'=>'homebase',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }


    function prodi()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_prodi'),
                'header'=>'Master Data prodi',
                'tabel_detail'=>'Master Data prodi',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetProdi'),
                'button_icon'=>'fa fa-download',
              
            );

            $data_isi=array(
                
                [
                    'code_nama'=>'kode_program_studi',
                    'nama'=>'kode_program_studi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'nama_program_studi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_jenjang_pendidikan',
                    'nama'=>'nama_jenjang_pendidikan',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }


    function agama()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_agama'),
                'header'=>'Master Data agama',
                'tabel_detail'=>'Master Data agama',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetAgama'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_agama',
                    'nama'=>'id_agama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_agama',
                    'nama'=>'nama_agama',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function jalurmasuk()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_jalurmasuk'),
                'header'=>'Master Data jalurmasuk',
                'tabel_detail'=>'Master Data jalurmasuk',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetJalurMasuk'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_jalur_masuk',
                    'nama'=>'id_jalur_masuk',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_jalur_masuk',
                    'nama'=>'nama_jalur_masuk',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function jalurkeluar()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_jalurkeluar'),
                'header'=>'Master Data Jlur keluar',
                'tabel_detail'=>'Master Data Jalur Keluar',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetJalurkeluar'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_jenis_keluar',
                    'nama'=>'id_jenis_keluar',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'jenis_keluar',
                    'nama'=>'jenis_keluar',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'apa_mahasiswa',
                    'nama'=>'apa_mahasiswa',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function jenispendaftaran()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_jenispendaftaran'),
                'header'=>'Master Data Jenis Pendaftaran',
                'tabel_detail'=>'Master Data Jenis Pendaftaran',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetJenisPendaftaran'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_Jenis_daftar',
                    'nama'=>'id_Jenis_daftar',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_jenis_daftar',
                    'nama'=>'nama_jenis_daftar',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'untuk_daftar_sekolah',
                    'nama'=>'untuk_daftar_sekolah',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function jenistinggal()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_jenistinggal'),
                'header'=>'Master Data Jenis Tinggal',
                'tabel_detail'=>'Master Data Jenis Tinggal',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetJenisTinggal'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_jenis_tinggal',
                    'nama'=>'id_jenis_tinggal',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_jenis_tinggal',
                    'nama'=>'nama_jenis_tinggal',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function jenjangpendidikan()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_jenjangpendidikan'),
                'header'=>'Master Data jenjang Pendidikan',
                'tabel_detail'=>'Master Data jenjang Pendidikan',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetJenjangPendidikan'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_jenjang_didik',
                    'nama'=>'id_jenjang_didik',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_jenjang_didik',
                    'nama'=>'nama_jenjang_didik',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function pekerjaan()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_pekerjaan'),
                'header'=>'Master Data pekerjaan',
                'tabel_detail'=>'Master Data pekerjaan',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetPekerjaan'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_pekerjaan',
                    'nama'=>'id_pekerjaan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_pekerjaan',
                    'nama'=>'nama_pekerjaan',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    

    function pembiayaan()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_pembiayaan'),
                'header'=>'Master Data pembiayaan',
                'tabel_detail'=>'Master Data pembiayaan',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetPembiayaan'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_pembiayaan',
                    'nama'=>'id_pembiayaan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_pembiayaan',
                    'nama'=>'nama_pembiayaan',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    

    function penghasilan()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_penghasilan'),
                'header'=>'Master Data penghasilan',
                'tabel_detail'=>'Master Data penghasilan',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetPenghasilan'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_penghasilan',
                    'nama'=>'id_penghasilan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_penghasilan',
                    'nama'=>'nama_penghasilan',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    

    function wilayah()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_wilayah'),
                'header'=>'Master Data wilayah',
                'tabel_detail'=>'Master Data wilayah',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetWilayah'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_wilayah',
                    'nama'=>'id_wilayah',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_negara',
                    'nama'=>'id_negara',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_wilayah',
                    'nama'=>'nama_wilayah',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    

    function tahunajaran()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_tahunajaran'),
                'header'=>'Master Data tahun ajaran',
                'tabel_detail'=>'Master Data tahun ajaran',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetTahunAjaran'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_tahun_ajaran',
                    'nama'=>'id_tahun_ajaran',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_tahun_ajaran',
                    'nama'=>'nama_tahun_ajaran',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'a_periode_aktif',
                    'nama'=>'a_periode_aktif',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_mulai',
                    'nama'=>'tanggal_mulai',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_selesai',
                    'nama'=>'tanggal_selesai',
                    'orderable'=>'1',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    

    function statusmahasiswa()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_statusmahasiswa'),
                'header'=>'Master Data status mahasiswa',
                'tabel_detail'=>'Master Data status mahasiswa',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetStatusMahasiswa'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_status_mahasiswa',
                    'nama'=>'id_status_mahasiswa',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_status_mahasiswa',
                    'nama'=>'nama_status_mahasiswa',
                    'orderable'=>'1',
                ],
               
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    

    function statusaktif()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_statusaktif'),
                'header'=>'Master Data status aktif',
                'tabel_detail'=>'Master Data status aktif',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetStatusKeaktifanPegawai'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_status_aktif',
                    'nama'=>'id_status_aktif',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_status_aktif',
                    'nama'=>'nama_status_aktif',
                    'orderable'=>'1',
                ],
               
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    

    function semester()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_semester'),
                'header'=>'Master Data semester',
                'tabel_detail'=>'Master Data semester',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetSemester'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_semester',
                    'nama'=>'id_semester',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_tahun_ajaran',
                    'nama'=>'id_tahun_ajaran',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_semester',
                    'nama'=>'nama_semester',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'semester',
                    'nama'=>'semester',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'a_periode_aktif',
                    'nama'=>'a_periode_aktif',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_mulai',
                    'nama'=>'tanggal_mulai',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_selesai',
                    'nama'=>'tanggal_selesai',
                    'orderable'=>'1',
                ],
               
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    

    function sdm()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_sdm'),
                'header'=>'Master Data sdm',
                'tabel_detail'=>'Master Data sdm',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetIkatanKerjaSdm'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_ikatan_kerja',
                    'nama'=>'id_ikatan_kerja',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_ikatan_kerja',
                    'nama'=>'nama_ikatan_kerja',
                    'orderable'=>'1',
                ],
                
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function riwayatnilai()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_riwayatnilai'),
                'header'=>'Master Data Nilai, Periode : '.$this->session->userdata('set_periode')['periode'],
                'tabel_detail'=>'Master Data Nilai, Periode : '.$this->session->userdata('set_periode')['periode'],
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetRiwayatNilaiMahasiswa'),
                'button_icon'=>'fa fa-download',

                'button_name2'=>'Update Nilai Angka',
                'button_action_link2'=>base_url('admin/feeder/f_GetRiwayatNilaiMahasiswa_update'),
                'button_icon2'=>'fa fa-pencil',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_trx',
                    'nama'=>'id_trx',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'periode',
                    'nama'=>'periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_matkul',
                    'nama'=>'id_matkul',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_registrasi_mahasiswa',
                    'nama'=>'id_registrasi_mahasiswa',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nilai_angka',
                    'nama'=>'nilai_angka',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'feeder_nilai',
                    'nama'=>'nilai_di_feeder',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_kelas',
                    'nama'=>'id_kelas',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'feeder_update_nilai',
                    'nama'=>'feeder_update_nilai',
                    'orderable'=>'1',
                ],
                
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    

    function transportasi()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_transportasi'),
                'header'=>'Master Data transportasi',
                'tabel_detail'=>'Master Data transportasi',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetAlatTransportasi'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_alat_transportasi',
                    'nama'=>'id_alat_transportasi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_alat_transportasi',
                    'nama'=>'nama_alat_transportasi',
                    'orderable'=>'1',
                ],
                
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function mahasiswa_riwayat_pendidikan()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_mahasiswa_riwayat_pendidikan'),
                'header'=>'Master Data Riwayat Pendidikan Mahasiswa',
                'tabel_detail'=>'Master Data Riwayat Pendidikan Mahasiswa',
                
                'button_name'=>'Download Data',
                'button_action_link'=>base_url('admin/feeder/f_GetListRiwayatPendidikanMahasiswa'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'nim',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_jenis_daftar',
                    'nama'=>'id_jenis_daftar',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi_asal',
                    'nama'=>'nama_program_studi_asal',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_prodi_asal',
                    'nama'=>'id_prodi_asal',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_perguruan_tinggi_asal',
                    'nama'=>'id_perguruan_tinggi_asal',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_perguruan_tinggi_asal',
                    'nama'=>'nama_perguruan_tinggi_asal',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'sks_diakui',
                    'nama'=>'sks_diakui',
                    'orderable'=>'1',
                ],

                
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function user_list()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/super/user_list'),
                'header'=>'User List',
                'tabel_detail'=>'User List',
            );

            $data_isi=array(
                [
                    'code_nama'=>'username',
                    'nama'=>'Username',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'create_at',
                    'nama'=>'Create at',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'role',
                    'nama'=>'Role',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'user_status',
                    'nama'=>'Status',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'action',
                    'orderable'=>'1',
                ],

                
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }


    function f_GetNilaiTransferPendidikanMahasiswa_list()
    {
            $data_detail=array(
                'link_json'=>base_url('admin/feeder/json_GetNilaiTransferPendidikanMahasiswa_list'),
                'header'=>'User List',
                'tabel_detail'=>'User List',

                'button_name'=>'Download Data periode : '.$this->session->userdata('set_periode')['periode'],
                'button_action_link'=>base_url('admin/feeder/f_GetNilaiTransferPendidikanMahasiswa'),
                'button_icon'=>'fa fa-download',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'nim',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'periode',
                    'nama'=>'periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mata_kuliah',
                    'nama'=>'Nama MK',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nilai_huruf',
                    'nama'=>'nilai_huruf',
                    'orderable'=>'1',
                ],

                
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    
    
  

}
