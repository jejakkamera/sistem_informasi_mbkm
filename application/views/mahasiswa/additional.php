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
                                <h4 class="m-b-0 text-white">UKT</h4>
                            </div>
                            <div class="card-block">
                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                                        <th>Nama</th>
                                                        <th>Janis</th>
                                                        <th>Total Tagihan</th>
                                                        <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $tagihan=0;
                                            if($pembayaran){
                                            foreach($pembayaran as $row){ ?>
                                                <tr>
                                                    <td><?php echo $row->nama_additional; ?></td>
                                                    <td><?php echo $row->jenis_additional; ?></td>
                                                    <td><?php echo number_format($row->tagihan); ?></td>
                                                    <td><?php 
                                                        $max_bayar=$row->tagihan;
                                                        $tagihan=1;?>
                                                        <form method="post"  onsubmit="return validateForm()" action="<?php echo base_url('mahasiswa/administrasi/ukt_generate_tagihan_additional/'.$row->id_additional); ?>">
                                                        
                                                        
                                                        <input type="hidden"  name="total_bayar" id="total_bayar" value="<?php echo ($row->tagihan); ?>" />
                                                        <input type="hidden"  name="id_additional" id="id_additional" value="<?php echo $row->id_additional; ?>" />

                                                        <input type="submit" id="button" onclick="return confirm('Apa Anda Yakin ?')" class="btn btn-warning"  value="Bayar" style="cursor:pointer;">
                                                        
                                                        </form>
                                                    </td>
                                                    </tr>
                                            <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <?php if($va){ 
                                        ?>
                                        Silahkan Lakukan Pembayaran Pada Norek/VA di bawah. <b>(BANK BNI)</b>.
                            <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="50%">
                                        <thead>
                                        <tr>
                                                        <th>No Rek/VA</th>
                                                        <th><?php echo ($virtual_account); ?></th>
                                                       
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td><?php echo ($va->customer_name); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tagihan</td>
                                                    <td><?php echo number_format($va->trx_amount); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Bayar Sebelum :</td>
                                                    <td><?php echo date('d M Y H:s:i',strtotime($va->datetime_expired)); ?></td>
                                                </tr>
                                        </tbody>
                            </table>Cara Pembayaran : 
                            <a href="<?php echo base_url(); ?>assets/pembayaran_pmb_atm_bersama_1.pdf" class="btn btn-success waves-effect waves-light" type="button">VIA ATM Bersama</a>
                            <a href="<?php echo base_url(); ?>assets/pembayaran_pmb_atm_bni_1.pdf" class="btn btn-success waves-effect waves-light" type="button">VIA ATM BNI (sesama BNI)</a>
                            <a href="<?php echo base_url(); ?>assets/pembayaran_pmb_internet_banking.pdf" class="btn btn-success waves-effect waves-light" type="button">VIA Internet Banking</a>
                            <a href="<?php echo base_url(); ?>assets/pembayaran_pmb_setor_tunai.pdf" class="btn btn-success waves-effect waves-light" type="button">VIA Setor Tunai / Teller</a>
                            <?php }?>
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
                                                        <th>Jenis</th>
                                                        <th>No Kwitansi</th>
                                                        <th>Total Bayar</th>
                                                        <th>Tanggal Bayar</th>
                                        </thead>
                                       
                                    </table>
                                    
                            </div>
                           
                        </div>
                    </div>
                </div>
               
            </div>

            <script type='text/javascript'>
  function validateForm() {
    // var max_bayar=<?php echo $max_bayar; ?>;
    // var total_bayar=parseInt(document.getElementById('total_bayar').value);
    // if(total_bayar<=1 && total_bayar>=100000){
        return true;
    // }else{
    //     swal("Warning!", "Anda Melebihi tagihan atau kurang batas minimal Tagihan : "+max_bayar+","+total_bayar, "error");
    //     return false;
    // }
}

$(document).ready(function() {
    $('#example').dataTable( {
        "columnDefs": [
            { type: 'formatted-num', targets: 2 }
        ],
        ajax: {"url": "<?php echo base_url('mahasiswa/administrasi/kwitansi_additional/'); ?>", "type": "POST"},
        "columns" : [
            { "data" : "nama" },
            { "data" : "jenis" },
            { "data" : "no_kwitansi" },
            { "data" : "amount",render: $.fn.dataTable.render.number(',', '.', 0, '') },
            { "data" : "tanggal" },
        ]
    } );
} );
    </script>