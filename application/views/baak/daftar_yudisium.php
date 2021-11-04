<link href="<?php echo base_url(); ?>assets/themplate/assets/plugins/wizard/steps.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables/media/css/buttons.dataTables.min.css" id="theme" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables24/css/jquery.dataTables.min.css" rel="stylesheet" />

       <div class="page-wrapper">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block wizard-content">
                                <h4  class="card-title">Form Yudisium <a class="btn btn-info" target="_blank" href="<?php echo base_url('/assets/berkas/yudisium/'.$data_master->berkas); ?>" > Berkas </a></h4>
                                
                                <form action="#" class="tab-wizard wizard-circle">
                                    <!-- Step 1 -->
                                    <h6>Data Pribadi</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="firstName1">nim :</label>
                                                    <input type="text" readonly name="nim" class="form-control" id="nim" value="<?php echo $data_master->nim; ?>"> </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="firstName1">Nama :</label>
                                                    <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $data_master->nama; ?>"> </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="firstName1">Tanggal Lahir :</label>
                                                    <input type="text" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="<?php echo $data_master->tanggal_lahir; ?>" > </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="firstName1">Tempat Lahir :</label>
                                                    <input type="text" nama="tempat_lahir" class="form-control" id="tempat_lahir" value="<?php echo $data_master->tempat_lahir; ?>"  > </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="firstName1">Jenis Kelamin :</label>
                                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                                        <option value="L" <?php if($data_master->jenis_kelamin=='L'){echo "selected";}  ?>>Laki-laki</option>
                                                        <option value="P" <?php if($data_master->jenis_kelamin=='P'){echo "selected";}  ?>  >Perempuan</option>
                                                    </select>

                                                    <!-- <input type="text" class="form-control" id="firstName1" value="<?php echo $data_master->jenis_kelamin; ?>"> </div> -->
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="firstName1">No HP :</label>
                                                    <input type="text" name='handphone' class="form-control" id="handphone" value="<?php echo $data_master->handphone; ?>" > </div>
                                            </div>
                                        </div>
                                      
                                    </section>
                                    <!-- Step 2 -->
                                    <h6>Transkript</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <table class="table product-overview" id="zero_config">
                                                <thead>
                                                    <tr>
                                                        <th>Kode MK</th>
                                                        <th>Nama MK</th>
                                                        <th>SKS</th>
                                                        <th>Semester</th>
                                                        <th>Nilai</th>
                                                        <th>Angka Mutu</th>
                                                        <th>Huruf Mutu</th>
                                                        <th>transfer</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Kode MK</th>
                                                        <th>Nama MK</th>
                                                        <th>SKS</th>
                                                        <th>Semester</th>
                                                        <th>Nilai</th>
                                                        <th>Angka Mutu</th>
                                                        <th>Huruf Mutu</th>
                                                        <th>transfer</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php $total=0;?>
                                                <?php foreach($transkript as $rows){ ?>
                                                    <tr>
                                                        <td ><input readonly='' type="text" class="form-control" id="kode_mk" name="kode_mk" value="<?php echo $rows['kode_mata_kuliah'] ?>"> </td>
                                                        <td><input readonly='' type="text"  id="nama_mk" name="nama_mk" value="<?php echo $rows['nama_mata_kuliah'] ?>"> 
                                                        
                                                        <td><input  readonly='' type="text" class="form-control" id="sks_mk" name="sks_mk" value="<?php echo $rows['sks_mata_kuliah'] ?>"> </td>
                                                        <td><input readonly='' type="text" class="form-control" id="semester" name="semester" value="<?php echo $rows['semester'] ?>"> </td>
                                                        <td><input readonly='' type="text" class="form-control" id="nilai_total" name="nilai_total" value="<?php echo $rows['max_nilai_total'] ?>"> </td>
                                                        <td><input readonly='' type="text" class="form-control" id="nilai_grade" name="nilai_grade" value="<?php echo $rows['max_nilai_index'] ?>"> </td>
                                                        <td><input readonly='' type="text" class="form-control" id="grade" name="grade" value="<?php echo $rows['nilai_huruf'] ?>"> </td>
                                                        <td><input readonly='' type="text" class="form-control" id="grade" name="grade" value="<?php echo $rows['transfer'] ?>"> </td>
                                                    <?php $total=$total+($rows['max_nilai_kumulatif']); ?>
                                                        
                                                    </tr>
                                                <?php }?>
                                                
                                                </tbody>
                                            </table>

                                            Total SKS :<?php $sum = array_sum(array_column($transkript, 'sks_mata_kuliah')); echo $sum?><br>
                                            Total : <?php echo $total?> <br>
                                            IPK : <?php echo number_format(($total/$sum),2);?><br>
                                            <input type="hidden" class="form-control" id="total_sks" nama="total_sks" value="<?php echo $sum; ?>"> 
                                            <input type="hidden" class="form-control" id="ipk" nama="ipk" value="<?php echo number_format(($total/$sum),2); ?>"> 
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 3 -->
                                    <h6>Ijazah</h6>
                                    <section>
                                    <div class="row">
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="firstName1">No Ijazah :</label>
                                                    <input type="text" class="form-control" id="no_ijasah" nama="no_ijasah" value="<?php echo $data_master->no_ijasah; ?>"> </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="firstName1">No Transkript :</label>
                                                    <input type="text" class="form-control" id="no_transkrip" nama="no_transkrip" value="<?php echo $data_master->no_transkrip; ?>"> </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="firstName1">PIN :</label>
                                                    <input type="text" class="form-control" id="pin" nama="pin" value="<?php echo $data_master->pin; ?>"> </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="firstName1">Judul (B.Indonesia) :</label>
                                                    <input type="text" class="form-control" id="judul_indo" nama="judul_indo" value="<?php echo $data_master->judul_indo; ?>"> </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="firstName1">Judul (Inggris) :</label>
                                                    <input type="text" class="form-control" id="judul_ing" nama="judul_ing" value="<?php echo $data_master->judul_ing; ?>"> </div>
                                            </div>
                                            
                                        </div>
                                      
                                    </section>
                                    
                                </form>

                                <button id="submit-row" class="btn btn-warning mr-1 inputs-submit"><i class="fa fa-save"></i> Submit form</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/wizard/jquery.steps.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/wizard/jquery.validate.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/wizard/steps.js"></script>
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/blockUI/jquery.blockUI.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/datatables24/js/jquery.dataTables.min.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function() {
        var table = $('#zero_config').DataTable({
                        
                        "lengthMenu": [[ -1], [ "All"]],
                        "autoWidth": true,
                         "columns": [
                            { "orderDataType": "dom-text", type: 'string' },
                            { "orderDataType": "dom-text", type: 'string' },
                            { "orderDataType": "dom-text-numeric" },
                            { "orderDataType": "dom-text-numeric" },
                            { "orderDataType": "dom-text-numeric" },
                            { "orderDataType": "dom-text-numeric" },
                            { "orderDataType": "dom-text", type: 'string' },
                            { "orderDataType": "dom-text", type: 'string' },
                            
                        ],
                    });

        $('#submit-row').click( function() {
            var nim =  ("<?php echo $data_master->nim; ?>") ;
            var periode =  ("<?php echo $data_master->periode; ?>") ;
            var id_trx =  ("<?php echo $id_trx; ?>") ;
            var nama =  document.getElementById("nama").value ;
            var ipk =  document.getElementById("ipk").value ;
            var total_sks =  document.getElementById("total_sks").value ;
            var tanggal_lahir =  document.getElementById("tanggal_lahir").value ;
            var tempat_lahir =  document.getElementById("tempat_lahir").value ;
            var jenis_kelamin =  document.getElementById("jenis_kelamin").value ;
            var handphone =  document.getElementById("handphone").value ;
            var no_ijasah =  document.getElementById("no_ijasah").value ;
            var no_transkrip =  document.getElementById("no_transkrip").value ;
            var pin =  document.getElementById("pin").value ;
            var judul_indo =  document.getElementById("judul_indo").value ;
            var judul_ing =  document.getElementById("judul_ing").value ;
            var datas = JSON.stringify( table.$("input, select").serializeArray());
            $.blockUI();
                        $.blockUI({ message: '<i class="fas fa-spin fa-sync text-white"></i>' });
                        $.blockUI({ css: {  border: 0,padding: 0,color: '#333',backgroundColor: 'transparent'} });
                        $.post("<?php echo base_url(); ?>baak/tugas_akhir/ta_s1/daftar_yudisium_action",
                            {
                                datas: datas,
                                id_trx:id_trx,
                                nim:nim,
                                nama:nama,
                                ipk:ipk,
                                total_sks:total_sks,
                                periode:periode,
                                tanggal_lahir:tanggal_lahir,
                                tempat_lahir:tempat_lahir,
                                jenis_kelamin:jenis_kelamin,
                                handphone:handphone,
                                no_ijasah:no_ijasah,
                                no_transkrip:no_transkrip,
                                pin:pin,
                                judul_indo:judul_indo,
                                judul_ing:judul_ing,
                            }, function(data,status){
                                var obj = JSON.parse(data);
                                $.unblockUI();
                                

                             if(obj.status==200){
                                swal("Good job!", obj.message, "success");
                                window.setTimeout(function () {
			 
                                    
                                    window.location.assign("<?php echo base_url('baak/tugas_akhir/ta_s1/yudisium_daftar/'.$id_yudisium.'/'.$periode); ?>");

                                }, 4000);                               
                            }else{
                                swal("Cancelled", obj.message, "error");
                            }  
                            });

        } );
    } );
    </script>