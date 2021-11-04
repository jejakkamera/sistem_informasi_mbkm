<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frs extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
        $this->load->model('Mahasiswa_model');

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('mahasiswa',$level,$action);
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
    
    
	public function isi_select(){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        $this->load->model('Baak_model');

        $data_masters=get_object_vars($this->Baak_model->master_get_set_frs());
        $data_master=$this->mahasiswa_form->isi_select($data_masters);

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

	public function isi_select_action(){
        $this->form_validation->set_rules('id_periode', 'id_periode', 'trim|required|xss_clean');
        if ( ($this->form_validation->run() == TRUE)   ) {
            $periode=$this->input->post('id_periode',TRUE);
            //$pembayaran=get_object_vars($this->Keuangan_model->cek_ukt($periode,'frs'));
            $pembayaran=1;
            if($pembayaran==1){
                $this->load->model('form/Mhs_f', 'mahasiswa_form');
                $this->load->model('Baak_model');

                $data_masters=get_object_vars($this->Baak_model->master_get_set_frs());

                $start = strtotime($data_masters["tgl_pengisian"]);
                $close = strtotime($data_masters["tgl_penutupan"].' 23:59:00');
                $now = strtotime(date('Y-m-d H:i:s'));
                if($start < $now and $now <$close and $data_masters["pengisian_frs"]=='buka' ){

                    $nim = $this->session->userdata('username');
                    $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'mahasiswa');
                    $kurikulum=($this->Baak_model->mahasiswa_list_kurikulum_saji($nim,$periode));

                    $kelas = $this->Master_model->master_result(['kode_prodi'=>$mahasiswa->kode_prodi,'angkatan'=>substr($mahasiswa->id_periode_masuk,0,4)],'kelas');
                    //echo $mahasiswa->kode_prodi;
                    // print_r($kelas);die();
                    //,'angkatan'=>substr($mahasiswa->id_periode_masuk,0,4)
                    $this->header();
                    $this->load->view('mahasiswa/isi_frs',
                        [
                            'periode'=>$periode,
                            'kurikulum'=>$kurikulum,
                            'kelas'=>$kelas,
                        ]
                    );
                    $this->footer();
                }else{
                    $text = $this->alert->danger('You do not have access : Pengisian FRS di tutup');
                	$this->session->set_flashdata('message', $text);
                	redirect("mahasiswa/frs/isi_select/");
                }
            }else{
                    $text = $this->alert->danger('You do not have access : Lakukan Registrasi Pembayaran');
                	$this->session->set_flashdata('message', $text);
                	redirect("mahasiswa/frs/isi_select/");
            }
        }else{
            $this->isi_select();
        }
      

    }
    
	public function isi_select_action_hapus($id_trx){
        $id_registrasi_mahasiswa = $this->Master_model->master_get(['id_trx'=>$id_trx],'frs_mhs_mk');
        //print_r($id_registrasi_mahasiswa);
        if( ($id_registrasi_mahasiswa) and ($id_registrasi_mahasiswa->status_frs=='tolak' or $id_registrasi_mahasiswa->status_frs=='pilih')){

            $this->Master_model->insert_history('Delete','frs_mhs_mk',json_encode($id_registrasi_mahasiswa));
            $this->Master_model->delete_query(['id_trx'=>$id_trx], 'frs_mhs_mk');
            $text = $this->alert->success('delete successfully');
            $this->session->set_flashdata('message', $text);
            redirect("mahasiswa/frs/isi_select_action/");
        }else{
            $text = $this->alert->danger('delete failed');
            $this->session->set_flashdata('message', $text);
            redirect("mahasiswa/frs/isi_select_action/");
        }
       

        //print_r($id_registrasi_mahasiswa);
    }

	public function isi_select_action_add(){
        $periode=$this->input->post('periode',TRUE);
        $mk=$this->input->post('mk',TRUE);
        $mk_ulang=$this->input->post('mk_ulang',TRUE);
        $kode_kelas=$this->input->post('kode_kelas',TRUE);
        $nim = $this->session->userdata('username');
        $id_registrasi_mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'mahasiswa')->id_registrasi_mahasiswa;
        if( ($mk or $mk_ulang) and $id_registrasi_mahasiswa ){
            if($mk){
                foreach($mk as $row){
                    $find=strpos($row,"#");
                    $id_matkul=substr($row,0,($find));
                    $data_mk = $this->Master_model->master_get([
                        'id_registrasi_mahasiswa'=>$id_registrasi_mahasiswa,
                        'id_matkul'=>$id_matkul,
                        'periode'=>$periode,
                    ],'frs_mhs_mk');
                    if(!$data_mk){
                        $data=array(
                            'id_registrasi_mahasiswa'=>$id_registrasi_mahasiswa,
                            'id_matkul'=>$id_matkul,
                            'periode'=>$periode,
                            'id_kelas_perkuliahan'=>$kode_kelas,
                        );
                        $this->Master_model->insert_query('frs_mhs_mk',$data);
                    }
                }
            }

            if($mk_ulang){
                foreach($mk_ulang as $rows){
                    $find=strpos($rows,"#");
                    $id_matkul=substr($rows,0,($find));
                    $data_mk = $this->Master_model->master_get([
                        'id_registrasi_mahasiswa'=>$id_registrasi_mahasiswa,
                        'id_matkul'=>$id_matkul,
                        'periode'=>$periode,
                    ],'frs_mhs_mk');
                    if(!$data_mk){
                        $data=array(
                            'id_registrasi_mahasiswa'=>$id_registrasi_mahasiswa,
                            'id_matkul'=>$id_matkul,
                            'periode'=>$periode,
                            'id_kelas_perkuliahan'=>$kode_kelas,
                            'ulang'=>'ya',
                        );
                        $this->Master_model->insert_query('frs_mhs_mk',$data);
                    }
                }
            }
            $data=array(
                'id_kelas'=>$kode_kelas
            );
            $this->Master_model->update_query(['nim'=>$nim], $data, 'mahasiswa');
            
            $text = $this->alert->success('Data successfully add');
            $this->session->set_flashdata('message', $text);
            redirect('mahasiswa/frs/lihat_select/','refresh');
            
        }else{
            $text = $this->alert->danger('form is null');
            $this->session->set_flashdata('message', $text);
            redirect('mahasiswa/frs/isi_select/','refresh');
        }
        // var_dump($this->input->post());
    }

	public function lihat_select(){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');

        $data_master=$this->mahasiswa_form->lihat_select();

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

	
    
	public function lihat_select_action(){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        $periode=$this->input->post('id_periode',TRUE);
        $pengisian_frs=$this->input->post('pengisian_frs',TRUE);
        $nim = $this->session->userdata('username');
        $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
        $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'periode'=>$periode,'transfer'=>'tidak'],'v_frs');
        if($data){
        if($pengisian_frs=='frs'){
            
            $mahasiswa_perwalian = $this->Master_model->master_result(['nim'=>$nim,'periode'=>$periode],'mahasiswa_perwalian');
            $this->header();

            // $data4 = $this->load->library('mypdf');
            // $this->mypdf->generate('mahasiswa/print_frs',
            // [
            //     'periode'=>$periode,
            //     'kurikulum'=>$data,
            //     'mahasiswa'=>$mahasiswa,
            //     'mahasiswa_perwalian'=>$mahasiswa_perwalian,


              
            // ]);


            $this->load->view('mahasiswa/lihat_frs',
                    [
                        'periode'=>$periode,
                        'kurikulum'=>$data,
                        'mahasiswa'=>$mahasiswa,
                        'mahasiswa_perwalian'=>$mahasiswa_perwalian,
                        'periode' => $periode,
                        'pengisian_frs' => $pengisian_frs    
                      
                    ]
            );
            $this->footer();
                    
                   
        }else{
            $this->load->model('Baak_model');
            $info_akademik=$this->Baak_model->master_akademik_mhs($nim);
            $nim = $this->session->userdata('username');
            $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
            $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'periode'=>$periode,'status_frs'=>'setujui'],'v_frs');

            $this->header();
            $this->load->view('mahasiswa/lihat_ks',
                    [
                        'periode'=>$periode,
                        'kurikulum'=>$data,
                        'mahasiswa'=>$mahasiswa,
                        'info_akademik'=>$info_akademik,
                        'periode' => $periode,
                        'pengisian_frs' => $pengisian_frs
                    ]
            );
            $this->footer();
        }

    }else{
        $text = $this->alert->danger('Data Is Null : anda belum mengisi FRS pada periode '.$periode);
            $this->session->set_flashdata('message', $text);
            redirect('mahasiswa/frs/lihat_select/','refresh');
    }
        
	}
	
    
    public function print($periode1,$print_frs1){
        
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        $periode=$periode1;
        $pengisian_frs=$print_frs1;
        $nim = $this->session->userdata('username');
        $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
        $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'periode'=>$periode],'v_frs');
        if($data){
        if($pengisian_frs=='frs'){
            
            $mahasiswa_perwalian = $this->Master_model->master_result(['nim'=>$nim,'periode'=>$periode],'mahasiswa_perwalian');
            $this->header();

            $data4 = $this->load->library('mypdf');
            $this->mypdf->generate('mahasiswa/print_frs',
            [
                'periode'=>$periode,
                'kurikulum'=>$data,
                'mahasiswa'=>$mahasiswa,
                'mahasiswa_perwalian'=>$mahasiswa_perwalian,
            ]);


            // $this->load->view('mahasiswa/lihat_frs',
            //         [
            //             'periode'=>$periode,
            //             'kurikulum'=>$data,
            //             'mahasiswa'=>$mahasiswa,
            //             'mahasiswa_perwalian'=>$mahasiswa_perwalian,
            //             'periode' => $periode,
            //             'pengisian_frs' => $pengisian_frs    
                      
            //         ]
            // );
            $this->footer();
                    
                   
        }else{
            $this->load->model('Baak_model');
            $info_akademik=$this->Baak_model->master_akademik_mhs($nim);
            $nim = $this->session->userdata('username');
            $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
            $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'periode'=>$periode,'status_frs'=>'setujui'],'v_frs');
            
            
            $this->header();

            $data4 = $this->load->library('mypdf');
            $this->mypdf->generate('mahasiswa/print_ks',
            [
                        'periode'=>$periode,
                        'kurikulum'=>$data,
                        'mahasiswa'=>$mahasiswa,
                        'info_akademik'=>$info_akademik,

            ]);

           
            // $this->load->view('mahasiswa/lihat_ks',
            //         [
            //             'periode'=>$periode,
            //             'kurikulum'=>$data,
            //             'mahasiswa'=>$mahasiswa,
            //             'info_akademik'=>$info_akademik,
            //         ]
            // );
            $this->footer();
        }

    }else{
        $text = $this->alert->danger('Data Is Null : anda belum mengisi FRS pada periode '.$periode);
            $this->session->set_flashdata('message', $text);
            redirect('mahasiswa/frs/lihat_select/','refresh');
    }

    }


}
