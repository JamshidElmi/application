<?php
/**
 * Created by PhpStorm.
 * User: Jamshid Elmi
 * Date: 1/7/2018
 * Time: 9:46 PM
 */
?>

<div class="box box-success">
    <div class="box-header with-border">
        <div class="col-xs-12 visible-print hidden">لیست معاشات پرداخت شده</div>
        <div class=" no-print">
            <div class="col-sm-4">
                <h3 class="box-title">لیست معاشات پرداخت شده</h3>
            </div>
            <form class="" action="<?=site_url('reports/salaries/salary_monthly');?>" method="POST" >
                <div class="col-sm-3">
                    <div class="form-group">
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
                        <a href="<?=site_url('reports/salaries/print_salaries'.$dates);?>" target="_BLANK" class="btn btn-defualt btn-sm" data-toggle="tooltip" data-original-title="Print"> <i class="fa fa-print fa-lg"></i></a>
                    </div>
                </div>
            </form>

        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="box-body no-padding">
            <table id="example2" class="table table-bordered table-hover table-striped">
                <thead class="bg-info">
                <tr>
                    <th>#</th>
                    <th>نام و تخلص</th>
                    <th>وظیفه</th>
                    <th>شماره تماش</th>
                    <th>معاش</th>
                    <th>تاریخ پرداخت</th>
                    <th>برج</th>
                    <th>پرداخت شده</th>
                    <th>باقیمانده</th>
                    <th class="hidden">جزئیات</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; $total_payed=0;$total_remain=0; foreach ($salaries as $salary): ?>
                    <tr id="ord_<? ?>">
                        <td><?=$i++;  ?></td>
                        <td><?=$salary->emp_name ?> <?=$salary->emp_lname ?></td>
                        <td><?=$salary->emp_position ?></td>
                        <td><span  data-toggle="tooltip" title="" data-original-title="Phone: <?=$salary->emp_phone ?>"><?=current(explode('-', $salary->emp_phone)) ?></span></td>
                        <td class="text-center"><strong><?=$salary->emp_salary ?></strong> افغانی</td>
                        <td><?= show_date("j F Y", $salary->sal_date); ?></td>
                        <td class="text-center"><?=str_month($salary->sal_month); ?> </td>
                        <td class="text-center text-success"><b><?=round($salary->sal_amount) ?>  </b>افغانی </td>
                        <td class="text-center text-danger"><b><?=round($salary->sal_remain) ?>  </b> افغانی </td>
                        <td class="text-center hidden">
                            <a class="read-only-garson" href="<?=site_url('order/kitchen_payment/'.$salary->sal_id); ?>"><span class="label label-default" data-toggle="tooltip" data-original-title="Payment List"><i class="fa fa-list fa-lg"></i></span></a>
                        </td>
                    </tr>
                    <?php $total_payed += $salary->sal_amount; $total_remain += $salary->sal_remain ?>
                <?php endforeach ?>
                </tbody>

            </table>

        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <span ><b class="text-success"> مجموع پرداخت شده:  <?= $total_payed ?>  </b></span>افغانی
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><b class="text-danger"> مجموع باقیمانده:  <?= $total_remain ?>  </b></span>افغانی
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
</script>


