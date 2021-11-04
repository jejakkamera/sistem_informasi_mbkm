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


<div class="text-center" style="text-align:center !important">
								<h2 style="font-size:20px !important" >Kartu Studi</h2>

                            </div>
                            <hr>
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
                                    <table id="mytable" border="1" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
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
    
</body>
</html>