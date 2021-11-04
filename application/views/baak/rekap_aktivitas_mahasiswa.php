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
                                <h4 class="card-title">Periode : <?php echo $periode; ?>. Total AKTIF : <?= number_format($rekap_aktivitas[0]->total_aktif); ?></h4>
                               
                                <br>
                                <table class="display nowrap table table-striped table-bordered" cellspacing="0" width="100%">
                                       

                                        <tbody>
                                         <tr>
                                                <td>Rerata IPS</td>
                                                <td>Rerata IPK</td>
                                                <td>IPS Terbesar</td>
                                                <td>IPK Terbesar</td>
                                                <td>IPS Terkecil</td>
                                                <td>IPK Terkecil</td>
                                            </tr>
                                            <tr>
                                                <td><?= number_format($rekap_aktivitas[0]->rerata_ips,2); ?></td>
                                                <td><?= number_format($rekap_aktivitas[0]->rerata_ipk,2); ?></td>
                                                <td><?= number_format($rekap_aktivitas[0]->max_ips,2); ?></td>
                                                <td><?= number_format($rekap_aktivitas[0]->max_ipk,2); ?></td>
                                                <td><?= number_format($rekap_aktivitas[0]->min_ips,2); ?></td>
                                                <td><?= number_format($rekap_aktivitas[0]->min_ipk,2); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan='6'></td>
                                            </tr>
                                            <tr>
                                                <td>IPK 0</td>
                                                <td>IPK 0.01 - 1.00</td>
                                                <td>IPK 1.0-2.00</td>
                                                <td>IPK 2.00-3.00</td>
                                                <td>IPK 3.00-3.50</td>
                                                <td>IPK 3.50-4.00</td>
                                            </tr>
                                            <tr>
                                                <td><?= number_format($rekap_aktivitas[0]->zero); ?></td>
                                                <td><?= number_format($rekap_aktivitas[0]->zero_one); ?></td>
                                                <td><?= number_format($rekap_aktivitas[0]->one_two); ?></td>
                                                <td><?= number_format($rekap_aktivitas[0]->two_tree); ?></td>
                                                <td><?= number_format($rekap_aktivitas[0]->tree_tree_h); ?></td>
                                                <td><?= number_format($rekap_aktivitas[0]->tree_h_four); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?= round($rekap_aktivitas[0]->zero/$rekap_aktivitas[0]->total * 100,2) ?> %</td>
                                                <td><?= round($rekap_aktivitas[0]->zero_one/$rekap_aktivitas[0]->total * 100,2); ?> %</td>
                                                <td><?= round($rekap_aktivitas[0]->one_two/$rekap_aktivitas[0]->total * 100,2); ?> %</td>
                                                <td><?= round($rekap_aktivitas[0]->two_tree/$rekap_aktivitas[0]->total * 100,2); ?> %</td>
                                                <td><?= round($rekap_aktivitas[0]->tree_tree_h/$rekap_aktivitas[0]->total * 100,2); ?> %</td>
                                                <td><?= round($rekap_aktivitas[0]->tree_h_four/$rekap_aktivitas[0]->total * 100,2); ?> %</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nim</th>
                                                <th>Nama</th>
                                                <th>Prodi</th>
                                                <th>Status</th>
                                                <th>periode</th>
                                                <th>last KRS</th>
                                                <th>IPS</th>
                                                <th>IPK</th>
                                                <th>Total SKS</th>
                                                <th>SKS Semester</th>
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
                { data: "id_status_mahasiswa." },
                { data: "id_periode." },
                { data: "last_periode." },
                { data: "ips." },
                { data: "ipk." },
                { data: "sks_total." },
                { data: "sks_semester." },
            ]
        });
        });
    </script>