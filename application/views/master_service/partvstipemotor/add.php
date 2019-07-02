<form action="#" id="import-form" class="bucket-form" enctype="multipart/form-data">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Part vs Tipe Motor Marketing</h4>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label>Select File .PVTM </label>
            <div class="input-group input-append">
                <input accept=".pvtm" type="file" id="file" class="custom-file-control form-control" name="file" placeholder="Choose file">
                <span class="input-group-addon" data-attr="Choose file..."><span class='fa fa-file-o fa-fw'></span></span>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-close'></i> Batal</button>
        <button type="submit" class="btn btn-danger" id="btn-submit"><i class='fa fa-save'></i> Simpan</button>
    </div>

</form>
<script>
        $(function(){
            $('input[name="file"]').on('change',function(e){
                var filename = document.getElementById("file").files[0].name;
                $(this).next().attr('data-attr',filename);
                console.log(filename);
            })
            $('#import-form').on('submit',function(e){
                e.preventDefault();
                var $btn = $(this).find('button[type="submit"]');
                var formdata = new FormData(this);
                //formdata.append('file', document.getElementById('file').files[0]);
                var url_gm = '<?php echo base_url("part/import_partvstipemotor");?>';
                console.log(this);
                $.ajax({
                    url: url_gm,
                    type: 'POST',
                    method: 'POST',
                    dataType: 'JSON',
                    data:formdata,
                    cache:false,
                    contentType: false,
                    processData: false,
                    beforeSend:function(){
                        $btn.button('Loading');
                        $('#btn-submit').html("<i class='fa fa-spinner fa-spin'></i> Loading");
                    },
                    success:function(response){
                        $('.form-group.has-error').removeClass('has-error').find('span.text-danger').remove();
                        //console.log(response);
                        switch(response.status){
                            case 'form-incomplete':
                                $.each(response.errors, function(key,val){
                                    if(val.error!=''){
                                        $(val.field).closest('.form-group').addClass('has-error').append(val.error);
                                    }
                                })
                            break;
                            case 'success':
                                $('#import-form').modal('hide')
                                window.location.reload(true);
                            break;
                            case 'error':
                                console.log(response.message);
                            break
                        }
                    },
                    error: function(jqXHR,textStatus,error){
                        console.log(jqXHR);
                        console.log(error);
                        window.location.reload(true);
                    }
                }).always(function(){
                    //$('#import-form').modal('hide')
                    //window.location.reload(true);
                    $btn.button('reset');
                });
            })
        })
    </script>