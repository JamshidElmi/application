<div class="box">
    <div class="box-header">
        <h3 class="box-title">لیست سفارشات </h3>
        <div class="pull-left box-tools">
            <a href="<?=site_url('order/create_order'); ?>" class="btn btn-success btn-sm"  data-toggle="tooltip" title="" data-original-title="New Order">
            <i class="fa fa-plus"></i></a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
        <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
        <table id="example2" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام و تخلص</th>
                    <th>کد مشتری</th>
                    <th>شماره تماس</th>
                    <th>تاریخ سفارش</th>
                    <th>هزینه کل</th>
                    <th>توضیحات</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($orders as $order): ?>
                <tr id="ord_<?=$order->ord_id ?>">
                    <td><?=$i++;  ?></td>
                    <td><?=($order->ord_cus_id == base_account()->acc_id) ? 'پرداخت نقد' : '' ?></td>
                    <td></td>
                    <td><span  data-toggle="tooltip" title="" data-original-title="Phone: "></span></td>
                    <td><?=show_date("l j F Y", $order->ord_date); ?> </td>
                    <td class="text-center"><strong><?=$order->ord_price ?></strong> افغانی</td>
                    <td><?=$order->ord_desc ?></td>
                    <td>
                        <a href="<?=site_url('order/kitchen_payment/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Payment"><i class="fa fa-money fa-lg"></i></span></a>
                        <a href="<?=site_url('order/edit_kitchen_order/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit fa-lg"></i></span></a>
                        <a href="#" class="ord_id_to_delete" id="<?php echo $order->ord_id; ?>" cus-id="<?php //echo $order->cus_acc_id; ?>"><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>نام و تخلص</th>
                    <th>کد مشتری</th>
                    <th>شماره تماس</th>
                    <th>تاریخ سفارش</th>
                    <th>هزینه کل</th>
                    <th>توضیحات</th>
                    <th>عملیات</th>
                </tr>
            </tfoot>
        </table>

    </div>
    <!-- /.box-body -->
    <div class="overlay" id="overlay" style="display: none;">
        <i class="fa ion-load-d fa-spin"></i>
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
                      $.post("<?php echo site_url('order/delete_kitchen_order'); ?>",{ord_id:ord_id, acc_id:acc_id},function(response){

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
})

</script>