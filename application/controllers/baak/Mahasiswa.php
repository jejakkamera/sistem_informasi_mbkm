<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
		$this->load->model('Baak_model');

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('baak_mahasiswa',$level,$action);
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
    
	public function filter(){
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
		redirect('baak/mahasiswa', 'refresh');
	}

	public function mahasiswa_hapus_action($nim){
		$mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
		if(!$mahasiswa){
			$text = $this->alert->warning('Nim not found');
                $this->session->set_flashdata('message', $text);
               	redirect('baak/mahasiswa/');
		}
        $data = $this->Master_model->master_result_(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'status_frs'=>'setujui'],'v_frs_index');
        if(!$data){
			$this->Master_model->insert_history('Delete','mahasiswa',json_encode($mahasiswa));
			$this->Master_model->delete_query(['username'=>$nim], 'user');
			$this->Master_model->delete_query(['nim'=>$nim], 'mahasiswa');
				$text = $this->alert->success('delete successfully');
				$this->session->set_flashdata('message', $text);
				redirect("baak/mahasiswa");

        }else{
            	$text = $this->alert->warning('error delete '.$nim.' : KRS not null');
                $this->session->set_flashdata('message', $text);
               	redirect('baak/mahasiswa/');
        }
	}

	public function profile($nim){
		
		//view
		$data_master['data_mahasiswa'] = $this->db->get_where('mahasiswa', ["nim" => $nim])->result();
		$query['data_ayah'] = $this->Master_model->master_result(['nim'=>$nim],'v_ayah');
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->join('mahasiswa_profile','mahasiswa_profile.nim=mahasiswa.nim');
		$query['data_ayah'] = $this->Master_model->master_get(['nim'=>$nim],'v_ayah');
		$query['data_ibu'] = $this->Master_model->master_get(['nim'=>$nim],'v_ibu');
		$query['data_wali'] = $this->Master_model->master_get(['nim'=>$nim],'v_wali');
		$query['data_mahasiswa'] = $this->db->where(["mahasiswa_profile.nim" => $nim])->get()->result();
		$query['data_mahasiswa_2'] = $this->Master_model->master_get(['nim'=>$nim],'v_profile_mhs');

		$query['wilayah'] = $this->Master_model->master_get(['id_kec'=>$query['data_mahasiswa_2']->id_kec],'v_data_wilayah');


		//form
		$query['jenis_tinggal'] =$this->db->get('dikti_jenis_tinggal')->result_array();
		$query['jenjang_pendidikan'] =$this->db->get('dikti_jenjang_pendidikan')->result_array();
		$query['pekerjaan'] =$this->db->get('dikti_pekerjaan')->result_array();
		$query['penghasilan'] =$this->db->get('dikti_penghasilan')->result_array();
		$query['agama'] =$this->db->get('dikti_agama')->result_array();
		$query['transportasi'] =$this->db->get('dikti_transportasi')->result_array();

		

		$this->header();
		$this->load->view('mahasiswa/profile',$query);
		$this->footer();

		// $data[]=$this->Master_model->master_result(['nim'=>'200001151001'],'mahasiswa');
		// $data[]=$this->Master_model->master_result(['nim'=>'200001151001'],'mahasiswa_profile');
		// var_dump($data);
		// die;
	}

	public function cariKec(){

		$q = $this->input->post('searchTerm');
		$data=$this->Master_model->master_result_like(['nama_wilayah' => $q],'prov_kab_kec');


		echo json_encode($data);
	}


	
	public function dosen_wali()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->dosen_wali_mahasiswa();

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

	public function dosen_wali_list()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->dosen_wali_list();

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

	public function kurikulum()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->kurikulum_mahasiswa();

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

	public function kelas()
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->baak_tabel->kelas();

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

	public function plot_kurikulum($id_kurikulum)
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->Baak_model->mahasiswa_kurikulum($id_kurikulum);

        //print_r($data_master);
        $this->header();
        $this->load->view('mahasiswa/plot_kurikulum_mahasiswa',[
			'data_master'=>$data_master,
			'id_kurikulum'=>$id_kurikulum,
			'action'=>base_url('baak/mahasiswa/plot_kurikulum_action/'.$id_kurikulum),
			'nama_kurikulum'=>$data_master[0]->nama_kurikulum
		]);
		$this->footer();
		
	}

	public function plot_dosen_wali($id,$homebase,$nama)
	{
		$this->load->model('tabel/Baak_t', 'baak_tabel');
        $data_master=$this->Baak_model->plot_dosen_wali($id,$homebase);

        //print_r($data_master);
        $this->header();
        $this->load->view('mahasiswa/plot_dosen_wali',[
			'data_master'=>$data_master,
			'id_dosen'=>$id,
			'action'=>base_url('baak/mahasiswa/plot_dosen_wali_action/'.$id),
			'nama_dosen'=>$nama
		]);
		$this->footer();
		
	}

	public function plot_kelas($id_kelas,$kode_prodi)
	{
		$data_kelas=$this->Master_model->master_get(['id_kelas'=>$id_kelas],'kelas');
		if($data_kelas){
			$this->load->model('tabel/Baak_t', 'baak_tabel');
			$data_master=$this->Baak_model->plot_kelas($id_kelas,$kode_prodi);

			//print_r($data_master);
			$this->header();
			$this->load->view('mahasiswa/plot_kelas',[
				'data_master'=>$data_master,
				'id_kelas'=>$id_kelas,
				'action'=>base_url('baak/mahasiswa/plot_kelas_action/'.$id_kelas.'/'.$kode_prodi),
				'nama_dosen'=>$data_kelas->angkatan.'-'.$data_kelas->nama_kelas
			]);
			$this->footer();
		}else{
			$text = $this->alert->danger('Error : id_kelas not found');
			$this->session->set_flashdata('message', $text);
			redirect("baak/mahasiswa/kelas");
		}
		
		
	}

	public function plot_kelas_action($id_kelas,$kode_prodi)
	{
		$duallistbox_demo1=$this->input->post('duallistbox_demo2',TRUE);
		$this->Baak_model->plot_kelas_action($id_kelas,$duallistbox_demo1);
		print_r($duallistbox_demo1);
	}

	public function plot_kurikulum_action($id_kurikulum)
	{
		$duallistbox_demo1=$this->input->post('duallistbox_demo2',TRUE);
		$this->Baak_model->plot_kurikulum_action($id_kurikulum,$duallistbox_demo1);
		print_r($duallistbox_demo1);
	}

	public function plot_dosen_wali_action($id_dosen)
	{
		$duallistbox_demo1=$this->input->post('duallistbox_demo2',TRUE);
		$data=array();
		$data_tmp=array();
		if($duallistbox_demo1){
			foreach($duallistbox_demo1 as $row){
				$data_tmp=array(
					'nim'=>$row,
					'id_dosen'=>$id_dosen,
				);
				array_push($data,$data_tmp);
	
			}
			//print_r($data);
			
		}
		$this->Baak_model->plot_dosen_wali_action($id_dosen,$data);
		
		print_r($data);
	}

	
	public function profile_update($id){
		if ($id == 1) {

			$this->form_validation->set_rules('tempat_lahir','tempat_lahir','xss_clean');
			$this->form_validation->set_rules('tanggal_lahir','tanggal_lahir','xss_clean');
			$this->form_validation->set_rules('jenis_kelamin','jenis_kelamin','xss_clean');
			$this->form_validation->set_rules('id_agama','id_agama','xss_clean');
			$this->form_validation->set_rules('nik','nik','xss_clean');
			$this->form_validation->set_rules('kewarganegaraan','kewarganegaraan','xss_clean');
			$this->form_validation->set_rules('alamat','alamat','xss_clean');
			$this->form_validation->set_rules('kelurahan','kelurahan','xss_clean');
			$this->form_validation->set_rules('rt','rt','xss_clean');
			$this->form_validation->set_rules('rw','rw','xss_clean');
			$this->form_validation->set_rules('kode_pos','kode_pos','xss_clean');
			$this->form_validation->set_rules('kecamatan','kecamatan','xss_clean');
			$this->form_validation->set_rules('id_kabupaten_kota','id_kabupaten_kota','xss_clean');
			$this->form_validation->set_rules('id_jenis_tinggal','id_jenis_tinggal','xss_clean');
			$this->form_validation->set_rules('telepon','telepon','xss_clean');
			$this->form_validation->set_rules('penerima_kps','penerima_kps','xss_clean');
			$this->form_validation->set_rules('no_kps','no_kps','xss_clean');
			$this->form_validation->set_rules('npwp','no_kps','xss_clean');
			$this->form_validation->set_rules('id_alat_transportasi','no_kps','xss_clean');
			$data_wilayah =$this->Master_model->master_get(['id_kec' =>$this->input->post('kecamatan',TRUE) ],'v_data_wilayah');

			if(($this->form_validation->run() == TRUE)){
				$data = array(
					'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
					'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
					'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
					'id_agama' => $this->input->post('id_agama',TRUE),
					'nik' => $this->input->post('nik',TRUE),
					'kewarganegaraan' => $this->input->post('kewarganegaraan',TRUE),
					'alamat' => $this->input->post('alamat',TRUE),
					'kelurahan' => $this->input->post('kelurahan',TRUE),
					'rt' => $this->input->post('rt',TRUE),
					'rw' => $this->input->post('rw',TRUE),
					'kode_pos' => $this->input->post('kode_pos',TRUE),
					'kecamatan' => $this->input->post('kecamatan',TRUE),
					'id_kabupaten_kota' => $data_wilayah->id_kab,
					'id_provinsi' => $data_wilayah->id_wilayah,
					'id_negara' => $data_wilayah->id_negara,
					'id_jenis_tinggal' => $this->input->post('id_jenis_tinggal',TRUE),
					'telepon' => $this->input->post('telepon',TRUE),
					'handphone' => $this->input->post('telepon',TRUE),
					'penerima_kps' => $this->input->post('penerima_kps',TRUE),
					'no_kps' => $this->input->post('no_kps',TRUE),
					'npwp' => $this->input->post('npwp',TRUE),
					'id_alat_transportasi' => $this->input->post('id_alat_transportasi',TRUE),
				);

		

				$this->Master_model->update_query(['nim'=>$this->input->post('nim',TRUE)], $data, 'mahasiswa_profile');
				return redirect(base_url("/baak/mahasiswa/profile/".$this->input->post('nim',TRUE)));
			}

			
		}
		if ($id == 2) {
			$this->form_validation->set_rules('nama_ayah','nama_ayah','xss_clean');
            $this->form_validation->set_rules('tanggal_lahir_ayah','tanggal_lahir_ayah','xss_clean');
            $this->form_validation->set_rules('tempat_lahir_ayah','tempat_lahir_ayah','xss_clean');
            $this->form_validation->set_rules('no_hp_ayah','no_hp_ayah','xss_clean');
            $this->form_validation->set_rules('nik_ayah','nik_ayah','xss_clean');
			$this->form_validation->set_rules('id_jenjang_pendidikan_ayah','id_jenjang_pendidikan_ayah','xss_clean');
			$this->form_validation->set_rules('id_pekerjaan_ayah','id_pekerjaan_ayah','xss_clean');
			$this->form_validation->set_rules('id_penghasilan_ayah','id_penghasilan_ayah','xss_clean');
			$this->form_validation->set_rules('nama_ibu_kandung','nama_ibu_kandung','xss_clean');
			$this->form_validation->set_rules('nik_ibu','nik_ibu','xss_clean');
            $this->form_validation->set_rules('tanggal_lahir_ibu','tanggal_lahir_ibu','xss_clean');
            $this->form_validation->set_rules('no_hp_ibu','no_hp_ibu','xss_clean');
            $this->form_validation->set_rules('tempat_lahir_ibu','tempat_lahir_ibu','xss_clean');
			$this->form_validation->set_rules('id_jenjang_pendidikan_ibu','id_jenjang_pendidikan_ibu','xss_clean');
			$this->form_validation->set_rules('id_pekerjaan_ibu','id_pekerjaan_ibu','xss_clean');
			$this->form_validation->set_rules('id_penghasilan_ibu','id_penghasilan_ibu','xss_clean');

			if(($this->form_validation->run() == TRUE)){
				$data = array(
                    'nama_ayah' => $this->input->post('nama_ayah',TRUE),
                    'no_hp_ayah' => $this->input->post('no_hp_ayah',TRUE),
                    'tempat_lahir_ayah' => $this->input->post('tempat_lahir_ayah',TRUE),
					'tanggal_lahir_ayah' => $this->input->post('tanggal_lahir_ayah',TRUE),
					'nik_ayah' => $this->input->post('nik_ayah',TRUE),
					'id_jenjang_pendidikan_ayah' => $this->input->post('id_jenjang_pendidikan_ayah',TRUE),
					'id_pekerjaan_ayah' => $this->input->post('id_pekerjaan_ayah',TRUE),
					'id_penghasilan_ayah' => $this->input->post('id_penghasilan_ayah',TRUE),
					'nama_ibu_kandung' => $this->input->post('nama_ibu_kandung',TRUE),
                    'nik_ibu' => $this->input->post('nik_ibu',TRUE),
                    'no_hp_ibu' => $this->input->post('no_hp_ibu',TRUE),
                    'tempat_lahir_ibu' => $this->input->post('tempat_lahir_ibu',TRUE),
					'tanggal_lahir_ibu' => $this->input->post('tanggal_lahir_ibu',TRUE),
					'id_jenjang_pendidikan_ibu' => $this->input->post('id_jenjang_pendidikan_ibu',TRUE),
					'id_pekerjaan_ibu' => $this->input->post('id_pekerjaan_ibu',TRUE),
					'id_penghasilan_ibu' => $this->input->post('id_penghasilan_ibu',TRUE),
				);
				$this->Master_model->update_query(['nim'=>$this->input->post('nim',TRUE)], $data, 'mahasiswa_profile');
				return redirect(base_url("/baak/mahasiswa/profile/".$this->input->post('nim',TRUE)));
			}
		}
		if ($id == 3) {
			$this->form_validation->set_rules('nama_wali','nama_wali','xss_clean');
            $this->form_validation->set_rules('nik_wali','nik_wali','xss_clean');
            $this->form_validation->set_rules('no_hp_wali','no_hp_wali','xss_clean');
            $this->form_validation->set_rules('nama_wali','nama_wali','xss_clean');
            $this->form_validation->set_rules('tempat_lahir_wali','tempat_lahir_wali','xss_clean');
            $this->form_validation->set_rules('tanggal_lahir_wali','tanggal_lahir_wali','xss_clean');
			$this->form_validation->set_rules('id_jenjang_pendidikan_wali','id_jenjang_pendidikan_wali','xss_clean');
			$this->form_validation->set_rules('id_pekerjaan_wali','id_pekerjaan_wali','xss_clean');
			$this->form_validation->set_rules('id_penghasilan_wali','id_penghasilan_wali','xss_clean');

			if(($this->form_validation->run() == TRUE)){
				$data = array(
					
                    'nama_wali' => $this->input->post('nama_wali',TRUE),
                    'nik_wali' => $this->input->post('nik_wali',TRUE),
                    'no_hp_wali' => $this->input->post('no_hp_wali',TRUE),
                    'tempat_lahir_wali' => $this->input->post('tempat_lahir_wali',TRUE),
					'tanggal_lahir_wali' => $this->input->post('tanggal_lahir_wali',TRUE),
					'id_jenjang_pendidikan_wali' => $this->input->post('id_jenjang_pendidikan_wali',TRUE),
					'id_pekerjaan_wali' => $this->input->post('id_pekerjaan_wali',TRUE),
					'id_penghasilan_wali' => $this->input->post('id_penghasilan_wali',TRUE),


				);
				$this->Master_model->update_query(['nim'=>$this->input->post('nim',TRUE)], $data, 'mahasiswa_profile');
				return redirect(base_url("/baak/mahasiswa/profile/".$this->input->post('nim',TRUE)));
			}

		}
	}

	public function kelas_add_action()
	{
			$this->form_validation->set_rules('nama_kelas','nama_kelas','xss_clean');
            $this->form_validation->set_rules('angkatan','angkatan','xss_clean');
			$this->form_validation->set_rules('kode_prodi','kode_prodi','xss_clean');
			if(($this->form_validation->run() == TRUE)){
				$data = array(
					'nama_kelas' => $this->input->post('nama_kelas',TRUE),
					'angkatan' => $this->input->post('angkatan',TRUE),
					'kode_prodi' => $this->input->post('kode_prodi',TRUE),
					'id_kelas' => $this->Master_model->random_text( $this->input->post('kode_prodi',TRUE)),
				);
				$this->Master_model->insert_query('kelas',$data);

				$text = $this->alert->success('success add : kelas');
				$this->session->set_flashdata('message', $text);
				redirect("baak/mahasiswa/kelas");

			}else{
				$this->kelas_add();
			}
	}
	public function kelas_add()
	{
        $this->load->model('form/Baak_f', 'baak_form');
		$data_master=$this->baak_form->kelas_add();
		$this->header();
        $this->load->view('master/master_form',
            [
                'data_detail'=>$data_master['form_detail'],
                'data_isi'=>$data_master['data_isi'],
                'status'=>'',
            ]
        );
		$this->footer();
	}
	
	public function mahasiswa_info($id){
		if ($data2 = $this->Master_model->master_get(['username'=>$id],'user')) {
			
				$this->load->model('form/mhs_f', 'mhs_form');
                $data_master=$this->mhs_form->mhs_password($id);
                
		        $this->header();
                $this->load->view('master/master_form',
                [
                    'data_detail'=>$data_master['form_detail'],
                    'data_isi'=>$data_master['data_isi'],
                    
                    'status'=>'',
                ]
              );
                $this->footer();

		} else {
			
			$data = array(
                'username' => $id,
                'password' => md5('123123123'),
                'role' => "mhs",
            );
            $this->Master_model->insert_query('user',$data);
            redirect(site_url('baak/mahasiswa/mahasiswa_info/'.$id));
		}
		
	}


	public function set_mahasiswa_password_update($id){
		$this->form_validation->set_rules('password','password','xss_clean|required');
        if(($this->form_validation->run() == TRUE)){
            $data = array(
                'password' =>md5($this->input->post('password',TRUE)),
            );

		$this->Master_model->update_query(['username'=>$id], $data, 'user');
		
        $text = $this->alert->success('Data successfully update');
        $this->session->set_flashdata('message', $text);
        redirect(site_url('baak/mahasiswa/'));
        }else{
            $text = $this->alert->success('Data failed update');
            $this->session->set_flashdata('message', $text);
            redirect(site_url('baak/mahasiswa/'));
        }
	}


	public function edit_gambar($id){
		var_dump($id);
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
                        'nim'=>$nim,
                    ]
            );
            $this->footer();
        }else{
            	$text = $this->alert->danger('Data Is Null : anda belum mengisi FRS');
                $this->session->set_flashdata('message', $text);
               	redirect('baak/mahasiswa/isi_select/'.$nim,'refresh');
        }
	}

	public function transkrip_draf($nim){
        $this->load->model('form/Mhs_f', 'mahasiswa_form');
		$mahasiswa = $this->Master_model->master_get(['nim'=>$nim],'v_mahasiswa');
		
        $data=$this->Baak_model->transkript($nim);

        if($data){
            $this->header();
            $this->load->view('mahasiswa/transkrip_draf',
                    [
                        'status'=>'transkrip_akademik',
                        'kurikulum'=>$data,
                        'mahasiswa'=>$mahasiswa,
                        'nim'=>$nim,
                    ]
            );
            $this->footer();
        }else{
            	$text = $this->alert->danger('Data Is Null : anda belum mengisi FRS');
                $this->session->set_flashdata('message', $text);
               	redirect('baak/mahasiswa/isi_select/'.$nim,'refresh');
        }
	}
	
	public function isi_select($nim){
        $this->load->model('form/Baak_f', 'baak_form');
        $this->load->model('Baak_model');

        $data_masters=get_object_vars($this->Baak_model->master_get_set_frs());
        $data_master=$this->baak_form->isi_select($data_masters,$nim);

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
	
	public function isi_select_action($nim){
        $this->form_validation->set_rules('id_periode', 'id_periode', 'trim|required|xss_clean');
        if ( ($this->form_validation->run() == TRUE)   ) {
            $periode=$this->input->post('id_periode',TRUE);
            //$pembayaran=get_object_vars($this->Keuangan_model->cek_ukt($periode,'frs'));
            $pembayaran=1;
            if($pembayaran==1){
                $this->load->model('form/Mhs_f', 'mahasiswa_form');
                $this->load->model('Baak_model');

                $data_masters=get_object_vars($this->Baak_model->master_get_set_frs());

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
                            'nim'=>$nim,
                        ]
                    );
                    $this->footer();
              
            }else{
                    $text = $this->alert->danger('You do not have access : Lakukan Registrasi Pembayaran');
                	$this->session->set_flashdata('message', $text);
                	redirect("mahasiswa/frs/isi_select/");
            }
        }else{
            $this->isi_select($nim);
        }

	}
	
	public function isi_select_action_add($nim){
        $periode=$this->input->post('periode',TRUE);
        $mk=$this->input->post('mk',TRUE);
        $mk_ulang=$this->input->post('mk_ulang',TRUE);
        $kode_kelas=$this->input->post('kode_kelas',TRUE);
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
                            'status_frs'=>'setujui',
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
							'status_frs'=>'setujui',
                        );
                        $this->Master_model->insert_query('frs_mhs_mk',$data);
                    }
                }
            }
            
            $text = $this->alert->success('Data successfully add');
            $this->session->set_flashdata('message', $text);
            redirect('baak/mahasiswa/transkrip_akademik/'.$nim,'refresh');
            
        }else{
            $text = $this->alert->danger('form is null');
            $this->session->set_flashdata('message', $text);
            redirect('baak/mahasiswa/transkrip_akademik/'.$nim,'refresh');
        }
        // var_dump($this->input->post());
	}
	
	public function delete_kelas($id_kelas,$kode_prodi){
		$kelas = $this->Master_model->master_get(['id_kelas'=>$id_kelas],'kelas');
		if($kelas){
			$kelas = $this->Master_model->master_get(['id_kelas'=>$id_kelas],'mahasiswa');
			if($kelas){
				$text = $this->alert->danger('delete failed : kelas in use');
				$this->session->set_flashdata('message', $text);
				redirect("baak/mahasiswa/kelas");
			}else{
				$this->Master_model->insert_history('Delete','frs_mhs_mk',json_encode($id_registrasi_mahasiswa));
				$this->Master_model->delete_query(['id_kelas'=>$id_kelas], 'kelas');
				$text = $this->alert->success('delete successfully');
				$this->session->set_flashdata('message', $text);
				redirect("baak/mahasiswa/kelas");
			}
		}else{
			$text = $this->alert->danger('delete failed : kelas not found');
            $this->session->set_flashdata('message', $text);
            redirect("baak/mahasiswa/kelas");
		}
	}

	public function isi_select_action_hapus($id_trx){
        $id_registrasi_mahasiswa = $this->Master_model->master_get(['id_trx'=>$id_trx],'frs_mhs_mk');
        //print_r($id_registrasi_mahasiswa);
        if( ($id_registrasi_mahasiswa) and ($id_registrasi_mahasiswa->status_frs=='tolak' or $id_registrasi_mahasiswa->status_frs=='pilih')){

            $this->Master_model->insert_history('Delete','frs_mhs_mk',json_encode($id_registrasi_mahasiswa));
			$this->Master_model->delete_query(['id_trx'=>$id_trx], 'frs_mhs_mk');
			$id_registrasi_mahasiswa = $this->Master_model->master_get(['id_registrasi_mahasiswa'=>$id_registrasi_mahasiswa->id_registrasi_mahasiswa],'mahasiswa');
            $text = $this->alert->success('delete successfully');
            $this->session->set_flashdata('message', $text);
            redirect("baak/mahasiswa/isi_select_action/".$id_registrasi_mahasiswa->nim);
        }else{
            $text = $this->alert->danger('delete failed');
            $this->session->set_flashdata('message', $text);
            redirect("baak/mahasiswa");
        }
       

        //print_r($id_registrasi_mahasiswa);
    }

}
