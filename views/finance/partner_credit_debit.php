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
                <h3 class="box-title">عملیات جمع و برداشت </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" id="myForm" action="<?=site_url('finance/insert_partner_credit_debit'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="form-group">
                        <label for="emp_name">سهامدار</label>
                        <input type="text" class="form-control" value="<?=$partner->emp_name; ?>"  id="emp_name" placeholder="سهامدار" required  readonly/>
                    </div>

                    <div class="form-group">
                        <label for="old_part_amount">مقدار موجود</label>
                        <input type="number" class="form-control" value="<?=$partner->part_amount; ?>" id="old_part_amount" placeholder=" " required readonly/>
                    </div>

                    <div class="form-group">
                        <label for="part_amount">مقدار جدید</label>
                        <input type="number" class="form-control" max="" name="part_amount" id="part_amount" placeholder="مقدار پول (افغانی)  " required/>
                    </div>

                    <div class="form-group">
                        <label>تاریخ ثبت</label>
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
                            <input type="radio" name="tr_status" id="tr_status2" value="2" /> برداشت
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="acc_description">توضیحات / یادداشت</label>
                        <textarea  rows="7" class="form-control" name="tr_desc" id="acc_description" placeholder="توضیحات / یادداشت" ></textarea>
                    </div>


                <input type="hidden" name="tr_part_id" value="<?=$partner->part_id ?>"/>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                    <!-- <button class="example2 btn btn-primary">example confirm</button> -->
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست جمع و برداشت از حساب <?=$partner->emp_name; ?></h3>
                <div class="box-tools pull-right">
                    <a href="<?=site_url('finance/accounts'); ?>" class="btn btn-box-tool bg-blue" data-toggle="tooltip" title="" data-original-title="Accounts List"><i class="ion-lock-combination fa-lg"></i></a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive ">
                <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>توضیحات</th>
                            <th>مقدار برداشت/جمع</th>
                            <th>وضعیت</th>
                            <th class="text-center text">تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; $credit=null; $debit=null; foreach ($transections as $transection): ?>
                        <tr id="tr_<?=$transection->tr_id  ?>">
                            <td><?=$i++ ?></td>
                            <td><span data-toggle="tooltip" title="" data-original-title="<?=$transection->tr_desc; ?>"><?=substr_fa($transection->tr_desc, 20); ?></span></td>
                            <td class="text-center"><?=$transection->tr_amount ?> افغانی</td>
                            <td class="text-center"><?=($transection->tr_status == 1) ? '<i data-toggle="tooltip" title="" data-original-title="Debit" class="ion ion-android-add-circle fa-lg text-success"></i>' : '<i data-toggle="tooltip" title="" data-original-title="Credit" class="ion ion-android-remove-circle fa-lg text-danger"></i>' ; ?></td>
                            <td class="text-center"><?=show_date('l d/F/Y', $transection->tr_date); ?></td>
                            <td class="text-center"><!-- <a href="" class="edit" id="<?//=$transection->tr_id ?>"><span class="label label-default "><i class="fa fa-edit fa-lg"></i></span></a> -->  <a class="remove" href="<?=site_url('finance/delete_transection/'.$transection->tr_id.'/'.base_account()->acc_id.'/'.base_account()->acc_amount); ?>"  data-toggle="tooltip" title="" data-original-title="Remove"><span class="label label-danger "><i class="ion ion-trash-b fa-lg"></i></span></a></td>
                        </tr>
                        <?php ($transection->tr_status == 1) ? $credit += $transection->tr_amount : $debit += $transection->tr_amount; ?>
                        <?php endforeach ?>
                        <?php $remain =   $credit - $debit; ?>
                    </tbody>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>موجود در حساب:</th>
                            <th class="text-center <?=($remain > 0)? 'bg-success' :'bg-danger'  ; ?>"><?=($remain > 0) ? '<span class="text-success">'.$remain.' افغانی</span>' : '<span class="text-danger">'.$remain.' افغانی</span>' ; ?></th>
                            <th></th>
                            <th class="text-center"> </th>
                            <th></th>
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
    // get transection type
    var $current_amount = $('#old_part_amount').val();
    var $radio = $('input[name=tr_status]:checked').val();
    $('#myForm input').on('change', function() {
       var $radio = $('input[name=tr_status]:checked', '#myForm').val();
    });
    // print remain || sum of current and old amount
    $('#part_amount').keyup(function(event) {
        $new_amount = $('#part_amount').val();
        var $radio = $('input[name=tr_status]:checked', '#myForm').val();
        if($radio == 1)
        {
            $remain_amount = parseFloat($current_amount) + parseFloat($new_amount);
            $('#old_part_amount').val($remain_amount);
        }else
        {
            $remain_amount = parseFloat($current_amount) - parseFloat($new_amount);
            $('#old_part_amount').val($remain_amount);
        }
    });


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