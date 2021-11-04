<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/themplate/assets/plugins/dual-list/bootstrap-duallistbox.css">
<script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/dual-list/jquery.bootstrap-duallistbox.js"></script>
<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?> 
                <div class="row page-titles">
                </div>
                
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 ">
                        <div class="card">
                        <h1><?php echo $periode; ?></h1>
                        <hr>
                            <form id="demoform" action="<?php echo $action; ?>" method="post">
                            <select multiple="multiple" size="15" name="duallistbox_demo1[]" title="duallistbox_demo1[]">
                                <?php foreach($data_master as $row){ ?>
                                    <option value="<?php echo $row->id_matkul; ?>" <?php if($row->id_kurikulum_saji==$id_kurikulum and $row->periode==$periode ){ echo "selected";} ?>>Smt : <?php echo $row->semester; ?> (<?php echo $row->kode_mata_kuliah; ?> - <?php echo $row->nama_mata_kuliah; ?>)</option>
                                <?php } ?>
                            </select>
                            <br>
                            <select  name="ok" title="ok" required>
                                <option value="">-</option>
                                <option value="ok">Selesai</option>
                            </select>
                            <button type="submit" class="btn btn-default btn-block">Submit data</button>
                            </form>
                            <script>
                            var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({
                                nonSelectedListLabel: 'Non-selected',
                                selectedListLabel: 'Selected',
                                preserveSelectionOnMove: 'moved',
                                moveOnSelect: false,
                            });
                            $("#demoform").submit(function() {
                                $.post("<?php echo $action; ?>",
                                    {
                                        duallistbox_demo2: ($('[name="duallistbox_demo1[]"]').val()),
                                    },
                                    function(data,status){
                                        alert("Data: " + data + "\nStatus: " + status);
                                        window.location.href = "<?php echo base_url('baak/frs/set_kurikulum/') ?>";
                                    });

                                // alert($('[name="duallistbox_demo1[]"]').val());
                                return false;
                            });
                            </script>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
   