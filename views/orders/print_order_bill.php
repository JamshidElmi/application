<?php
/**
 * Created by PhpStorm.
 * User: Eng-Elmi
 * Date: 14/12/2017
 * Time: 11:09 PM
 */
?>

<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">جزئیات فاکتور</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print fa-lg"></i>
                </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php $this->load->view('layout/bill_header'); ?>
        <?php print_r($ord_cus) ?>
    </div>
    <!-- /.box-body -->
</div>
