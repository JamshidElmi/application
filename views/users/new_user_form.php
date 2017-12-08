<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">ایجاد کاربر جدید</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('user/insert'); ?>" method='POST' >

                <div class="box-body">
                        <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                        <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); } ?>

                    <input type="hidden" name="emp_id" class="form-control"   id="emp_id" />


                     <div class="form-group">
                        <label for="user_name">نام و تخلص کارمند</label>
                        <input type="text" class="form-control"  id="emp_full_name" placeholder="نام و تخلص"  required  disabled>
                    </div>

                    <div class="form-group">
                        <label for="user_name">عنوان پست کارمند</label>
                        <input type="text" class="form-control"  id="emp_position" placeholder="پست" disabled required>
                    </div>

                    <div class="form-group">
                        <label for="user_name">نام کاربری</label>
                        <input type="text" name="user_name" class="form-control" id="user_name" placeholder="نام کاربری" pattern="[A-Za-z]+" required>
                        <small class="help" > برای نام کاربری از کلمات انگلیسی استفاده کنید</small>
                    </div>


                    <div class="form-group">
                        <label for="user_pass">رمز عبور</label>
                        <input type="password" name="user_pass" class="form-control" id="user_pass" placeholder="رمز عبور" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_pass">تکرار رمز عبور</label>
                        <input type="password" name="confirm_pass" class="form-control" id="confirm_pass" placeholder="تکرار رمز عبور" required>
                    </div>

                    <div class="form-group">
                        <label for="user_type">سطح دسترسی</label>
                        <select name="user_type" onchange="check_value();" class="form-control" id="user_type" required="required">
                            <option value="">انتخاب کنید</option>
                            <option value="1">مدیر کل</option>
                            <option value="2">مدیر مسئول</option>
                            <option value="3">گارسن</option>
                            <!-- <option value="4">مشتری</option> -->
                        </select>
                    </div>




                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" id="submit" disabled="disabled" class="btn btn-primary">ایجاد حساب <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">پاک کردن <i class="fa fa-refresh"></i></button>
                    <br>
                    <small>لطفاً قبل از فشردن دکمه ایجاد حساب یکی از کارمندان را انتخاب کنید </small>
                </div>

            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">لیست کارمندان</h3>
            </div>
            <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-hover table-warning">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام و تخلص</th>
                                <th>ایمیل آدرس</th>
                                <th>نوعیت حساب</th>
                                <th>حساب کاربری</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($employees as $employee): ?>
                                <tr>
                                    <td><?=$i++ ?></td>
                                    <td><?=$employee->emp_name. ' ' . $employee->emp_lname?></td>
                                    <td><?=$employee->emp_email?></td>
                                    <td><span class="badge bg-red"><?=$employee->emp_position?></span></td>
                                    <td class="text-center"><a class="label bg-gray" onclick="select_emp(<?=$employee->emp_id?>,'<?=$employee->emp_name?>','<?=$employee->emp_lname?>','<?=$employee->emp_position?>');"><i class="fa fa-lock fa-lg"></i></a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                </table>
            </div>

            <!-- /.box-body -->
        </div>
    </div>


</div>


<script>
    function select_emp(id, name, lname, position) {
        $("#emp_id").val(id);
        $("#emp_full_name").val(name + ' ' + lname);
        $("#emp_position").val(position);
        $("#submit").attr('disabled', false);
    }
</script>