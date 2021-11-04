
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    
                   
                </div>

 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive m-t-40">
                               
                               
                                <hr>
                                <table width="100%">
                                <tr>
                                    <td width="50%" colspan="3" >Dosen : <?php echo $cek_->nama_id_dosen ?></td>
                                    <td width="50%" colspan="3" >Kode MK : <?php echo $cek_->kode_mata_kuliah ?></td>
                                </tr> 
                                <tr>
                                    <td width="50%" colspan="3" >Program Strudi : <?php echo $cek_->nama_program_studi ?> (<?php echo $cek_->nama_jenjang_pendidikan ?>)</td>
                                    <td width="50%" colspan="3">Nama MK : <?php echo $cek_->nama_mata_kuliah ?> - <?php echo $cek_->sks_mata_kuliah ?> SKS</td>
                                </tr>
                                <tr>
                                    <td width="50%" colspan="3" >Kelas : <?php echo $cek_->prodi_kelas ?></td>
                                    <td width="50%" colspan="3">Periode : <?php echo $cek_->periode ?> </td>
                                </tr>
                              
                            </table>
                            <br>

                                    <table border='1' id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>TRX</th>
                                                <th>Nim</th>
                                                <th>Nama</th>
                                                <?php foreach($nilai_komponen as $row){ ?>
                                                    <th><?php echo $row['komponen']; ?> (<?php echo $row['presentase']; ?>%)</th>
                                                <?php } ?>
                                                <th>Nilai Angka</th>
                                                <th>Nilai Huruf</th>
                                            </tr>
                                        </thead>
                                     
                                        <tbody>
                                        <?php 
                                        $no=0;
                                        foreach($list_mhs as $row){ 
                                            //print_r($row);die();?>
                                            <tr>
                                                <td> <?php $no++; echo $no; ?></td>
                                                <td><?php echo $row->nim; ?></td>
                                                <td><?php echo $row->nama; ?></td>
                                                <?php 
                                                $total=0;
                                                foreach($nilai_komponen as $rowz){ 
                                                    $kolom=$rowz['komponen'];
                                                    $total=$total+( ($row->$kolom/100)*$rowz['presentase'] );?>
                                                    <td align="center"><?php echo round($row->$kolom,2);?></td>
                                                <?php 
                                                
                                            } ?>
                                                
                                                <td align="center"><?php echo round($row->nilai_angka,2) ; ?></td>
                                                <td align="center"><?php echo $row->nilai_huruf; ?></td>
                                                 </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <!-- ============================================================== -->
                

                  </div>
* nilai angka = nilai yang telah di publish



    
   
