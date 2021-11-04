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
								<td width="40%" style="text-align:center !important"><h2>Kartu Studi</h2></td>
								<td width="30%" style="text-align:left !important">Form-STMIK-BAAK/KS</td>
								
							</tr>
						</table>
							<hr>

						</div>
						<div class="col-md-12">
							
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
                            </table>
						</div>
						<div class="col-md-12">
							<div >
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                                        <th>Kode MK</th>
                                                        <th>Nama MK</th>
                                                        <th>Semester</th>
                                                        <th>Sks</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $sks_total=0;
                                            foreach($kurikulum as $row){ ?>
                                                <tr>
                                                    <td><?php echo $row->kode_mata_kuliah; ?></td>
                                                    <td><?php echo $row->nama_mata_kuliah ?></td>
                                                    <td><?php echo $row->semester ?></td>
                                                    <td><?php echo $row->sks_mata_kuliah;$sks_total=$sks_total+$row->sks_mata_kuliah; ?></td>
                                                 
                                                    
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                    <td colspan="2">Total SKS</td>
                                                    <td></td>
                                                    <td><?php echo $sks_total; ?></td>
                                                    
                                                </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%">
                                <tr>
                                    <td width="33%"  align='center' >Mengetahui</td>
                                    <td width="33%"  align='center'>Disetejui</td>
                                    <td width="34%"  align='center'>Karawang,<?php echo date('d-m-Y'); ?></td>
                                       </tr>
                                <tr>
								<td width="33%" align='center' >Ketua Program Studi</td>
                                    <td width="33%"  align='center'>Dosen Wali</td>
                                    <td width="34%"  align='center'></td>
                                   </tr>
								   <tr>
								<td width="33%" align='center' > </td>
                                    <td width="33%"  align='center'></td>
                                    <td width="34%"  align='center'>&nbsp</td>
                                   </tr>
								   <tr>
								<td width="33%" align='center' > </td>
                                    <td width="33%"  align='center'></td>
                                    <td width="34%"  align='center'>&nbsp</td>
                                   </tr>
								   <tr>
								<td width="33%" align='center' ><?php echo $info_akademik->nama_k_prodi;?></td>
                                    <td width="33%"  align='center'><?php echo $info_akademik->nama_wali_dosen;?></td>
                                    <td width="34%"  align='center'><?php echo $mahasiswa->nama; ?></td>
                                   </tr>
                            </table>
                                    </div>
							<div class="text-right">
							<a href="<?php echo base_url('/mahasiswa/frs/print/').$periode.'/'.$pengisian_frs ?>"  class="btn btn-default btn-outline" > <span><i
											class="fa fa-print"></i> Print</span> </a>
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