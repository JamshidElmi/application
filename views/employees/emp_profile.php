<div class="box box-primary box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">اطلاعات کارمند: <?=$employee->emp_name ." ". $employee->emp_lname ?></h3>
        <div class="pull-left box-tools no-print">
            <a target="_BLANK" class="btn btn-info btn-sm" href="<?php echo site_url('employee/print_profile/'.$employee->emp_id); ?>" data-toggle="tooltip" title="" data-original-title="Print"> <i class="fa fa-print fa-lg"></i></a>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php // print_r($employee); ?>
        <?php // print_r($users); ?>
        <div class="row">
            <div class="col-xs-3">
                <img width="150" src="<?=base_url('assets/img/profiles/'.$employee->emp_picture); ?>" class="img-thumbnail" alt="">
            </div>
            <div class="col-xs-9">
                <table class="table " >
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <th>نام: </th>
                        <td><?=$employee->emp_name ?> </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <th>بخش کاری: </th>
                        <td><?=sys_type($employee->emp_type) ?>  </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th>تخلص: </th>
                        <td><?=$employee->emp_lname ?>  </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <th>پست: </th>
                        <td><?=($employee->emp_position) ?>  </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
<style>
.table-border th , .table-border td , .table-border
{
    border:2px solid #BEBEBE;
}
</style>
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h5 class="box-title">اطلاعات شخصی کارمند</h5>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-border table-striped">
                            <tr >
                                <th>نام: </th>
                                <td><?=$employee->emp_name ?> </td>
                                <th>بخش کاری: </th>
                                <td><?=sys_type($employee->emp_type) ?>  </td>
                                <th>تاریخ استخدام</th>
                                <td><?=mds_date("l Y/F/d ", $employee->emp_join_date, 0); ?></td>
                            </tr>
                            <tr>
                                <th>تخلص: </th>
                                <td><?=$employee->emp_lname ?>  </td>
                                <th>پست: </th>
                                <td><?=($employee->emp_position) ?>  </td>
                                <th>تاریخ ختم قرارداد</th>
                                <td><?=mds_date("l Y/F/d ", strtotime('+1 years', $employee->emp_join_date), 0); ?></td>
                            </tr>
                            <tr>
                                <th>تخلص: </th>
                                <td><?=$employee->emp_lname ?>  </td>
                                <th>پست: </th>
                                <td><?=($employee->emp_position) ?>  </td>
                                <th>تاریخ ختم قرارداد</th>
                                <td><?=mds_date("l Y/F/d ", strtotime('+1 years', $employee->emp_join_date), 0); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>





    </div>
    <!-- /.box-body -->
</div>