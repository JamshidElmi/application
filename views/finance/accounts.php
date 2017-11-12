<style>
.small-box h3 {
    font-size: 30px;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
}
</style>
<div class="row">
    <div class="col-md-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ایجاد صندوق جدید</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('finance/insert_account'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="form-group">
                        <label for="acc_name">نام صندوق</label>
                        <input type="text" class="form-control" name="acc_name" id="acc_name" placeholder="نام صندوق" required/>
                    </div>

                    <div class="form-group">
                        <label for="acc_amount">مقدار اولیه</label>
                        <input type="number" class="form-control" name="acc_amount" id="acc_amount" placeholder="مقدار اولیه به عدد " required/>
                    </div>

                    <div class="form-group">
                        <label for="emp_phone">نوعیت حساب</label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-warning active">
                                <input type="radio" name="acc_type" id="acc_type1" value="1" checked /> همکار
                            </label>
                            <label class="btn btn-warning ">
                                <input type="radio" name="acc_type" id="acc_type2" value="2" /> مشتری
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>تاریخ ایجاد</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                            <input type="hidden" id="tarikhAlt" name="acc_date" class="form-control pull-right" style="z-index: 0;" >
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label for="acc_description">توضیحات / یادداشت</label>
                        <textarea type="number" rows="7" class="form-control" name="acc_description" id="acc_description" placeholder="توضیحات / یادداشت" /></textarea>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <div class="box  box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست صندوق های موجود در سیستم</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
            <div class="row">
                <?php foreach ($accounts as $account): ?>
                    <div class="col-sm-6" id="acc_<?=$account->acc_id ?>">
                        <div class="small-box <?php if($account->acc_type == 0) echo 'bg-orange'; else if($account->acc_type == 1) echo 'bg-green'; else echo 'bg-blue'; ?>">
                            <div class="icon">
                                <i class="ion ion-lock-combination"></i>
                            </div>
                            <div class="inner">
                                <h3><?=$account->acc_amount ?><sup style="font-size: 20px;opacity: 0.5" >AF</sup></h3>

                                <p><?=$account->acc_name ?></p>
                            </div>
                            <a href="<?=site_url('finance/credit_debit/'.$account->acc_id); ?>" class="small-box-footer" data-toggle="tooltip" title="" data-original-title="Credit & Debit List">
                                لیست جمع و برداشت <i class="fa fa-line-chart fa-lg" ></i>
                            </a>
                            <?php if ($account->acc_type != 0): ?>
                                <a href="#" class="small-box-footer acc_id_to_delete" id="<?php echo $account->acc_id; ?>" data-toggle="tooltip" title="" data-original-title="Remove Account">
                                    حذف حساب <i class="ion ion-trash-b fa-lg" ></i>
                                </a>
                            <?php endif ?>

                        </div>
                    </div>
                <?php endforeach ?>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="overlay" id="overlay" hidden >
                <i class="fa ion ion-load-d fa-spin fa-lg" style="font-size: 40px;"></i>
            </div>
        </div>
    </div>


</div>

<script>
$(document).ready(function() {
    // Date Picker
    $('#tarikh').persianDatepicker({
        altField: '#tarikhAlt',
        format: 'D/MMMM/YYYY',
        observer: true,

        altFormat: 'YYYY-MM-DD',
        observer: true,
        position: [-65,0],
        calendar: {
            persian: {
                enabled: true,
                locale: 'en',
                leapYearMode: "algorithmic" // "astronomical"
            },
            gregorian: {
                enabled: false,
                locale: 'en'
            }
        },
    });
});

// remove account
$('.acc_id_to_delete').click(function() {
    var acc_id = $(this).attr('id');
    if (confirm('آیا با حذف این صندوق و تمام معاملات آن موافق هستید؟'))
    {
        $(document).ajaxStart(function(){
            $(".overlay").css('display','block');
        });
          $.post("<?php echo site_url('finance/delete_account'); ?>",{acc_id:acc_id},function(response){});
        $(document).ajaxStop(function(){
            $(".overlay").css('display','none');
            $(".msg").css('display','block');
            $("div#acc_"+acc_id).remove();
        });
    };
});
</script>





