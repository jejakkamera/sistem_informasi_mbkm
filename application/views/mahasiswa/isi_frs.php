<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

<div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    
                   
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>   
                        <div class="card card-outline-danger">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Pengisian FRS <?php echo $periode; ?></h4>
                            </div>
                            <div class="card-block">
                            <?php if($this->session->userdata('role')=='mhs' ){ ?>
                                <form method="post"  onsubmit="return validateForm()" action="<?php echo base_url('mahasiswa/frs/isi_select_action_add/'); ?>">
                            <?php }else{ ?>
                                <form method="post"  onsubmit="return validateForm()" action="<?php echo base_url('baak/mahasiswa/isi_select_action_add/'.$nim); ?>">
                            <?php } ?>
                            

                                    <table id="mytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                                        <th>Kode MK</th>
                                                        <th>Nama MK</th>
                                                        <th>Semester</th>
                                                        <th>Sks</th>
                                                        <th>Periode</th>
                                                        <th>Ambil MK</th>
                                                        <th>Mengulang</th>
                                        </thead>
                                        <tbody>
                                            <?php $total_pilih=0;
                                            foreach($kurikulum as $row){ ?>
                                                <tr>
                                                    <td><?php echo $row->kode_mata_kuliah ?></td>
                                                    <td><?php echo $row->nama_mata_kuliah ?></td>
                                                    <td><?php echo $row->semester ?></td>
                                                    <td><?php echo $row->sks_mata_kuliah ?></td>
                                                    <td><?php echo $row->periode_ambil ?></td>
                                                    <td align="center"><?php if($row->periode_ambil!=null && $row->periode_ambil!=$periode){

                                                        echo '<i class="fa fa-check"></i>';

                                                        }else{
                                                            
                                                        ?>
                                                        <input type="checkbox" <?php if($row->periode_ambil==$periode){ echo "checked disabled=''"; } ?>   class="form-control form-control-sm" id="myCheck" name="mk[]"  onclick="checkChoice(this);" value="<?php echo $row->id_matkul."#".$row->sks_mata_kuliah;?>">

<?php 
if((($row->status_frs=='tolak') or ($row->status_frs=='pilih')or ($row->status_frs=='setujui') )and ($row->periode_ambil==$periode) ){ 
    $total_pilih=$total_pilih+$row->sks_mata_kuliah; }
if(($row->status_frs=='tolak') or ($row->status_frs=='pilih') ){?>

                            <?php if($this->session->userdata('role')=='mhs' ){ ?>
                                <a  class="btn btn-default" href="<?php echo base_url('mahasiswa/frs/isi_select_action_hapus/'.$row->id_trx); ?>">Hapus MK (Di<?php echo $row->status_frs_; ?>) </a>
                            <?php }else{ ?>
                                <a  class="btn btn-default" href="<?php echo base_url('baak/mahasiswa/isi_select_action_hapus/'.$row->id_trx); ?>">Hapus MK (Di<?php echo $row->status_frs_; ?>) </a>
                            <?php } ?>

    

<?php }  ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php if($row->periode_ambil!=null && $row->periode_ambil!=$periode){ ?>
                                                            <input type="checkbox" class="form-control form-control-sm" id="myCheck" name="mk_ulang[]"  onclick="checkChoice(this);" value="<?php echo $row->id_matkul."#".$row->sks_mata_kuliah;?>">
                                                        <?php }else{echo '<i class="fa fa-minus"></i>';} ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <table>
                                        <tr><td><p id="textnya">Total SKS dipilih :</p></td><td><p id="total_sks_pilih"><?php echo $total_pilih; ?></p></td></tr>
                                        <tr><td>Kelas Perkuliahan : </td><td>
                                             <select name="kode_kelas" >
                                                <?php foreach($kelas as $row){ ?>
                                                <option value="<?php echo $row['id_kelas']; ?>"> <?php echo $row['nama_kelas']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td></tr>
                                        </table>
                                    <input type="submit" id="button" onclick="return confirm('Apa Anda Yakin ?')" class="btn btn-warning"  value="Proses" style="cursor:pointer;">
                                    <input type="hidden"  name="periode" value="<?php echo $periode; ?>" />
                                    </form>
                                    
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>

            
<script type='text/javascript'>
  function validateForm() {
    var jlm_sks_pilih=parseInt(document.getElementById('total_sks_pilih').innerHTML);
    if(jlm_sks_pilih<=24 && jlm_sks_pilih>=1){
        return true;
    }else{
        swal("Warning!", "Anda tidak memenuhi atau melebihi sks yang telah di tentukan.", "error");
        return false;
    }
}
    </script>
<script type='text/javascript'>  
    function checkChoice() {
    var inputElems = document.getElementsByTagName("input"),
        count = 0;
        // var jumlah_sks=<?php echo $total_pilih;?>;
        var jumlah_sks=0;
        for (var i=0; i<inputElems.length; i++) {       
           if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
              count++;
              data=inputElems[i].value;
              sks=data.substr(data.indexOf('#')+1,1);
              jumlah_sks=(parseInt(jumlah_sks))+parseInt(sks);
           }
        }
        document.getElementById('total_sks_pilih').innerHTML  = jumlah_sks;
    	}
	</script>