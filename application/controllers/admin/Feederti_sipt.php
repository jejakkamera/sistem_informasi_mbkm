<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feeder extends CI_Controller {

    private $features = array();

    function __construct(){
        parent::__construct();
        $this->load->library('Feeder_lib');
        if($this->verify->checkBearerToken()['status'] != true) {
            $this->response->json([
                'messages' => 'Pengguna tidak terdaftar atau tidak memiliki hak akses'
            ],401);

        } 
    }

    function data_jenjang_pendidikan(){
        $jenjang = $this->crud->all('dikti_jenjang_pendidikan');

        if($jenjang->num_rows() > 0) {
            $this->response->json([
                'messages' => 'success',
                'status_code' => '000',
                'total_data' => $jenjang->num_rows(),
                'data' => $jenjang->result()
            ],200);
        } else {
            $this->response->json([
                'messages' => 'jenjang tidak ditemukan',
                'status_code' => '401',
                'data' => null
            ],200);
        }
    }

    function data_mahasiswa(){
        $mahasiswa = $this->db->select('mahasiswa.nim as nim, mahasiswa.id_periode_masuk AS periode_masuk,mahasiswa.tanggal_daftar,mahasiswa.email, mahasiswa.nama,dikti_prodi.nama_program_studi AS prodi,mahasiswa.id_mahasiswa AS status_feeder')
                              ->from('mahasiswa')
                              ->join('dikti_prodi','mahasiswa.kode_prodi = dikti_prodi.kode_program_studi')
                              ->where('mahasiswa.id_mahasiswa',null)
                              ->get();
          if($mahasiswa->num_rows() > 0){
            
            $this->response->json([
                'messages' => 'success',
                'status_code' => '000',
                'total_data' => $mahasiswa->num_rows(),
                'data' => $mahasiswa->result()
            ],200);

        } else {
            $this->response->json([
                'messages' => 'mahasiswa tidak ditemukan',
                'status_code' => '401',
                'data' => null
            ],200);
        }

    }

    function f_UpdateProfilPT(){

        // $this->load->helper('security');
        // 'rules' => 'required|trim|xss_clean'


        
        $rules = [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ],
            [
                'field' => 'url',
                'label' => 'Url',
                'rules' => 'required'
            ],
            [
                'field' => 'port',
                'label' => 'Port',
                'rules' => 'required'
            ],
           
            [
                'field' => 'live',
                'label' => 'live',
                'rules' => 'required'
            ],
        ];

        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == false){
            $this->response->json([
                'messages' => "Error",
                'data'=> validation_errors(),
                'status_code' => '401'
            ],200);
        } else {

            $this->crud->update('dikti_pt',[
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'url' => $this->input->post('url'),
                'port' => $this->input->post('port'),
                'live' => $this->input->post('live')
            ],['kode_pt' => '041062']);

            $this->response->json([
                'messages' => "success",
                'data'=> [
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'url' => $this->input->post('url'),
                    'port' => $this->input->post('port'),
                    'live' => $this->input->post('live')
                ],
                'status_code' => '000'
            ],200);
        }
    }

    function pt_info(){
       $info_pt=$this->crud->all('dikti_pt')->row();
        $this->response->json([
            'messages' => $info_pt->nm_lemb,
            'data'=>$info_pt
        ],200);
    }
    

 /**
  * ! Sebelum Akses API Feeder dengan API Client, akses ke f_GetToken terlebih dahulu
  *
  */

    function f_GetToken(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi( $data_pt);
       
        $kode_pt=$data_pt->username;
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $data = ['act'=>'GetToken', 'username'=>$data->username,'password'=>$data->password];
        $data = json_encode($data);
     	$options = array(
							'http' => array(
                                'header'  => "Content-type: application/json",
                                'method'  => 'POST',
                                'content' => ($data),)
                            );
                        
        $context  = stream_context_create($options);

        if (!$data = file_get_contents($url, false, $context)) {
            $error = "HTTP request failed. Error was: ".error_get_last();
            $where_=array(
                'username'=>$kode_pt,
            );
            $data = array(
                'status_connected' => 'n',
                'token' => NULL,
            );

            $this->crud->update('dikti_pt',$data,$where_);
            $this->response->json([
                'messages' => 'error code [] : '.$error,
            ],200);

        }else{
            $data_json=json_decode($data);
            if($data_json->error_code==0){
                $data_feeder=$data_json->data;
                $where_=array(
                    'username'=>$kode_pt,
                );
                $data = array(
					'status_connected' => 'y',
					'token' => $data_feeder->token,
				);
                $this->crud->update('dikti_pt',$data,$where_);
                
                $this->session->set_userdata(array(
                    'token'      =>  $data_feeder->token,
                    'kode_pt'      =>  $kode_pt,
                ));
                $this->response->json([
                    'messages' => 'Feeder connected',
                    'token' => $data_feeder->token,
                ],200);
            }else{

                $where_=array(
                    'username'=>$kode_pt,
                );
                $data = array(
					'status_connected' => 'n',
					'token' => NULL,
				);
                $this->crud->update('dikti_pt',$data,$where_);
                $this->response->json([
                    'messages' => 'error code 2 ['.$data_json->error_code.'] : '.$data_json->error_desc,
                ],200);
            }
        }
    }

    // function f_GetListMataKuliah(){
    //     $pt = $this->crud->all('dikti_pt')->row();
    //     $desc = $this->feeder_lib->deskripsi($pt);
    //     $data = $desc['data_pt'];
    //     $url = $desc['url'];
    //     $kode_pt = $pt->username;

    //     $data = json_encode([
    //         'act' => 'DetailBiodataDosen',
    //         'token' => $data->token
    //     ]);

    //     $feederData = $this->feeder_lib->send_ws($data,$url);

    //     if($feederData){
    //         $this->crud->insert_batch('dikti_raw_dosen',$feederData);
    //         $this->response->json([
    //             'messages' => 'Data dosen berhasil tersimpan'
    //         ],200);
    //     } else {
    //         $this->response->json([
    //             'messages' => 'null data',
    //         ],200);
    //     }
       
    // }

    function f_GetDetailBiodataDosen(){
        $pt = $this->crud->all('dikti_pt')->row();
        $desc = $this->feeder_lib->deskripsi($pt);
        $data = $desc['data_pt'];
        $url = $desc['url'];
        $kode_pt = $pt->username;

        $data = json_encode([
            'act' => 'DetailBiodataDosen',
            'token' => $data->token
        ]);

        $feederData = $this->feeder_lib->send_ws($data,$url);

        if($feederData){
            $this->crud->insert_batch('dikti_raw_dosen',$feederData);
            $this->response->json([
                'messages' => 'Data dosen berhasil tersimpan'
            ],200);
        } else {
            $this->response->json([
                'messages' => 'null data',
            ],200);
        }
       
    }
    
    function f_GetPembiayaan(){

        $pt = $this->crud->all('dikti_pt')->row();
        $desc = $this->feeder_lib->deskripsi($pt);
        $data = $desc['data_pt'];
        $url = $desc['url'];
        $kode_pt = $pt->username;

        $data = json_encode([
            'act' => 'GetPembiayaan',
            'token' => $data->token
        ]);

        $feederData = $this->feeder_lib->send_ws($data,$url);

        if ($feederData) {
            $this->crud->truncate('dikti_pembiayaan');
            $this->crud->insert_batch('dikti_pembiayaan',$feederData);
            
            $this->response->json([
                'messages' => 'Data pembiayaan berhasil disimpan'
            ],200);

        } else {

            $this->response->json([
                'messages' => 'Kesalahan mengambil data pembiayaan'
            ],500);

        }


        
    }

    function f_GetProfilPT(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetProfilPT', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        $data_feeder= $data_feeder[0];
                $where_=array(
                    'username'=>$kode_pt,
                );
                $data = array(
					'id_sp' => $data_feeder->id_perguruan_tinggi,
					'kode_pt' => $data_feeder->kode_perguruan_tinggi,
					'nm_lemb' => $data_feeder->nama_perguruan_tinggi,
				);
                $this->crud->update('dikti_pt',$data,$where_);
                $this->response->json([
                    'messages' => 'Succes get content',
                    'data'=>$data_feeder
                ],200);
    }

    function f_GetProdi(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetProdi', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        $count_update=0;
        $count_insert=0;
        foreach($data_feeder as $row){
            $where_=array(
                'id_prodi'=>$row->id_prodi,
            );
            $data=$this->crud->get('dikti_prodi',$where_)->row();
            if($data){

                $data = array(
					'kode_program_studi' => $row->kode_program_studi,
					'nama_program_studi' => $row->nama_program_studi,
					'status' => $row->status,
					'id_jenjang_pendidikan' => $row->id_jenjang_pendidikan,
				);
                $this->crud->update('dikti_prodi',$data,$where_);
                $count_update++;
            }else{
                $data = array(
					'id_prodi' => $row->id_prodi,
					'kode_program_studi' => $row->kode_program_studi,
					'nama_program_studi' => $row->nama_program_studi,
					'status' => $row->status,
					'id_jenjang_pendidikan' => $row->id_jenjang_pendidikan,
				);
                $this->crud->insert('dikti_prodi',$data);
                $count_insert++;
            }

        }

                $this->response->json([
                    'messages' => 'Succes get content, Update : '.$count_update.', Add : '.$count_insert,
                   
                ],200);
    }
    /**
     *  ! deprecated 
     *
     */
    function f_GetPeriode(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetPeriode', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){

            $this->crud->truncate('dikti_periode_aktif_prodi');
            $this->crud->insert_batch('dikti_periode_aktif_prodi',$data_feeder);
            
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetJenjangPendidikan(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetJenjangPendidikan', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){
        $count_update=0;
        $count_insert=0;
        foreach($data_feeder as $row){
            $where_=array(
                'id_jenjang_didik'=>$row->id_jenjang_didik,
            );
            $data=$this->crud->get('dikti_jenjang_pendidikan',$where_)->row();
            if($data){

                $data = array(
					'nama_jenjang_didik' => $row->nama_jenjang_didik,
				);
                $this->crud->update('dikti_jenjang_pendidikan',$data,$where_);
                $count_update++;
            }else{
                $data = array(
					'id_jenjang_didik' => $row->id_jenjang_didik,
					'nama_jenjang_didik' => $row->nama_jenjang_didik,
				);
                $this->crud->insert('dikti_jenjang_pendidikan',$data);
                $count_insert++;
            }
        }
            $this->response->json([
                'messages' => 'Succes get content, Update : '.$count_update.', Add : '.$count_insert,
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetWilayah(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetWilayah', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){
            $this->crud->truncate('dikti_wilayah');
            $this->crud->insert_batch('dikti_wilayah',$data_feeder);
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetSdm(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;
        $data = [
            'act' => 'GetIkatanKerjaSdm',
            'token' => $data->token
        ];

        $data = json_encode($data);
        $feederData = $this->feeder_lib->send_ws($data,$url);
        if($feederData){
            //$this->crud->truncate('dikti_status_aktif');
            $this->crud->insert_batch('dikti_sdm',$feederData);

            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        } else {
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }


    function f_GetStatusAktif(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;
        $data = [
            'act' => 'GetStatusKeaktifanPegawai',
            'token' => $data->token
        ];

        $data = json_encode($data);
        $feederData = $this->feeder_lib->send_ws($data,$url);
        if($feederData){
            //$this->crud->truncate('dikti_status_aktif');
            $this->crud->insert_batch('dikti_status_aktif',$feederData);

            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        } else {
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetTahunAjaran(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetTahunAjaran', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){
           $this->crud->truncate('dikti_tahun_ajaran');
            $this->crud->insert_batch('dikti_tahun_ajaran',$data_feeder);
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetStatusMahasiswa(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetStatusMahasiswa', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){
           $this->crud->truncate('dikti_status_mahasiswa');
            $this->crud->insert_batch('dikti_status_mahasiswa',$data_feeder);
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetSemester(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetSemester', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){
           $this->crud->truncate('dikti_semester');
            $this->crud->insert_batch('dikti_semester',$data_feeder);
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetPenghasilan(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetPenghasilan', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){
           $this->crud->truncate('dikti_penghasilan');
            $this->crud->insert_batch('dikti_penghasilan',$data_feeder);
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetPekerjaan(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetPekerjaan', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){
           
           $this->crud->truncate('dikti_pekerjaan');
            $this->crud->insert_batch('dikti_pekerjaan',$data_feeder);
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetJenisTinggal(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetJenisTinggal', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){ 
           $this->crud->truncate('dikti_jenis_tinggal');
            $this->crud->insert_batch('dikti_jenis_tinggal',$data_feeder);
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetJenisPendaftaran(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetJenisPendaftaran', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){ 
           $this->crud->truncate('dikti_jenis_pendaftaran');
            $this->crud->insert_batch('dikti_jenis_pendaftaran',$data_feeder);
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetJenisKeluar(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetJenisKeluar', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){ 
           $this->crud->truncate('dikti_jenis_keluar');
            $this->crud->insert_batch('dikti_jenis_keluar',$data_feeder);
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetJalurMasuk(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetJalurMasuk', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){ 
           $this->crud->truncate('dikti_jalur_masuk');
            $this->crud->insert_batch('dikti_jalur_masuk',$data_feeder);
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetAgama(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetAgama', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder){ 
          
           $this->crud->truncate('dikti_agama');
            $this->crud->insert_batch('dikti_agama',$data_feeder);
            $this->response->json([
                'messages' => 'Succes get content',
            ],200);
        }else{
            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }
    }

    function f_GetListKurikulum(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetListKurikulum', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        if($data_feeder) {

            foreach($data_feeder as $feeder) {


                $this->crud->insert('kurikulum',[
                    'id_kurikulum' => $feeder->id_kurikulum,
                    'nama_kurikulum' => $feeder->nama_kurikulum,
                    'kode_prodi' => $feeder->id_prodi,
                    'id_semester' => $feeder->id_semester,
                   
                ]);
    
        
    
            }

            $this->response->json([
                'messages' => 'Succes get content',
            ],200);

        } else {

            $this->response->json([
                'messages' => 'Null data',
            ],200);

        }
        // print_r($data_feeder);
    }

    function f_GetListMataKuliah(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetListMataKuliah', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);

     
        if($data_feeder) {

            foreach($data_feeder as $feeder) {


                $this->crud->insert('mata_kuliah',[
                    'id_matkul' => $feeder->id_matkul,
                    'kode_mata_kuliah' => $feeder->kode_mata_kuliah,
                    'nama_mata_kuliah' => $feeder->nama_mata_kuliah,
                    'kode_prodi' => $feeder->id_prodi,
                    'id_jenis_mata_kuliah' => $feeder->id_jenis_mata_kuliah,
                    'id_kelompok_mata_kuliah' => $feeder->id_kelompok_mata_kuliah,
                    'sks_mata_kuliah' => $feeder->sks_mata_kuliah
                ]);
    
            }

            $this->response->json([
                'messages' => 'Succes get content',
            ],200);

        } else {

            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }

        
        
        // print_r($data_feeder[0]);
    }

    function f_GetMatkulKurikulum(){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetMatkulKurikulum', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);

        // print_r($data_feeder);

     
        if($data_feeder) {

            foreach($data_feeder as $feeder) {

                $this->crud->insert('matakuliah_kurikulum',[
                    'id_kurikulum' => $feeder->id_kurikulum,
                    'kode_mata_kuliah' => $feeder->kode_mata_kuliah,
                    'kode_prodi' => $feeder->id_prodi,
                    'semester' => $feeder->semester,
                    'apakah_wajib' => $feeder->apakah_wajib,
                    'sks_tatap_muka' => $feeder->sks_tatap_muka,
                    'sks_praktek' => $feeder->sks_praktek,
                    'sks_praktek_lapangan' => $feeder->sks_praktek_lapangan,
                    'sks_simulasi' => $feeder->sks_simulasi,
                    'id_semester' => $feeder->id_semester,
                    'id_matkul' => $feeder->id_matkul
                ]);
    
            }

            $this->response->json([
                'messages' => 'Succes get content',
            ],200);

        } else {

            $this->response->json([
                'messages' => 'Null data',
            ],200);
        }    
    }

    function f_GetListMahasiswa($nim){
        $data_pt=$this->crud->all('dikti_pt')->row();
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetListMahasiswa', 'token'=>$data->token,'filter'=>"nim = '".$nim."'"];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);

        if($data_feeder){ 
            $where_=array(
                'nim'=>$nim,
            );
            $data = array(
                'id_mahasiswa' => $data_feeder[0]->id_mahasiswa,
            );

            $this->crud->update('mahasiswa',$data,$where_);
            $this->response->json([
                'messages' => $data,
            ],200);
         }else{
             $this->response->json([
                 'messages' => 'Null data',
             ],200);
         }
        //print_r($data_feeder);
      
    }

    
}
