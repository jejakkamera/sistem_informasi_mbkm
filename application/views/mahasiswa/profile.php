<?php foreach ($data_mahasiswa as $data ) { ?>

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
								<h3><img height='200px' src="<?php echo base_url(); ?>assets/mbkm.png"
										class="light-logo" /> <span class="pull-right"></span><br></h3>

							</div>
							<div class="pull-right text-right">
								<address>
									<h3>Universitas Buana perjuangan Karawang,</h3>
									<h4 class="font-bold">Jalan HS. Ronggo Waluyo, Puseurjaya, Telukjambe Timur.</h4>
									<p class="text-muted m-l-30"> Kabupaten Karawang, Jawa Barat 41361<br>
										Telephone: +6285771189715 <br>

								</address>
							</div>

						</div>



						<div class="col-md-12">
							<img class=""
								src="<?php echo base_url().'assets/img_mahasiswa/'.$data->foto ?>"
								alt="..." class="img-thumbnail" width="130" height="170" >

							<div class="text-center">
								<h2>BIODATA <?= $data->nama ?></h2>

							</div>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rubahFoto">
								Rubah Foto Profil
							</button>





						</div>
						<div class="col-md-12">
							<div class="table-responsive m-t-40" style="clear: both;">

								<table class="table ">

									<tbody>
										<tr>
											<td class="text-left">NIM</td>
											<td><?= $data->nim ?>/</td>
										</tr>
										<tr>
											<td class="text-left">Nama Mahasiswa</td>
											<td><?= $data->nama ?></td>
										</tr>
										<tr>
											<td class="text-left">Tempat Lahir</td>
											<td><?= $data->tempat_lahir ?></td>
										</tr>
										<tr>
											<td class="text-left">Tanggal Lahir</td>
											<td><?= $data->tanggal_lahir ?></td>
										</tr>
										<tr>
											<td class="text-left">Program Studi</td>
											<td><?= $data->kode_prodi ?></td>
										</tr>
										<tr>
											<td class="text-left">Jenis Kelamin</td>
											<td><?= $data->jenis_kelamin ?></td>
										</tr>
										<tr>
											<td class="text-left">Agama</td>
											<td><?= $data_mahasiswa_2->nama_agama ?></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
						<div class="col-md-12">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item" role="presentation">
									<a class="nav-link active" id="alamat-tab" data-toggle="tab" href="#alamat"
										role="tab" aria-controls="alamat" aria-selected="true">Alamat</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" id="orang_tua-tab" data-toggle="tab" href="#orang_tua"
										role="tab" aria-controls="orang_tua" aria-selected="false">Orang Tua</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" id="wali-tab" data-toggle="tab" href="#wali" role="tab"
										aria-controls="wali" aria-selected="false">Wali</a>
								</li>

							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="alamat" role="tabpanel"
									aria-labelledby="alamat-tab">
									<div class="table-responsive">
										<table class="table table-striped">
											<tr>
												<td>NIK</td>
												<td><?= $data->nik ?></td>
											</tr>
											<tr>
												<td>Kewarga Negaraan</td>
												<td><?= $data->kewarganegaraan ?></td>
											</tr>
											<tr>
												<td>Jalan</td>
												<td><?= $data->alamat ?></td>
											</tr>
											<tr>
												<td>Desa atau Kelurahan</td>
												<td><?= $data->kelurahan ?></td>
											</tr>
											<tr>
												<td>Rt/Rw</td>
												<td>0<?= $data->rt ?> / 0<?= $data->rw ?></td>
											</tr>
											<tr>
												<td>Kode Pos</td>
												<td><?= $data->kode_pos ?></td>
											</tr>
											<tr>
												<td>Kecamatan</td>
												<td><?= $data_mahasiswa_2->nama_kec ?></td>
											</tr>
											<tr>
												<td>Kabupaten</td>
												<td><?php if( $wilayah){echo $wilayah->nama_kab;}  ?></td>
											</tr>
											<tr>
												<td>provinsi</td>
												<td><?php if( $wilayah){echo $wilayah->nama_prov;}  ?></td>
											</tr>
											<tr>
												<td>Negara</td>
												<td><?php if( $wilayah){  echo $wilayah->id_negara;}  ?></td>
											</tr>
											<tr>
												<td>Jenis Tinggal</td>
												<td><?= $data_mahasiswa_2->nama_jenis_tinggal ?></td>
											</tr>
											<tr>
												<td>Telepon</td>
												<td><?= $data->telepon ?></td>
											</tr>
											<tr>
												<td>E-Mail</td>
												<td><?= $data->email ?></td>
											</tr>
											<tr>
												<td>Penerima KPS</td>
												<td>
													<?php if($data->penerima_kps == 0) : ?>
													Tidak
													<?php else :?>
													Ya
													<?php endif ?>
												</td>
											</tr>
											<tr>
												<td>Nomor KPS</td>
												<td><?= $data->no_kps ?></td>
											</tr>
											<tr>
												<td>NPWP</td>
												<td><?= $data->npwp ?></td>
											</tr>
											<tr>
												<td>Alat Transportasi</td>
												<td><?= $data_mahasiswa_2->nama_alat_transportasi ?></td>
											</tr>
											<tr>
												<td><a class="btn btn-primary mb-3" href="" data-toggle="modal"
														data-target="#exampleModal">Rubah Data</a></td>
											</tr>

										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="orang_tua" role="tabpanel"
									aria-labelledby="orang_tua-tab">
									<div class="table-responsive">
										<table class="table table-striped">
											<tr>
												<td class="font-weight-bold">Ayah</td>
												<td></td>
											</tr>
											<tr>
												<td>Nama</td>
												<td><?= $data->nama_ayah ?></td>
											</tr>
											<tr>
												<td>Nik</td>
												<td><?= $data->nik_ayah ?></td>
											</tr>
											<tr>
												<td>No Hp</td>
												<td><?= $data->no_hp_ayah ?></td>
											</tr>
											<tr>
												<td>Tempat Lahir</td>
												<td><?= $data->tempat_lahir_ayah ?></td>
											</tr>
											<tr>
												<td>Tanggal Lahir</td>
												<td><?= $data->tanggal_lahir_ayah ?></td>
											</tr>
											<tr>
												<td>Pendidikan</td>
												<td><?= $data_ayah->nama_jenjang_didik ?></td>
											</tr>
											<tr>
												<td>Pekerjaan</td>
												<td><?= $data_ayah->nama_pekerjaan ?></td>
											</tr>
											<tr>
												<td>Penghasilan</td>
												<td><?= $data_ayah->nama_penghasilan ?></td>
											</tr>
											<tr>
												<td class="font-weight-bold">Ibu</td>
												<td></td>
											</tr>
											<tr>
												<td>Nama</td>
												<td><?= $data->nama_ibu_kandung ?></td>
											</tr>
											<tr>
												<td>Nik</td>
												<td><?= $data->nik_ibu ?></td>
											</tr>
											<tr>
												<td>No Hp</td>
												<td><?= $data->no_hp_ibu ?></td>
											</tr>
											<tr>
												<td>Tempat Lahir</td>
												<td><?= $data->tempat_lahir_ibu ?></td>
											</tr>
											<tr>
												<td>Tanggal Lahir</td>
												<td><?= $data->tanggal_lahir_ibu ?></td>
											</tr>
											<tr>
												<td>Pendidikan</td>
												<td><?= $data_ibu->nama_jenjang_didik ?></td>
											</tr>
											<tr>
												<td>Pekerjaan</td>
												<td><?= $data_ibu->nama_pekerjaan?></td>
											</tr>
											<tr>
												<td>Penghasilan</td>
												<td><?= $data_ibu->nama_penghasilan?></td>
											</tr>
											<tr>
												<td><a class="btn btn-primary mb-3" href="" data-toggle="modal"
														data-target="#exampleModal2">Rubah Data</a></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="wali" role="tabpanel" aria-labelledby="wali-tab">
									<div class="table-responsive">
										<table class="table table-striped">
											<tr>
												<td class="font-weight-bold">Wali</td>
												<td></td>
											</tr>
											<tr>
												<td>Nama</td>
												<td><?= $data->nama_wali ?></td>
											</tr>
											<tr>
												<td>Nik</td>
												<td><?= $data->nik_wali ?></td>
											</tr>
											<tr>
												<td>No Hp</td>
												<td><?= $data->no_hp_wali ?></td>
											</tr>
											<tr>
												<td>Tempat Lahir</td>
												<td><?= $data->tempat_lahir_wali ?></td>
											</tr>
											<tr>
												<td>Tanggal Lahir</td>
												<td><?= $data->tanggal_lahir_wali ?></td>
											</tr>
											<tr>
												<td>Pendidikan</td>
												<td><?= $data_wali->nama_jenjang_didik ?></td>
											</tr>
											<tr>
												<td>Pekerjaan</td>
												<td><?= $data_wali->nama_pekerjaan ?></td>
											</tr>
											<tr>
												<td>Penghasilan</td>
												<td><?= $data_wali->nama_penghasilan ?></td>
											</tr>
											<tr>
												<td><a class="btn btn-primary mb-3" href="" data-toggle="modal"
														data-target="#exampleModal3">Rubah Data</a></td>
											</tr>

										</table>
									</div>
								</div>


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
	<?php } ?>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Rubah Data Diri</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?php echo base_url(). '/baak/mahasiswa/profile_update/1'; ?>" method="POST">
					<input type="text" name="nim" value="<?= $data->nim ?>" hidden class="form-control">
					<div class="modal-body px-0">
						<div style="overflow-y: hidden; height: calc(100vh - 15rem);">
							<div class="px-2" style="overflow-y: auto; height: 100%;">
								<div class="form-group">
									<label for="nik">Kecamatan</label>
									<br>
									<select class="js-example-basic-single select2 " style="width: 200px;"
										name="kecamatan">
										<option value="<?= $data_mahasiswa_2->id_kec ?>" selected>
											<?= $data_mahasiswa_2->nama_kec ?></option>
									</select>
								</div>

								<div class="form-group">
									<label for="nik">NIK</label>
									<input type="text" name="nik" value="<?= $data->nik ?>" class="form-control">
								</div>

								<div class="form-group">
									<label for="jenis_kelamin">Jenis Kelamin</label>
									<select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
										<option value="L" <?php if($data->jenis_kelamin === "L") { ?>selected <?php }?>>
											Laki-laki</option>
										<option value="P" <?php if($data->jenis_kelamin === "P") { ?>selected <?php }?>>
											Perempuan</option>
									</select>
								</div>

								<div class="form-group">
									<label for="Kewarganegaraan">Kewarganegaraan</label>
									<select class="form-control" id="Kewarganegaraan" name="kewarganegaraan">
										<option value="WNI" <?php if($data->kewarganegaraan === "WNI") { ?>selected
											<?php }?>>WNI</option>
										<option value="WNA" <?php if($data->kewarganegaraan === "WNA") { ?>selected
											<?php }?>>WNA</option>
									</select>
								</div>

								<div class="form-group">
									<label for="tempat_lahir">Tempat Lahir</label>
									<input type="text" name="tempat_lahir" value="<?= $data->tempat_lahir ?>"
										class="form-control">
								</div>

								<div class="form-group">
									<label for="tanggal_lahir">Tanggal Lahir</label>
									<input type="date" name="tanggal_lahir" value="<?= $data->tanggal_lahir ?>"
										class="form-control">
								</div>



								<div class="form-group">
									<label for="id_agama">Agama</label>
									<select name="id_agama" class="form-control">
										<?php foreach($agama as $item) { ?>
										<option value="<?= $item['id_agama'] ?>"
											<?php if($data->id_agama === $item['id_agama']) { ?>selected <?php }?>>
											<?= $item['nama_agama'] ?></option>

										<?php }; ?>
									</select>
								</div>

								<div class="form-group">
									<label for="jalan">Jalan</label>
									<input type="text" value="<?= $data->alamat ?>" name="alamat" class="form-control">
								</div>

								<div class="form-group">
									<label for="desa">Desa/Kelurahan</label>
									<input type="text" name="kelurahan" value="<?= $data->kelurahan ?>"
										class="form-control">
								</div>

								<div class="form-group">
									<label for="rt">Rt</label>
									<input type="text" class="form-control" value="<?= $data->rt ?>" name="rt">
								</div>

								<div class="form-group">
									<label for="Rw">Rw</label>
									<input type="text" class="form-control" value="<?= $data->rw ?>" name="rw">
								</div>

								<div class="form-group">
									<label for="Kode_pos">Kode Pos</label>
									<input type="text" class="form-control" value="<?= $data->kode_pos ?> "
										name="kode_pos">
								</div>



								<div class="form-group">
									<label for="id_jenis_tinggal">Jenis Tinggal</label>
									<select name="id_jenis_tinggal" class="form-control">
										<?php foreach($jenis_tinggal as $item) { ?>
										<option value="<?= $item['id_jenis_tinggal'] ?>"
											<?php if($data->id_jenis_tinggal === $item['id_jenis_tinggal']) { ?>selected
											<?php }?>>
											<?= $item['nama_jenis_tinggal'] ?></option>

										<?php }; ?>
									</select>
								</div>

								<div class="form-group">
									<label for="telepon">telepon</label>
									<input type="text" class="form-control" value="<?= $data->telepon ?>"
										name="telepon">
								</div>
								<div class="form-group">
									<label for="penerima_kps">Penerima KPS</label>
									<select name="penerima_kps" class="form-control">
										<option value="1" <?php if($data->penerima_kps === "1") { ?>selected <?php }?>>
											Ya</option>
										<option value="0" <?php if($data->penerima_kps === "0") { ?>selected <?php }?>>
											Tidak</option>
									</select>
								</div>
								<div class="form-group">
									<label for="no_kps">Nomor Kps</label>
									<input type="text" class="form-control" value="<?= $data->no_kps ?>" name="no_kps">
								</div>
								<div class="form-group">
									<label for="npwp">NPWP</label>
									<input type="text" class="form-control" value="<?= $data->npwp ?>" name="npwp">
								</div>

								<div class="form-group">
									<label for="id_alat_transportasi">Alat Transportasi</label>
									<select name="id_alat_transportasi" class="form-control">
										<?php foreach($transportasi as $item) { ?>
										<option value="<?= $item['id_alat_transportasi'] ?>"
											<?php if($data->id_alat_transportasi === $item['id_alat_transportasi']) { ?>selected
											<?php }?>>
											<?= $item['nama_alat_transportasi'] ?></option>

										<?php }; ?>
									</select>
								</div>



							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button class="btn btn-primary" type="submit" value="simpan">Simpan</button>
				</form>
			</div>

		</div>
	</div>
