<?php
/**
 * Created by PhpStorm.
 * User: Eng-Elmi
 * Date: 14/12/2017
 * Time: 11:09 PM
 */
?>

<style>
    
    
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
    {
        padding:      3px;
        border-color: #000;
    }
    
    .table-border th, .table-border td, .table-border
    {
        border: 1px solid #000;
    }
    
    .well
    {
        border-color: black;
    }
</style>
<div class="row" style="font-family: arial;">
    <div class="col-xs-4" style="margin: 0;padding: 0;">
        <div class="box box-dafualt  " style="width: 72mm; font-size: 13px !important; border:1px solid black">
            <div class="box-header with-border no-print">
                <h3 class="box-title"> فاکتور رستورانت</h3>
                <div class="box-tools pull-right no-print">
                    <a href="<?= site_url('order/resturant_payment/' . $ord_cus->ord_id) ?>" type="button" class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Payment">
                        <i class="fa fa-money fa-lg"></i> </a>
                    <a href="<?= site_url('order/sub_orders/' . $ord_cus->ord_id) ?>" type="button" class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Order's List">
                        <i class="fa fa-list fa-lg"></i> </a>
                    <a href="<?= site_url('order/print_resturant_order/' . $ord_cus->ord_id . '/' . $this->uri->segment(4)) ?>" target="_blank" type="button" class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Print">
                        <i class="fa fa-print fa-lg"></i> </a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="col-xs-12 well well-sm no-shadow text-center" style="margin-bottom: 5px;">
                    <div class="row">
                        
                        <div class="col-xs-9">
                            <p style="margin-bottom: 4px;  font-size: 12px; font-family:BTitrBold,'BTitrBold', 'Vazir', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                                <b><?= $this->session->general_info->ci_full_name ?></b></p>
                            <p style="margin: 4px; font-size: 9px;">
                                <b><?= $this->session->general_info->ci_full_name_en ?></b></p>
                        </div>
                        <div class="col-xs-3">
                            <img style="margin:-5px 0 -10px 0" src="<?= base_url('assets/img/info/' . $this->session->general_info->ci_logo) ?>" class="img-responsive" alt="LOGO">
                        </div>
                    </div>
                </div>
                <?php //$this->load->view('layout/bill_header'); ?>
                
                <div class="well well-sm" style="margin-bottom: 5px; padding:4px;font-size:11px">
                    <div class="row">
                        <div class="col-xs-6"><b>تاریخ: <?= show_date("Y/m/j", $ord_cus->ord_date) ?> </b></div>
                        <div class="col-xs-6"><b>ساعت: <?= $ord_cus->ord_time ?></b></div>
                    </div>
                </div>
                
                <div class="well well-sm" style="margin-bottom: 5px; padding:4px;font-size:10px;font-size:11px">
                    <div class="row">
                        <div class="col-xs-6">
                            <b> نمبر بل :<?= $ord_cus->ord_id ?></b>
                        </div>
    
                        <div class="col-xs-6">
                            <b>میز: </b> <?= (isset($desk->desk_name)) ? $desk->desk_name  : ' - '; ?>
                        </div>
                    </div>
                </div>
              
                
                <?php if (isset($ord_cus->cus_name)): ?>
                    <div class="well well-sm" style="margin-bottom: 5px; padding:4px;font-size:11px">
                        <div class="row">
                            <div class="col-xs-7">
                                <b>نام مشتری: </b> <?= (isset($ord_cus->cus_name)) ? $ord_cus->cus_name . ' ' . $ord_cus->cus_lname : ''; ?>
                            </div>
                            
                            <div class="col-xs-5">
                                <b>کد اشتراک:</b> <?= (isset($ord_cus->cus_name)) ? $ord_cus->cus_unique_id : '' ?>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="well well-sm" style="margin-bottom: 5px; padding:4px">
                        <div class="row">
                            <div class="col-xs-12">
                                <b>آدرس: </b> <?= (isset($ord_cus->cus_name)) ? $ord_cus->cus_address : '' ?></div>
                        </div>
                    </div>
                <?php endif ?>
                
                <?php $total_payed = 0;
                foreach ($ord_transections as $transection) : ?>
                    <?php $total_payed += $transection->tr_amount ?>
                <?php endforeach ?>
                
                
                <table class="table table-border table-striped">
                    <tbody>
                    <tr class="">
                        <th style="width: 8px;border-top: 1px solid #000;">#</th>
                        <th style="border-top: 1px solid #000;">نوع غــذا</th>
                        <th style="border-top: 1px solid #000;">تعداد</th>
                        <th style="border-top: 1px solid #000;">فیات</th>
                        <th style="border-top: 1px solid #000;">مجموع</th>
                    </tr>
                    <?php $i = 1;
                    foreach ($sub_menus as $sm) : ?>
                        <tr>
                            <td class=" text-center"><strong><?= $i++; ?></strong></td>
                            <td><?= $sm->bm_name ?></td>
                            <td><?= ($sm->sord_count) ?> <?= $sm->unit_name ?></td>
                            <td><?= round($sm->bm_price, 1) ?> </td>
                            <td><?= $sm->bm_price * $sm->sord_count ?> </td>
                        </tr>
                    <?php endforeach ?>
                    
                    <?php $total_unpayed = $ord_cus->ord_price - $total_payed ?>
                    <?php $ord_discount = 100 - $ord_cus->ord_discount; ?>
                    <?php $discount_price = round($ord_cus->ord_price * 100 / $ord_discount) - $ord_cus->ord_price; ?>
                    <tr>
                        <th colspan="3">قیمت مجموعی</th>
                        <td colspan="2"><b><?= round($ord_cus->ord_price + $discount_price, 1) ?></b> افغانی</td>
                    </tr>
                    <tr>
                        <th colspan="3">تخفیف</th>
                        <td colspan="2">
                            <b> <?= number_format($discount_price); ?></b> افغانی (<?= round($ord_cus->ord_discount) ?>%)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class=" text-success"><b>رسیده</b></td>
                        <td colspan="2"><b><?= number_format($total_payed); ?></b> افغانی</td>
                    </tr>
                    <tr>
                        <td colspan="3" class=" text-danger"><b>الباقی</b></td>
                        <td colspan="2"><b><?= number_format($total_unpayed); ?></b> افغانی</td>
                    </tr>
                    <tr>
                        <td colspan="5"><b>آدرس:</b> <?= $this->session->general_info->ci_address ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center" style="font-size:11px">  <?= $this->session->general_info->ci_phones ?>
                            <i class="fa fa-phone-square fa-lg"></i></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center" style="font-size: 10px;font-family:arial;direction:ltr:text-align:left">
                            
                            <span style="direction:ltr:text-align:left"><?= $this->session->general_info->ci_website ?></span>
                            <i class="fa fa-facebook-square fa-lg"></i>
                            <span style="direction:ltr:text-align:left"><?= $this->session->general_info->ci_emails ?></span>
                            <i class="ion-android-globe fa-lg"</i>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="font-size:9px">مشتری گرامی افتخار ما رضایت شماست. رضایت شما اعتبار ماست.</td>
                    </tr>
                    </tbody>
                </table>
            
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
