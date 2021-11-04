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
                                <h4 class="card-title">Periode : <?php echo $periode; ?></h4>
                               
                                <br>

                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nim</th>
                                                <th>Nama</th>
                                                <th>Prodi</th>
                                                <th>SKS</th>
                                                <th>Tagihan</th>
                                                <th>Total Bayar</th>
                                                <th>Sisa</th>
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
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: [
                'pageLength','copy',  'excel', 'pdf', 'print'
            ],
            
            data: <?php echo json_encode($list_aktivitas_mahasiswa) ; ?>,
            columns: [
                { data: "nim" },
                { data: "nama" },
                { data: "nama_program_studi" },
                { data: "total_sks" },
                { data: 'total_tagihan',
                    render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ' )
                },
                { data: 'total_bayar',
                    render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ' )
                },
                { data: null,
                    render: function ( data, type, row, meta ) {
                        return (row.total_tagihan-row.total_bayar).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");  // Column will display firstname lastname
            
                    }
                },
                
             
            ]
        });
        });
    </script>