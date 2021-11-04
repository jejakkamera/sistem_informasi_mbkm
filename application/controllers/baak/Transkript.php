<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transkript extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->model('Baak_model');

        $this->url=url_siku;
		$this->key=key_siku;

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('tanskript',$level,$action);
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

    public function list(){
      
        $this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_tanskrip();

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

    public function json_list(){
        $this->load->model('datatable/Baak_dt', 'Baak_dt');
        
        header('Content-Type: application/json');
        echo $this->Baak_dt->json_list_trankript();
    }

    public function cetak_trankript($nim){
        $data_masters=$this->Master_model->master_get(['nim' => $nim],'cetak_info');
        if(!$data_masters){
            $data = array(
                'nim' => $nim,
            );
            $this->Master_model->insert_query('cetak_info',$data);
            $data_masters=$this->Master_model->master_get(['nim' => $nim],'cetak_info');
        }
        $status_print=false;
        if($data_masters->transcript='0000-00-00'){
            $status_print=$data_masters->transcript;
        }
        $transkript_data=$this->Baak_model->cetak_trankript_data($nim);
        
        if($transkript_data){
            $transkript_nilai=$this->Baak_model->cetak_trankript_nilai($nim);
            // print_r($transkript_nilai[1]['kode_mk']);die();
            $this->load->view('baak/cetak_trankript',
                [
                    'transkript_nilai'=>$transkript_nilai,
                    'transkript_data'=>$transkript_data,
                ]
            );
            
        }else{
            $text = $this->alert->danger('NIM not found');
			$this->session->set_flashdata('message', $text);
			redirect("baak/transkript/list");
        }


    }

}