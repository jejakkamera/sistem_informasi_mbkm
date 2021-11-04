<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perkuliahan extends CI_Controller {

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
    
	public function akademik(){
        $this->load->model('Baak_model');

        $nim = $this->session->userdata('username');

        $kurikulum=($this->Baak_model->mahasiswa_list_kurikulum($nim));
        $info_akademik=$this->Baak_model->master_akademik_mhs($nim);

        // var_dump($info_akademik);
        // die;
        //print_r($kurikulum[0]);
        $this->header();
        $this->load->view('mahasiswa/akadmik',
            ['kurikulum'=>$kurikulum,'info_akademik'=>$info_akademik]
        );
        $this->footer();
    }
    
	public function riwayat_perkuliahan(){
        $this->load->model('Baak_model');

        $nim = $this->session->userdata('username');
        $kurikulum=($this->Baak_model->mahasiswa_list_kurikulum($nim));
        $info_akademik=$this->Baak_model->master_akademik_mhs($nim);

        //print_r($info_akademik);
        //print_r($kurikulum[0]);
        $this->header();
        // $this->load->view('mahasiswa/riwayat_perkuliahan',
        //     ['kurikulum'=>$kurikulum,'info_akademik'=>$info_akademik]
        // );
        $this->footer();
    }
    
    public function kartu_kehadiran_action(){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        $periode=$this->input->post('id_periode',TRUE);
        $nim = $this->session->userdata('username');
        $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
        $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'periode'=>$periode,'status_frs'=>'setujui'],'v_frs');
        if($data){
            $this->header();
            $this->load->view('mahasiswa/kartu_kehadiran',
                    [
                        'periode'=>$periode,
                        'kurikulum'=>$data,
                        'mahasiswa'=>$mahasiswa,
                    ]
            );
            $this->footer();
        }else{
            $text = $this->alert->danger('Data Is Null : anda belum mengisi FRS pada periode '.$periode);
                $this->session->set_flashdata('message', $text);
                redirect('mahasiswa/perkuliahan/kartu_kehadiran/','refresh');
        }

    }

    public function kartu_kehadiran_action_cetak($akses,$id_trx){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        $data = $this->Master_model->master_get(['id_trx'=>$id_trx],'v_frs');
        
        if($data){
            $nim = $this->session->userdata('username');
            $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');

            $data4 = $this->load->library('print_kehadiran');
            $this->print_kehadiran->generate('mahasiswa/print_kartu_kehadiran',
            [
                'periode'=>$data->periode,
                'mk'=>$data,
                'mahasiswa'=>$mahasiswa,
                'akses'=>$akses,

            ]);
            
            $this->header();
            $this->load->view('mahasiswa/cetak_kartu_kehadiran',
                    [
                        'periode'=>$data->periode,
                        'mk'=>$data,
                        'mahasiswa'=>$mahasiswa,
                        'akses'=>$akses,
                    ]
            );
            $this->footer();
        }else{
            $text = $this->alert->danger('Data Is Null : Data MK tidak ditemukan ');
                $this->session->set_flashdata('message', $text);
                redirect('mahasiswa/perkuliahan/kartu_kehadiran/','refresh');
        }

    }

    public function kartu_kehadiran(){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');

        $data_master=$this->mahasiswa_form->kartu_kehadiran();

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

    public function kartu_ujian_action(){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        $periode=$this->input->post('id_periode',TRUE);
        $type = $this->input->post('type',TRUE);

        $nim = $this->session->userdata('username');
        $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
        $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'periode'=>$periode,'status_frs'=>'setujui'],'v_frs');
        if($data){
            $this->header();

            $data4 = $this->load->library('mypdf');
            $this->mypdf->generate('mahasiswa/cetak_kartu_ujian',
            [
                'periode'=>$periode,
                'kurikulum'=>$data,
                'mahasiswa'=>$mahasiswa,
                'type'=>$type

            ]);

            // $this->load->view('mahasiswa/kartu_ujian',
            //         [
            //             'periode'=>$periode,
            //             'kurikulum'=>$data,
            //             'mahasiswa'=>$mahasiswa,
            //             'type'=>$type
            //         ]
            // );
            $this->footer();
        }else{
            $text = $this->alert->danger('Data Is Null : anda belum mengisi FRS pada periode '.$periode);
                $this->session->set_flashdata('message', $text);
                redirect('mahasiswa/perkuliahan/kartu_ujian/','refresh');
        }
    }

    public function kartu_ujian(){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');

        $data_master=$this->mahasiswa_form->kartu_ujian();

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

    public function transkrip_akademik(){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        $nim = $this->session->userdata('username');
        $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
        $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'status_frs'=>'setujui'],'v_frs_index');
        if($data){
            $this->header();
            $this->load->view('mahasiswa/hasil_studi',
                    [
                        'status'=>'transkrip_akademik',
                        'periode'=>'all',
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

    public function hasil_studi_action(){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
        $periode=$this->input->post('id_periode',TRUE);
        $nim = $this->session->userdata('username');
        $mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
        $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'periode <='=>$periode,'status_frs'=>'setujui'],'v_frs_index');
        if($data){
            $this->header();
            $this->load->view('mahasiswa/hasil_studi',
                    [
                        'status'=>'hasil_studi',
                        'periode'=>$periode,
                        'kurikulum'=>$data,
                        'mahasiswa'=>$mahasiswa,
                    ]
            );
            $this->footer();
        }else{
            $text = $this->alert->danger('Data Is Null : anda belum mengisi FRS pada periode '.$periode);
                $this->session->set_flashdata('message', $text);
                redirect('mahasiswa/perkuliahan/hasil_studi/','refresh');
        }
    }

    public function hasil_studi_detail($id){
        $hasil_studi_detail = $this->Mahasiswa_model->hasil_studi_detail($id);
        echo "<div class='table-responsive'><table class='table table-bordered'><tr>
				<td> Nama Komponen</td>
				<td> Presentase</td>
				<td> Nilai</td>
				<td> Tanggal Input</td>
            </tr> ";
            if($hasil_studi_detail){
                foreach($hasil_studi_detail as $val){
                    echo "<tr>
                    <td>".$val->komponen."</td><td> ".$val->presentase." </td><td>".$val->nilai."</td><td> ".$val->insert_date." </td>
                    </tr>";
                }
            }
            
            echo " </table></div>";
    }

    public function hasil_studi(){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');

        $data_master=$this->mahasiswa_form->hasil_studi();

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

}
