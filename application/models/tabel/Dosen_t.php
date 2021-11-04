<?php
class Dosen_t extends CI_Model{//baku
	function __construct()
	{
        parent::__construct();
        $this->load->library('Master_lib');
    }

    function frs($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('baak/data_json/json_frs_mahasiswa/'.$periode->kode),
                'header'=>'FRS Periode : '.$periode->nama." (".$periode->kode.")",
                'tabel_detail'=>'FRS Periode : '.$periode->nama." (".$periode->kode.")",
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
                    'code_nama'=>'terakhir_krs',
                    'nama'=>'Pengisian FRS Terakhir',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status_pilih',
                    'nama'=>'Perlu respon',
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

    function presensi_dosen($id_trx,$cek_)
    {
        $data_detail=array(
            'link_json'=>base_url('dosen/data_json/json_presensi_dosen/'.$id_trx),
            'header'=>'Presensi Kehadiran Dosen',
            'tabel_detail'=>'Presensi Kehadiran Dosen : '.$cek_->nama_mata_kuliah.' - '.$cek_->nama_kelas,

            'button_name'=>'Tambah Presensi',
            'button_action_link'=>base_url('dosen/perkuliahan/presensi_dosen_add/'.$id_trx),
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
                'nama'=>'Tanggal Masuk',
                'orderable'=>'1',
            ],
            [
                'code_nama'=>'materi',
                'nama'=>'Materi',
                'orderable'=>'1',
            ],
            [
                'code_nama'=>'methode',
                'nama'=>'Metode',
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

    function kehadiran_dosen_jadwal($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('dosen/data_json/json_jadwal_dosen/'.$periode->kode),
                'header'=>'Jadwal periode : '.$periode->nama." (".$periode->kode.")",
                'tabel_detail'=>'Jadwal periode : '.$periode->nama." (".$periode->kode.")",
            );

            $data_isi=array(
                [
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Prodi',
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
                    'code_nama'=>'periode',
                    'nama'=>'Periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_kelas',
                    'nama'=>'Kelas',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'ruang',
                    'nama'=>'Kelas',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'waktu_jam',
                    'nama'=>'Kelas',
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

    function presensi_mahasiswa($periode)
    {
            $data_detail=array(
                'link_json'=>base_url('dosen/data_json/presensi_mahasiswa/'.$periode->kode),
                'header'=>'Presensi Perkuliahan Mahasiswa, Periode : '.$periode->kode,
                'tabel_detail'=>'Presensi Perkuliahan Mahasiswa, Periode : '.$periode->kode,
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

    function input_nilai($periode)
    {
          
            if($periode->pengisian_frs=='buka'){
                $data_detail=array(

                    'link_json'=>base_url('dosen/data_json/json_input_nilai/'.$periode->id_periode),
                    'header'=>'Penginputan Nilai (di Buka pada tanggal : <b>'.date('j F Y',strtotime($periode->tgl_pengisian)).' - '.date('j F Y',strtotime($periode->tgl_penutupan)).'</b>)',
                    'tabel_detail'=>'Penginputan Nilai (di Buka pada tanggal : <b>'.date('j F Y',strtotime($periode->tgl_pengisian)).' - '.date('j F Y',strtotime($periode->tgl_penutupan)).'</b>)',

                );
            }else{
                $data_detail=array(
                    'link_json'=>base_url('dosen/data_json/json_input_nilai/'.$periode->id_periode),
                    'header'=>'Pengisian Nilai (di TUTUP)',
                    'tabel_detail'=>'Pengisian Nilai (di TUTUP)',
                );
            }

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
                    'code_nama'=>'nama_program_studi',
                    'nama'=>'Program Studi',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'total_mhs',
                    'nama'=>'Total Mahasiswa',
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

    function presensi_mahasiswa_pertemuan($cek_)
    {
            $data_detail=array(
                'link_json'=>base_url('dosen/data_json/presensi_mahasiswa_pertemuan/'.$cek_->id_trx_jadwal),
                'header'=>'Presensi Perkuliahan Mahasiswa, MK : '.$cek_->nama_mata_kuliah,
                'tabel_detail'=>'Presensi Perkuliahan Mahasiswa, MK : '.$cek_->nama_mata_kuliah,
            );

            $data_isi=array(
                [
                    'code_nama'=>'pertemuan',
                    'nama'=>'Pertemuan',
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

    function presensi_mahasiswa_pertemuan_report($cek_)
    {
            $data_detail=array(
                'link_json'=>base_url('dosen/data_json/presensi_mahasiswa_pertemuan_report/'.$cek_->id_trx_jadwal),
                'header'=>'Presensi Perkuliahan Mahasiswa, MK : '.$cek_->nama_mata_kuliah,
                'tabel_detail'=>'Presensi Perkuliahan Mahasiswa, MK : '.$cek_->nama_mata_kuliah,

                'button_name'=>'Input nilai',
                'button_action_link'=>base_url('dosen/perkuliahan/input_nilai_presensi/'.$cek_->id_trx_jadwal),
                'button_icon'=>'fa fa-random',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'NIM',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama',
                    'nama'=>'Nama',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p1',
                    'nama'=>'P1',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p2',
                    'nama'=>'P2',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p3',
                    'nama'=>'P3',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p4',
                    'nama'=>'P4',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p5',
                    'nama'=>'P5',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p6',
                    'nama'=>'P6',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p7',
                    'nama'=>'P7',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p8',
                    'nama'=>'P8',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p9',
                    'nama'=>'P9',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p10',
                    'nama'=>'P10',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p11',
                    'nama'=>'P11',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p12',
                    'nama'=>'P12',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p13',
                    'nama'=>'P13',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'p14',
                    'nama'=>'P14',
                    'orderable'=>'0',
                ],
                [
                    'code_nama'=>'total_hadir',
                    'nama'=>'Total hadir',
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

    function list_sidang_magang()
    {
        $data_detail=array(
            'link_json'=>base_url('dosen/magang/json_list_jadwal_sidang_magang/'),
            'header'=>'List Pendaftar periode : ',
            'tabel_detail'=>'List Pendaftar periode : ',
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
                    'code_nama'=>'tanggal_sidang',
                    'nama'=>'Tanggal Sidang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status_berkas_',
                    'nama'=>'Berkas Nilai',
                    'orderable'=>'0',
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

    function list_mahasiswa_magang()
    {
            $data_detail=array(
                'link_json'=>base_url('dosen/magang/json_list_mahasiswa_magang/'),
                'header'=>'List mahasiswa',
                'tabel_detail'=>'List mahasiswa',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'nim',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mhs',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'periode',
                    'nama'=>'Periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'Progres',
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

    function list_mahasiswa_ta_s1()
    {
            $data_detail=array(
                'link_json'=>base_url('dosen/ta_s1/json_list_mahasiswa_ta_s1/'),
                'header'=>'List mahasiswa',
                'tabel_detail'=>'List mahasiswa',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'nim',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mhs',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'periode',
                    'nama'=>'Periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'Progres',
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

    function list_mahasiswa_ta_d3()
    {
            $data_detail=array(
                'link_json'=>base_url('dosen/ta_d3/json_list_mahasiswa_ta_d3/'),
                'header'=>'List mahasiswa',
                'tabel_detail'=>'List mahasiswa',
            );

            $data_isi=array(
                [
                    'code_nama'=>'nim',
                    'nama'=>'nim',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'nama_mhs',
                    'nama'=>'nama',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'periode',
                    'nama'=>'Periode',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'progres',
                    'nama'=>'Progres',
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

    function list_sidang_ta_s1()
    {
        $data_detail=array(
            'link_json'=>base_url('dosen/ta_s1/json_list_jadwal_sidang_ta_s1/'),
            'header'=>'List Pendaftar periode : ',
            'tabel_detail'=>'List Pendaftar periode : ',
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
                    'code_nama'=>'sidang',
                    'nama'=>'Sidang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'pembimbing',
                    'nama'=>'Pembimbing',
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
                    'code_nama'=>'tanggal_sidang',
                    'nama'=>'Tanggal Sidang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status_berkas_',
                    'nama'=>'Berkas Nilai',
                    'orderable'=>'0',
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

    function list_sidang_ta_d3()
    {
        $data_detail=array(
            'link_json'=>base_url('dosen/ta_d3/json_list_jadwal_sidang_ta_d3/'),
            'header'=>'List Pendaftar periode : ',
            'tabel_detail'=>'List Pendaftar periode : ',
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
                    'code_nama'=>'sidang',
                    'nama'=>'Sidang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'pembimbing',
                    'nama'=>'Pembimbing',
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
                    'code_nama'=>'tanggal_sidang',
                    'nama'=>'Tanggal Sidang',
                    'orderable'=>'1',
                ],
                [
                    'code_nama'=>'status_berkas_',
                    'nama'=>'Berkas Nilai',
                    'orderable'=>'0',
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