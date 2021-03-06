<?php  $now = mds_date("Y/m/d", "now", 1);?>
<div class="nav-tabs-custom">
    <div class="pull-left box-tools" style="margin: 10px 0 0 10px">
        <a href="<?=site_url('order/create_resturant_order'); ?>" class="btn btn-success btn-sm"  data-toggle="tooltip" title="" data-original-title="New Order">
        <i class="fa fa-plus"></i></a>
    </div>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">سفارشات نقد</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">سفارش مشتریان</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
        

        <div class="box-body table-responsive">
            <?php if($this->session->form_success) {  alert($this->session->form_success,'success'); }  ?>
            <div class="msg" hidden><?php alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>

            <table id="example2" class="table table-bordered table-hover table-striped">
                <thead class="bg-info">
                    <tr>
                        <th>#</th>
                        <th>صندوق</th>
                        <th class="text-center">تاریخ سفارش</th>
                        <th class="text-center">ساعت</th>
                        <th class="text-center">هزینه کل</th>
                        <th class="text-center">تخفیف</th>
                        <th class="text-center">توضیحات</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($orders_base_acc as $order): ?>
                    <?php if (1 == 1): ?>
                    <tr id="ord_<?=$order->ord_id ?>">
                        <td><?=$i++;  ?></td>
                         <td><?=base_account()->acc_name  ?></td>
                        <td class="text-center"><?=show_date("j F Y", $order->ord_date); ?> </td>
                        <td class="text-center"><?=$order->ord_time; ?> </td>
                        <td class="text-center"><strong><?=number_format($order->ord_price + $order->ord_ext_charges) ?></strong> افغانی</td>
                        <td class="text-center"><span class="badge bg-green"><?=round($order->ord_discount,1) ?> %</span></td>
                        <td><span data-toggle="tooltip" data-original-title="<?=$order->ord_desc; ?>"><?=substr_fa($order->ord_desc, 30); ?></span></td>
                        <td class="text-center">
                            <a class="read-only-garson" href="<?=site_url('order/resturant_payment/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Payment"><i class="fa fa-money fa-lg"></i></span></a>
                            <a class='<?php echo ($now >= show_date("Y/m/d", $order->ord_date) AND $this->session->user_info->user_type != 1) ? "lock" : "" ?>' href="<?=site_url('order/sub_orders/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Order's Items"><i class="fa fa-list fa-lg"></i></span></a>
                            <a target="_blank" href="<?= site_url('order/print_resturant_order/'.$order->ord_id.'/no_customer') ; ?>"><span class="label label-default" data-toggle="tooltip" data-original-title="Print Bill"><i class="fa fa-print fa-lg"></i></span></a>
                            <a href="delete_kitchen_order/<?php echo $order->ord_id; ?>/<?php echo base_account()->acc_id; ?>/<?php echo $order->ord_price; ?>/resturant_orders" class="" id="" ><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
<!--                            <a href="#" class="ord_id_to_delete only-admin" id="--><?php //echo $order->ord_id; ?><!--" ><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>-->
                        </td>
                    </tr>
                    <?php endif ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="overlay" id="overlay" style="display: none;">
            <i class="fa ion-load-d fa-spin"></i>
        </div>
        </div>

        <div class="tab-pane" id="tab_2">

        <div class="box-body table-responsive">
            <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
            <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>

            <table id="example1" class="table table-bordered table-hover table-striped">
                <thead class="bg-info">
                    <tr>
                        <th>#</th>
                        <th>نام و تخلص</th>
                        <th>کد اشتراک</th>
                        <th>شماره تماس</th>
                        <th>تاریخ سفارش</th>
                        <th>ساعت</th>
                        <th>هزینه کل</th>
                        <th>تخفیف</th>
                        <th>پرداخت شده</th>
                        <th>باقی مانده</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($orders as $order): ?>
                    <?php if ($order->ord_cus_id != base_account()->acc_id): ?>
                    <tr id="ord_<?=$order->ord_id ?>">
                        <td><?=$i++;  ?></td>
                        <td><?=$order->cus_name ?> <?=$order->cus_lname ?></td>
                        <td><?=$order->cus_unique_id ?></td>
                        <td><span  data-toggle="tooltip" data-original-title="Phone: <?=$order->cus_phones ?>"><?=current(explode('-',$order->cus_phones)) ?></span></td>
                        <td><?=show_date("j F Y", $order->ord_date); ?> </td>
                        <td><?=$order->ord_time; ?> </td>
                        <td class="text-center"><strong><?=number_format($order->ord_price + $order->ord_ext_charges) ?></strong> افغانی</td>
                        <td class="text-center"><span class="badge bg-green"><?=round($order->ord_discount,1) ?> %</span></td>
                        <td class="text-center text-success"><strong><?=number_format($total_payed = $this->order_model->get_order_sum($order->ord_id)->total_payed ) ?></strong> افغانی</td>
                        <td class="text-center text-danger"><strong><?=number_format($order->ord_price + $order->ord_ext_charges - $total_payed ) ?></strong> افغانی</td>
                        <td>
                            <a class="read-only-garson" href="<?=site_url('order/resturant_payment/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Payment"><i class="fa fa-money fa-lg"></i></span></a>
                            <a class='<?php echo ($now >= show_date("Y/m/d", $order->ord_date) AND $this->session->user_info->user_type != 1) ? "lock" : "" ?>' href="<?=site_url('order/sub_orders/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Order's Items"><i class="fa fa-list fa-lg"></i></span></a>
                            <a target="_blank" href="<?=site_url('order/print_resturant_order/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" data-original-title="Print Bill"><i class="fa fa-print fa-lg"></i></span></a>
                            <a href="<?=site_url('order/add_item/'.$order->ord_id); ?>"><span class="label label-success" data-toggle="tooltip" title="" data-original-title="Add Item"><i class="fa ion-plus-round fa-lg"></i></span></a>
                            <a href="#"  class="ord_id_to_delete only-admin hidden" id="<?php echo $order->ord_id; ?>" ><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
                            <a href="delete_kitchen_order/<?php echo $order->ord_id; ?>/<?php echo $order->cus_acc_id; ?>/<?php echo $order->ord_price; ?>/resturant_orders" class="" id="" ><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
                        </td>
                    </tr>
                    <?php endif ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    // delete order
    $('.ord_id_to_delete').confirm({
        title: 'حذف',
        content: 'آیا با حذف این سفارش موافق هستید؟',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var ord_id = this.$target.attr('id');
                    var acc_id = this.$target.attr('cus-id');
                    $(document).ajaxStart(function(){
                    $(".overlay").css('display','block');
                    });
                      $.post("<?php echo site_url('order/delete_kitchen_order'); ?>",{ord_id:ord_id, acc_id:acc_id, },function(response){

                      });
                    $(document).ajaxStop(function(){
                        $(".overlay").css('display','none');
                        $(".msg").css('display','block');
                        $("tr#ord_"+ord_id).remove();
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




$(function () {
    $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
    })
});

$(function () {
    $('#example1').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
    })
});

</script>