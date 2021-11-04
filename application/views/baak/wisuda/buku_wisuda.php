<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>

th, td {
  padding: 5px;
  text-align: left;
 
} 

</style>

<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<table class="table table-borderless" >
<?php 
$start = 0 ;
//print_r($cek_data);
foreach($cek_data as $row){
  if(($start%5)==0){ echo '</table><br style="page-break-before: always"><table class="table table-borderless" >'; }
  $start++;
    ?>
<tr>
    <td align="center" style="border-bottom: 1px solid #ddd;"> <img src="<?php echo base_url('assets/berkas/wisuda/'); ?><?php echo $row->berkas; ?>" alt="user"  width="90" height="120" style="border-radius: 15%;"></td>
    <td style="border-bottom: 1px solid #ddd;"><table>
        <tr><td style="padding-left: 20px;"><?php echo strtoupper($row->nim); ?></td></tr>
        <tr><td style="padding-left: 20px;"><?php echo strtoupper($row->nama); ?></td></tr>
        <tr><td style="padding-left: 20px;"><?php echo strtoupper($row->tempat_lahir); ?></td></tr>
        <tr><td style="padding-left: 20px;"><?php echo strtoupper($row->tanggal_lahir); ?></td></tr>
        <tr><td style="padding-left: 20px;"><?php echo strtoupper($row->telepon); ?></td></tr>
    </table></td>
</tr>


<?php 

} ?>
</table>