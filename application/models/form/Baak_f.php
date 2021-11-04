<?php
class Baak_f extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
        // $this->db = $this->load->database('default', TRUE);
        // $this->nmdb =$this->db1->database;

    }

    function upload_siku_select()
    {
        $form_detail=array(
            'action'=> base_url('admin/super/upload_siku_select_action'),
            'form_detail'=>'Set Periode masuk',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode_all/'),
                'placeholder'=>'Periode masuk',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function upload_alumni_select()
    {
        $form_detail=array(
            'action'=> base_url('admin/super/upload_alumni_select_action'),
            'form_detail'=>'Set Periode masuk',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode_all/'),
                'placeholder'=>'Periode masuk',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }


    function f_GetListMahasiswa_select($link)
    {
        $form_detail=array(
            'action'=> base_url('admin/feeder/f_GetListMahasiswa_select_action'),
            'form_detail'=>'Set Periode masuk',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode_all/'),
                'placeholder'=>'Periode masuk',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }


    function set_periode()
    {
        $form_detail=array(
            'action'=> base_url('baak/pembelajaran/set_periode_action'),
            'form_detail'=>'Set Periode. Periode set : '.$this->session->userdata('set_periode')['periode'],
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }
    
    function set_input_nilai()
    {
        $form_detail=array(
            'action'=> base_url('baak/frs/set_input_nilai_update'),
            'form_detail'=>'Input Nilai Setting',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'pengisian_frs',
                'nama_form'=>'Pengisian Input Nilai',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'buka','value'=>'Buka'],
                    ['id'=>'tutup','value'=>'Tutup'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tgl_pengisian',
                'nama_form'=>'Tanggal Mulai Input Nilai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tgl_penutupan',
                'nama_form'=>'Tanggal Akhir Input Nilai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'last_edit',
                'nama_form'=>'Last edit',
                'tipe'=>'text',
                'placeholder'=>'Token',
                'required'=>'0',
                'readonly'=>'1',
            ],
            [
                'kode_form'=>'user_edit',
                'nama_form'=>'User edit',
                'tipe'=>'text',
                'placeholder'=>'Token',
                'required'=>'0',
                'readonly'=>'1',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function set_frs()
    {
        $form_detail=array(
            'action'=> base_url('baak/frs/set_frs_update'),
            'form_detail'=>'FRS Setting',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'pengisian_frs',
                'nama_form'=>'Pengisian Frs',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'buka','value'=>'Buka'],
                    ['id'=>'tutup','value'=>'Tutup'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tgl_pengisian',
                'nama_form'=>'Tanggal Mulai Isi KRS',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tgl_penutupan',
                'nama_form'=>'Tanggal Akhir Isi KRS',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'last_edit',
                'nama_form'=>'Last edit',
                'tipe'=>'text',
                'placeholder'=>'Token',
                'required'=>'0',
                'readonly'=>'1',
            ],
            [
                'kode_form'=>'user_edit',
                'nama_form'=>'User edit',
                'tipe'=>'text',
                'placeholder'=>'Token',
                'required'=>'0',
                'readonly'=>'1',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function kelas_add()
    {
        $form_detail=array(
            'action'=> base_url('baak/mahasiswa/kelas_add_action'),
            'form_detail'=>'Kelas Add',
            'add_action'=>'Back',
            'add_action_url'=>base_url('baak/mahasiswa/kelas'),
            'action_status'=>'back',
        );
        $data_isi=array(
            [
                'kode_form'=>'nama_kelas',
                'nama_form'=>'Nama Kelas',
                'tipe'=>'text',
                'placeholder'=>'Reguler,Malam,01,1,pagi',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'angkatan',
                'nama_form'=>'Angkatan',
                'tipe'=>'number',
                'placeholder'=>'2015,2016,2017,2020',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'kode_prodi',
                'nama_form'=>'Program Studi',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_prodi_kode/'),
                'placeholder'=>'programstudi',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function mahasiswa_filter()
    {
        if($this->session->userdata('role')=='dosen'){
            $form_detail=array(
                'action'=> base_url('dosen/mahasiswa/filter_mahasiswa'),
                'form_detail'=>'Mahasiswa Data Filter',
            );
        }else{
            $form_detail=array(
                'action'=> base_url('baak/mahasiswa/filter'),
                'form_detail'=>'Mahasiswa Data Filter',
            );
        }
     


        $data_isi=array(
            [
                'kode_form'=>'status_mahasiswa',
                'nama_form'=>'status_mahasiswa',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'Lulus','value'=>'Lulus'],
                    ['id'=>'Dikeluarkan','value'=>'Dikeluarkan'],
                    ['id'=>'AKTIF','value'=>'AKTIF'],
                    ['id'=>'Mengundurkan diri','value'=>'Mengundurkan diri'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_periode_masuk',
                'nama_form'=>'Periode Masuk',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode/'),
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function list_pengisian_frs_mhs_filter($link)
    {
        
        if($this->session->userdata('role')!='pegawai_baak'){
            $form_detail=array(
                'action'=> base_url('prodi/frs/filter/'.$link),
                'form_detail'=>'KRS Data Filter',
            );
        }else{
            $form_detail=array(
                'action'=> base_url('baak/frs/filter/'.$link),
                'form_detail'=>'KRS Data Filter',
            );
        }
        $data_isi=array(
            [
                'kode_form'=>'id_periode_masuk',
                'nama_form'=>'Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode/'),
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],[
                'kode_form'=>'kode_prodi',
                'nama_form'=>'Program Studi',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_prodi_kode/'),
                'placeholder'=>'programstudi',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function copy_skala_nilai($periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/baak/copy_skala_nilai_action/'.$periode),
            'form_detail'=>'Copy Skala Nilai',
        );
        $data_isi=array(
            [
                'kode_form'=>'periode',
                'nama_form'=>'Copy From Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode/'),
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function skala_nilai_add($periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/baak/skala_nilai_add_action/'.$periode),
            'form_detail'=>'Periode Skala Nilai',
        );
        $data_isi=array(
          
            [
                'kode_form'=>'nilai_huruf',
                'nama_form'=>'Nilai Huruf',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'A','value'=>'A'],
                    ['id'=>'B','value'=>'B'],
                    ['id'=>'C','value'=>'C'],
                    ['id'=>'D','value'=>'D'],
                    ['id'=>'E','value'=>'E'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'nilai_index',
                'nama_form'=>'Nilai Index',
                'tipe'=>'float',
                'placeholder'=>'Nilai Inde : 3.00,3.50',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'bobot_minimum',
                'nama_form'=>'Nilai Minimum',
                'tipe'=>'float',
                'placeholder'=>'Nilai Inde : 99.0',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'bobot_maximum',
                'nama_form'=>'Nilai Maximum',
                'tipe'=>'float',
                'placeholder'=>'Nilai Inde : 99.0',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'kode_prodi',
                'nama_form'=>'Program Studi',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_prodi_kode/'),
                'placeholder'=>'programstudi',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function master_jadwal_dosen_edit($id_trx)
    {
        $form_detail=array(
            'action'=> base_url('baak/frs/master_jadwal_dosen_edit_action/'.$id_trx),
            'form_detail'=>'Master Ploting jadwal',
        );
        $data_isi=array(
          
           
            [
                'kode_form'=>'dosen',
                'nama_form'=>'Dosen',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'bahasan',
                'nama_form'=>'Bahasan',
                'tipe'=>'text',
                'placeholder'=>'bahasan',
                'required'=>'0',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function plot_jadwal_dosen_edit($id_trx,$master_saji)
    {
        $form_detail=array(
            'action'=> base_url('baak/frs/plot_jadwal_dosen_edit_action/'.$id_trx),
            'form_detail'=>'Master Ploting jadwal',
        );
        $data_isi=array(
          
           
            [
                'kode_form'=>'id_dosen',
                'nama_form'=>'Dosen',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'kelas',
                'nama_form'=>'Kelas (cannot be edited)',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_kelas/'.$master_saji['kode_prodi']),
                'placeholder'=>'kelas',
                'required'=>'0',
                'readonly'=>'1',
            ],
            [
                'kode_form'=>'ruang',
                'nama_form'=>'Ruang',
                'tipe'=>'text',
                'placeholder'=>'Ruang',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'hari',
                'nama_form'=>'Hari',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'senin','value'=>'Senin'],
                    ['id'=>'selasa','value'=>'Selasa'],
                    ['id'=>'rabu','value'=>'Rabu'],
                    ['id'=>'kamis','value'=>'Kamis'],
                    ['id'=>'jumat','value'=>'Jum\'at'],
                    ['id'=>'sabtu','value'=>'Sabtu'],
                    ['id'=>'minggu','value'=>'Minggu'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'waktu',
                'nama_form'=>'Waktu',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_waktu_kuliah_select/'),
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function plot_jadwal_dosen_add($id_trx,$master_saji)
    {
        $form_detail=array(
            'action'=> base_url('baak/frs/plot_jadwal_dosen_add_action/'.$id_trx),
            'form_detail'=>'Master Ploting jadwal',
        );
        $data_isi=array(
          
           
            [
                'kode_form'=>'dosen',
                'nama_form'=>'Dosen',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'kelas',
                'nama_form'=>'Kelas (cannot be edited)',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_kelas/'.$master_saji['kode_prodi']),
                'placeholder'=>'kelas',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'ruang',
                'nama_form'=>'Ruang',
                'tipe'=>'text',
                'placeholder'=>'Ruang',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'hari',
                'nama_form'=>'Hari',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'senin','value'=>'Senin'],
                    ['id'=>'selasa','value'=>'Selasa'],
                    ['id'=>'rabu','value'=>'Rabu'],
                    ['id'=>'kamis','value'=>'Kamis'],
                    ['id'=>'jumat','value'=>'Jum\'at'],
                    ['id'=>'sabtu','value'=>'Sabtu'],
                    ['id'=>'minggu','value'=>'Minggu'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'waktu',
                'nama_form'=>'Waktu',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_waktu_kuliah_select/'),
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function waktu_kuliah_add()
    {
        $form_detail=array(
            'action'=> base_url('baak/baak/waktu_kuliah_add_action/'),
            'form_detail'=>'Add Jadwal',
        );
        $data_isi=array(
          
            [
                'kode_form'=>'id',
                'nama_form'=>'id',
                'tipe'=>'number',
                'placeholder'=>'angka jam pertama : 8 , 9 , 10 ',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'waktu',
                'nama_form'=>'waktu',
                'tipe'=>'text',
                'placeholder'=>'10.00-12.00 [Format 24 jam]',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'nama_id',
                'nama_form'=>'keterangan',
                'tipe'=>'text',
                'placeholder'=>'Kelas pagi jam ke-1',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'status',
                'nama_form'=>'status',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'aktif','value'=>'Aktif'],
                    ['id'=>'tidak_aktif','value'=>'Tidak Aktif'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }
    
    function rekap_presensi_dosen_add()
    {
        $form_detail=array(
            'action'=> base_url('baak/pembelajaran/rekap_presensi_dosen_add_action/'),
            'form_detail'=>'Add Jadwal',
        );
        $data_isi=array(
            [
                'kode_form'=>'tanggal_akhir',
                'nama_form'=>'Tanggal Akhir Rekap',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'minggu',
                'nama_form'=>'Jumlah Minggu',
                'tipe'=>'number',
                'placeholder'=>'Jumlah minggu dalam angka',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'nama_rekap',
                'nama_form'=>'Nama Rekap',
                'tipe'=>'text',
                'placeholder'=>'bulan - tahun - total minggu',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
            
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    
    function waktu_kuliah_edit($id_trx)
    {
        $form_detail=array(
            'action'=> base_url('baak/baak/waktu_kuliah_edit_action/'.$id_trx),
            'form_detail'=>'Add Jadwal',
        );
        $data_isi=array(
          
            [
                'kode_form'=>'id',
                'nama_form'=>'id',
                'tipe'=>'number',
                'placeholder'=>'angka jam pertama : 8 , 9 , 10 ',
                'required'=>'1',
                'readonly'=>'1',
            ],
            [
                'kode_form'=>'waktu',
                'nama_form'=>'waktu',
                'tipe'=>'text',
                'placeholder'=>'10.00-12.00 [Format 24 jam]',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'nama_id',
                'nama_form'=>'keterangan',
                'tipe'=>'text',
                'placeholder'=>'Kelas pagi jam ke-1',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'status',
                'nama_form'=>'status',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'aktif','value'=>'Aktif'],
                    ['id'=>'tidak_aktif','value'=>'Tidak Aktif'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function isi_select($data_masters,$nim)
    {
        
            $form_detail=array(
                'action'=> base_url('baak/mahasiswa/isi_select_action/'.$nim),
                'form_detail'=>'Pengisian FRS (di Buka pada tanggal : <b>'.date('j F Y',strtotime($data_masters["tgl_pengisian"])).' - '.date('j F Y',strtotime($data_masters["tgl_penutupan"])).'</b>)',
                // 'add_action'=>'Get Token',
                // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
                //'action_status'=>$action,
            );
        
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Periode',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>$data_masters['id_periode'],'value'=>$data_masters['nama_id_periode']],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function periode_magang_add()
    {
        $form_detail=array(
            'action'=> base_url('baak/magang/periode_magang_add_action'),
            'form_detail'=>'Create periode Magang',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'status',
                'nama_form'=>'Status',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'open','value'=>'Open'],
                    ['id'=>'close','value'=>'Close'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'periode_akhir',
                'nama_form'=>'Penutupan ',
                'tipe'=>'date',
                'placeholder'=>'Token',
                'required'=>'0',
                'readonly'=>'0',
            ],          
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function periode_rule_add($periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/magang/periode_rule_add_action/'.$periode),
            'form_detail'=>'Create Rule Magang',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Rule',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/magang/rule_list/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

   

    function periode_magang_edit($periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/magang/periode_magang_edit_action/'.$periode),
            'form_detail'=>'Create periode Magang',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            
            [
                'kode_form'=>'status',
                'nama_form'=>'Status',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'open','value'=>'Open'],
                    ['id'=>'close','value'=>'Close'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'periode_akhir',
                'nama_form'=>'Penutupan ',
                'tipe'=>'date',
                'placeholder'=>'Token',
                'required'=>'0',
                'readonly'=>'0',
            ],          
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function magang_plot_dosen($id_trx,$data_file)
    {
        $form_detail=array(
            'action'=> base_url('baak/magang/plot_dosen_action/'.$id_trx),
            'form_detail'=>'Ploting Dosen : '.$data_file->nim."/ ".$data_file->nama_mhs."/ ".$data_file->nama_pt,
        );
        $data_isi=array(
          
            [
                'kode_form'=>'id_dosen',
                'nama_form'=>'Dosen',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function ta_s1_plot_dosen($id_trx,$data_file)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_s1/plot_dosen_action/'.$id_trx),
            'form_detail'=>'Ploting Dosen : '.$data_file->nim."/ ".$data_file->nama_mhs."/ ".$data_file->judul,
        );
        $data_isi=array(
          
            [
                'kode_form'=>'id_dosen_bimbing_1',
                'nama_form'=>'Pembimbing 1',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_dosen_bimbing_2',
                'nama_form'=>'Pembimbing 2',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_dosen_bimbing_3',
                'nama_form'=>'Pembimbing 3',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'0',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function ta_d3_plot_dosen($id_trx,$data_file)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_d3/plot_dosen_action/'.$id_trx),
            'form_detail'=>'Ploting Dosen : '.$data_file->nim."/ ".$data_file->nama_mhs."/ ".$data_file->judul,
        );
        $data_isi=array(
          
            [
                'kode_form'=>'id_dosen_bimbing_1',
                'nama_form'=>'Pembimbing 1',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_dosen_bimbing_2',
                'nama_form'=>'Pembimbing 2',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_dosen_bimbing_3',
                'nama_form'=>'Pembimbing 3',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'0',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function tolak_sidang_magang($id_trx,$data_file)
    {
        $form_detail=array(
            'action'=> base_url('baak/magang/tolak_sidang_magang_action/'.$id_trx),
            'form_detail'=>'Ploting Dosen : '.$data_file->nim."/ ".$data_file->nama_mhs."/ ".$data_file->nama_pt,
        );
        $data_isi=array(
          
            [
                'kode_form'=>'ket',
                'nama_form'=>'Keterangan',
                'tipe'=>'text',
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function plot_sidang_magang($id_trx,$data_file)
    {
        $link = base_url('/assets/berkas/magang/'.$data_file->berkas); //" base_url('/assets/berkas/magang/'.".$data_masters->berkas.")";
        $link2 = base_url('baak/magang/tolak_sidang_magang/'.$id_trx.'/'.$data_file->periode); //" base_url('/assets/berkas/magang/'.".$data_masters->berkas.")";
        $form_detail=array(
            'action'=> base_url('baak/magang/plot_sidang_magang_action/'.$id_trx),
            'form_detail'=>'Ploting Sidang : '.$data_file->nim."/ ".$data_file->nama_mhs."/ Pembimbing : ".$data_file->nama_dosen.' || <a class="btn btn-info" target="_blank" href="'.$link.'">Lihat Berkas</a> ||  <a class="btn btn-warning" href="'.$link2.'">Tolak Pendaftaran</a> ',
        );
        $data_isi=array(
          
            [
                'kode_form'=>'id_dosen_ketua',
                'nama_form'=>'Ketua Sidang',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_dosen_penguji_1',
                'nama_form'=>'Penguji 1',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_dosen_penguji_2',
                'nama_form'=>'Penguji 2',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_dosen_penguji_3',
                'nama_form'=>'Penguji 3',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'0',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function sidang_magang_add($periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/magang/sidang_magang_add_action/'.$periode),
            'form_detail'=>'Create jadwal sidang',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
         
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],          
            [
                'kode_form'=>'tanggal_sidang',
                'nama_form'=>'Tanggal Pelaksanaan Sidang',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],          
            [
                'kode_form'=>'ket',
                'nama_form'=>'Keterangan Tambahan',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ],  
            [
                'kode_form'=>'kode_prodi',
                'nama_form'=>'Program Studi',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_prodi_kode/'),
                'placeholder'=>'programstudi',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_rule',
                'nama_form'=>'Syarat Pendaftaran',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/magang/rule_list/'),
                'placeholder'=>'Periode',
                'required'=>'0',
                'readonly'=>'0',
            ],         
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function sidang_magang_edit($id_trx,$periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/magang/sidang_magang_edit_action/'.$id_trx.'/'.$periode),
            'form_detail'=>'Create jadwal sidang',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
         
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],          
            [
                'kode_form'=>'tanggal_sidang',
                'nama_form'=>'Tanggal Pelaksanaan Sidang',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],          
            [
                'kode_form'=>'ket',
                'nama_form'=>'Keterangan Tambahan',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_rule',
                'nama_form'=>'Syarat Pendaftaran',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/magang/rule_list/'),
                'placeholder'=>'Periode',
                'required'=>'0',
                'readonly'=>'0',
            ],          
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }
  
    
    function input_penilaian($id_trx,$data_file,$periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/magang/input_penilaian_action/'.$id_trx.'/'.$periode),
            'form_detail'=>'Ploting Dosen : '.$data_file['nim']."/ ".$data_file['nama_mhs']."/".$periode,
        );
        $data_isi=array(
          
            [
                'kode_form'=>'nilai_sidang',
                'nama_form'=>'Nilai Akhir',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'keterangan_sidang',
                'nama_form'=>'Keterangan sidang',
                'tipe'=>'text',
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'progres',
                'nama_form'=>'Progres',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'lulus','value'=>'lulus'],
                    ['id'=>'gagal','value'=>'gagal'],
                ],
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tgl_lulus',
                'nama_form'=>'Tanggal Lulus',
                'tipe'=>'date',
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_frs',
                'nama_form'=>'Matakuliah',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_frs_mhs/'.$periode.'/'.$data_file['nim']),
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
            
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function periode_tugas_akhir_add()
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_s1/periode_tugas_akhir_add_action'),
            'form_detail'=>'Create periode Magang',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'status',
                'nama_form'=>'Status',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'open','value'=>'Open'],
                    ['id'=>'close','value'=>'Close'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'periode_akhir',
                'nama_form'=>'Penutupan ',
                'tipe'=>'date',
                'placeholder'=>'Token',
                'required'=>'0',
                'readonly'=>'0',
            ],          
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function periode_ta_s1_edit($periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_s1/periode_edit_action/'.$periode),
            'form_detail'=>'Create periode Tugas Akhir',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            
            [
                'kode_form'=>'status',
                'nama_form'=>'Status',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'open','value'=>'Open'],
                    ['id'=>'close','value'=>'Close'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'periode_akhir',
                'nama_form'=>'Penutupan ',
                'tipe'=>'date',
                'placeholder'=>'Token',
                'required'=>'0',
                'readonly'=>'0',
            ],          
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function periode_rule_add_ta_s1($periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_s1/periode_rule_add_action/'.$periode),
            'form_detail'=>'Create Rule Tugas Akhir',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Rule',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/magang/rule_list/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function periode_rule_add_wisuda($id_trx)
    {
        $form_detail=array(
            'action'=> base_url('baak/wisuda/periode_rule_add_action/'.$id_trx),
            'form_detail'=>'Create Rule Wisuda',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Rule',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/magang/rule_list/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function sidang_ta_s1_add($sidang,$periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_s1/sidang_ta_s1_add_action/'.$sidang.'/'.$periode),
            'form_detail'=>'Create jadwal sidang '.$sidang,
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
         
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],          
            [
                'kode_form'=>'tanggal_sidang',
                'nama_form'=>'Tanggal Pelaksanaan Sidang',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],          
            [
                'kode_form'=>'ket',
                'nama_form'=>'Keterangan Tambahan',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ],  
            [
                'kode_form'=>'kode_prodi',
                'nama_form'=>'Program Studi',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_prodi_kode/30'),
                'placeholder'=>'programstudi',
                'required'=>'1',
                'readonly'=>'0',
            ], 
            [
                'kode_form'=>'id_rule',
                'nama_form'=>'Syarat Pendaftaran',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/magang/rule_list/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],        
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function sidang_ta_s1_edit($id_trx,$periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_s1/sidang_ta_s1_edit_action/'.$id_trx.'/'.$periode),
            'form_detail'=>'Edit jadwal sidang',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
         
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],          
            [
                'kode_form'=>'tanggal_sidang',
                'nama_form'=>'Tanggal Pelaksanaan Sidang',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],          
            [
                'kode_form'=>'ket',
                'nama_form'=>'Keterangan Tambahan',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_rule',
                'nama_form'=>'Syarat Pendaftaran',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/magang/rule_list/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],         
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function plot_sidang_ta_s1($id_trx,$data_file)
    {
        $link = base_url('/assets/berkas/ta/'.$data_file->berkas); //" base_url('/assets/berkas/magang/'.".$data_masters->berkas.")";
        $link2 = base_url('baak/tugas_akhir/ta_s1/tolak_sidang/'.$id_trx.'/'.$data_file->periode); //" base_url('/assets/berkas/magang/'.".$data_masters->berkas.")";
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_s1/plot_sidang_ta_s1_action/'.$id_trx),
            'form_detail'=>'Ploting Sidang : '.$data_file->nim."/ ".$data_file->nama_mhs."/ Pembimbing : ".$data_file->nama_p1.' & '.$data_file->nama_p2.' & '.$data_file->nama_p3.' || <a class="btn btn-info" target="_blank" href="'.$link.'">Lihat Berkas</a> ||  <a class="btn btn-warning" href="'.$link2.'">Tolak Pendaftaran</a> ',
        );
        $data_isi=array(
          
            [
                'kode_form'=>'id_dosen_ketua',
                'nama_form'=>'Ketua Sidang',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_dosen_penguji_1',
                'nama_form'=>'Penguji 1',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_dosen_penguji_2',
                'nama_form'=>'Penguji 2',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'id_dosen_penguji_3',
                'nama_form'=>'Penguji 3',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_select_dosen/'),
                'placeholder'=>'dosen',
                'required'=>'0',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function tolak_sidang($id_trx,$data_file)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_s1/tolak_sidang_action/'.$id_trx),
            'form_detail'=>'Ploting Dosen : '.$data_file->nim."/ ".$data_file->nama_mhs."/ ".$data_file->judul,
        );
        $data_isi=array(
          
            [
                'kode_form'=>'ket',
                'nama_form'=>'Keterangan',
                'tipe'=>'text',
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
           
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function input_penilaian_sidang_s1($id_trx,$data_file,$periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_s1/input_penilaian_action/'.$id_trx.'/'.$periode),
            'form_detail'=>'Ploting Dosen : '.$data_file['nim']."/ ".$data_file['nama_mhs']."/".$periode." (Sidang ".$data_file['sidang'].")",
        );
        $data_isi=array(
          
            [
                'kode_form'=>'nilai',
                'nama_form'=>'Nilai Akhir',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'ket',
                'nama_form'=>'Keterangan sidang',
                'tipe'=>'text',
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'progres',
                'nama_form'=>'Progres',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'lulus','value'=>'lulus'],
                    ['id'=>'gagal','value'=>'gagal'],
                ],
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tgl_lulus',
                'nama_form'=>'Tanggal Lulus',
                'tipe'=>'date',
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],   
           
        );
        if($data_file['sidang']=='ta'){
            array_push($data_isi,
                [
                    'kode_form'=>'id_frs',
                    'nama_form'=>'Matakuliah',
                    'tipe'=>'select2',
                    'select_data'=>base_url('baak/data_json/json_frs_mhs/'.$periode.'/'.$data_file['nim']),
                    'placeholder'=>'keterangan',
                    'required'=>'1',
                    'readonly'=>'0',
                ]
        );
        }

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function yudusium_add($periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_s1/yudusium_add_action/'.$periode),
            'form_detail'=>'Yudisium Periode : '.$periode,
        );
        $data_isi=array(
          
            [
                'kode_form'=>'tanggal_penutupan',
                'nama_form'=>'Penutupan Pendaftaran',
                'tipe'=>'date',
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'kode_prodi',
                'nama_form'=>'Program Studi',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_prodi_kode/30'),
                'placeholder'=>'programstudi',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'no_sk',
                'nama_form'=>'No-Sk',
                'tipe'=>'text',
                'placeholder'=>'no sk',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tanggal_sk',
                'nama_form'=>'Tanggal SK',
                'tipe'=>'date',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ], 
            [
                'kode_form'=>'no_akreditasi',
                'nama_form'=>'No Akreditasi',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ], 
            [
                'kode_form'=>'nama_ketua',
                'nama_form'=>'Nama ketua',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ], 
            [
                'kode_form'=>'nama_ketua_prodi',
                'nama_form'=>'Nama Ketua Program Studi',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tanggal_ttd',
                'nama_form'=>'Tanggal TTD',
                'tipe'=>'date',
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ], 
            [
                'kode_form'=>'id_rule',
                'nama_form'=>'Syarat Pendaftaran',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/magang/rule_list/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ], 
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function yudisium_edit($id,$periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_s1/yudisium_edit_action/'.$id.'/'.$periode),
            'form_detail'=>'Yudisium Periode : '.$periode,
        );
        $data_isi=array(
          
            [
                'kode_form'=>'tanggal_penutupan',
                'nama_form'=>'Penutupan Pendaftaran',
                'tipe'=>'date',
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'no_sk',
                'nama_form'=>'No-Sk',
                'tipe'=>'text',
                'placeholder'=>'no sk',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tanggal_sk',
                'nama_form'=>'Tanggal SK',
                'tipe'=>'date',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ], 
            [
                'kode_form'=>'no_akreditasi',
                'nama_form'=>'No Akreditasi',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ], 
            [
                'kode_form'=>'nama_ketua',
                'nama_form'=>'Nama ketua',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ], 
            [
                'kode_form'=>'nama_ketua_prodi',
                'nama_form'=>'Nama Ketua Program Studi',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tanggal_ttd',
                'nama_form'=>'Tanggal TTD',
                'tipe'=>'date',
                'placeholder'=>'keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ], 
            [
                'kode_form'=>'id_rule',
                'nama_form'=>'Syarat Pendaftaran',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/magang/rule_list/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ], 
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function periode_wisuda_add()
    {
        $form_detail=array(
            'action'=> base_url('baak/wisuda/periode_wisuda_add_action'),
            'form_detail'=>'Create periode Wisuda',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            
            [
                'kode_form'=>'status',
                'nama_form'=>'Status',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'open','value'=>'Open'],
                    ['id'=>'close','value'=>'Close'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'keterangan',
                'nama_form'=>'Keterangan',
                'tipe'=>'text',
                'placeholder'=>'Tanggal pelaksanaan Wisuda',
                'required'=>'0',
                'readonly'=>'0',
            ],          
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function periode_wisuda_edit($id_trx)
    {
        $form_detail=array(
            'action'=> base_url('baak/wisuda/periode_wisuda_edit_action/'.$id_trx),
            'form_detail'=>'edit periode Wisuda',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            
            [
                'kode_form'=>'status',
                'nama_form'=>'Status',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'open','value'=>'Open'],
                    ['id'=>'close','value'=>'Close'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'keterangan',
                'nama_form'=>'Keterangan',
                'tipe'=>'text',
                'placeholder'=>'Tanggal pelaksanaan Wisuda',
                'required'=>'0',
                'readonly'=>'0',
            ],          
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function periode_tugas_akhir_d3_add()
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_d3/periode_tugas_akhir_add_action'),
            'form_detail'=>'Create periode Magang',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Periode',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_id_periode/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'status',
                'nama_form'=>'Status',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'open','value'=>'Open'],
                    ['id'=>'close','value'=>'Close'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'periode_akhir',
                'nama_form'=>'Penutupan ',
                'tipe'=>'date',
                'placeholder'=>'Token',
                'required'=>'0',
                'readonly'=>'0',
            ],          
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function periode_rule_add_ta_d3($periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_d3/periode_rule_add_action/'.$periode),
            'form_detail'=>'Create Rule Tugas Akhir',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            [
                'kode_form'=>'id_periode',
                'nama_form'=>'Rule',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/magang/rule_list/'),
                'placeholder'=>'Periode',
                'required'=>'1',
                'readonly'=>'0',
            ],
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }

    function periode_ta_d3_edit($periode)
    {
        $form_detail=array(
            'action'=> base_url('baak/tugas_akhir/ta_d3/periode_edit_action/'.$periode),
            'form_detail'=>'Create periode Tugas Akhir',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            //'action_status'=>$action,
        );
        $data_isi=array(
            
            [
                'kode_form'=>'status',
                'nama_form'=>'Status',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'open','value'=>'Open'],
                    ['id'=>'close','value'=>'Close'],
                ],
                'placeholder'=>'live',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'buka_daftar',
                'nama_form'=>'Tanggal Mulai',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tutup_daftar',
                'nama_form'=>'Tanggal Akhir',
                'tipe'=>'date',
                'placeholder'=>'status_connected',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'periode_akhir',
                'nama_form'=>'Penutupan ',
                'tipe'=>'date',
                'placeholder'=>'Token',
                'required'=>'0',
                'readonly'=>'0',
            ],          
        );

        $data=[
            'form_detail'=>$form_detail,
            'data_isi'=>$data_isi,
        ];
        
        return $data;
    }


}
