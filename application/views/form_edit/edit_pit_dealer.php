<?php
$defaultDealer = $this->session->userdata("kd_dealer");
if (!isBolehAkses()) {
  redirect(base_url() . 'auth/error_auth');
}

$status_c = (isBolehAkses('c') ? '' : 'disabled-action' );
$status_e = (isBolehAkses('e') ? '' : 'disabled-action' );
$status_v = (isBolehAkses('v') ? '' : 'disabled-action' );
$status_p = (isBolehAkses('p') ? '' : 'disabled-action' );

?>

<form id="addForm" class="bucket-form" method="post" action="<?php echo base_url('dealer/update_pit_dealer/' . $list->message[0]->ID); ?>">

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Edit Pit Dealer : <?php echo  $list->message[0]->NAMA_PIT; ?></h4>
  </div>

  <div class="modal-body">

    <div class="row">

      <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">
          <label>Nama Dealer</label>
          <select class="form-control disabled-action" id="kd_dealer" name="kd_dealer" readonly>
            <option value="0">--Pilih Dealer--</option>
            <?php
            if ($dealer) {
              if (is_array($dealer->message)) {
                foreach ($dealer->message as $key => $value) {
                  $aktif = ($defaultDealer == $value->KD_DEALER) ? "selected" : "";
                  $aktif = ($this->input->get("kd_delaer") == $value->KD_DEALER) ? "selected" : $aktif;
                  echo "<option value='" . $value->KD_DEALER . "' " . $aktif . ">" . $value->NAMA_DEALER . "</option>";
                }
              }
            }
            ?> 
          </select>
        </div>

        <div class="form-group">
          <label>Kode Pit</label>
          <input type="text" name="kd_pit" id="kd_pit" class="form-control" value="<?php echo  $list->message[0]->KD_PIT; ?>" readonly maxlength="5" required>
        </div>
        <div class="form-group">
          <label>Jenis Pit</label>
          <select name="jenis_pit" class="form-control">
            <option value="">- Pilih Jenis Pit -
            </option>
            <?php if($jenispit && (is_array($jenispit->message) || is_object($jenispit->message))): foreach ($jenispit->message as $key => $value) : ?>
              <option value="<?php echo $value->KD_JENISPIT;?>" <?php echo ($value->KD_JENISPIT == $list->message[0]->JENIS_PIT ? "selected" : "");?>><?php echo $value->KD_JENISPIT;?> - <?php echo $value->NAMA_JENISPIT;?>
              </option>
            <?php endforeach; endif;?>
          </select>
        </div>

        <div class="form-group">
          <label>Nama Pit</label>
          <input type="text" name="nama_pit" id="nama_pit" class="form-control" value="<?php echo  $list->message[0]->NAMA_PIT; ?>" required>
        </div>
                    <div class="form-group">
                <label>Urutan</label>
                <input id="urutan" type="text" name="urutan" class="form-control" value="<?php echo  $list->message[0]->URUTAN; ?>">
              </div>

        <div class="form-group">
         <label>Status</label>
         <select name="row_status" class="form-control">
           <option value="<?php echo $list->message[0]->ROW_STATUS;?>"> <?php if($list->message[0]->ROW_STATUS == 0){echo "Aktif"; }else{ echo "Tidak Aktif"; }?> </option>
           <?php
           if($list->message[0]->ROW_STATUS == 0){
             ?>
             <option value="-1">Tidak Aktif</option>
             <?php
           }else{
             ?>
             <option value="0">Aktif</option>
             <?php
           }
           ?>
         </select>
       </div>

     </div>

   </div>

 </div>

 <div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  <button id="submit-btn" type="submit" class="btn btn-danger <?php echo  $status_e ?> submit-btn">Simpan</button>
</div>

</form>
<script type="text/javascript">
    
    $(document).ready(function(e){
        
        $('#urutan')
           .focusout(function(){
           })
           .ForceNumericOnly()
            });

</script>