<link href="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/media/css/buttons.dataTables.min.css" id="theme" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/themplate/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/themplate/assets/plugins/summernote/dist/summernote.css" rel="stylesheet" />

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    
                   
                </div>

 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                                <h6 class="card-subtitle"> <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   </h6>
                                <div class="table-responsive m-t-40">
                                <div class="progress">
                                    <div class="progress-bar bg-success" id="progesbar" role="progressbar" style="width: 0%;height:15px;" role="progressbar""> Progres</div>
                                </div>
                                <br>

                                <button  class="btn btn-success waves-effect waves-light" ><span class="btn-label"><i class="fa fa-save"></i></span> Publish</button>

                                <?php if($this->session->userdata('role')=='dosen'){ ?>
                                <a href="<?php echo base_url('dosen/perkuliahan/input_nilai_select/'.$id_trx); ?>" class="btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-list"></i></span> Menu Nilai</a>
                                
                                <?php }?>
                                <a target='_blank' href="<?php echo base_url('dosen/perkuliahan/input_nilai_report/'.$id_trx); ?>" class="btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-file-excel-o"></i></span> Excel</a>
                                <hr>
                                <table width="100%">
                                <tr>
                                    <td width="15%" >Dosen</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $cek_->nama_id_dosen ?></td>
                                    <td width="15%" >Kode MK</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $cek_->kode_mata_kuliah ?></td>
                                </tr>
                                <tr>
                                    <td width="15%" >Program Strudi</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $cek_->nama_program_studi ?> (<?php echo $cek_->nama_jenjang_pendidikan ?>)</td>
                                    <td width="15%">Nama MK</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $cek_->nama_mata_kuliah ?> - <?php echo $cek_->sks_mata_kuliah ?> SKS</td>
                                </tr>
                                <tr>
                                    <td width="15%" >Kelas</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $cek_->prodi_kelas ?></td>
                                    <td width="15%">Periode</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $cek_->periode ?></td>
                                </tr>
                                
                            </table>
                            <br>

                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>TRX</th>
                                                <th>Nim</th>
                                                <th>Nama</th>
                                                <?php foreach($nilai_komponen as $row){ ?>
                                                    <th><?php echo $row['komponen']; ?> (<?php echo $row['presentase']; ?>%)</th>
                                                <?php } ?>
                                                <th>Total</th>
                                                <th>Huruf</th>
                                                <th>Nilai Angka</th>
                                                <th>Nilai Huruf</th>
                                                <th>History</th>
                                            </tr>
                                        </thead>
                                     
                                        <tbody>
                                        <?php 
                                        
                                        foreach($list_mhs as $row){ 
                                            //print_r($row);die();?>
                                            <tr>
                                                <td> <?php echo $row->id_trx; ?> <input type="hidden" name='id_trx[]' value='<?php echo $row->id_trx; ?>'></td>
                                                <td><?php echo $row->nim; ?></td>
                                                <td><?php echo $row->nama; ?></td>
                                                <?php 
                                                $total=0;
                                                foreach($nilai_komponen as $rowz){ 
                                                    $kolom=$rowz['komponen'];
                                                    $total=$total+( ($row->$kolom/100)*$rowz['presentase'] );?>
                                                    <td><?php echo round($row->$kolom,2);?></td>
                                                <?php 
                                                
                                            } ?>
                                                <td><?php echo number_format($total,2) ?><input type="hidden" name='nilai_<?php  echo $row->id_trx; ?>' min="0" max="5" value="<?php  echo number_format($total,2) ; ?>" ></td>

                                                <!-- <td><select class="form-control" name="nilai_huruf_<?php  echo $row->id_trx; ?>" >
                                                    <?php foreach($nilai_skala as $row_s){ ?>
                                                    <option <?php if($row->nilai_huruf == $row_s['nilai_huruf'] ){echo 'selected';} ?>  value="<?php echo $row_s['nilai_huruf']; ?>" > <?php echo $row_s['nilai_huruf']; ?>/<?php echo $row_s['nilai_index']; ?>  </option>
                                                    <?php } ?>
                                                </select></td> -->

                                                <td width="5%"> <?php foreach($nilai_skala as $row_s){ ?>
                                                    <?php if($row_s['bobot_minimum']<= $total && $total <= $row_s['bobot_maximum'] ){
                                                        $nilai_huruf= $row_s['nilai_huruf'];
                                                    } ?>
                                                <?php } ?>
                                                <input type="text" class="form-control" name="nilai_huruf_<?php  echo $row->id_trx; ?>" value="<?php echo $nilai_huruf; ?>" readonly>
                                                </td>
                                                <td><?php echo $row->nilai_angka; ?></td>
                                                <td><?php echo $row->nilai_huruf; ?></td>
                                                <td> <a href="#edit_modal" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-id_trx="<?php echo $row->id_trx; ?>" data-nama="<?php echo $row->nama; ?>" data-nim="<?php echo $row->nim; ?>" >History</a> </td>
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



    <div class="modal fade bd-example-modal-lg" id="edit_modal" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    <h4 class="modal-title">History Nilai</h4>
                </div>
                <div class="modal-body">
                    <div class="hasil-data">Load Data..</div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button> -->
                </div>
            </div>
        </div>
    </div>


                  <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/jquery/jquery.min.js"></script>
                  <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/jquery.dataTables.min.js"></script>

                  
    <!-- start - This is for export functionality only -->
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/media/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/media/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/media/js/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/media/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/media/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/media/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/media/js/buttons.print.min.js"></script>

    
    <script type="text/javascript">

                // function namaFungsi(){
                //     var data = t.rows().data();
                //     data.each(function (value, index) {
                //         console.log('For index ${index}, data value is ${value}');
                //     });
                // }

            $(document).ready(function() {
                
                var t = $("#mytable").DataTable({
                    "lengthMenu": [ [-1, 25], [ "All",25] ]
                } );

                $("button").click(function(){
                    
                    var data = t.$('input,select').serialize();
                        $.ajax({
                            url:"<?php echo base_url('dosen/perkuliahan/report_nilai_action/');?>",
                            method:"POST",
                            data: data, 
                            async: false, 
                            success:function(response) {
                                console.log(response);
                                
                            },
                            error:function(){
                                console.log('error');
                            }

                        });
                     document.getElementById("progesbar").style.width = "100%";
                    // window.location.replace("<?php echo base_url('dosen/perkuliahan/report_nilai/'.$id_trx); ?>");
                    
                });

                $('#edit_modal').on('show.bs.modal', function (e) {
                    $('.hasil-data').html("Load Data..");
                    var id_trx = $(e.relatedTarget).data('id_trx');
                    var nim = $(e.relatedTarget).data('nim');
                    var nama = $(e.relatedTarget).data('nama');
                    //menggunakan fungsi ajax untuk pengambilan data
                    $.ajax({
                        type : 'post',
                        url : "<?php echo base_url('dosen/perkuliahan/history_nilai/'); ?>"+id_trx+'/'+nim+'/'+nama,
                        // data :  'idx='+ idx,
                        success : function(data){
                        $('.hasil-data').html(data);//menampilkan data ke dalam modal
                        }
                    });
                });

            });
        </script>
