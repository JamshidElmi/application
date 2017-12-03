<div class="row">
    <div class="col-sm-3">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت واحد جدید</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('setting/insert_stock_unit'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="form-group">
                        <label for="st_name">نام واحد جنس</label>
                        <input type="text" class="form-control" name="st_name" id="st_name" placeholder="نام جنس: برنج، آدر، روغن، نوشابه" required/>
                    </div>

                    <div class="form-group">
                        <label for="st_max_count">قیمت فی واحد</label>
                        <input type="number" class="form-control" name="st_price" id="st_price" placeholder="قیمت فی واحد" required/>
                    </div>

                    <div class="form-group">
                        <label for="st_unit">واحد مقیاسی</label>
                        <select name="st_unit" id="st_unit" class="form-control" required>
                            <option value="">انتخاب کنید</option>
                            <?php units(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="st_max_count">حداکثر ظرفیت گدام</label>
                        <input type="number" class="form-control" name="st_max_count" id="st_max_count" placeholder="مقدار حداکثر به عدد" required/>
                        <p class="help-block " style="font-size: 11px">حداکثر تعداد واحد جنس که گدام ظرفیت نگهداری دارد. (عدد)</p>
                    </div>

                    <div class="form-group">
                        <label for="st_min_count">حداقل تعداد </label>
                        <input type="number" class="form-control" name="st_min_count" id="st_min_count" placeholder="مقدار حداقل به عدد" required/>
                        <p class="help-block" style="font-size: 11px">تعداد واحد جنس که سیستم بر اساس آن پیغامی مبنی بر کمبود جنس در گدام ارسال خواهد کرد. (عدد)</p>
                    </div>
                </div>
                <div id="st_id"></div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست واحد اجناس گدام </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg_coo" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
            <?php foreach ($units as $unit): ?>
                <a style="height: 80px;" class="btn btn-app" id="<?=$unit->st_id ?>"  data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Max: <?=$unit->st_max_count; ?>   &ensp;&ensp;    Min: <?=$unit->st_min_count; ?>">
                    <span class="badge bg-gray ">  <i class="fa fa-edit fa-lg text-black st_edit" id="<?=$unit->st_id ?>" st-name="<?=$unit->st_name ?>" st-price="<?=$unit->st_price ?>" st-max="<?=$unit->st_max_count ?>" st-min="<?=$unit->st_min_count ?>"  data-toggle="tooltip" title="" data-original-title="Edit"></i> &ensp; <i class="fa ion-trash-b fa-lg text-red st_delete" id="<?=$unit->st_id ?>" data-toggle="tooltip" title="" data-original-title="Remove"></i></span>
                    <i class="fa " >  <?=$unit->st_count ?> </i><b><?=$unit->st_name ?></b> <p> <?=$unit->st_price ?> افغانی</p>
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
    $('.st_delete').confirm({
        title: 'حذف',
        content: 'توجه! در صورت حذف این واحد در گدام، جنسی با این واحد نباید موجود باشد، در غیر این صورت واحد حذف نخواهد شد.',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var unit_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                        $("#overlay").css('display','block');
                    });
                      $.post("<?php echo site_url('setting/delete_stock_unit'); ?>",{unit_id:unit_id},function(response){});
                    $(document).ajaxStop(function(){
                        $("#overlay").css('display','none');
                        $(".msg_coo").css('display','block');
                        $("a#"+unit_id).remove();
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
    $('.st_edit').click(function() {
        var st_id = $(this).attr('id');
        var st_name = $(this).attr('st-name');
        var st_min = $(this).attr('st-min');
        var st_max = $(this).attr('st-max');
        var st_price = $(this).attr('st-price');
        $('#st_name').val(st_name);
        $('#st_min_count').val(st_min);
        $('#st_max_count').val(st_max);
        $('#st_price').val(st_price);
        $('#st_id').html('<input type="hidden" name="st_id" value="'+st_id+'">');
    });

}); // end Document

</script>