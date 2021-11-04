


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
				<div class="card card-block printableArea" id="content2">

					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="pull-left">

							</div>

						</div>
						<div class="col-md-12 ">
                        <table width="100%"  >
							<tr>
								<td width="30%" style="text-align:right !important" ><img   src="<?php echo base_url('assets/logo_rosma_kw_100.png');  ?>" alt="Logo"></td>
								<td width="40%" style="text-align:center !important"><h2>FRS</h2></td>
								<td width="30%" style="text-align:left !important">Form-STMIK-BAAK/FRS</td>
								
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
                                    <td width="15%">Periode</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $periode; ?></td>
                                </tr>
                            </table>
						</div>
						<div class="col-md-12">
							<div >
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered frss" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                                        <th>Kode MK</th>
                                                        <th>Nama MK</th>
                                                        <th>Semester</th>
                                                        <th>Sks</th>
                                                        <th>Status</th>
                                                        <th>Mengulang</th>
                                                        <th>Prasyarat<br>kode-periode ambil (Huruh mutu)</th>
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
                                                    <td><?php echo $row->status_frs ?></td>
                                                    <td><?php echo $row->ulang ?></td>
													<td><?php $ulang=$this->Master_model->master_result(['id_registrasi_mahasiswa'=>$mahasiswa->id_registrasi_mahasiswa,'id_matkul'=>$row->id_matkul_prasyarat],'v_frs');

													foreach ($ulang as $rowz) {
														echo $rowz['kode_mata_kuliah']."-".$rowz['periode']." (".$rowz['nilai_huruf'].")";
													};
													?></td>
                                                    
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
							Keterangan Perwalian : <br>
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
	<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.min.js"></script>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.1.0/jspdf.umd.min.js"></script>
<script type="text/javascript">
        function demoFromHTML() {
            var pdf = new jsPDF('p', 'pt', 'letter');
            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            source = window.document.getElementsById("#content2")[0];;

            // we support special element handlers. Register them with jQuery-style 
            // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
            // There is no support for any other type of selectors 
            // (class, of compound) at this time.
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#bypassme': function(element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
			$("#pdf").click(function () {

            pdf.fromHTML(
                    source, // HTML string or DOM elem ref.
                    margins.left, // x coord
                    margins.top, {// y coord
                        'width': margins.width, // max width of content on PDF
                        'elementHandlers': specialElementHandlers
                    },
            function(dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }
            , margins);
		});
        }
    </script>