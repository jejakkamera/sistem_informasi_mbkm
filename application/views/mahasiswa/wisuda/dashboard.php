<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    
                   
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   
                        <div class="card card-outline-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Dashboard Wisuda</h4>
                            </div>
                            <div class="card-block">
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                     
                                        <tbody>
                                            <tr>
                                                <td style="width:30%">NIM</td>
                                                <td><?php echo $data_masters->nim ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td><?php echo $data_masters->nama; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Foto</td>
                                                <td><img width="80" height="120" src="<?php echo base_url('/assets/berkas/wisuda/'.$data_masters->berkas); ?>" alt="">
                                               <br> <a target="_blank" href="<?php echo base_url('/assets/berkas/wisuda/'.$data_masters->berkas); ?>">Lihat Berkas</a></td>
                                            </tr>
                                            <tr>
                                                <td>Status bayar</td>
                                                <td><?php echo $data_masters->bayar; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Bayar</td>
                                                <td><?php echo $data_masters->tanggal_bayar; ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Kwitansi</td>
                                                <td><?php echo $data_masters->no_kwitansi; ?></td>
                                            </tr>
                                           
                                      
                                        </tbody>
                                    </table>
                                    <a href="<?php echo base_url('mahasiswa/wisuda/cek_payment/'.$id_trx); ?>" class="btn btn-info"> Cek Payment</a> <br>
                                    <hr>
                                    Virtual Account akan muncul di menu <b>Administrasi -> Addtional</b>

                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                     
                                        <tbody>
                                            <tr>
                                                <td>Nama</td>
                                                <td>Estimasi Tagihan</td>
                                                <td>Action</td>
                                            </tr>
                                           <?php foreach($wisuda_rule as $row){ ?>
                                            <tr>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo number_format($row['besaran']); ?></td>
                                                <td> <?php 
                                                        $max_bayar=$row['besaran'];
                                                        $tagihan=1;?>
                                                        <form method="post"  onsubmit="return validateForm()" action="<?php echo base_url('mahasiswa/wisuda/ukt_generate_tagihan_additional/'.$id_trx); ?>">
                                                        
                                                        
                                                        <input type="hidden"  name="total_bayar" id="total_bayar" value="<?php echo ($row['besaran']); ?>" />
                                                        <input type="hidden"  name="id_additional" id="id_additional" value="<?php echo $row['id_rule']; ?>" />

                                                        <input type="submit" id="button" onclick="return confirm('Apa Anda Yakin ?')" class="btn btn-warning"  value="Bayar" style="cursor:pointer;">
                                                        
                                                        </form> </td>
                                            </tr>
                                           <?php } ?>
                                      
                                        </tbody>
                                    </table>
                                    * Estimasi tagihan : harga dapat sewaktu waktu berubah. harga pasti adalah yang tertera di Virtual Account.
                                    <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
               
            </div>