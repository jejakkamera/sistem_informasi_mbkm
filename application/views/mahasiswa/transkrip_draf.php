<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Container fluid  -->
	<!-- ============================================================== -->
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
		</div>
		<!-- ============================================================== -->
		<!-- End Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<!-- Row -->
		<div class="row">
		<button id="print" class="btn btn-default btn-outline" class="btn btn-success waves-effect waves-light" ><span><i
											class="fa fa-print"></i> Print</span></button>
			|| <a href="<?php echo base_url('baak/mahasiswa/transkrip_akademik/').$nim ?>" class="btn btn-success waves-effect waves-light" ><span><i
											class="fa fa-book"></i> Hasil Studi</span></a>
											<div class="col-md-12">
				<div class="card card-block printableArea">

								
					<hr>
					<div class="row">
						
						<div class="col-md-12">
						<table width="100%"  >
							<tr>
								<td width="30%" style="text-align:right !important" ><img   src="<?php echo base_url('assets/logo_rosma_kw_100.png');  ?>" alt="Logo"></td>
								<td width="40%" style="text-align:center !important"><h2>Draf Transkript</h2></td>
								<td width="30%" style="text-align:left !important">Form-STMIK-BAAK/Draf</td>
								
							</tr>
						</table>
						<hr>
                            <table width="100%" >
                                <tr>
                                    <td width="15%" >Nim</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $mahasiswa->nim; ?></td>
                                    <td width="15%" >Program Studi</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $mahasiswa->nama_jenjang_pendidikan; ?> - <?php echo $mahasiswa->nama_program_studi; ?></td>
                                </tr>
                                <tr>
                                    <td width="15%" >Nama</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $mahasiswa->nama; ?></td>
                                    <td width="15%">Tanggal Cetak</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo date('d-F-Y'); ?></td>
                                </tr>
                            </table>
						</div>
						<div class="col-md-12">
							<div class="table-responsive m-t-40" style="clear: both;">
								<table class="table table-hover">
									<thead>
										<tr>
											<!-- <th class="text-center">Periode</th> -->
											<th class="text-center">Kode Mk</th>
											<th class="text-center">Nama MK</th>
											<th class="text-center">Semester</th>
											<th class="text-center">Sks</th>
											<th class="text-center">Nilai Angka</th>
											<th class="text-center">Nilai Huruf</th>
											<th class="text-center">Nilai Index</th>
											<th class="text-center">Nilai Kumulatif</th>
                                            <?php if($status=='hasil_studi'){ ?>
											<th class="text-center">Cetak</th>
                                            <?php } ?>
										</tr>
									</thead>
									<tbody>
                                    <?php 
                                    $total_sks=0;
                                    $total_kumulatif=0;
                                    $total_sks_semester=0;
                                    $total_kumulatif_semester=0;
									$periode_lalu='';
									foreach($kurikulum as $row){ 
										
									 ?>

                                        <tr>
                                            <td><?php echo $row['kode_mata_kuliah']; ?></td>
                                            <td><?php echo $row['nama_mata_kuliah'] ?></td>
                                            <td class="text-center"><?php echo $row['semester'] ?></td>
											<td class="text-center"><?php echo $row['sks_mata_kuliah'];
											$total_sks=$total_sks+$row['sks_mata_kuliah'];
											?></td>
                                            <td class="text-center"><?php echo number_format($row['max_nilai_total'],2);?></td>
                                            <td class="text-center"><?php echo $row['nilai_huruf'];?></td>
                                            <td class="text-center"><?php echo $row['max_nilai_index'];?></td>
											<td class="text-center"><?php echo $row['max_nilai_kumulatif'];
											$total_kumulatif=$total_kumulatif+$row['max_nilai_kumulatif'];
											?></td>
                                            <?php if($status=='hasil_studi'){ ?>       
											<td>
												<button type="button" class="btn btn-primary" data-toggle="modal"  data-person-id_trx="<?php echo $row->id_trx;?>" data-person-mk="<?php echo $row->nama_mata_kuliah; ?>" data-target="#personInfo">Detail Nilai</button>

											</td>
                                            <?php } ?>
										</tr>
									<?php 
									} ?>
										
											<tr>
												<td colspan='2' class="text-center"></td>
												
												<td colspan='2' class="text-center" >SKS : <?php echo  number_format($total_sks,2); ?></td>
												<td colspan='3' class="text-center" >Kumulatif: <?php echo  number_format($total_kumulatif,2); ?></td>
												<td colspan='2' class="text-center" >IPK : <?php echo   number_format($total_kumulatif/$total_sks,2); ?></td>
											</tr>
                                        
									</tbody>
								</table>
                                
                                </div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
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
						<div class="row">
							<div class="col-md-12">
								<div class="modal fade bs-example-modal-lg" id="personInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Detail Nilai</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                loading
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
								
<script>
    /* must apply only after HTML has loaded */
    $(document).ready(function () {
        $('#personInfo').on('show.bs.modal', function(e) {
            /* get data written in data-person-name field*/ 
            var personid_trx = $(e.relatedTarget).data('person-id_trx');
            var mk = $(e.relatedTarget).data('person-mk');
            var Nim = '<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"> Detail Nilai : '+mk+'</h4>';
            /* append that to form our service url */
            $.get('<?php echo site_url(); ?>mahasiswa/perkuliahan/hasil_studi_detail/' + personid_trx, function( data ) {
                $('#personInfo .modal-body').html(data);
                $('#personInfo .modal-header').html(Nim);
              });
        });
    });
</script>

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