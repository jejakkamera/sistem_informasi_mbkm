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
                                <button  class="btn btn-success waves-effect waves-light" ><span class="btn-label"><i class="fa fa-gear"></i></span> Update Database</button>
                                <a class="btn btn-info waves-effect waves-light" href="<?php echo base_url('admin/feeder/f_GetRiwayatNilaiMahasiswa_update'); ?>"><span class="btn-label"><i class="fa fa-download"></i></span> Update nilai </a>


                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>id_registrasi_mahasiswa</th>
                                                <th>nama_mata_kuliah</th>
                                            </tr>
                                        </thead>
                                     
                                        <tbody>
                                        
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
                    dom: "Bfrtip",
                    'ajax': {
                        'url':'<?php echo base_url();?>results_nilai.json',
                        'type': 'POST'
                    },
                    'columns': [
                        { data: 'id_registrasi_mahasiswa' },
                        { data: 'nama_mata_kuliah' },
                        { data: 'id_matkul',"visible": false },
                        { data: 'id_periode',"visible": false },
                        { data: 'id_matkul',"visible": false },
                        { data: 'id_kelas',"visible": false },
                        { data: 'nilai_angka',"visible": false },
                        { data: 'nilai_huruf',"visible": false },
                    ],
                    select: true,
                });

                $("button").click(function(){
                    
                    
                    var data = t.rows().data();
                    var total = data.length;
                    var now = 1;
                    var count = 0;
                    var width = 1;
                   
                    data.each(function (value, index) {
                        now=now+10;
                        $.ajax({
                            url:"<?php echo base_url('admin/feeder/f_GetRiwayatNilaiMahasiswa_check');?>",
                            method:"POST",
                            data: value, 
                            async: false, 
                            success:function(response) {
                                console.log(response);
                                
                            },
                            error:function(){
                                console.log('error');
                            }

                        });
                        
                        //console.log(value['id_registrasi_mahasiswa']);
                        
                    });
                    document.getElementById("progesbar").style.width = "100%";
                    
                });
            });
        </script>