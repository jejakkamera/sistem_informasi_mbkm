<?php (! defined('BASEPATH')) and exit('No direct script access allowed');

//class Master_lib extends Master_control {
class Feeder_lib  {
    private $_ci;
    public function __construct()
    {
        $this->_ci = & get_instance();

    }

    public function deskripsi($kode_pt=''){

        if($kode_pt){
            $data=$kode_pt;
        }else{
            //$data=$this->_ci->crud->all('dikti_pt')->row();
            $data=$this->_ci->Master_model->master_get(['kode_pt'=>'043139'],'dikti_pt');
        }
        
        $url='http://'.$data->url.':'.$data->port.'/';
        if($data->live=='live'){
            $sub_url='ws/live2.php';
        }else{
            $sub_url='ws/sanbox2.php';
        }
        $url=$url.$sub_url;

        $deskripsi=array(
            'url'=>$url,
            'data_pt'=>$data
        );
        return $deskripsi;
    }

    public function send_ws($data,$url){

        $options = array(
            'http' => array(
            'header'  => "Content-type: application/json",
            'method'  => 'POST',
            'content' => ($data),
        )
        );
        $context  = stream_context_create($options);


        if (!$data = file_get_contents($url, false, $context)) {
        $error = error_get_last();
        // echo "HTTP request failed. Error was: ";
        // print_r($error);
        }else{
            $data_json=json_decode($data);
            if($data_json->error_code==0){
                $data_feeder=$data_json->data;
                return [
                    'error_code'=>$data_json->error_code,
                    'data'=>$data_feeder
                ];
            }elseif($data_json->error_code==100){
                
                return [
                    'error_code'=>$data_json->error_code,
                    'error_desc'=>'error code ['.$data_json->error_code.'] : '.$data_json->error_desc.', <strong>Solution : Please check feeder PT connection</strong>',
                ];
            }else{
              
                return [
                    'error_code'=>$data_json->error_code,
                    'error_desc'=>'error code ['.$data_json->error_code.'] : '.$data_json->error_desc,
                ];
            }
        }
    }


    public function send_ws_retrun($data,$url){

        $options = array(
            'http' => array(
            'header'  => "Content-type: application/json",
            'method'  => 'POST',
            'content' => ($data),
        )
        );
        $context  = stream_context_create($options);


        if (!$data = @file_get_contents($url, false, $context)) {
        $error = error_get_last();
        echo "HTTP request failed. Error was: ";
        print_r($error);
        }else{
            $data_json=json_decode($data);
            return $data_json;
            
        }
    }

}