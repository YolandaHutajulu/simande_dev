<style type="text/css">

    @page { size: portrait; }
}
}
</style>
<div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   <h4 class="modal-title" id="myModalLabel">KWITANSI</h4>
</div>
<?php
   $kd_dealer="";$alamat_dealer="";$fincoy="";$telp="";$nama_dealer="";$ppn=0; $nama_finco="";
   $no_trans="";$jumlah=0;$keterangan=""; $no_mesin="";$no_rangka="";$nama_kota="";
   $harga_otr=0; $uang_muka=0; $dibuat_oleh=""; $nama_customer="";$telp="";$fax="";$total=0;
   $tagihke="";$untuk="";$alias="";$kd_maindealer="";$tgl_trans=date("d/m/Y");

   if(isset($program)){
      if($program->totaldata >0){
         foreach ($program->message as $key => $value) {
            $kd_dealer  = $value->KD_DEALER;
            $fincoy     = $value->KD_FINCOY;
            $no_trans   = $value->NO_TRANS;
            $jumlah     = $value->JML_TAGIHAN;
            $ppn        = round(($value->JML_TAGIHAN*10/100),2);
            $dpp        = round(($value->JML_TAGIHAN/101),2);
            $keterangan = $value->URAIAN_TRANSAKSI;
            $nama_customer = $value->NAMA_CUSTOMER;
            $tagihke    = ($value->TAGIHANKE=='MAINDEALER')?'PT. TRIO MOTOR': $value->TAGIHANKE;
            $untuk      = $value->TAGIHANKE;
            $alias      = ($value->TAGIHANKE=='MAINDEALER')?'MD':$value->TAGIHANKE;
            $tgl_trans  = tglFromSql($value->TGL_TRANS);
         }
      }
   }
   $tampil="hidden";
   $gatampil="";
   $total =round(($jumlah),0);
   if(isset($dealer)){
      if($dealer->totaldata >0){
         foreach ($dealer->message as $key => $value) {
            if($value->KD_DEALER === $kd_dealer){
               $alamat_dealer = $value->ALAMAT;
               $telp = $value->TLP;
               $nama_dealer = $value->NAMA_DEALER;
               $fax = $value->TLP3;
               $nama_kota = $value->NAMA_KABUPATEN;
               $tampil =($value->KD_JENISDEALER=='Y')?'hidden':'';
               $gatampil=($value->KD_JENISDEALER=='Y')?'':'hidden';
               $kd_maindealer = $value->KD_MAINDEALER;
            }
         }
      }
   }
   if(isset($finco)){
      if($finco->totaldata >0){
         foreach ($finco->message as $key => $value) {
            if($value->KD_LEASING === $fincoy){
               $nama_finco = $value->NAMA_LEASING;
            }
         }
      }
   }
   $no_kwt="0";
   if(isset($kwt)){
      if($kwt->totaldata > 0){
         foreach ($kwt->message as $key => $value) {
            $no_kwt = str_pad(($value->LAST_DOCNO),6,"0",STR_PAD_LEFT);
         }
      }
   }
