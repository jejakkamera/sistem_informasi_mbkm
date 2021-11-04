<?php
class Baak_t extends CI_Model{//baku
	function __construct()
	{
        parent::__construct();
        $this->load->library('Master_lib');
    }
    
    function mahasiswa()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_mahasiswa'),
                'header'=>'Master Data Mahasiswa',
                'tabel_detail'=>'Master Data Mahasiswa',
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
                    'code_nama'=>'id_periode_masuk',
                    'nama'=>'Periode Masuk',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi_univ',
                    'nama'=>'Nama Prodi - Univ',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_jenjang_pendidikan',
                    'nama'=>'Jenjang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status_mahasiswa',
                    'nama'=>'Status mahasiswa',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_kurikulum',
                    'nama'=>'Kurikulum',
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

    function prodi()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_prodi'),
                'header'=>'Master Data Program Studi',
                'tabel_detail'=>'Master Data Program Studi',
            );

            $data_isi=array(
                [
                    'code_nama'=>'kode_program_studi',
                    'nama'=>'Kode Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status',
                    'nama'=>'Status',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_jenjang_pendidikan',
                    'nama'=>'Jenjang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama',
                    'nama'=>'Kepala Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nidn',
                    'nama'=>'NIDN Kepala Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function kurikulum_mahasiswa()
    {
       
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_kurikulum_mahasiswa'),
                'header'=>'Master Data kurikulum',
                'tabel_detail'=>'Master Data kurikulum',
               
            );
            
            $data_isi=array(
                [
                    'code_nama'=>'nama_kurikulum',
                    'nama'=>'nama_kurikulum',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_semester',
                    'nama'=>'Mulai Semester',
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
                [
                    'code_nama'=>'total_mhs',
                    'nama'=>'Total MHS',
                    'orderable'=>'0',
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

    function set_kurikulum($periode,$report)
    {
       
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_kurikulum_mahasiswa_set/'.$periode.'/'.$report),
                'header'=>'Master Plot Matakuliah TA : '.$periode,
                'tabel_detail'=>'Master Plot Matakuliah TA : '.$periode,

                'button_name'=>'All Jadwal',
                'button_action_link'=>base_url('baak/frs/jadwal_dosen_all/'.$periode),
                'button_icon'=>'fa fa-graduation-cap',
               
            );

            $data_isi=array(
                [
                    'code_nama'=>'nama_kurikulum',
                    'nama'=>'nama_kurikulum',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_semester',
                    'nama'=>'Mulai Semester',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_jenjang_pendidikan',
                    'nama'=>'Jenjang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'total_mhs',
                    'nama'=>'Total MHS Aktif',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'total_mk',
                    'nama'=>'Total MK Plot',
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

    function kurikulum()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_kurikulum'),
                'header'=>'Master Data kurikulum',
                'tabel_detail'=>'Master Data kurikulum',
               
            );

            $data_isi=array(
                [
                    'code_nama'=>'nama_kurikulum',
                    'nama'=>'nama_kurikulum',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_semester',
                    'nama'=>'Mulai Semester',
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


    function kurikulum_matakuliah($data_kurikulm)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_kurikulum_matakuliah/'.$data_kurikulm->id_kurikulum),
                'header'=>'Kurikulum : '.$data_kurikulm->nama_program_studi.'-'.$data_kurikulm->nama_jenjang_pendidikan.' ('.$data_kurikulm->id_semester.')',
                'tabel_detail'=>'Kurikulum : '.$data_kurikulm->nama_program_studi.'-'.$data_kurikulm->nama_jenjang_pendidikan.' ('.$data_kurikulm->id_semester.')',

                'button_name'=>'List Kurikulum',
                'button_action_link'=>base_url('baak/matakuliah/kurikulum'),
                'button_icon'=>'fa fa-arrow-left',
               
            );

            $data_isi=array(
                [
                    'code_nama'=>'kode_mata_kuliah',
                    'nama'=>'Kode MK',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mata_kuliah',
                    'nama'=>'Nama MK',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'semester',
                    'nama'=>'Semester',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'sks_mata_kuliah',
                    'nama'=>'SKS',
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

    function list_ta()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_list_ta/'),
                'header'=>'List Tahun Akademik ',
                'tabel_detail'=>'List Tahun Akademik',

                // 'button_name'=>'List Kurikulum',
                // 'button_action_link'=>base_url('baak/matakuliah/kurikulum'),
                // 'button_icon'=>'fa fa-arrow-left',
               
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_tahun_ajaran',
                    'nama'=>'Tahun',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_semester',
                    'nama'=>'Periode',
                    'orderable'=>'1',
                ],
                
                [
                    'code_nama'=>'nama_semester',
                    'nama'=>'Nama Periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'semester',
                    'nama'=>'Semester',
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

                
                'button_name'=>'Tambah Dosen',
                'button_action_link'=>base_url('baak/dosen/add_dosen'),
                'button_icon'=>'fa fa-arrow-left',
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
                    'code_nama'=>'nama_homebase',
                    'nama'=>'homebase',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status_email',
                    'nama'=>'Login',
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

    function dosen_wali_mahasiswa()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_dosen_wali_mahasiswa'),
                'header'=>'Master Data dosen',
                'tabel_detail'=>'Master Data dosen',

                'button_name2'=>'Report Dosen Wali',
                'button_action_link2'=>base_url('baak/mahasiswa/dosen_wali_list'),
                'button_icon2'=>'fa fa-list',
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
                    'code_nama'=>'nama_homebase',
                    'nama'=>'homebase',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'total_mhs',
                    'nama'=>'Total Mahasiswa',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'action',
                    'orderable'=>'0',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function dosen_wali_list()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_dosen_wali_list'),
                'header'=>'Master Data dosen',
                'tabel_detail'=>'Master Data dosen',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nip',
                    'nama'=>'nip',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nidn',
                    'nama'=>'nidn',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_dosen',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_homebase',
                    'nama'=>'homebase',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nim',
                    'nama'=>'NIM',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_dmahasiswa',
                    'nama'=>'Nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi_mhs',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status_mahasiswa',
                    'nama'=>'Status Mahasiswa',
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

    function list_pengisian_frs_mhs()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_list_pengisian_frs_mhs'),
                'header'=>'Master Data Isi KRS',
                'tabel_detail'=>'Master Data Isi KRS',
            );

            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'periode',
                    'orderable'=>'1',
                ],
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
                    'code_nama'=>'status_feeder',
                    'nama'=>'status_feeder',
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
                    'code_nama'=>'semester',
                    'nama'=>'semester',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nilai_angka',
                    'nama'=>'nilai_angka',
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

    function list_pengisian_frs_mk()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_list_pengisian_frs_mk'),
                'header'=>'Master Data Isi KRS',
                'tabel_detail'=>'Master Data Isi KRS',
            );

            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'nama_program_studi',
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
                    'code_nama'=>'semester',
                    'nama'=>'semester',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'total',
                    'nama'=>'total mhs',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'action',
                    'orderable'=>'0',
                ],
               
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function list_pengisian_frs_prodi()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_list_pengisian_frs_prodi'),
                'header'=>'Master Data Isi KRS',
                'tabel_detail'=>'Master Data Isi KRS',
            );

            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'periode',
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
                [
                    'code_nama'=>'total',
                    'nama'=>'total mhs',
                    'orderable'=>'0',
                ],
               
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function kelas()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_kelas'),
                'header'=>'Master Kelas Mahasiswa',
                'tabel_detail'=>'Master Kelas Mahasiswa',

                'button_name'=>'Add Kelas',
                'button_action_link'=>base_url('baak/mahasiswa/kelas_add'),
                'button_icon'=>'fa fa-plus',
            );

            $data_isi=array(
                [
                    'code_nama'=>'angkatan',
                    'nama'=>'angkatan',
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
                [
                    'code_nama'=>'nama_kelas',
                    'nama'=>'nama_kelas',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'total',
                    'nama'=>'total mhs',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
                    'orderable'=>'0',
                ],
               
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function list_skala_nilai()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_skala_nilai'),
                'header'=>'Skala Nilai',
                'tabel_detail'=>'Skala nilai',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id_semester',
                    'nama'=>'Periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'total',
                    'nama'=>'Total',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
                    'orderable'=>'0',
                ],
               
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function list_skala_nilai_detail($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_skala_nilai_detail/'.$periode),
                'header'=>'Skala Nilai',
                'tabel_detail'=>'Skala nilai',

                'button_name'=>'Add Skala',
                'button_action_link'=>base_url('baak/baak/skala_nilai_add/'.$periode),
                'button_icon'=>'fa fa-list',
            );

            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'Periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Program Studi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nilai_huruf',
                    'nama'=>'Nilai Huruf',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nilai_index',
                    'nama'=>'Nilai Index',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'bobot_minimum',
                    'nama'=>'Nilai Index',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'bobot_maximum',
                    'nama'=>'Nilai Index',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
                    'orderable'=>'0',
                ],
               
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function jadwal_dosen($id_kurikulum,$periode,$report)
    {
        if($report){
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_jadwal_dosen/'.$id_kurikulum.'/'.$periode),
                'header'=>'Ploting Dosen',
                'tabel_detail'=>'Ploting Dosen',

                'button_name'=>'All Kurikulum',
                'button_action_link'=>base_url('baak/frs/set_kurikulum/report'),
                'button_icon'=>'fa fa-list',

            );
        }else{
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_jadwal_dosen/'.$id_kurikulum.'/'.$periode),
                'header'=>'Ploting Dosen',
                'tabel_detail'=>'Ploting Dosen',

                'button_name'=>'All Kurikulum',
                'button_action_link'=>base_url('baak/frs/set_kurikulum/'),
                'button_icon'=>'fa fa-list',

            );
        }
           

            $data_isi=array(
                [
                    'code_nama'=>'semester',
                    'nama'=>'Semester',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'kode_mata_kuliah',
                    'nama'=>'Kode Mk',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mata_kuliah',
                    'nama'=>'Nama MK',
                    'orderable'=>'1',
                ],
               
                [
                    'code_nama'=>'total_kelas',
                    'nama'=>'Total Kelas',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
                    'orderable'=>'0',
                ],
               
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function jadwal_dosen_all($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_jadwal_dosen_all/'.$periode),
                'header'=>'Ploting Dosen',
                'tabel_detail'=>'Ploting Dosen',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'angkatan',
                    'nama'=>'Angkatan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'kode_mata_kuliah',
                    'nama'=>'Kode Mk',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mata_kuliah',
                    'nama'=>'Nama MK',
                    'orderable'=>'1',
                ],
               
                [
                    'code_nama'=>'nama_id_dosen',
                    'nama'=>'Total Kelas',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_kelas',
                    'nama'=>'Kelas',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'hari',
                    'nama'=>'Hari',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_waktu',
                    'nama'=>'Waktu',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
                    'orderable'=>'0',
                ],
               
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function peserta_kelas($id_trx)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/peserta_kelas/'.$id_trx),
                'header'=>'Master Data Isi KRS',
                'tabel_detail'=>'Master Data dosen',

                'button_name2'=>'Master plot jadwal',
                'button_action_link2'=>base_url('baak/frs/plot_jadwal_dosen/'.$id_trx),
                'button_icon2'=>'fa fa-list',
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
                    'code_nama'=>'status_feeder',
                    'nama'=>'status_feeder',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'semester',
                    'nama'=>'semester',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nilai_angka',
                    'nama'=>'nilai_angka',
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

    function waktu_kuliah()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_waktu_kuliah/'),
                'header'=>'Waktu Kuliah',
                'tabel_detail'=>'Waktu Kuliah',

                'button_name2'=>'ADD Waktu Kuliah',
                'button_action_link2'=>base_url('baak/baak/waktu_kuliah_add'),
                'button_icon2'=>'fa fa-plus',
            );

            $data_isi=array(
                [
                    'code_nama'=>'id',
                    'nama'=>'kode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'waktu',
                    'nama'=>'waktu',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_id',
                    'nama'=>'keterangan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status',
                    'nama'=>'status',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'action',
                    'orderable'=>'0',
                ],
               
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function prodi_presensi_dosen()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_prodi_presensi_dosen'),
                'header'=>'Master Data Program Studi. Periode :'.$this->session->userdata('set_periode')['periode'],
                'tabel_detail'=>'Master Data Program Studi. Periode :'.$this->session->userdata('set_periode')['periode'],
            );

            $data_isi=array(
                [
                    'code_nama'=>'kode_program_studi',
                    'nama'=>'Kode Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status',
                    'nama'=>'Status',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_jenjang_pendidikan',
                    'nama'=>'Jenjang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function presensi_jadwal_prodi($kode_prodi)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_presensi_jadwal_prodi/'.$kode_prodi),
                'header'=>'Master jadwal. Periode :'.$this->session->userdata('set_periode')['periode'],
                'tabel_detail'=>'Master jadwal. Periode :'.$this->session->userdata('set_periode')['periode'],
            );

            $data_isi=array(
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'matakuliah',
                    'nama'=>'Matakuliah',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_id_dosen',
                    'nama'=>'Dosen',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'kelas',
                    'nama'=>'Kelas',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'hari',
                    'nama'=>'Hari',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'waktu_jam',
                    'nama'=>'jam',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'ruang',
                    'nama'=>'Ruang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'last_pertemuan',
                    'nama'=>'Pertemuan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function presensi_dosen_list($id_trx_jadwal,$cek_)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_presensi_dosen_list/'.$id_trx_jadwal),
                'header'=>'Report presensi dosen',
                'tabel_detail'=>'Report presensi dosen',

                'button_name2'=>'List Jadwal Prodi',
                'button_action_link2'=>base_url('baak/pembelajaran/presensi_jadwal_prodi/'.$cek_->kode_prodi),
                'button_icon2'=>'fa fa-info',

                'button_name'=>'Add Presensi Dosen',
                'button_action_link'=>base_url('baak/pembelajaran/presensi_dosen_add/'.$id_trx_jadwal),
                'button_icon'=>'fa fa-plus',
            );

            $data_isi=array(
                [
                    'code_nama'=>'pertemuan',
                    'nama'=>'Pertemuan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_presensi',
                    'nama'=>'Tanggal Presensi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_masuk',
                    'nama'=>'Tanggal masuk',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'materi',
                    'nama'=>'Materi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'methode',
                    'nama'=>'Methode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status_rekap',
                    'nama'=>'Status',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
                    'orderable'=>'0',
                ],
            );

            
		$data_isi=$this->master_lib->master_list($data_isi);
     
        $data_kirim=array(
			'data_isi'=>$data_isi,
			'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function prodi_presensi_mahasiswa()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_prodi_presensi_mahasiswa'),
                'header'=>'Master Data Program Studi. Periode :'.$this->session->userdata('set_periode')['periode'],
                'tabel_detail'=>'Master Data Program Studi. Periode :'.$this->session->userdata('set_periode')['periode'],
            );

            $data_isi=array(
                [
                    'code_nama'=>'kode_program_studi',
                    'nama'=>'Kode Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status',
                    'nama'=>'Status',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_jenjang_pendidikan',
                    'nama'=>'Jenjang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function presensi_matakuliah_prodi($kode_prodi)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_presensi_matakuliah_prodi/'.$kode_prodi),
                'header'=>'Presensi Perkuliahan Mahasiswa. Periode :'.$this->session->userdata('set_periode')['periode'],
                'tabel_detail'=>'Presensi Perkuliahan Mahasiswa. Periode :'.$this->session->userdata('set_periode')['periode'],
            );

            $data_isi=array(
                [
                    'code_nama'=>'kode_mata_kuliah',
                    'nama'=>'Kode Mk',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mata_kuliah',
                    'nama'=>'Nama MK',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'periode',
                    'nama'=>'Periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function rekap_presensi_dosen()
    {
        if($this->session->userdata('role')=='pegawai_baak'){
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_rekap_presensi_dosen'),
                'header'=>'Rekap presensi dosen. Periode :'.$this->session->userdata('set_periode')['periode'],
                'tabel_detail'=>'Rekap presensi dosen. Periode :'.$this->session->userdata('set_periode')['periode'],

                'button_name'=>'Create Report',
                'button_action_link'=>base_url('baak/pembelajaran/rekap_presensi_dosen_add/'),
                'button_icon'=>'fa fa-plus',
            );
        }else{
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_rekap_presensi_dosen'),
                'header'=>'Rekap presensi dosen. Periode :'.$this->session->userdata('set_periode')['periode'],
                'tabel_detail'=>'Rekap presensi dosen. Periode :'.$this->session->userdata('set_periode')['periode'],
            );
        }
           

            $data_isi=array(
                [
                    'code_nama'=>'tanggal_akhir',
                    'nama'=>'Tanggal Akhir',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'periode',
                    'nama'=>'Periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'minggu',
                    'nama'=>'Jumlah Minggu',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_rekap',
                    'nama'=>'Nama Rekap',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status_rekap',
                    'nama'=>'Status',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function rekap_presensi_dosen_detail($id_rekap)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_rekap_presensi_dosen_detail/'.$id_rekap),
                'header'=>'Rekap presensi dosen',
                'tabel_detail'=>'Rekap presensi dosen',

                'button_name'=>'Report Perdosen',
                'button_action_link'=>base_url('baak/pembelajaran/json_rekap_presensi_dosen_detail_akademik/'.$id_rekap),
                'button_icon'=>'fa fa-bars',

                'button_name2'=>'Report Keuangan',
                'button_action_link2'=>base_url('baak/pembelajaran/json_rekap_presensi_dosen_detail_keuangan/'.$id_rekap),
                'button_icon2'=>'fa fa-money',
            );

            $data_isi=array(
                [
                    'code_nama'=>'tanggal_presensi',
                    'nama'=>'Tanggal Presensi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_masuk',
                    'nama'=>'Tanggal Masuk',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'pertemuan',
                    'nama'=>'Pertemuan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'materi',
                    'nama'=>'Materi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'matakuliah',
                    'nama'=>'Matakuliah',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama',
                    'nama'=>'Dosen',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_kelas',
                    'nama'=>'Kelas',
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

    function json_rekap_presensi_dosen_detail_akademik($id_rekap)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_json_rekap_presensi_dosen_detail_akademik/'.$id_rekap),
                'header'=>'Rekap presensi dosen',
                'tabel_detail'=>'Rekap presensi dosen',

                'button_name'=>'Report ',
                'button_action_link'=>base_url('baak/pembelajaran/rekap_presensi_dosen_detail/'.$id_rekap),
                'button_icon'=>'fa fa-bars',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nama',
                    'nama'=>'Dosen',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'matakuliah',
                    'nama'=>'Matakuliah',
                    'orderable'=>'1',
                ],
               
                [
                    'code_nama'=>'total_rekap',
                    'nama'=>'Total Pertemuan',
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

    function json_rekap_presensi_dosen_detail_keuangan($id_rekap)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_rekap_presensi_dosen_detail_keuangan/'.$id_rekap),
                'header'=>'Rekap presensi dosen',
                'tabel_detail'=>'Rekap presensi dosen',

                'button_name'=>'Report ',
                'button_action_link'=>base_url('baak/pembelajaran/rekap_presensi_dosen_detail/'.$id_rekap),
                'button_icon'=>'fa fa-bars',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nidn',
                    'nama'=>'NIDN',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama',
                    'nama'=>'Dosen',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi Dosen',
                    'orderable'=>'1',
                ],
               
                [
                    'code_nama'=>'total_hari',
                    'nama'=>'Total Hari',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'total_rekap',
                    'nama'=>'Total Pertemuan',
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


    function list_periode_magang()
    {
        if($this->session->userdata('role')=='mhs'){
            $data_detail=array(
                'link_json'=>base_url('mahasiswa/magang/json_list_periode_magang/'),
                'header'=>'Periode magang',
                'tabel_detail'=>'Periode magang',
            );

        }else{
            $data_detail=array(
                'link_json'=>base_url('baak/magang/json_list_periode_magang/'),
                'header'=>'Periode magang',
                'tabel_detail'=>'Periode magang',

                'button_name'=>'Create Preiode',
                'button_action_link'=>base_url('baak/magang/periode_magang_add/'),
                'button_icon'=>'fa fa-plus',
            );

        }
          
            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'buka_daftar',
                    'nama'=>'Tanggal Pendaftran',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tutup_daftar',
                    'nama'=>'Tanggal Penutupan Pendaftaran',
                    'orderable'=>'1',
                ],
               
                [
                    'code_nama'=>'periode_akhir',
                    'nama'=>'Tanggal Penutupan periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function periode_rule($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/magang/json_periode_rule/'.$periode),
                'header'=>'Rule magang periode : '.$periode,
                'tabel_detail'=>'Rule magang periode : '.$periode,

                'button_name'=>'add rule',
                'button_action_link'=>base_url('baak/magang/periode_rule_add/'.$periode),
                'button_icon'=>'fa fa-plus',
            );

            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_rule',
                    'nama'=>'id rule',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'name',
                    'nama'=>'Nama rule',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function sidang_rule($id_trx,$periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/magang/json_sidang_rule/'.$id_trx),
                'header'=>'Rule magang Sidang : '.$id_trx,
                'tabel_detail'=>'Rule magang Sidang : '.$id_trx,

                'button_name'=>'add rule',
                'button_action_link'=>base_url('baak/magang/sidang_rule_add/'.$id_trx),
                'button_icon'=>'fa fa-plus',
            );

            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_rule',
                    'nama'=>'id rule',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'name',
                    'nama'=>'Nama rule',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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


    function list_history_magang()
    {
       
            $data_detail=array(
                'link_json'=>base_url('mahasiswa/magang/json_list_history_magang/'),
                'header'=>'History magang',
                'tabel_detail'=>'History magang',
            );       
          
            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'periode',
                    'orderable'=>'1',
                ],               
                [
                    'code_nama'=>'periode_akhir',
                    'nama'=>'Tanggal Penutupan periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_pt',
                    'nama'=>'Tempat',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'Progres',
                    'orderable'=>'1',
                ],
             
                [
                    'code_nama'=>'nama_dosen',
                    'nama'=>'Pembimbing',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
                    'orderable'=>'0',
                ],
             
            );

            
        $data_isi=$this->master_lib->master_list($data_isi);
    
        $data_kirim=array(
            'data_isi'=>$data_isi,
            'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function list_pendaftar_magang($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/magang/json_list_pendaftar_magang/'.$periode),
                'header'=>'List Pendaftar periode : '.$periode,
                'tabel_detail'=>'List Pendaftar periode : '.$periode,
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'NIM',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mhs',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'progres',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'email_dosen',
                    'nama'=>'Email Dosen',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function all_data_magang($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/magang/json_all_data_magang/'.$periode),
                'header'=>'List Magang periode : '.$periode,
                'tabel_detail'=>'List Magang periode : '.$periode,
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'NIM',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mhs',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'progres',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_dosen',
                    'nama'=>'Pembimbing',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_ketua',
                    'nama'=>'Ketua Sidang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_penguji_1',
                    'nama'=>'Penguji 1',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_penguji_2',
                    'nama'=>'Penguji 2',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_penguji_3',
                    'nama'=>'Penguji 3',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function list_sidang_magang($periode)
    {
       
            $data_detail=array(
                'link_json'=>base_url('baak/magang/json_list_sidang_magang/'.$periode),
                'header'=>'Jadwal Sidang periode : '.$periode,
                'tabel_detail'=>'Jadwal Sidang periode : '.$periode,

                'button_name'=>'add jadwal',
                'button_action_link'=>base_url('baak/magang/sidang_magang_add/'.$periode),
                'button_icon'=>'fa fa-plus',
            );       
          
            $data_isi=array(
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],               
                [
                    'code_nama'=>'buka_daftar',
                    'nama'=>'Tanggal Buka',
                    'orderable'=>'1',
                ],               
                [
                    'code_nama'=>'tutup_daftar',
                    'nama'=>'Tanggal Penutupan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_sidang',
                    'nama'=>'Tanggal Sidang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'ket',
                    'nama'=>'Keterangan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
                    'orderable'=>'0',
                ],
             
            );

            
        $data_isi=$this->master_lib->master_list($data_isi);
    
        $data_kirim=array(
            'data_isi'=>$data_isi,
            'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function list_jadwal_sidang_magang($id_trx)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/magang/json_list_jadwal_sidang_magang/'.$id_trx),
                'header'=>'List Pendaftar periode : '.$id_trx,
                'tabel_detail'=>'List Pendaftar periode : '.$id_trx,
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'NIM',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mhs',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'progres',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_dosen',
                    'nama'=>'Pembimbing',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_ketua',
                    'nama'=>'Ketua Sidang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_penguji_1',
                    'nama'=>'Penguji 1',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_penguji_2',
                    'nama'=>'Penguji 2',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_penguji_3',
                    'nama'=>'Penguji 3',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function list_periode_s1()
    {
        if($this->session->userdata('role')=='mhs'){
            $data_detail=array(
                'link_json'=>base_url('mahasiswa/ta_s1/json_list_periode_s1/'),
                'header'=>'Periode Tugas Akhir',
                'tabel_detail'=>'Periode Tugas Akhir',
            );

        }else{
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_s1/json_list_periode_s1/'),
                'header'=>'Periode Tugas Akhir',
                'tabel_detail'=>'Periode Tugas Akhir',

                'button_name'=>'Create Preiode',
                'button_action_link'=>base_url('baak/tugas_akhir/ta_s1/periode_tugas_akhir_add/'),
                'button_icon'=>'fa fa-plus',
            );

        }
          
            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'buka_daftar',
                    'nama'=>'Tanggal Pendaftran',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tutup_daftar',
                    'nama'=>'Tanggal Penutupan Pendaftaran',
                    'orderable'=>'1',
                ],
               
                [
                    'code_nama'=>'periode_akhir',
                    'nama'=>'Tanggal Penutupan periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function periode_rule_ta_s1($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_s1/json_periode_rule/'.$periode),
                'header'=>'Rule Tugas Akhir S1. periode : '.$periode,
                'tabel_detail'=>'Rule Tugas Akhir S1. periode : '.$periode,

                'button_name'=>'add rule',
                'button_action_link'=>base_url('baak/tugas_akhir/ta_s1/periode_rule_add/'.$periode),
                'button_icon'=>'fa fa-plus',
            );

            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_rule',
                    'nama'=>'id rule',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'name',
                    'nama'=>'Nama rule',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function list_pendaftar_ta_s1($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_s1/json_list_pendaftar_ta_s1/'.$periode),
                'header'=>'List Pendaftar periode : '.$periode,
                'tabel_detail'=>'List Pendaftar periode : '.$periode,
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'NIM',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mhs',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'progres',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'judul',
                    'nama'=>'Judul',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p1',
                    'nama'=>'Pembimbing 1',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p2',
                    'nama'=>'Pembimbing 2',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p3',
                    'nama'=>'Pembimbing 3',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function all_data_ta_s1($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_s1/json_all_data_ta_s1/'.$periode),
                'header'=>'List Data periode : '.$periode,
                'tabel_detail'=>'List Data periode : '.$periode,
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'NIM',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mhs',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'progres',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'judul',
                    'nama'=>'Judul',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p1',
                    'nama'=>'Pembimbing 1',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p2',
                    'nama'=>'Pembimbing 2',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p3',
                    'nama'=>'Pembimbing 3',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function all_data_ta_d3($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_d3/json_all_data_ta_d3/'.$periode),
                'header'=>'List Data periode : '.$periode,
                'tabel_detail'=>'List Data periode : '.$periode,
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'NIM',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mhs',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'progres',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'judul',
                    'nama'=>'Judul',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p1',
                    'nama'=>'Pembimbing 1',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p2',
                    'nama'=>'Pembimbing 2',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p3',
                    'nama'=>'Pembimbing 3',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function list_sidang_ta_s1($sidang,$periode)
    {
       
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_s1/json_list_sidang_ta_s1/'.$sidang.'/'.$periode),
                'header'=>'Jadwal Sidang '.$sidang.' periode : '.$periode,
                'tabel_detail'=>'Jadwal Sidang '.$sidang.' periode : '.$periode,

                'button_name'=>'add jadwal',
                'button_action_link'=>base_url('baak/tugas_akhir/ta_s1/sidang_add/'.$sidang.'/'.$periode),
                'button_icon'=>'fa fa-plus',
            );       
          
            $data_isi=array(
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],               
                [
                    'code_nama'=>'buka_daftar',
                    'nama'=>'Tanggal Buka',
                    'orderable'=>'1',
                ],               
                [
                    'code_nama'=>'tutup_daftar',
                    'nama'=>'Tanggal Penutupan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_sidang',
                    'nama'=>'Tanggal Sidang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'ket',
                    'nama'=>'Keterangan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
                    'orderable'=>'0',
                ],
             
            );

            
        $data_isi=$this->master_lib->master_list($data_isi);
    
        $data_kirim=array(
            'data_isi'=>$data_isi,
            'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function list_sidang_ta_d3($sidang,$periode)
    {
       
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_d3/json_list_sidang_ta_d3/'.$sidang.'/'.$periode),
                'header'=>'Jadwal Sidang '.$sidang.' periode : '.$periode,
                'tabel_detail'=>'Jadwal Sidang '.$sidang.' periode : '.$periode,

                'button_name'=>'add jadwal',
                'button_action_link'=>base_url('baak/tugas_akhir/ta_d3/sidang_add/'.$sidang.'/'.$periode),
                'button_icon'=>'fa fa-plus',
            );       
          
            $data_isi=array(
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],               
                [
                    'code_nama'=>'buka_daftar',
                    'nama'=>'Tanggal Buka',
                    'orderable'=>'1',
                ],               
                [
                    'code_nama'=>'tutup_daftar',
                    'nama'=>'Tanggal Penutupan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_sidang',
                    'nama'=>'Tanggal Sidang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'ket',
                    'nama'=>'Keterangan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
                    'orderable'=>'0',
                ],
             
            );

            
        $data_isi=$this->master_lib->master_list($data_isi);
    
        $data_kirim=array(
            'data_isi'=>$data_isi,
            'data_detail'=>$data_detail,
        );
        return $data_kirim;
    }

    function list_jadwal_sidang_ta_s1($id_trx,$data_masters)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_s1/json_list_jadwal_sidang_ta_s1/'.$id_trx),
                'header'=>'List Pendaftar Sidang '.$data_masters->sidang.' periode : '.$data_masters->tanggal_sidang,
                'tabel_detail'=>'List Pendaftar Sidang '.$data_masters->sidang.' periode : '.$data_masters->tanggal_sidang,
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'NIM',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mhs',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'progres',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p1',
                    'nama'=>'Pembimbing 1',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p2',
                    'nama'=>'Pembimbing 2',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_ketua',
                    'nama'=>'Ketua Sidang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_penguji1',
                    'nama'=>'Penguji 1',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_penguji2',
                    'nama'=>'Penguji 2',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_penguji3',
                    'nama'=>'Penguji 3',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function list_yudusium($periode)
    {
   
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_s1/json_list_yudusium_s1/'.$periode),
                'header'=>'Periode Tugas Akhir',
                'tabel_detail'=>'Periode Tugas Akhir',

                'button_name'=>'Create Yudisium',
                'button_action_link'=>base_url('baak/tugas_akhir/ta_s1/yudusium_add/'.$periode),
                'button_icon'=>'fa fa-plus',
            );

          
            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_penutupan',
                    'nama'=>'Tanggal Penutupan Pendaftaran',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'no_sk',
                    'nama'=>'No SK',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function list_yudisium_daftar($id_trx,$data_masters)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_s1/json_list_yudisium_daftar/'.$id_trx),
                'header'=>'List Pendaftar Yudisium periode : '.$data_masters->tanggal_sk,
                'tabel_detail'=>'List Pendaftar Yudisium periode : '.$data_masters->tanggal_sk,
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
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'progres',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'ipk_lulus',
                    'nama'=>'IPK',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'total_sks_lulus',
                    'nama'=>'Total SKS',
                    'orderable'=>'1',
                ],
               
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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


    function list_periode_wisuda()
    {
        if($this->session->userdata('role')=='mhs'){
            $data_detail=array(
                'link_json'=>base_url('mahasiswa/wisuda/json_list_periode_wisuda/'),
                'header'=>'Periode Wisuda',
                'tabel_detail'=>'Periode Wisuda',
            );

        }else{
            $data_detail=array(
                'link_json'=>base_url('baak/wisuda/json_list_periode_wisuda/'),
                'header'=>'Periode Wisuda',
                'tabel_detail'=>'Periode Wisuda',

                'button_name'=>'Create Preiode',
                'button_action_link'=>base_url('baak/wisuda/periode_wisuda_add/'),
                'button_icon'=>'fa fa-plus',
            );

        }
          
            $data_isi=array(
               
                [
                    'code_nama'=>'buka_daftar',
                    'nama'=>'Tanggal Pendaftran',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tutup_daftar',
                    'nama'=>'Tanggal Penutupan Pendaftaran',
                    'orderable'=>'1',
                ],
               
                [
                    'code_nama'=>'keterangan',
                    'nama'=>'Keterangan',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function periode_rule_wisuda($id_trx)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/wisuda/json_periode_rule/'.$id_trx),
                'header'=>'Rule magang periode : '.$id_trx,
                'tabel_detail'=>'Rule magang periode : '.$id_trx,

                'button_name'=>'add rule',
                'button_action_link'=>base_url('baak/wisuda/periode_rule_add/'.$id_trx),
                'button_icon'=>'fa fa-plus',
            );

            $data_isi=array(
             
                [
                    'code_nama'=>'id_rule',
                    'nama'=>'id rule',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'name',
                    'nama'=>'Nama rule',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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


    function list_pendaftar_wisuda($id_wisuda)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/wisuda/json_list_pendaftar_wisuda/'.$id_wisuda),
                'header'=>'Pendaftar Wisuda ',
                'tabel_detail'=>'Pendaftar Wisuda ',

                'button_name'=>'Wisuda',
                'button_action_link'=>base_url('baak/wisuda/wisuda_report/'.$id_wisuda),
                'button_icon'=>'fa fa-book',
            );

            $data_isi=array(
             
                [
                    'code_nama'=>'nim',
                    'nama'=>'Nim',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama',
                    'nama'=>'Nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'bayar',
                    'nama'=>'Status Bayar',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tanggal_bayar',
                    'nama'=>'Tanggal Bayar',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'foto',
                    'nama'=>'Foto',
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

    function list_tanskrip()
    {
            $data_detail=array(
                'link_json'=>base_url('baak/transkript/json_list/'),
                'header'=>'List yudisium ',
                'tabel_detail'=>'List yudisium ',

            );

            $data_isi=array(
             
                [
                    'code_nama'=>'nim',
                    'nama'=>'Nim',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama',
                    'nama'=>'Nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'total_sks_lulus',
                    'nama'=>'total SKS',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'ipk_lulus',
                    'nama'=>'IPK',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'file_backup',
                    'nama'=>'file',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function list_periode_d3()
    {
        if($this->session->userdata('role')=='mhs'){
            $data_detail=array(
                'link_json'=>base_url('mahasiswa/ta_d3/json_list_periode_d3/'),
                'header'=>'Periode Tugas Akhir',
                'tabel_detail'=>'Periode Tugas Akhir',
            );

        }else{
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_d3/json_list_periode_d3/'),
                'header'=>'Periode Tugas Akhir',
                'tabel_detail'=>'Periode Tugas Akhir',

                'button_name'=>'Create Preiode',
                'button_action_link'=>base_url('baak/tugas_akhir/ta_d3/periode_tugas_akhir_add/'),
                'button_icon'=>'fa fa-plus',
            );

        }
          
            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'buka_daftar',
                    'nama'=>'Tanggal Pendaftran',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'tutup_daftar',
                    'nama'=>'Tanggal Penutupan Pendaftaran',
                    'orderable'=>'1',
                ],
               
                [
                    'code_nama'=>'periode_akhir',
                    'nama'=>'Tanggal Penutupan periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function periode_rule_ta_d3($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_d3/json_periode_rule/'.$periode),
                'header'=>'Rule Tugas Akhir d3. periode : '.$periode,
                'tabel_detail'=>'Rule Tugas Akhir d3. periode : '.$periode,

                'button_name'=>'add rule',
                'button_action_link'=>base_url('baak/tugas_akhir/ta_d3/periode_rule_add/'.$periode),
                'button_icon'=>'fa fa-plus',
            );

            $data_isi=array(
                [
                    'code_nama'=>'periode',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'id_rule',
                    'nama'=>'id rule',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'name',
                    'nama'=>'Nama rule',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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

    function list_pendaftar_ta_d3($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/tugas_akhir/ta_d3/json_list_pendaftar_ta_d3/'.$periode),
                'header'=>'List Pendaftar periode : '.$periode,
                'tabel_detail'=>'List Pendaftar periode : '.$periode,
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'NIM',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mhs',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'progres',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'judul',
                    'nama'=>'Judul',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p1',
                    'nama'=>'Pembimbing 1',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p2',
                    'nama'=>'Pembimbing 2',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_p3',
                    'nama'=>'Pembimbing 3',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'action',
                    'nama'=>'Action',
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
