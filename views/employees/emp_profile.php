<div class="box box-primary box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">اطلاعات
            کارمند: <?php echo ($employee->emp_gendar == 0) ? 'خانم' : 'آقای'; ?> <?= $employee->emp_name . " " . $employee->emp_lname ?></h3>
        <div class="pull-left box-tools no-print">
            <a target="_BLANK" class="btn btn-info btn-sm" href="<?php echo site_url('employee/print_profile/' . $employee->emp_id); ?>" data-toggle="tooltip" title="" data-original-title="Print">
                <i class="fa fa-print fa-lg"></i></a>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-xs-3">
                <img width="150" src="<?= base_url('assets/img/profiles/' . $employee->emp_picture); ?>" class="img-thumbnail" alt="">
            </div>
            <div class="col-xs-8">
                <table class="table ">
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr class="text-center">
                        <th class="bg-info text-center">نام</th>
                        <th class="bg-info text-center">تخلص</th>
                        <th class="bg-info text-center">بخش کاری</th>
                        <th class="bg-info text-center">پست</th>
                    </tr>
                    <tr>
                        <td class="bg-warning text-center"><?= $employee->emp_name ?> </td>
                        <td class="bg-warning text-center"><?= $employee->emp_lname ?>  </td>
                        <td class="bg-warning text-center"><?= sys_type($employee->emp_type) ?>  </td>
                        <td class="bg-warning text-center"><?= ($employee->emp_position) ?>  </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h5 class="box-title">اطلاعات شخصی کارمند</h5>
            </div>
            <div class="box-body">
                <div class="row">

                </div>
                <div class="col-xs-9">
                    <table class="table table-border table-striped">
                        <tr>
                            <th>نام:</th>
                            <td><?= $employee->emp_name ?> </td>
                            <th>بخش کاری:</th>
                            <td><?= sys_type($employee->emp_type) ?>  </td>
                            <th>تاریخ استخدام</th>
                            <!-- <td><? //=mds_date("l Y/F/d ", $employee->emp_join_date, 0); ?></td> -->
                            <td><?= show_date("l j F Y", $employee->emp_join_date); ?></td>
                        </tr>
                        <tr>
                            <th>تخلص:</th>
                            <td><?= $employee->emp_lname ?>  </td>
                            <th>پست:</th>
                            <td><?= ($employee->emp_position) ?>  </td>
                            <th>تاریخ ختم قرارداد</th>
                            <!-- <td><? //=mds_date("l Y/F/d ", strtotime('+1 years', $employee->emp_join_date)); ?></td> -->
                            <td>
                                <?php $date = explode('-', $employee->emp_join_date);
                                $date[0]++; ?>
                              
                                <?= show_date('dd', implode('-', [$date[0], $date[1],$date[2]])); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>شماره تذکره:</th>
                            <td><?= $employee->emp_national_id ?>  </td>
                            <th>شماره تماس:</th>
                            <td><?= ($employee->emp_phone) ?>  </td>
                            <th>ایمیل آدرس:</th>
                            <td><?= $employee->emp_email ?></td>
                        </tr>
                        <tr>
                            <th>سکونت اصلی:</th>
                            <td><?= $employee->emp_org_place ?>  </td>
                            <th>سکونت فعلی:</th>
                            <td><?= ($employee->emp_cur_place) ?>  </td>
                            <th>جنسیت:</th>
                            <td><?php echo ($employee->emp_gendar == 0) ? 'خانم' : 'آقا'; ?></td>
                        </tr>
                    </table>

                    <div class="col-sm-6 text-muted well well-sm no-shadow">
                        <h4>آدرس کارمند:</h4>
                        <p class="text-justify"><?= ($employee->emp_address) ?></p>
                    </div>
                    <div class="col-sm-6 text-muted well well-sm no-shadow">
                        <h4>خلص سوانح کارمند:</h4>
                        <p class="text-justify"><?= ($employee->emp_biography) ?></p>
                    </div>

                </div>

                <div class="col-xs-3">
                    <?php if ((!$users)): ?>
                        <div class="callout callout-warning">
                            <p> کارمند مورد نظر حساب کاربری ندارد.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h5 class="text-center">حساب کاربری</h5>
                                </div>
                                <div class="box-body box-profile">
                                    <img src="<?= base_url('assets/img/profiles/' . $employee->emp_picture); ?>" class="profile-user-img img-responsive img-circle" alt="">
                                    <h3 class="profile-username text-center"><?= $employee->emp_name . " " . $employee->emp_lname ?></h3>
                                    <p class="text-muted text-center"><?= $employee->emp_position ?> |
                                        بخش <?= sys_type($employee->emp_type) ?></p>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>نام کاربری</b> <a class="pull-left"><?= ($user->user_name); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>رمز عبور</b> <a class="pull-left">**********</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>سطح دسترسی</b>
                                            <a class="pull-left"><?= permission($user->user_type); ?></a>
                                        </li>
                                    </ul>
                                    <?php if ($this->session->user_info->user_id === $user->user_id): ?>
                                        <a href="#" data-toggle="modal" data-target="#<?= $this->session->user_info->user_id ?>" class="btn btn-warning btn-block">تغییر
                                            رمز عبور<b></b></a>
                                    <?php endif ?>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<!-- Modal -->
<div id="<?= $this->session->user_info->user_id ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm modal-warning">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ویرایش حساب کاربری</h4>
            </div>
            <form action="<?= base_url('user/edit/' . $this->session->user_info->user_id); ?>" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="user_name">نام کاربری</label>
                        <input type="text" name="user_name" value="<?= $user->user_name ?>" class="form-control" id="user_name" placeholder="نام کاربری" pattern="[A-Za-z]+" required readonly>
                        <small class="help"> برای نام کاربری از کلمات انگلیسی استفاده کنید</small>
                    </div>

                    <div class="form-group">
                        <label for="old_pass">رمز عبور قبلی</label>
                        <input type="password" name="old_pass" class="form-control" id="old_pass" placeholder="رمز عبور قبلی کاربر مذکور" required>
                    </div>

                    <div class="form-group">
                        <label for="user_pass">رمز عبور جدید</label>
                        <input type="password" name="user_pass" class="form-control" id="user_pass" placeholder="رمز عبور جدید" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن <i class="fa fa-close"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>