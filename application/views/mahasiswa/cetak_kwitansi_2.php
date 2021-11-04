<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Penaguhan</title>
    
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
  <style>
      body{
          font-size: 10px !important;
         
      };
      tr{
          height: 10px !important;
      }
     @media print {
        @page {
            size: A5 landscape;
        }
    }

  </style>

<body>

<div class="page-wrapper"  style="opacity: 2;">
	<!-- ============================================================== -->
	<!-- Container fluid  -->
	<!-- ============================================================== -->
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
        
		</div>
        <div class="card card-block printableArea" id="content2" >
       

		<!-- ============================================================== -->
		<!-- End Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<!-- Row -->

        <table width="100%"  >
            <tr>
                <td width="30%" style="text-align:center !important" ><img   src="<?php echo base_url('assets/logo_rosma_kw_100.png');  ?>" alt="Logo"></td>
               
                <h2>Bebas Penaguhan : <?php echo $data_masters[0]->nama_penaguhan; ?> /<?php echo $data_masters[0]->jenis_penaguhan; ?> </h2></td>
            </tr>
        </table>
        <hr>

        <table width="100%" border="1"  class="display nowrap table"  >
                                <tr>
                                    <td width="15%" >Nim</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $data_masters[0]->nim;; ?></td>
                                   
                                    <td width="15%" >Tanggal Trx</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo date('d M Y'); ?></td>
                                </tr>
                                <tr>
                                    <td width="15%" >Nama</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $data_masters[0]->nama; ?></td>
                                    <td width="15%">Periode</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $data_masters[0]->periode; ?></td>
                                </tr>
                                <tr>
                                    <td width="15%" >Prodi</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $data_masters[0]->nama_program_studi; ?></td>
                                </tr>
                               
                            </table>
                            
                            </div>
                                    <button id="print" class="btn btn-default btn-outline" class="btn btn-success waves-effect waves-light" ><span><i
											class="fa fa-print"></i> Print</span></button>
                                    </div>
                           
    

	<!-- Row -->
	<!-- ============================================================== -->
	<!-- End PAge Content -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Right sidebar -->
	<!-- ============================================================== -->
	<!-- .right-sidebar -->
	<script src="<?php echo base_url(); ?>assets/themplate/horizontal/js/jquery.PrintArea.js" type="text/JavaScript">
	</script>
	<script>
		$(document).ready(function () {
			$("#print").click(function () {
				var mode = 'iframe'; //popup
				var close = mode == "popup";
				var options = {
					mode: mode,
					popClose: close
				};
				$("div.printableArea").printArea(options);
			});
		});

	</script>

    
</body>
</html>