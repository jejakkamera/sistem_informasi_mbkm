<?php
class Master_model extends CI_Model{//baku
	function __construct()
	{
		parent::__construct();
        $this->db = $this->load->database('default', TRUE);

    }
    
    function ms_list($where,$tabel)
    {
        $this->db->where($where);
        $this->db->order_by('urut','ASC');
        return $this->db->get($tabel)->result_array();
    }
    
    function master_result($where,$tabel)
    {
        $this->db->where($where);
        return $this->db->get($tabel)->result_array();
    }

    function master_result_order_asc($where,$tabel,$order)
    {
        $this->db->where($where);
        $this->db->order_by($order,'ASC');
        return $this->db->get($tabel)->result_array();
    }

    function master_result_order_desc($where,$tabel,$order)
    {
        $this->db->where($where);
        $this->db->order_by($order,'desc');
        return $this->db->get($tabel)->result_array();
    }

    function master_result_($where,$tabel)
    {
        $this->db->where($where);
        return $this->db->get($tabel)->result();
    }

    function master_result_like($where,$tabel)
    {
        $this->db->like($where);
        return $this->db->get($tabel)->result_array();
    }
    
    function master_get($where_,$nama_tabel)
    {
        $this->db->where($where_);
        return $this->db->get($nama_tabel)->row();
    }

    function master_get_max($where_,$nama_tabel,$column)
    {
        $this->db->select_max($column);
        $this->db->where($where_);
        return $this->db->get($nama_tabel)->row();
    }

    function delete_query($where_array, $nama_tabel)
    {
        $this->db->where($where_array);
        $this->db->delete($nama_tabel);
    }

    function truncate_query( $nama_tabel)
    {
        $this->db->truncate($nama_tabel);
    }

    function insert_query($nm_table,$data)
	{
		$this->db->insert($nm_table, $data);
    }

    function insert_batch_query($nm_table,$data)
	{
		$this->db->insert_batch($nm_table, $data);
    }

    function insert_query_retrun_id($nm_table,$data)
	{
        $this->db->insert($nm_table, $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;

    }
    
    function insert_batch($nm_table,$data)
	{
        $this->db->insert_batch($nm_table, $data);

    }
    
    function update_query($where_array, $data, $nama_tabel)
    {
        $this->db->where($where_array);
        $this->db->update($nama_tabel, $data);
    }
    
    function update_get_result($where_array, $data, $nama_tabel)
    {
        $this->db->where($where_array);
        $update =$this->db->update($nama_tabel, $data);
        //return $update;
        if($update)
        {
            return true;
        }
        else
        {
           return false;
        }
    }

    public function cek_akses($module,$level,$method){
        $this->db->select('*');
        $this->db->from('access_user');
        $this->db->where('access_user.level',$level);
        $this->db->where('module',$module);

        $query=$getData=$this->db->get();
    
            if($getData->num_rows() > 0)
    
            return $query->row($method);
    
    else 
    
            return null;
    }

    public function insert_history($aksi,$tabel,$data)
    {

		$data=array(
			'aksi'=>$aksi,
			'tabel'=>$tabel,
			'data'=>$data,
			'user_id'=>$this->session->userdata('username'),
			'detail_user'=>$this->user_cek_ident(),
		);
		$this->insert_query('histori_',$data);

    }
    public function random_text($kode='')
    {

        $random=$kode.date('Ymdhsi').rand(1000,9999);
        return $random;

    }
    
    public function user_cek_ident()
	{
		$this->load->library('user_agent');
		
		if ($this->agent->is_browser())
		{
				$agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
				$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
				$agent = $this->agent->mobile();
		}
		else
		{
				$agent = 'Unidentified User Agent';
		}
		$name_pc=gethostbyaddr($_SERVER['REMOTE_ADDR']); //echo "<br>";          
		$browser_use=$agent." "; //echo "<br>";
		$ip_addres=$this->input->ip_address(); //echo "<br>";
		$oprating_sistem=$this->agent->platform(); //echo "<br>";
		date_default_timezone_set("Asia/Bangkok"); 
		$datetime=date('Y-m-d H:s:i'); //echo "<br>"; 

		$username=$this->session->userdata('username'); //echo "<br>"; 
		$name=$this->session->userdata('role'); //echo "<br>"; 
		//$bagian=$this->session->userdata('bagian'); //echo "<br>"; 

		return $name_pc." ".$browser_use." ".$ip_addres." ".$oprating_sistem." date : ".$datetime." login Detail : ".$username.",".$name;
    }
    
    public function cek_key($module,$key,$method){
        $this->db->select('*');
        $this->db->from('access_user');
        $this->db->where('access_user.kunci_akses',$key);
        $this->db->where('module',$module);

        $query=$getData=$this->db->get();
    
            if($getData->num_rows() > 0)
    
            return $query->row($method);
    
    else 
    
            return null;
    }

    function trans_start() {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 
    }

    function trans_finish() {
        $this->db->trans_complete(); # Completing transaction

       /*Optional*/

       if ($this->db->trans_status() === FALSE) {
           # Something went wrong.
           $this->db->trans_rollback();
           return FALSE;
       } 
       else {
           # Everything is Perfect. 
           # Committing data to the database.
           $this->db->trans_commit();
           return TRUE;
       }
   }

}
