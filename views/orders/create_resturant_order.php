<div class="row">
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت سفارش برای رستورانت</h3>
                <div class="box-tools pull-right">
                    <a href="<?=site_url('menu/resturant_menus'); ?>" class="btn btn-box-tool"  data-toggle="tooltip" title="" data-original-title="Add or Edit  Menu"><i class="fa fa-plus"></i></a>
                </div>

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $bm_id = (isset($bm->bm_id))?$bm->bm_id:'' ?>
            <form role="form" method="POST" action="<?=site_url('order/insert_resturant_order/'); ?>">

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
                    <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'warning'); }  ?>

                    <div id="order_list" class="text-muted well well-sm"><b>از لیست منو انتخاب نمائید.</b></div>
                    <div id="order_inputs"></div>

                    <div class="form-group">
                        <label for="order">توضیحات</label>
                        <input type="text" class="form-control" name="order" id="order" placeholder="order" />
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>


    <div class="col-sm-8">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست منو های آشپزخانه </h3>
                <div class="box-tools pull-right">
                    <select name="menu_category" id="menu_category" class="form-control" >
                        <option value="0">انتخاب نوعیت منو</option>
                        <?php foreach ($menu_categories as $menu_category): ?>
                            <option value="<?=$menu_category->mc_id ?>"><?=$menu_category->mc_name ?></option>
                        <?php endforeach ?>
                    </select>

                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg" hidden><?=alert("برای این نوع منو زیر منوئی ثبت نشده است.", 'warning'); ?></div>
                <ul class="users-list clearfix" id="menu_list"></ul>
            </div>
                <!-- /.box-body -->
            <div class="overlay" id="overlay" style="display: none;">
                <i class="fa ion-load-d fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $('#menu_category').change(function(event) {
        // alert($('#menu_category :selected').text());
        var mc_id = $('#menu_category :selected').val();
        var urls = '<?php echo base_url().'order/jq_menu_list/' ?>' + mc_id;



        $.ajax({
            type: "POST",
            url: urls,
            dataType: "html",
            success: function(response){
                $("#menu_list").html(response);
                $('.msg').attr('hidden', true);


                // btn add(+) is clicked
                $('.btn_add').click(function(event) {
                    var pic = $(this).attr('menu-pic');
                    var id = $(this).attr('bm-id');
                    var thumb = '<img width="40" id="pic_'+pic+'" class="img-thumbnail" src="<?php echo site_url().'assets/img/menus/' ?>'+pic+' " alt="">';

                    // create image tag
                    $('#order_list').append(thumb);
                    $('#order_list>b').remove();

                    // create input or sum input value
                    if ($("#order_"+id).length) {
                         // alert('order_'+id);
                         var value = $("#order_"+id).val();
                         var new_val = parseInt(value) + 1;
                         $("#order_"+id).val(new_val);
                    }
                    else{
                        $('#order_inputs').append('<input type="text" name="order_'+id+'" id="order_'+id+'" value="1"/>');
                    }
                });



                // alert(response);
                if(response == ''){
                    $('.msg').attr('hidden', false);
                }

            }
        });
    });



});

</script>