<?php
/**
 * Created by PhpStorm.
 * User: Eng-Elmi
 * Date: 14/12/2017
 * Time: 11:09 PM
 */
?>
<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 5px;
    }
</style>
<div class="box box-warning ">
    <div class="box-header with-border no-print">
        <h3 class="box-title"> فاکتور آشپزخانه</h3>
        <div class="box-tools pull-right no-print">
            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Print">
                <i class="fa fa-print fa-lg"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php $this->load->view('layout/bill_header'); ?>

        <div class="alert bg-info" style="margin-bottom: 5px"><p>آشپز خانه و رستورانت ممتاز هرات افتخار دارد تا غذای محافل و مجالس شما را الی 3000
                نفر در اسرع وقت به قیمت کاملا مناسب تهیه الی درب منزل شما طور رایگان ارسال نماید. ( سفارش پرسونل جهت
                پذیرایی مهمانان پذیرفته میشود).</p></div>
        <div class="well well-sm" style="margin-bottom: 5px">
            <div class="row">
                <div class="col-xs-5"><b>نام مشتری: </b> <?= $ord_cus->cus_name . ' ' . $ord_cus->cus_lname ?></div>
                <div class="col-xs-4"><b>شماره تماس:</b> <?= current(explode('-', $ord_cus->cus_phones)) ?></div>
                <div class="col-xs-3"><b>کد اشتراک:</b> <?= $ord_cus->cus_unique_id ?></div>
            </div>
        </div>
        <div class="well well-sm" style="margin-bottom: 5px">
            <div class="row">
                <div class="col-xs-5"><b>تاریخ ثبت: </b> <?= show_date("j F Y", $ord_cus->ord_created_date) ?></div>
                <div class="col-xs-4"><b>تاریخ تحویل غذا:</b> <?= show_date("j F Y", $ord_cus->ord_date) ?></div>
                <div class="col-xs-3"><b>ساعت:</b> <?= $ord_cus->ord_time ?></div>
            </div>
        </div>
        <div class="well well-sm" style="margin-bottom: 5px">
            <div class="row">
                <div class="col-xs-12"><b>آدرس: </b> <?= $ord_cus->cus_address ?></div>
            </div>
        </div>


        <table class="table table-border">
            <tbody>
                <tr class="bg-gray">
                    <th style="width: 8px">شماره</th>
                    <th>نوع غــذا</th>
                    <th>تعداد</th>
                    <th>واحد</th>
                    <th>فیات</th>
                    <th>مجموع</th>
                </tr>
                <?php $i = 1;$rows =15;  foreach ($sub_menus as $sm) : ?>
                    <tr>
                        <td><?=$i++; $rows--; ?></td>
                        <td><?=$sm->sm_name ?></td>
                        <td><?=$sm->sm_count * $sm->sord_count ?></td>
                        <td><?=$sm->unit_name ?></td>
                        <td><?=$sm->sm_price ?> افغانی </td>
                        <td><?=$sm->sm_price * $sm->sord_count ?> افغانی </td>
                    </tr>
                <?php endforeach ?>
                <?php for ($l = 0; $l < $rows; $l++):?>
                    <tr>
                        <td><?=$i++;?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                <?php endfor;?>
                    <tr>
                        <td colspan="2" rowspan="2"><b>قیمت مجموع به حروف</b> </td>
                        <td colspan="2" rowspan="2">حروف</td>
                        <td><b>قیمت مجموعی</b></td>
                        <td><b><?=$sm->ord_price ?></b> افغانی </td>
                    </tr>
                    <tr>
                        <td><b>رسیده</b> </td>
                        <td><b></b> افغانی  </td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>آدرس:</b> <?=$this->session->general_info->ci_address ?></td>
                        <td style="background: #e1e1e1;"><b>الباقی</b></td>
                        <td><b></b> افغانی   </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>شماره های تماس</b></td>
                        <td colspan="4" class="text-center"><?=$this->session->general_info->ci_phones ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-left"><b><?=$this->session->general_info->ci_website ?></b></td>
                        <td colspan="3" class="text-left"><b><?=$this->session->general_info->ci_emails ?></b></td>
                    </tr>
            </tbody>
        </table>


    </div>
    <!-- /.box-body -->
</div>
