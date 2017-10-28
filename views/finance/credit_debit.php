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
                <h3 class="box-title">عملیات جمع و برداشت در صندوق</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('finance/insert_credit_debit'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="form-group">
                        <label for="acc_name">نام صندوق</label>
                        <input type="text" class="form-control" value="<?=$account->acc_name; ?>"  id="acc_name" placeholder="نام صندوق" required  readonly/>
                    </div>

                    <div class="form-group">
                        <label for="acc_amount">مقدار موجود</label>
                        <input type="number" class="form-control" value="<?=$account->acc_amount; ?>" id="acc_amount" placeholder="مقدار اولیه به عدد " required readonly/>
                    </div>

                    <div class="form-group">
                        <label for="acc_amount">مقدار جدید</label>
                        <input type="number" class="form-control"  max="<?=round($account->acc_amount); ?>"  name="tr_amount" id="tr_amount" placeholder="مقدار اولیه به عدد " required/>
                    </div>

                    <div class="form-group">
                        <label>تاریخ ایجاد</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                            <input type="hidden" id="tarikhAlt" name="tr_date" class="form-control pull-right" style="z-index: 0;" >
                        </div>
                        <!-- /.input group -->
                    </div>

                    <label for="emp_phone">نوعیت عملیات</label> &nbsp;&nbsp;&nbsp;
                    <div id="radios" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="tr_status" id="tr_status1" value="1" checked /> جمع
                        </label>
                        <label class="btn btn-primary ">
                            <input type="radio" name="tr_status" id="tr_status2" value="0" /> برداشت
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="acc_description">توضیحات / یادداشت</label>
                        <textarea type="number" rows="7" class="form-control" name="tr_desc" id="acc_description" placeholder="توضیحات / یادداشت" /></textarea>
                    </div>


                <input type="hidden" name="tr_acc_id" value="<?=$account->acc_id ?>"/>
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
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>نام صندوق</th>
                                <th>مقدار برداشت/جمع</th>
                                <th>وضعیت</th>
                                <th>تاریخ</th>
                                <th>تاریخ</th>
                            </tr>
                <?php foreach ($transections as $transection): ?>
                            <tr>
                                <td>1.</td>
                                <td><?=$transection->tr_desc ?></td>
                                <td><?=$transection->tr_amount ?></td>
                                <td class="text-center"><?=($transection->tr_status == 0) ? '<span class="badge bg-red">برداشت</span>' : '<span class="badge bg-green">جمع</span>' ; ?></td>
                                <td><?=mds_date("Y/F/d ", $employee->emp_join_date); ?></td>
                                <td><span class="badge bg-orange"><?php echo $transection->tr_amount*100/$account->acc_amount; ?>%</span></td>
                            </tr>
                <?php endforeach ?>
                        </tbody>
                    </table>

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
    var $current_amount = $('#acc_amount').val();

$('#tr_amount').keyup(function(event) {
    $new_amount = $(this).val();
    $remain_amount = $current_amount - $new_amount;
    $('#acc_amount').val($remain_amount);

});




    // Date Picker
    $('#tarikh').persianDatepicker({
        altField: '#tarikhAlt',
        altFormat: 'X',
        format: 'D/MMMM/YYYY',
        observer: true,
    });
});
</script>