</div>



<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModal2Label">Rubah Data Orang Tua</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body px-0">
				<div style="overflow-y: hidden; height: calc(100vh - 15rem);">
					<div class="px-2" style="overflow-y: auto; height: 100%;">
						<form action="<?php echo base_url(). '/baak/mahasiswa/profile_update//2'; ?>" method="POST">
							<input type="text" name="nim" value="<?= $data->nim ?>" hidden class="form-control">
							<div class="form-group">
								<label for="nama_ayah">Nama Ayah</label>
								<input type="text" name="nama_ayah" value="<?= $data->nama_ayah ?>" class="form-control"
									id="nama_ayah">
							</div>

							<div class="form-group">
								<label for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
								<input type="date" name="tanggal_lahir_ayah" value="<?= $data->tanggal_lahir_ayah ?>"
									class="form-control" id="tanggal_lahir_ayah">
							</div>

							<div class="form-group">
								<label for="nik_ayah">NIK Ayah</label>
								<input type="text" name="nik_ayah" value="<?= $data->nik_ayah ?>" class="form-control"
									id="nik_ayah">
							</div>

							<div class="form-group">
								<label for="no_hp_ayah">No Hp Ayah</label>
								<input type="text" name="no_hp_ayah" value="<?= $data->no_hp_ayah ?>"
									class="form-control" id="no_hp_ayah">
							</div>

							<div class="form-group">
								<label for="tempat_lahir_ayah">Tempat Lahir Ayah</label>
								<input type="text" name="tempat_lahir_ayah" value="<?= $data->tempat_lahir_ayah ?>"
									class="form-control" id="tempat_lahir_ayah">
							</div>

							<div class="form-group">
								<label for="id_jenjang_pendidikan_ayah">Jenjang Pendidikan Ayah</label>
								<select name="id_jenjang_pendidikan_ayah" class="form-control id_jenjang_pendidikan">
									<?php foreach($jenjang_pendidikan as $item) { ?>
									<option <?php if($item['id_jenjang_didik'] == $data_ayah->id_jenjang_didik) : ?>
										selected <?php endif;  ?> value="<?= $item['id_jenjang_didik'] ?>">
										<?= $item['nama_jenjang_didik'] ?></option>
									<?php }; ?>
								</select>
							</div>

							<div class="form-group">
								<label for="id_pekerjaan_ayah">Pekerjaan Ayah</label>
								<select name="id_pekerjaan_ayah" class="form-control id_pekerjaan">
									<?php foreach($pekerjaan as $item) { ?>
									<option <?php if($item['id_pekerjaan'] == $data_ayah->id_pekerjaan) : ?> selected
										<?php endif;  ?> value="<?= $item['id_pekerjaan'] ?>">
										<?= $item['nama_pekerjaan'] ?></option>
									<?php }; ?>
								</select>
							</div>

							<div class="form-group">
								<label for="id_penghasilan_ayah">Penghasilan Ayah</label>
								<select name="id_penghasilan_ayah" class="form-control id_penghasilan">
									<?php foreach($penghasilan as $item) { ?>
									<option <?php if($item['id_penghasilan'] == $data_ayah->id_penghasilan) : ?>
										selected <?php endif;  ?> value="<?= $item['id_penghasilan'] ?>">
										<?= $item['nama_penghasilan'] ?></option>
									<?php }; ?>
								</select>
							</div>

							<div class="form-group">
								<label for="nama_ibu_kandung">Nama Ibu Kandung</label>
								<input type="text" name="nama_ibu_kandung" value="<?= $data->nama_ibu_kandung ?>"
									class="form-control" id="nama_ibu_kandung">
							</div>

							<div class="form-group">
								<label for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
								<input type="date" name="tanggal_lahir_ibu" value="<?= $data->tanggal_lahir_ibu ?>"
									class="form-control" id="tanggal_lahir_ibu">
							</div>

							<div class="form-group">
								<label for="nik_ibu">NIK Ibu</label>
								<input type="text" name="nik_ibu" value="<?= $data->nik_ibu ?>" class="form-control"
									id="nik_ibu">
							</div>

							<div class="form-group">
								<label for="no_hp_ibu">Nomor Hp Ibu</label>
								<input type="text" name="no_hp_ibu" value="<?= $data->no_hp_ibu ?>" class="form-control"
									id="no_hp_ibu">
							</div>

							<div class="form-group">
								<label for="tempat_lahir_ibu">Tempat Lahir ibu</label>
								<input type="text" name="tempat_lahir_ibu" value="<?= $data->tempat_lahir_ibu ?>"
									class="form-control" id="tempat_lahir_ibu">
							</div>



							<div class="form-group">
								<label for="id_jenjang_pendidikan_ibu">jenjang pendidikan ibu</label>
								<select name="id_jenjang_pendidikan_ibu" class="form-control id_jenjang_pendidikan">
									<?php foreach($jenjang_pendidikan as $item) { ?>
									<option <?php if($item['id_jenjang_didik'] == $data_ibu->id_jenjang_didik) : ?>
										selected <?php endif;  ?> value="<?= $item['id_jenjang_didik'] ?>">
										<?= $item['nama_jenjang_didik'] ?></option>
									<?php }; ?>
								</select>
							</div>

							<div class="form-group">
								<label for="id_pekerjaan_ibu">pekerjaan ibu</label>
								<select name="id_pekerjaan_ibu" class="form-control id_pekerjaan">
									<?php foreach($pekerjaan as $item) { ?>
									<option <?php if($item['id_pekerjaan'] == $data_ibu->id_pekerjaan) : ?> selected
										<?php endif;  ?> value="<?= $item['id_pekerjaan'] ?>">
										<?= $item['nama_pekerjaan'] ?></option>
									<?php }; ?>
								</select>
							</div>

							<div class="form-group">
								<label for="id_penghasilan_ibu">penghasilan ibu</label>
								<select name="id_penghasilan_ibu" class="form-control id_penghasilan">
									<?php foreach($penghasilan as $item) { ?>
									<option <?php if($item['id_penghasilan'] == $data_ibu->id_penghasilan) : ?> selected
										<?php endif;  ?> value="<?= $item['id_penghasilan'] ?>">
										<?= $item['nama_penghasilan'] ?></option>
									<?php }; ?>
								</select>
							</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" value="simpan1" class="btn btn-primary">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModal3Label">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url(). '/baak/mahasiswa/profile_update//3'; ?>" method="POST">
					<input type="text" name="nim" value="<?= $data->nim ?>" hidden class="form-control">
					<div class="form-group">
						<label for="nama_wali">Nama Wali</label>
						<input type="text" name="nama_wali" value="<?= $data->nama_wali ?>" class="form-control"
							id="nama_wali">
					</div>



					<div class="form-group">
						<label for="nik_wali">NIK Wali</label>
						<input type="text" name="nik_wali" value="<?= $data->nik_wali ?>" class="form-control"
							id="nik_wali">
					</div>

					<div class="form-group">
						<label for="no_hp_wali">No Hp Wali</label>
						<input type="text" name="no_hp_wali" value="<?= $data->no_hp_wali ?>" class="form-control"
							id="no_hp_wali">
					</div>

					<div class="form-group">
						<label for="tempat_lahir_wali">Tempat Lahir Wali</label>
						<input type="text" name="tempat_lahir_wali" value="<?= $data->tempat_lahir_wali ?>"
							class="form-control" id="tempat_lahir_wali">
					</div>

					<div class="form-group">
						<label for="tanggal_lahir_wali">Tanggal Lahir Wali</label>
						<input type="date" name="tanggal_lahir_wali" value="<?= $data->tanggal_lahir_wali ?>"
							class="form-control" id="tanggal_lahir_wali">
					</div>

					<div class="form-group">
						<label for="id_jenjang_pendidikan_wali"> Jenjang pendidikan wali</label>
						<select name="id_jenjang_pendidikan_wali" class="form-control id_jenjang_pendidikan2">
							<?php foreach($jenjang_pendidikan as $item) { ?>
							<option <?php if($item['id_jenjang_didik'] == $data_wali->id_jenjang_didik) : ?> selected
								<?php endif;  ?> value="<?= $item['id_jenjang_didik'] ?>">
								<?= $item['nama_jenjang_didik'] ?></option>
							<?php }; ?>
						</select>
					</div>

					<div class="form-group">
						<label for="id_pekerjaan_wali"> pekerjaan wali</label>
						<select name="id_pekerjaan_wali" class="form-control id_pekerjaan2">
							<?php foreach($pekerjaan as $item) { ?>
							<option <?php if($item['id_pekerjaan'] == $data_wali->id_pekerjaan) : ?> selected
								<?php endif;  ?> value="<?= $item['id_pekerjaan'] ?>"><?= $item['nama_pekerjaan'] ?>
							</option>
							<?php }; ?>
						</select>
					</div>

					<div class="form-group">
						<label for="id_penghasilan_wali">penghasilan wali</label>
						<select name="id_penghasilan_wali" class="form-control id_penghasilan2">
							<?php foreach($penghasilan as $item) { ?>
							<option <?php if($item['id_penghasilan'] == $data_wali->id_penghasilan) : ?> selected
								<?php endif;  ?> value="<?= $item['id_penghasilan'] ?>"><?= $item['nama_penghasilan'] ?>
							</option>
							<?php }; ?>
						</select>
					</div>




			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>




