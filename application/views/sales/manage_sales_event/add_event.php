<?php
if (!isBolehAkses()) {
  redirect(base_url() . 'auth/error_auth/true');
}
$status_c = (isBolehAkses('c') ? '' : 'disabled-action' );
$status_e = (isBolehAkses('e') ? '' : 'disabled-action' );
$status_v = (isBolehAkses('v') ? '' : 'disabled-action' );
$status_p = (isBolehAkses('p') ? '' : 'disabled-action' );
$end_date=date('d/m/Y',strtotime('Last day of this month'));
$start_date=date('d/m/Y');
$defaultDealer = ($this->input->get("kd_dealer")) ? $this->input->get("kd_dealer") : $this->session->userdata("kd_dealer");
?>
<form id="addForm" class="bucket-form" action="<?php echo base_url('sales_event/add_event_simpan');?>" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Tambah Event</h4>
  </div>

  <div class="modal-body">
    <!-- 1 -->
    <div class="row">
      <div class="col-sm-3">
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
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <label>Event ID</label>
          <select class="form-control" id="id_event" name="id_event" required="true">
            <option value="" >- Pilih Event ID -</option>
            <?php if($event && (is_array($event->message) || is_object($event->message))): foreach ($event->message as $key => $value) : ?>
              <option value="<?php echo $value->ID_EVENT;?>"><?php echo $value->ID_EVENT;?> - <?php echo $value->NAMA_EVENT;?></option>
            <?php endforeach; endif;?>
          </select>
        </div>
      </div>

      <div class="col-sm-3">  
        <div class="form-group">
          <label>Nama Event</label>
          <input type="text" id="nama_event" name="nama_event" class="form-control">
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <label>TanggaL</label>
          <div class="input-group input-append date" id="date">
            <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy"  value="<?php echo $start_date; ?>"/>
            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
      </div>

    </div>

    <!-- 2 -->
    <div class="row">

      <div class="col-sm-3">
        <div class="form-group">
          <label>Jenis Event</label>
          <select class="form-control" id="jenis_event" name="jenis_event" required="true">
            <option value="" >- Pilih Jenis Event -</option>
            <?php if($jevent && (is_array($jevent->message) || is_object($jevent->message))): foreach ($jevent->message as $key => $value) : ?>
              <option value="<?php echo $value->NAMA_JENIS;?>"><?php echo $value->NAMA_JENIS;?> - <?php echo $value->KD_JENIS;?></option>
            <?php endforeach; endif;?>
          </select>
        </div>
      </div>

      <div class="col-sm-2">
        <div class="form-group">
          <label>Unit Target</label>
          <input type="text" id="unit_target" name="unit_target" class="form-control" placeholder="0" >
        </div>
      </div>

      <div class="col-sm-2">
        <div class="form-group">
          <label>Revenue Target</label>
          <input type="text" id="revenue_target" name="revenue_target" class="form-control" placeholder="0" >
        </div>
      </div>

      <div class="col-sm-2">
        <div class="form-group">
          <label>Budget Event</label>
          <input type="text" id="budget_event" name="budget_event" class="form-control" placeholder="0" >
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <label>Lokasi</label>
          <input type="text" id="loc_event" name="loc_event" class="form-control" placeholder="-" >
        </div>
      </div>

    </div>

    <!-- 3 -->
    <div class="row">

      <div class="col-sm-3">
        <div class="form-group">
          <label>Tanggal Mulai</label>
          <div class="input-group input-append date" id="date">
            <input type="text" class="form-control" id="start_date" name="start_date"  placeholder="dd/mm/yyyy" value="<?php echo $start_date; ?>"/>
            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <label>Tanggal Selesai</label>
          <div class="input-group input-append date" id="date">
            <input type="text" class="form-control" id="end_date" name="end_date" placeholder="dd/mm/yyyy" value="<?php echo $end_date; ?>"/>
            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
      </div>

      <!-- <div class="col-sm-2">
        <div class="form-group">
          <label>Unit to Display</label>
          <input type="text" id="unit_to_display" name="unit_to_display" class="form-control" placeholder="Unit to Display" >
        </div>
      </div> -->

      <div class="col-sm-4">
        <div class="form-group">
          <label>Deskripsi Event</label>
          <textarea type="text" rows="1" name="desc_event" id="desc_event" class="form-control" placeholder="Masukkan Deskripsi"></textarea>
        </div>
      </div>

    </div>

  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
    <button id="submit-btn" type="submit" class="btn btn-danger submit-btn">Simpan</button>
  </div>
</form>

<script type="text/javascript">
   var path = window.location.pathname.split('/');
   var http = window.location.origin + '/' + path[1];

   $(document).ready(function(){
      ListEvent();

      $("#id_event").change(function(){
         var id_event = $(this).val();

         $.getJSON("<?php echo base_url("sales_event/get_event");?>",
            {'id_event':id_event},
              function(result){
                if(result.status == true){
                  $.each(result.message,function(e,d){
                  $("#nama_event").val(d.NAMA_EVENT);
                  $("#start_date").val(d.START_DATE);
                  $("#end_date").val(d.END_DATE);
                  $("#jenis_event").val(d.JENIS_EVENT);
                  $("#unit_target").val(d.UNIT_TARGET);
                  $("#revenue_target").val(d.REVENUE_TARGET);
                  $("#budget_event").val(d.BUDGET_EVENT);
                  $("#loc_event").val(d.LOC_EVENT);
                  //$("#unit_to_display").val(d.UNIT_TO_DISPLAY);
                  $("#desc_event").val(d.DESC_EVENT);
               })
               }
            }
            )
      });
   })

   function ListEvent(){
      var datax=[];
   }
 </script>