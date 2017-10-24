<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">فرم ویرایش کارمند</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="<?=site_url('employee/update/'.$employee->emp_id); ?>" enctype="multipart/form-data">

        <div class="box-body">
            <div class="col-md-6">
                <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'danger'); }  ?>

                <div class="form-group">
                    <label for="emp_name">نام کارمند</label>
                    <input type="text" value="<?=$employee->emp_name ?>" class="form-control" name="emp_name" id="emp_name" placeholder="نام" required/>
                </div>

                <div class="form-group">
                    <label for="emp_lname">تخلص کارمند</label>
                    <input type="text" value="<?=$employee->emp_lname ?>" class="form-control" name="emp_lname" id="emp_lname" placeholder="تخلص" required/>
                </div>

                <div class="form-group">
                    <label for="emp_national_id">شماره تذکره </label>
                    <input type="number" value="<?=$employee->emp_national_id ?>" class="form-control" name="emp_national_id" id="emp_national_id" placeholder="شماره تذکره" />
                </div>

                <div class="form-group">
                    <label for="emp_position">پست</label>
                    <select class="form-control" name="emp_position" id="emp_position" required>
                        <option><?=$employee->emp_position ?></option>
                        <?php  options('job'); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="emp_salary">معاش کارمند</label>
                    <input type="number" value="<?=$employee->emp_salary ?>" class="form-control" name="emp_salary" id="emp_salary" placeholder="مقدار معاش به عدد" required/>
                </div>

                 <div class="form-group">
                    <!-- join date -->
                </div>

                <div class="form-group">
                    <label for="emp_email">ایمیل آدرس</label>
                    <input type="email" value="<?=$employee->emp_email ?>" class="form-control" name="emp_email" id="emp_email" placeholder="ایمیل آدرس: email@domain.com" />
                </div>

                <div class="form-group">
                    <label for="emp_phone">شماره تماس</label>
                    <input type="text" value="<?=$employee->emp_phone ?>"class="form-control" name="emp_phone" id="emp_phone" placeholder="شماره تماس: 0777181828" required/>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="emp_picture">عکس</label>
                            <input type="file" name="emp_picture" id="emp_picture" />
                            <p class="small">حجم فایل باید کمتر از 250 کیلوبایت و ابعاد آن از 400 پیکسل کوچکتر باشد.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 text-left">
                        <?php if ($employee->emp_picture != ""): ?>
                            <img src="<?=base_url('assets/img/profiles/'.$employee->emp_picture); ?>" width="80" class="img-thumbnail" alt="Profile Picture">
                        <?php endif ?>
                    </div>
                </div>


                <div class="row">
                     <div class="col-xs-5">
                        <label for="emp_phone">جنسیت</label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                        <?php $male = NULL; $fmale = NULL; $male_a = NULL; $fmale_a = NULL;
                                if($employee->emp_gendar == 1) { $male = 'checked' ; $male_a = 'active' ; }else { $fmale = 'checked'; $fmale_a = 'active'; } ?>
                            <label class="btn btn-primary <?=$male_a ?>">
                                <input type="radio" name="emp_gendar" id="emp_gendar1" value="1" <?=$male ?> /> ذکور
                            </label>
                            <label class="btn btn-primary <?=$fmale_a ?>">
                                <input type="radio" name="emp_gendar" id="emp_gendar2" value="0" <?=$fmale ?> /> اناث
                            </label>
                        </div>
                    </div>

                    <div class="col-xs-7 text-right">
                        <label for="emp_phone">بخش کاری</label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                        <?php $cook = NULL;$restur = NULL; $cook_a = NULL;$restur_a = NULL;
                                if($employee->emp_gendar == 1) { $cook = 'checked' ; $cook_a = 'active' ; }else {$restur = 'checked';$restur_a = 'active'; } ?>
                            <label class="btn btn-warning <?=$cook_a?>">
                                <input type="radio" name="emp_type" id="emp_type1" value="0" <?=$cook?> /> آشپزخانه
                            </label>
                            <label class="btn btn-warning <?=$restur_a?>">
                                <input type="radio" name="emp_type" id="emp_type2" value="1" <?=$restur?> /> رستورانت
                            </label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label>تاریخ استخدام</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                        <input type="hidden" id="tarikhAlt" value="<?=$employee->emp_join_date ?>" name="emp_join_date" class="form-control pull-right" style="z-index: 0;" >
                    </div>
                    <!-- /.input group -->
                    <br>
                </div>

                <div class="form-group">
                    <label for="emp_org_place">سکونت اصلی</label>
                    <input type="text" class="form-control" value="<?=$employee->emp_org_place ?>" name="emp_org_place" id="emp_org_place" placeholder="محل سکونت اصلی کارمند: ولایت / ولسوالی" required/>
                </div>

                <div class="form-group">
                    <label for="emp_cur_place">سکونت فعلی</label>
                    <input type="text" class="form-control" value="<?=$employee->emp_cur_place ?>" name="emp_cur_place" id="emp_cur_place" placeholder="محل سکونت فعلی کارمند: ولایت / ولسوالی" required/>
                </div>

                <div class="form-group">
                    <label for="emp_address">آدرس کامل کارمند</label>
                    <textarea class="form-control" rows="7" name="emp_address" id="emp_address" placeholder="آدرس کامل کارمند: ولایت - ولسوالی - ناحیه - منطقه - سرک" required/><?=$employee->emp_address ?></textarea>
                </div>

                <div class="form-group">
                    <label for="emp_biography">خلص سوانح کارمند</label>
                    <textarea class="form-control" rows="7" name="emp_biography" id="emp_biography" placeholder="خلص سوانح کارمند: تحصیلات - قابلیت ها - مهارت ها - اطلاعات شخصی ..." /><?=$employee->emp_biography ?></textarea>
                </div>

            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
            <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
        </div>
    </form>
</div>

<script>
$(document).ready(function () {
    $('#tarikh').persianDatepicker({
        altField: '#tarikhAlt',
        altFormat: 'X',
        format: 'D MMMM YYYY ساعت  HH:mm a',
        observer: true,
        timePicker: {
            enabled: true
        },

    });
});


</script>
