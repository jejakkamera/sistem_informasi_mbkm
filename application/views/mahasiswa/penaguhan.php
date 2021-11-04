<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
<link href="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/media/css/buttons.dataTables.min.css" id="theme" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/jquery/jquery.min.js"></script>
                  <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/jquery.dataTables.min.js"></script>

<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    
                   
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   
                        <div class="card card-outline-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Penaguhan</h4>
                            </div>
                            <div class="card-block">
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                                        <th>Nama</th>
                                                        <th>Janis</th>
                                                        <th>Periode</th>
                                                        <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $tagihan=0;
                                            if($penaguhan){
                                            foreach($penaguhan as $row){ ?>
                                                <tr>
                                                    <td><?php echo $row->nama_penaguhan; ?></td>
                                                    <td><?php echo $row->jenis_penaguhan; ?></td>
                                                    <td><?php echo ($row->periode); ?></td>
                                                    <td>
                                                        <form method="post" enctype="multipart/form-data"  onsubmit="return validateForm()" action="<?php echo base_url('mahasiswa/administrasi/create_penaguhan/'.$row->id_penaguhan); ?>">
                                                        
                                                        
                                                        <input type="file"  name="file_penaguhan" id="file_penaguhan"  />
                                                        <input type="hidden"  name="id_penaguhan" id="id_penaguhan" value="<?php echo $row->id_penaguhan; ?>" />

                                                        <input type="submit" id="button" onclick="return confirm('Apa Anda Yakin ?')" class="btn btn-warning"  value="Daftar" style="cursor:pointer;">
                                                        
                                                        </form>
                                                    </td>
                                                    </tr>
                                            <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                   
                            </div>
                           
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   
                        <div class="card card-outline-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Detail Pembayaran</h4>
                            </div>
                            <div class="card-block">
                                    <table id="example" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Janis</th>
                                            <th>Periode</th>
                                            <th>Status</th>
                                            <th>Information</th>
                                            <th>Action</th>
                                        </thead>
                                       
                                    </table>
                                    
                            </div>
                           
                        </div>
                    </div>
                </div>
               
            </div>

            <script type='text/javascript'>
  

$(document).ready(function() {
  

    $('#example').dataTable( {
        "columnDefs": [
            { type: 'formatted-num', targets: 2 }
        ],
        ajax: {"url": "<?php echo base_url('mahasiswa/administrasi/pengajuan_penanguhan/'); ?>", "type": "POST"},
        "columns" : [
            { "data" : "nama_penaguhan" },
            { "data" : "jenis_penaguhan" },
            { "data" : "periode" },
            { "data" : "status_validation" },
            { "data" : "information" },
            {
                "data": "id_trx",
                "render": function(data, type, row) {
                return '<a class="btn btn-info" target="_blank" href="<?php echo base_url('mahasiswa/administrasi/penanguhan_cetak/'); ?>'+data+'">Print</a>';}
            },
        ]
    } );

   

} );
    </script>