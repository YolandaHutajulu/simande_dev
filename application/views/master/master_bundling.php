<?php
if (!isBolehAkses()) {
    redirect(base_url() . 'auth/error_auth');
}

$status_c = (isBolehAkses('c') ? '' : 'disabled-action' );
$status_e = (isBolehAkses('e') ? '' : 'disabled-action' );
$status_v = (isBolehAkses('v') ? '' : 'disabled-action' );
$status_p = (isBolehAkses('p') ? '' : 'disabled-action' );
$status_cev=(isBolehAkses('c')||isBolehAkses('e')||isBolehAkses('v'))?"": 'disabled-action';
?>

<section class="wrapper">

    <div class="breadcrumb margin-bottom-10">
        <?php echo breadcrumb(); ?>
        <div class="bar-nav pull-right ">
            <a id="modal-button" class="btn btn-default <?php echo $status_c?>" href="<?php echo base_url('motor/add_bundling'); ?>");' role="button">
                <i class="fa fa-file-o fa-fw"></i> Tambah Bundling
            </a>
        </div>
    </div>


    <div class="col-lg-12 padding-left-right-10">

        <div class="panel margin-bottom-10">

            <div class="panel-heading">
                Bundling
                <span class="tools pull-right">
                    <a class="fa fa-chevron-up" href="javascript:;"></a>
                </span>
            </div>

            <div class="panel-body panel-body-border" style="display: none;">

                <form id="filterForm" action="<?php echo base_url('motor/bundling') ?>" class="bucket-form" method="get">

                    <div id="ajax-url" url="<?php echo base_url('motor/bundling_typeahead'); ?>"></div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Nama Dealer</label>
                                <select class="form-control" id="kd_dealer" name="kd_dealer" disabled="disabled">
                                    <option value="0">--Pilih Dealer--</option>
                                    <?php
                                        if($dealer){
                                            if(is_array($dealer->message)){
                                                foreach ($dealer->message as $key => $value) {
                                                    $select=($this->session->userdata('kd_dealer')==$value->KD_DEALER)?"selected":"";
                                                    echo "<option value='".$value->KD_DEALER."' ".$select.">".$value->NAMA_DEALER."</option>";
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <div class="input-group input-append date" id="date">
                                        <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo date('d/m/Y');?>" placeholder="dd/mm/yyyy" required="required" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <div class="input-group input-append date" id="date">
                                        <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo date('d/m/Y',strtotime('last day of next month'));?>" placeholder="dd/mm/yyyy" required="required" />
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-8">

                            <div class="form-group">
                                <label>Cari</label>
                                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Masukkan Kode atau Nama Bundling" autocomplete="off">
                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-4">

                            <div class="form-group hidden">
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
                            <th>Aksi</th>
                            <th>Kode Bundling</th>
                            <th>Nama Bundling</th>
                            <th>Kode Dealer</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Type Motor</th>
                            <th>Warna Motor</th>
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        $no = $this->input->get('page');
                        if ($list):
                            if (is_array($list->message) || is_object($list->message)):
                                foreach ($list->message as $key => $row):
                                    $no ++;
                                    $statusbnd=($row->STATUS_BUNDLING=="0")?"":" disabled-action";
                                    ?>

                                    <tr id="<?php echo  $this->session->flashdata('tr-active') == $row->KD_BUNDLING ? 'tr-active' : ' '; ?>" >
                                        <td><?php echo  $no; ?></td>
                                        <td class="table-nowarp">
											<a href="<?php echo base_url('motor/add_bundling/' . $row->KD_BUNDLING); ?>" role="button" class="<?php echo  $status_cev ?>">
                                                <i data-toggle="tooltip" data-placement="left" title="Input Item" class="fa fa-edit text-success text-active"></i>
                                            </a>
											<?php 
											if($row->ROW_STATUS == 0){ 
											?>
                                            <a id="delete-btn<?php echo  $no; ?>" class="delete-btn <?php echo $status_e;?> <?php echo $statusbnd;?>" url="<?php echo base_url('motor/delete_bundling/' . $row->KD_BUNDLING); ?>">
                                                <i data-toggle="tooltip" data-placement="left" title="Hapus" class="fa fa-trash text-danger text"></i>
                                            </a>
											<?php
											}
											?>
                                        </td>
                                        <td><?php echo $row->KD_BUNDLING; ?></td>
                                        <td><?php echo $row->NAMA_BUNDLING; ?></td>
                                        <td><?php echo $row->NAMA_DEALER; ?></td>
                                        <td><?php echo tglFromSql($row->START_DATE); ?></td>
                                        <td><?php echo tglFromSql($row->END_DATE); ?></td>
                                        <td><?php echo $row->KD_TYPEMOTOR; ?></td>
                                        <td><?php echo $row->KD_WARNA; ?></td>
                                        <!-- <td><?php echo  $row->ROW_STATUS == 0 ? 'Aktif' : 'Tidak Aktif'; ?></td> -->
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
                            echo belumAdaData(8);
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