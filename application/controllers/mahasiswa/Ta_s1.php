<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ta_s1 extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
		$this->load->model('Baak_model');
        $this->load->model('form/Baak_f', 'baak_form');
        $this->load->model('Mahasiswa_model');

        $this->url=url_siku;
		$this->key=key_siku;

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('mahasiswa_ta_s1',$level,$action);
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

    public function index(){
        $v_mahasiswa=$this->Master_model->master_get(['nim'=>$this->session->userdata('username')],'v_mahasiswa');
        if($v_mahasiswa->nama_jenjang_pendidikan != 'S1'){
            $text = $this->alert->danger('You do not have access');
			$this->session->set_flashdata('message', $text);
			redirect("welcome/dashboard");
        }
        $this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->list_periode_s1();

            //print_r($data_master);
            $this->header();
            
            $this->load->view('master/master_list',
                [
                    'data_detail'=>$data_master['data_detail'],
                    'data_isi'=>$data_master['data_isi'],
                ]
            );
            //$this->load->view('baak/mahasiswa_filter');
            $this->footer();
	}

    public function json_list_periode_s1(){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_periode_s1_mhs();
    }

    public function daftar($periode){
        $rule_date=$this->Master_model->master_get(['periode'=>$periode],'ta_s1_list');
       
        $start = strtotime($rule_date->buka_daftar);
        $close = strtotime($rule_date->tutup_daftar);
        $now = strtotime(date('Y-m-d'));
                if($start < $now and $now <$close and $rule_date->status=='open' ){
                }else{
                    $text = $this->alert->warning('registration has closed');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/");
                }
        
        $rules=$this->Master_model->master_result(['periode'=>$periode],'ta_s1_rule');
        if($rules){
            $rule=$this->Master_model->master_result(['periode'=>$periode,'nim'=>$this->session->userdata('username')],'ta_s1_mhs_rule');
            if(!$rule){
                $text = $this->alert->warning('anda belum melakukan pembayaran');
                $this->session->set_flashdata('message', $text);
                redirect("mahasiswa/ta_s1/cek_rule/".$periode);
            }
        }

        $this->load->model('form/Mhs_f', 'mahasiswa_form');

        $data_master=$this->mahasiswa_form->daftar_ta_s1($periode);

		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'status'=>null,
            ]
        );
		$this->footer();
    }

    public function daftar_ta_s1_action($periode){
        // $nama_pt = $this->input->post('nama_pt');
        $this->form_validation->set_rules('judul','judul','trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		if (($this->form_validation->run() == TRUE)   ) {
            $data_masters=($this->Master_model->master_get(['periode' => $periode,'nim' => $this->session->userdata('username')],'ta_s1_mhs_list'));
            if($data_masters){
                $text = $this->alert->warning('you have registered in : '.$data_masters->judul);
                $this->session->set_flashdata('message', $text);
                redirect(site_url('mahasiswa/ta_s1/'));
            }

            $data=array(
                'periode'=>$periode,
                'judul'=>$this->input->post('judul'),
                'nim'=>$this->session->userdata('username'),
            );
            $this->Master_model->insert_query('ta_s1_mhs_list',$data);

            $text = $this->alert->success('saved successfully, registered in : '.$this->input->post('nama_pt'));
            $this->session->set_flashdata('message', $text);
            redirect(site_url('mahasiswa/ta_s1/'));

        }else{
            $this->daftar($periode);
        }
        
    }

    public function cek_rule($periode){
        $rule=$this->Master_model->master_result(['periode'=>$periode],'ta_s1_rule');
        if($rule){
            foreach($rule as $row){
                $this->output->set_header('Access-Control-Allow-Origin: *');
                
                $url =$this->url.'api/cek_rule';
                $data = array('key' => $this->key, 'id_rule' => $row['id_rule'],'nim'=>$this->session->userdata('username') );
                $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data)
                    )
                );
                                
                $context  = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                $result = json_decode($result);
                if($result->status_code=='000'){
                    $data=$result->data;
                    if($data->status_bayar=='sudah'){
                        $data = array(
                            'periode' => $periode,
                            'nim' => $this->session->userdata('username'),
                        );
                        $this->Master_model->insert_query('ta_s1_mhs_rule',$data);

                        $text = $this->alert->success('rule ok');
                        $this->session->set_flashdata('message', $text);
                        redirect("mahasiswa/ta_s1/daftar/".$periode);
                    }
                }
                
            }
            $text = $this->alert->warning('anda belum melakukan pembayaran');
                        $this->session->set_flashdata('message', $text);
                        redirect("mahasiswa/ta_s1/");
        }

        $text = $this->alert->success('rule ok');
                        $this->session->set_flashdata('message', $text);
                        redirect("mahasiswa/ta_s1/daftar/".$periode);
      
    }

    public function dashboard($periode){
        $data_masters=($this->Master_model->master_get(['nim' => $this->session->userdata('username')],'v_ta_s1_mhs_list'));
        // $data_masters=($this->Master_model->master_get(['periode' => $periode,'nim' => $this->session->userdata('username')],'v_ta_s1_mhs_list'));
        if($data_masters){
           
            $this->load->model('Baak_model');
            $nim = $this->session->userdata('username');

            $jadwal_sidang=($this->Mahasiswa_model->jadwal_sidang_ta_s1($periode,$data_masters->kode_prodi));
            $jadwal_yudisium=($this->Mahasiswa_model->jadwal_yudisium($periode,$data_masters->kode_prodi));
            $history_sidang=$this->Master_model->master_result(['nim'=>$this->session->userdata('username')],'v_ta_s1_mhs_sidang');
            $history_bimbingan=$this->Master_model->master_result(['nim'=>$this->session->userdata('username')],'history_bimbingan');
            $yudisium_mhs=($this->Master_model->master_get(['nim' => $this->session->userdata('username')],'yudisium_mhs'));
            // var_dump($info_akademik);
            // die;
            //print_r($kurikulum[0]);
            $this->header();
            $this->load->view('mahasiswa/ta_s1/dashboard',
                [
                    'data_masters'=>$data_masters,
                    'jadwal_sidang'=>$jadwal_sidang,
                    'jadwal_yudisium'=>$jadwal_yudisium,
                    'yudisium_mhs'=>$yudisium_mhs,
                    'history_bimbingan'=>$history_bimbingan,
                    'history_sidang'=>$history_sidang
                ]
            );
            $this->footer();
        }else{
            $text = $this->alert->warning('you not registered');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('mahasiswa/ta_s1/'));
        }
    }

    public function pendaftar_sidang_ta_s1($id_trx){
        $rule_date=$this->Master_model->master_get(['id_trx'=>$id_trx],'ta_s1_jadwal_sidang');
        if(!$rule_date){
            $text = $this->alert->warning('schedule not found');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/"); 
        }
        $start = strtotime($rule_date->buka_daftar);
        $close = strtotime($rule_date->tutup_daftar);
        $now = strtotime(date('Y-m-d'));

                if($start < $now and $now <$close  ){
                }else{
                    $text = $this->alert->warning('registration has closed');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/");
                }
        $cek_rule_byid=$this->Master_model->master_get(['nim'=>$this->session->userdata('username'),'id_rule'=>$rule_date->id_rule],'ta_s1_mhs_rule');
        if(!$cek_rule_byid){
            $this->cek_rule_byid($rule_date->periode,$rule_date->id_rule,'mahasiswa/ta_s1/dashboard/'.$rule_date->periode);
        }
            
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        
        $historisidang=($this->Master_model->master_get(['id_sidang'=>$id_trx,'nim'=>$this->session->userdata('username')],'ta_s1_mhs_sidang'));
        $data_master=$this->mahasiswa_form->pendaftar_sidang_ta_s1($id_trx,$rule_date);
            
        $this->header();
        if($historisidang){
            $historisidang=get_object_vars($historisidang);
            $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>$historisidang,
                'status'=>'update',
            ]
        );
        }else{
            $historisidang=get_object_vars($this->Master_model->master_get(['periode'=>$rule_date->periode,'nim'=>$this->session->userdata('username')],'ta_s1_mhs_list'));
            $historisidang['berkas']='';
            $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>$historisidang,
                'status'=>'update',
            ]
        );
        }
        
		$this->footer();
    }

    public function pendaftar_sidang_ta_s1_action($id_trx){
        $rule_date=$this->Master_model->master_get(['id_trx'=>$id_trx],'ta_s1_jadwal_sidang');
        if(!$rule_date){
            $text = $this->alert->warning('schedule not found');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/"); 
        }
        $ta_s1_mhs_list=$this->Master_model->master_get(['periode'=>$rule_date->periode,'nim'=>$this->session->userdata('username')],'ta_s1_mhs_list');

        if(!$ta_s1_mhs_list){
            $text = $this->alert->warning('id trx registration not found');
            $this->session->set_flashdata('message', $text);
            redirect("mahasiswa/ta_s1/"); 
        }

        if($rule_date->sidang=='proposal'){
            if(!in_array($ta_s1_mhs_list->progres,['bimbingan','daftar sidang proposal']) ){
                $text = $this->alert->warning('You do not have access. you progres : '.$ta_s1_mhs_list->progres);
                $this->session->set_flashdata('message', $text);
                redirect("mahasiswa/ta_s1/dashboard/".$ta_s1_mhs_list->periode); 
            }
        }elseif($rule_date->sidang=='hasil'){
            if(!in_array($ta_s1_mhs_list->progres,['daftar sidang hasil','penilaian sidang proposal']) ){
                $text = $this->alert->warning('You do not have access. you progres : '.$ta_s1_mhs_list->progres);
                $this->session->set_flashdata('message', $text);
                redirect("mahasiswa/ta_s1/dashboard/".$ta_s1_mhs_list->periode); 
            }
        }elseif($rule_date->sidang=='ta'){
            if(!in_array($ta_s1_mhs_list->progres,['daftar sidang TA','penilaian sidang hasil']) ){
                $text = $this->alert->warning('You do not have access. you progres : '.$ta_s1_mhs_list->progres);
                $this->session->set_flashdata('message', $text);
                redirect("mahasiswa/ta_s1/dashboard/".$ta_s1_mhs_list->periode); 
            }
        }

        $this->form_validation->set_rules('judul','judul','trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		if (($this->form_validation->run() == TRUE)   ) {
            $config['upload_path']          = './assets/berkas/ta/';
            $config['allowed_types']        = 'pdf';
            $new_name = time().'_'.$this->session->userdata('username').'_ta.pdf';
		    $config['file_name'] = $new_name;

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('berkas'))
            {
                $text = $this->alert->danger('Data failed Added. Info :'.$this->upload->display_errors());
                    $this->session->set_flashdata('message', $text);
                    return redirect("mahasiswa/ta_s1/pendaftar_sidang_ta_s1/".$id_trx);
            }
            else
            {

                $ta_s1_mhs_sidang=$this->Master_model->master_get(['id_sidang'=>$id_trx,'periode'=>$rule_date->periode,'nim'=>$this->session->userdata('username')],'ta_s1_mhs_sidang');
                if($ta_s1_mhs_sidang){
                    $this->Master_model->insert_history('update','ta_s1_mhs_sidang',json_encode($ta_s1_mhs_sidang));

                    $nama_berkas = $this->upload->data("file_name");
                    $data=array(
                        
                        'judul'=>$this->input->post('judul'),
                        'berkas'=>$nama_berkas,
                        'tgl_berkas'=>(date('Y-m-d H:i:s')),
                    );
                    if($ta_s1_mhs_sidang->progres=='ditolak'){
                        $data['progres']='daftar';
                    }

                    $this->Master_model->update_query(['id_sidang'=>$ta_s1_mhs_sidang->id_trx,'periode'=>$rule_date->periode,'nim'=>$this->session->userdata('username')], $data, 'ta_s1_mhs_sidang');

                }else{
                    

                    $nama_berkas = $this->upload->data("file_name");
                    $data=array(
                        'nim'=>$this->session->userdata('username'),
                        'periode'=>$rule_date->periode,
                        'judul'=>$this->input->post('judul'),
                        'berkas'=>$nama_berkas,
                        'id_sidang'=>$id_trx,
                        'tgl_berkas'=>(date('Y-m-d H:i:s')),
                        'sidang'=>$rule_date->sidang,
                        'id_list'=>$ta_s1_mhs_list->id_trx,
                    );
                    $this->Master_model->insert_query('ta_s1_mhs_sidang',$data);
                }

                    $data=array(
                        
                        'progres'=>'daftar sidang '.$rule_date->sidang,
                        'judul'=>$this->input->post('judul'),
                    );

                    $this->Master_model->update_query(['periode'=>$rule_date->periode,'nim'=>$this->session->userdata('username')], $data, 'ta_s1_mhs_list');

                $text = $this->alert->success('registration was update');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/dashboard/".$ta_s1_mhs_list->periode); 
            }
        }else{
            $this->pendaftar_sidang_ta_s1($id_trx);
        }

    }

    public function pendaftar_yudisium_ta_s1($id_trx){
        $rule_date=$this->Master_model->master_get(['id'=>$id_trx],'yudisium');
        if(!$rule_date){
            $text = $this->alert->warning('schedule not found');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/"); 
        }
        $close = strtotime($rule_date->tanggal_penutupan);
        $now = strtotime(date('Y-m-d'));

                if( $now <$close  ){
                }else{
                    $text = $this->alert->warning('registration has closed');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/");
                }
        
                $ta_s1_mhs_list=$this->Master_model->master_get(['periode'=>$rule_date->periode,'nim'=>$this->session->userdata('username')],'ta_s1_mhs_list');
                if(!$ta_s1_mhs_list){
                    $text = $this->alert->warning('id trx registration not found');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/"); 
                }
        
                if(!in_array($ta_s1_mhs_list->progres,['daftar sidang TA','penilaian sidang TA','daftar yudisium']) ){
                    $text = $this->alert->warning('You do not have access. you progres : '.$ta_s1_mhs_list->progres);
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/dashboard/".$ta_s1_mhs_list->periode); 
                }
            
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        
        $historisidang=($this->Master_model->master_get(['nim'=>$this->session->userdata('username')],'v_yudisium_mhs'));
        $data_master=$this->mahasiswa_form->pendaftar_yudisium_ta_s1($id_trx,$rule_date);
   
        $this->header();
        if($historisidang){
            $historisidang=get_object_vars($historisidang);
            $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>$historisidang,
                'status'=>'update',
            ]
        );
        }else{
            $historisidang=get_object_vars($this->Master_model->master_get(['periode'=>$rule_date->periode,'nim'=>$this->session->userdata('username')],'ta_s1_mhs_list'));
            $v_profile_mhs=get_object_vars($this->Master_model->master_get(['nim'=>$this->session->userdata('username')],'v_profile_mhs'));

            $historisidang['judul_indo']=$historisidang['judul'];
            $historisidang['judul_ing']='';
            $historisidang['berkas']='';
            $historisidang['nama']=$v_profile_mhs['nama'];
            $historisidang['tanggal_lahir']=$v_profile_mhs['tanggal_lahir'];
            $historisidang['tempat_lahir']=$v_profile_mhs['tempat_lahir'];
            $historisidang['handphone']=$v_profile_mhs['handphone'];
            $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>$historisidang,
                'status'=>'update',
            ]
        );
        }
        
		$this->footer();
    }

    
    public function pendaftar_yudisium_ta_s1_action($id_trx){
        $rule_date=$this->Master_model->master_get(['id'=>$id_trx],'yudisium');
        if(!$rule_date){
            $text = $this->alert->warning('schedule not found');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/"); 
        }
        $close = strtotime($rule_date->tanggal_penutupan);
        $now = strtotime(date('Y-m-d'));

                if( $now <$close  ){
                }else{
                    $text = $this->alert->warning('registration has closed');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/");
                }

        $ta_s1_mhs_list=$this->Master_model->master_get(['periode'=>$rule_date->periode,'nim'=>$this->session->userdata('username')],'ta_s1_mhs_list');
        if(!$ta_s1_mhs_list){
            $text = $this->alert->warning('id trx registration not found');
            $this->session->set_flashdata('message', $text);
            redirect("mahasiswa/ta_s1/"); 
        }

        if(!in_array($ta_s1_mhs_list->progres,['daftar sidang TA','penilaian sidang TA','daftar yudisium']) ){
            $text = $this->alert->warning('You do not have access. you progres : '.$ta_s1_mhs_list->progres);
            $this->session->set_flashdata('message', $text);
            redirect("mahasiswa/ta_s1/dashboard/".$ta_s1_mhs_list->periode); 
        }

        $this->form_validation->set_rules('judul_indo','judul_indo','trim|required|xss_clean');
        $this->form_validation->set_rules('judul_ing','judul_ing','trim|required|xss_clean');
        $this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
        $this->form_validation->set_rules('tanggal_lahir','tanggal_lahir','trim|required|xss_clean');
        $this->form_validation->set_rules('tempat_lahir','tempat_lahir','trim|required|xss_clean');
        $this->form_validation->set_rules('handphone','handphone','trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		if (($this->form_validation->run() == TRUE)   ) {

            $config['upload_path']          = './assets/berkas/yudisium/';
            $config['allowed_types']        = 'pdf';
            $new_name = time().'_'.$this->session->userdata('username').'_ta.pdf';
		    $config['file_name'] = $new_name;

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('berkas'))
            {
                $text = $this->alert->danger('Data failed Added. Info :'.$this->upload->display_errors());
                    $this->session->set_flashdata('message', $text);
                    return redirect("mahasiswa/ta_s1/pendaftar_yudisium_ta_s1/".$id_trx);
            }
            else
            {
                $yudisium_mhs=$this->Master_model->master_get(['id_yudisium'=>$id_trx,'periode'=>$rule_date->periode,'nim'=>$this->session->userdata('username')],'yudisium_mhs');
               

                if($yudisium_mhs){

                    if($yudisium_mhs->progres=='disetujui'){
                        $text = $this->alert->warning('You do not have access. you progres : '.$yudisium_mhs->progres);
                        $this->session->set_flashdata('message', $text);
                        redirect("mahasiswa/ta_s1/dashboard/".$ta_s1_mhs_list->periode); 
                    }

                    $this->Master_model->insert_history('update','yudisium_mhs',json_encode($yudisium_mhs));

                    $nama_berkas = $this->upload->data("file_name");
                    $data=array(
                        
                        'judul_indo'=>$this->input->post('judul_indo'),
                        'judul_ing'=>$this->input->post('judul_ing'),
                        'progres'=>'daftar',
                        'berkas'=>$nama_berkas,
                    );
                    $this->Master_model->update_query(['id_trx'=>$yudisium_mhs->id_trx], $data, 'yudisium_mhs');

                }else{

                    $nama_berkas = $this->upload->data("file_name");
                    $data=array(
                        'nim'=>$this->session->userdata('username'),
                        'periode'=>$rule_date->periode,
                        'judul_indo'=>$this->input->post('judul_indo'),
                        'judul_ing'=>$this->input->post('judul_ing'),
                        'berkas'=>$nama_berkas,
                        'id_yudisium'=>$id_trx,
                    );
                    $this->Master_model->insert_query('yudisium_mhs',$data);

                }

                $data_profile=array(
                    'tanggal_lahir'=>$this->input->post('tanggal_lahir'),
                    'tempat_lahir'=>$this->input->post('tempat_lahir'),
                    'handphone'=>$this->input->post('handphone'),
                );
                $this->Master_model->update_query(['nim'=>$this->session->userdata('username')], $data_profile, 'mahasiswa_profile');

                $data_profile=array(
                    'nama'=>$this->input->post('nama'),
                );
                $this->Master_model->update_query(['nim'=>$this->session->userdata('username')], $data_profile, 'mahasiswa');

                $data=array(
                        
                    'progres'=>'daftar yudisium',
                    'judul'=>$this->input->post('judul_indo'),
                );

                $this->Master_model->update_query(['periode'=>$rule_date->periode,'nim'=>$this->session->userdata('username')], $data, 'ta_s1_mhs_list');

                $text = $this->alert->success('registration was update');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/dashboard/".$ta_s1_mhs_list->periode); 



            }

        }else{
            $this->pendaftar_yudisium_ta_s1($id_trx);
        }

    }

    public function add_bimbingan_action($nim){
        $this->form_validation->set_rules('keterangan','keterangan','trim|required|xss_clean');
        if(($this->form_validation->run() == TRUE)){
            $new_name=null;
           
            if(!empty($_FILES['berkas']['name'])){
                $config['upload_path']          = './assets/berkas/history_bimbingan/';
                $config['allowed_types']        = 'pdf';
                $new_name = time().'_'.$this->session->userdata('username').'_bimbingan.pdf';
                $config['file_name'] = $new_name;
    
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('berkas'))
                {
                    $text = $this->alert->danger('Data failed Added. Info :'.$this->upload->display_errors());
                        $this->session->set_flashdata('message', $text);
                        return redirect("mahasiswa/ta_s1/add_bimbingan/".$nim);
                }
            }

                if($this->session->userdata('role')=='mhs'){
                    $data=array(
                        'nim'=>$nim,
                        'email_dosen'=>null,
                        'file'=>$new_name,
                        'keterangan'=>$this->input->post('keterangan',TRUE),
                        'user_create'=>$this->Master_model->user_cek_ident(),
                    );
                }else{
                    $data=array(
                        'nim'=>$nim,
                        'email_dosen'=>$this->session->userdata('username'),
                        'berkas'=>$new_name,
                        'keterangan'=>$this->input->post('keterangan',TRUE),
                        'user_create'=>$this->Master_model->user_cek_ident(),
                    );
                }
                $this->Master_model->insert_query('history_bimbingan',$data);

                $data_masters=($this->Master_model->master_get(['nim' => $nim],'v_ta_s1_mhs_list'));
                $text = $this->alert->success('History Bimbingan add');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/ta_s1/dashboard/".$data_masters->periode); 
            

        }else{
            $this->add_bimbingan($nim);
        }
    }

    public function add_bimbingan($nim){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');

        $data_master=$this->mahasiswa_form->add_bimbingan_s1($nim);

		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'status'=>null,
            ]
        );
		$this->footer();
    }

    public function cek_rule_byid($periode,$id_rule,$link){
        $this->output->set_header('Access-Control-Allow-Origin: *');
        
        $url =$this->url.'api/cek_rule';
        $data = array('key' => $this->key, 'id_rule' => $id_rule,'nim'=>$this->session->userdata('username') );
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
                        
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $result = json_decode($result);
        if($result->status_code=='000'){
            $data=$result->data;
            if($data->status_bayar=='sudah'){
                $data = array(
                    'periode' => $periode,
                    'id_rule' => $id_rule,
                    'nim' => $this->session->userdata('username'),
                );
                $this->Master_model->insert_query('ta_s1_mhs_rule',$data);

                return ok;
                // $text = $this->alert->success('rule ok');
                // $this->session->set_flashdata('message', $text);
                // redirect($link);
            }
        }
        
    
                $text = $this->alert->warning('anda belum melakukan pembayaran');
                $this->session->set_flashdata('message', $text);
                redirect($link);
    }

}