<?php
/**
 * Created by Eng-Elmi
 * User: Jamshid Elmi
 * Date: 1/7/2018
 * Time: 9:46 PM
 */
?>

<?php  $now = mds_date("Y/m/d", "now", 1);?>
<div class="box box-default">
    <div class="box-header">
        <div class="col-sm-12 visible-print">
            <h3 class="box-title">لیست معاشات پرداخت شده</h3>
        </div>
        <div class=" no-print">
            <div class="col-sm-4">
                <h3 class="box-title">لیست معاشات پرداخت شده</h3>
            </div>
            <form class="" action="<?=site_url('reports/reports/resturant_order_report_list');?>" method="POST" >
                <div class="col-sm-3">
                    <div class="form-group ">
                        <div class="input-group date">
                            <div class="input-group-addon">از</div>
                            <input type="text" id="tarikh1" class="form-control pull-right input-sm" style="z-index: 0;" readonly>
                            <input type="hidden" id="tarikh1Alt" name="tarikh1" class="form-control pull-right" style="z-index: 0;">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="input-group date">
                            <div class="input-group-addon">الی</div>
                            <input type="text" id="tarikh2" class="form-control pull-right input-sm" style="z-index: 0;" readonly>
                            <input type="hidden" id="tarikh2Alt" name="tarikh2" class="form-control pull-right" style="z-index: 0;">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary btn-sm">جستجو</button>
                </div>
                <div class="col-sm-1">
                    <?php if ($this->input->post('tarikh1')): ?>
                        <?php $last = $this->input->post('tarikh1') ?>
                        <?php $now  = $this->input->post('tarikh2') ?>
                        <?php $dates  = '/'.$last.'/'.$now ?>
                    <?php else: ?>
                        <?php $dates  = '' ?>
                    <?php endif ?>

                    <div class="pull-left box-tools no-print">
                        <a onclick="window.print()" target="_BLANK" class="btn btn-defualt btn-sm" data-toggle="tooltip" data-original-title="Print"> <i class="fa fa-print fa-lg"></i></a>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="box-body no-padding table-responsive vis-print">
        <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
        <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>

        <table id="example2" class="table table-bordered table-hover table-striped">
            <thead class="bg-info">
            <tr>
                <th>#</th>
                <th>نام و تخلص</th>
                <th>کد اشتراک</th>
                <th>میز</th>
                <th class="text-center">تاریخ سفارش</th>
                <th class="text-center">هزینه کل</th>
                <th class="text-center">تخفیف</th>
                <th>توضیحات</th>
                <th class="text-center no-print">عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($orders as $order): ?>
                    <tr id="ord_<?=$order->ord_id ?>">
                        <td><?=$i++;  ?></td>
                    <?php if ($order->ord_cus_id == base_account()->acc_id): ?>
                        <td><?=base_account()->acc_name  ?></td>
                        <td class="text-center"> - </td>
                    <?php else: ?>
                        <td><?=$order->cus_name.' '.$order->cus_lname  ?></td>
                        <td class="text-center"><?= $order->cus_unique_id ?></td>
                    <?php endif ?>
                        <td class="text-center"><?=$order->desk_name ?></td>
                        <td class="text-center"><?=show_date("l j F Y", $order->ord_date); ?> </td>
                        <td class="text-center"><strong><?=$order->ord_price ?></strong> افغانی</td>
                        <td class="text-center"><span class="badge bg-green"><?=round($order->ord_discount,1) ?> %</span></td>
                        <td><span data-toggle="tooltip" data-original-title="<?=$order->ord_desc; ?>"><?=substr_fa($order->ord_desc, 30); ?></span></td>
                        <td class="text-center no-print">
                            <a class="read-only-garson" href="<?=site_url('order/resturant_payment/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Payment"><i class="fa fa-money fa-lg"></i></span></a>
                            <a class='<?php echo ($now >= show_date("Y/m/d", $order->ord_date) AND $this->session->user_info->user_type != 1) ? "lock" : "" ?>' href="<?=site_url('order/sub_orders/'.$order->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Order's Items"><i class="fa fa-list fa-lg"></i></span></a>
                            <a href="<?=site_url('order/print_resturant_bill/'.$order->ord_id.'/no_customer'); ?>"><span class="label label-default" data-toggle="tooltip" data-original-title="Print Bill"><i class="fa fa-print fa-lg"></i></span></a>
                            <a href="#" class="ord_id_to_delete only-admin" id="<?php echo $order->ord_id; ?>" ><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
                        </td>
                    </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="overlay" id="overlay" style="display: none;">
        <i class="fa ion-load-d fa-spin"></i>
    </div>
</div>




<script>
// Year & Month Picker
$('#tarikh1').persianDatepicker({
    altField: '#tarikh1Alt',
    altFormat: 'YYYY-MM-DD',
    format: 'D/MMMM/YYYY',
    observer: true,
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

// Year & Month Picker
$('#tarikh2').persianDatepicker({
    altField: '#tarikh2Alt',
    altFormat: 'YYYY-MM-DD',
    format: 'D/MMMM/YYYY',
    observer: true,
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
</script>


