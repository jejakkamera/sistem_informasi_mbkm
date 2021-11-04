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
                                <button  class="btn btn-success waves-effect waves-light" ><span class="btn-label"><i class="fa fa-save"></i></span> Save</button>


                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nim</th>
                                                <th>Nama</th>
                                                <th>Tanggal Presensi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                     
                                        <tbody>
                                        <?php 
                                        //print_r($list_mhs);
                                        $presensi_status='presensi_status_'.$pertemuan;
                                        $tanggal_absen_='tanggal_absen_'.$pertemuan;
                                        foreach($list_mhs as $row){ ?>
                                            <tr>
                                                <th>
                                                <input type="text" name='nim[]' value='<?php echo $row->nim; ?>'>
                                                </th>
                                                <th><?php echo $row->nama; ?></th>
                                                <th><?php echo $row->$tanggal_absen_; ?></th>
                                                <th>
                                                    <input <?php if($row->$presensi_status=='hadir'){echo "checked";} ?> type="radio"  name="presensi_status_<?php  echo $row->nim; ?>" value="hadir">
                                                    <label for="male">Hadir</label><br>
                                                    <input <?php if($row->$presensi_status=='izin'){echo "checked";} ?> type="radio" name="presensi_status_<?php  echo $row->nim; ?>" value="izin">
                                                    <label for="female">Izin</label><br>
                                                    <input <?php if($row->$presensi_status=='tidak_hadir'){echo "checked";} ?> type="radio"name="presensi_status_<?php  echo $row->nim; ?>" value="tidak_hadir">
                                                    <label for="other">Tidak Hadir</label>
                                                    
                                                </th>
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
                    
                    var data = t.$('input').serialize();
                    //console.log(data);
                    // var data = t.rows().data();
                    // var total = data.length;
                    // var now = 1;
                    // var count = 0;
                    // var width = 1;
                   
                    // data.each(function (value, index) {
                    //     now=now+10;
                        $.ajax({
                            url:"<?php echo base_url('dosen/perkuliahan/presensi_mahasiswa_pertemuan_list_action/'.$cek_->id_matkul.'/'.$cek_->periode.'/'.$pertemuan);?>",
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
                        
                    //     //console.log(value['id_registrasi_mahasiswa']);
                        
                    // });
                    //  document.getElementById("progesbar").style.width = "100%";
                    //  window.location.replace("<?php echo base_url('dosen/perkuliahan/presensi_mahasiswa_pertemuan/'.$id_trx); ?>");
                    
                });
            });
        </script>