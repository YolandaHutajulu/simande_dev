<?php
$defaultDealer =($this->input->get("kd_dealer"))? $this->input->get("kd_dealer"): $this->session->userdata("kd_dealer");
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Edit Unit</h4>
</div>

<div class="modal-body">
   <form id="addForm" class="bucket-form" method="post" action="<?php echo base_url('sales_event/update_unit/' . $list->message[0]->ID); ?>">
      <input type="hidden" name="id" id="id" class="form-control" value="<?php echo  $list->message[0]->ID; ?>" ><input type="hidden" name="kd_event" id="kd_event" class="form-control" value="<?php echo  $list->message[0]->KD_EVENT; ?>" >

      <div class="form-group">
        <label>Dealer</label>
        <select class="form-control" id="kd_dealer" name="kd_dealer" disabled>
          <option value="0">--Pilih Dealer--</option>
          <?php
          if ($dealer) {
            if (($dealer->totaldata > 0)) {
              foreach ($dealer->message as $key => $value) {
                $aktif = ($defaultDealer == $value->KD_DEALER) ? "selected" : "";
                echo "<option value='" . $value->KD_DEALER . "' " . $aktif . ">" . $value->NAMA_DEALER . "</option>";
              }
            }
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label>Kode Item</label>
        <input type="text" name="kd_item" id="kd_item" class="form-control" value="<?php echo  $list->message[0]->KD_ITEM; ?>" readonly>
      </div>

      <div class="form-group">
        <label>Nama Item</label>
        <input type="text" name="nama_item" id="nama_item" class="form-control" value="<?php echo  $list->message[0]->NAMA_ITEM; ?>" readonly>
      </div>

      <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?php echo  $list->message[0]->KETERANGAN; ?>" >
      </div>

  </form>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  <button id="submit-btn" onclick="addData();" class="btn btn-danger">Simpan</button>
</div>