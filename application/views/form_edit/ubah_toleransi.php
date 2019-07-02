<?php
if (!isBolehAkses()) {
  redirect(base_url() . 'auth/error_auth');
}

$status_c = (isBolehAkses('c') ? '' : 'disabled-action' );
$status_e = (isBolehAkses('e') ? '' : 'disabled-action' );
$status_v = (isBolehAkses('v') ? '' : 'disabled-action' );
$status_p = (isBolehAkses('p') ? '' : 'disabled-action' );
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Edit Master Toleransi</h4>
</div>

<div class="modal-body">

    <form id="addForm" class="bucket-form" method="post" action="<?php echo base_url('motor/update_toleransi/'. $list->message[0]->ID); ?>">
      <input type="hidden" name="id" id="id" class="form-control" value="<?php echo  $list->message[0]->ID; ?>" >
      <input type="hidden" name="kd_maindealer" id="kd_maindealer" class="form-control" value="<?php echo  $list->message[0]->KD_MAINDEALER; ?>" >
      <input type="hidden" name="kd_dealer" id="kd_dealer" class="form-control" value="<?php echo  $list->message[0]->KD_DEALER; ?>" >
      
      <!-- propinsi -->
      <div class="form-group">
        <label>Propinsi</label>
        <select class="form-control disabled-action" name="kd_propinsi" id="kd_propinsi" title="propinsi" readonly>
            <option value="0">--Pilih Propinsi--</option>
            <?php
            if ($propinsi) {
                if (is_array($propinsi->message)) {
                    foreach ($propinsi->message as $key => $value) {
                        $select=($list->message[0]->KD_PROPINSI == $value->KD_PROPINSI)?"selected":"";
                        echo "<option value='" . $value->KD_PROPINSI . "' ".$select.">" . $value->NAMA_PROPINSI . "</option>";
                    }
                }
            }
            ?>
        </select>
    </div>
    <!-- kabupaten -->
    <div class="form-group">
        <label>Kabupaten <span id="l_kabupaten"></span></label>
        <select class="form-control disabled-action" id="kd_kabupaten" name="kd_kabupaten" title="kabupaten" readonly>
            <option value="0">--Pilih Kabupaten--</option>
        </select>
    </div>


    <div class="form-group">
        <label>Toleransi (Hari)</label>
        <input type=number" name="toleransi" id="toleransi" class="form-control" value="<?php echo  $list->message[0]->TOLERANSI; ?>">
    </div>

    <div class="form-group">
       <label>Status</label>
       <select name="row_status" class="form-control">
         <option value="<?php echo $list->message[0]->ROW_STATUS;?>"> <?php if($list->message[0]->ROW_STATUS == 0){echo "Aktif"; }ELSE{ echo "Tidak Aktif"; }?> </option>
         <?php
         if($list->message[0]->ROW_STATUS == -1){
             ?>
             <option value="0">Aktif</option>
             <?php
         }else{
             ?>
             <option value="-1">Tidak Aktif</option>
             <?php
         }
         ?>
     </select>
 </div>
</form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
    <button id="submit-btn" onclick="addData();" class="btn btn-danger">Simpan</button>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        loadData('kd_kabupaten', $('#kd_propinsi').val(), "<?php echo $list->message[0]->KD_KABUPATEN;?>");
        /*pilihan propinsi*/
        $('#kd_propinsi').on('change', function () {
            loadData('kd_kabupaten', $('#kd_propinsi').val(), "<?php echo $list->message[0]->KD_KABUPATEN;?>")
        })

        $("#submit-btn").on('click',function(event){
            var formId = '#'+$(this).closest('form').attr('id');
            var btnId = '#'+this.id;
            $('#loadpage').removeClass("hidden");

            $(formId).validate({
                highlight: function(element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function(error, element) {
                    if(element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            if (jQuery(formId).valid()) {
                // Do something
                event.preventDefault();

                addValid(formId, btnId);

            }else{
                $('#loadpage').addClass("hidden");
                $(window).scrollTop($('.form-group').hasClass('has-error').offset().top);
            }
        });
    })

    function loadData(id, value, select) {

        var param = $('#' + id + '').attr('title');
        $('#l_' + param + '').html("<i class='fa fa-spinner fa-spin'></i>");
        var urls = "<?php echo base_url(); ?>master_service/" + param;
        var datax = {"kd": value};
        $('#' + id + '').attr('disabled','disabled');
        $.ajax({
            type: 'POST',
            url: urls,
            data: datax,
            typeData: 'html',
            success: function (result) {
                $('#' + id + '').html('');
                $('#' + id + '').html(result);
                $('#' + id + '').val(select).select();
                $('#l_' + param + '').html('');
                $('#' + id + '').removeAttr('disabled');
            }
        });
    }
</script>