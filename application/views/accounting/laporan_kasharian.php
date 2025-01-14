<?php
//echo isBolehAkses();
  if (!isBolehAkses()) {
      //redirect(base_url() . 'auth/error_auth');
  }
  $status_c = (isBolehAkses('c') ? '' : 'disabled-action' );
  $status_e = (isBolehAkses('e') ? '' : 'disabled-action' );
  $status_v = (isBolehAkses('v') ? '' : 'disabled-action' );
  $status_p = (isBolehAkses('p') ? '' : 'disabled-action' );
  $usergroup=$this->session->userdata("kd_group");
  $mode=($this->input->get("t"))?"":"hidden";
?>
<section class="wrapper">
	<div class="breadcrumb margin-bottom-10">
        <?php echo breadcrumb();?>

        <div class="bar-nav pull-right ">
            <a id="modal-button" class="btn btn-default" href="<?php echo base_url('cashier/kasirnew'); ?>" role="button">
                <i class="fa fa-file-o fa-fw"></i> Transaksi Baru
            </a>
            <a id="modal-button-1" class="btn btn-default" href="<?php echo base_url('cashier/seleksi_lkh'); ?>" role="button">
                <i class="fa fa-list-alt fa-fw"></i> Seleksi Transaksi
            </a>
            <a id="modal-button-1" class="btn btn-default <?php echo $mode;?>" href="<?php echo base_url('cashier/laporan_lkh'); ?>" role="button">
                <i class="fa fa-list-alt fa-fw"></i> Laporan Kas Harian
            </a>
            <a id="modal-button-1" class="btn btn-default" href="<?php echo base_url('cashier/listkasir'); ?>" role="button">
                <i class="fa fa-list-ul fa-fw"></i> List Transaksi
            </a>
        </div>
    </div>

    <div class="col-lg-12 padding-left-right-10">
        <div class="panel margin-bottom-10">
            <div class="panel-heading"><i class="fa fa-list-ul"></i> LAPORAN KAS HARIAN
                <span class="tools pull-right">
                    <a class="fa fa-chevron-up" href="javascript:;"></a>
                </span>
            </div>
            <div class="panel-body panel-body-border" style="display: block;">
            	<form id="frmCriteria" action="<?php echo base_url('cashier/laporan_lkh') ?>" class="bucket-form" method="get">
            		<!-- <div id="ajax-url" url="<?php echo base_url('cashier/tm_typeahead'); ?>"></div> -->
            		<div class="row">
            			<div class="col-sm-4 col-md-4 col-xs-12">
                            <div class="form-group">
                				<label>Nama Dealer</label>
                				<select name="kd_dealer" id="kd_dealer" class="form-control <?php echo($usergroup!=='0')?" disabled='disabled":""?>">
                					<option value="">--Pilih Dealer--</option>
                					<?php
            							if($dealer){
            								if(is_array($dealer->message)){
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
                            <a href="<?php echo base_url("cashier/laporan_lkh/false/true?tgl_trans_aw=");?><?php echo $this->input->get("tgl_trans_aw")."&tgl_trans_ak=".$this->input->get("tgl_trans_aw");?>" target="_blank" class="btn btn-default" role="button"><i class="fa fa-print fa-fw"></i> Print</a>
                        </div>
            		</div>
            		<!-- <div class='row'>
            			<div class="col-sm-6">
                            <div class="form-group">
                				<label>Find by</label>
                				<input class="form-control" type="text" id="keyword" name="keyword" placeholder="cari berdasarkan No Trans, nama customer atau no spk">
                            </div>
            			</div>
            			
            		</div> -->
            	</form>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 padding-left-right-10" id="printarea" style="width:100%">
        <div class="row onlyprint">
            <table class='table' style="width:100%">
                <tr>
                    <td style="width:30%" class='table-nowarp'><h4><?php echo NamaDealer($this->session->userdata("kd_dealer"));?></h4></td>
                    <td style="width:65%" class='text-center table-nowarp'><h1>LAPORAN KAS HARIAN</h1></td>
                    <td style="width:5%" class='table-nowarp'></td>
                </tr>
                <tr><td>&nbsp;</td>
                    <td class="text-center">Tanggal : <?php echo ($this->input->get('tgl_trans_aw'))?$this->input->get('tgl_trans_aw'):date('d/m/Y');?></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="">
            <table class="table table-striped table-hover table-bordered" style="width:100%; border-collapse: collapse;" border="1">
                <thead>
                    <tr>
                        <th style="width:5%">No.</th>
                        <th style="width:15%">No.Trans</th>
                        <th style="width:50%">Keterangan</th>
                        <!-- <th style="width:5%">jns</th> -->
                        <th style="width:10%">Ket</th>
                        <th style="width:10%">Debet</th>
                        <th style="width:10%">Kredit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $saldoAkhir=0;$n=0;$kredit=0;$debet=0;
                    $totalWO=0;$totalSO=0;
                    //print_r($list);exit();
                    if(isset($list)){ 
                            if($list->totaldata > 0){
                                foreach ($list->message as $key => $value) {
                                    $n++;
                                    $saldoAkhir=$value->SALDO_AKHIR;
                                    $kredit +=($value->HARGA_AKHIR>0 && $value->POSTING_STATUS==1)?$value->HARGA_AKHIR:0;
                                    $debet +=($value->HARGA_AKHIR<0 && $value->POSTING_STATUS==1)?$value->HARGA_AKHIR:0;
                                    switch (substr($value->NO_REFF,0,2)) {
                                        case 'SO': $totalSO +=$value->HARGA_AKHIR; break;
                                        case 'WO': $totalWO +=$value->HARGA_AKHIR; break;
                                        default:
                                            # code...
                                            break;
                                    }
                                    //if ( $value->POSTING_STATUS==1 ){

                                    ?>

                                    <tr class='<?php echo ( $value->POSTING_STATUS==1 || (int)$value->URUTAN ==0 )?'':'info';?>'>
                                        <td class="text-center"><?php echo $n;?></td>
                                        <td class="text-center table-nowarp"><?php echo $value->NO_TRANS;?></td>
                                        <td><?php echo $value->URAIAN_TRANSAKSI;?></td>
                                        <!-- <td class="text-center">&nbsp;</td> -->
                                        <td class="text-center"><?php echo ($value->POS_AKUN);?></td>
                                        <?php if($value->URUTAN==0){ ?>
                                            <td class="text-right"><?php echo number_format(($value->HARGA_AKHIR),0);?></td>
                                            <td class="text-right"><?php echo 0;?></td>
                                       <?php }else{
                                            ?>
                                            <td class="text-right"><?php echo(($value->HARGA_AKHIR>=0) /*&& $value->POSTING_STATUS==1*/)? number_format(($value->JUMLAH*$value->HARGA),0):0;?></td>
                                            <td class="text-right"><?php echo(($value->HARGA_AKHIR<0) /*&& $value->POSTING_STATUS==1*/)? number_format(($value->JUMLAH*$value->HARGA),0):0;?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    <?
                                   //}
                                }
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="subtotal">
                        <td colspan="4" class="text-right" style="padding-right: 10px"><b><i>Total</i></b></td>
                        <td class="text-right"><?php echo number_format($kredit,0);?></td>
                        <td class="text-right"><?php echo number_format(abs($debet),0);?></td>
                    </tr>
                    <!-- <tr class="subtotal"><td colspan="4">&nbsp;</td>
                        <td colspan="2">Saldo Kasir</td>
                        <td class="text-right"><?php echo number_format($saldoAkhir,0);?></td>
                    </tr> -->
                    <?php
                        $kus=0;$ceks=0;$total_kucek=0;
                        $kus= (isset($ku))? ($ku->totaldata>0)?($ku->message[0]->TOTAL_HARGA):0:0;
                        $ceks =  (isset($cek))? ($cek->totaldata>0)?($cek->message[0]->TOTAL_HARGA):0:0;
                        $total_kucek=($kus+$ceks);
                    ?>
                    <tr class="subtotal">
                        <td colspan="6">
                            <table class='table table-hover'>
                                <tr>
                                    <td colspan="2">Total CEK STNK<span class='pull-right'>:</span></td>
                                    <td class='text-right'>
                                        <?php echo (isset($cek_stnk))?($cek_stnk->totaldata>0)? number_format($cek_stnk->message[0]->TOTAL_HARGA,0):"0":"0";?></td>
                                    <td>( KREDIT )</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Total KU BPKB<span class='pull-right'>:</span></td>
                                    <td class='text-right'><?php echo (isset($ku_bpkb))?($ku_bpkb->totaldata>0)? number_format($ku_bpkb->message[0]->TOTAL_HARGA,0):"0":"0";?></td>
                                    <td>( KREDIT )</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <!-- <tr class="hidden">
                                    <td colspan="2">Total CEK STNK<span class='pull-right'>:</span></td>
                                    <td class='text-right'>0</td>
                                    <td class="text-left">( KREDIT )</td>
                                    <td>&nbsp;</td>
                                    <td>TOTAL KU RP<span class='pull-right'>:</span></td>
                                    <td class='text-right'>0</td>
                                </tr> -->
                                <tr>
                                    <td colspan="2">Pinj. Pengurusan STNK/BPKB Gantung<span class='pull-right'>:</span></td>
                                    <td class='text-right'><?php echo (isset($pinjaman))? number_format($pinjaman->message[0]->HARGA,0):"0";?></td>
                                    <td>( KREDIT )</td>
                                    <td>&nbsp;</td>
                                    <td>TOTAL KU RP<span class='pull-right'>:</span></td>
                                    <td class='text-right'><?php echo number_format($kus,0);?></td>
                                </tr>
                                <tr style="border-bottom:2px solid grey !important">
                                    <td colspan="2">Pinj. Sementara Gantung<span class='pull-right'>:</span></td>
                                    <td class='text-right'>0</td>
                                    <td>( KREDIT )</td>
                                    <td>&nbsp;</td>
                                    <td>TOTAL CEK RP<span class='pull-right'>:</span></td>
                                    <td class='text-right'><?php echo number_format($ceks,0);?></td>
                                </tr>
                                <tr>
                                    <td>Total Cek DEBET<span class='pull-right'>:</span></td>
                                    <td class='text-right'>0</td>
                                    <td>Total Batal Cek DEBET<span class='pull-right'>:</span></td>
                                    <td class='text-right'>0</td>
                                    <td>&nbsp;</td>
                                    <td>TOTAL KU/CEK RP<span class='pull-right'>:</span></td>
                                    <td class='text-right'><?php echo number_format($total_kucek,0);?></td>
                                </tr>
                                <tr style="border-bottom:2px solid grey !important">
                                    <td>Total Cek KREDIT<span class='pull-right'>:</span></td>
                                    <td class='text-right'>0</td>
                                    <td>Total Batal Cek KREDIT<span class='pull-right'>:</span></td>
                                    <td class='text-right'>0</td>
                                    <td>&nbsp;</td>
                                    <td>SALDO KASIR<span class='pull-right'>:</span></td>
                                    <td class="text-right"><?php echo number_format($saldoAkhir,0);?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td>Jasa Bengkel<span class='pull-right'>:</span></td>
                                    <td class='text-right'><?php echo (isset($jasa))? ($jasa->totaldata >0)? number_format($jasa->message[0]->TOTAL_HARGA,0):"0":"0";?></td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td class="text-right"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td>Part Bengkel <span class='pull-right'>:</span></td>
                                    <td class='text-right'><?php echo (isset($part_bengkel))?($part_bengkel->totaldata >0)? number_format($part_bengkel->message[0]->TOTAL_HARGA,0):"0":"0";?></td>
                                    <td>&nbsp;</td>
                                    <td>Part Counter <span class='pull-right'>:</span></td>
                                    <td class="text-right"><?php echo (isset($part_counter))?($part_counter->totaldata > 0)? number_format($part_counter->message[0]->TOTAL_HARGA,0):"0":"0";?></td>
                                </tr>
                                <tr>
                                    <td>Total PKB Pause  <span class='pull-right'>:</span></td>
                                    <td class="text-center"><?php echo (isset($pkb))?($pkb->totaldata > 0)? number_format($pkb->message[0]->TOTAL_HARGA,0):"0":"0";?></td>
                                    <td>Oli Bengkel <span class='pull-right'>:</span></td>
                                    <td class='text-right'><?php echo (isset($oli_bengkel))?($oli_bengkel->totaldata >0)?number_format($oli_bengkel->message[0]->TOTAL_HARGA,0):"0":"0";?></td>
                                    <td>&nbsp;</td>
                                    <td>Oli Counter <span class='pull-right'>:</span></td>
                                    <td class="text-right"><?php echo (isset($oli_counter))?($oli_counter->totaldata >0)? number_format($oli_counter->message[0]->TOTAL_HARGA,0):"0":"0";?></td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr><td colspan="6"><small><em><?php echo date('d-m-Y H:i:s');?></em></small></td></tr>

                </tfoot>
            </table>
        </div>
    </div>
</section>
<script type="text/javascript" src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#print_l').on('click',function(){
            printJS({
                printable:'printarea',
                type:'html',
                css:"<?php echo base_url('assets/css/style.css'); ?>"
            });
        })
    })
</script>  