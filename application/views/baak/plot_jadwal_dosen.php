<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    
                   
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   
                        <div class="card card-outline-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Ploting jadwal</h4>
                            </div>
                            <div class="card-block">
                            Dengan menambahkan data ploting. maka dosen dapat mengisi dan merubah nilai.
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                     
                                        <tbody>
                                             <tr>
                                                <td style="width:30%">Kode MK</td>
                                                <td><?php echo $master_saji->kode_mata_kuliah; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:30%">Nama Matakuliah</td>
                                                <td><?php echo $master_saji->nama_mata_kuliah; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:30%">SKS</td>
                                                <td><?php echo $master_saji->sks_mata_kuliah; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:30%">Periode</td>
                                                <td><?php echo $master_saji->periode; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:30%">Dosen Pengampu utama *</td>
                                                <td><?php echo $master_saji->nama; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:30%">Status Dosen</td>
                                                <td><?php echo $master_saji->status_pegawai; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:30%">Bahasan</td>
                                                <td><?php echo $master_saji->bahasan; ?></td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                    <a href="<?php echo base_url('/baak/frs/master_jadwal_dosen_edit/'.$id_trx); ?>" class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-pencil"></i></span> Edit</a><br>
                                    * Dosen pengampu utama harus dosen ber NIDN dan berstatus tetap yang terdaftar di feeder.
                                          
<hr>
<h2 align="center"> Jadwal</h2>
<a href="<?php echo base_url('/baak/frs/jadwal_dosen/'.$master_saji->id_kurikulum.'/'. $master_saji->periode); ?>" class="btn btn-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-list"></i></span> List MK</a>
<a href="<?php echo base_url('/baak/frs/peserta_kelas/'.$id_trx); ?>" class="btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-eye"></i></span> Peserta</a>
<a href="<?php echo base_url('/baak/frs/plot_jadwal_dosen_add/'.$id_trx); ?>" class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span> ADD</a>
<br><br>
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                                        <th>Dosen</th>
                                                        <th>Kelas</th>
                                                        <th>Hari</th>
                                                        <th>Jam</th>
                                                        <th>Ruangan</th>
                                                        <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $no=1;if($master_jadwal){foreach($master_jadwal as $row){ ?>
                                            <tr>
                                                <td><?php echo $row->nama_id_dosen ?></td>
                                                <td><?php echo $row->angkatan ?>-<?php echo $row->nama_kelas ?></td>
                                                <td><?php echo $row->hari ?></td>
                                                <td><?php echo $row->nama_waktu ?></td>
                                                <td><?php echo $row->ruang ?></td>
                                                <td>
                                                <a href="<?php echo base_url('/baak/frs/plot_jadwal_dosen_edit/'.$row->id_trx_jadwal); ?>" class="btn btn-success waves-effect waves-light" type="button"><i class="fa fa-pencil"></i> </a> |
                                                <a href="<?php echo base_url('/baak/frs/plot_jadwal_dosen_delete/'.$row->id_trx_jadwal.'/'.$id_trx); ?>" class="btn btn-danger waves-effect waves-light" type="button"><i class="fa fa-trash"></i> </a>
                                                </td>
                                            </tr>
                                            <?php $no++;}} ?>
                                        </tbody>
                                    </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
               
            </div>