<?php
/**
 * Created by PhpStorm.
 * User: Eng-Elmi
 * Date: 14/12/2017
 * Time: 11:09 PM
 */
?>
<style>
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        padding: 4px;
    }
</style>
<div class="box box-warning ">
    <div class="box-header with-border no-print">
        <h3 class="box-title"> فاکتور آشپزخانه</h3>
        <div class="box-tools pull-right no-print">
            <a href="<?=site_url('order/print_kitchen_order/'.$ord_cus->ord_id) ?>" target="_blank" type="button" class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Print">
                <i class="fa fa-print fa-lg"></i>
            </a>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php $this->load->view('layout/bill_header'); ?>

        <div class="well well-sm" style="margin-bottom: 5px; padding:4px">
            <div class="row">
                <div class="col-xs-5"><b>نام مشتری: </b> <?= $ord_cus->cus_name . ' ' . $ord_cus->cus_lname ?></div>
                <div class="col-xs-4"><b>شماره تماس:</b> <?= current(explode('-', $ord_cus->cus_phones)) ?></div>
                <div class="col-xs-3"><b>کد اشتراک:</b> <?= $ord_cus->cus_unique_id ?></div>
            </div>
        </div>
        <div class="well well-sm" style="margin-bottom: 5px; padding:4px">
            <div class="row">
                <div class="col-xs-5"><b>تاریخ ثبت: </b> <?= show_date("j F Y", $ord_cus->ord_created_date) ?></div>
                <div class="col-xs-4"><b>تاریخ تحویل غذا:</b> <?= show_date("j F Y", $ord_cus->ord_date) ?></div>
                <div class="col-xs-3"><b>ساعت:</b> <?= $ord_cus->ord_time ?></div>
            </div>
        </div>
        <div class="well well-sm" style="margin-bottom: 5px; padding:4px">
            <div class="row">
                <div class="col-xs-12"><b>آدرس: </b> <?= $ord_cus->cus_address ?></div>
            </div>
        </div>

        <?php $total_payed = 0;
        foreach ($ord_transections as $transection) : ?>
            <?php $total_payed += $transection->tr_amount ?>
        <?php endforeach ?>


        <table class="table table-border table-striped">
            <tbody>
            <tr class="bg-gray">
                <th style="width: 8px">شماره</th>
                <th>نوع غــذا</th>
                <th>تعداد</th>
                <th>واحد</th>
                <th>فیات</th>
                <th>مجموع</th>
            </tr>
            <?php $i = 1;
            $rows = 15;
            foreach ($sub_menus as $sm) : ?>
                <tr>
                    <td class="bg-gray text-center"><strong><?= $i++;
                        $rows--; ?></strong></td>
                    <td><?= $sm->sm_name ?></td>
                    <td><?= ($sm->sm_count * $sm->sord_count) ?></td>
                    <td><?= $sm->unit_name ?></td>
                    <td><?= round($sm->sm_price,1) ?> افغانی</td>
                    <td><?= $sm->sm_price * $sm->sord_count ?> افغانی</td>
                </tr>
            <?php endforeach ?>
            <?php for ($l = 0; $l < $rows; $l++): ?>
                <tr>
                    <td class="bg-gray text-center"><strong><?= $i++; ?></strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            <?php endfor; ?>
            <?php $total_unpayed = $ord_cus->ord_price - $total_payed ?>
            <tr>
                <td colspan="2" rowspan="2"><b>قیمت مجموع به حروف</b></td>
                <td colspan="2" rowspan="2"><strong> </strong> افغانی</td>
                <td><b>قیمت مجموعی</b></td>
                <td><b><?= round($ord_cus->ord_price,1) ?></b> افغانی</td>
            </tr>
            <tr>
                <td><b>تخفیف</b></td>
                <td>
                    <b><?php $ord_discount = 100 - $ord_cus->ord_discount; ?> <?= round($ord_cus->ord_price * 100 / $ord_discount) - $ord_cus->ord_price; ?></b>
                    افغانی (<?= round($ord_cus->ord_discount) ?>%)
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong>امضاء فروشنده:</strong></td>
                <td colspan="2"><strong>امضاء مشتری:</strong></td>
                <td class="bg-success text-success"><b>رسیده</b></td>
                <td><b><?= $total_payed ?></b> افغانی</td>
            </tr>
            <tr>
                <td colspan="2"><b>شماره های تماس</b></td>
                <td colspan="2" class="text-center"><?= $this->session->general_info->ci_phones ?></td>
                <td class="bg-danger text-danger"><b>الباقی</b></td>
                <td><b><?= $total_unpayed ?></b> افغانی</td>
            </tr>
            <tr style="font-size: 13px">
                <td colspan="3"><b>آدرس:</b> <?= $this->session->general_info->ci_address ?></td>
                <td colspan="3" class="text-center">
                    <b><span><?= $this->session->general_info->ci_emails ?></span> <i class="ion-ios-email fa-lg"></i></b>
                    <b><span><?= $this->session->general_info->ci_website ?></span> <i class="ion-android-globe fa-lg"></i></b>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
    <!-- /.box-body -->
</div>
