<div class="row">
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت میز جدید</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('setting/save_desk'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="form-group">
                        <label for="desk_name">نام میز</label>
                        <input type="text" class="form-control" name="desk_name" id="desk_name" placeholder="نام میز" required/>
                    </div>

                    <div class="form-group">
                        <label for="desk_capacity">گنجایش میز </label>
                        <input type="number" class="form-control" name="desk_capacity" id="desk_capacity" placeholder="تعداد نفر (عدد)" required/>
                        <p class="help-block" style="font-size: 11px">تعداد افرادی که دور میز نشسته میتوانند.</p>
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
                <h3 class="box-title">لیست میزهای موجود در رستورانت</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg_coo" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
            <?php foreach ($desks as $desk): ?>
                <a class="btn btn-app" id="desk_<?=$desk->desk_id ?>"  data-toggle="tooltip" title="" data-placement="bottom" data-original-title="capacity: <?=$desk->desk_capacity; ?>">
                    <span class="badge bg-gray ">  <i class="fa fa-edit fa-lg text-black desk_edit" id="<?=$desk->desk_id ?>" desk-name="<?=$desk->desk_name ?>"  desk-capacity="<?=$desk->desk_capacity ?>"  data-toggle="tooltip" title="" data-original-title="Edit"></i> &ensp; <i class="fa ion-trash-b fa-lg text-red desk_delete" id="<?=$desk->desk_id ?>" data-toggle="tooltip" title="" data-original-title="Remove"></i></span>
                    <i class="fa ion-android-archive" ></i><?php echo $desk->desk_name ?>
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
        content: 'در صورتی که سفارشی با این میز در سیستم ثبت نشده باشد میز مورد نظر حذف خواهد شد، در غیر این صورت میز را ویرایش کنید.',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var desk_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                        $("#overlay").css('display','block');
                    });
                      $.post("<?php echo site_url('setting/delete_desk'); ?>",{desk_id:desk_id},function(response){});
                    $(document).ajaxStop(function(){
                        $("#overlay").css('display','none');
                        $(".msg_coo").css('display','block');
                        $("a#desk_"+desk_id).remove();
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
        var desk_id = $(this).attr('id');
        var desk_name = $(this).attr('desk-name');
        var desk_capacity = $(this).attr('desk-capacity');
        $('#desk_name').val(desk_name);
        $('#desk_capacity').val(desk_capacity);
        $('#desk_id').html('<input type="hidden" name="desk_id" value="'+desk_id+'">');
    });

}); // end Document

</script>