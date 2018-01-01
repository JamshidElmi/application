<?php
/**
 * Created by PhpStorm.
 * User: Jamshid Elmi
 * Date: 12/26/2017
 * Time: 8:22 PM
 */
?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">آپلود اطلاعات در پایگاه اطلاعاتی  </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body text-center">
                <a href="<?=base_url('setting/create_backup') ?>">
                    <i class="fa fa-upload" style="font-size: 200px"></i>
                </a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <div class="col-md-4">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">دانلود اطلاعات از پایگاه اطلاعاتی</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body text-center">
                <a href="<?=base_url('setting/create_backup') ?>">
                    <i class="fa fa-download" style="font-size: 200px"></i>
                </a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

</div>