<!-- foto -->
<div class="modal fade" id="rubahFoto" tabindex="-1" aria-labelledby="rubahFotoLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="rubahFotoLabel">Rubah Foto Profil</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
						<?php echo form_open_multipart( base_url().'mahasiswa/profile/edit_gambar/'.$data->nim);?>
					<div class="form-group">
						<label for="foto">foto</label>
						<input type="file" name="foto" value="<?= $data->foto ?>" class="form-control"
							id="foto">
					</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button  type="submit" class="btn btn-primary">Save changes</button>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function () {
		$(".js-example-basic-single").select2({
			width: '100%',
			dropdownParent: $("#exampleModal")
		});
	});

</script>

<script type="text/javascript">
	$(document).ready(function () {
		$('.js-example-basic-single').select2({
			width: '100%',
			minimumInputLength: 3,
			dropdownParent: $("#exampleModal"),
			placeholder: 'Masukan Kecamatan Anda...',
			ajax: {
				url: '<?= base_url() ?>baak/mahasiswa/cariKec',
				type: 'post',
				dataType: 'json',
				delay: 250,
				data: function (param) {
					return {
						searchTerm: param.term

					}
				},
				processResults: function (data) {
					return {
						results: $.map(data, function (item) {
							return {
								text: item.nama_wilayah,
								id: item.id_kec
							}
						})
					};
				},

				cache: true
			}
		});
	});

</script>

<script>
	$(document).ready(function () {
		$('.id_jenjang_pendidikan').select2({
			width: '100%',
			dropdownParent: $("#exampleModal2"),
		});
	});

</script>

<script>
	$(document).ready(function () {
		$('.id_pekerjaan').select2({
			width: '100%',
			dropdownParent: $("#exampleModal2"),
		});
	});

</script>

<script>
	$(document).ready(function () {
		$('.id_penghasilan').select2({
			width: '100%',
			dropdownParent: $("#exampleModal2"),
		});
	});

</script>

<script>
	$(document).ready(function () {
		$('.id_jenjang_pendidikan2').select2({
			width: '100%',
			dropdownParent: $("#exampleModal3"),
		});
	});

</script>

<script>
	$(document).ready(function () {
		$('.id_pekerjaan2').select2({
			width: '100%',
			dropdownParent: $("#exampleModal3"),
		});
	});

</script>

<script>
	$(document).ready(function () {
		$('.id_penghasilan2').select2({
			width: '100%',
			dropdownParent: $("#exampleModal3"),
		});
	});

</script>
