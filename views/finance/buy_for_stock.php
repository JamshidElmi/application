<div class="row">
    <div class="col-md-8">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">فرم ثبت خریداری برای گدام</h3>
                <div class="box-tools pull-right">
                    <a href="#" data-toggle="modal" data-target="#create_account" class="btn btn-box-tool bg-green" data-toggle="tooltip" title="" data-original-title="Create Partner"><i class="ion ion-lock-combination fa-lg"></i></a>
                    <a href="<?= site_url('finance/expences/1'); ?>" class="btn btn-box-tool bg-gray" data-toggle="tooltip" title="" data-original-title="Expences List"><i class="ion-android-list fa-lg"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" id="myForm" action="<?= site_url('finance/insert_stock_expence'); ?>">
                
                <div class="box-body">
                    <?php if ($this->session->form_errors) {
                        echo alert($this->session->form_errors, 'danger');
                    } ?>
                    <?php if ($this->session->form_success) {
                        echo alert($this->session->form_success, 'success');
                    } ?>
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="dex_shop">نام دوکان</label>
                                <input type="text" class="form-control" value="<?= $this->session->bill_info['bill_shop']; ?>" name="bill_shop" id="bill_shop" placeholder="نام دوکان" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="dex_bill_no">شماره فاکتور</label>
                                <input type="text" class="form-control" name="bill_no" value="<?= $this->session->bill_info['bill_no']; ?>" id="bill_no" placeholder="شماره فاکتور" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>تاریخ</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                                    <input type="hidden" id="tarikhAlt" value="<?= $this->session->bill_info['bill_date']; ?>" name="bill_date" class="form-control pull-right" style="z-index: 0;">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>انتخاب همکار</label> <select name="dex_name" id="dex_name" class="form-control">
                                    <?php if ($this->session->bill_info): ?>
                                        <option value="<?= $this->session->bill_info['acc_id']; ?>" acc-amount="<?= $this->session->bill_info['acc_amount']; ?>"><?= $this->session->bill_info['acc_name']; ?></option>
                                    <?php else: ?>
                                        <option value="">انتخاب کنید</option>
                                    <?php endif ?>
                                    
                                    <?php foreach ($accounts as $account)
                                    {
                                        echo '<option value="' . $account->acc_id . '" acc-amount="' . $account->acc_amount . '">' . $account->acc_name . '</option>';
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="acc_id" id="acc_id" value="<?= $this->session->bill_info['acc_id']; ?>">
                                <input type="hidden" name="acc_name" id="acc_name" value="<?= $this->session->bill_info['acc_name']; ?>">
                                <input type="hidden" name="acc_amount" id="acc_amount" value="<?= $this->session->bill_info['acc_amount']; ?>">
                            </div>
                        </div>
                        
                        <div class="col-sm-3 hidden">
                            <div class="form-group">
                                <label for="dex_shop">موجودی صندوق</label>
                                <!-- <input type="text" class="form-control" value="<? //=$acc_amount; ?>" id="dex_shop" disabled /> -->
                                <!-- <input type="hidden" name="acc_amount" value="0" id="acc_amount"> -->
                            </div>
                        </div>
                    </div>
                    <hr>
                    
                    <!-- row[] -->
                    <div class="input_fields_wrap">
                        <!-- Fields Dynamicly will Added -->
                        
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>نوع جنس</label>
                                    
                                    <select name="st_name" id="st_name" class="form-control">
                                        <option value="">انتخاب کنید</option>
                                        <?php foreach ($stock_units as $stock_unit)
                                        {
                                            echo '<option st-id="' . $stock_unit->st_id . '" value="' . $stock_unit->st_unit . '" st-unit-name="' . $stock_unit->unit_name . '" st-max-count="' . $stock_unit->st_max_count . '" st-min-count="' . $stock_unit->st_min_count . '" >' . $stock_unit->st_name . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="dex_unit">واحد</label>
                                    <input name="dex_unit" id="dex_unit" class="form-control" required readonly />
                                    <input type="hidden" name="dex_unit_id" id="dex_unit_id" class="form-control" required readonly />
                                    <input type="hidden" name="st_unit_name" id="st_unit_name" class="form-control" required readonly />
                                    <input type="hidden" name="st_id" id="st_id" class="form-control" required readonly />
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="dex_count">تعداد</label>
                                    <input type="number" class="form-control" name="dex_count" id="dex_count" placeholder="تعداد عدد " required />
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="dex_price">قیمت فی واحد</label>
                                    <input type="number" class="form-control" name="dex_price" id="dex_price" placeholder="قیمت عدد" required />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="dex_total_amount">هزینه کل</label>
                                    <input type="number" class="form-control" id="dex_total_amount_alt" placeholder="هزینه کل " disabled />
                                    <input type="hidden" class="form-control" name="dex_total_amount" id="dex_total_amount" />
                                </div>
                            </div>
                            <!-- <a href="#" style="padding-top:30px;" class="remove_field col-xs-1" >
                                <i class="ion ion-trash-b text-red fa-lg" data-toggle="tooltip" title="" data-original-title="Remove"></i>
                            </a> -->
                        </div>
                    
                    
                    </div>
                    <!-- row[END] -->
                    
                    
                    <div class="form-group hidden">
                        <div class="row">
                            <div class="col-xs-10">
                                <a class="btn btn-primary col-xs-12 add_field_button" id="add_new" data-toggle="tooltip" title="" data-original-title="Add New"><i class="ion-android-add-circle fa-lg"></i></a>
                            </div>
                            <div class="col-xs-2">
                                <button type=button class="btn btn-warning col-xs-12" id="calcolate" data-toggle="tooltip" title="" data-original-title="Sum Total">
                                    <i class="ion-calculator fa-lg"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="dex_desc">توضیحات / یادداشت</label>
                        <textarea rows="7" class="form-control" name="dex_desc" id="dex_desc" placeholder="توضیحات / یادداشت"></textarea>
                    </div>
                
                
                </div>
                <div class="box-footer">
                    <div class="col-xs-6">
                        <?php if ($this->session->bill_info): ?>
                            <button type="submit" id="submit" name="second" disabled class="btn btn-success">ذخیره و ادامه
                                <i class="fa fa-save"></i></button>
                        <?php else: ?>
                            <button type="submit" id="submit" name="first" disabled class="btn btn-success">ذخیره و ادامه
                                <i class="fa fa-save"></i></button>
                        <?php endif ?>
                        <!--                    <a href="--><? //=site_url('finance/end_buy'); ?><!--" class="btn btn-danger">ختم خرید <i class="fa ion-ios-cart fa-lg"></i></a>-->
                        <a href="#" data-toggle="modal" data-target="#pay_amount" id="get_pay_amount" class="btn btn-warning">ختم خرید و پرداخت
                            <i class="fa ion-ios-cart fa-lg"></i></a>
                        <!--                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>-->
                    </div>
                    
                    <div class="col-xs-6">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <span>مجموعه:</span>
                            </div>
                            <input type="hidden" name=dex_sum id="sum" value="<?= ($this->session->total_amount) ? $this->session->total_amount : '0'; ?>">
                            <input type="text" id="sum_alt" readonly value="<?= ($this->session->total_amount) ? $this->session->total_amount : '0'; ?>" class="form-control col-xs-4 pull-left">
                            <div class="input-group-addon">
                                <span>افغانی</span>
                            </div>
                        </div>
                    </div>
                
                </div>
            </form>
        </div>
    </div> <!-- end col-sm-8 -->
    
    <div class="col-sm-4">
        <div id="partner-box" class="info-box  ">
            <span class="info-box-icon"><i class="ion ion-lock-combination fa-lg"></i></span>
            
            <div class="info-box-content">
                <span class="info-box-text" id="box_acc_name">حسابی انتخاب نشده است</span>
                <span class="info-box-number"> همکار انتخاب نشده</span>
                
                <div class="progress" style="height: 5px;">
                    <div id="progress-bar" class="progress-bar" style="width: 100%;"></div>
                </div>
                <span class="progress-description">مصرفی ثبت نشده است</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>


</div>


<!-- Payment Modal -->
<div id="pay_amount" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title no-margin">پرداخت هزینه </h4>
            </div>
            <form role="form" method="POST" action="<?= site_url('finance/insert_stock_pay_transection'); ?>">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="tr_amount">هزینه قابل پرداخت</label>
                        <div class="input-group">
                            <input type="number" value="<?= ($this->session->total_amount) ? $this->session->total_amount : '0' ?>" step="0.1" class="form-control" disabled />
                            <div class="input-group-addon">افغانی</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tr_amount">مبلغ پرداختی</label>
                        <div class="input-group">
                            <input type="number" value="0" step="0.1" id="tr_amount" name="tr_amount" class="form-control" />
                            <div class="input-group-addon">افغانی</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>تاریخ پرداخت</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="tarikh_pay" class="form-control pull-right" style="z-index: 0;" readonly />
                            <input type="hidden" id="tarikh_payAlt" name="tr_date" class="form-control pull-right" style="z-index: 0;">
                        </div>
                        <!-- /.input group -->
                    </div>
                    
                    <div class="form-group">
                        <label for="dex_desc">توضیحات / یادداشت</label>
                        <textarea rows="7" class="form-control" name="tr_desc" id="dex_desc" placeholder="توضیحات / یادداشت"></textarea>
                    </div>
                    <input type="hidden" name="tr_acc_id" value="<?= $this->session->insert_ids['acc_id'] ?>">
                    <input type="hidden" name="bill_id" value="<?= $this->session->insert_ids['bill_id'] ?>">
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success " <?= ($this->session->insert_ids) ? '' : 'disabled' ?>>پرداخت
                        <i class="fa fa-save"></i></button>
                    <a href="<?= site_url('finance/end_buy') ?>" class="btn btn-danger">ختم خرید
                        <i class="fa fa-close"></i></a>
                </div>
            </form>
        
        </div>
    </div>
</div>


<!-- Modal -->
<div id="create_account" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title no-margin">ایجاد حساب جدید</h4>
            </div>
            <form role="form" method="POST" action="<?= site_url('finance/insert_account/buy_stock'); ?>">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="acc_name">نام صندوق</label>
                        <input type="text" class="form-control" name="acc_name" id="acc_name" placeholder="نام صندوق" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="emp_phone">نوعیت حساب</label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-warning btn-sm read-only active">
                                <input type="radio" name="acc_type" id="acc_type1" value="1" checked /> همکار </label>
                            <label class="btn btn-warning btn-sm ">
                                <input type="radio" name="acc_type" id="acc_type2" value="2" /> مشتری </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="acc_amount">مقدار اولیه</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="acc_amount" value="0" id="acc_amount" placeholder="مقدار اولیه به عدد " required />
                            <div class="input-group-addon">افغانی</div>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label>تاریخ ایجاد</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="tarikh_acc" class="form-control pull-right" style="z-index: 0;" readonly>
                            <input type="hidden" id="tarikh_accAlt" name="acc_date" class="form-control pull-right" style="z-index: 0;">
                        </div>
                        <!-- /.input group -->
                    </div>
                    
                    <div class="form-group">
                        <label for="acc_description">توضیحات / یادداشت</label>
                        <textarea type="number" rows="7" class="form-control" name="acc_description" id="acc_description" placeholder="توضیحات / یادداشت" /></textarea>
                    </div>
                
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن <i class="fa fa-close"></i>
                    </button>
                </div>
            </form>
        
        </div>
    </div>
</div>


<script>
    // Date Picker
    $(document).ready(function () {
        $('#tarikh').persianDatepicker({
            altField: '#tarikhAlt',
            format: 'D/MMMM/YYYY',
            observer: true,
            altFormat: 'YYYY-MM-DD',
            position: [-65, 200],
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

        // account date
        $('#tarikh_acc').persianDatepicker({
            altField: '#tarikh_accAlt',
            format: 'D/MMMM/YYYY',
            observer: true,
            altFormat: 'YYYY-MM-DD',
            position: [-65, 200],
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

        // pay date
        $('#tarikh_pay').persianDatepicker({
            altField: '#tarikh_payAlt',
            format: 'D/MMMM/YYYY',
            observer: true,
            altFormat: 'YYYY-MM-DD',
            position: [-65, 200],
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


        $('#get_pay_amount').click(function () {
            //
        });
        
        
        
        <?php if($this->session->bill_info)
        { ?>
        // $('#partner-box').addClass('bg-green');
        $('#bill_shop').attr('readonly', true);
        $('#bill_no').attr('readonly', true);
        $('#dex_name').attr('disabled', true);
        $('#tarikh').attr('disabled', true);
        $('#submit').attr('disabled', false);

        var id = $("#dex_name option:selected").val();
        var acc_name = $("#dex_name option:selected").text();
        var acc_amount = $("#dex_name option:selected").attr('acc-amount');

        if (acc_amount >= 0) {
            $('#partner-box').addClass('bg-green').removeClass('bg-red');
        }
        else {
            $('#partner-box').addClass('bg-red').removeClass('bg-green');
        }

        // alert(acc_amount);
        $('.info-box-number').html(acc_amount + ' افغانی موجود');
        $('.info-box-text').html(acc_name);
        $('#acc_name').val(acc_name);
        $('#acc_id').val(id);
        $('#acc_amount').val(acc_amount);

        $('#dex_price').keyup(function (event) {
            var new_amm = $(this).val() * $('#dex_count').val();
            $('#dex_total_amount').val(new_amm);
            $('#dex_total_amount_alt').val(new_amm);

            var remain = parseFloat(acc_amount) - parseFloat(new_amm);
            $('#acc_amount').val(remain);
            $('.info-box-number').html(remain + ' افغانی باقیمانده');

            $('#sum').val(new_amm);
//            $('#sum_alt').val(total_amount);

            var persentage = parseFloat(new_amm) * parseFloat(100) / parseFloat(acc_amount);
            var persentage_plus = Math.round(100 - persentage);
            $('#progress-bar').css('width', persentage_plus + '%');
            $('.progress-description').html(Math.round(persentage) + ' درصد کاهش از صندوق');

            if (remain >= 0) {
                $('#partner-box').addClass('bg-green').removeClass('bg-red');
            }
            else {
                $('#partner-box').addClass('bg-red').removeClass('bg-green');
            }
        });
        
        <?php }else{ ?>

        // get account data
        $('#dex_name').change(function (event) {

            var id = $("#dex_name option:selected").val();
            var acc_name = $("#dex_name option:selected").text();
            var acc_amount = $("#dex_name option:selected").attr('acc-amount');
            $('#submit').attr('disabled', false);

            if (acc_amount >= 0) {
                $('#partner-box').addClass('bg-green').removeClass('bg-red');
            }
            else {
                $('#partner-box').addClass('bg-red').removeClass('bg-green');
            }
            // alert(acc_amount);
            $('.info-box-number').html(acc_amount + ' افغانی موجود');
            $('.info-box-text').html(acc_name);
            $('#acc_name').val(acc_name);
            $('#acc_id').val(id);
            $('#acc_amount').val(acc_amount);

            // calcolate amount
            $('#dex_price').keyup(function (event) {
                var new_amm = $(this).val() * $('#dex_count').val();
                $('#dex_total_amount').val(new_amm);
                $('#dex_total_amount_alt').val(new_amm);

                $('#sum').val(new_amm);
//                $('#sum_alt').val(new_amm);

                var persentage = parseFloat(new_amm) * parseFloat(100) / parseFloat(acc_amount);
                var persentage_plus = Math.round(100 - persentage);
                $('#progress-bar').css('width', persentage_plus + '%');
                $('.progress-description').html(Math.round(persentage) + ' درصد کاهش از صندوق');


                var remain = parseFloat(acc_amount) - parseFloat(new_amm);
                $('#acc_amount').val(remain);
                $('.info-box-number').html(remain + ' افغانی باقیمانده');

                if (remain >= 0) {
                    $('#partner-box').addClass('bg-green').removeClass('bg-red');
                }
                else {
                    $('#partner-box').addClass('bg-red').removeClass('bg-green');
                }
            });
        });
        
        <?php } ?>

        // set max count and unit
        $('#st_name').change(function (event) {
            var id = $(this).val();
            var unit = $("#st_name option:selected").attr('st-unit');
            var unit_name = $("#st_name option:selected").attr('st-unit-name');
            var max = $("#st_name option:selected").attr('st-max-count');
            var min = $("#st_name option:selected").attr('st-min-count');
            var st_id = $("#st_name option:selected").attr('st-id');
            var text = $("#st_name option:selected").text();
            // alert(unit_name);
            $('#dex_unit').val(unit_name);
            $('#dex_count').attr('max', max);
            $('#dex_unit_id').val(id);
            $('#st_unit_name').val(text);
            $('#st_id').val(st_id);
        });

    }); // end document
</script>








