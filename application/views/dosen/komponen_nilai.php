<div class="page-wrapper">
    <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   
                        <div class="card card-outline-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Ploting jadwal</h4>
                            </div>
                            <div class="card-block">
                            <a href="<?php echo base_url('dosen/perkuliahan/input_nilai_select/'.$id_trx); ?>" class="btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-pencil"></i></span> Input nilai</a> </br></br>
                                <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                     <thead>
                                        <tr>
                                            <th>Nama Komponen</th>
                                            <th>Presentase (%)</th>
                                            <th>Action</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                          <?php foreach($cek_ as $row){ ?>
                                          <tr>
                                            <td><?php echo $row['komponen'];?></td>
                                            <td><?php echo $row['presentase'];?></td>
                                            <td><a href="#edit_modal" class="btn btn-default btn-small" data-toggle="modal" data-id="<?php echo $row['id'];  ?>" data-id_trx="<?php echo $id_trx;  ?>" >Edit</a></td>
                                            <!-- <td><a href="<?php echo base_url('dosen/perkuliahan/komponen_nilai_edit/'.$row['id'].'/'.$id_trx); ?>" class="btn btn-warning"><span class="btn-label"><i class="fa fa-pencil"></i></span></a></td> -->
                                         </tr>
                                          <?php } ?>
                                          <tr>
                                            <td><form action="<?php echo $action; ?>" method="post"><input type="text" name="nama" required></td>
                                            <td><input type="number" name="presentase" required></td>
                                            <td> <input type="submit" value="simpan"> </form></td>
                                         </tr>
                                     </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>

<div class="modal fade" id="edit_modal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Komponen Nilai</h4>
                </div>
                <div class="modal-body">
                    <div class="hasil-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#edit_modal').on('show.bs.modal', function (e) {
            var idx = $(e.relatedTarget).data('id');
            var id_trx = $(e.relatedTarget).data('id_trx');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : "<?php echo base_url('dosen/perkuliahan/komponen_nilai_edit/'); ?>"+idx+"/"+id_trx,
                // data :  'idx='+ idx,
                success : function(data){
                $('.hasil-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>