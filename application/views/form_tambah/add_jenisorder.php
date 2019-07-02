<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Tambahkan Jenis Order</h4>
</div>

<div class="modal-body">

    <form id="addForm" class="bucket-form" method="post" action="<?php echo base_url('Setup/add_jenisorder_simpan'); ?>">

        <div class="form-group">
            <label>Kode Jenis Order</label>
            <input type="text" name="kd_jenisorder" id="kd_jenisorder" class="form-control" placeholder="Masukkan kode Jenis Order" >
        </div>

        <div class="form-group">
            <label>Nama Jenis Order</label>
            <input type="text" name="nama_jenisorder" id="nama_jenisorder" class="form-control" placeholder="Masukkan nama Jenis Order" >
        </div>

    </form>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
    <button id="submit-btn" onclick="addData();" class="btn btn-danger">Simpan</button>
</div>

