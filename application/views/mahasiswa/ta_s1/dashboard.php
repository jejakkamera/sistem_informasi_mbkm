<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    
            
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   
                        <div class="card card-outline-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Dashboard Tugas Akhir / Skripsi</h4>
                            </div>
                            <div class="card-block">
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                     
                                        <tbody>
                                            <tr>
                                                <td style="width:30%">Progres</td>
                                                <td><?php echo $data_masters->progres ?> / <?php echo $data_masters->ket ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:30%">NIM</td>
                                                <td><?php echo $data_masters->nim ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td><?php echo $data_masters->nama_mhs; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Periode</td>
                                                <td><?php echo $data_masters->periode; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Program Studi</td>
                                                <td><?php echo $data_masters->nama_program_studi;?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Dosen Pembimbing 1</td>
                                                <td><?php echo $data_masters->nama_p1;?></td>
                                            </tr>
                                            <tr>
                                                <td>Email Pembimbing 1</td>
                                                <td><?php echo $data_masters->email_p1;?></td>
                                            </tr>
                                            <tr>
                                                <td>Dosen Pembimbing 2</td>
                                                <td><?php echo $data_masters->nama_p2;?></td>
                                            </tr>
                                            <tr>
                                                <td>Email Pembimbing 2</td>
                                                <td><?php echo $data_masters->email_p2;?></td>
                                            </tr>
                                            <tr>
                                                <td>Dosen Pembimbing 3</td>
                                                <td><?php echo $data_masters->nama_p3;?></td>
                                            </tr>
                                            <tr>
                                                <td>Email Pembimbing 3</td>
                                                <td><?php echo $data_masters->email_p3;?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Plot Pembimbing</td>
                                                <td><?php echo $data_masters->tgl_pembimbing;?></td>
                                            </tr>
                                            <tr>
                                                <td>Judul</td>
                                                <td><?php echo $data_masters->judul;?></td>
                                            </tr>
                                      
                                        </tbody>
                                    </table>

                                    <hr>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                            <h2 align="center">Bimbingan & Jadwal Sidang</h2>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#bimbingan" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Bimbingan</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#proposal" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Sidang Proposal</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#hasil" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Sidang Hasil</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#ta" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Sidang TA</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#yudisium" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Yudisium</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="bimbingan" role="tabpanel">
                                        <br>
                                    <?php if(  $this->session->userdata('role')=='mhs' ){ ?>
                                        <a href="<?php echo base_url(); ?>mahasiswa/ta_s1/add_bimbingan/<?php echo $data_masters->nim ?>" class="btn btn-block btn-warning">Add Bimbingan</a>
                                    <?php }else{  ?> 
                                        <a href="<?php echo base_url(); ?>dosen/ta_s1/add_bimbingan/<?php echo $data_masters->nim ?>" class="btn btn-block btn-warning">Add Bimbingan</a>
                                    <?php } ?> 
                                    <br>

                                        <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                                <th>No</th>
                                                                <th>Tanggal</th>
                                                                <th>Keterangan</th>
                                                                <th>File</th>
                                                                <th>User</th>

                                                </thead>
                                                <tbody>
                                                    <?php if($history_bimbingan){$no=1;foreach($history_bimbingan as $row_bimbingan){  ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $row_bimbingan['tanggal'] ?></td>
                                                        <td><?php echo $row_bimbingan['keterangan'] ?></td>
                                                        <td>
                                                        <?php if($row_bimbingan['file']){ ?>    
                                                        <a target='_blank' href="<?php echo base_url('/assets/berkas/history_bimbingan/'.$row_bimbingan['file']); ?>">Lihat Berkas</a><?php } ?></td>
                                                        <td><?php if($row_bimbingan['email_dosen']){ echo $row_bimbingan['email_dosen']; }else{echo "MHS";} ?></td>
                                                        
                                                    </tr>
                                                    <?php $no++;}} ?>
                                                </tbody>
                                            </table>
                                    </div>

                                    <div class="tab-pane p-20" id="proposal" role="tabpanel">

                                        <?php if(  $this->session->userdata('role')=='mhs' || $this->session->userdata('role')=='dosen'  ){ ?>

                                            <?php if($history_sidang){foreach($history_sidang as $rows){ if($rows['sidang']=='proposal'){ ?>

                                            <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                     
                                                <tbody>
                                                    <tr>
                                                        <td>Progres</td>
                                                        <td><?php echo $rows['progres'] ;?> / <?php echo $rows['ket'] ;?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Judul</td>
                                                        <td><?php echo $rows['judul'] ;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Berkas</td>
                                                        <td><a target='_blank' href="<?php echo base_url('/assets/berkas/ta/'.$rows['berkas']); ?>">Lihat Berkas</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ketua Sidang</td>
                                                        <td><?php echo $rows['nama_ketua'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Penguji 1</td>
                                                        <td><?php echo $rows['nama_penguji1'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Penguji 2</td>
                                                        <td><?php echo $rows['nama_penguji2'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Penguji 3</td>
                                                        <td><?php echo $rows['nama_penguji3'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nilai</td>
                                                        <td><?php echo $rows['nilai'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>tanggal Sidang</td>
                                                        <td><?php echo $rows['tanggal_sidang'];?></td>
                                                    </tr>
                                                    
                                                

                                                </tbody>
                                            </table>
                                            <?php }}} ?>

                                        <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                            <th>No</th>
                                                            <th>Periode</th>
                                                            <th>Tanggal Pendaftaran</th>
                                                            <th>Tanggal Tutup Pendaftaran</th>
                                                            <th>Tanggal Sidang</th>
                                                            <th>Keterangan</th>
                                                            <th>Dafatar</th>
                                            </thead>
                                            <tbody>
                                                <?php if($jadwal_sidang){$no=1;foreach($jadwal_sidang as $row){ if($row->sidang=='proposal' && $this->session->userdata('role')=='mhs'){ ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <td><?php echo $row->periode ?></td>
                                                    <td><?php echo $row->buka_daftar ?></td>
                                                    <td><?php echo $row->tutup_daftar ?></td>
                                                    <td><?php echo $row->tanggal_sidang ?></td>
                                                    <td><?php echo $row->ket ?></td>
                                                    <td><a href="<?php echo base_url(); ?>mahasiswa/ta_s1/pendaftar_sidang_ta_s1/<?php echo $row->id_trx ?>" class="btn btn-block btn-warning">Daftar Sidang</a> *daftar atau update data</td>
                                                </tr>
                                                <?php }$no++;}} ?>
                                            </tbody>
                                        </table>
                                        <?php } ?>
                                    </div>
                                   
                                    <div class="tab-pane p-20" id="hasil" role="tabpanel">
                                        <?php if(  $this->session->userdata('role')=='mhs' || $this->session->userdata('role')=='dosen' ){ ?>

                                            <?php if($history_sidang){foreach($history_sidang as $rows){ if($rows['sidang']=='hasil'){ ?>

                                                <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">

                                                    <tbody>
                                                        <tr>
                                                            <td>Progres</td>
                                                            <td><?php echo $rows['progres'] ;?> / <?php echo $rows['ket'] ;?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Judul</td>
                                                            <td><?php echo $rows['judul'] ;?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Berkas</td>
                                                            <td><a target='_blank' href="<?php echo base_url('/assets/berkas/ta/'.$rows['berkas']); ?>">Lihat Berkas</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ketua Sidang</td>
                                                            <td><?php echo $rows['nama_ketua'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Penguji 1</td>
                                                            <td><?php echo $rows['nama_penguji1'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Penguji 2</td>
                                                            <td><?php echo $rows['nama_penguji2'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Penguji 3</td>
                                                            <td><?php echo $rows['nama_penguji3'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nilai</td>
                                                            <td><?php echo $rows['nilai'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>tanggal Sidang</td>
                                                            <td><?php echo $rows['tanggal_sidang'];?></td>
                                                        </tr>
                                                        
                                                    

                                                    </tbody>
                                                </table>
                                                <?php }}} ?>

                                            <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                                <th>No</th>
                                                                <th>Periode</th>
                                                                <th>Tanggal Pendaftaran</th>
                                                                <th>Tanggal Tutup Pendaftaran</th>
                                                                <th>Tanggal Sidang</th>
                                                                <th>Keterangan</th>
                                                                <th>Daftar</th>
                                                </thead>
                                                <tbody>
                                                    <?php if($jadwal_sidang){$no=1;foreach($jadwal_sidang as $row){ if($row->sidang=='hasil' && $this->session->userdata('role')=='mhs'){ ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $row->periode ?></td>
                                                        <td><?php echo $row->buka_daftar ?></td>
                                                        <td><?php echo $row->tutup_daftar ?></td>
                                                        <td><?php echo $row->tanggal_sidang ?></td>
                                                        <td><?php echo $row->ket ?></td>
                                                        <td><a href="<?php echo base_url(); ?>mahasiswa/ta_s1/pendaftar_sidang_ta_s1/<?php echo $row->id_trx ?>" class="btn btn-block btn-warning">Daftar Sidang</a> *daftar atau update data</td>
                                                    </tr>
                                                    <?php }$no++;}} ?>
                                                </tbody>
                                            </table>
                                        <?php } ?>

                                    </div>
                                    <div class="tab-pane p-20" id="ta" role="tabpanel">

                                    <?php if(  $this->session->userdata('role')=='mhs' || $this->session->userdata('role')=='dosen' ){ ?>

                                        <?php if($history_sidang){foreach($history_sidang as $rows){ if($rows['sidang']=='ta'){ ?>

                                            <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">

                                                <tbody>
                                                    <tr>
                                                        <td>Progres</td>
                                                        <td><?php echo $rows['progres'] ;?> / <?php echo $rows['ket'] ;?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Judul</td>
                                                        <td><?php echo $rows['judul'] ;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Berkas</td>
                                                        <td><a target='_blank' href="<?php echo base_url('/assets/berkas/ta/'.$rows['berkas']); ?>">Lihat Berkas</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ketua Sidang</td>
                                                        <td><?php echo $rows['nama_ketua'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Penguji 1</td>
                                                        <td><?php echo $rows['nama_penguji1'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Penguji 2</td>
                                                        <td><?php echo $rows['nama_penguji2'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Penguji 3</td>
                                                        <td><?php echo $rows['nama_penguji3'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nilai</td>
                                                        <td><?php echo $rows['nilai'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>tanggal Sidang</td>
                                                        <td><?php echo $rows['tanggal_sidang'];?></td>
                                                    </tr>
                                                    
                                                

                                                </tbody>
                                            </table>
                                            <?php }}} ?>

                                        <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                            <th>No</th>
                                                            <th>Periode</th>
                                                            <th>Tanggal Pendaftaran</th>
                                                            <th>Tanggal Tutup Pendaftaran</th>
                                                            <th>Tanggal Sidang</th>
                                                            <th>Keterangan</th>
                                                            <th>Dafatar</th>
                                            </thead>
                                            <tbody>
                                                <?php if($jadwal_sidang){$no=1;foreach($jadwal_sidang as $row){ if($row->sidang=='ta' && $this->session->userdata('role')=='mhs'){ ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <td><?php echo $row->periode ?></td>
                                                    <td><?php echo $row->buka_daftar ?></td>
                                                    <td><?php echo $row->tutup_daftar ?></td>
                                                    <td><?php echo $row->tanggal_sidang ?></td>
                                                    <td><?php echo $row->ket ?></td>
                                                    <td><a href="<?php echo base_url(); ?>mahasiswa/ta_s1/pendaftar_sidang_ta_s1/<?php echo $row->id_trx ?>" class="btn btn-block btn-warning">Daftar Sidang</a> *daftar atau update data</td>
                                                </tr>
                                                <?php }$no++;}} ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                                
                                    </div>
                                    <div class="tab-pane p-20" id="yudisium" role="tabpanel">
                                    <?php if($yudisium_mhs){?>
                                        <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td>Progres</td>
                                                <td><?php echo $yudisium_mhs->progres ;?> / <?php echo $yudisium_mhs->ket ;?> </td>
                                            </tr>
                                            <tr>
                                                <td>Judul (Indonesia)</td>
                                                <td><?php echo $yudisium_mhs->judul_indo ;?></td>
                                            </tr>
                                            <tr>
                                                <td>Judul (Inggris)</td>
                                                <td><?php echo $yudisium_mhs->judul_ing ;?></td>
                                            </tr>
                                            <tr>
                                                <td>Berkas</td>
                                                <td><a target='_blank' href="<?php echo base_url('/assets/berkas/yudisium/'.$yudisium_mhs->berkas); ?>">Lihat Berkas</a></td>
                                            </tr>
                                            <tr>
                                                <td>Periode</td>
                                                <td><?php echo $yudisium_mhs->periode ;?></td>
                                            </tr>
                                            <tr>
                                                <td>PIN</td>
                                                <td><?php echo $yudisium_mhs->pin ;?></td>
                                            </tr>
                                            <tr>
                                                <td>No Transkrip</td>
                                                <td><?php echo $yudisium_mhs->no_transkrip ;?></td>
                                            </tr>
                                            <tr>
                                                <td>No Ijazah</td>
                                                <td><?php echo $yudisium_mhs->no_ijasah ;?></td>
                                            </tr>
                                            <tr>
                                                <td>IPK Lulus</td>
                                                <td><?php echo $yudisium_mhs->ipk_lulus ;?></td>
                                            </tr>
                                            <tr>
                                                <td>Total SKS Lulus</td>
                                                <td><?php echo $yudisium_mhs->total_sks_lulus ;?></td>
                                            </tr>
                                           
                                        </tbody>
                                        </table>

                                        <?php }?>
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                            <th>No</th>
                                                            <th>Periode</th>
                                                            <th>Tanggal Tutup Pendaftaran</th>
                                                            <th>Syarat</th>
                                                            <th>Dafatar</th>
                                            </thead>
                                            <tbody>
                                                <?php if($jadwal_yudisium){$no=1;foreach($jadwal_yudisium as $row){ ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <td><?php echo $row->periode ?></td>
                                                    <td><?php echo $row->tanggal_penutupan ?></td>
                                                    <td><?php echo $row->nam_rule ?></td>
                                                    <td><a href="<?php echo base_url(); ?>mahasiswa/ta_s1/pendaftar_yudisium_ta_s1/<?php echo $row->id ?>" class="btn btn-block btn-warning">Daftar Yudisium</a> *daftar atau update data</td>
                                                </tr>
                                                <?php $no++;}} ?>
                                            </tbody>

                                    </div>
                                </div>
                            </div>
                        </div>

<?php if( in_array($data_masters->progres,['daftar sidang','sidang','penilaian','lulus','gagal'])  ){ ?>
    <h2 align="center">Informasi Sidang</h2>
    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                     
                                     <tbody>
                                         <tr>
                                             <td>Judul</td>
                                             <td><?php echo $data_masters->judul;?></td>
                                         </tr>
                                         <tr>
                                             <td>Berkas</td>
                                             <td><a href="<?php echo base_url('/assets/berkas/ta/'.$data_masters->berkas); ?>">Lihat Berkas</a></td>
                                         </tr>
                                         <tr>
                                             <td>Ketua Sidang</td>
                                             <td><?php echo $data_masters->nama_ketua;?></td>
                                         </tr>
                                         <tr>
                                             <td>Penguji 1</td>
                                             <td><?php echo $data_masters->nama_penguji_1;?></td>
                                         </tr>
                                         <tr>
                                             <td>Nilai Sidang</td>
                                             <td><?php echo $data_masters->nilai_sidang;?></td>
                                         </tr>
                                         <tr>
                                             <td>Tanggal Lulus</td>
                                             <td><?php echo $data_masters->tgl_lulus;?></td>
                                         </tr>
                                         <tr>
                                             <td>Keterangan Sidang</td>
                                             <td><?php echo $data_masters->keterangan_sidang;?></td>
                                         </tr>
                                         
                                       

                                     </tbody>
                                 </table>

<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
               
            </div>