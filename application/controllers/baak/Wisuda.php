<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisuda extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->model('Baak_model');

        $this->url=url_siku;
		$this->key=key_siku;

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('baak_wisuda',$level,$action);
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

    public function json_list_periode_wisuda(){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_periode_wisuda();
    }

    public function periode_wisuda_add(){
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->periode_wisuda_add();
        
        // print_r($master_saji);
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

    public function periode_wisuda_add_action(){

        $this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('buka_daftar', 'buka_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tutup_daftar', 'tutup_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

            if ( ($this->form_validation->run() == TRUE)   ) {

                $data = array(
					'status' => $this->input->post('status',TRUE),
					'buka_daftar' => $this->input->post('buka_daftar',TRUE),
					'tutup_daftar' => $this->input->post('tutup_daftar',TRUE),
					'keterangan' => $this->input->post('keterangan',TRUE),
				);
				$this->Master_model->insert_query('wisuda_periode',$data);

                $text = $this->alert->success('success add : periode Wisuda');
				$this->session->set_flashdata('message', $text);
				redirect("baak/wisuda/list_periode");
            }else{
                $this->periode_tugas_akhir_add();
            }
    }    
    
    public function periode_wisuda_edit($id_trx){
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->periode_wisuda_edit($id_trx);
        $data_masters=get_object_vars($this->Master_model->master_get(['id_trx'=>$id_trx],'wisuda_periode'));
		if(!$data_masters){
			$text = $this->alert->danger('Periode not found');
			$this->session->set_flashdata('message', $text);
			redirect("baak/wisuda/list_periode");
		}
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

    public function periode_wisuda_edit_action($id_trx){

        $data_masters=get_object_vars($this->Master_model->master_get(['id_trx'=>$id_trx],'wisuda_periode'));
        if(!$data_masters){
            $text = $this->alert->danger('Periode not found');
			$this->session->set_flashdata('message', $text);
			redirect("baak/wisuda/list_periode");
        }
        $this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('buka_daftar', 'buka_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tutup_daftar', 'tutup_daftar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

            if ( ($this->form_validation->run() == TRUE)   ) {

                $data = array(
					'status' => $this->input->post('status',TRUE),
					'buka_daftar' => $this->input->post('buka_daftar',TRUE),
					'tutup_daftar' => $this->input->post('tutup_daftar',TRUE),
					'keterangan' => $this->input->post('keterangan',TRUE),
				); 
                $this->Master_model->update_query(['id_trx'=>$id_trx], $data, 'wisuda_periode');

                $text = $this->alert->success('success add : periode Wisuda');
				$this->session->set_flashdata('message', $text);
				redirect("baak/wisuda/list_periode");
            }else{
                $this->periode_wisuda_edit();
            }
    }

    public function periode_rule($id_trx){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
            $data_master=$this->baak_tabel->periode_rule_wisuda($id_trx);

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

    public function json_periode_rule($id_trx){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_periode_rule_wisuda($id_trx);
    }

    public function periode_rule_add($id_trx){
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->periode_rule_add_wisuda($id_trx);
        
        // print_r($master_saji);
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

    public function periode_rule_add_action($id_trx){
        $this->form_validation->set_rules('id_periode', 'id_periode', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

            if ( ($this->form_validation->run() == TRUE)   ) {

                $this->output->set_header('Access-Control-Allow-Origin: *');
                $url =$this->url.'api/get_rule_administrasi_byid';
                $data = array('key' => $this->key, 'id_rule' =>  $this->input->post('id_periode',TRUE) );
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
                if($result->status_code!='000'){

                    $text = $this->alert->danger('cannot get data from siku');
                    $this->session->set_flashdata('message', $text);
                    redirect("baak/wisuda/periode_rule_add/".$id_trx);
                }  
                $result = ($result->data);
                

                $data = array(
					'id_trx' => $id_trx,
					'id_rule' => $result->kode,
					'name' => $result->nama,
					'besaran' => $result->tagihan,
				);
				$this->Master_model->insert_query('wisuda_rule',$data);

                $text = $this->alert->success('success add : Wisuda rule');
				$this->session->set_flashdata('message', $text);
				redirect("baak/wisuda/periode_rule/".$id_trx);
            }else{
                $this->periode_rule_add($periode);
            }
    }


    public function delete_rule($id){
        $data_file = $this->Master_model->master_get(['id_wisuda_rule'=>$id], 'wisuda_rule');
        if($data_file){
            $this->Master_model->delete_query(['id_wisuda_rule'=> $id],'wisuda_rule');

            $text = $this->alert->warning('Data successfully Delete');
				$this->session->set_flashdata('message', $text);
				redirect("baak/wisuda/periode_rule/".$data_file->id_trx);
        }else{
            $text = $this->alert->warning('TRX not found');
				$this->session->set_flashdata('message', $text);
				redirect("baak/wisuda/list_periode");
        }
    }

    public function list_pendaftar($id_wisuda){
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_pendaftar_wisuda($id_wisuda);

        $this->header();
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
        );
        $this->footer();
    }

    public function wisuda_report($id_wisuda){
        header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=ms_kelas20.doc");
		header("Pragma: no-cache");
		header("Expires: 0");
		
        $this->load->model('Baak_model');
        $cek_data=$this->Baak_model->wisuda_report($id_wisuda);
        $data = array(
            'start' => 0,
            'cek_data' => $cek_data,
        );
        $this->load->view('baak/wisuda/buku_wisuda',$data);
    }

    public function json_list_pendaftar_wisuda($id_wisuda){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_pendaftar_wisuda($id_wisuda);
    }

}