?>
<div class="modal-body" id="printarea">
   <table class="" style="width:100%; border-collapse: collapse; font-size:small; " border="0">
      <tr>
         <td colspan="4" align="center"><h3><strong>KWITANSI</strong></h3></td>
      </tr>
      <tr style="font-size: 12px">
         <td colspan="3"><span class="<?php echo $tampil;?>"><?php echo $nama_dealer;?></span> </td>
         <td align="right" style="width:150px; padding-right: 5px;"><input type='text' class='on-grid text-right <?php echo $gatampil;?>' id="no_kwt" placeholder="Masukan No urut Kwitansi">
            <span class="<?php echo $tampil;?>"><b>No. :<?php echo $no_kwt;?></b>
         </td>
      </tr>
      <tr style="font-size: 11px">
         <td colspan="3"><span class="<?php echo $tampil;?>"><?php echo str_replace("<br>"," ",$alamat_dealer)." ".$nama_kota;?></span></td>
         <td align="right"><b><?php echo $no_trans;?></b></td>
      </tr>
      <tr style="font-size: 10px">
         <td colspan="3"><span class="<?php echo $tampil;?>">Telp: <?php echo $telp;?></span></td>
         <td>&nbsp;</td>
      </tr>
      <tr style="font-size: 10px">
         <td colspan="3"><span class="<?php echo $tampil;?>">Fax:</span> </td>
         <td></td>
      </tr>
      <tr>
         <td colspan="4"><hr></td>
      </tr>
      
      <tr style="min-height: 27px">
         <td style="width:150px" align="text-right"><span class="<?php echo $tampil;?>">Telah Terima dari</span></td>
         <td style="width: 20px"><span class="<?php echo $tampil;?>">:</span></td>
         <td colspan="2"><?php echo $tagihke;?></td>
      </tr>
      <tr style="min-height:27px">
         <td align="text-right"><span class="<?php echo $tampil;?>">Uang Sejumlah</span></td>
         <td style="width: 20px"><span class="<?php echo $tampil;?>">:</span></td>
         <td colspan="2" style="color:red"><em><?php echo terbilang($total)." Rupiah";?></em></td>
      </tr>
      <tr style="min-height: 27px">
         <td align="text-right" style="" valign="top"><span class="<?php echo $tampil;?>">Untuk Pembayaran</span></td>
         <td style="width: 20px"><span class="<?php echo $tampil;?>">:</span></td>
         <td colspan="2" valign="top"><span id="ket"><?php echo $keterangan;?> a.n <?php echo $nama_customer;?></span></td>
      </tr>
      <tr><td colspan="4">&nbsp;</td>
      <tr>
         <td colspan="2">&nbsp;</td>
         <td align="" valign="top">
            <table style="width:100%; border-collapse: collapse;">
               <tr>
                  <td style="width: 20%">&nbsp;</td>
                  <td style="width:15%">DPP :</td>
                  <td style="width:25%" align="right"><?php echo number_format(($jumlah-$dpp),0);?></td>
                  <td></td>
               </tr>
               <tr>
                  <td>&nbsp;</td>
                  <td>PPN  :</td>
                  <td align="right"><?php echo number_format(($dpp),0);?></td>
                  <td></td>
               </tr>
            </table>
         </td>
         <td></td>
      </tr>
      <tr><td colspan="4">&nbsp;</td></tr>
      <tr style="height: 50px">
         <td colspan="2" align="right" style="white-space: nowrap;"><h3><em><span class="<?php echo $tampil;?>">Rp.&nbsp;&nbsp;</span> <?php echo number_format($jumlah,0);?></em></h3></td>
         <td align="right"><em><?php echo ucwords(strtolower($nama_kota));?>,</em></td>
         <td align="left"><em><?php echo date("d F Y");?></em></td>
      <tr style="height: 35px">
         <td colspan="2" valign="top" align="right" style="padding-top: 5px;"><smaller><sup><?php echo date('d/m/Y H:i:s');?></sup></smaller></td> 
         <td>&nbsp</td>
         <td valign="bottom"><u><?php echo $this->session->userdata("user_name");?></u></td>
      </tr>
      </table>
   </div>
<div class="modal-footer">
   <span class="pull-left"><em><small><sup>*</sup> Hanya bisa diprint 1 kali</small></em></span>
    <button type="button" class="btn btn-default" id="keluar" data-dismiss="modal">Keluar</button>
    <button type="button" onclick="printSj();" class="btn btn-danger"><i class='fa fa-print'></i> Print</button>

</div>

<script src="<?php echo base_url('assets/dist/print.min.js'); ?>"></script>
<script type="text/javascript">
   function printSj() {
      printJS('printarea', 'html');
      __simpan_data();
      
   }
   function __simpan_data(){
      var datax=[];
      datax={
            "kd_maindealer"   : "<?php echo $kd_maindealer;?>",
            "kd_dealer"       : "<?php echo $kd_dealer;?>",
            "no_trans"        : "<?php echo $no_trans;?>",
            "tgl_piutang"     : "<?php echo date('d/m/Y');?>",
            "kd_piutang"      : "PKUSP-<?php echo $alias;?>",
            "tgl_trans"       : "<?php echo $tgl_trans;?>",
            "reff_piutang"    : "<?php echo $no_kwt;?>",
            "uraian_piutang"  : $('#ket').html().replace('&#8629;',''),
            "jumlah_piutang"  : "<?php echo $jumlah;?>",
            "cara_bayar"      : "KU",
            "tgl_tempo"       : "<?php echo tglFromSql(getNextDays(date('Ymd'),7));?>",
            "status_piutang"  : "1",
            "created_by"      : "<?php echo $this->session->userdata('user_id');?>"
         }
      console.log(datax);
      $.post("<?php echo base_url('report/simpan_tagihan');?>",datax,function(result){
            console.log(result);
            if(result){
               $("#<?php echo $no_trans."_".$untuk;?> > td:eq(1) span.fa-stack").removeClass("hidden");
               $("#<?php echo $no_trans."_".$untuk;?> > td:eq(1) a#modal-button").addClass("hidden");
               $('#keluar').click();
            }
      })
   }

</script>