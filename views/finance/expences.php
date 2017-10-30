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


    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست مصارف روزانه</h3>
                <div class="box-tools pull-right">
                    <a href="<?=site_url('finance/new_expence'); ?>" class="btn btn-box-tool bg-blue" data-toggle="tooltip" title="" data-original-title="New Expence"><i class="ion ion-plus fa-lg"></i></a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم جنس</th>
                            <th>تعداد/واحد</th>
                            <th>قیمت فی واحد</th>
                            <th>هزینه کل</th>
                            <th>توضیحات نمبر بل</th>
                            <th class="text-center">تاریخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; $credit=null; $debit=null; foreach ($expences as $expence): ?>
                        <tr id="tr_<?=$expence->tr_id  ?>">
                            <td><?=$i++ ?></td>
                            <td><span data-toggle="tooltip" title="" data-original-title="<?=$expence->tr_desc; ?>"><?=substr_fa($expence->tr_desc, 20); ?></span></td>
                            <td class="text-center"><?=$expence->dex ?> افغانی</td>
                            <td class="text-center"><?=($expence->tr_status == 1) ? '<i data-toggle="tooltip" title="" data-original-title="Debit" class="ion ion-android-add-circle fa-lg text-success"></i>' : '<i data-toggle="tooltip" title="" data-original-title="Credit" class="ion ion-android-remove-circle fa-lg text-danger"></i>' ; ?></td>
                            <td><?=mds_date("Y/F/d ", $expence->tr_date); ?></td>
                            <td><a href="" class="edit" id="<?=$expence->tr_id ?>"><span class="label label-default "><i class="fa fa-edit fa-lg"></i></span></a>  <a class="remove" href="<?=site_url('finance/delete_expence/'.$expence->tr_id.'/'.$account->acc_id.'/'.$account->acc_amount); ?>"  ><span class="label label-danger "><i class="ion ion-trash-b fa-lg"></i></span></a></td>
                        </tr>
                        <?php ($expence->tr_status == 1) ? $credit += $expence->tr_amount : $debit += $expence->tr_amount; ?>
                        <?php endforeach ?>
                        <?php $remain =   $credit - $debit; ?>
                    </tbody>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>مجموعه:</th>
                            <th class="text-center <?=($remain > 0)? 'bg-success' :'bg-danger'  ; ?>"><?=($remain > 0) ? '<span class="text-success">'.$remain.' افغانی</span>' : '<span class="text-danger">'.$remain.' افغانی</span>' ; ?></th>
                            <th></th><th></th><th></th>
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
        title: 'حذف',
        content: 'آیا با حذف این معامله موافق هستید؟',
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