<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                </div>
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">

                <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                     
                                     <tbody>
                                         <tr>
                                             <td>Progres</td>
                                             <td><?php echo $data_masters->progres ;?> </td>
                                         </tr>
                                         <tr>
                                             <td>Judul</td>
                                             <td><?php echo $data_masters->judul ;?></td>
                                         </tr>
                                         <tr>
                                             <td>Berkas</td>
                                             <td><a target='_blank' href="<?php echo base_url('/assets/berkas/ta/'.$data_masters->berkas); ?>">Lihat Berkas</a></td>
                                         </tr>
                                         <tr>
                                             <td>Ketua Sidang</td>
                                             <td><?php echo $data_masters->nama_ketua;?></td>
                                         </tr>
                                         <tr>
                                             <td>Penguji 1</td>
                                             <td><?php echo $data_masters->nama_penguji1;?></td>
                                         </tr>
                                         <tr>
                                             <td>Penguji 2</td>
                                             <td><?php echo $data_masters->nama_penguji2;?></td>
                                         </tr>
                                         <tr>
                                             <td>Penguji 3</td>
                                             <td><?php echo $data_masters->nama_penguji3;?></td>
                                         </tr>
                                         <tr>
                                             <td>Nilai</td>
                                             <td><?php echo $data_masters->nilai;?></td>
                                         </tr>
                                         <tr>
                                             <td>tanggal Sidang</td>
                                             <td><?php echo $data_masters->tanggal_sidang;?></td>
                                         </tr>
                                         <tr>
                                             <td>tanggal lulus sidang</td>
                                             <td><?php echo $data_masters->tgl_lulus;?></td>
                                         </tr>
                                         
                                     

                                     </tbody>
                                 </table>
                        <a  href="<?php echo base_url(); ?>baak/tugas_akhir/ta_s1/input_penilaian/<?php echo $id_trx ?>/<?php echo $periode ?>" class="btn btn-warning">Input Nilai</a>
                        <hr>
                                 <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                            <th>No</th>
                                                            <th>Penginput</th>
                                                            <th>Tanggal Input</th>
                                                            <th>Berkas</th>
                                            </thead>
                                            <tbody>
                                                <?php if($magang_nilai){$no=1;foreach($magang_nilai as $row){  ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <td><?php echo $row['email_penginput'] ?></td>
                                                    <td><?php echo $row['date'] ?></td>
                                                    <td><a target="_blank" href="<?php echo base_url(); ?>assets/berkas/ta/<?php echo $row['berkas'] ?>" class="btn btn-block btn-info">Berkas</a></td>
                                                </tr>
                                                <?php $no++;}} ?>
                                            </tbody>
                                        </table>
            </div>
            </div>
            </div>
            </div>
</div>