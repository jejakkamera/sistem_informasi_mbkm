<?php (! defined('BASEPATH')) and exit('No direct script access allowed');
require_once('assets/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

use Dompdf\Options; 
// Reference the Font Metrics namespace 
use Dompdf\FontMetrics; 

class Print_kehadiran{
    public $ci;

    public function __construct(){
        $this->ci =& get_instance();
    }

    public function generate($view,$data = array(),$paper ="A5",$orientation ="portrait"){
        $options = new Options(); 
        $options->set('isPhpEnabled', 'true'); 
        $options->set('isRemoteEnabled', TRUE);
        
        $dompdf = new  Dompdf($options);

 
        
        $html = $this->ci->load->view($view, $data, TRUE);
         $dompdf->loadHtml($html);
         $dompdf->setPaper($paper,$orientation);
         $dompdf->render();
         $canvas = $dompdf->getCanvas();
         // Instantiate font metrics class 
        $fontMetrics = new FontMetrics($canvas, $options);  
        // Get height and width of page 
        $w = $canvas->get_width(); 
        $h = $canvas->get_height(); 
        // Get font family file 
        $imageURL = base_url('assets/logo_rosma_kw_100.png'); 
        $imgWidth = 100; 
        $imgHeight = 100; 
         
        // Set image opacity 
        $canvas->set_opacity(.1); 
         
        // Specify horizontal and vertical position 
        $x = (($w-$imgWidth)/2); 
        $y = (($h-$imgHeight)/2); 
         
        // Add an image to the pdf 
        $canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight); 
        $dompdf->stream("Document.pdf", array("Attachment" => 0));
 
 

 
    }
}