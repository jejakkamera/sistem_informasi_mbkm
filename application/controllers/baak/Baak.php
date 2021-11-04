<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baak extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->library('Feeder_lib');
		$this->load->model('Baak_model');

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('baak',$level,$action);
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
        $data_master=$this->baak_tabel->prodi();

        //print_r($data_master);
        $this->header();
        
		$this->footer();
		
	}

	public function rekap_perkuliahan_action()
	{
		$nim=$this->input->post('nim',TRUE);
		$periode=$this->input->post('periode',TRUE);

		// $nim="201901531022";
		// $periode="20201";
		if(!$nim && !$periode){
			echo "no nim";
			die();
		}
		$data = $this->Master_model->master_result_(['nim'=>$nim,'status_frs'=>'setujui'],'v_frs_index');
		
			$total_sks=0;
			$total_kumulatif=0;
			$total_sks_semester=0;
			$total_kumulatif_semester=0;
			$periode_lalu='';
			foreach($data as $row){ 
				if($periode_lalu!=$row->periode and $periode_lalu!=''){
					$ips[$periode_lalu]=number_format($total_kumulatif_semester/$total_sks_semester,2);
					$ipk[$periode_lalu]=number_format($total_kumulatif/$total_sks,2);
					$total_kumulatif_semester_s[$periode_lalu]=$total_sks_semester;
					$total_kumulatif_s[$periode_lalu]=$total_sks;
					
					$total_sks_semester=0;
					$total_kumulatif_semester=0;
				}
					$total_sks=$total_sks+$row->sks_mata_kuliah;
					$total_sks_semester=$total_sks_semester+$row->sks_mata_kuliah;
					$total_kumulatif=$total_kumulatif+$row->nilai_kumulatif;
					$total_kumulatif_semester=$total_kumulatif_semester+$row->nilai_kumulatif;
					$periode_lalu=$row->periode;
			}
				$ips[$periode_lalu]=number_format($total_kumulatif_semester/$total_sks_semester,2);
				$ipk[$periode_lalu]=number_format($total_kumulatif/$total_sks,2);
				$total_kumulatif_semester_s[$periode_lalu]=$total_sks_semester;
				$total_kumulatif_s[$periode_lalu]=$total_sks;

		if($ips[$periode]){
			$data2=array(
				'nim'=>$nim,
				'last_periode'=>$periode,
				'id_periode'=>$periode,
				'id_status_mahasiswa'=>'AKTIF',
				'ips'=>$ips[$periode],
				'ipk'=>$ipk[$periode],
				'sks_total'=>$total_kumulatif_s[$periode],
				'sks_semester'=>$total_kumulatif_semester_s[$periode],
			);
		}else{
			$data2=array(
				'nim'=>$nim,
				'last_periode'=>$periode_lalu,
				'id_periode'=>$periode,
				'id_status_mahasiswa'=>'NON-AKTIF',
				'ips'=>0,
				'ipk'=>$ipk[$periode_lalu],
				'sks_total'=>$total_kumulatif_s[$periode_lalu],
				'sks_semester'=>0,
			);
		}
		$data_file = $this->Master_model->master_get(['nim'=>$nim,'id_periode'=>$periode], 'aktivitas_perkuliahan_siakad');
		if($data_file){
			$this->Master_model->update_query(['nim'=>$nim,'id_periode'=>$periode], $data2, 'aktivitas_perkuliahan_siakad');
			echo "succes update";
		}else{
			$this->Master_model->insert_query('aktivitas_perkuliahan_siakad',$data2);
			echo "succes insert";
		}
		
	}
	
	public function list_ta()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_ta();

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

	public function list_skala_nilai()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_skala_nilai();

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
	
	public function list_skala_nilai_detail($periode)
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->list_skala_nilai_detail($periode);

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

	

	public function perkuliahan_rekap()
	{
		$where=array(
			'status_mahasiswa'=>'AKTIF'
		);
		$mahasiswa_aktif=$this->Baak_model->mahasiswa_list($where);
		$periode=$this->Baak_model->json_id_periode('');
        $this->header();
        
        $this->load->view('baak/perkuliahan_rekap',
            [
                'mahasiswa_aktif'=>$mahasiswa_aktif,
                'periode'=>$periode,
            ]
        );
        //$this->load->view('baak/mahasiswa_filter');
		$this->footer();
		
	}

	public function skala_nilai_add($periode)
	{
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->skala_nilai_add($periode);

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

	public function copy_skala_nilai($periode)
	{
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->copy_skala_nilai($periode);

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

	public function copy_skala_nilai_action($periode)
	{
		$this->form_validation->set_rules('periode', 'periode', 'trim|required|xss_clean');
		if ( ($this->form_validation->run() == TRUE)   ) {
			$periode_from=$this->input->post('periode',TRUE);
			$where_=array(
				'periode'=>$periode_from
			);
			$cek_=$this->Master_model->master_get($where_,'nilai_skala');
			if($cek_){
				//print_r($cek_);
				$this->Baak_model->copy_skala_nilai_action($periode,$periode_from);
				$text = $this->alert->success('Data successfully Copy');
				$this->session->set_flashdata('message', $text);
				redirect(site_url('baak/baak/list_skala_nilai/'));
			}else{
				$text = $this->alert->Danger('Record Is Null Data');
				$this->session->set_flashdata('message', $text);
				redirect(site_url('baak/baak/list_skala_nilai/'));
			}

			
		}else{
			$this->copy_skala_nilai($periode);
		}
	}
	
	public function skala_nilai_add_action($periode)
	{
        $this->form_validation->set_rules('nilai_huruf', 'nilai_huruf', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nilai_index', 'nilai_index', 'trim|required|xss_clean|less_than[4.1]');
        $this->form_validation->set_rules('kode_prodi', 'kode_prodi', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bobot_minimum', 'bobot_minimum', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bobot_maximum', 'bobot_maximum', 'trim|required|xss_clean|less_than[101]');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		$where_=array(
			'nilai_huruf'=>$this->input->post('nilai_huruf',TRUE),
			'kode_prodi' => $this->input->post('kode_prodi',TRUE),
            'periode' => $periode,
		);

		$cek_=$this->Master_model->master_get($where_,'nilai_skala');

		if(!$cek_){
			if ( ($this->form_validation->run() == TRUE)   ) {
				$data = array(
					'nilai_huruf' => $this->input->post('nilai_huruf',TRUE),
					'nilai_index' => $this->input->post('nilai_index',TRUE),
					'kode_prodi' => $this->input->post('kode_prodi',TRUE),
					'periode' => $periode,
				);
				$this->Master_model->insert_query('nilai_skala',$data);
				log_message('info', 'Input - data to frs_set, data :'.json_encode($data));
				
				$text = $this->alert->success('Data successfully Add');
				$this->session->set_flashdata('message', $text);
				redirect(site_url('baak/baak/list_skala_nilai_detail/'.$periode));
			}else{
				$this->skala_nilai_add($periode);
			}
		}else{
				$text = $this->alert->Danger('Record Duplicate');
				$this->session->set_flashdata('message', $text);
				redirect(site_url('baak/baak/list_skala_nilai_detail/'.$periode));
		}
		
	}
	
	public function skala_nilai_delete($id)
	{
		
		$where_=array(
			'id'=>$id
		);

		$cek_=$this->Master_model->master_get($where_,'nilai_skala');
		if($cek_){

			$where_array=array(
				'id'=>$id
			);
			$this->Master_model->delete_query($where_array, 'nilai_skala');

			$data_history=json_encode($cek_);
			log_message('info', 'Delete - data to frs_set, data :'.$data_history);

			$text = $this->alert->success('record successfully deleted');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/baak/list_skala_nilai_detail/'.$cek_->periode));

		}else{
			$text = $this->alert->danger('Data not Found');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/baak/list_skala_nilai'));
		}
		
    }

	public function waktu_kuliah()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->waktu_kuliah();

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

	public function waktu_kuliah_add()
	{
        $this->load->model('form/Baak_f', 'baak_form');

        $data_master=$this->baak_form->waktu_kuliah_add();

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

	public function waktu_kuliah_delete($id)
	{
        $where_=array(
			'id'=>$id
		);

		$cek_=$this->Master_model->master_get($where_,'waktu_kulia');
		if($cek_){
			$where_=array(
				'waktu'=>$id
			);
	
			$cek_w=$this->Master_model->master_get($where_,'mata_kuliah_jadwal');
			if($cek_){
				$text = $this->alert->danger('Data Cannot Delete : Waktu kuliah sudah digunakan, silahkan nonaktifkan status');
				$this->session->set_flashdata('message', $text);
				redirect(site_url('baak/baak/waktu_kuliah'));
			}else{

			}

		}else{
			$text = $this->alert->danger('Data not Found');
			$this->session->set_flashdata('message', $text);
			redirect(site_url('baak/baak/waktu_kuliah'));
		}
	}

	public function waktu_kuliah_add_action()
	{
		$this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('waktu', 'waktu', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nama_id', 'nama_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
		if(($this->form_validation->run() == TRUE)){
            $where_=array(
				'id'=>$this->input->post('id',TRUE)
			);
	
			$cek_=$this->Master_model->master_get($where_,'waktu_kulia');
			if(!$cek_){
				$data=array(
					'id'=>$this->input->post('id',TRUE),
					'waktu'=>$this->input->post('waktu',TRUE),
					'nama_id'=>$this->input->post('nama_id',TRUE),
					'status'=>$this->input->post('status',TRUE),
				);
				$this->Master_model->insert_query('waktu_kulia',$data);
				log_message('info', 'Input - waktu_kulia, data :'.json_encode($data));
				
				$text = $this->alert->success('Data successfully Add');
				$this->session->set_flashdata('message', $text);
				redirect(site_url('baak/baak/waktu_kuliah_add'));
			}else{
				$text = $this->alert->danger('Duplicate primary key');
				$this->session->set_flashdata('message', $text);
				redirect(site_url('baak/baak/waktu_kuliah_add'));
			}
        }else{
			$this->waktu_kuliah_add();
		}
	}

	
    public function waktu_kuliah_edit($id_trx)
	{
        $this->load->model('form/Baak_f', 'baak_form');

		
		
		// $master_saji=get_object_vars($this->Baak_model->waktu_kuliah_get($id_trx));
		
        $data_masters=get_object_vars($this->Master_model->master_get(['id' => $id_trx],'waktu_kulia'));
        $data_master=$this->baak_form->waktu_kuliah_edit($id_trx);
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
	
	
	public function waktu_kuliah_edit_action($id)
	{
		
        $this->form_validation->set_rules('waktu', 'waktu', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nama_id', 'nama_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
		if(($this->form_validation->run() == TRUE)){
            $where_=array(
				'id'=>$this->input->post('id',TRUE),
				'id'=>$id,
			);
	
			$cek_=$this->Master_model->master_get($where_,'waktu_kulia');
			if($cek_){
				$data=array(
					'waktu'=>$this->input->post('waktu',TRUE),
					'nama_id'=>$this->input->post('nama_id',TRUE),
					'status'=>$this->input->post('status',TRUE),
				);
				
				$this->Master_model->update_query(['id'=>$id], $data, 'waktu_kulia');
				log_message('info', 'Update - waktu_kuliah, data :'.json_encode($data));
				
				$text = $this->alert->success('Data successfully Update');
				$this->session->set_flashdata('message', $text);
				redirect(site_url('baak/baak/waktu_kuliah'));
			}else{
				$text = $this->alert->danger('Waktu Kuliah Not Found');
				$this->session->set_flashdata('message', $text);
				redirect(site_url('baak/baak/waktu_kuliah'));
			}
        }else{
			$this->waktu_kuliah_edit($id);
		}
	}
	
    


}
