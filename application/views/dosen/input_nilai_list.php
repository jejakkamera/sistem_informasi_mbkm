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
                            Input nilai : <?php echo $nilai_komponen->komponen; ?>
                                <h6 class="card-subtitle"> <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   </h6>
                                <div class="table-responsive m-t-40">
                                <div class="progress">
                                    <div class="progress-bar bg-success" id="progesbar" role="progressbar" style="width: 0%;height:15px;" role="progressbar""> Progres</div>
                                </div>
                                <br>
                                <button  class="btn btn-success waves-effect waves-light" ><span class="btn-label"><i class="fa fa-save"></i></span> Save</button>
                                <a href="<?php echo base_url('dosen/perkuliahan/input_nilai_select/'.$id_trx); ?>" class="btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-list"></i></span> Menu Nilai</a>


                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nim</th>
                                                <th>Nama</th>
                                                <th>Tanggal Input</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                     
                                        <tbody>
                                        <?php 
                                        $nim_now=0;
                                        foreach($list_mhs as $row){ ?>
                                        

                                            <tr>
                                                <th>
                                                <input type="hidden" name='id_trx[]' value='<?php echo $row->id_trx; ?>'>
                                               <?php echo $row->nim; ?>
                                                </th>
                                                <th><?php echo $row->nama; ?></th>
                                                <th><?php  echo $row->date_info; ?></th>
                                                <th>
                                                <input type="number" name='nilai_<?php  echo $row->id_trx; ?>' min="0" max="5" value="<?php  echo $row->nilai; ?>" >
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
                            url:"<?php echo base_url('dosen/perkuliahan/input_nilai_list_action/'.$komponen);?>",
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
                     document.getElementById("progesbar").style.width = "100%";
                     alert('Progres finish');
                    //  window.location.replace("<?php echo base_url('dosen/perkuliahan/presensi_mahasiswa_pertemuan/'.$id_trx); ?>");

                    
                });
            });
        </script>