<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use GuzzleHttp\Client;
class Administrasi extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
        $this->load->model('Mahasiswa_model');
        $this->url=url_siku;
		$this->key=key_siku;
        $this->client_id =client_id;
        $this->secret_key =secret_key;
        $this->url_bni =url_bni;

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('administrasi',$level,$action);
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

	public function ukt_generate_tagihan($periode_send){
		
        $this->form_validation->set_rules('total_bayar', 'total_bayar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('periode', 'periode', 'trim|required|xss_clean');
        // echo $this->input->post('total_bayar',TRUE);
        // echo $this->input->post('periode',TRUE);
        if ( ($this->form_validation->run() == TRUE)   ) {
            $total_bayar=$this->input->post('total_bayar',TRUE);
            $periode=$this->input->post('periode',TRUE);
            if($periode==$periode_send AND $total_bayar>=100000){
                date_default_timezone_set('Asia/Jakarta');
                $this->load->library('bnienc');	
                
                $data_asli = array(
					'client_id' => $this->client_id,
					'trx_id' => mt_rand(), // fill with Billing ID
					'trx_amount' => $total_bayar+3000, 
                    'billing_type' => 'c',
					'datetime_expired' => date('c', time() + 2 * 3600),
					'customer_name' => 'Pembayaran UKT:'.$this->session->userdata('username').', Periode#'.$periode,
					'customer_email' => "",
					'customer_phone' =>  "" ,
					'description' => 'Pembayaran UKT:'.$this->session->userdata('username').', Periode#'.$periode,
					'type'=>'createBilling'
                );
				// print_r($data_asli);
                
                $hashed_string = $this->bnienc->encrypt($data_asli,	$this->client_id,	$this->secret_key);

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
				// $context  = stream_context_create($options);

				// $response = file_get_contents($this->url_bni, false, $context);
				
				$response = $this->get_content($this->url_bni, json_encode($data));
				$response_json = json_decode($response, true);
                
                if ($response_json['status'] !== '000') {

					$text_json = json_encode($response_json);
					$text=$this->alert->warning('Pembuatan Virtual Account Gagal Detail : '.$text_json);
                    $this->session->set_flashdata('message',$text);
                    redirect("mahasiswa/administrasi/ukt/");
				
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
                    redirect("mahasiswa/administrasi/ukt/");
				}

            }else{
                $text = $this->alert->danger('Error data post');
			$this->session->set_flashdata('message', $text);
			redirect("mahasiswa/administrasi/ukt/");
            }
        }else{
            $text = $this->alert->danger('Error data post');
			$this->session->set_flashdata('message', $text);
			redirect("mahasiswa/administrasi/ukt/");
        }

    }


	public function kwitansi(){
		$this->output->set_header('Access-Control-Allow-Origin: *');
        $url =$this->url.'api/get_kwitansi';
		$data = array('key' => $this->key, 'nim' => $this->session->userdata('username') );
		$options = array(
			'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
		);
						
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		echo $result;
	}

	public function kwitansi_additional(){
		$this->output->set_header('Access-Control-Allow-Origin: *');
        $url =$this->url.'api/get_kwitansi_additional';
		$data = array('key' => $this->key, 'nim' => $this->session->userdata('username') );
		$options = array(
			'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
		);
						
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		echo $result;
	}

	public function ukt(){
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $url =$this->url.'api/get_tagihan';
		$data = array('key' => $this->key, 'nim' => $this->session->userdata('username') );
		$options = array(
			'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
		);
						
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
        $data_json=json_decode($result);
		$va=$this->Master_model->master_get(['nim'=>$this->session->userdata('username'),'UNIX_TIMESTAMP(`datetime_expired`)>'=>strtotime('now')],'master_va');
		

       if($data_json->status_code=='000'){
            // print_r($data_json->data);
			$this->header();
			$virtual_account='';
			if($va){
				$virtual_account=$this->FormatCreditCard($va->virtual_account);
			}
			
            $this->load->view('mahasiswa/ukt',[
                'pembayaran'=>$data_json->data,
                'va'=>$va,
                'virtual_account'=>$virtual_account,
                ]
            );
            $this->footer();
       }else{
            $text = $this->alert->danger($data_json->messages);
            $this->session->set_flashdata('message', $text);
            redirect('welcome/dashboard','refresh');
       }
        // return $data_json;
	}
	
	

    public function FormatCreditCard($cc)
	{
		// Clean out extra data that might be in the cc
		$cc = str_replace(array('-',' '),'',$cc);
		// Get the CC Length
		$cc_length = strlen($cc);
		// Initialize the new credit card to contian the last four digits
		$newCreditCard = substr($cc,-4);
		// Walk backwards through the credit card number and add a dash after every fourth digit
		for($i=$cc_length-5;$i>=0;$i--){
			// If on the fourth character add a dash
			if((($i+1)-$cc_length)%4 == 0){
				$newCreditCard = ' - '.$newCreditCard;
			}
			// Add the current character to the new credit card
			$newCreditCard = $cc[$i].$newCreditCard;
		}
		// Return the formatted credit card number
		return $newCreditCard;
	}

    public function inquiry($va){

		$va=$this->Master_model->master_get(['virtual_account'=>$va],'master_va');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('bnienc');	
		
		$data_asli = array(
			
			'client_id' => $this->client_id,
			// 'trx_id' => "09810748037",
			'type'=>'inquirybilling'
		);

		$hashed_string = $this->bnienc->encrypt($data_asli,	$this->client_id,	$this->secret_key);

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

		// $response = file_get_contents($this->url_bni, false, $context);
		$response = $this->get_content($this->url_bni, json_encode($data));
		$response_json = json_decode($response, true);
		print_r($data);
		echo "<hr>";
		print_r($response);
	}

    public function cupdate_va_va_($va){
       
                $va=$this->Master_model->master_get(['virtual_account'=>$va],'master_va');
                date_default_timezone_set('Asia/Jakarta');
                $this->load->library('bnienc');	
                
                $data_asli = array(
					'client_id' => $this->client_id,
					'trx_id' => $va->trx_id, // fill with Billing ID
					'trx_amount' => $va->trx_amount,
                    'billing_type' => 'iz',
					'datetime_expired' => date('c', time() + 2 * 3600),
					'customer_name' => $va->customer_name,
					'customer_email' => "",
					'customer_phone' =>  "" ,
					'description' => $va->customer_name,
					'type'=>'updateBilling'
                );
                
                $hashed_string = $this->bnienc->encrypt($data_asli,	$this->client_id,	$this->secret_key);

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

				// $response = file_get_contents($this->url_bni, false, $context);
				$response = $this->get_content($this->url_bni, json_encode($data));
                $response_json = json_decode($response, true);
               print_r($data);
               echo "<hr>";
               print_r($response);

	}
	
	public function additional(){
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $url =$this->url.'api/get_tagihan_additional';
		$data = array('key' => $this->key, 'nim' => $this->session->userdata('username') );
		$options = array(
			'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
		);
						
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
        $data_json=json_decode($result);
		$va=$this->Master_model->master_get(['nim'=>$this->session->userdata('username'),'UNIX_TIMESTAMP(`datetime_expired`)>'=>strtotime('now')],'master_va');
		

       if($data_json->status_code=='000'){
            // print_r($data_json->data);
			$this->header();
			$virtual_account='';
			if($va){
				$virtual_account=$this->FormatCreditCard($va->virtual_account);
			}
			
            $this->load->view('mahasiswa/additional',[
                'pembayaran'=>$data_json->data,
                'va'=>$va,
                'virtual_account'=>$virtual_account,
                ]
            );
            $this->footer();
       }else{
            $text = $this->alert->danger($data_json->messages);
            $this->session->set_flashdata('message', $text);
            redirect('welcome/dashboard','refresh');
       }
        // return $data_json;
	}
	
	public function ukt_generate_tagihan_additional($id_additional){
        $this->form_validation->set_rules('total_bayar', 'total_bayar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('id_additional', 'id_additional', 'trim|required|xss_clean');
        // echo $this->input->post('total_bayar',TRUE);
        // echo $this->input->post('periode',TRUE);
        if ( ($this->form_validation->run() == TRUE)   ) {
            $total_bayar=$this->input->post('total_bayar',TRUE);
			$id_additional=$this->input->post('id_additional',TRUE);
			
                date_default_timezone_set('Asia/Jakarta');
                $this->load->library('bnienc');	
                
                $data_asli = array(
					'client_id' => $this->client_id,
					'trx_id' => mt_rand(), // fill with Billing ID
					'trx_amount' => $total_bayar+3000, 
                    'billing_type' => 'c',
					'datetime_expired' => date('c', time() + 2 * 3600),
					'customer_name' => 'Pembayaran additional:'.$this->session->userdata('username').', id_additional#'.$id_additional,
					'customer_email' => "",
					'customer_phone' =>  "" ,
					'description' => 'Pembayaran additional:'.$this->session->userdata('username').', id_additional#'.$id_additional,
					'type'=>'createBilling'
                );
                
                $hashed_string = $this->bnienc->encrypt($data_asli,	$this->client_id,	$this->secret_key);

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

				// $response = file_get_contents($this->url_bni, false, $context);
				$response = $this->get_content($this->url_bni, json_encode($data));
                $response_json = json_decode($response, true);
                if ($response_json['status'] !== '000') {

					$text_json = json_encode($response_json);
					$text=$this->alert->warning('Pembuatan Virtual Account Gagal Detail : '.$text_json);
                    $this->session->set_flashdata('message',$text);
                    redirect("mahasiswa/administrasi/additional/");
				
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
            $text = $this->alert->danger('Error data post');
			$this->session->set_flashdata('message', $text);
			redirect("mahasiswa/administrasi/additional/");
        }

	}
	
	public function update_sks($nim,$periode){
		$mahasiswa=$this->Master_model->master_get(['nim'=>$nim],'mahasiswa');
		if($mahasiswa){
			$krs=$this->Master_model->master_get(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'terakhir_krs'=>$periode],'v_frs_total_sks');
			if($krs){
				$this->output->set_header('Access-Control-Allow-Origin: *');
				$url =$this->url.'api/krs_mhs';
				$data = array('key' => $this->key, 'nim' => $nim,'periode' => $krs->terakhir_krs,'total_krs_ambil' => $krs->total_krs_ambil );
				$options = array(
					'http' => array(
						'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
						'method'  => 'POST',
						'content' => http_build_query($data)
					)
				);
								
				$context  = stream_context_create($options);
				$result = file_get_contents($url, false, $context);
				$data_json=json_decode($result);
				if($data_json->status_code=='000'){
					redirect("dosen/mahasiswa/frs_mhs/".$nim."/".$periode);
				}else{
					redirect("dosen/mahasiswa/frs_mhs/".$nim."/".$periode);
				}	

			}else{
				echo "mahasiswa krs kosong, silahkan kembali kehalaman sebelumnya";
			}
		}else{
			echo "mahasiswa tidak ada, silahkan kembali kehalaman sebelumnya";
		}
		// redirect("dosen/mahasiswa/frs_mhs/".$nim."/".$periode);
	}
    

	public function create_penaguhan(){
		$config['upload_path']          = './assets/penanguhan/';
		$config['allowed_types']        = 'pdf';
		$new_name = time().$this->session->userdata('username').'.pdf';
		$config['file_name'] = $new_name;
		$id_penaguhan=$this->input->post('id_penaguhan',TRUE);

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('file_penaguhan'))
		{
            $text = $this->alert->danger('Data failed Added. Info :'.$this->upload->display_errors());
				$this->session->set_flashdata('message', $text);
            return redirect("mahasiswa/administrasi/penaguhan/");
		}
		else
		{
            $nama_berkas = $this->upload->data("file_name");
			$this->output->set_header('Access-Control-Allow-Origin: *');
				$url =$this->url.'api/daftar_penaguhan_master';
				$data = array('key' => $this->key, 'nim' => $this->session->userdata('username'),'id_penaguhan' => $id_penaguhan,'nama_berkas' => $nama_berkas );
				$options = array(
					'http' => array(
						'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
						'method'  => 'POST',
						'content' => http_build_query($data)
					)
				);
								
				$context  = stream_context_create($options);
				$result = file_get_contents($url, false, $context);
				$data_json=json_decode($result);
				print_r($data_json);
				if($data_json->status_code=='000'){
					
								
					$text = $this->alert->success('Data successfully Added');
					$this->session->set_flashdata('message', $text);
            		return redirect("mahasiswa/administrasi/penaguhan/");
			   }else{
					$text = $this->alert->danger('error send :'.$data_json->messages);
					$this->session->set_flashdata('message', $text);
					return redirect("mahasiswa/administrasi/penaguhan/");
			   }
          }
	}

	public function penaguhan(){
        $this->output->set_header('Access-Control-Allow-Origin: *');
		
		$frs_set=$this->Master_model->master_get(['id'=>0],'frs_set');
		
        $url =$this->url.'api/get_penaguhan_master';
		$data = array('key' => $this->key, 'periode' => $frs_set->id_periode );
		$options = array(
			'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
		);
						
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
        $data_json=json_decode($result);		
       if($data_json->status_code=='000'){
            // print_r($data_json->data);
			$this->header();
						
            $this->load->view('mahasiswa/penaguhan',[
                'penaguhan'=>$data_json->data,
                ]
            );
            $this->footer();
       }else{
            $text = $this->alert->danger($data_json->messages);
            $this->session->set_flashdata('message', $text);
            //redirect('welcome/dashboard','refresh');
       }
        // return $data_json;
	}

	public function penanguhan_cetak($id_trx){
		$this->output->set_header('Access-Control-Allow-Origin: *');
		
		$frs_set=$this->Master_model->master_get(['id'=>0],'frs_set');
		
        $url =$this->url.'api/cek_penaguhan';
		$data = array('key' => $this->key, 'id_trx' => $id_trx,'nim' => $this->session->userdata('username') );
		$options = array(
			'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
		);
						
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
        $data_json=json_decode($result);		
       if($data_json->status_code=='000'){
            // print_r($data_json->data);
			$this->header();
			$this->load->view('mahasiswa/cetak_kwitansi_2',
				[
					'data_masters'=>$data_json->data,
				]
			);
			$this->footer();
       }else{
            $text = $this->alert->danger($data_json->messages);
            $this->session->set_flashdata('message', $text);
            redirect('welcome/dashboard','refresh');
       }

	}

	public function pengajuan_penanguhan(){
		$this->output->set_header('Access-Control-Allow-Origin: *');
		$frs_set=$this->Master_model->master_get(['id'=>0],'frs_set');
        $url =$this->url.'api/get_pengajuan_penanguhan';
		$data = array('key' => $this->key, 'nim' => $this->session->userdata('username'),'periode' => $frs_set->id_periode );
		$options = array(
			'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
		);
						
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		echo $result;
	}

	function get_content($url, $post = '') {
		$usecookie = __DIR__ . "/cookie.txt";
		$header[] = 'Content-Type: application/json';
		$header[] = "Accept-Encoding: gzip, deflate";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Accept-Language: en-US,en;q=0.8,id;q=0.6";
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		// curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
	
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");
	
		if ($post)
		{
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
		$rs = curl_exec($ch);
	
		if(empty($rs)){
			var_dump($rs, curl_error($ch));
			curl_close($ch);
			return false;
		}
		curl_close($ch);
		return $rs;
	}
    
}
