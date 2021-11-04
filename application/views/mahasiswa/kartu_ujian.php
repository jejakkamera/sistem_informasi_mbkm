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
			<div class="col-md-12">
				<div class="card card-block printableArea">

					<hr>
					<div class="row">
						<div class="col-md-12">
						<table width="100%"  >
							<tr>
								<td width="30%" style="text-align:right !important" ><img   src="<?php echo base_url('assets/logo_rosma_kw_100.png');  ?>" alt="Logo"></td>
								<td width="40%" style="text-align:center !important"><h2>Kartu Ujian</h2></td>
								<td width="30%" style="text-align:left !important">Form-STMIK-BAAK/KU</td>
								
							</tr>
						</table>
							<hr>

						</div>
						<div class="col-md-12">
							<div class="text-center">
								<h2>KARTU Ujian</h2>
								<h4><?= $type ?></h4>
								<hr>

							</div>
						</div>
						<div class="col-md-12">
							<div class="table-responsive m-t-40" style="clear: both;">
								<table class="table table-hover">
									<thead>
										<tr>
											<th class="text-center">Kode Mk</th>
											<th class="text-center">Nama MK</th>
											<th class="text-center">Sks</th>
											<th class="text-center">Semester</th>
											<th class="text-center">Tanggal</th>
											<th class="text-center">Kelas</th>
											<th class="text-center">TTD</th>
										</tr>
									</thead>
									<tbody>
                                    <?php foreach($kurikulum as $row){ ?>
                                        <tr>
                                            <td><?php echo $row->kode_mata_kuliah; ?></td>
                                            <td><?php echo $row->nama_mata_kuliah ?></td>
											<td><?php echo $row->sks_mata_kuliah;?></td>
											<td><?php echo $row->semester ?></td>
											
											<td></td>
											<td></td>
                                                    
											<td>

											</td>

										</tr>
                                    <?php } ?>
										
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