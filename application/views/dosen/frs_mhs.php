
<link href="<?php echo base_url(); ?>assets/themplate/assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet">
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
							<div class="pull-left">
								<h3><img src="<?php echo base_url(); ?>assets/themplate/assets/images/logo-official.png"
										class="light-logo" /> <span class="pull-right"></span><br></h3>
							</div>

						</div>
						<div class="col-md-12">
							<div class="text-center">
								<h2>FRS</h2>
								<form  action="<?php echo base_url('dosen/mahasiswa/frs_mhs_action'); ?>" method="post"> 
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
                                                        <th>Mengulang</th>
                                                        <th>Prasyarat<br>kode-periode ambil (Huruh mutu)</th>
                                                        <th>Action</th>
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
                                                    <td><?php echo $row->ulang ?></td>
													<td><?php $ulang=$this->Master_model->master_result(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'id_matkul'=>$row->id_matkul_prasyarat],'v_frs');

													foreach ($ulang as $rowz) {
														echo $rowz['kode_mata_kuliah']."-".$rowz['periode']." (".$rowz['nilai_huruf'].")";
													};
													?></td>
                                                    <td>
													<input type="hidden" name="id_table[]" value="<?php echo $row->id_trx; ?>"/>
													 <select name="status[]" class="form-control" >
												            <option <?php if($row->status_frs=="tolak"){ echo 'selected=""'; } ?> value="tolak"> Tolak</option>
												            <option <?php if($row->status_frs=="pilih" or $row->status_frs=="setujui" ){ echo 'selected=""'; } ?>   value="setujui">setujui</option>
												            <option <?php if($row->status_frs=="kadaluarsa" ){ echo 'selected=""'; } ?>   value="kadaluarsa">kadaluarsa</option>
													</select>
													</td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                    <td colspan="2">Total SKS</td>
                                                    <td></td>
                                                    <td><?php echo $sks_total; ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    
                                                </tr>
                                        </tbody>
                                    </table>
                                   
                                    </div>
						
							
							<div class="text-right">
							<input type="hidden" name="periode" value="<?php echo $periode ?>"/>
							<input type="hidden" name="nim" value="<?php echo $mahasiswa->nim; ?>"/>
							
							<button  class="btn btn-danger" type="submit"><i class="icon-save"></i> Update Respon</button>
							</form> 
								
								<button id="print" class="btn btn-default btn-outline" type="button"> <span><i
											class="fa fa-print"></i> Print</span> </button>
								<a target='blank' class="btn btn-default" href="<?php echo base_url('dosen/mahasiswa/transkrip_akademik/'.$mahasiswa->nim); ?>">Transkip Akademik</a>
							</div>
						</div>
							
						</div>

				</div>

			</div>

		</div>
		
						
		<form  action="<?php echo base_url('dosen/mahasiswa/mahasiswa_perwalian_add'); ?>" method="post"> 
				Keterangan : 	<br>
					<textarea name="perwalian" id="perwalian" cols="100" rows="5"></textarea>				<button  class="btn btn-danger" type="submit"><i class="icon-save"></i> Simpan</button>
						<input type="hidden" name="periode" value="<?php echo $periode ?>"/>
						<input type="hidden" name="nim" value="<?php echo $mahasiswa->nim; ?>"/>
					</form> 
		
		<table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>	
				<th>Keterangan</th>
				<th>Tanggal</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($mahasiswa_perwalian as $rows){ ?>
				<tr>
					<td><?php echo $rows['keterangan']; ?></td>
					<td><?php echo $rows['input_date']; ?></td>
				</tr>
			<?php } ?>
		</tbody>
		</table>

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
	<script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/switchery/dist/switchery.min.js"></script>
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
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                $('.js-switch').each(function() {
                    new Switchery($(this)[0], $(this).data());
                });
		});

	</script>
 