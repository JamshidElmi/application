<div class="row">
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت نوعیت مصرف جدید</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('setting/save_exp_category'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="form-group">
                        <label for="exp_cat_name">نوع مصرف</label>
                        <input type="text" class="form-control" name="exp_cat_name" id="exp_cat_name" placeholder="نوع مصرف" required/>
                    </div>

                </div>
                <div id="desk_id"></div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست نوعیت مصارف موجود در سیستم</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg_coo" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
            <?php foreach ($categories as $category): ?>
                <a class="btn btn-app" id="desk_<?=$category->exp_cat_id ?>"  data-toggle="tooltip" title="" data-placement="bottom">
                    <span class="badge bg-gray ">  <i class="fa fa-edit fa-lg text-black desk_edit" id="<?=$category->exp_cat_id ?>" cat-name="<?=$category->exp_cat_name ?>"  data-toggle="tooltip" title="" data-original-title="Edit"></i> &ensp; <i class="fa ion-trash-b fa-lg text-red desk_delete read-only" id="<?=$category->exp_cat_id ?>" data-toggle="tooltip" title="" data-original-title="Remove"></i></span>
                    <i class="fa fa-tags" ></i><?php echo $category->exp_cat_name ?>
                </a>
            <?php endforeach ?>
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
    $('.desk_delete').confirm({
        title: 'حذف',
        content: 'در صورتی که مصرفی با این نوعیت در سیستم ثبت نشده باشد نوعیت مصرف مورد نظر حذف خواهد شد، در غیر این صورت نوعیت مصرف را ویرایش کنید.',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var exp_cat_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                        $("#overlay").css('display','block');
                    });
                      $.post("<?php echo site_url('setting/delete_exp_category'); ?>",{exp_cat_id:exp_cat_id},function(response){});
                    $(document).ajaxStop(function(){
                        $("#overlay").css('display','none');
                        $(".msg_coo").css('display','block');
                        $("a#desk_"+exp_cat_id).remove();
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

    // edit stock unit
    $('.desk_edit').click(function() {
        var exp_cat_id = $(this).attr('id');
        var exp_cat_name = $(this).attr('cat-name');
        $('#exp_cat_name').val(exp_cat_name);
        $('#desk_id').html('<input type="hidden" name="exp_cat_id" value="'+exp_cat_id+'">');
    });

}); // end Document

</script>