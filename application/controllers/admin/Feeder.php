<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit', '12048M');
defined('BASEPATH') OR exit('No direct script access allowed');

class Feeder extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('feeder',$level,$action);
        if($access==0){
            $text = $this->alert->danger('You do not have access');
			$this->session->set_flashdata('message', $text);
			redirect("welcome/dashboard");
		}
	}

	public function header(){
		if($this->session->userdata('isLogin')==TRUE){
			$this->load->view('master/header');
		}else{
			redirect('/welcome/login', 'refresh');
		}
		
	}

	public function footer(){
			$this->load->view('master/footer');
	}

	public function index()
	{
		if($this->session->userdata('isLogin')==TRUE){
			redirect('/admin/feeder/connector', 'refresh');
		}else{
			redirect('/welcome/login', 'refresh');
		}
		
    }

    function f_GetRiwayatNilaiMahasiswa(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetRiwayatNilaiMahasiswa', 'token'=>$data->token,
        // 'filter'=>"id_periode = '20201'"
        'filter'=>"id_periode='".$this->session->userdata('set_periode')['periode']."'"
        ];
        
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //print_r($data_feeder);
        if($data_feeder['error_code']==0){ 
            unlink('results_nilai.json');
            $fp = fopen('results_nilai.json', 'x');
            fwrite($fp, json_encode($data_feeder));
            fclose($fp);

            $text = $this->alert->success('Data Succes ful get');
            $this->session->set_flashdata('message', $text);
            redirect('/admin/feeder/f_GetRiwayatNilaiMahasiswa_action', 'refresh');
        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
            $this->session->set_flashdata('message', $text);
            redirect('/admin/feeder/riwayatnilai', 'refresh');
                
        }      
    }

    function f_GetListMahasiswa_select($link=null){
        $this->load->model('form/Baak_f', 'baak_form');
        $data_master=$this->baak_form->f_GetListMahasiswa_select($link);

		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>null,
                'status'=>null,
            ]
        );
		$this->footer();
    }

    function f_GetListMahasiswa_select_action($link=null){
        $id_periode=$this->input->post('id_periode',TRUE);
        redirect(site_url('admin/feeder/f_GetListMahasiswa/'.$id_periode));
    }

    function f_GetListMahasiswa($periode){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetListMahasiswa', 'filter'=>"id_periode='".$periode."'", 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);

        if($data_feeder['error_code']==0){ 
            unlink('results.json');
            $fp = fopen('results.json', 'x');
            fwrite($fp, json_encode($data_feeder));
            fclose($fp);

            $text = $this->alert->success('Data Succes ful get');
            $this->session->set_flashdata('message', $text);
            redirect('/admin/feeder/f_GetListMahasiswa_action', 'refresh');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
            $this->session->set_flashdata('message', $text);
            redirect('/admin/feeder/mahasiswa', 'refresh');
                
        }      
    }

    function f_GetListDosen(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetListDosen', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);

        if($data_feeder['error_code']==0){ 
            unlink('results_dosen.json');
            $fp = fopen('results_dosen.json', 'x');
            fwrite($fp, json_encode($data_feeder));
            fclose($fp);

            $text = $this->alert->success('Data Succes ful get');
            $this->session->set_flashdata('message', $text);
            redirect('/admin/feeder/f_GetListDosen_action', 'refresh');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
            $this->session->set_flashdata('message', $text);
            redirect('/admin/feeder/dosen', 'refresh');
                
        }      
    }

    function f_GetBiodataMahasiswa($id_mahasiswa){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetBiodataMahasiswa','filter'=>"id_mahasiswa='".$id_mahasiswa."'", 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);

        if($data_feeder['error_code']==0){ 
           return $data_feeder['data'];
        }else{
            return null;
        }      
    }

    function f_Getalldatadosen($id_dosen){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetListPenugasanDosen','filter'=>"id_dosen='".$id_dosen."'", 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);

        if($data_feeder['error_code']==0){ 
           return $data_feeder['data'];
        }else{
            return null;
        }      
    }

    function f_GetListPenugasanDosen(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        // $data = ['act'=>'GetListPenugasanDosen','filter'=>"id_tahun_ajar='".substr($this->session->userdata('set_periode')['periode'], 0, 4) ."'", 'token'=>$data->token];
        $data = ['act'=>'GetListPenugasanDosen','filter'=>"", 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);

        if($data_feeder['error_code']==0){ 
        //    print_r($data_feeder['data']); die();
            foreach($data_feeder['data'] as $row){
                $id_registrasi_dosen=$this->Master_model->master_get(['id_registrasi_dosen'=>$row->id_registrasi_dosen,'id_tahun_ajaran'=>$row->id_tahun_ajaran],'dikti_penugasan_dosen');
                // print_r($row); die();
                if(!$id_registrasi_dosen){
                    $data=array(
                        'id_registrasi_dosen'=>$row->id_registrasi_dosen,
                        'id_dosen'=>$row->id_dosen,
                        'id_tahun_ajaran'=>$row->id_tahun_ajaran,
                        'id_prodi'=>$row->id_prodi,
                        'mulai_surat_tugas'=>$row->mulai_surat_tugas,
                    );
                    $this->Master_model->insert_query('dikti_penugasan_dosen',$data);
                }

            }   

            $text = $this->alert->success('Data Succes ful get');
            $this->session->set_flashdata('message', $text);
            redirect('/admin/feeder/dosen', 'refresh');

        }else{
             $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
            $this->session->set_flashdata('message', $text);
            redirect('/admin/feeder/dosen', 'refresh');
        }      
    }

    function f_GetToken(){
        //echo date('Y-m-d h:i:s');
        //$data_pt=$this->crud->all('dikti_pt')->row();
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
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
                'info_conection' => $error,
            );

            $this->Master_model->update_query($where_, $data, 'dikti_pt');
            $text = $this->alert->danger('Error : '.$error);
        }else{
            $data_json=json_decode($data);
            //print_r($data_json);
            if($data_json->error_code==0){
                $data_feeder=$data_json->data;
                $where_=array(
                    'username'=>$kode_pt,
                );
                $data = array(
					'status_connected' => 'y',
					'token' => $data_feeder->token,
                    'info_conection'      =>  'Feeder connected',
				);
                $this->Master_model->update_query($where_, $data, 'dikti_pt');
                
                $this->session->set_userdata(array(
                    'token'      =>  $data_feeder->token,
                    'kode_pt'      =>  $kode_pt,
                    'last_connection'      =>  date('Y-m-d H:i:s'),
                    'info_conection'      =>  'Feeder connected',
                ));
                $text = $this->alert->success('Feeder connected, Token : '.$data_feeder->token);
                
            }else{

                $where_=array(
                    'username'=>$kode_pt,
                );
                $data = array(
					'status_connected' => 'n',
					'token' => NULL,
					'info_conection' => 'error code 2 ['.$data_json->error_code.'] : '.$data_json->error_desc,
                );
                
                $this->Master_model->update_query($where_, $data, 'dikti_pt');
                $text = $this->alert->danger('error code 2 ['.$data_json->error_code.'] : '.$data_json->error_desc);
                
            }
        }
       
		$this->session->set_flashdata('message', $text);
       redirect('/admin/feeder/connector', 'refresh');
    }

    function f_GetListmatakuliah(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetListMataKuliah', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        
        //print_r($data_feeder);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
            $data_prodi=$this->Master_model->master_result(array(),'dikti_prodi');
             $data_mk=array();
             $data_p=array();
            foreach($data_prodi as $row){
                $data_prodis=array(
                    $row['id_prodi']=>$row['kode_program_studi'],
                );
                $data_p=$data_p+$data_prodis;
            }
            //print_r($data_p);
            //echo $data_p['06f28cbe-1cab-4713-a42a-635c01e5548f'];
            foreach($data_feeder['data'] as $rows){
                $data_now=array(
                    'id_matkul'=>$rows->id_matkul,
                    'kode_mata_kuliah'=>$rows->kode_mata_kuliah,
                    'nama_mata_kuliah'=>$rows->nama_mata_kuliah,
                    'kode_prodi'=>$data_p[$rows->id_prodi],
                    'id_jenis_mata_kuliah'=>$rows->id_jenis_mata_kuliah,
                    'id_kelompok_mata_kuliah'=>$rows->id_kelompok_mata_kuliah,
                    'sks_mata_kuliah'=>$rows->sks_mata_kuliah,
                );
                array_push($data_mk,$data_now);
            }

            $this->Master_model->truncate_query('mata_kuliah');
            $this->Master_model->insert_batch('mata_kuliah',$data_mk);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/matakuliah', 'refresh');
    }

    function f_GetListKurikulum(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetDetailKurikulum', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        
        //print_r($data_feeder);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){
            $data_prodi=$this->Master_model->master_result(array(),'dikti_prodi');
             $data_mk=array();
             $data_p=array();
            foreach($data_prodi as $row){
                $data_prodis=array(
                    $row['id_prodi']=>$row['kode_program_studi'],
                );
                $data_p=$data_p+$data_prodis;
            }

            foreach($data_feeder['data'] as $rows){
                $data_now=array(
                    'id_kurikulum'=>$rows->id_kurikulum,
                    'nama_kurikulum'=>$rows->nama_kurikulum,
                    'id_prodi'=>$rows->id_prodi,
                    'id_semester'=>$rows->id_semester,
                    'kode_prodi'=>$data_p[$rows->id_prodi],
                );
                array_push($data_mk,$data_now);
            }

            $this->Master_model->truncate_query('kurikulum');
            $this->Master_model->insert_batch('kurikulum',$data_mk);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/kurikulum', 'refresh');
    }
    
    function f_GetMatkulKurikulum(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetMatkulKurikulum', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        
        //print_r($data_feeder);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){
            $data_prodi=$this->Master_model->master_result(array(),'dikti_prodi');
            $data_mk=array();
            $data_p=array();
           foreach($data_prodi as $row){
               $data_prodis=array(
                   $row['id_prodi']=>$row['kode_program_studi'],
               );
               $data_p=$data_p+$data_prodis;
           }

           foreach($data_feeder['data'] as $rows){
            $data_now=array(
                'id_kurikulum'=>$rows->id_kurikulum,
                'kode_prodi'=>$data_p[$rows->id_prodi],

                'semester'=>$rows->semester,
                'apakah_wajib'=>$rows->apakah_wajib,
                'sks_tatap_muka'=>$rows->sks_tatap_muka,
                'sks_praktek'=>$rows->sks_praktek,
                'sks_praktek_lapangan'=>$rows->sks_praktek_lapangan,
                'sks_simulasi'=>$rows->sks_simulasi,
                'id_semester'=>$rows->id_semester,
                'id_matkul'=>$rows->id_matkul,
                
            );
            array_push($data_mk,$data_now);
            $this->Master_model->truncate_query('matakuliah_kurikulum');
            $this->Master_model->insert_batch('matakuliah_kurikulum',$data_mk);
            $text = $this->alert->success('Success');
        }


        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/matakuliah_kurikulum', 'refresh');
    }

    function f_GetProdi(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetProdi', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //print_r($data_feeder);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_prodi');
            $this->Master_model->insert_batch('dikti_prodi',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/prodi', 'refresh');
    }

    function f_GetAgama(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetAgama', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_agama');
            $this->Master_model->insert_batch('dikti_agama',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/agama', 'refresh');
    }

    function f_GetJalurMasuk(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetJalurMasuk', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_jalur_masuk');
            $this->Master_model->insert_batch('dikti_jalur_masuk',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/jalurmasuk', 'refresh');
    }




    function f_GetJalurkeluar(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetJenisKeluar', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_jenis_keluar');
            $this->Master_model->insert_batch('dikti_jenis_keluar',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/jalurkeluar', 'refresh');
    }

    function f_GetJenisPendaftaran(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetJenisPendaftaran', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_jenis_pendaftaran');
            $this->Master_model->insert_batch('dikti_jenis_pendaftaran',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/jenispendaftaran', 'refresh');
    }

    function f_GetJenjangPendidikan(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetJenjangPendidikan', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_jenjang_pendidikan');
            $this->Master_model->insert_batch('dikti_jenjang_pendidikan',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/jenjangpendidikan', 'refresh');
    }

    function f_GetJenisTinggal(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetJenisTinggal', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_jenis_tinggal');
            $this->Master_model->insert_batch('dikti_jenis_tinggal',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/jenistinggal', 'refresh');
    }

    

    function f_GetPekerjaan(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetPekerjaan', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_pekerjaan');
            $this->Master_model->insert_batch('dikti_pekerjaan',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/pekerjaan', 'refresh');
    }

    

    function f_GetPembiayaan(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetPembiayaan', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_pembiayaan');
            $this->Master_model->insert_batch('dikti_pembiayaan',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/pembiayaan', 'refresh');
    }

    

    function f_GetPenghasilan(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetPenghasilan', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_penghasilan');
            $this->Master_model->insert_batch('dikti_penghasilan',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/penghasilan', 'refresh');
    }

    

    function f_GetWilayah(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetWilayah', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_wilayah');
            $this->Master_model->insert_batch('dikti_wilayah',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/wilayah', 'refresh');
    }

    

    function f_GetTahunAjaran(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetTahunAjaran', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_tahun_ajaran');
            $this->Master_model->insert_batch('dikti_tahun_ajaran',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/tahunajaran', 'refresh');
    }

    function f_GetListRiwayatPendidikanMahasiswa(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;
        $data_mk=array();

        $data = ['act'=>'GetNilaiTransferPendidikanMahasiswa', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);

        
        print_r($data_feeder);
        die;
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){
        
            foreach($data_feeder['data'] as $rows){
                $data_now=array(
                    'nim'=>$rows->nim,
                    'id_jenis_daftar'=>$rows->id_jenis_daftar,
                    'nama_program_studi_asal'=>$rows->nama_program_studi_asal,
                    'id_prodi_asal'=>$rows->id_prodi_asal,
                    'id_perguruan_tinggi_asal'=>$rows->id_perguruan_tinggi_asal,
                    'nama_perguruan_tinggi_asal'=>$rows->nama_perguruan_tinggi_asal,
                    'sks_diakui'=>$rows->sks_diakui,
                );
                array_push($data_mk,$data_now);
  
            }

            $this->Master_model->truncate_query('mahasiswa_riwayat_pendidikan');
            $this->Master_model->insert_batch('mahasiswa_riwayat_pendidikan',$data_mk);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/mahasiswa_riwayat_pendidikan', 'refresh');
    }

    function f_GetListRiwayatPendidikanMahasiswa2(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetListRiwayatPendidikanMahasiswa', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('mahasiswa_riwayat_pendidikan');
            $this->Master_model->insert_batch('mahasiswa_riwayat_pendidikan',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/mahasiswa_riwayat_pendidikan', 'refresh');
    }

    

    function f_GetStatusMahasiswa(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetStatusMahasiswa', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_status_mahasiswa');
            $this->Master_model->insert_batch('dikti_status_mahasiswa',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/statusmahasiswa', 'refresh');
    }

    

    function f_GetStatusKeaktifanPegawai(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetStatusKeaktifanPegawai', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_status_aktif');
            $this->Master_model->insert_batch('dikti_status_aktif',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/statusaktif', 'refresh');
    }

    

    function f_GetSemester(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetSemester', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_semester');
            $this->Master_model->insert_batch('dikti_semester',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/semester', 'refresh');
    }

    

    function f_GetIkatanKerjaSdm(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetIkatanKerjaSdm', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_sdm');
            $this->Master_model->insert_batch('dikti_sdm',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/sdm', 'refresh');
    }

    

    function f_GetAlatTransportasi(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;

        $data = ['act'=>'GetAlatTransportasi', 'token'=>$data->token];
        $data = json_encode($data);
        $data_feeder=$this->feeder_lib->send_ws($data,$url);
        //echo $data_feeder['error_code'];
        if($data_feeder['error_code']==0){ 
          
            $this->Master_model->truncate_query('dikti_transportasi');
            $this->Master_model->insert_batch('dikti_transportasi',$data_feeder['data']);
            $text = $this->alert->success('Success');

        }else{

            $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                
        }

        $this->session->set_flashdata('message', $text);
        redirect('/admin/feeder/transportasi', 'refresh');
    }

	public function connector_update()
	{
        $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('url', 'url', 'trim|required|xss_clean');
        $this->form_validation->set_rules('port', 'port', 'trim|required|xss_clean');
        $this->form_validation->set_rules('live', 'live', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ( ($this->form_validation->run() == TRUE)   ) {
            $data = array(
                'username' => $this->input->post('username',TRUE),
                'password' => $this->input->post('password',TRUE),
                'url' => $this->input->post('url',TRUE),
                'port' => $this->input->post('port',TRUE),
                'live' => $this->input->post('live',TRUE),
            );
            $this->Master_model->update_query(['kode_pt'=>'043139'], $data, 'dikti_pt');
            log_message('info', 'Update - data to dikti_pt, data :');
            
            $text = $this->alert->success('Data successfully update');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('admin/feeder/connector'));
        }else{
            $this->connector();
        }
        
    }

	public function agama()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->agama();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

	public function jalurmasuk()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->jalurmasuk();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

	public function jalurkeluar()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->jalurkeluar();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    public function jenispendaftaran()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->jenispendaftaran();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    

    public function jenistinggal()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->jenistinggal();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    

    public function jenjangpendidikan()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->jenjangpendidikan();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    

    public function pekerjaan()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->pekerjaan();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    public function mahasiswa_riwayat_pendidikan()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->mahasiswa_riwayat_pendidikan();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    

    public function pembiayaan()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->pembiayaan();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    

    public function penghasilan()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->penghasilan();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    

    public function wilayah()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->wilayah();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    public function tahunajaran()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->tahunajaran();

        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    public function statusmahasiswa()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->statusmahasiswa();

        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    public function statusaktif()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->statusaktif();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    public function semester()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->semester();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    

    public function sdm()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->sdm();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    public function kurikulum()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->kurikulum();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    public function riwayatnilai()
	{
        if($this->session->userdata('set_periode')['periode']){
            $this->load->model('tabel/Feeder_t', 'feeder_tabel');
            $data_master=$this->feeder_tabel->riwayatnilai();

            //print_r($data_master);
            $this->header();
            $this->load->view('master/master_list',
                [
                    'data_detail'=>$data_master['data_detail'],
                    'data_isi'=>$data_master['data_isi'],
                ]
            );
            $this->footer();
        }else{
            $text = $this->alert->danger('Select Periode');
            $this->session->set_flashdata('message', $text);
            redirect('admin/feeder/set_periode', 'refresh');
        }
		
    }

    public function f_GetListMahasiswa_action(){
        $this->header();
        $this->load->view('f_GetListMahasiswa_action');
		$this->footer();
    }

    public function f_GetRiwayatNilaiMahasiswa_action(){
        $this->header();
        $this->load->view('f_GetRiwayatNilaiMahasiswa_action');
		$this->footer();
    }

    public function f_GetListDosen_action(){
        $this->header();
        $this->load->view('f_GetListDosen_action');
		$this->footer();
    }

    public function f_GetListMahasiswa_check(){
        $nim=$this->input->post('nim',TRUE);
        $id_mahasiswa=$this->input->post('id_mahasiswa',TRUE);
        $id_periode=$this->input->post('id_periode',TRUE);
        $id_prodi=$this->input->post('id_prodi',TRUE);
        $nama_mahasiswa=$this->input->post('nama_mahasiswa',TRUE);
        $nama_status_mahasiswa=$this->input->post('nama_status_mahasiswa',TRUE);
        $id_registrasi_mahasiswa=$this->input->post('id_registrasi_mahasiswa',TRUE);

        $mahasiswa=$this->Master_model->master_get(['nim'=>$nim],'mahasiswa');
        if($mahasiswa){
            $data=array(
                'id_periode_masuk'=>$id_periode,
                'nama'=>$nama_mahasiswa,
                'status_mahasiswa'=>$nama_status_mahasiswa,
            );

            $this->Master_model->update_query(['nim'=>$nim], $data, 'mahasiswa');
            $this->Master_model->insert_history('update','mahasiswa',json_encode($data));
            $biodata = $this->f_GetBiodataMahasiswa($id_mahasiswa);
            $data_bio=array(
                'jenis_kelamin'=>$biodata[0]->jenis_kelamin,
                'tempat_lahir'=>$biodata[0]->tempat_lahir,
                'tanggal_lahir'=>$biodata[0]->tanggal_lahir,
                'id_agama'=>$biodata[0]->id_agama,
                'nik'=>$biodata[0]->nik,
                'nisn'=>$biodata[0]->nisn,
                'npwp'=>$biodata[0]->npwp,
                'id_negara'=>$biodata[0]->id_negara,
                'kewarganegaraan'=>$biodata[0]->kewarganegaraan,
                'alamat'=>$biodata[0]->dusun,
                'kelurahan'=>$biodata[0]->kelurahan,
                'kode_pos'=>$biodata[0]->kode_pos,
                'id_wilayah'=>$biodata[0]->id_wilayah,
                'id_jenis_tinggal'=>$biodata[0]->id_jenis_tinggal,
                'id_alat_transportasi'=>$biodata[0]->id_alat_transportasi,
                'telepon'=>$biodata[0]->telepon,
                'handphone'=>$biodata[0]->handphone,
                'email'=>$biodata[0]->email,
                'penerima_kps'=>$biodata[0]->penerima_kps,
                'no_kps'=>$biodata[0]->nomor_kps,
                'nik_ayah'=>$biodata[0]->nik_ayah,
                'nama_ayah'=>$biodata[0]->nama_ayah,
                'tanggal_lahir_ayah'=>$biodata[0]->tanggal_lahir_ayah,
                'id_jenjang_pendidikan_ayah'=>$biodata[0]->id_pendidikan_ayah,
                'id_pekerjaan_ayah'=>$biodata[0]->id_pekerjaan_ayah,
                'id_penghasilan_ayah'=>$biodata[0]->id_penghasilan_ayah,
                'nik_ibu'=>$biodata[0]->nik_ibu,
                'nama_ibu_kandung'=>$biodata[0]->nama_ibu,
                'tanggal_lahir_ibu'=>$biodata[0]->tanggal_lahir_ibu,
                'id_jenjang_pendidikan_ibu'=>$biodata[0]->id_pendidikan_ibu,
                'id_pekerjaan_ibu'=>$biodata[0]->id_pekerjaan_ibu,
                'id_penghasilan_ibu'=>$biodata[0]->id_penghasilan_ibu,
                'nama_wali'=>$biodata[0]->nama_wali,
                'tanggal_lahir_wali'=>$biodata[0]->tanggal_lahir_wali,
                'id_jenjang_pendidikan_ibu'=>$biodata[0]->id_pendidikan_wali,
                'id_pekerjaan_wali'=>$biodata[0]->id_pekerjaan_wali,
                'id_penghasilan_wali'=>$biodata[0]->id_penghasilan_wali,
                'id_kebutuhan_khusus_mahasiswa'=>$biodata[0]->id_kebutuhan_khusus_mahasiswa,
                'id_kebutuhan_khusus_ayah'=>$biodata[0]->id_kebutuhan_khusus_ayah,
                'id_kebutuhan_khusus_ibu'=>$biodata[0]->id_kebutuhan_khusus_ibu,
            );
            $this->Master_model->update_query(['nim'=>$nim], $data_bio, 'mahasiswa_profile');
            $this->Master_model->insert_history('insert','mahasiswa_profile',json_encode($data));

            $text=array(
                'info'=>'Berhasil Update Data'
            );
            echo json_encode($text);
            // $text=array(
            //     'info'=>'Mahasiswa telah terdaftar'
            // );
            // echo json_encode($text);
        }else{
            $prodi=$this->Master_model->master_get(['id_prodi'=>$id_prodi],'dikti_prodi');
            $data=array(
                'nim'=>$nim,
                'id_mahasiswa'=>$id_mahasiswa,
                'id_periode_masuk'=>$id_periode,
                'kode_prodi'=>$prodi->kode_program_studi,
                'nama'=>$nama_mahasiswa,
                'status_mahasiswa'=>$nama_status_mahasiswa,
                'id_registrasi_mahasiswa'=>$id_registrasi_mahasiswa,
            );

            $this->Master_model->insert_query('mahasiswa',$data);
            $this->Master_model->insert_history('insert','mahasiswa',json_encode($data));

            $biodata = $this->f_GetBiodataMahasiswa($id_mahasiswa);
            $data_bio=array(
                'nim'=>$nim,
                'jenis_kelamin'=>$biodata[0]->jenis_kelamin,
                'tempat_lahir'=>$biodata[0]->tempat_lahir,
                'tanggal_lahir'=>$biodata[0]->tanggal_lahir,
                'id_agama'=>$biodata[0]->id_agama,
                'nik'=>$biodata[0]->nik,
                'nisn'=>$biodata[0]->nisn,
                'npwp'=>$biodata[0]->npwp,
                'id_negara'=>$biodata[0]->id_negara,
                'kewarganegaraan'=>$biodata[0]->kewarganegaraan,
                'alamat'=>$biodata[0]->dusun,
                'kelurahan'=>$biodata[0]->kelurahan,
                'kode_pos'=>$biodata[0]->kode_pos,
                'id_wilayah'=>$biodata[0]->id_wilayah,
                'id_jenis_tinggal'=>$biodata[0]->id_jenis_tinggal,
                'id_alat_transportasi'=>$biodata[0]->id_alat_transportasi,
                'telepon'=>$biodata[0]->telepon,
                'handphone'=>$biodata[0]->handphone,
                'email'=>$biodata[0]->email,
                'penerima_kps'=>$biodata[0]->penerima_kps,
                'no_kps'=>$biodata[0]->nomor_kps,
                'nik_ayah'=>$biodata[0]->nik_ayah,
                'nama_ayah'=>$biodata[0]->nama_ayah,
                'tanggal_lahir_ayah'=>$biodata[0]->tanggal_lahir_ayah,
                'id_jenjang_pendidikan_ayah'=>$biodata[0]->id_pendidikan_ayah,
                'id_pekerjaan_ayah'=>$biodata[0]->id_pekerjaan_ayah,
                'id_penghasilan_ayah'=>$biodata[0]->id_penghasilan_ayah,
                'nik_ibu'=>$biodata[0]->nik_ibu,
                'nama_ibu_kandung'=>$biodata[0]->nama_ibu,
                'tanggal_lahir_ibu'=>$biodata[0]->tanggal_lahir_ibu,
                'id_jenjang_pendidikan_ibu'=>$biodata[0]->id_pendidikan_ibu,
                'id_pekerjaan_ibu'=>$biodata[0]->id_pekerjaan_ibu,
                'id_penghasilan_ibu'=>$biodata[0]->id_penghasilan_ibu,
                'nama_wali'=>$biodata[0]->nama_wali,
                'tanggal_lahir_wali'=>$biodata[0]->tanggal_lahir_wali,
                'id_jenjang_pendidikan_ibu'=>$biodata[0]->id_pendidikan_wali,
                'id_pekerjaan_wali'=>$biodata[0]->id_pekerjaan_wali,
                'id_penghasilan_wali'=>$biodata[0]->id_penghasilan_wali,
                'id_kebutuhan_khusus_mahasiswa'=>$biodata[0]->id_kebutuhan_khusus_mahasiswa,
                'id_kebutuhan_khusus_ayah'=>$biodata[0]->id_kebutuhan_khusus_ayah,
                'id_kebutuhan_khusus_ibu'=>$biodata[0]->id_kebutuhan_khusus_ibu,
            );
            $this->Master_model->insert_query('mahasiswa_profile',$data_bio);
            $this->Master_model->insert_history('insert','mahasiswa_profile',json_encode($data));

            $data = array(
                'username' => $nim,
                'password' => md5($nim),
                'role' => "mhs",
            );
            $this->Master_model->insert_query('user',$data);

            $text=array(
                'info'=>'Berhasil Menyimpan data'
            );
            echo json_encode($text);
        }
    }


    public function f_GetRiwayatNilaiMahasiswa_check(){
        $id_registrasi_mahasiswa=$this->input->post('id_registrasi_mahasiswa',TRUE);
        $nama_mata_kuliah=$this->input->post('nama_mata_kuliah',TRUE);
        $id_matkul=$this->input->post('id_matkul',TRUE);
        $id_periode=$this->input->post('id_periode',TRUE);
        $id_matkul=$this->input->post('id_matkul',TRUE);
        $id_kelas=$this->input->post('id_kelas',TRUE);
        $nilai_angka=$this->input->post('nilai_angka',TRUE);
        $nilai_huruf=$this->input->post('nilai_huruf',TRUE);

        $mahasiswa=$this->Master_model->master_get(['id_registrasi_mahasiswa'=>$id_registrasi_mahasiswa,'id_matkul'=>$id_matkul,'periode'=>$id_periode],'frs_mhs_mk');
        if($mahasiswa){

            $data=array(
                'id_kelas'=>$id_kelas,
                'feeder_update_nilai'=>'sudah',
                'feeder_nilai'=>$nilai_angka,
                'feeder_nilai_huruf'=>$nilai_huruf,
                'status_feeder'=>'terdaftar',
            );
            $this->Master_model->update_query(['id_trx'=>$mahasiswa->id_trx], $data, 'frs_mhs_mk');
            $this->Master_model->insert_history('update','frs_mhs_mk',json_encode($mahasiswa));
            $text=array(
                'info'=>'TRX Telah Terdaftar'
            );
            echo json_encode($text);
        }else{
            $data=array(
                'periode'=>$id_periode,
                'id_matkul'=>$id_matkul,
                'id_registrasi_mahasiswa'=>$id_registrasi_mahasiswa,
                'id_kelas'=>$id_kelas,
                'nilai_angka'=>$nilai_angka,
                'nilai_huruf'=>$nilai_huruf,
                'status_frs'=>'setujui',
                'status_feeder'=>'terdaftar',
            );

            $this->Master_model->insert_query('frs_mhs_mk',$data);
            $this->Master_model->insert_history('insert','frs_mhs_mk',json_encode($data));

          
            $text=array(
                'info'=>'Berhasil Menyimpan data'
            );
            echo json_encode($text);
        }
    }

    public function f_GetListDosen_check(){
        $id_dosen=$this->input->post('id_dosen',TRUE);
        $nidn=$this->input->post('nidn',TRUE);
        $nama_dosen=$this->input->post('nama_dosen',TRUE);
        $nip=$this->input->post('nip',TRUE);

        $mahasiswa=$this->Master_model->master_get(['id_dosen'=>$id_dosen],'pegawai');
        if($mahasiswa){
            $text=array(
                'info'=>'Dosen telah terdaftar'
            );
            echo json_encode($text);
        }else{

            $biodata = $this->f_Getalldatadosen($id_dosen);
            if($biodata){
                $prodi=$this->Master_model->master_get(['id_prodi'=>$biodata[0]->id_prodi],'dikti_prodi');
                $data=array(
                    'nip'=>$nip,
                    'nidn'=>$nidn,
                    'nama'=>$nama_dosen,
                    'id_dosen'=>$id_dosen,
                    'status_pegawai'=>'dosen_tetap',
                    'homebase'=>$prodi->kode_program_studi,
                );

                $this->Master_model->insert_query('pegawai',$data);
                $this->Master_model->insert_history('insert','pegawai',json_encode($data));


                $text=array(
                    'info'=>'Berhasil Menyimpan data'
                );
                echo json_encode($text);
    
            }else{
                $text=array(
                    'info'=>'Dosen telah terdaftar'
                );
                echo json_encode($text);
            }

           

            // $this->Master_model->insert_query('mahasiswa',$data);
            // $this->Master_model->insert_history('insert','mahasiswa',json_encode($data));


            // $text=array(
            //     'info'=>'Berhasil Menyimpan data'
            // );
            // echo json_encode($text);
        }
    }



	public function prodi()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->prodi();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

	public function matakuliah_kurikulum()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->matakuliah_kurikulum();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

	public function matakuliah()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->matakuliah();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

	public function dosen()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->dosen();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

	public function mahasiswa()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->mahasiswa();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

    

    public function transportasi()
	{
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->transportasi();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
		
    }

	public function connector()
	{
        $this->load->model('form/Feeder_f', 'feeder_form');

        $data_master=$this->feeder_form->connector();
        $data_masters=get_object_vars($this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt'));

		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>$data_masters,
                'status'=>'update',
            ]
        );
		$this->footer();
		
    }
    
    public function json_GetNilaiTransferPendidikanMahasiswa_list()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_GetNilaiTransferPendidikanMahasiswa_list();
    }

    public function json_prodi()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_prodi',[]);
    }

    public function json_mahasiswa()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('mahasiswa',[]);
    }

    public function json_agama()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_agama',[]);
    }
    

    public function json_mahasiswa_riwayat_pendidikan()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('mahasiswa_riwayat_pendidikan',[]);
    }

    public function json_jalurmasuk()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_jalur_masuk',[]);
    }

    public function json_jalurkeluar()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_jenis_keluar',[]);
    }

    

    public function json_jenispendaftaran()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_jenis_pendaftaran',[]);
    }

    
    public function json_jenistinggal()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_jenis_tinggal',[]);
    }


        public function json_jenjangpendidikan()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_jenjang_pendidikan',[]);
    }

    // public function json_jenjangpendidikan()
    // {
    //     $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
    //     header('Content-Type: application/json');
    //     echo $this->Feeder_dt->json_master('dikti_jenjang_pendidikan',[]);
    // }


    public function json_pekerjaan()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_pekerjaan',[]);
    }

    

    public function json_pembiayaan()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_pembiayaan',[]);
    }



    public function json_penghasilan()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_penghasilan',[]);
    }

    

    public function json_wilayah()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_wilayah',[]);
    }

    

    public function json_tahunajaran()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_tahun_ajaran',[]);
    }

    

    public function json_statusmahasiswa()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_status_mahasiswa',[]);
    }

    

    public function json_statusaktif()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_status_aktif',[]);
    }

    

    public function json_semester()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_semester',[]);
    }

    

    public function json_sdm()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('dikti_sdm',[]);
    }

    public function json_riwayatnilai()
    {
        $this->load->model('datatable/Feeder_dt', 'Feeder_dt');
        
        header('Content-Type: application/json');
        echo $this->Feeder_dt->json_master('v_frs',['periode'=>$this->session->userdata('set_periode')['periode']]);
    }

    public function json_kurikulum()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_kurikulum();
    }

    public function json_matakuliah_kurikulum()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_matakuliah_kurikulum();
    }

    public function json_matakuliah()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_matakuliah();
    }

    public function json_kelas_perkuliahan()
    {
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_kelas_perkuliahan();
    }

    public function set_periode(){
        $this->load->model('form/Feeder_f', 'feeder_form');
        $data_master=$this->feeder_form->set_periode();

		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>null,
                'status'=>null,
            ]
        );
		$this->footer();
        
    }

    public function set_periode_action(){
        $this->form_validation->set_rules('id_periode', 'id_periode', 'trim|required|xss_clean');
        if(($this->form_validation->run() == TRUE)){
            $id_periode=$this->input->post('id_periode',TRUE);
            $this->session->set_userdata(
                array(
                    'set_periode' => array(
                        'periode'=>$id_periode,	
                    )
                )
            );
            $text = $this->alert->success('Periode Set');
            $this->session->set_flashdata('message', $text);
            redirect('admin/feeder/set_periode', 'refresh');
        }else{
            $text = $this->alert->danger('Error');
            $this->session->set_flashdata('message', $text);
            redirect('admin/feeder/set_periode', 'refresh');
        }
    }

    public function f_InsertPesertaKelasKuliah(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;
        $this->load->model('Baak_model');
        $InsertPesertaKelasKuliah=$this->Baak_model->InsertPesertaKelasKuliah();
        foreach($InsertPesertaKelasKuliah as $row){
            $rows=array(
                'id_kelas_kuliah'=>$row->id_kelas_feeder,
                'id_registrasi_mahasiswa'=>$row->id_registrasi_mahasiswa,
              );
              $payload = [
                'act' => 'InsertPesertaKelasKuliah',
                'token' => $data_pt->token,
                'record' => $rows
            ];
            $data = json_encode($payload);
            $data_feeder=$this->feeder_lib->send_ws($data,$url);
            if($data_feeder['error_code']==0){ 
                $fetchFeederData = $data_feeder['data'];
                $this->Master_model->update_query(['id_trx'=>$row->id_trx], 
                [
                    'id_kelas'=>$fetchFeederData->id_kelas_kuliah,
                    'status_feeder'=>'terdaftar',
                    'feeder_info'=>'InsertPesertaKelasKuliah : success input'
                ], 
                'frs_mhs_mk');
            }else{
                $this->Master_model->update_query(['id_trx'=>$row->id_trx], ['feeder_info'=>'InsertPesertaKelasKuliah : '.$data_feeder['error_desc']], 'frs_mhs_mk');

                    
            } 
            // die();

        }
            $text = $this->alert->success('please Cek Feeder');
            $this->session->set_flashdata('message', $text);
            redirect('admin/feeder/push_kelas_perkuliahan', 'refresh');
    }

    public function f_InsertDosenPengajarKelasKuliah(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;
        $this->load->model('Baak_model');
        $DosenPengajarKelasKuliah=$this->Baak_model->DosenPengajarKelasKuliah();
        // print_r($DosenPengajarKelasKuliah);die();
        foreach($DosenPengajarKelasKuliah as $row){
            $rows=array(
                'id_registrasi_dosen'=>$row->id_registrasi_dosen,
                'id_kelas_kuliah'=>$row->id_kelas_feeder,
                'sks_substansi_total'=>$row->sks_mata_kuliah,
                'rencana_minggu_pertemuan'=>14,
                'realisasi_minggu_pertemuan'=>14,
                'id_jenis_evaluasi'=>1,
              );
              $payload = [
                'act' => 'InsertDosenPengajarKelasKuliah',
                'token' => $data_pt->token,
                'record' => $rows
            ];
            $data = json_encode($payload);
            $data_feeder=$this->feeder_lib->send_ws($data,$url);

            if($data_feeder['error_code']==0){ 
                $fetchFeederData = $data_feeder['data'];
                $this->Master_model->update_query(['id_trx_jadwal'=>$row->id_trx_jadwal], ['id_aktivitas_mengajar'=>$fetchFeederData->id_aktivitas_mengajar,'feeder_info'=>'InsertDosenPengajarKelasKuliah : success input'], 'mata_kuliah_jadwal');
            }else{
                $this->Master_model->update_query(['id_trx_jadwal'=>$row->id_trx_jadwal], ['feeder_info'=>'InsertDosenPengajarKelasKuliah : '.$data_feeder['error_desc']], 'mata_kuliah_jadwal');

                    
            } 

            // print_r($kelas_perkuliahan);
            // die();

        }

        $text = $this->alert->success('please Cek Feeder');
            $this->session->set_flashdata('message', $text);
            redirect('admin/feeder/push_kelas_perkuliahan', 'refresh');

    }
    
    public function f_InsertKelasKuliah(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;
        $this->load->model('Baak_model');
        $kelas_perkuliahan=$this->Baak_model->kelas_perkuliahan();
        foreach($kelas_perkuliahan as $row){
            $rows=array(
                'id_prodi'=>$row->id_prodi,
                'id_semester'=>$row->periode,
                'id_matkul'=>$row->id_matkul,
                'nama_kelas_kuliah'=>'0'.$row->sks_mata_kuliah,
              );
              $payload = [
                'act' => 'InsertKelasKuliah',
                'token' => $data_pt->token,
                'record' => $rows
            ];

            $data = json_encode($payload);
            $data_feeder=$this->feeder_lib->send_ws($data,$url);
            // print_r($rows);
            // print_r($data_feeder);
            if($data_feeder['error_code']==0){ 
                $fetchFeederData = $data_feeder['data'];
                $this->Master_model->update_query(['id_trx_jadwal'=>$row->id_trx_jadwal], ['id_kelas_feeder'=>$fetchFeederData->id_kelas_kuliah,'feeder_info'=>'InsertKelasKuliah : success input'], 'mata_kuliah_jadwal');
            }else{
                // $data_feeder['error_desc']

                $this->Master_model->update_query(['id_trx_jadwal'=>$row->id_trx_jadwal], ['feeder_info'=>'InsertKelasKuliah : '.$data_feeder['error_desc']], 'mata_kuliah_jadwal');
                    
            }
        }

        $text = $this->alert->success('please Cek Feeder');
        $this->session->set_flashdata('message', $text);
        redirect('admin/feeder/push_kelas_perkuliahan', 'refresh');

       
    }

    public function f_GetRiwayatNilaiMahasiswa_update(){
        if($this->session->userdata('set_periode')['periode']){
            $this->load->model('Baak_model');
            $this->Master_model->trans_start();
            $this->Baak_model->f_GetRiwayatNilaiMahasiswa_history();
            $this->Baak_model->f_GetRiwayatNilaiMahasiswa_update();
            $this->Master_model->trans_finish();
            $text = $this->alert->success('success update nilai');
            $this->session->set_flashdata('message', $text);
            redirect('admin/feeder/riwayatnilai', 'refresh');
            
        }else{
            $text = $this->alert->danger('Select Periode');
            $this->session->set_flashdata('message', $text);
            redirect('admin/feeder/set_periode', 'refresh');
        }
    }

    public function push_kelas_perkuliahan(){
        if($this->session->userdata('set_periode')['periode']){
            $this->load->model('tabel/Feeder_t', 'feeder_tabel');
            $data_master=$this->feeder_tabel->kelas_perkuliahan();

            //print_r($data_master);
            $this->header();
            $this->load->view('master/master_list',
                [
                    'data_detail'=>$data_master['data_detail'],
                    'data_isi'=>$data_master['data_isi'],
                ]
            );
            $this->footer();
        }else{
            $text = $this->alert->danger('Select Periode');
            $this->session->set_flashdata('message', $text);
            redirect('admin/feeder/set_periode', 'refresh');
        }
    }

    public function f_GetNilaiTransferPendidikanMahasiswa_list(){
        $this->load->model('tabel/Feeder_t', 'feeder_tabel');
        $data_master=$this->feeder_tabel->f_GetNilaiTransferPendidikanMahasiswa_list();

        //print_r($data_master);
        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
		$this->footer();
    }

    public function f_GetNilaiTransferPendidikanMahasiswa(){
        if($this->session->userdata('set_periode')['periode']){
            $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
            $deskripsi = $this->feeder_lib->deskripsi($data_pt);
            $data=$deskripsi['data_pt'];
            $url=$deskripsi['url'];
            $kode_pt=$data_pt->username;
    
            $data = ['act'=>'GetNilaiTransferPendidikanMahasiswa', 'filter'=>"id_periode_masuk='".$this->session->userdata('set_periode')['periode']."'", 'token'=>$data->token];
            $data = json_encode($data);
            $data_feeder=$this->feeder_lib->send_ws($data,$url);

            if($data_feeder['error_code']==0){ 
                $count=0;
               foreach($data_feeder['data'] as $row){
                $data_transfer=$this->Master_model->master_get(['id_transfer'=>$row->id_transfer],'frs_mhs_mk');

                if(!$data_transfer){
                    $data = [
                        'periode'=>$row->id_periode_masuk,
                        'id_matkul'=>$row->id_matkul,
                        'id_registrasi_mahasiswa'=>$row->id_registrasi_mahasiswa,
                        'feeder_update_nilai'=>'sudah',
                        'nilai_huruf'=>$row->nilai_huruf_diakui,
                        'status_frs'=>'setujui',
                        'transfer'=>'ya',
                        'id_transfer'=>$row->id_transfer,
                    ];
                    $this->Master_model->insert_query('frs_mhs_mk',$data);
                    $count++;
                }

                   
               }
    
                $text = $this->alert->success('Data Succes ful get. Total data : '.$count);
                $this->session->set_flashdata('message', $text);
                redirect('/admin/feeder/f_GetNilaiTransferPendidikanMahasiswa_list', 'refresh');
    
            }else{
    
                $text = $this->alert->danger('Failed, error : '.$data_feeder['error_desc']);
                $this->session->set_flashdata('message', $text);
                redirect('/admin/feeder/f_GetNilaiTransferPendidikanMahasiswa_list', 'refresh');
                    
            }      
        }else{
            $text = $this->alert->danger('Select Periode');
            $this->session->set_flashdata('message', $text);
            redirect('admin/feeder/set_periode', 'refresh');
        }
    }

    public function f_UpdateNilaiPerkuliahanKelas(){
        $data_pt=$this->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        $deskripsi = $this->feeder_lib->deskripsi($data_pt);
        $data=$deskripsi['data_pt'];
        $url=$deskripsi['url'];
        $kode_pt=$data_pt->username;
        $this->load->model('Baak_model');
        $kelas_perkuliahan=$this->Baak_model->v_frs_index($this->session->userdata('set_periode')['periode']);
        $count=0;
        $count_push=0;
        $count_null=0;
        foreach($kelas_perkuliahan as $row){
            $count++;
                $payload = [
                    'act' => 'UpdateNilaiPerkuliahanKelas',
                    'token' => $data_pt->token,
                    'key' => array(
                    'id_registrasi_mahasiswa'=>$row->id_registrasi_mahasiswa,
                    'id_kelas_kuliah'=>$row->id_kelas_kuliah_feeder,
                    ),
                    'record' => array(
                    'nilai_angka'=>$row->nilai_angka,
                    'nilai_huruf'=>$row->nilai_huruf,
                    'nilai_indeks'=>$row->nilai_index,
                    )
                ];
                // print_r($payload);die();
                $data = json_encode($payload);
                $data_feeder=$this->feeder_lib->send_ws($data,$url);
                if($data_feeder['error_code']==0){ 
                    // $fetchFeederData = $data_feeder['data'];
                    $this->Master_model->update_query(['id_trx'=>$row->id_trx], ['feeder_update_nilai'=>'sudah','feeder_info'=>'UpdateNilaiPerkuliahanKelas : success update nilai'], 'frs_mhs_mk');
                    $count_push++;
                }else{
                    $this->Master_model->update_query(['id_trx'=>$row->id_trx], ['feeder_update_nilai'=>'belum','feeder_info'=>'UpdateNilaiPerkuliahanKelas : '.$data_feeder['error_desc']], 'frs_mhs_mk');
                    $count_null++;
                }
                
          
           
        }
            $text = $this->alert->success('please Cek Feeder, Info all data : '.$count.', Success : '.$count_push.', Gagal : '.$count_null);
            $this->session->set_flashdata('message', $text);
            redirect('admin/feeder/push_kelas_perkuliahan', 'refresh');
  
        $encodedData = json_encode($payload);
        $feederData = $this->feeder_lib->send_ws_retrun($encodedData,$url);
    }

}
