<div class="box box-primary box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">اطلاعات
            مشتری: <?php echo ($customer->cus_gendar == 0) ? 'خانم' : 'آقای'; ?> <?= $customer->cus_name . " " . $customer->cus_lname ?>
            کد: <span class="label label-warning "><?= $customer->cus_unique_id ?></span></h3>
        <div class="pull-left box-tools no-print">
            <a target="_BLANK" class="btn btn-info btn-sm" href="<?php echo site_url('customer/print_profile/' . $customer->cus_id); ?>" data-toggle="tooltip" title="" data-original-title="Print">
                <i class="fa fa-print fa-lg"></i></a>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-xs-3">
                <img width="150" src="<?= base_url('assets/img/customers/' . $customer->cus_picture); ?>" class="img-thumbnail" alt="">
            </div>
            <div class="col-xs-8">
                <table class="table ">
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr class="text-center">
                        <th class="bg-info text-center">نام</th>
                        <th class="bg-info text-center">تخلص</th>
                        <th class="bg-info text-center">بخش</th>
                        <th class="bg-info text-center">موجودی صندوق</th>
                    </tr>
                    <tr>
                        <td class="bg-warning text-center"><?= $customer->cus_name ?> </td>
                        <td class="bg-warning text-center"><?= $customer->cus_lname ?>  </td>
                        <td class="bg-warning text-center"><?= sys_type($customer->cus_type) ?>  </td>
                        <td class="bg-warning text-center"><?= ($account->acc_amount) ?> افغانی</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h5 class="box-title">اطلاعات شخصی مشتری</h5>
            </div>
            <div class="box-body">
                <div class="row">

                </div>
                <div class="col-xs-12">
                    <table class="table table-border table-striped">
                        <tr>
                            <th>نام:</th>
                            <td><?= $customer->cus_name ?> </td>
                            <th>بخش :</th>
                            <td><?= sys_type($customer->cus_type) ?>  </td>
                            <th>تاریخ ثبت نام</th>
                            <td><?= show_date("l j F Y", $customer->cus_join_date); ?></td>
                            <th>صندوق:</th>
                            <td><?= $account->acc_name ?>  </td>
                        </tr>
                        <tr>
                            <th>تخلص:</th>
                            <td><?= $customer->cus_lname ?>  </td>
                            <th>وظیفه:</th>
                            <td><?= ($customer->cus_job) ?>  </td>
                            <th>وبسایت:</th>
                            <td><?= $customer->cus_site; ?></td>
                            <th>ضامن:</th>
                            <td><?= $customer->cus_ref_full_name ?>  </td>
                        </tr>
                        <tr>
                            <th>شماره تذکره:</th>
                            <td><?= $customer->cus_national_id ?>  </td>
                            <th>شماره تماس:</th>
                            <td><?= ($customer->cus_phones) ?>  </td>
                            <th>ایمیل آدرس:</th>
                            <td><?= $customer->cus_email ?></td>
                            <th>شماره ضامن:</th>
                            <td><?= ($customer->cus_ref_phone) ?>  </td>
                        </tr>
                        <tr>
                            <th>سکونت اصلی:</th>
                            <td><?= $customer->cus_org_place ?>  </td>
                            <th>سکونت فعلی:</th>
                            <td><?= ($customer->cus_cur_place) ?>  </td>
                            <th>جنسیت:</th>
                            <td><?php echo ($customer->cus_gendar == 0) ? 'خانم' : 'آقا'; ?></td>
                            <th>شرکت-کمپنی:</th>
                            <td><?= $customer->cus_org_name ?></td>
                        </tr>

                    </table>

                    <div class="row">
                        <div class="col-xs-4">
                            <div class="text-muted well well-sm no-shadow">
                                <h5>آدرس مشتری:</h5>
                                <p class="text-justify"><?= ($customer->cus_address) ?></p>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="text-muted well well-sm no-shadow">
                                <h5>درباره <?= $customer->cus_name ?>:</h5>
                                <p class="text-justify"><?= ($customer->cus_biography) ?></p>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="text-muted well well-sm no-shadow">
                                <h5>آدرس کامل ضامن:</h5>
                                <p class="text-justify"><?= ($customer->cus_ref_address) ?></p>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>


</div>
<!-- /.box-body -->
