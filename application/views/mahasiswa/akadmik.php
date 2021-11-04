<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    
                   
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   
                        <div class="card card-outline-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Profile Akademik</h4>
                            </div>
                            <div class="card-block">
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                     
                                        <tbody>
                                            <tr>
                                                <td style="width:30%">NIM</td>
                                                <td><?php echo $info_akademik->nim ?>/</td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td><?php echo $info_akademik->nama; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kelas</td>
                                                <td><?php echo $info_akademik->angkatan;?> - <?php echo $info_akademik->nama_kelas;?></td>
                                            </tr>
                                            <tr>
                                                <td>Program Studi</td>
                                                <td><?php echo $info_akademik->nama_program_studi;?>-<?php echo $info_akademik->nama_jenjang_pendidikan;?></td>
                                            </tr>
                                            <tr>
                                                <td>Ketua Program Studi</td>
                                                <td><?php echo $info_akademik->nama_k_prodi;?></td>
                                            </tr>
                                            <tr>
                                                <td>Wali Dosen</td>
                                                <td><?php echo $info_akademik->nama_wali_dosen;?></td>
                                            </tr>
                                            <tr>
                                                <td>NIDN Wali Dosen</td>
                                                <td><?php echo $info_akademik->nidn;?></td>
                                            </tr>
                                            <tr>
                                                <td>Email Wali Dosen</td>
                                                <td><?php echo $info_akademik->email_wali;?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Kurikurum</td>
                                                <td><?php echo $info_akademik->nama_kurikulum;?></td>
                                            </tr>
                                        </tbody>
                                    </table>
<hr>
<h2 align="center"> Kurikulum</h2>
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                                        <th>No</th>
                                                        <th>Kode MK</th>
                                                        <th>Nama MK</th>
                                                        <th>Semester</th>
                                                        <th>Sks</th>
                                        </thead>
                                        <tbody>
                                            <?php $no=1;foreach($kurikulum as $row){ ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $row->kode_mata_kuliah ?></td>
                                                <td><?php echo $row->nama_mata_kuliah ?></td>
                                                <td><?php echo $row->semester ?></td>
                                                <td><?php echo $row->sks_mata_kuliah ?></td>
                                            </tr>
                                            <?php $no++;} ?>
                                        </tbody>
                                    </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
               
            </div>