<?php //print_r( (is_array($customer)) ? ($customer) :  'Not array' ); ?>

<?php
$total = 0;
foreach ($transections as $trans) {
    $total += $trans->tr_amount;
}
$final_total = $order->ord_price-$total;
 ?>
<div class="row">
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">پرداخت باقیمانده حساب</h3>
                <div class="box-tools pull-right">
                    <a href="<?=site_url('order/resturant_orders'); ?>" class="btn btn-box-tool bg-gray"  data-toggle="tooltip" title="" data-original-title="Order List"><i class="fa fa-list-ul fa-lg"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('order/insert_resturant_payment/'); ?>">

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
                    <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'warning'); }  ?>

                    <div class="form-group">
                        <label>تاریخ</label>
                        <div class="input-group date">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" id="tarikh"  class="form-control pull-right" style="z-index: 0;" readonly>
                            <input type="hidden" id="dateAlt"  name="tr_date" class="form-control pull-right" style="z-index: 0;" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>پرداخت شده</label>
                                <div class="input-group date">
                                    <input type="number" value="<?=$total ?>" id="payed" class="form-control" readonly />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>مجموع باقیمانده</label>
                                <div class="input-group date">
                                    <input type="text" id="unpayed" value="<?=$final_total ?>" class="form-control" readonly/>
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>مقدار پرداختی</label>
                        <div class="input-group date">
                            <input type="text" id="tr_amount" name="tr_amount" class="form-control" />
                            <div class="input-group-addon">افغانی</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tr_desc">توضیحات</label>
                        <textarea rows="5" class="form-control" name="tr_desc" id="tr_desc"></textarea>
                    </div>

                    <div class="">
                        <input type="hidden" value="<?=(is_array($customer)) ? ($customer['cus_acc_id']) :  $customer->cus_acc_id ; ?>" name="tr_acc_id" id="acc_id">
                        <input type="hidden" value="<?=$order->ord_id ?>" name="tr_ord_id" id="ord_id">
                        <!-- <input type="hidden"  name="sord_id" id="sord_id"> -->
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-success" >ذخیره <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>




<div class="col-md-7">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">لیست پرداخت برای سفارش <?=(is_array($customer)) ? ($customer['cus_name']) :  $customer->cus_name.' '.$customer->cus_lname ; ?> </h3>
            </div>
            <!-- /.box-header -->
                <div class="box-body ">
                    <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>

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
                        <?php $i=1; foreach ($transections as $transection): ?>
                            <tr id="tr_<?=$transection->tr_id ?>">
                                <td><?=$i++ ?></td>
                                <td><?=$transection->tr_desc ?></td>
                                <td><?=$transection->tr_amount ?> افغانی</td>
                                <td><?=show_date("l j F Y", $transection->tr_date); ?></td>
                                <td><span class="badge bg-gray">پرداخت سفارش</span></td>
                                <td class="text-center"><a href="#" class="trans_id_to_delete" id="<?php echo $transection->tr_id; ?>" cus-id="<?php echo $transection->tr_acc_id; ?>"><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a></td>
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
$(document).ready(function() {

    var unpayed = $('#unpayed').val();
    var payed = $('#payed').val();

    $('#tr_amount').keyup(function(event) {
        var tr_amount = $(this).val();
        sum = 0;
        minus = 0;
        var sum = parseFloat(tr_amount) + parseFloat(payed) ;
        var minus = parseFloat(unpayed) - parseFloat(tr_amount);

        $('#unpayed').val(minus);
        $('#payed').val(sum);


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
                    $(document).ajaxStart(function(){
                    $(".overlay").css('display','block');
                    });
                      $.post("<?php echo site_url('order/delete_kitchen_transection'); ?>",{tr_id:tr_id, tr_acc_id:tr_acc_id},function(response){

                      });
                    $(document).ajaxStop(function(){
                        $(".overlay").css('display','none');
                        $(".msg").css('display','block');
                        $("tr#tr_"+tr_id).remove();
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
        },
    });


});

</script>