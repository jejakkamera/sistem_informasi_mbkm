<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* .data{
        border: 0.5px solid lightgrey !important;
    } */

    body{
        font-size: 10px ;
    }
</style>
<body>
<table width="100%"  >
							<tr>
								<td width="30%" style="text-align:right !important" ><img   src="<?php echo base_url('assets/logo_rosma_kw_100.png');  ?>" alt="Logo"></td>
								<td width="40%" style="text-align:center !important"><h2>Kartu Ujian</h2><?= $type ?></td>
								<td width="30%" style="text-align:left !important">Form-STMIK-BAAK/KU</td>
								
							</tr>
						</table>
							<hr>

                            <br>
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
                            <br>
                            <table class='data' border="1" cellspacing="0" width="100%">
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
                                            <td height="30px" ><?php echo $row->kode_mata_kuliah; ?></td>
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
    
</body>
</html>