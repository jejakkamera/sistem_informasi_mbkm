<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisuda extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->model('Baak_model');

        $this->url=url_siku;
		$this->key=key_siku;
        $this->client_id =client_id;
        $this->secret_key =secret_key;
        $this->url_bni =url_bni;

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('mhs_wisuda',$level,$action);
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

	public function list_periode(){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->list_periode_wisuda();

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

    public function daftar($id_trx){
        $wisuda=$this->Master_model->master_get(['nim'=>$this->session->userdata('username')],'wisuda_mhs');
        if($wisuda){
            $text = $this->alert->warning('You was register : '.$wisuda->date_daftar);
            $this->session->set_flashdata('message', $text);
            redirect("mahasiswa/wisuda/list_periode");
        }   
        $rule_date=$this->Master_model->master_get(['id_trx'=>$id_trx],'wisuda_periode');
       
        $start = strtotime($rule_date->buka_daftar);
        $close = strtotime($rule_date->tutup_daftar);
        $now = strtotime(date('Y-m-d'));
                if($start < $now and $now <$close and $rule_date->status=='open' ){
                }else{
                    $text = $this->alert->warning('registration has closed');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/wisuda/list_periode");
                }

        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        
        $historisidang=get_object_vars($this->Master_model->master_get(['nim'=>$this->session->userdata('username')],'v_yudisium_mhs'));
        if(!$historisidang){
            $text = $this->alert->warning('you not registerd in : yudisium');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/wisuda/list_periode");
        }
        $data_master=$this->mahasiswa_form->daftar_wisuda($id_trx,$rule_date);

		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'data_master'=>$historisidang,
                'status'=>'update',
            ]
        );
		$this->footer();
    }

    public function json_list_periode_wisuda(){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_periode_wisuda_mhs();
    }

    public function pendaftar_yudisium_wisuda_action($id_trx){
        $rule_date=$this->Master_model->master_get(['id_trx'=>$id_trx],'wisuda_periode');
       
        $start = strtotime($rule_date->buka_daftar);
        $close = strtotime($rule_date->tutup_daftar);
        $now = strtotime(date('Y-m-d'));
                if($start < $now and $now <$close and $rule_date->status=='open' ){
                }else{
                    $text = $this->alert->warning('registration has closed');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/wisuda/list_periode");
                }

        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        
        $historisidang=get_object_vars($this->Master_model->master_get(['nim'=>$this->session->userdata('username')],'v_yudisium_mhs'));
        if(!$historisidang){
            $text = $this->alert->warning('you not registerd in : yudisium');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/wisuda/list_periode");
        }
        
        $this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		if (($this->form_validation->run() == TRUE)   ) {
            $config['upload_path']          = './assets/berkas/wisuda/';
            $config['allowed_types']        = 'jpg';
            $new_name = time().'_'.$this->session->userdata('username').'_ta.jpg';
		    $config['file_name'] = $new_name;

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('berkas'))
            {
                $text = $this->alert->danger('Data failed Added. Info :'.$this->upload->display_errors());
                    $this->session->set_flashdata('message', $text);
                    return redirect("mahasiswa/wisuda/daftar/".$id_trx);
            }
            else
            {
                $nama_berkas = $this->upload->data("file_name");
                $data=array(
                    'nim'=>$this->session->userdata('username'),
                    'nama'=>$this->input->post('nama'),
                    'berkas'=>$nama_berkas,
                    'id_wisuda'=>$id_trx,
                );
                $this->Master_model->insert_query('wisuda_mhs',$data);

                $text = $this->alert->success('registration was update');
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/wisuda/dashboard/".$id_trx); 
            }
        }else{
            $this->daftar($id_trx);
        }

    }

    public function dashboard($id_trx){
        $wisuda=$this->Master_model->master_get(['nim'=>$this->session->userdata('username')],'wisuda_mhs');
        if($wisuda){
            $wisuda_rule=$this->Master_model->master_result(['id_trx'=>$id_trx],'wisuda_rule');
            $this->header();
            $this->load->view('mahasiswa/wisuda/dashboard',
                [
                    'data_masters'=>$wisuda,
                    'wisuda_rule'=>$wisuda_rule,
                    'id_trx'=>$id_trx,
                ]
            );
            $this->footer();
        }else{
            $text = $this->alert->warning('You not registerd in : Wisuda');
            $this->session->set_flashdata('message', $text);
            redirect("mahasiswa/wisuda/list_periode");
        }
    }
    
    
    public function ukt_generate_tagihan_additional($id_trx){
        $this->form_validation->set_rules('total_bayar', 'total_bayar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('id_additional', 'id_additional', 'trim|required|xss_clean');
        if ( ($this->form_validation->run() == TRUE)   ) {
            $this->output->set_header('Access-Control-Allow-Origin: *');
            $url =$this->url.'api/plot_additional';
            $data = array('key' => $this->key,'respon'=>'yes', 'id_rule' => $this->input->post('id_additional'),'nim'=>$this->session->userdata('username') );
            // print_r($data);die();
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
                date_default_timezone_set('Asia/Jakarta');
                $this->load->library('bnienc');	

                $datas=$result->data;
                $data_asli = array(
					'client_id' => $this->client_id,
					'trx_id' => mt_rand(), // fill with Billing ID
					'trx_amount' => $datas->tagihan+3000, 
                    'billing_type' => 'c',
					'datetime_expired' => date('c', time() + 2 * 3600),
					'customer_name' => 'Pembayaran '.$datas->nama.' additional:'.$this->session->userdata('username').', id_additional#'.$datas->id_trx,
					'customer_email' => "",
					'customer_phone' =>  "" ,
					'description' => 'Pembayaran '.$datas->nama.' additional:'.$this->session->userdata('username').', id_additional#'.$datas->id_trx,
					'type'=>'createBilling'
                );
                 
                $hashed_string = $this->bnienc->encrypt($data_asli,	$this->client_id,	$this->secret_key);
                $this->Master_model->update_query(['nim'=>$this->session->userdata('username'),'id_wisuda'=>$id_trx], 
                    [
                        'id_rule'=>$datas->id_trx,
                    ]
                    , 'wisuda_mhs');

				$data = array(
					'client_id' => $this->client_id,
					'data' => $hashed_string,
				);
				
				$options = array(
					'http' => array(
						'header'  => "Content-type: application/json\r\n",
						'method'  => 'POST',
						'content' => json_encode( $data )
					)
				);
				$context  = stream_context_create($options);

				$response = file_get_contents($this->url_bni, false, $context);
                $response_json = json_decode($response, true);
                if ($response_json['status'] !== '000') {

					$text_json = json_encode($response_json);
					$text=$this->alert->warning('Pembuatan Virtual Account Gagal Detail : '.$text_json);
                    $this->session->set_flashdata('message',$text);
                    redirect('mahasiswa/wisuda/dashboard/'.$id_trx,'refresh');
				
				}else {
                    
                    

					$data_response = $this->bnienc->decrypt($response_json['data'], $this->client_id, $this->secret_key);
					$data_input=array(
						'trx_id' => $data_response['trx_id'],
						'virtual_account' => $data_response['virtual_account'],
						'trx_amount' => $data_asli['trx_amount'],
						'customer_name' => $data_asli['customer_name'],
						'customer_email' => $data_asli['customer_email'],
						'customer_phone' => $data_asli['customer_phone'],
						'datetime_expired' => $data_asli['datetime_expired'],
						'description' => $data_asli['description'],
						'nim' => $this->session->userdata('username'),
					);
					$this->Master_model->insert_query('master_va',$data_input);
					$text=$this->alert->success('Pembuatan Virtual Account Berhasil dengan No VA : '.$data_response['virtual_account'].' Silahkan Lakukan Pembayaran sebelum : '.$data_asli['datetime_expired']);
                    $this->session->set_flashdata('message', $text);
                    redirect("mahasiswa/administrasi/additional/");
				}

            }else{
                $text = $this->alert->danger($data_json->messages);
                $this->session->set_flashdata('message', $text);
                redirect('mahasiswa/wisuda/dashboard/'.$id_trx,'refresh');
            }

        }else{
            $text = $this->alert->danger('Error data post');
			$this->session->set_flashdata('message', $text);
			redirect("mahasiswa/wisuda/dashboard/".$id_trx);
        }
    }

    public function cek_payment($id_trx){
        $wisuda=$this->Master_model->master_get(['nim'=>$this->session->userdata('username')],'wisuda_mhs');
        if($wisuda){
            $this->output->set_header('Access-Control-Allow-Origin: *');
            $url =$this->url.'api/cek_rule';
            $data = array('key' => $this->key,'id_rule' => $wisuda->id_rule,'nim'=>$this->session->userdata('username') );
            // print_r($data);die();
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
            // print_r($result);
            if($result->status_code=='000'){
                $datas=$result->data;
                if($datas->status_bayar=='sudah'){
                    $this->Master_model->update_query(['nim'=>$this->session->userdata('username'),'id_rule'=>$wisuda->id_rule], 
                    [
                        'no_kwitansi'=>$datas->id_kwitansi,
                        'bayar'=>'sudah',
                        'tanggal_bayar'=>date('Y-m-d H:i:s'),
                    ]
                    , 'wisuda_mhs');
                    $text = $this->alert->success('Payment Update');
                    $this->session->set_flashdata('message', $text);
                    redirect('mahasiswa/wisuda/dashboard/'.$id_trx,'refresh');
                }else{
                    $text = $this->alert->warning($result->messages.' : Status Bayar '.$datas->status_bayar);
                    $this->session->set_flashdata('message', $text);
                    redirect('mahasiswa/wisuda/dashboard/'.$id_trx,'refresh');
                }
            }else{
                $text = $this->alert->danger($result->messages);
                $this->session->set_flashdata('message', $text);
                redirect('mahasiswa/wisuda/dashboard/'.$id_trx,'refresh');
            }     

        }else{
            $text = $this->alert->warning('You not registerd in : Wisuda');
            $this->session->set_flashdata('message', $text);
            redirect("mahasiswa/wisuda/list_periode");   
        }
        


    }

}