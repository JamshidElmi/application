<div class="row">
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">فرم ثبت تخفیف</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('setting/save_discount'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="form-group">
                        <label for="disc_name">عنوان تخفیف</label>
                        <input type="text" class="form-control" name="disc_name" id="disc_name" placeholder="عنوان تخفیف" required/>
                    </div>

                    <div class="form-group">
                        <label for="disc_persent">درصد تخفیف </label>
                        <div class="input-group">
                            <span class="input-group-addon"><strong>%</strong></span>
                            <input type="number" class="form-control" name="disc_persent" id="disc_persent" step=".01" placeholder="مقدار تخفیف بر حسب فیصد(اعشار)" required="">
                        </div>
                    </div>
                    <div id="disc_id"></div>

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
                <h3 class="box-title">لیست تخفیفات </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg_coo" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
            <?php foreach ($discounts as $discount): ?>
                <a class="btn btn-app" id="disc_<?=$discount->disc_id ?>"  data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Persentage: %<?=$discount->disc_persent; ?>">
                    <span class="badge bg-gray ">  <i class="fa fa-edit fa-lg text-black disc_edit" id="<?=$discount->disc_id ?>" disc-name="<?=$discount->disc_name ?>"  disc-persent="<?=$discount->disc_persent ?>"  data-toggle="tooltip" title="" data-original-title="Edit"></i> &ensp; <i class="fa ion-trash-b fa-lg text-red disc_delete" id="<?=$discount->disc_id ?>" data-toggle="tooltip" title="" data-original-title="Remove"></i></span>
                    <i class="fa fa-gift"></i><?php echo $discount->disc_name ?>
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
    $('.disc_delete').confirm({
        title: 'حذف',
        content: 'در صورتی که سفارشی با این تخفیف در سیستم ثبت شده باشد این تخفیف حذف نخواهد شد.',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var disc_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                        $("#overlay").css('display','block');
                    });
                      $.post("<?php echo site_url('setting/delete_disc'); ?>",{disc_id:disc_id},function(response){});
                    $(document).ajaxStop(function(){
                        $("#overlay").css('display','none');
                        $(".msg_coo").css('display','block');
                        $("a#disc_"+disc_id).remove();
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

    // edit discount
    $('.disc_edit').click(function() {
        var disc_id = $(this).attr('id');
        var disc_name = $(this).attr('disc-name');
        var disc_persent = $(this).attr('disc-persent');
        $('#disc_name').val(disc_name);
        $('#disc_persent').val(disc_persent);
        $('#disc_id').html('<input type="hidden" name="disc_id" value="'+disc_id+'">');
    });

}); // end Document

</script>