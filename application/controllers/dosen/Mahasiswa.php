<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
		$this->load->model('Baak_model');
		$this->load->model('Dosen_model');

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('dosen_mahasiswa',$level,$action);
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
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->mahasiswa();

        //print_r($data_master);
        $this->header();
       
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
		);

		$this->load->model('form/Baak_f', 'baak_form');

		$data_master=$this->baak_form->mahasiswa_filter();
		
		$this->load->view('master/master_filter',
			[
				'data_detail'=>$data_master['form_detail'],
				'data_isi'=>$data_master['data_isi'],
				'data_filter'=>$this->session->userdata('mahasiswa_filter')['status_mahasiswa'].",".$this->session->userdata('mahasiswa_filter')['id_periode_masuk'],
				// 'data_master'=>$data_masters,
			]);
		$this->footer();
    }

    public function filter_mahasiswa(){
		$status_mahasiswa=$this->input->post('status_mahasiswa',TRUE);
		$id_periode_masuk=$this->input->post('id_periode_masuk',TRUE);
		$this->session->set_userdata(
			array(
				'mahasiswa_filter' => array(
					'status_mahasiswa'=>$status_mahasiswa,	
					'id_periode_masuk'=>$id_periode_masuk,	
				)
			)
		);
		redirect('dosen/mahasiswa', 'refresh');
    }
    
    public function frs(){
		$this->load->model('tabel/Dosen_t', 'dosen_tabel');
        $periode=$this->Baak_model->json_id_periode_aktif('');

        $data_master=$this->dosen_tabel->frs($periode);

        
        $this->header();
       
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
		);
		$this->footer();
	}

	public function transkrip_akademik($nim){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
    
        $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
        $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'status_frs'=>'setujui'],'v_frs_index');
        if($data){
            $this->header();
            $this->load->view('mahasiswa/hasil_studi',
                    [
                        'status'=>'transkrip_akademik',
                        'kurikulum'=>$data,
                        'mahasiswa'=>$mahasiswa,
                    ]
            );
            $this->footer();
        }else{
            $text = $this->alert->danger('Data Is Null : anda belum mengisi FRS pada periode '.$periode);
                $this->session->set_flashdata('message', $text);
                redirect('mahasiswa/perkuliahan/kartu_ujian/','refresh');
        }
	}
	
    public function mahasiswa_perwalian_add(){
        $this->form_validation->set_rules('periode', 'periode', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nim', 'nim', 'trim|required|xss_clean');
        $this->form_validation->set_rules('perwalian', 'perwalian', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        $nim=$this->input->post('nim',TRUE);
        $periode=$this->input->post('periode',TRUE);
        if (($this->form_validation->run() == TRUE)   ) {
           $data=array(
               'periode'=>$this->input->post('periode',TRUE),
               'nim'=>$this->input->post('nim',TRUE),
               'keterangan'=>$this->input->post('perwalian',TRUE),
               'email_dosen'=>$this->session->userdata('username'),
           );
           $this->Master_model->insert_query('mahasiswa_perwalian',$data);
           redirect("dosen/mahasiswa/frs_mhs/".$nim."/".$periode);
        //print_r($id_table);
    }else{
        $this->frs_mhs($nim,$periode);
    }
    }
    
	public function frs_mhs_action(){
      
        $this->form_validation->set_rules('periode', 'periode', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nim', 'nim', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        $nim=$this->input->post('nim',TRUE);
        $periode=$this->input->post('periode',TRUE);

            if (($this->form_validation->run() == TRUE)   ) {
                $id_table=$this->input->post('id_table',TRUE);
                $status=$this->input->post('status',TRUE);
                if(count($status)==count($id_table)){
                    for($i=0;$i<count($id_table);$i++) {
                
                        $id_table_o=$id_table[$i];
                        $status_o=$status[$i];
                        // echo $id_table_o." ";
                        // echo $status_o."-";
                        $data=array(
                            'status_frs'=>$status_o
                        );
                        $where_array=array(
                            'id_trx'=>$id_table_o
                        );
                        $this->Master_model->update_query($where_array, $data, 'frs_mhs_mk');
                        $this->Master_model->insert_history('update','frs_mhs_mk',json_encode($data));
                        //public function insert_history($aksi,$tabel,$data)
                        
                    }
                    redirect("mahasiswa/administrasi/update_sks/".$nim."/".$periode);
                    // redirect("dosen/mahasiswa/frs_mhs/".$nim."/".$periode);
                }else{
                    $text = $this->alert->danger('Error: Data not same');
                    $this->session->set_flashdata('message', $text);
                    redirect("welcome/dashboard");
                }
            //print_r($id_table);
        }else{
            $this->frs_mhs($nim,$periode);
        }
    }

	public function frs_mhs($nim,$periode,$akses='frs'){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        //$akses='frs';
        $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
        $mahasiswa_perwalian = $this->Master_model->master_result(['nim'=>$nim,'periode'=>$periode],'mahasiswa_perwalian');
        $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'periode'=>$periode,'transfer'=>'tidak'],'v_frs');
        if($data){
        if($akses=='frs'){
            
            $this->header();
            $this->load->view('dosen/frs_mhs',
                    [
                        'periode'=>$periode,
                        'kurikulum'=>$data,
                        'mahasiswa'=>$mahasiswa,
                        'mahasiswa_perwalian'=>$mahasiswa_perwalian,
                    ]
            );
            $this->footer();
        }else{
            // $nim = $this->session->userdata('username');
            // $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
            // $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'periode'=>$periode,'status_frs'=>'setujui'],'v_frs');

            // $this->header();
            // $this->load->view('mahasiswa/lihat_ks',
            //         [
            //             'periode'=>$periode,
            //             'kurikulum'=>$data,
            //             'mahasiswa'=>$mahasiswa,
            //         ]
            // );
            // $this->footer();
        }

    }else{
        $text = $this->alert->danger('Data Is Null : Mahasiswa belum mengisi FRS pada periode '.$periode);
            $this->session->set_flashdata('message', $text);
            redirect('dosen/mahasiswa/frs','refresh');
    }
        
    }
    


    public function print(){
        
        // $data = $this->load->library('mypdf');

        
        
        // $this->mypdf->generate('tes/tes');

        $this->load->model('tabel/Dosen_t', 'dosen_tabel');
        $periode=$this->Baak_model->json_id_periode_aktif('');

        $data_master=$this->dosen_tabel->frs($periode);

        
        $this->header();
       
        $this->load->view('master/master_list',
            [
                'data_detail'=>$data_master['data_detail'],
                'data_isi'=>$data_master['data_isi'],
            ]
		);
		$this->footer();
    }

}