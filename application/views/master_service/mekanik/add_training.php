<?php
if (!isBolehAkses()) {
  redirect(base_url() . 'auth/error_auth');
}

$status_c = (isBolehAkses('c') ? '' : 'disabled-action' );
$status_e = (isBolehAkses('e') ? '' : 'disabled-action' );
$status_v = (isBolehAkses('v') ? '' : 'disabled-action' );
$status_p = (isBolehAkses('p') ? '' : 'disabled-action' );

$defaultDealer = $this->session->userdata("kd_dealer");
$defaultMainDealer = $this->session->userdata("kd_maindealer");
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Tambah Training Mekanik</h4>
</div>

<div class="modal-body">

    <form id="addForm" class="bucket-form" method="post" action="<?php echo base_url('master_service/add_training_simpan'); ?>">

        <div class="form-group">
            <label>Main Dealer</label>
            <select class="form-control" id="kd_maindealer" name="kd_maindealer" disabled="disabled" required>
                <option value="0">--Pilih Main Dealer-</option>
                <?php
                if ($maindealer) {
                    if (is_array($maindealer->message)) {
                        foreach ($maindealer->message as $key => $value) {
                            $aktif = ($defaultMainDealer == $value->KD_MAINDEALER) ? "selected" : "";
                            $aktif = ($this->input->get("kd_maindealer") == $value->KD_MAINDEALER) ? "selected" : $aktif;
                            echo "<option value='" . $value->KD_MAINDEALER . "' " . $aktif . ">" . $value->NAMA_MAINDEALER . "</option>";
                        }
                    }
                }
                ?> 
            </select>
        </div>

        <div class="form-group">
            <label>Dealer</label>
            <select class="form-control" id="kd_dealer" name="kd_dealer" disabled="disabled" required>
                <option value="0">--Pilih Dealer--</option>
                <?php
                if ($dealer) {
                    if (is_array($dealer->message)) {
                        foreach ($dealer->message as $key => $value) {
                            $aktif = ($defaultDealer == $value->KD_DEALER) ? "selected" : "";
                            $aktif = ($this->input->get("kd_dealer") == $value->KD_DEALER) ? "selected" : $aktif;
                            echo "<option value='" . $value->KD_DEALER . "' " . $aktif . ">" . $value->NAMA_DEALER . "</option>";
                        }
                    }
                }
                ?> 
            </select>
        </div>
        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" id="nik" class="form-control" value="<?php echo $list->message[0]->NIK; ?>" disabled="disabled">
        </div>
        <div class="form-group">
            <label class="control-label" for="date">Tanggal Training</label>
            <div class="input-group input-append date" id="datex">
                <input type="text" class="form-control" id="tgl_training" name="tgl_training" value="" placeholder="dd/mm/yyyy" required="required" />
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <div class="form-group">
            <label>Nama Training</label>
            <input type="text" name="nama_training" id="nama_training" class="form-control" placeholder="Masukkan nama training" >
        </div>
        <div class="form-group">
            <label>Status Training</label>
            <select name="status_training" id="status_training" class="form-control" required>
              <option value="" >- Pilih Status -</option>
              <?php if($status && (is_array($status->message) || is_object($status->message))): foreach ($status->message as $key => $value) : ?>
                  <option value="<?php echo $value->KD_TRAINING;?>"><?php echo $value->KD_TRAINING;?> - <?php echo $value->NAMA_TRAINING;?></option>
              <?php endforeach; endif;?>
          </select>
      </div>
      <div class="form-group">
        <label>Durasi (hari)</label>
        <input type="number" name="durasi" id="durasi" class="form-control" placeholder="Masukkan durasi" >
    </div>
    <div class="form-group">
        <label>Lokasi/ Tempat</label>
        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Masukkan lokasi training" >
    </div>
    <div class="form-group">
        <label>Pembicara</label>
        <input type="text" name="pembicara" id="pembicara" class="form-control" placeholder="Masukkan nama pemateri" >
    </div>
    <div class="form-group">
        <label>Materi</label>
        <input type="text" name="materi" id="materi" class="form-control" placeholder="Masukkan materi" >
    </div>

</form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
    <button id="submit-btn" onclick="addData();" class="btn btn-danger">Simpan</button>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        var date = new Date();
        date.setDate(date.getDate());

        $('#datex').datepicker({
            format: 'dd/mm/yyyy',
            daysOfWeekHighlighted: "0",
            autoclose: true,
            todayHighlight:true,
            onClose:function(){
                checkumur();
            }
        });
    })
</script>