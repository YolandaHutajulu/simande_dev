<?php if(!isBolehAkses()){ redirect(base_url().'auth/error_auth');}

$status_c = (isBolehAkses('c') ? '' : 'disabled-action' ); 
$status_e = (isBolehAkses('e') ? '' : 'disabled-action' ); 
$status_v = (isBolehAkses('v') ? '' : 'disabled-action' ); 
$status_p = (isBolehAkses('p') ? '' : 'disabled-action' ); 
?>


<section class="wrapper">

  <div class="breadcrumb margin-bottom-10">
   <?php echo breadcrumb();?>

   <div class="bar-nav pull-right ">

    <a id="modal-button" class="btn btn-default disabled-action <?php echo $status_c?>" onclick='addForm("<?php echo base_url('master_service/add_mekanik'); ?>");' role="button" data-toggle="modal" data-target="#myModalLg" data-backdrop="static">
      <i class="fa fa-file-o fa-fw"></i> Add Mekanik Baru
    </a>

  </div>

</div>


<div class="col-lg-12 padding-left-right-10">

  <div class="panel margin-bottom-10">

    <div class="panel-heading">
      Mekanik
      <span class="tools pull-right">
        <a class="fa fa-chevron-up" href="javascript:;"></a>
      </span>
    </div>

    <div class="panel-body panel-body-border" style="display: none;">

      <form id="filterForm" action="<?php echo base_url('master_service/mekanik') ?>" class="bucket-form" method="get">

        <div id="ajax-url" url="<?php echo base_url('master_service/mekanik_typeahead');?>"></div>

        <div class="row">
          <div class="col-xs-6 col-sm-4 col-md-4">
              <div class="form-group">
                  <label>Dealer</label>
                  <select id="kd_dealer" name="kd_dealer" class="form-control">
                      <option value="">--Pilih Dealer--</option>
                      <?php
                          if(isset($dealer)){
                              if($dealer->totaldata >0){
                                  foreach ($dealer->message as $key => $value) {
                                      $select=($this->session->userdata('kd_dealer')==$value->KD_DEALER)?"selected":"";
                                      $select=($this->input->get("kd_dealer")==$value->KD_DEALER)?"selected":$select;
                                      echo "<option value='".$value->KD_DEALER."' ".$select.">".$value->NAMA_DEALER."</option>";
                                  }
                              }
                          }
                      ?>
                  </select>
              </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="form-group">
              <label>Mekanik</label>
              <input type="text" id="keyword" name="keyword" value="<?php echo $this->input->get('keyword'); ?>" class="form-control" placeholder="Masukkan NIK atau nama mekanik" autocomplete="off">
            </div>
          </div>

          <div class="col-xs-12 col-sm-2">
            <div class="form-group">
              <label>Status</label>
              <select id="row_status" name="row_status" class="form-control">
                <option value="0" <?php echo ($this->input->get('row_status') == 0 ? "selected" : ""); ?>>Aktif</option>
                <option value="-1" <?php echo ($this->input->get('row_status') == -1 ? "selected" : ""); ?>>Tidak Aktif</option>
                <option value="-2" <?php echo ($this->input->get('row_status') == -2 ? "selected" : ""); ?>>Semua</option>
              </select>
            </div>

          </div>

        </div>


      </form>

    </div>

  </div>

</div>

<div class="col-lg-12 padding-left-right-10">

  <div class="panel panel-default">

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:40px;">No.</th>
            <th style="width:45px;">Aksi</th>
            <th>Main Dealer</th>
            <th>Dealer</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Honda ID</th>
            <th>Tipe PKB</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = $this->input->get('page');
          if($list):
            if(is_array($list->message) || is_object($list->message)):
              foreach($list->message as $key=>$row): 
                $no ++;
                ?>

                <tr id="<?php echo $this->session->flashdata('tr-active') == $row->NIK ? 'tr-active' : ' ';?>" >
                  <td><?php echo $no;?></td>
                  <td class="table-nowarp">

        
                    <a href="<?php echo base_url('master_service/training_mekanik/'.$row->NIK); ?>";' role="button" class="<?php echo $status_v?>">
                      <i data-toggle="tooltip" data-placement="left" title="Training Record" class="fa fa-signing text-success text-active"></i>
                    </a>
        
                  </td>
                  <td><?php echo $row->NAMA_MAINDEALER;?></td>
                  <td><?php echo $row->NAMA_DEALER;?></td>
                  <td><?php echo $row->NIK;?></td>
                  <td><?php echo $row->NAMA_MEKANIK;?></td>
                  <td><?php echo $row->HONDA_ID;?></td>
                  <td><?php echo $row->TIPE_PKB;?></td>
                  <td><?php echo $row->ROW_STATUS == 0 ? 'Aktif':'Tidak Aktif';?></td>
                </tr>

                <?php 
              endforeach;
            else:
              ?>
              <tr>
                <td>&nbsp;<i class="fa fa-info-circle"></i></td>
                <td colspan="8"><b><?php echo ($list->message); ?></b></td>
              </tr>
              <?php
            endif;
          else:
            ?>
            <tr>
              <td>&nbsp;<i class="fa fa-info-circle"></i></td>
              <td colspan="8"><b>ada error, harap hubungi bagian IT</b></td>
            </tr>
            <?php
          endif;
          ?>
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">

        <div class="col-sm-5">
          <small class="text-muted inline m-t-sm m-b-sm"> 
            <?php echo ($list)? ($list->totaldata==''?"":"<i>Total Data ". $list->totaldata ." items</i>") : '' ?>
          </small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
         <?php echo $pagination;?>
       </div>
     </div>
   </footer>

 </div>
</div>
</section>