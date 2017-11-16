<style>
    /*.bg-red{padding: 3px 4px 3px 4px;}*/
    .bg-red:hover {
    background-color: #8F2418 !important;
}
</style>
<div class="row">
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت نوع منو برای رستورانت</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('setting/insert_menu_cat'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="form-group">
                        <label for="mc_name">نام نوعیت منو</label>
                        <input type="text" class="form-control" name="mc_name" id="mc_name" placeholder="کباب، قابلی، نوشیدنی" required/>
                    </div>


                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>


    <div class="col-sm-8">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">نوعیت منو</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg_res" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
            <?php foreach ($menu_categories as $menu_cat): ?>
                <a class="btn btn-app" id="res_<?=$menu_cat->mc_id ?>">
                    <span class="badge bg-red mc_res_delete" id="<?=$menu_cat->mc_id ?>" data-toggle="tooltip" title="" data-original-title="Remove"><i class="ion ion-trash-b fa-lg"></i></span>
                    <i class="fa ion-ios-filing-outline"></i><?=$menu_cat->mc_name ?>
                </a>
            <?php endforeach ?>
            </div>
            <!-- /.box-body -->
            <div class="overlay" id="overlay_res" style="display: none;">
                <i class="fa ion-load-d fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // delete unit restuarant
    $('.mc_res_delete').confirm({
        title: 'حذف',
        content: 'آیا با حذف این نوعیت منو موافق هستید؟',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var mc_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                        $("#overlay_res").css('display','block');
                    });
                      $.post("<?php echo site_url('setting/delete_mc'); ?>",{mc_id:mc_id},function(response){});
                    $(document).ajaxStop(function(){
                        $("#overlay_res").css('display','none');
                        $(".msg_res").css('display','block');
                        $("a#res_"+mc_id).remove();
                    });
                }
            },
            cancel: {
                text: 'انصراف',
                action: function () {
                }
            }
        }
    });

    // delete unit coock
    $('.mc_coo_delete').confirm({
        title: 'حذف',
        content: 'آیا با حذف این واحد موافق هستید؟',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var mc_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                        $("#overlay_coo").css('display','block');
                    });
                      $.post("<?php echo site_url('setting/delete_unit'); ?>",{mc_id:mc_id},function(response){});
                    $(document).ajaxStop(function(){
                        $("#overlay_coo").css('display','none');
                        $(".msg_coo").css('display','block');
                        $("a#coo_"+mc_id).remove();
                    });
                }
            },
            cancel: {
                text: 'انصراف',
                action: function () {
                }
            }
        }
    });
});

</script>