<?php
if (!isBolehAkses()) {
  redirect(base_url() . 'auth/error_auth');
}

$status_c = (isBolehAkses('c') ? '' : 'disabled-action' );
$status_e = (isBolehAkses('e') ? '' : 'disabled-action' );
$status_v = (isBolehAkses('v') ? '' : 'disabled-action' );
$status_p = (isBolehAkses('p') ? '' : 'disabled-action' );
?>

<section class="wrapper">
  <div class="breadcrumb margin-bottom-10">
    <?php echo breadcrumb(); ?>

    <div class="bar-nav pull-right ">
      <a class="btn btn-default <?php echo $status_p ?>" id="modal-button" onclick='addForm("");'  role="button" data-toggle="modal" data-target="#myModalLg" data-backdrop="static">
                <i class='fa fa-print fa-fw' data-toggle="tooltip" data-placement="left" title="Print Laporan" ></i> Cetak
      </a>
    </div>

  </div>

  <div class="col-lg-12 padding-left-right-10">
    <div class="panel margin-bottom-10">
      <div class="panel-heading">
        Neraca Percobaan
        <span class="tools pull-right">
          <a class="fa fa-chevron-down" href="javascript:;"></a>
        </span>
      </div>

      <div class="panel-body panel-body-border" style="display: block;">

        <form id="penerimaanForm" action="" class="bucket-form" method="get">

          <div class="row">

            <div class="col-xs-12 col-sm-4 col-md-4">
              <div class="form-group">
                <label>Dealer</label>
                <select name="kd_dealer" id="kd_dealer" class="form-control" disabled="disabled" required="true">
                  <option value="">- Pilih Dealer -</option>
                  <?php
                    foreach ($dealer->message as $key => $group) :
                      if ($KD_DEALER != ''):
                        $default = ($KD_DEALER == $group->KD_DEALER) ? " selected" : " ";
                        else:
                          $default = ($this->session->userdata("kd_dealer") == $group->KD_DEALER) ? " selected" : '';
                        endif;
                        ?>
                        <option value="<?php echo $group->KD_DEALER; ?>" <?php echo $default; ?> ><?php echo $group->NAMA_DEALER; ?></option>
                      <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-sm-3 col-xs-6 col-md-3">
              <div class="form-group">
                <label>Periode dari Tanggal</label>
                <div class="input-group append-group date">
                  <input type="text" class="form-control" id="tgl_trans_aw" name="tgl_trans_aw" value="<?php echo ($this->input->get("tgl_trans_aw"))?$this->input->get("tgl_trans_aw"):date("d/m/Y");?>">
                  <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span> </span>
                </div>
              </div>
            </div>

            <div class="col-sm-3 col-xs-6 col-md-3 hidden">
              <div class="form-group">
                <label>Sampai Tanggal</label>
                <div class="input-group append-group date">
                  <input type="text" class="form-control" id="tgl_trans_ak" name="tgl_trans_ak" value="<?php echo ($this->input->get("tgl_trans_ak"))?$this->input->get("tgl_trans_ak"):date("d/m/Y");?>"">
                  <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span> </span>
                </div>
              </div>
            </div>

            <div class="col-sm-3 col-xs-6 col-md-3">
              <br>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Preview</button>
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
              <tr class="text-center">
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Aksi</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">No Bukti</th>
                <th style="text-align: center;">Keterangan</th>
                <th style="text-align: center;">Debet</th>
                <th style="text-align: center;">Kredit</th>
                <th style="text-align: center;">Saldo</th>
              </tr>
            </thead>

            <tbody>
              

              <tr>
                <td style="text-align: center;">1</td>
                <td style="text-align: center;">2</td>
                <td style="text-align: center;">3</td>
                <td style="text-align: center;">4</td>
                <td style="text-align: center;">5</td>
                <td style="text-align: center;">6</td>
                <td style="text-align: center;">7</td>
                <td style="text-align: center;">8</td>

              </tr>
              <tr>
                <td>&nbsp;<i class="fa fa-info-circle"></i></td>
                <td></b></td>
              </tr>
            </tbody>
            <tfoot>
              <tr colspan="5">
                <td>
                  <table>
                    <tr>
                      <td colspan="5">Total</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tfoot>

          </table>
        </div>

        <footer class="panel-footer">
          <div class="row">

            <div class="col-sm-5">
              <small class="text-muted inline m-t-sm m-b-sm"> 
                <?php echo ($list) ? ($list->totaldata == '' ? "" : "<i>Total Data " . $list->totaldata . " items</i>") : '' ?>
              </small>
            </div>

            <div class="col-sm-7 text-right text-center-xs">                
              <?php echo $pagination; ?>
            </div>

          </div>
        </footer>

      </div>
    </div>

</section>

<script type="text/javascript">
</script>