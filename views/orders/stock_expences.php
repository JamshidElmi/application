<?php
/**
 * Created by PhpStorm.
 * User: Eng-Elmi
 * Date: 04/12/2017
 * Time: 02:27 PM
 */
?>
<div class="col-sm-12">
    <div class="box box-info box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">    لیست مصارف سفارش    <?=$order->cus_name.' '.$order->cus_lname ?> <span class="label label-default"><?=show_date("l j F Y", $order->ord_date); ?></span></h3>
            <div class="box-tools pull-right">
                <a href="<?=site_url('menu/kitchen_menus'); ?>" class="btn btn-box-tool"  data-toggle="tooltip" title="" data-original-title="Add or Edit  Menu"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>

            <table id="example2" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام جنس</th>
                    <th class="text-center">تعداد</th>
                    <th class="text-center"> قیمت فی واحد</th>
                    <th class="text-center">قیمت کلی</th>
                    <th class="text-center">عملیات</th>
                </tr>
                </thead>
                <tbody>
                <?php $sum_total=0; $i = 1; foreach ($stocks as $stock): ?>
                    <tr id="stock_<?=$stock->stock_id ?>">
                        <td><?=$i++;  ?></td>
                        <td><?=$stock->st_name ?></td>
                        <td><b><?=$stock->stock_count?> </b> <?=$stock->unit_name ?> </td>
                        <td><b><?=$stock->st_price ?></b> افغانی </td>
                        <td class="text-center"><b><?=$stock->stock_total_price ?></b> افغانی </td>
                        <td class="text-center">
                            <a href="#"><span class="label label-default select_order"  data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit fa-lg"></i></span></a>
                            <a href="#"><span class="label label-danger stock_id_to_delete" id="<?=$stock->stock_id ?>"  data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
                        </td>
                    </tr>
                <?php $sum_total += $stock->stock_total_price;  ?>
                <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>نام جنس</th>
                    <th class="text-center">تعداد</th>
                    <th class="text-center"> قیمت فی واحد</th>
                    <th class="text-center"><?=$sum_total ?>  افغانی</th>
                    <th class="text-center">عملیات</th>
                </tr>
                </tfoot>
            </table>

        </div>
        <div class="box-footer">
            <b><?=' مجموعه مصارف: '. $sum_total ?> </b> افغانی
        </div>
        <!-- /.box-body -->
        <div class="overlay" id="overlay" style="display: none;">
            <i class="fa ion-load-d fa-spin"></i>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        // delete order
        $('.stock_id_to_delete').confirm({
            title: 'حذف',
            content: 'آیا با حذف این مورد از مصرف موافق هستید؟',
            type: 'red',
            rtl: true,
            buttons: {
                confirm: {
                    text: 'تایید',
                    btnClass: 'btn-red',
                    action: function () {
                        var stock_id = this.$target.attr('id');
                        $(document).ajaxStart(function(){
                            $(".overlay").css('display','block');
                        });
                        $.post("<?php echo site_url('order/delete_expence_order'); ?>",{stock_id:stock_id},function(response){

                        });
                        $(document).ajaxStop(function(){
                            $(".overlay").css('display','none');
                            $(".msg").css('display','block');
                            $("tr#stock_"+stock_id).remove();
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
</script>
