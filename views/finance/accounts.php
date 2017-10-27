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
        <div class="box box-primary box-solid">
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
                <?php foreach ($accounts as $account): ?>
                    <div class="col-sm-6">
                        <div class="small-box bg-green">
                            <div class="icon">
                                <i class="ion ion-lock-combination"></i>
                            </div>
                            <div class="inner">
                                <h3><?=$account->acc_amount ?><sup style="font-size: 20px;opacity: 0.5" >AF</sup></h3>

                                <p><?=$account->acc_name ?></p>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="tooltip" title="" data-original-title="Credit & Debit List">اطلاعات بیشتر <i class="fa fa-line-chart"></i></a>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
            <!-- /.box-body -->
            <div class="overlay" id="overlay" style="display: none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </div>


</div>

<script>
$(document).ready(function() {
    // Date Picker
    $('#tarikh').persianDatepicker({
        altField: '#tarikhAlt',
        altFormat: 'X',
        format: 'D/MMMM/YYYY',
        observer: true,
    });
});

</script>





