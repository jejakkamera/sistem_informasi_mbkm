<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        font-size: 10px !important;
    }
</style>
<body>
                        <table width="100%"  >
							<tr>
								<td width="30%" style="text-align:right !important" ><img   src="<?php echo base_url('assets/logo_rosma_kw_100.png');  ?>" alt="Logo"></td>
								<td width="40%" style="text-align:center !important"><h2>Kartu Studi</h2></td>
								<td width="30%" style="text-align:left !important">Form-STMIK-BAAK/KS</td>
								
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
                            <table id="mytable" border="1" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                                        <th width='10%'>Pertemuan</th>
                                                        <th width='50%'>Materi</th>
                                                        <th width='15%'>Tanggal</th>
                                                        <th width='25%'>Paraf</th>
                                                        </tr>           
                                        </thead>
                                        
                                          <tbody height="400px">
                                            <?php for ($i=1; $i <= 16 ; $i++) { ?>
                                            

                                                <tr height="50px" style="padding: 10px 10px;"  >
                                                    <td align='center' height="25px" ><?php echo $i; ?></td>
                                                    <td align='center' ><?php if($i==8 or $i==16){echo 'Ujian';} ?></td>
                                                    <td align='center' ><?php if($i==8 or $i==16){echo 'Ujian';} ?></td>
                                                    <td align='center' ><?php if($i==8 or $i==16){echo 'Ujian';} ?></td>
                                                </tr>
                                            <?php } ?>
                                          </tbody>
                                    </table>
</body>
</html>