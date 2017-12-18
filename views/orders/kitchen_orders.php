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
            <thead class="bg-info">
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
                    <td><?=$order->cus_name ?> <?=$order->cus_lname ?></td>
                    <td><?=$order->cus_unique_id ?></td>
                    <td><span  data-toggle="tooltip" title="" data-original-title="Phone: <?=$order->cus_phones ?>"><?=current(explode('#', $order->cus_phones)) ?></span></td>
                    <td><?=show_date("l j F Y", $order->ord_date); ?> </td>
                    <td class="text-center"><strong><?=$order->ord_price ?></strong> افغانی</td>
                    <td><span data-toggle="tooltip" title="" data-original-title="<?=$order->ord_desc; ?>"><?=substr_fa($order->ord_desc, 30); ?></span></td>
                    <td>
                        <a href="<?=site_url('order/kitchen_payment/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" data-original-title="Payment"><i class="fa fa-money fa-lg"></i></span></a>
                        <a href="<?=site_url('order/stock_expences/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" data-original-title="Stock Expences for this Order"><i class="fa fa-shopping-cart fa-lg"></i></span></a>
                        <a href="#" class="sm_menu_list" data-toggle="modal" data-target="#modal-warning" id="<?php echo $order->ord_id; ?>" cus-id="<?php echo $order->cus_acc_id; ?>"><span class="label label-default" data-toggle="tooltip" data-original-title="Sub Menu list"><i class="fa ion-clipboard fa-lg"></i></span></a>
                        <a href="<?=site_url('order/edit_kitchen_order/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit fa-lg"></i></span></a>
                        <a href="#" class="ord_id_to_delete" id="<?php echo $order->ord_id; ?>" cus-id="<?php echo $order->cus_acc_id; ?>"><span class="label label-danger" data-toggle="tooltip" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
                    </td>
                    </tr>

                <?php endforeach ?>
            </tbody>
            <tfoot class="bg-info">
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



<div class="modal modal-warning fade" id="modal-warning">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">لیست زیر منوی سفارش</h4>
            </div>
            <div class="modal-body text-center" id="modal_here">
                <!-- Modal Here-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" id="close_me">بستن</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



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
                      $.post("<?php echo site_url('order/delete_kitchen_order'); ?>",{ord_id:ord_id, acc_id:acc_id},function(response){});
                    $(document).ajaxStop(function(){
                        $(".overlay").css('display','none');
                        $("tr#ord_"+ord_id).remove();
                        $(".msg").css('display','block');
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

    // Ganerate Data Table
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



    // jq show dynamicly order's sub menus
    $('.sm_menu_list').click(function(event) {
        var ord_id = $(this).attr('id');
        var urls = '<?php echo base_url().'order/jq_sub_menus/' ?>' + ord_id;

        $(document).ajaxStart(function(){
            $("#modal_here").html('<i class="fa ion-load-d fa-spin " style="text-align: center; font-size: 40px"></i>');
        });
        $.ajax({
            type: "POST",
            url: urls,
            dataType: "html",
            success: function(response){
                $("#modal_here").html(response);
            }
        });
        $(document).ajaxStop(function(){
            $(".overlay").css('display','none');
        });

    });

}); // end document


</script>




