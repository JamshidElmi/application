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
    <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"> جمع و برداشت </h3>
                <div id="radios" class="btn-group pull-left" data-toggle="buttons">
                    <label class="btn btn-xs btn-warning active" id="persentage_1" data-toggle="tooltip" data-original-title="Set the Percentage by Input Field">
                        <input type="radio" id="persentage1" value="1" checked /> فیصدی دستی
                    </label>
                    <label class="btn btn-xs btn-warning " id="persentage_2" data-toggle="tooltip" data-original-title="System will Set the Percentage Automatically" >
                        <input type="radio" id="persentage2" value="2" />  فیصدی خودکار
                    </label>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" id="myForm" action="<?=site_url('finance/insert_partner_credit_debit'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="emp_name">سهامدار</label>
                                <input type="text" class="form-control" value="<?= $partner->emp_name; ?>" id="emp_name" placeholder="سهامدار" required readonly />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="old_part_amount">مقدار موجود</label>
                                <input type="number" class="form-control" value="<?=$partner->part_amount; ?>" id="old_part_amount" placeholder=" " required readonly/>
                            </div>
                        </div>
                    </div>

                    <label for="emp_phone">نوعیت عملیات</label> &nbsp;&nbsp;&nbsp;
                    <div id="radios" class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary btn-sm active">
                            <input type="radio" name="tr_status" id="tr_status1" value="1" checked /> جمع
                        </label>
                        <label class="btn btn-primary btn-sm">
                            <input type="radio" name="tr_status" id="tr_status2" value="2" /> برداشت
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="part_amount">مقدار جدید</label>
                        <div class="input-group">
                            <input type="number" class="form-control" max="" name="part_amount" id="part_amount" placeholder="مقدار پول (افغانی)  " required />
                            <div class="input-group-addon">افغانی</div>
                        </div>
                    </div>

                    <div id="persentage"> <!-- Percentage field Here-->
                        <label for="part_persent">فیصدی</label>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" class="form-control" max="100" name="part_persent" id="part_persent" placeholder=" مقدار (فیصدی)  " required/>
                                <div class="input-group-addon">%</div>
                            </div>
                        </div>
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

    <div class="col-md-8">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست جمع و برداشت از حساب <?=$partner->emp_name; ?></h3>
                <div class="box-tools pull-right">
                    <a href="<?=site_url('setting/partners'); ?>" class="btn btn-box-tool bg-green" data-toggle="tooltip" data-original-title="Add Partner"><i class="fa fa-user-plus fa-lg"></i></a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive ">
                <?php if($this->session->form_2_errors) { echo alert($this->session->form_2_errors,'danger'); }  ?>
                <?php if($this->session->form_2_success) { echo alert($this->session->form_2_success,'success'); }  ?>
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
                            <td class="text-center"><?=show_date('d/F/Y', $transection->tr_date); ?></td>
                            <td class="text-center"><a class="remove read-only" href-auto-persent="<?=site_url('finance/delete_partner_transection/'.$transection->tr_id.'/'.$transection->tr_amount.'/'.$transection->tr_status.'/'.$partner->part_id.'/'.$partner->part_amount.'/auto'); ?>" href="<?=site_url('finance/delete_partner_transection/'.$transection->tr_id.'/'.$transection->tr_amount.'/'.$transection->tr_status.'/'.$partner->part_id.'/'.$partner->part_amount); ?>"  data-toggle="tooltip" title="" data-original-title="Remove"><span class="label label-danger "><i class="ion ion-trash-b fa-lg"></i></span></a></td>
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

    $('#persentage_1').click(function () {
        $('#persentage').html('<div class="form-group">\n' +
            '                            <label for="part_persent">فیصدی</label>\n' +
            '                            <input type="number" class="form-control" max="100" name="part_persent" id="part_persent" placeholder=" مقدار (فیصدی)  " required/>\n' +
            '                        </div>');
    });

    $('#persentage_2').click(function () {
        $('#persentage').html('');
    });

    // Date Picker
    $('#tarikh').persianDatepicker({
        altField: '#tarikhAlt',
        format: 'D/MMMM/YYYY',
        observer: true,

        altFormat: 'YYYY-MM-DD',
        observer: true,
        position: [-67,200],
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
        }
    });

    $('a.remove').confirm({
        title: 'حذف',
        content: 'آیا با حذف این معامله فیصدی سهامداران در حالت خود باقی بماند و یا فیصدی ها بروز شوند؟',
        type: 'red',
        rtl: true,
        buttons: {
            update: {
                text: 'بروز شوند',
                btnClass: 'btn-blue',
                action: function () {
                    location.href = this.$target.attr('href-auto-persent');
                }
            },
            confirm: {
                text: 'خیر بروز نشوند',
                btnClass: 'btn-orange',
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