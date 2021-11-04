
<link href="<?php echo base_url(); ?>assets/themplate/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<style>
    .table td, .table th {
    padding: 0.2rem;
     vertical-align: middle;
     
}
* {
    font-size: 11px;
    color: black; 
}

@media print{@page {}}
.col-md-1 {width:8%;  float:left;}
.col-md-2 {width:16%; float:left;}
.col-md-3 {width:25%; float:left;}
.col-md-4 {width:33%; float:left;}
.col-md-5 {width:42%; float:left;}
.col-md-6 {width:50%; float:left;}
.col-md-7 {width:58%; float:left;}
.col-md-8 {width:66%; float:left;}
.col-md-9 {width:75%; float:left;}
.col-md-10{width:83%; float:left;}
.col-md-11{width:92%; float:left;}
.col-md-12{width:100%; float:left;}




</style>
    

<div class="row " style="text-align: center; padding-top: 150px;" >
 
 <div class="col-md-1"></div>
 <div class="col-md-10">
 <p style="text-align: right;">Form-STMIK-BAAK/TRANSKRIP/001 RI</p>
 <H3 style="margin-bottom: -5px;">TRANSKRIP NILAI</H3>

</div>
</div>
<div class="col-md-1"></div>
<br>

                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row" >
                    <div class="col-md-1"></div>
                    <div class="col-md-9">
                    <table class="table table-borderless" width='100%'>
                    <tbody><?php //print_r($data_mhs); ?>
                        <tr>
                            <td width="20%" >NIM</td>
                            <td width="30%" >:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($transkript_data->nim); ?></td>
                            <td width="5%" ></td>
                            <td width="15%" >PROGRAM STUDI</td>
                            <td width="300%" >:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($transkript_data->nama_program_studi); ?></td>
                        </tr>
                        <tr>
                            <td width="20%" >Nama</td>
                            <td width="30%" >:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($transkript_data->nama); ?></td>
                            <td width="5%" ></td>
                            <td width="15%" >JENJANG</td>
                            <td width="300%" >:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($transkript_data->jenjang); ?> (<?php echo strtoupper($transkript_data->nama_jenjang_pendidikan); ?>) </td>
                        </tr>
                        <tr>
                            <td width="20%" >Tempat Lahir</td>
                            <td width="30%" >:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($transkript_data->tempat_lahir); ?>, <?php echo  tgl_indo(date("Y-m-d",strtotime($transkript_data->tanggal_lahir))); ?></td>
                            <td width="5%" ></td>
                            <td width="15%" ></td>
                            <td width="300%" ></b></td>
                        </tr>
                        
                                                
                            </tbody>
                        </table>
                        
                       

                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row" >
                <?php  $total_mk=count($transkript_nilai); $setengah=$total_mk/2;$semester=0;   ?>
                    <div class="col-md-1"></div>
                    <div class="col-md-5"><table  border="1" height="900">
                            <?php 

                            /*if($semester!=$transkript_nilai[$x]['semester']){
                                $semester=$transkript_nilai[$x]['semester'];*/
                                ?>
                            <tr >
                                <td  ><div class="text-center">KODE</div></td>
                                <td  ><div class="text-center">MATAKULIAH</i>
                                </div></td>
                                <td  ><div class="text-center">K</td>
                                <td  ><div class="text-center">HM</td>
                                <td  ><div class="text-center">AM</td>
                                <td  ><div class="text-center">NM</td>
                            </tr >
                                <?php
                            //}

                            for ($x = 0; $x <= $setengah; $x++) {
                            ?>
                                <tr >
                                <td width="5%"><div class="col-md-6 text-left" style="font-size: 11px;"><?php echo $transkript_nilai[$x]['kode_mk']; ?></div></td>
                                <td width="80%" style="font-size: 11px;" > <?php echo $transkript_nilai[$x]['nama_mk']; ?> 
                                
                                </td>
                                    
                                <td width="5%" style="font-size: 11px;"><div class="text-center"><small><?php echo $transkript_nilai[$x]['sks_mk']; ?></small></div> </td>
                                <td width="5%"style="font-size: 11px;"><div class="text-center"><small><?php echo $transkript_nilai[$x]['grade']; ?> </small></div></td>
                                <td width="5%"style="font-size: 11px;"><div class="text-center"><small><?php echo $transkript_nilai[$x]['nilai_grade']; ?> </small></div></td>
                                <td width="5%"style="font-size: 11px;"><div class="text-center"><small><?php echo $transkript_nilai[$x]['nilai_grade']*$transkript_nilai[$x]['sks_mk']; ?> </small></div></td>
                                </tr>
                            <?php  }   ?>
                        </table></div>
                        <div class="col-md-5"><table  border="1" height="900">
                            <?php 
                            /*if($semester!=$transkript_nilai[$x]['semester']){
                                $semester=$transkript_nilai[$x]['semester'];*/
                                ?>
                                     <tr >
                                        <td  ><div class="text-center">KODE</div></td>
                                        <td  ><div class="text-center">MATAKULIAH</i>
                                        </div></td>
                                        <td  ><div class="text-center">K</td>
                                        <td  ><div class="text-center">HM</td>
                                        <td  ><div class="text-center">AM</td>
                                        <td  ><div class="text-center">NM</td>
                                    </tr >
                                <?php
                            //}
                            
                            for ($x ; $x <= $total_mk-1; $x++) {
                            ?>
                                <tr >
                                <td width="5%"><div class="col-md-6 text-left" style="font-size: 11px;"><?php echo $transkript_nilai[$x]['kode_mk']; ?></div></td>
                                <td width="80%" style="font-size: 11px;" > <?php echo $transkript_nilai[$x]['nama_mk']; ?> 
                                
                                </td>
                                    
                                <td width="5%" style="font-size: 11px;"><div class="text-center"><small><?php echo $transkript_nilai[$x]['sks_mk']; ?></small></div> </td>
                                <td width="5%"style="font-size: 11px;"><div class="text-center"><small><?php echo $transkript_nilai[$x]['grade']; ?> </small></div></td>
                                <td width="5%"style="font-size: 11px;"><div class="text-center"><small><?php echo $transkript_nilai[$x]['nilai_grade']; ?> </small></div></td>
                                <td width="5%"style="font-size: 11px;"><div class="text-center"><small><?php echo $transkript_nilai[$x]['nilai_grade']*$transkript_nilai[$x]['sks_mk']; ?> </small></div></td>
                                </tr>
                            <?php  }   ?>

                            
                        </table>
                        
                        </div>
                        
                    <div class="col-md-1"></div>
                </div>

                <div class="row" >
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <table  border="0" width='50%' >
                            <tr >
                                <td  >Keterangan</td>
                                <td  >K</td>
                                <td  >:</td>
                                <td  >Kredit</td>
                            </tr >
                            <tr >
                                <td  ></td>
                                <td  >H</td>
                                <td  >:</td>
                                <td  >Huruf Mutu</td>
                            </tr >
                            <tr >
                                <td  ></td>
                                <td  >AM</td>
                                <td  >:</td>
                                <td  >Angka Mutu</td>
                            </tr >
                            <tr >
                                <td  ></td>
                                <td  >NM</td>
                                <td  >:</td>
                                <td  >Nilai Mutu</td>
                            </tr >
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <table  border="0" width='100%' >
                            <tr >
                                <td  >Jumlah Total SKS</td>
                                <td  >:</td>
                                <td  ><?php echo $transkript_data->total_sks_lulus; ?></td>
                            </tr >
                            <tr >
                                <td  >Indeks Prestasi Kumulatif (IPK)</td>
                                <td  >:</td>
                                <td  ><?php echo $transkript_data->ipk_lulus; ?></td>
                            </tr >
                            <tr >
                                <td  >Tanggal Lulus</td>
                                <td  >:</td>
                                <td  ><?php echo  tgl_indo(date("Y-m-d",strtotime($transkript_data->tanggal_sk))); ?></td>
                            </tr >
                            
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                
                <div class="row" >
                <div class="col-md-1"></div>
                <div class="col-md-3">Judul Skripsi</div>
                <div class="col-md-7">: <?php echo $transkript_data->judul_indo; ?></div>
                <div class="col-md-1"></div>
                </div>  


                <div class="row" >
                    <div class="col-md-1"></div>
                    <div class="col-md-5"></div>
                    <div class="col-md-5">Karawang,<?php echo  tgl_indo(date("Y-m-d",strtotime($transkript_data->tanggal_sk))); ?></div>
                    <div class="col-md-1"></div>
                </div>  
                <div class="row" >
                    <div class="col-md-1"></div>
                    <div class="col-md-5"></div>
                    <div class="col-md-5">Sekolah Tinggi Manajemen Informatika dan Komputer Rosma</div>
                    <div class="col-md-1"></div>
                </div>  
                <div class="row" >
                    <div class="col-md-1"></div>
                    <div class="col-md-5"></div>
                    <div class="col-md-5">Kepala Unit Pengelola Program Studi,</div>
                    <div class="col-md-1"></div>
                </div>  
                <br>
                        <br>
                        <br>
                        <br>
                        <div class="row" >
                    <div class="col-md-1"></div>
                    <div class="col-md-5"></div>
                    <div class="col-md-5"><?php echo $transkript_data->nama_ketua_prodi; ?></div>
                    <div class="col-md-1"></div>
                </div>
              
                <?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>