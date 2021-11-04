<div class="page-wrapper">
    <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   
                        <div class="card card-outline-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Ploting jadwal</h4>
                            </div>
                            <div class="card-block">
                            <form action='<?php echo $action; ?>' method='post' >
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
                                             <td style="width:30%">Periode</td>
                                             <td><?php echo $master_saji->periode; ?></td>
                                         </tr>
                                         <tr>
                                             <td style="width:30%">Komponen Nilai</td>
                                             <td>
                                                <select name='komponen' class="form-control" required>
                                                    <?php foreach($komponen_nilai as $row){ ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['komponen']; ?> (<?php echo $row['presentase']; ?>)</option>
                                                    <?php } ?>
                                                </select>
                                             </td>
                                         </tr>
                                        
                                     </tbody>
                                 </table>
                                 <input type="submit" value="input">
                                 </br>
                                 </br>
                                 </form>
                                 <a href="<?php echo base_url('dosen/perkuliahan/komponen_nilai/'.$id_trx); ?>" class="btn btn-warning waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-pencil"></i></span> Komponen nilai</a>
                                 <a href="<?php echo base_url('dosen/perkuliahan/report_nilai/'.$id_trx); ?>" class="btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-list"></i></span> Report Nilai</a>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>