<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">پرداخت معاش کارمند</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('finance/insert_salary'); ?>" method='POST' >

                <div class="box-body">
                        <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                        <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); } ?>
                        <?php if($this->session->form_warning) { echo alert($this->session->form_warning,'warning'); } ?>

                    <input type="hidden" name="sal_emp_id" class="form-control"   id="sal_emp_id" />


                     <div class="form-group">
                        <label for="user_name">نام و تخلص کارمند</label>
                        <input type="text" class="form-control"  id="emp_full_name" placeholder="نام و تخلص"  required  disabled>
                    </div>

                    <div class="form-group">
                        <label for="user_name">عنوان پست کارمند</label>
                        <input type="text" class="form-control"  id="emp_position" placeholder="پست" disabled required>
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
                                    <input type="text" id="tarikh_month" class="form-control pull-right" style="z-index: 0;" readonly />
                                    <input type="hidden" id="tarikhAlt_month" name="sal_month" value="8" class="form-control pull-right" style="  font-style: Arial !important;  z-index: 0;" >
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                                <label for="sal_tax">مالیات</label>
                            <div class="input-group">
                                <span class="input-group-addon"><strong>%</strong></span>
                                <input type="number"  class="form-control" id="sal_tax_alt" step=".01" value="0" required />
                                <input type="hidden"  class="form-control" name="sal_tax" id="sal_tax" step=".01" value="0" required />
                              </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="sal_fine">جریمه</label>
                                <input type="number" name="sal_fine" class="form-control" id="sal_fine" step=".01"  value="0" required />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="sal_bonus">انعام</label>
                                <input type="number"  class="form-control" name="sal_bonus" id="sal_bonus" step=".01" value="0" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                                <label for="emp_salary">معاش کارمند</label>
                            <div class="input-group">
                                <input type="number"  class="form-control" id="emp_salary" step=".01" placeholder="مقدار باقیمانده" value="0" readonly>
                                <span class="input-group-addon">افغانی</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                                <label for="sal_amount">مقدار پرداختی  معاش </label>
                            <div class="input-group">
                                <input type="number"  class="form-control" name="sal_amount" id="sal_amount" step=".01" placeholder="اعشاری" required />
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
                        <textarea rows="5" class="form-control" name="sal_desc" id="sal_desc" placeholder="توضیحات / یادداشت" ></textarea>
                    </div>

                <input type="hidden" name="sal_payable" id="sal_payable" >
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
                    <table class="table table-hover table-warning">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام و تخلص</th>
                                <th>وظیفه</th>
                                <th>بخش کاری</th>
                                <th>معاش</th>
                                <th>پرداخت معاش</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($employees as $employee): ?>
                                <tr>
                                    <td><?=$i++ ?></td>
                                    <td><?=$employee->emp_name. ' ' . $employee->emp_lname; ?></td>
                                    <td><?=$employee->emp_position; ?></td>
                                    <td><?=($employee->emp_type == 0) ? '<span class="badge bg-orange">آشپزخانه</span>' : '<span class="badge bg-green">رستورانت</span>' ; ?></td>
                                    <td><?= number_format($employee->emp_salary); ?> افغانی</td>
                                    <!-- <td><?php // echo show_date('d/F/Y', '1395-10-5'); ?></td> -->
                                    <td class="text-center">
                                        <a class="label bg-green" onclick="select_emp(<?=$employee->emp_id?>,'<?=$employee->emp_name?>','<?=$employee->emp_lname?>','<?=$employee->emp_position?>','<?=$employee->emp_salary?>');"  data-toggle="tooltip" title="" data-original-title="Pay Salary"><i class="fa fa-money fa-lg"></i></a>
                                        <a class="label bg-gray pay_salary" onclick="$('#emp_id').val(<?=$employee->emp_id; ?>);" id="<?=$employee->emp_id; ?>" data-toggle="modal" data-target="#myModal" ><i class="fa fa-list fa-lg" data-toggle="tooltip" title="" data-original-title="Pay Remian Salary / Payment List"></i></a>
                                    </td>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                </table>
            </div>

            <!-- /.box-body -->
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <form action="<?= site_url('finance/pay_salary'); ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">پرداخت باقیمانده معاش</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tarikh">سال و ماه</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="tarikh_year_month" class="form-control pull-right" style="z-index: 0;" readonly />
                            <input type="hidden" id="tarikhAlt_year_month" name="date" value="8" class="form-control pull-right" style="  font-style: Arial !important;  z-index: 0;">
                        </div>
                        <!-- /.input group -->
                        <input type="hidden" id="emp_id" name="emp_id" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">پرداخت معاش</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">صرف نظر</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
