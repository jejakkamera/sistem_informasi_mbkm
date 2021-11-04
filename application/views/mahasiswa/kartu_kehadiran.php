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
								<td width="40%" style="text-align:center !important"><h2>Kartu Kehadiran</h2></td>
								<td width="30%" style="text-align:left !important">Form-STMIK-BAAK/KH</td>
								
							</tr>
						</table>
							<hr>

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
											<th class="text-center">Cetak</th>
										</tr>
									</thead>
									<tbody>
                                    <?php foreach($kurikulum as $row){ ?>
                                        <tr>
                                            <td><?php echo $row->kode_mata_kuliah; ?></td>
                                            <td><?php echo $row->nama_mata_kuliah ?></td>
                                            <td><?php echo $row->semester ?></td>
                                            <td><?php echo $row->sks_mata_kuliah;?></td>
                                                    
											<td>
												<a href="<?php echo base_url('mahasiswa/perkuliahan/kartu_kehadiran_action_cetak/teori/'.$row->id_trx); ?>" target="_blank" class="btn btn-success">Kehadiran</a>
												<br>
                                                <?php if($row->sks_praktek>0){ ?>
                                                    <a href="<?php echo base_url('mahasiswa/perkuliahan/kartu_kehadiran_action_cetak/praktikum/'.$row->id_trx); ?>" class="btn btn-warning mt-2">Praktikum</a>
                                                <?php } ?>
												
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