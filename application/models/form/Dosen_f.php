<?php
class Dosen_f extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
        // $this->db = $this->load->database('default', TRUE);
        // $this->nmdb =$this->db1->database;

    }
    
    function dosen_update($id){
        $form_detail=array(
            'action'=> base_url('baak/dosen/set_dosen_update/'.$id),
            'form_detail'=>'Udpdate Data dosen',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'nip',
                'nama_form'=>'NIP',
                'tipe'=>'text',
                'placeholder'=>'nip',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'nama',
                'nama_form'=>'Nama Dosen',
                'tipe'=>'text',
                'placeholder'=>'nama',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'nidn',
                'nama_form'=>'NIDN',
                'tipe'=>'text',
                'placeholder'=>'nidn',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'jabatan_struktural',
                'nama_form'=>'Jabatan Struktural',
                'tipe'=>'text',
                'placeholder'=>'',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'status_pegawai',
                'nama_form'=>'Status Pegawai',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'dosen_tetap','value'=>'dosen_tetap'],
                    ['id'=>'dosen_tidak_tetap','value'=>'dosen_tidak_tetap'],
                ],
                'placeholder'=>'jenis kelamin',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'homebase',
                'nama_form'=>'homebase',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_prodi_kode'),
                'placeholder'=>'homebase',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'jenjang_didik',
                'nama_form'=>'jenjang_didik',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_jenjang_didik'),
                'placeholder'=>'id_jenjang_didik',
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

    function dosen_password($id,$email){
        $form_detail=array(
            'action'=> base_url('baak/dosen/set_dosen_password_update/'.$id),
            'form_detail'=>'Ubah Password Dosen : '.$email,
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

    function input_nilai_presensi($id_trx,$nilai_komponen){
        $form_detail=array(
            'action'=> base_url('dosen/perkuliahan/input_nilai_presensi_action/'.$id_trx),
            'form_detail'=>'Nilai Presensi',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );
        $datas=array();
        if($nilai_komponen){
            foreach($nilai_komponen as $row){   
                array_push($datas,['id'=>$row['id'],'value'=>$row['komponen']]);
            }
        }
       

        $data_isi=array(
            [
                'kode_form'=>'id_komponen',
                'nama_form'=>'Komponen Nilai',
                'tipe'=>'select',
                'select_data'=>$datas,
                'placeholder'=>'Komponen Nilai',
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

    function dosen_add(){
        $form_detail=array(
            'action'=> base_url('baak/dosen/add_dosen_action'),
            'form_detail'=>'Ubah Password Dosen',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
            [
                'kode_form'=>'nip',
                'nama_form'=>'nip',
                'tipe'=>'text',
                'placeholder'=>'nip',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'nama',
                'nama_form'=>'nama',
                'tipe'=>'text',
                'placeholder'=>'nama',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'nidn',
                'nama_form'=>'nidn',
                'tipe'=>'text',
                'placeholder'=>'nidn',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'jabatan_struktural',
                'nama_form'=>'jabatan_struktural',
                'tipe'=>'text',
                'placeholder'=>'jabatan_struktural',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'status_pegawai',
                'nama_form'=>'Status Pegawai',
                'tipe'=>'select',
                'select_data'=>[
                    ['id'=>'dosen_tetap','value'=>'dosen_tetap'],
                    ['id'=>'dosen_tidak_tetap','value'=>'dosen_tidak_tetap'],
                ],
                'placeholder'=>'jenis kelamin',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'homebase',
                'nama_form'=>'homebase',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_prodi_kode'),
                'placeholder'=>'homebase',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'jenjang_didik',
                'nama_form'=>'jenjang_didik',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_jenjang_didik'),
                'placeholder'=>'id_jenjang_didik',
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


    function dosen_hapus($id,$nama){
        $form_detail=array(
            'action'=> base_url('baak/dosen/set_dosen_hapus/'.$id),
            'form_detail'=>'Apakah Anda Yakin Menghapus Data dosen '.$nama,
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data=[
            'form_detail'=>$form_detail,
           
        ];
        
        return $data;
    }

    function presensi_dosen_add($id_trx,$cek_){
        if($this->session->userdata('role')!='pegawai_baak'){
            $form_detail=array(
                'action'=> base_url('dosen/perkuliahan/presensi_dosen_add_action/'.$id_trx),
                'form_detail'=>'Tambah Presensi Kehadiran Dosen : '.$cek_->nama_mata_kuliah.' - '.$cek_->nama_kelas,
            );
        }else{
            $form_detail=array(
                'action'=> base_url('baak/pembelajaran/presensi_dosen_add_action/'.$id_trx),
                'form_detail'=>'Tambah Presensi Kehadiran Dosen : '.$cek_->nama_mata_kuliah.' - '.$cek_->nama_kelas,
            );
        }
       

        $data_isi=array(
            [
                'kode_form'=>'tanggal_masuk',
                'nama_form'=>'Tanggal masuk kelas',
                'tipe'=>'date',
                'placeholder'=>'methode',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'materi',
                'nama_form'=>'Materi',
                'tipe'=>'text',
                'placeholder'=>'materi',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'methode',
                'nama_form'=>'Methode',
                'tipe'=>'tags',
                'placeholder'=>'methode',
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
    
    function presensi_dosen_edit($id_trx){
        if($this->session->userdata('role')!='pegawai_baak'){
            $form_detail=array(
                'action'=> base_url('dosen/perkuliahan/presensi_dosen_edit_action/'.$id_trx),
                'form_detail'=>'Edit Presensi Kehadiran Dosen',
            );
        }else{
            $form_detail=array(
                'action'=> base_url('baak/pembelajaran/presensi_dosen_edit_action/'.$id_trx),
                'form_detail'=>'Edit Presensi Kehadiran Dosen',
            );
        }
       

        $data_isi=array(
            [
                'kode_form'=>'tanggal_masuk',
                'nama_form'=>'Tanggal masuk kelas',
                'tipe'=>'date',
                'placeholder'=>'methode',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'materi',
                'nama_form'=>'Materi',
                'tipe'=>'text',
                'placeholder'=>'materi',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'methode',
                'nama_form'=>'Methode',
                'tipe'=>'tags',
                'placeholder'=>'methode',
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

    function dosen_profile($id){
        $form_detail=array(
            'action'=> base_url('dosen/profile/set_dosen_update/'),
            'form_detail'=>'Udpdate Data dosen',
            // 'add_action'=>'Get Token',
            // 'add_action_url'=>base_url('admin/feeder/f_GetToken'),
            // 'action_status'=>$action,
        );

        $data_isi=array(
           
            [
                'kode_form'=>'nama',
                'nama_form'=>'Nama Dosen',
                'tipe'=>'text',
                'placeholder'=>'nama',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'nidn',
                'nama_form'=>'NIDN',
                'tipe'=>'text',
                'placeholder'=>'nidn',
                'required'=>'0',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'jenjang_didik',
                'nama_form'=>'Jenjang Pendidikan',
                'tipe'=>'select2',
                'select_data'=>base_url('baak/data_json/json_jenjang_didik'),
                'placeholder'=>'id_jenjang_didik',
                'required'=>'1',
                'readonly'=>'0',
            ],
            [
                'kode_form'=>'password',
                'nama_form'=>'password',
                'tipe'=>'password',
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

    function upload_nilai_sidang($id_trx,$data_file){
      
        $form_detail=array(
            'action'=> base_url('dosen/magang/upload_nilai_sidang_action/'.$id_trx),
            'form_detail'=>'Form sidang : '.$data_file->nim."/ ".$data_file->nama_mhs,
        );

        $data_isi=array(
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

    function upload_nilai_ta_s1($id_trx,$data_file){
      
        $form_detail=array(
            'action'=> base_url('dosen/ta_s1/upload_nilai_ta_s1_action/'.$id_trx),
            'form_detail'=>'Form sidang : '.$data_file->nim."/ ".$data_file->nama_mhs,
        );

        $data_isi=array(
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


}
