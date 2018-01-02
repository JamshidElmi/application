<?php //print_r( (is_array($customer)) ? ($customer) :  'Not array' ); ?>

<?php
$total = 0;
foreach ($transections as $trans) {
    $total += $trans->tr_amount;
}
$final_total = $order->ord_price - $total;
?>
<div class="row">
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">پرداخت باقیمانده حساب</h3>
                <div class="box-tools pull-right">
                    <a href="<?= site_url('order/resturant_orders'); ?>" class="btn btn-box-tool bg-gray" data-toggle="tooltip" title="" data-original-title="Order List"><i class="fa fa-list-ul fa-lg"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="myform" method="POST" action="<?= site_url('order/insert_resturant_payment/'); ?>">

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

                    <div class="form-group">
                        <label>تاریخ</label>
                        <div class="input-group date">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                            <input type="hidden" id="dateAlt" name="tr_date" class="form-control pull-right" style="z-index: 0;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>پرداخت شده</label>
                                <div class="input-group date">
                                    <input type="number" value="<?= $total ?>" id="payed" class="form-control" readonly />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>مجموع باقیمانده</label>
                                <div class="input-group date">
                                    <input type="text" id="unpayed" value="<?= $final_total ?>" class="form-control" readonly />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>مقدار پرداختی</label>
                                <div class="input-group date">
                                    <input type="number" id="tr_amount" step="0.1" name="tr_amount" class="form-control" />
                                    <div class="input-group-addon" id="total_price"><?php $ord_discount = 100 - $order->ord_discount;
                                        echo round($order->ord_price * 100 / $ord_discount); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>تخفیف </label>
                                <select name="ord_discount" id="ord_discount" class="form-control" ord-price="">
                                    <option value="0">انتخاب تخفیف</option>
                                    <?php foreach ($discounts as $discount) : ?>
                                        <option <?= ($order->ord_discount == $discount->disc_persent) ? 'selected' : '' ?> value="<?= $discount->disc_persent ?>"><?= $discount->disc_name ?>
                                            (<?= round($discount->disc_persent) ?>%)
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="tr_desc">توضیحات</label>
                        <textarea rows="5" class="form-control" name="tr_desc" id="tr_desc"></textarea>
                    </div>

                    <div class="">
                        <input type="hidden" value="<?= (is_array($customer)) ? ($customer['cus_acc_id']) : $customer->cus_acc_id; ?>" name="tr_acc_id" id="acc_id">
                        <input type="hidden" value="<?= $order->ord_id ?>" name="tr_ord_id" id="ord_id">
                        <!-- <input type="hidden"  name="sord_id" id="sord_id"> -->
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>


    <div class="col-md-7">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">لیست پرداخت برای
                    سفارش <?= (is_array($customer)) ? ($customer['cus_name']) : $customer->cus_name . ' ' . $customer->cus_lname; ?> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <div class="msg" hidden><?= alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>

                <table class="table table-hover table-bordered table-warning">
                    <thead>
                    <tr class="bg-blue">
                        <th>#</th>
                        <th>توضیحات</th>
                        <th>مقدار پرداخت</th>
                        <th class="text-center">تاریخ</th>
                        <th>نوعیت پرداخت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    foreach ($transections as $transection): ?>
                        <tr id="tr_<?= $transection->tr_id ?>">
                            <td><?= $i++ ?></td>
                            <td>
                                <span data-toggle="tooltip" data-original-title="<?= $transection->tr_desc ?>"><?= substr_fa($transection->tr_desc, 20) ?></span>
                            </td>
                            <td><strong><?= $transection->tr_amount ?></strong>  افغانی</td>
                            <td class="text-center"><?= show_date("j F Y", $transection->tr_date); ?></td>
                            <td class="text-center"><span class="badge bg-gray"> سفارش</span></td>
                            <td class="text-center">
                                <a href="#" class="trans_id_to_delete read-only" id="<?php echo $transection->tr_id; ?>" cus-id="<?php echo $transection->tr_acc_id; ?>"><span class="label label-danger" data-toggle="tooltip" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
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
<!-- /.row -->


<script>
    $(document).ready(function () {

        var unpayed = $('#unpayed').val();
        var payed = $('#payed').val();

        $('#tr_amount').keyup(function (event) {
            var tr_amount = $(this).val();
            sum = 0;
            minus = 0;
            var sum = parseFloat(tr_amount) + parseFloat(payed);
            var minus = parseFloat(unpayed) - parseFloat(tr_amount);

            $('#unpayed').val(minus);
            $('#payed').val(sum);


        });

        $('#ord_discount').change(function () {
            var ord_discount = $('#ord_discount :selected').val();
            var total_amount = parseInt($('#total_price').text());
            var discount = ord_discount / 100 * total_amount;
            var ord_price = total_amount - discount;
            // alert(ord_price);
            $('#unpayed').val(ord_price - $('#payed').val());
            $('#myform').append('<input type="hidden" name="ord_price" id="ord_price" value="' + ord_price + '" placeholder="ord_price">');
            // $('#ord_price').val(ord_price);

            var unpayed = $('#unpayed').val();
            var payed = $('#payed').val();
            $('#tr_amount').keyup(function (event) {
                var tr_amount = $(this).val();
                sum = 0;
                minus = 0;
                var sum = parseFloat(tr_amount) + parseFloat(payed);
                var minus = parseFloat(unpayed) - parseFloat(tr_amount);

                $('#unpayed').val(minus);
                $('#payed').val(sum);


            });
        });


        // delete payment
        $('.trans_id_to_delete').confirm({
            title: 'حذف',
            content: 'آیا با حذف این پرداخت سفارش موافق هستید؟',
            type: 'red',
            rtl: true,
            buttons: {
                confirm: {
                    text: 'تایید',
                    btnClass: 'btn-red',
                    action: function () {
                        var tr_id = this.$target.attr('id');
                        var tr_acc_id = this.$target.attr('cus-id');
                        $(document).ajaxStart(function () {
                            $(".overlay").css('display', 'block');
                        });
                        $.post("<?php echo site_url('order/delete_kitchen_transection'); ?>", {
                            tr_id: tr_id,
                            tr_acc_id: tr_acc_id
                        }, function (response) {

                        });
                        $(document).ajaxStop(function () {
                            $(".overlay").css('display', 'none');
                            $(".msg").css('display', 'block');
                            $("tr#tr_" + tr_id).remove();
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

        // date
        $('#tarikh').persianDatepicker({
            altField: '#dateAlt',
            format: 'D MMMM YYYY',
            observer: true,

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
            },
        });


    });

</script>