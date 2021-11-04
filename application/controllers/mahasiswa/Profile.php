<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('Feeder_lib');
		$this->load->model('Mahasiswa_model');

        $level=$this->session->userdata('role');
        $action='get';
        $access = $this->Master_model->cek_akses('mahasiswa_profile',$level,$action);
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
		$this->detail();
	}	

	public function detail($nim=''){
		if($this->session->userdata('role')=='dosen' || $this->session->userdata('role')=='prodi'){

		}else{
			$nim = $this->session->userdata('username');
		}
        
		$data_master['data_mahasiswa'] = $this->db->get_where('mahasiswa', ["nim" => $nim])->result();
		$query['data_ayah'] = $this->Master_model->master_result(['nim'=>$nim],'v_ayah');
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->join('mahasiswa_profile','mahasiswa_profile.nim=mahasiswa.nim');
		$query['data_ayah'] = $this->Master_model->master_get(['nim'=>$nim],'v_ayah');
		$query['data_ibu'] = $this->Master_model->master_get(['nim'=>$nim],'v_ibu');
		$query['data_wali'] = $this->Master_model->master_get(['nim'=>$nim],'v_wali');
		$query['data_mahasiswa'] = $this->db->where(["mahasiswa_profile.nim" => $nim])->get()->result();
		$query['jenis_tinggal'] =$this->db->get('dikti_jenis_tinggal')->result_array();
		$query['jenjang_pendidikan'] =$this->db->get('dikti_jenjang_pendidikan')->result_array();
		$query['pekerjaan'] =$this->db->get('dikti_pekerjaan')->result_array();
		$query['penghasilan'] =$this->db->get('dikti_penghasilan')->result_array();
		$query['agama'] =$this->db->get('dikti_agama')->result_array();
		$query['transportasi'] =$this->db->get('dikti_transportasi')->result_array();
		$query['data_mahasiswa_2'] = $this->Master_model->master_get(['nim'=>$nim],'v_profile_mhs');
		$query['wilayah'] = $this->Master_model->master_get(['id_kec'=>$query['data_mahasiswa_2']->id_kec],'v_data_wilayah');
        //print_r($data_master['data_mahasiswa']);
		$this->header();
		$this->load->view('mahasiswa/profile',$query);
		$this->footer();

		// $data[]=$this->Master_model->master_result(['nim'=>'200001151001'],'mahasiswa');
		// $data[]=$this->Master_model->master_result(['nim'=>'200001151001'],'mahasiswa_profile');
		// var_dump($data);
		// die;
	}
	
	public function update($id){
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
					'penerima_kps' => $this->input->post('penerima_kps',TRUE),
					'no_kps' => $this->input->post('no_kps',TRUE),
					'npwp' => $this->input->post('npwp',TRUE),
					'id_alat_transportasi' => $this->input->post('id_alat_transportasi',TRUE),
				);

		

				$this->Master_model->update_query(['nim'=>$id], $data, 'mahasiswa_profile');
				return redirect(base_url("/baak/mahasiswa/profile"));
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
				$this->Master_model->update_query(['nim'=>$id], $data, 'mahasiswa_profile');
				return redirect(base_url("/baak/mahasiswa/profile"));
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
					// 'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
					// 'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
					// 'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
					// 'id_agama' => $this->input->post('id_agama',TRUE),
					// 'nik' => $this->input->post('nik',TRUE),
					// 'kewarganegaraan' => $this->input->post('kewarganegaraan',TRUE),
					// 'alamat' => $this->input->post('alamat',TRUE),
					// 'kelurahan' => $this->input->post('kelurahan',TRUE),
					// 'rt' => $this->input->post('rt',TRUE),
					// 'rw' => $this->input->post('rw',TRUE),
					// 'kode_pos' => $this->input->post('kode_pos',TRUE),
					// 'kecamatan' => $this->input->post('kecamatan',TRUE),
					// 'id_kabupaten_kota' => $this->input->post('id_kabupaten_kota',TRUE),
					// 'id_jenis_tinggal' => $this->input->post('id_jenis_tinggal',TRUE),
					// 'penerima_kps' => $this->input->post('penerima_kps',TRUE),
					// 'no_kps' => $this->input->post('no_kps',TRUE),
                    'nama_wali' => $this->input->post('nama_wali',TRUE),
                    'nik_wali' => $this->input->post('nik_wali',TRUE),
                    'no_hp_wali' => $this->input->post('no_hp_wali',TRUE),
                    'tempat_lahir_wali' => $this->input->post('tempat_lahir_wali',TRUE),
					'tanggal_lahir_wali' => $this->input->post('tanggal_lahir_wali',TRUE),
					'id_jenjang_pendidikan_wali' => $this->input->post('id_jenjang_pendidikan_wali',TRUE),
					'id_pekerjaan_wali' => $this->input->post('id_pekerjaan_wali',TRUE),
					'id_penghasilan_wali' => $this->input->post('id_penghasilan_wali',TRUE),


				);
				$this->Master_model->update_query(['nim'=>$id], $data, 'mahasiswa_profile');
				return redirect(base_url("/baak/mahasiswa/profile"));
			}

		}
	}



	public function edit_gambar($nim){
		$config['upload_path']          = './assets/img_mahasiswa/';
		$config['allowed_types']        = 'gif|jpg|png';

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('foto'))
		{
				var_dump("error");
				die;
		}
		else
		{
			$data['nama_berkas'] = $this->upload->data("file_name");
			$data2 =array(
				"foto" => $data['nama_berkas']
			);
			$this->Master_model->update_query(['nim'=>$nim],$data2, 'mahasiswa_profile');
			return redirect(base_url("/mahasiswa/profile"));
		}
	}

	

}
