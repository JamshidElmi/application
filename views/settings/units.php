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
                <h3 class="box-title">ثبت واحد جدید</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('setting/insert_unit'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="form-group">
                        <label for="unit_name">نام واحد</label>
                        <input type="text" class="form-control" name="unit_name" id="unit_name" placeholder="نام واحد" required/>
                    </div>

                    <label for="emp_phone">واحد برای:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div id="radios" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-warning active">
                            <input type="radio" name="unit_type" id="unit_type1" value="1" checked /> رستورانت
                        </label>
                        <label class="btn btn-warning ">
                            <input type="radio" name="unit_type" id="unit_type2" value="0" /> آشپزخانه
                        </label>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">واحدات آشپزخانه</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg_coo" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
            <?php foreach ($units_coock as $coock): ?>
                <a class="btn btn-app " id="coo_<?=$coock->unit_id ?>">
                    <span class="badge bg-red unit_coo_delete" id="<?=$coock->unit_id ?>" data-toggle="tooltip" title="" data-original-title="Remove"><i class="ion ion-trash-b fa-lg"></i></span>
                    <i class="fa ion-ios-nutrition"></i><?php echo $coock->unit_name ?>
                </a>
            <?php endforeach ?>

            </div>
            <!-- /.box-body -->
            <div class="overlay" id="overlay_coo" style="display: none;">
                <i class="fa ion-load-d fa-spin"></i>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">واحدات رستورانت</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg_res" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
            <?php foreach ($units_resturant as $resturant): ?>
                <a class="btn btn-app" id="res_<?=$resturant->unit_id ?>">
                    <span class="badge bg-red unit_res_delete" id="<?=$resturant->unit_id ?>" data-toggle="tooltip" title="" data-original-title="Remove"><i class="ion ion-trash-b fa-lg"></i></span>
                    <i class="fa ion-beer"></i><?=$resturant->unit_name ?>
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
    $('.unit_res_delete').click(function() {
        var unit_id = $(this).attr('id');
        if (confirm('آیا با حذف این واحد موافق هستید؟'))
        {
            $(document).ajaxStart(function(){
                $("#overlay_res").css('display','block');
            });
              $.post("<?php echo site_url('setting/delete_unit'); ?>",{unit_id:unit_id},function(response){});
            $(document).ajaxStop(function(){
                $("#overlay_res").css('display','none');
                $(".msg_res").css('display','block');
                $("a#res_"+unit_id).remove();
            });
        };
    });

    $('.unit_coo_delete').click(function() {
        var unit_id = $(this).attr('id');
        if (confirm('آیا با حذف این واحد موافق هستید؟'))
        {
            $(document).ajaxStart(function(){
                $("#overlay_coo").css('display','block');
            });
              $.post("<?php echo site_url('setting/delete_unit'); ?>",{unit_id:unit_id},function(response){});
            $(document).ajaxStop(function(){
                $("#overlay_coo").css('display','none');
                $(".msg_coo").css('display','block');
                $("a#coo_"+unit_id).remove();
            });
        };
    });
});

</script>