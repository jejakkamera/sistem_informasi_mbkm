<?php
class Mhs_f extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
        // $this->db = $this->load->database('default', TRUE);
        // $this->nmdb =$this->db1->database;

    }
    
    function isi_select($data_masters)
    {
        if($data_masters["pengisian_frs"]=='buka'){
            $form_detail=array(
                'action'=> base_url('mahasiswa/frs/isi_select_action/'),
                'form_detail'=>'Pengisian FRS (di Buka pada tanggal : <b>'.date('j F Y',strtotime($data_masters["tgl_pengisian"])).' - '.date('j F Y',strtotime($data_masters["tgl_penutupan"])).'</b>)',
                // 'add_action'=>'Get Token',
                // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
                //'action_status'=>$action,
            );
        }else{
            $form_detail=array(
                'action'=> base_url('mahasiswa/frs/isi_select_action/'),
                'form_detail'=>'Pengisian FRS (di TUTUP)',
                // 'add_action'=>'Get Token',
                // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
                //'action_status'=>$action,
            );
        }
        
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

    function lihat_select()
    {
        $form_detail=array(
            'action'=> base_url('mahasiswa/frs/lihat_select_action/'),
            'form_detail'=>'Kartu Studi',
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
                'nama_form'=>'Menu',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'ks','value'=>'FRS'],
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

    function kartu_kehadiran()
    {
        $form_detail=array(
            'action'=> base_url('mahasiswa/perkuliahan/kartu_kehadiran_action/'),
            'form_detail'=>'Kartu Studi',
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

    function kartu_ujian()
    {
        $form_detail=array(
            'action'=> base_url('mahasiswa/perkuliahan/kartu_ujian_action/'),
            'form_detail'=>'Kartu Ujian',
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
                'kode_form'=>'type',
                'nama_form'=>'type',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'UTS','value'=>'UTS'],
                    ['id'=>'UAS','value'=>'UAS'],
                ],
                'placeholder'=>'Ujian',
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

    function hasil_studi()
    {
        $form_detail=array(
            'action'=> base_url('mahasiswa/perkuliahan/hasil_studi_action/'),
            'form_detail'=>'Hasil Studi',
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

    function mhs_password($id){
        $form_detail=array(
            'action'=> base_url('baak/Mahasiswa/set_mahasiswa_password_update/'.$id),
            'form_detail'=>'Update Password Mahasiswa',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'password',
                'nama_form'=>'password',
                'tipe'=>'text',
                'placeholder'=>'password',
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

    function daftar_magang($periode){
        $form_detail=array(
            'action'=> base_url('mahasiswa/magang/daftar_magang_action/'.$periode),
            'form_detail'=>'Pendaftaran magang',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'nama_pt',
                'nama_form'=>'Tempat',
                'tipe'=>'text',
                'placeholder'=>'Nama institusi /  perusahaan',
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

    function pendaftar_sidang_magang($id_trx){
        $form_detail=array(
            'action'=> base_url('mahasiswa/magang/pendaftar_sidang_magang_action/'.$id_trx),
            'form_detail'=>'Pendaftaran sidang magang',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'judul',
                'nama_form'=>'Judul',
                'tipe'=>'text',
                'placeholder'=>'Judul',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'berkas',
                'nama_form'=>'Berkas *pdf',
                'tipe'=>'upload',
                'placeholder'=>'berkas',
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

    function daftar_ta_s1($periode){
        $form_detail=array(
            'action'=> base_url('mahasiswa/ta_s1/daftar_ta_s1_action/'.$periode),
            'form_detail'=>'Pendaftaran Tugas Akhir (S1)',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'judul',
                'nama_form'=>'Judul',
                'tipe'=>'text',
                'placeholder'=>'Judul / tema penelitian',
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

    function pendaftar_sidang_ta_s1($id_trx,$rule_date){
        $form_detail=array(
            'action'=> base_url('mahasiswa/ta_s1/pendaftar_sidang_ta_s1_action/'.$id_trx),
            'form_detail'=>'Pendaftaran sidang '.$rule_date->sidang,
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'judul',
                'nama_form'=>'Judul',
                'tipe'=>'text',
                'placeholder'=>'Judul',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'berkas',
                'nama_form'=>'Berkas *pdf',
                'tipe'=>'upload',
                'placeholder'=>'berkas',
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

    function pendaftar_yudisium_ta_s1($id_trx,$rule_date){
        $form_detail=array(
            'action'=> base_url('mahasiswa/ta_s1/pendaftar_yudisium_ta_s1_action/'.$id_trx),
            'form_detail'=>'Pendaftaran yudisium '.$rule_date->tanggal_penutupan,
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'nama',
                'nama_form'=>'Nama sesuai Ijazah',
                'tipe'=>'text',
                'placeholder'=>'Judul',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tanggal_lahir',
                'nama_form'=>'Tanggal lahir',
                'tipe'=>'date',
                'placeholder'=>'Judul',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'tempat_lahir',
                'nama_form'=>'Tempat Lahir',
                'tipe'=>'text',
                'placeholder'=>'Judul',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'handphone',
                'nama_form'=>'No HP yang dapat di hubingi',
                'tipe'=>'text',
                'placeholder'=>'08xxxxxxx',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'judul_indo',
                'nama_form'=>'Judul (bahasa indonesia)',
                'tipe'=>'text',
                'placeholder'=>'Judul',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'judul_ing',
                'nama_form'=>'Judul (bahasa inggris)',
                'tipe'=>'text',
                'placeholder'=>'Judul',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'berkas',
                'nama_form'=>'Berkas *pdf',
                'tipe'=>'upload',
                'placeholder'=>'berkas',
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

    function daftar_wisuda($id_trx,$rule_date){
        $form_detail=array(
            'action'=> base_url('mahasiswa/wisuda/pendaftar_yudisium_wisuda_action/'.$id_trx),
            'form_detail'=>'Pendaftaran Wisuda '.$rule_date->tutup_daftar,
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'nama',
                'nama_form'=>'Nama sesuai Ijazah',
                'tipe'=>'text',
                'placeholder'=>'Judul',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'berkas',
                'nama_form'=>'Foto *jpg',
                'tipe'=>'upload',
                'placeholder'=>'berkas',
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

    function add_bimbingan_s1($nim)
    {
        if($this->session->userdata('role')=='mhs'){
            $form_detail=array(
                'action'=> base_url('mahasiswa/ta_s1/add_bimbingan_action/'.$nim),
                'form_detail'=>'Bimbingan',
            );
        }else{
            $form_detail=array(
                'action'=> base_url('dosen/ta_s1/add_bimbingan_action/'.$nim),
                'form_detail'=>'Bimbingan',
            );
        }
    
        

        $data_isi=array(
            [
                'kode_form'=>'keterangan',
                'nama_form'=>'Keterangan',
                'tipe'=>'wyswyg',
                'placeholder'=>'Keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'berkas',
                'nama_form'=>'File *pdf',
                'tipe'=>'upload',
                'placeholder'=>'berkas',
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

    function add_bimbingan_magang($nim)
    {
        if($this->session->userdata('role')=='mhs'){
            $form_detail=array(
                'action'=> base_url('mahasiswa/magang/add_bimbingan_action/'.$nim),
                'form_detail'=>'Bimbingan',
            );
        }else{
            $form_detail=array(
                'action'=> base_url('dosen/magang/add_bimbingan_action/'.$nim),
                'form_detail'=>'Bimbingan',
            );
        }
    
        

        $data_isi=array(
            [
                'kode_form'=>'keterangan',
                'nama_form'=>'Keterangan',
                'tipe'=>'wyswyg',
                'placeholder'=>'Keterangan',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'berkas',
                'nama_form'=>'File *pdf',
                'tipe'=>'upload',
                'placeholder'=>'berkas',
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

    function daftar_ta_d3($periode){
        $form_detail=array(
            'action'=> base_url('mahasiswa/ta_d3/daftar_ta_d3_action/'.$periode),
            'form_detail'=>'Pendaftaran Tugas Akhir (S1)',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'judul',
                'nama_form'=>'Judul',
                'tipe'=>'text',
                'placeholder'=>'Judul / tema penelitian',
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
  

}
