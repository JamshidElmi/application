<div class="row">
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت سفارش برای رستورانت</h3>
                <div class="box-tools pull-right">
                    <a href="" data-toggle="modal" data-target="#orderModal" class="btn btn-box-tool bg-orange" title="Order Summary"><i class="fa ion-eye fa-lg"></i></a>
                    <a href="<?= site_url('order/garson_resturant_orders'); ?>" class="btn btn-box-tool bg-gray" data-toggle="tooltip" data-original-title="Order List"><i class="fa fa-list-ul fa-lg"></i></a>
                    <a href="" data-toggle="modal" data-target="#create_account" class="btn btn-box-tool bg-green" title="Create Customer"><i class="fa ion-person-add fa-lg"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $bm_id = (isset($bm->bm_id)) ? $bm->bm_id : '' ?>
            <form role="form" method="POST" action="<?= site_url('order/insert_resturant_order/garson_ordering'); ?>">

                <div class="box-body">
                    <?php if ($this->session->form_errors) {
                        echo alert($this->session->form_errors, 'danger');
                    } ?>
                    <?php if ($this->session->form_success) {
                        echo alert($this->session->form_success, 'success');
                    } ?>
                    <?php if ($this->session->file_errors) {
                        echo alert($this->session->file_errors, 'warning');
                    } ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label for="ord_cus_id">انتخاب مشتری</label>
                                <select style="width: 100%" name="ord_cus_id" id="ord_cus_id" class="form-control select2">
                                    <option value="<?= base_account()->acc_id ?>_">انتخاب کنید</option><?php foreach ($customers as $customer): ?>
                                    <option cus-acc-id="<?= $customer->cus_acc_id ?>" value="<?= $customer->cus_id ?>"><?= $customer->cus_name . ' ' . $customer->cus_lname ?>
                                    <span>(<?= $customer->cus_unique_id ?>)</span></option><?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bm_cat_id">انتخاب میز</label>
                                <select name="ord_desk_id" id="ord_desk_id" class="form-control">
                                    <option>انتخاب کنید</option>
                                    <?php foreach ($desks as $desk): ?>
                                        <option value="<?= $desk->desk_id ?>"><?= $desk->desk_name . ' (' . $desk->desk_capacity . ')' ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاریخ</label>
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                                    <input type="hidden" id="dateAlt" name="ord_date" class="form-control pull-right" style="z-index: 0;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>زمان</label>
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa ion-clock fa-lg"></i></div>
                                    <input type="text" id="time" class="form-control pull-right" style="z-index: 0;" readonly>
                                    <input type="hidden" id="timeAlt" name="ord_time" class="form-control pull-right" style="z-index: 0;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>هزینه کلی</label>
                                        <div class="input-group date">
                                            <input type="number" name="ord_price" type="text" class="form-control" id="total_amount" value="0" readonly />
                                            <div class="input-group-addon">افغانی</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>تخفیف </label>
                                        <select name="ord_discount" id="ord_discount" class="form-control" ord-price="">
                                            <option value="">انتخاب تخفیف</option>
                                            <?php foreach ($discounts as $discount) : ?>
                                                <option value="<?= $discount->disc_persent ?>"><?= $discount->disc_name ?>
                                                    (<?= round($discount->disc_persent) ?>%)
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ord_desc">توضیحات</label>
                                <textarea rows="5" class="form-control" name="ord_desc" id="ord_desc"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="row hidden">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>مقدار پرداختی</label>
                                <div class="input-group date">
                                    <input type="number" type="text" name="tr_amount" id="tr_amount" class="form-control" />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>باقیمانده</label>
                                <div class="input-group date">
                                    <input type="number" name="remain" id="remain" class="form-control" value="0" readonly />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="order_list" class="text-muted text-center well well-sm"><b>از لیست منو انتخاب نمائید.</b>
                    </div>
                    <div class="modal fade" id="orderModal">
                        <div class="modal-dialog modal-sm modal-warning" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title">لیست جزئیات سفارش</h5>
                            </div>
                            <div class="modal-body">
                                <div id="order_inputs"></div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-7">
                            <button type="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                            <button type="submit" name="submit_print" id="submit_print" class="btn btn-info">
                                <i class="fa fa-save"></i> ذخیره و چاپ <i class="fa fa-print"></i></button>
                            <!--                        <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>-->
                        </div>
                        <div class="col-xs-5">
                            <div class="form-group">
                                <div id="radios" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary btn-xs active">
                                        <input type="radio" name="pay_type" id="pay1" value="1" checked /> نقد
                                    </label>
                                    <label class="btn btn-primary btn-xs ">
                                        <input type="radio" name="pay_type" id="pay2" value="2"  /> قرض
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="create_account" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title no-margin">ثبت مشتری جدید</h4>
                </div>
                <form role="form" method="POST" action="<?= site_url('customer/ordering_insert'); ?>" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-xs-7">
                                        <div class="form-group">
                                            <label for="cus_name">نام مشتری</label>
                                            <input type="text" class="form-control" name="cus_name" id="cus_name" placeholder="نام" required />
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="form-group">
                                            <label for="cus_unique_id">کد اشتراک</label>
                                            <input type="text" class="form-control text-center" style="font-family: Segoe; background-color: #FFF9A8;" name="cus_unique_id" value="<?= $uniqee_id ?>" id="cus_unique_id" placeholder="کد منحصر به فرد برای مشتری" required readonly />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cus_lname">تخلص مشتری</label>
                                    <input type="text" class="form-control" name="cus_lname" id="cus_lname" placeholder="تخلص" required />
                                </div>

                                <div class="form-group">
                                    <label for="cus_phones">شماره تماس</label>
                                    <input type="text" class="form-control" name="cus_phones" id="cus_phones" placeholder="شماره تماس: 0777181828#0785555555" required />
                                </div>

                                <div class="form-group">
                                    <label for="cus_picture">عکس</label>
                                    <input type="file" name="cus_picture" id="cus_picture" />
                                    <p class="small">حجم فایل باید کمتر از 250 کیلوبایت و ابعاد آن از 400 پیکسل کوچکتر
                                        باشد.</p>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>تاریخ ثبت</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="tarikh_acc" class="form-control pull-right" style="z-index: 0;" readonly>
                                        <input type="hidden" id="tarikh_accAlt" name="cus_join_date" class="form-control pull-right" style="z-index: 0;">
                                    </div>
                                    <!-- /.input group -->

                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="cus_address">آدرس کامل مشتری</label>
                                            <textarea class="form-control" rows="5" name="cus_address" id="cus_address" placeholder="آدرس دقیق و کامل مشتری: ولایت - ولسوالی - ناحیه - منطقه - سرک - کوچه" required /></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label for="cus_phone">جنسیت: </label> &nbsp;
                                            <div id="radios" class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-primary active">
                                                    <input type="radio" name="cus_gendar" id="cus_gendar1" value="1" checked />
                                                    ذکور
                                                </label>
                                                <label class="btn btn-primary ">
                                                    <input type="radio" name="cus_gendar" id="cus_gendar2" value="0" />
                                                    اناث
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12 text-right">
                                            <label for="cus_phone">مشتری برای: </label> &nbsp;
                                            <div id="radios" class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-warning active">
                                                    <input type="radio" name="cus_type" id="cus_type1" value="0" checked />
                                                    آشپزخانه
                                                </label>
                                                <label class="btn btn-warning ">
                                                    <input type="radio" name="cus_type" id="cus_type2" value="1" />
                                                    رستورانت
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!--div.col-6-->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">بستن
                            <i class="fa fa-close"></i></button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="col-sm-7">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست منو های رستورانت </h3>
                <div class="box-tools pull-right">
                    <select name="menu_category" id="menu_category" class="form-control input-sm" style="border-radius: 3px; box-shadow: inset 0 0 6px 0px #616161;">
                        <option value="0">انتخاب نوعیت منو</option>
                        <?php foreach ($menu_categories as $menu_category): ?>
                            <option value="<?= $menu_category->mc_id ?>"><?= $menu_category->mc_name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="selection-msg" class="well text-warning well-sm text-center"><p>
                        <i class="ion ion-clipboard " style="font-size: 35px"></i></p>لطفاً یکی از نوعیت منو را انتخاب
                    کنید.
                </div>
                <div class="msg" hidden><?= alert("برای این نوع منو زیر منوئی ثبت نشده است.", 'warning'); ?></div>
                <ul class="users-list clearfix" id="menu_list"></ul>
            </div>
            <!-- /.box-body -->
            <div class="overlay" id="overlay" style="display: none;">
                <i class="fa ion-load-d fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.select2').select2();

        $('#tr_amount').keyup(function (event) {
            var ord_price = $('#total_amount').val();
            var tr_amount = $(this).val();
            var remain = parseFloat(ord_price) - parseFloat(tr_amount);
            $('#remain').val(remain);
        });

        $('#menu_category').change(function (event) {
            // alert($('#menu_category :selected').text());
            var mc_id = $('#menu_category :selected').val();
            var urls = '<?php echo base_url() . 'order/jq_menu_list/' ?>' + mc_id;

            $(document).ajaxStart(function () {
                $(".overlay").css('display', 'block');
            });
            $.ajax({
                type: "POST",
                url: urls,
                dataType: "html",
                success: function (response) {
                    $("#menu_list").html(response);
                    $('.msg').attr('hidden', true);

                    // btn add(+) is clicked
                    $('.btn_add').click(function (event) {
                        var id = $(this).attr('bm-id');
                        var price = $(this).attr('bm-price');
                        var pic = $(this).attr('menu-pic');
                        var bm_unit_id = $(this).attr('bm-unit-id');
                        var bm_name = $(this).attr('bm-name');

                        // create input or sum input value
                        if ($("#order_" + id).length) {
                            // alert('order_'+id);
                            var value = $("#order_" + id).val();
                            var new_val = parseInt(value) + 1;
                            $("#order_" + id).val(new_val);
                            $('#count_' + id).html(new_val);

                            var v_count = $('#order_' + id).val();
                            var v_price = $('#price_' + id).val();

                            var sord_total = v_count * v_price;
                            var total = 1 * v_price;
                            var curr_total = $('#total_amount').val();
                            // alert(curr_total);

                            total = total + parseFloat(curr_total);
                            $('#sord_price_' + id).val(sord_total);
                            $('#total_amount').val(total);
                            $('#ord_discount').attr('ord-price', total); //
                        }
                        else 
                        {
                            $('#order_inputs').append('<input type="text" name="bm_name[]" value="' + bm_name + '" id="bm_name_' + id + '" class="form-control col-xs-8" /><div class="clear-fix">');
                            $('#order_inputs').append('<input type="text" name="sord_count[]" id="order_' + id + '" value="1" class="form-control col-xs-4"/>');
                            $('#order_inputs').append('<input type="hidden" name="sord_bm_id[]" value="' + id + '" id="id_' + id + '" />');
                            $('#order_inputs').append('<input type="hidden" name="sord_price[]" value="0" id="sord_price_' + id + '" />');
                            $('#order_inputs').append('<input type="hidden" name="bm_price[]" value="' + price + '" id="price_' + id + '" />');
                            $('#order_inputs').append('<input type="hidden" name="bm_unit_id[]" value="' + bm_unit_id + '" id="bm_unit_id_' + id + '" />');
                            $('#order_list').append('<a href="" class="btn-app" style="border: 0; background: none;"><span class="badge bg-green" id="count_' + id + '">1</span><img width="40" id="pic_' + id + '" class="img-thumbnail" src="<?php echo site_url() . 'assets/img/menus/' ?>' + pic + ' " alt=""></a>');
                            $('#order_list>b').remove();

                            var v_count = $('#order_' + id).val();
                            var v_price = $('#price_' + id).val();

                            var curr_total = $('#total_amount').val();
                            // alert(curr_total);
                            var total = v_count * v_price;
                            var sord_total = v_count * v_price;
                            total = parseFloat(total) + parseFloat(curr_total);
                            $('#sord_price_' + id).val(sord_total);
                            $('#total_amount').val(total);
                        }

                    });

                    // btn minus(-) is clicked
                    $('.btn_minus').click(function (event) {
                        var id = $(this).attr('bm-id');
                        var price = $(this).attr('bm-price');
                        var pic = $(this).attr('menu-pic');

                        if ($("#order_" + id).length) {
                            // alert('order_'+id);
                            var value = $("#order_" + id).val();
                            var new_val = parseInt(value) - 1;
                            $("#order_" + id).val(new_val);
                            $('#count_' + id).html(new_val);

                            var v_count = $('#order_' + id).val();
                            var v_price = $('#price_' + id).val();

                            var sord_total = $('#sord_price_' + id).val() - v_price;
                            var total = $('#total_amount').val() - v_price;
                            var curr_total = $('#total_amount').val();
                            // alert(curr_total);

                            $('#sord_price_' + id).val(sord_total);
                            $('#total_amount').val(total);
                            $('#ord_discount').attr('ord-price', total); //

                            if (new_val == 0) {
                                $("#order_" + id).remove();
                                $('#count_' + id).remove();
                                $('#price_' + id).remove();
                                $('#id_' + id).remove();
                                $('#pic_' + id).remove();
                                $('#sord_price_' + id).remove();
                                $('#bm_unit_id_' + id).remove();
                            }
                        }
                    });

                    // alert(response);
                    if (response == '') {
                        $('.msg').attr('hidden', false);
                    }
                }
            });
            $(document).ajaxStop(function () {
                $(".overlay").css('display', 'none');
                $('#selection-msg').attr('hidden', true);
            });

        });

        $('#ord_discount').change(function () {
            var ord_discount = $('#ord_discount :selected').val();
            var ord_price = $('#ord_discount').attr('ord-price');
            var discount = ord_discount / 100 * ord_price;
            ord_price = ord_price - discount;
            $('#total_amount').val(ord_price);
            $('#menu_list').html('');
            $('#selection-msg').attr('hidden', false);
            $('#menu_category').attr('disabled', true);
        });

        // date
        $('#tarikh').persianDatepicker({
            altField: '#dateAlt',
            format: 'D MMMM YYYY',
            altFormat: 'YYYY-MM-DD',
            observer: true,
            position: [-67, 200],
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

        // time
        $('#time').persianDatepicker({
            altField: '#timeAlt',
            format: 'HH:mm',
            altFormat: 'HH:mm',
            observer: true,
            position: [-67, 200],
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
            onlyTimePicker: true
        });

        // account date
        $('#tarikh_acc').persianDatepicker({
            altField: '#tarikh_accAlt',
            format: 'D/MMMM/YYYY',
            observer: true,
            altFormat: 'YYYY-MM-DD',
            position: [-65,200],
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
    });

</script>