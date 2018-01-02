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
<?php $segment =  $this->uri->segment(3); ?>

    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست فاکتور های مصرفی</h3>
                <div class="box-tools pull-right">
                    <a href="<?=($segment == 0) ? site_url('finance/new_expence') : site_url('finance/buy_stock') ; ?>" class="btn btn-box-tool bg-green" data-toggle="tooltip" title="" data-original-title="New Expence"><i class="ion ion-plus fa-lg"></i></a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
                <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دوکان</th>
                            <th class="text-center">شماره فاکتور</th>
                            <th class="text-center">مجموع فاکتور</th>
                            <th class="text-center">نوع مصرف</th>
                            <th>توضیحات</th>
                            <th class="text-center">تاریخ</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_bills= null; $i = 1; foreach ($expences as $expence): ?>
                        <tr id="tr_<?=$expence->bill_id  ?>">
                            <td><?=$i++ ?></td>
                            <td ><?=$expence->bill_shop ?></td>
                            <td class="text-center"><?=$expence->bill_no ?></td>
                            <td class="text-center"><?=$expence->bill_total_amount ?> افغانی</td>   <span class="bg-purple"></span>
                            <td class="text-center"><?=($expence->bill_type == 0) ? '<span class="label bg-orange">مصارف روزانه</span>' : '<span class="label bg-purple">خریداری برای گدام</span>' ?></td>
                            <td ><span data-toggle="tooltip" data-original-title="<?=$expence->bill_desc; ?>"><?=substr_fa($expence->bill_desc, 20); ?></span></td>
                            <td class="text-center"><?=show_date('l d/F/Y', $expence->bill_date); ?></td>
                            <td class="text-center">
                                <a href="<?=site_url('finance/bill_details/'.$expence->bill_id); ?>" class="edit" id="" data-toggle="tooltip" title="" data-original-title="Expences List"><span class="label label-default "><i class="fa ion-android-list fa-lg"></i></span></a>
                                <a class="remove only-admin" href="<?=site_url('finance/delete_bill_expence/'.$expence->bill_id.'/'.$expence->bill_total_amount.'/'. $expence->tr_acc_id.'/'.$expence->bill_type); ?>"  ><span class="label label-danger "  data-toggle="tooltip" title="" data-original-title="Remove"><i class="ion ion-trash-b fa-lg"></i></span></a>
                            </td>
                        </tr>
                        <?php $total_bills += $expence->bill_total_amount; ?>
                        <?php endforeach ?>
                    </tbody>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th colspan="2">مجموعه فاکتورها:</th>
                            <th class="bg-success text-center"><?=$total_bills." افغانی" ?></th><th></th>
                        </tr>
                    </thead>

                </table>
            </div>
            <!-- /.box-body -->
            <div class="overlay" id="overlay" hidden>
                <i class="fa ion ion-load-d fa-spin"></i>
            </div>
        </div>
    </div>


</div>

<script>
$(document).ready(function() {
    // get expence type
    var $current_amount = $('#acc_amount').val();
    var $radio = $('input[name=tr_status]:checked').val();
    $('#myForm input').on('change', function() {
       var $radio = $('input[name=tr_status]:checked', '#myForm').val();
    });
    // print remain || sum of current and old amount
    $('#tr_amount').keyup(function(event) {
        $new_amount = $(this).val();
        var $radio = $('input[name=tr_status]:checked', '#myForm').val();
        if($radio == 1)
        {
            $remain_amount = parseFloat($current_amount) + parseFloat($new_amount);
            $('#acc_amount').val($remain_amount);
        }else
        {
            $remain_amount = parseFloat($current_amount) - parseFloat($new_amount);
            $('#acc_amount').val($remain_amount);
        }
    });


    // Date Picker
    $('#tarikh').persianDatepicker({
        altField: '#tarikhAlt',
        altFormat: 'X',
        format: 'D/MMMM/YYYY',
        observer: true,
    });

    $('a.remove').confirm({
        title: 'توجه!',
        content: 'با حذف این فاکتور تمام مصارفی که در آن ثبت شده است حذف خواهد شد.',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    location.href = this.$target.attr('href');
                }
            },
            cancel: {
                text: 'انصراف',
                action: function () {
                }
            }
        }
    });


}); // end document
</script>