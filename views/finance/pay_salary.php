<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">پرداخت معاش کارمند</h3>
                <?php // show_date('Y/m/d', '1395-10-5'); ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('finance/insert_salary_pay'); ?>" method='POST' >

                <div class="box-body">
                        <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                        <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); } ?>

                    <input type="hidden" name="sal_emp_id" class="form-control" value="<?=$employee->emp_id?>"  id="sal_emp_id"/>


                     <div class="form-group">
                        <label for="user_name">نام و تخلص کارمند</label>
                        <input type="text" class="form-control"  id="emp_full_name" value='<?=$employee->emp_name.' '.$employee->emp_lname ?>' placeholder="نام و تخلص"  required  disabled>
                    </div>

                    <div class="form-group">
                        <label for="user_name">عنوان پست کارمند</label>
                        <input type="text" class="form-control" value="<?=$employee->emp_position ?>" id="emp_position" placeholder="پست" disabled required>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tarikh">تاریخ</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                                    <input type="hidden" id="tarikhAlt" name="sal_date"  class="form-control pull-right" style="z-index: 0;" >
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tarikh">برج / ماه</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="tarikh_month" value="<?=show_date('F', '1396-'.$salaries[0]->sal_month.'-01')?>" class="form-control pull-right" disabled style="z-index: 0;" readonly>
                                    <input type="hidden" id="tarikhAlt_month" value="<?=$salaries[0]->sal_month ?>" name="sal_month" value="8" class="form-control pull-right" style="  font-style: Arial !important;  z-index: 0;" >
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                                <label for="emp_salary">معاش قابل پرداخت</label>
                            <div class="input-group">
                                <input type="number"  class="form-control" id="emp_salary" value="<?=$salaries[0]->sal_remain?>" step=".01" placeholder="مقدار باقیمانده" value="0" readonly>
                                <span class="input-group-addon">افغانی</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                                <label for="sal_amount">مقدار پرداختی  معاش </label>
                            <div class="input-group">
                                <input type="number"  class="form-control" max="<?=$salaries[0]->sal_remain?>" name="sal_amount" id="sal_amount" step=".01" placeholder="اعشاری" required />
                                <span class="input-group-addon">افغانی</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="sal_remain">باقی مانده معاش</label>
                                <input type="number"  class="form-control" name="sal_remain" id="sal_remain" step=".01" placeholder="مقدار باقیمانده" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sal_desc">توضیحات / یادداشت</label>
                        <textarea rows="5" class="form-control" name="sal_desc" id="sal_desc" placeholder="توضیحات / یادداشت" /></textarea>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" id="submit" disabled="disabled" class="btn btn-primary">پرداخت معاش <i class="fa ion-cash"></i></button>
                    <button type="reset" class="btn btn-default">پاک کردن <i class="fa fa-refresh"></i></button>
                    <br>
                    <small>لطفاً قبل از فشردن دکمه پرداخت معاش یکی از کارمندان را انتخاب کنید </small>
                </div>

            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">لیست کارمندان</h3>
            </div>
            <!-- /.box-header -->
                <div class="box-body no-padding">
                <table class="table table-hover table-warning table-border">
                    <tr>
                        <th class="text-center bg-info">نام و تخلص</th>
                        <th class="text-center bg-info">برج / ماه</th>
                        <th class="text-center bg-info">معاش اصلی</th>
                        <th class="text-center bg-info">معاش قابل پرداخت</th>
                    </tr>
                    <tr>
                        <td class="text-center"><?=$employee->emp_name.' '.$employee->emp_lname ?></td>
                        <td class="text-center"><?=show_date('F', '1396-'.$salaries[0]->sal_month.'-01')?></td>
                        <td class="text-center"><?=$employee->emp_salary?> افغانی</td>
                        <td class="text-center"><b><?=$salaries[0]->sal_payable?></b> افغانی</td>
                    </tr>

                    <tr>
                        <th class="text-center bg-info">مالیت</th>
                        <th class="text-center bg-info">جریمه</th>
                        <th class="text-center bg-info">انعام</th>
                        <th class="text-center bg-info">باقیمانده معاش</th>
                    </tr>
                    <tr>
                        <td class="text-center bg-danger"><?=$salaries[0]->sal_tax?> افغانی</td>
                        <td class="text-center bg-danger"><?=$salaries[0]->sal_fine?> افغانی</td>
                        <td class="text-center bg-success"><?=$salaries[0]->sal_bonus?> افغانی</td>
                        <td class="text-center bg-danger text-danger"><b><?=$salaries[0]->sal_remain?></b> افغانی</td>
                    </tr>
                </table>
                <br>
                <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>

                    <table class="table table-hover table-warning">
                        <thead>
                            <tr class="bg-primary">
                                <th>#</th>
                                <th>مقدار پرداختی</th>
                                <th>توضیحات</th>
                                <th>تاریخ پرداخت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($salaries as $salary): ?>
                                <tr id="sal_<?php echo $salary->tr_id; ?>">
                                    <td><?=$i++ ?></td>
                                    <td><?=$salary->tr_amount; ?> افغانی</td>
                                    <td><?=$salary->tr_desc; ?> </td>
                                    <td><?php  echo show_date('d/F/Y', $salary->tr_date); ?></td>
                                    <td class="text-center">
                                        <a class="sal_id_to_delete" href="#" id="<?php echo $salary->tr_id; ?>" data-toggle="tooltip" title="" data-original-title="Remove" ><i class="fa ion-android-delete fa-lg text-danger"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
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
    // delete job
    $('.sal_id_to_delete').confirm({
        title: 'حذف',
        content: 'آیا با حذف این پرداخت موافق هستید؟',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    // var tr_id = $(this).attr('tr-id');
                    var tr_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                        $(".overlay").css('display','block');
                    });
                      $.post("<?php echo site_url('finance/delete_salary'); ?>",{tr_id:tr_id},function(response){
                      });
                    $(document).ajaxStop(function(){
                        $(".overlay").css('display','none');
                        $(".msg").css('display','block');
                        $("tr#sal_"+tr_id).remove();
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
});


// $(document).ready(function() {
//     $('.sal_id_to_delete').click(function() {
//         var tr_id = $(this).attr('tr-id');
//         if (confirm('آیا با حذف این پرداخت موافق هستید؟'))
//         {
//             $(document).ajaxStart(function(){
//                 $(".overlay").css('display','block');
//             });
//               $.post("<?php //echo site_url('finance/delete_salary'); ?>",{tr_id:tr_id},function(response){

//               });
//             $(document).ajaxStop(function(){
//                 $(".overlay").css('display','none');
//                 $(".msg").css('display','block');
//                 $("tr#sal_"+tr_id).remove();
//             });
//         };
//     });
// });














$(document).ready(function() {
    // Date Picker
    $('#tarikh').persianDatepicker({
        altField: '#tarikhAlt',
        altFormat: 'YYYY-MM-DD',
        format: 'D/MMMM/YYYY',
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


    $('#sal_amount').keyup(function(event) {
        $emp_salary = $('#emp_salary').val();
        $sal_amount = $(this).val();

        $sal_remain =  parseFloat($emp_salary) -  parseFloat($sal_amount);

        $('#sal_remain').val($sal_remain);
        $('#submit').attr('disabled', false);

    });


}); // end document
</script>