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
                            <th class="text-center">تعداد / واحد</th>
                            <th class="text-center">قیمت فی واحد</th>
                            <th class="text-center">هزینه کل</th>
                            <th>توضیحات</th>
                            <th class="text-center">تاریخ</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($expences as $expence): ?>
                        <tr id="tr_<?=$expence->dex_id  ?>">
                            <td><?=$i++ ?></td>
                            <td ><?=$expence->dex_name ?></td>
                            <td class="text-center"><?=$expence->dex_count ?> <?=$expence->unit_name ?></td>
                            <td class="text-center"><?=$expence->dex_price ?> افغانی</td>
                            <td class="text-center"><?=$expence->dex_total_amount ?> افغانی</td>
                            <td ><span data-toggle="tooltip" title="" data-original-title="<?=$expence->dex_desc; ?>"><?=substr_fa($expence->dex_desc, 20); ?></span></td>
                            <td class="text-center"><?=mds_date("Y/F/d ", $expence->dex_date); ?></td>
                            <td class="text-center"><a href="" class="edit" id="<?=$expence->dex_id ?>"><span class="label label-default "><i class="fa fa-edit fa-lg"></i></span></a>  <a class="remove" href="<?=site_url('finance/delete_expence/'.$expence->dex_id); ?>"  ><span class="label label-danger "><i class="ion ion-trash-b fa-lg"></i></span></a></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>مجموعه:</th>
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