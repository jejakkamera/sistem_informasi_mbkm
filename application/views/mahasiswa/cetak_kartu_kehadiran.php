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
					<div class="row">
						<div class="col-md-12">
						<table width="100%"  >
							<tr>
								<td width="30%" style="text-align:right !important" ><img   src="<?php echo base_url('assets/logo_rosma_kw_100.png');  ?>" alt="Logo"></td>
								<td width="40%" style="text-align:center !important"><h2>Kartu Kehadiran</h2>Kartu Kehadiran</td>
								<td width="30%" style="text-align:left !important">Form-STMIK-BAAK/KH</td>
								
							</tr>
						</table>
							<hr>

						</div>
					
                            <table width="100%">
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
                                    <td width="15%">Periode</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $periode; ?></td>
                                </tr>
                                <tr>
                                    <td width="15%" >Matakuliah</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $mk->nama_mata_kuliah; ?></td>
                                    <td width="15%">Dosen</td>
                                    <td width="5%">:</td>
                                    <td width="30%">-</td>
                                </tr>
                            </table>
						</div>
						<div class="col-md-12">
							<div >
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                                        <th width='10%'>Pertemuan</th>
                                                        <th width='50%'>Materi</th>
                                                        <th width='15%'>Tanggal</th>
                                                        <th width='25%'>Paraf</th>
                                                        </tr>           
                                        </thead>
                                        
                                          <tbody>
                                            <?php for ($i=1; $i <= 16 ; $i++) { ?>
                                            

                                                <tr>
                                                    <td align='center' ><?php echo $i; ?></td>
                                                    <td align='center' ><?php if($i==8 or $i==16){echo 'Ujian';} ?></td>
                                                    <td align='center' ><?php if($i==8 or $i==16){echo 'Ujian';} ?></td>
                                                    <td align='center' ><?php if($i==8 or $i==16){echo 'Ujian';} ?></td>
                                                </tr>
                                            <?php } ?>
                                          </tbody>
                                    </table>
                                   
                                    </div>
						
							<div class="text-right">
								<button id="print" class="btn btn-default btn-outline" type="button"> <span><i
											class="fa fa-print"></i> Print</span> </button>
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