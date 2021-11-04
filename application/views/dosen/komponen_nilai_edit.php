<form action="<?php echo $action; ?>" method="post"><input type="text" name="komponen" value="<?php echo $cek_->komponen;  ?>" required>
                                            <input type="number" name="presentase" value="<?php echo $cek_->presentase;  ?>" required>
                                             <input type="submit" value="simpan"> </form>
                                            <hr> last edit : <?php echo $cek_->update_info;  ?>