<?php
$dari_tgl = ($this->input->get("tgl_trans")) ? $this->input->get("tgl_trans") : date("d/m/Y", strtotime("-1 Days"));
$no_trx = $this->input->get("n");
$disable = ($no_trx) ? "" : "disabled-action";
$defaulD = ($this->input->get("kd_dealer")) ? $this->input->get("kd_dealer") : $this->session->userdata("kd_dealer");
$bulan = ($this->input->get('bulan')) ? $this->input->get('bulan') : date("m");
$tahuns = ($this->input->get("tahun")) ? $this->input->get("tahun") : date('Y');
?>

<style type="text/css">
    #desc {
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        width: 100%;
    }
    .project {
        text-align: left;
        display: table;
        width: 100%;
    }
    .project div {
        display: table-row;
    }

    .project .title {
        color: #5D6975;
        width: 90px;
    }

    .project span {
    text-align: left;
         width: 100px; 
         margin-right: 15px; 
        padding: 2px 0;
        display: table-cell;
         font-size: 0.8em; 
    }

    .project .content {
        width: 100%;
    }

    /*@page { size: portrait; }*/
</style>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Laporan Human Resource</h4>
</div>

<div class="modal-body" id="printarea">

    <table border='0' id="desc" class="">

        <tr align='center'>
            <td><h4><strong>LAPORAN STATUS TRAINING KARYAWAN</strong></h4></td>
        </tr>
    </table>
    <table border='0' id="desc" class="">
        <tr>
            <td style="width:115px;">Nomor AHASS</td>
            <td style="width:15px;">:</td>
            <td><?php echo KodeDealerAHM($defaulD); ?></td>
        </tr>
        <tr>
            <td>Nama AHASS</td>
            <td>:</td>
            <td><?php echo NamaDealer($defaulD); ?></td>
        </tr>
        <tr>
            <td>Kota</td>
            <td>:</td>
            <td><?php echo KotaDealer($defaulD); ?></td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>:</td>
            <td><?php echo nBulan($bulan) . " " . $tahuns; ?></td>
        </tr>
        <tr>
            <td>Dibuat Tgl</td>
            <td>:</td>
            <td><?php echo date('d/m/Y') ?>  <?php echo date('H:i:s') ?></td>
        </tr>

        <tr align='center'>
            <!--<td><h7>Tanggal : <?php echo($this->input->get("tanggal")) ?></h7></td>-->
        </tr>

    </table>

    <table border='1' class="table table-hover table-striped table-bordered">

        <thead>
            <tr>
                <th style="width: 40px;">No.</th>
                <th>Honda id</th>
                <th>Nama Karyawan</th>
                <th>Tanggal Lahir</th>
                <th>Pendidikan Terakhir</th>
                <th>Tanggal Masuk</th>
                <th>Jabatan</th>
                <th>Status Training</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($list) {
                $no = 0;
                if (is_array($list->message)) {
                    foreach ($list->message as $key => $row) {
                    $no++;
                ?>

                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row->HONDA_ID; ?></td>
                    <td class="table-nowarp" class="td-overflow-50"><?php echo $row->NAMA; ?></td>
                    <td><?php echo tglfromSql($row->TGL_LAHIR);?></td>
                    <td class="table-nowarp" class="td-overflow-50"><?php echo $row->PENDIDIKAN; ?></td>
                    <td><?php echo tglfromSql($row->TGL_MASUK);?></td>
                    <td class="table-nowarp" class="td-overflow-50"><?php echo $row->PERSONAL_JABATAN; ?></td>
                    <td><?php echo $row->KD_STATUS; ?></td>
                </tr>
                        
                <?php
                    }
                } else {
                    belumAdaData(20);
                }
            } else {
                belumAdaData(20);
            }
            ?>
        </tbody>

    </table>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" id="keluar" data-dismiss="modal">Keluar</button>
    <button type="button" onclick="printSj();" class="btn btn-danger"><i class='fa fa-print'></i> Print</button>
</div>

<script src="<?php echo base_url('assets/dist/print.min.js'); ?>"></script>
<script type="text/javascript">
    function printSj() {
        printJS('printarea', 'html');
        $('#keluar').click();
    }
</script>