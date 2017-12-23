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
<div class="row">
    <div class="col-xs-4">
        <div class="box box-warning " style="width: 400px">
            <div class="box-header with-border no-print">
                <h3 class="box-title"> فاکتور آشپزخانه</h3>
                <div class="box-tools pull-right no-print">
                    <a href="<?= site_url('order/print_resturant_order/' . $ord_cus->ord_id) ?>" target="_blank" type="button" class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Print">
                        <i class="fa fa-print fa-lg"></i>
                    </a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-xs-12 well well-sm no-shadow text-center" style="margin-bottom: 5px;">
                    <div class="row">

                        <div class="col-xs-8">
                            <p style="margin-bottom: 4px"><b><?= $this->session->general_info->ci_full_name ?></b></p>
                            <p style="margin: 4px"><b><?= $this->session->general_info->ci_full_name_en ?></b></p>
                            <p class="text-sm" style="margin: 0">نمبر بل: <?= $ord_cus->ord_id ?></p>
                        </div>
                        <div class="col-xs-4">
                            <img src="<?= base_url('assets/img/info/' . $this->session->general_info->ci_logo) ?>" class="img-responsive" alt="LOGO">
                        </div>
                    </div>
                </div>
                <?php //$this->load->view('layout/bill_header'); ?>

                <div class="well well-sm" style="margin-bottom: 5px; padding:4px">
                    <div class="row">
                        <div class="col-xs-6"><b>تاریخ:</b> <?= show_date("j F Y", $ord_cus->ord_date) ?>
                        </div>
                        <div class="col-xs-6"><b>ساعت:</b> <?= $ord_cus->ord_time ?></div>
                    </div>
                </div>
                <div class="well well-sm" style="margin-bottom: 5px; padding:4px">
                    <div class="row">
                        <div class="col-xs-6"><b>نام مشتری: </b> <?= $ord_cus->cus_name . ' ' . $ord_cus->cus_lname ?>
                        </div>

                        <div class="col-xs-6"><b>کد اشتراک:</b> <?= $ord_cus->cus_unique_id ?></div>
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
                        <th style="width: 8px">#</th>
                        <th>نوع غــذا</th>
                        <th>تعداد</th>
                        <th>فیات</th>
                        <th>مجموع</th>
                    </tr>
                    <?php $i = 1;

                    foreach ($sub_menus as $sm) : ?>
                        <tr>
                            <td class="bg-gray text-center"><strong><?= $i++; ?></strong></td>
                            <td><?= $sm->bm_name ?></td>
                            <td><?= ($sm->sord_count) ?> <?= $sm->unit_name ?></td>
                            <td><?= round($sm->bm_price, 1) ?> افغانی</td>
                            <td><?= $sm->bm_price * $sm->sord_count ?> افغانی</td>
                        </tr>
                    <?php endforeach ?>

                    <?php $total_unpayed = $ord_cus->ord_price - $total_payed ?>
                    <tr>
                        <th colspan="3">قیمت مجموعی</th>
                        <td colspan="2"><b><?= round($ord_cus->ord_price, 1) ?></b> افغانی</td>
                    </tr>
                    <tr>
                        <th colspan="3">تخفیف</th>
                        <td colspan="2"><b><?php $ord_discount = 100 - $ord_cus->ord_discount; ?> <?= round($ord_cus->ord_price * 100 / $ord_discount) - $ord_cus->ord_price; ?></b> افغانی (<?= round($ord_cus->ord_discount) ?>%)</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="bg-success text-success"><b>رسیده</b></td>
                        <td colspan="2"><b><?= $total_payed ?></b> افغانی</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="bg-danger text-danger"><b>الباقی</b></td>
                        <td colspan="2"><b><?= $total_unpayed ?></b> افغانی</td>
                    </tr>
                    <tr style="font-size: 13px">
                        <td colspan="5"><b>آدرس:</b> <?= $this->session->general_info->ci_address ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center">  <?= $this->session->general_info->ci_phones ?> <i class="fa fa-phone-square fa-lg"></i> </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center">
                            <b><span><?= $this->session->general_info->ci_emails ?></span></b>
                            <b><span><?= $this->session->general_info->ci_website ?></span></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><p class="text-sm">مشتری گرامی افتخار ما رضایت شماست. رضایت شما اعتبار
                                ماست.</p></td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
