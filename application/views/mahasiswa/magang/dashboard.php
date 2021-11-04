<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    
                   
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   
                        <div class="card card-outline-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Dashboard magang</h4>
                            </div>
                            <div class="card-block">

                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#dashboard" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Dashboard</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#bimbingan" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Bimbingan</span></a> </li>
                                </ul>

                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="dashboard" role="tabpanel">
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
                                                    <td>Dosen Pembimbing</td>
                                                    <td><?php echo $data_masters->nama_dosen;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email Pembimbing</td>
                                                    <td><?php echo $data_masters->email_dosen;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Plot Pembimbing</td>
                                                    <td><?php echo $data_masters->tgl_pembimbing;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tempat</td>
                                                    <td><?php echo $data_masters->nama_pt;?></td>
                                                </tr>
                                        
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="tab-pane p-20" id="bimbingan" role="tabpanel">
                                        <?php if(  $this->session->userdata('role')=='mhs' ){ ?>
                                            <a href="<?php echo base_url(); ?>mahasiswa/magang/add_bimbingan/<?php echo $data_masters->nim ?>" class="btn btn-block btn-warning">Add Bimbingan</a>
                                        <?php }else{  ?> 
                                            <a href="<?php echo base_url(); ?>dosen/magang/add_bimbingan/<?php echo $data_masters->nim ?>" class="btn btn-block btn-warning">Add Bimbingan</a>
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
                                                </tr>
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
                                </div>
                               

                                   

                                    <hr>

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
                                             <td><a href="<?php echo base_url('/assets/berkas/magang/'.$data_masters->berkas); ?>">Lihat Berkas</a></td>
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


<?php if( ($this->session->userdata('role')!='mhs') and ($this->session->userdata('role')!='dosen')  ){ ?>

    <h2 align="center"> Form nilai</h2>
    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                                        <th>No</th>
                                                        <th>Dosen</th>
                                                        <th>Berkas</th>
                                        </thead>
                                        <tbody>
                                            <?php if($magang_nilai){$no=1;foreach($magang_nilai as $row){ ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $row['email_input'] ?></td>
                                                <td><a target='_blank' href="<?php echo base_url(); ?>/assets/berkas/magang/<?php echo $row['berkas'] ?>" class="btn btn-block btn-info">Download File</a> </td>
                                            </tr>
                                            <?php $no++;}} ?>
                                        </tbody>
                                    </table>

                                    <a  href="<?php echo base_url(); ?>baak/magang/input_penilaian/<?php echo $id_trx ?>/<?php echo $periode ?>" class="btn btn-warning">Input Nilai</a>

<?php } ?>

<?php if( in_array($data_masters->progres,['daftar','bimbingan','sidang','pendaftaran ditolak']) and $this->session->userdata('role')=='mhs' ){ ?>
    <h2 align="center"> Jadwal Sidang</h2>
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
                                            <?php if($jadwal_sidang){$no=1;foreach($jadwal_sidang as $row){ ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $row->periode ?></td>
                                                <td><?php echo $row->buka_daftar ?></td>
                                                <td><?php echo $row->tutup_daftar ?></td>
                                                <td><?php echo $row->tanggal_sidang ?></td>
                                                <td><?php echo $row->ket ?>, Rule administrasi : <?php echo $row->nama_id_rule ?></td>
                                                <td><a href="<?php echo base_url(); ?>mahasiswa/magang/pendaftar_sidang_magang/<?php echo $row->id_trx ?>" class="btn btn-block btn-warning">Daftar Sidang</a> *daftar atau update data</td>
                                            </tr>
                                            <?php $no++;}} ?>
                                        </tbody>
                                    </table>
<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
               
            </div>