<?php
if (!isBolehAkses()) {
    redirect(base_url() . 'auth/error_auth');
}

$status_c = (isBolehAkses('c') ? '' : 'disabled-action' );
$status_e = (isBolehAkses('e') ? '' : 'disabled-action' );
$status_v = (isBolehAkses('v') ? '' : 'disabled-action' );
$status_p = (isBolehAkses('p') ? '' : 'disabled-action' );
$defaultDealer =($this->input->get("kd_dealer"))?$this->input->get("kd_dealer"): $this->session->userdata("kd_dealer");
?>

<section class="wrapper">

    <div class="breadcrumb margin-bottom-10">

        <?php echo breadcrumb(); ?>

        <div class="bar-nav pull-right ">

            <a class="btn btn-default <?php echo $status_p ?>" id="modal-button" onclick='addForm("<?php echo base_url('report_penerimaan/penerimaan_print?kd_dealer='.$this->input->get("kd_dealer").'&tgl_awal=' . $this->input->get("tgl_awal") . '&tgl_akhir=' . $this->input->get("tgl_akhir")); ?>");'  role="button" data-toggle="modal" data-target="#myModalLg" data-backdrop="static">
                <i class='fa fa-print fa-fw' data-toggle="tooltip" data-placement="left" title="Print Laporan Penerimaan" ></i> Cetak
            </a>

            <!--            <a id="modal-button" class="btn btn-default disabled" role="button" data-toggle="modal" data-target="#myModalLg" data-backdrop="static">
                            <i class="fa fa-file-text-o fa-fw"></i> Export ke PDF
                        </a>-->

        </div>

    </div>

    <div class="col-lg-12 padding-left-right-10">

        <div class="panel margin-bottom-10">

            <div class="panel-heading">
                Laporan Penerimaan Part
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                </span>
            </div>

            <div class="panel-body panel-body-border" style="display: block;">

                <form id="penerimaanForm" action="<?php echo base_url('report_penerimaan/penerimaan_part') ?>" class="bucket-form" method="get">

                    <div class="row">

                        <div class="col-xs-12 col-sm-4 col-md-4">

                            <div class="form-group">
                                <label>Dealer</label>
                                <select class="form-control" id="kd_dealer" name="kd_dealer">
                                    <option value="0">--Pilih Dealer--</option>
                                    <?php
                                    if ($dealer) {
                                      if (($dealer->totaldata > 0)) {
                                        foreach ($dealer->message as $key => $value) {
                                          $aktif = ($defaultDealer == $value->KD_DEALER) ? "selected" : "";
                                          //$aktif = ($this->input->get("kd_dealer") == $value->KD_DEALER) ? "selected" : $aktif;
                                          echo "<option value='" . $value->KD_DEALER . "' " . $aktif . ">" . $value->NAMA_DEALER . "</option>";
                                        }
                                      }
                                    }
                                    ?>
                                  </select>
                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-3 col-md-3">

                            <div class="form-group">

                                <label class="control-label" for="date">Periode Awal</label>
                                <div class="input-group input-append date">
                                    <input class="form-control" name="tgl_awal" placeholder="DD/MM/YYYY" value="<?php echo ($this->input->get("tgl_awal")) ? $this->input->get("tgl_awal") : date('d/m/Y', strtotime('first day of this month')); ?>" type="text"/>
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-3 col-md-3">

                            <div class="form-group">

                                <label class="control-label" for="date">Periode Akhir</label>
                                <div class="input-group input-append date">
                                    <input class="form-control" name="tgl_akhir" placeholder="DD/MM/YYYY" value="<?php echo($this->input->get("tgl_akhir")) ? $this->input->get("tgl_akhir") : date('d/m/Y'); ?>" type="text"/>
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>

                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2">

                            <div class="form-group">

                                <br>
                                <button id="submit-btn" onclick="" class="btn btn-primary"><i class="fa fa-search"></i> Preview</button>

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
                <table class="table table-bordered table-hover b-t b-light table-striped">
                    <thead>
                        <tr class="text-center">
                            <th rowspan="2" style="width:40px; vertical-align: middle;">No.</th>
                            <th colspan="2" style="text-align: center;">Nomor Shipping List</th>
                            <th style="text-align: center;">Nomor PO</th>
                            <th style="text-align: center;">Tanggal Penerimaan</th>
                        </tr>
                        <tr>                            
                           
                            <th>No.</th>
                            <th>Nomor Part</th>
                            <th>Deskripsi Part</th>                                                    
                            <th>Kuantitas Diterima</th>                              
                            
                        
                    </thead>
                    <tbody>

                        <?php
                        $no = $this->input->get('page');
                        if ($list):
                            if (is_array($list->message) || is_object($list->message)):
                                foreach ($list->message as $key => $group_row):
                                    $no ++;
                                    ?>
                                    <tr class="info bold">
                                        <th class="text-bold"><?php echo $no; ?></th>
                                        <th colspan="2" style="text-align: center;"><?php echo $group_row->NO_SURATJALAN; ?></th>
                                        <th  style="text-align: center;"><?php echo $group_row->NO_PO; ?></th>
                                        <th  style="text-align: center;"><?php echo $group_row->TGL_TRANS2; ?></th>
                                    </tr>

                                    <?php
                                    if ($list_group) {
                                        if ($list_group->totaldata > 0) {
                                            
                                            $j=0;
                                            foreach ($list_group->message as $row):
                                                if ($group_row->NO_SURATJALAN == $row->NO_SURATJALAN):
                                                    
                                                    $j++;
                                                    ?>

                                                    <tr id="<?php echo $this->session->flashdata('tr-active') == $row->ID ? 'tr-active' : ' '; ?>" >
                                                        <td></td>
                                                        <td><?php echo $j; ?> </td>
                                                        <td><?php echo $row->PART_NUMBER; ?></td>
                                                        <td><?php echo $row->PART_DESKRIPSI; ?></td>
                                                        <td><?php echo $row->JUMLAH; ?></td>
                                                        
                                                    </tr>

                                                    <?php
                                             
                                                endif;

                                            endforeach;
                                        }

                                    }
                                endforeach;
                            else:
                                ?>
                                <tr>
                                    <td>&nbsp;<i class="fa fa-info-circle"></i></td>
                                    <td colspan="6"><b><?php echo ($list->message); ?></b></td>
                                </tr>
                            <?php
                            endif;
                        else:

                            belumAdaData(5);

                        endif;
                        ?>
                    </tbody>

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