function select_emp(id, name, lname, position, salary) {
    $("#sal_emp_id").val(id);
    $("#emp_full_name").val(name + ' ' + lname);
    $("#emp_position").val(position);
    $("#emp_salary").val(salary);
    $("#submit").attr('disabled', false);
}

$(document).ready(function() {
    // Date Picker
    $('#tarikh').persianDatepicker({
        altField: '#tarikhAlt',
        altFormat: 'YYYY/M/D',
        format: 'D/MMMM/YYYY',
        observer: true,
        position: [-65,200],
        calendar: {
                persian: {
                    enabled: true,
                    locale: 'en',
                    leapYearMode: "algorithmic" // "astronomical"
                },

                gregorian: {
                    enabled: false,
                    locale: 'fa'
                }
            }
    });

    // Month Picker
    $('#tarikh_month').persianDatepicker({
        altField: '#tarikhAlt_month',
        persianDigit: false,
        autoClose: true,
        yearPicker:{
            enabled: false
        },
        monthPicker:{
            enabled: true
        },
        dayPicker:{
            enabled: false
        },
        format: "MMMM",
        toolbox: {
            text: {
                btnToday: 'این ماه'
            },
            justSelectOnDate: false
        },
        altFormat: "M",
        // altFieldFormatter: alt_font() ,

        calendar: {
                persian: {
                    enabled: true,
                    locale: 'en',
                    leapYearMode: "algorithmic" // "astronomical"
                },

                gregorian: {
                    enabled: false,
                    locale: 'fa'
                }
            },
        position: [-65,200]
    });

    // function alt_font(){
    //     $('#year-picker').change(function() {
    //             //alert($(this).val());
    //             $('#yearpickerAlt').css("font-family", 'b titr');



     // Month Picker
    $('#tarikh_year_month').persianDatepicker({
        altField: '#tarikhAlt_year_month',
        persianDigit: false,
        autoClose: true,
        yearPicker:{
            enabled: true
        },
        monthPicker:{
            enabled: true
        },
        dayPicker:{
            enabled: false
        },
        format: "YYYY/MMMM",
        altFormat: "YYYY-M",

        calendar: {
                persian: {
                    enabled: true,
                    locale: 'en',
                    leapYearMode: "algorithmic" // "astronomical"
                },
                gregorian: {
                    enabled: false,
                    locale: 'fa'
                }
            },
        position: [-67, 200]
    });


    $('#sal_amount').keyup(function(event) {
        $emp_salary = $('#emp_salary').val();
        $sal_amount = $(this).val();
        $sal_bonus  = $('#sal_bonus').val();
        $sal_fine   = $('#sal_fine').val();
        $sal_tax    = $('#sal_tax_alt').val();




        if($sal_bonus <= 0){
            $total = 0;
            $total = $emp_salary;
            $('#sal_payable').val($total);
        }
        else
        {
            $total =  parseFloat($emp_salary) +  parseFloat($sal_bonus);
             $('#sal_payable').val($total);
        }

        if($sal_fine <= 0){
            $total = 0;
            $total = $emp_salary;
            $('#sal_payable').val($total);
        }else
        {
            $total =  parseFloat($emp_salary) -  parseFloat($sal_fine);
             $('#sal_payable').val($total);
        }

        $sal_payable_new = parseFloat($emp_salary) - parseFloat($sal_amount);
        $sal_payable_new = parseFloat($sal_payable_new) + parseFloat($sal_bonus);
        $sal_payable_new = parseFloat($sal_payable_new) - parseFloat($sal_fine);
        if ($sal_tax > 0) {
            $tax = parseFloat($emp_salary) / 100 * parseFloat($sal_tax);
            $sal_payable_new = parseFloat($sal_payable_new) - parseFloat($tax);

            $total = parseFloat($total) - parseFloat($tax);
        }

        $('#sal_remain').val($sal_payable_new);
        $('#sal_tax').val($tax);
        $('#sal_payable').val($total);



    });


}); // end document
</script>