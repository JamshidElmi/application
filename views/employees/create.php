<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">فرم استخدام کارمند</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="<?=site_url('employee/insert'); ?>" enctype="multipart/form-data">

        <div class="box-body">
            <div class="col-md-6">
                <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'danger'); }  ?>

                <div class="form-group">
                    <label for="emp_name">نام کارمند</label>
                    <input type="text" class="form-control" name="emp_name" id="emp_name" placeholder="نام" required/>
                </div>

                <div class="form-group">
                    <label for="emp_lname">تخلص کارمند</label>
                    <input type="text" class="form-control" name="emp_lname" id="emp_lname" placeholder="تخلص" required/>
                </div>

                <div class="form-group">
                    <label for="emp_national_id">شماره تذکره </label>
                    <input type="number" class="form-control" name="emp_national_id" id="emp_national_id" placeholder="شماره تذکره" />
                </div>

                <div class="form-group">
                    <label for="emp_position">پست</label>
                    <select class="form-control" name="emp_position" id="emp_position" required>
                        <option value="">انتخاب کنید</option>
                        <?php  options('job'); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="emp_salary">معاش کارمند</label>
                    <input type="number" class="form-control" name="emp_salary" id="emp_salary" placeholder="مقدار معاش به عدد" required/>
                </div>

                 <div class="form-group">
                    <!-- join date -->
                </div>

                <div class="form-group">
                    <label for="emp_email">ایمیل آدرس</label>
                    <input type="email" class="form-control" name="emp_email" id="emp_email" placeholder="ایمیل آدرس: email@domain.com" />
                </div>

                <div class="form-group">
                    <label for="emp_phone">شماره تماس</label>
                    <input type="text" class="form-control" name="emp_phone" id="emp_phone" placeholder="شماره تماس: 0777181828" required/>
                </div>

                <div class="form-group">
                    <label for="emp_picture">عکس</label>
                    <input type="file" name="emp_picture" id="emp_picture" required />
                    <p class="small">حجم فایل باید کمتر از 100 کیلوبایت باشد.</p>
                </div>

                <div class="row">
                     <div class="col-xs-6">
                        <label for="emp_phone">جنسیت</label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary checked">
                                <input type="radio" name="emp_gendar" id="emp_gendar1" value="1" checked /> ذکور
                            </label>
                            <label class="btn btn-primary ">
                                <input type="radio" name="emp_gendar" id="emp_gendar2" value="0" /> اناث
                            </label>
                        </div>
                    </div>

                    <div class="col-xs-6 text-right">
                        <label for="emp_phone">بخش کاری</label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-warning checked">
                                <input type="radio" name="emp_type" id="emp_type1" value="0" checked /> آشپزخانه
                            </label>
                            <label class="btn btn-warning ">
                                <input type="radio" name="emp_type" id="emp_type2" value="1" /> رستورانت
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
                        <input type="hidden" id="tarikhAlt" name="emp_join_date" class="form-control pull-right" style="z-index: 0;" >
                    </div>
                    <!-- /.input group -->
                    <br>
                </div>

                <div class="form-group">
                    <label for="emp_org_place">سکونت اصلی</label>
                    <input type="text" class="form-control" name="emp_org_place" id="emp_org_place" placeholder="محل سکونت اصلی کارمند: ولایت / ولسوالی" required/>
                </div>

                <div class="form-group">
                    <label for="emp_cur_place">سکونت فعلی</label>
                    <input type="text" class="form-control" name="emp_cur_place" id="emp_cur_place" placeholder="محل سکونت فعلی کارمند: ولایت / ولسوالی" required/>
                </div>

                <div class="form-group">
                    <label for="emp_address">آدرس کامل کارمند</label>
                    <textarea class="form-control" rows="7" name="emp_address" id="emp_address" placeholder="آدرس کامل کارمند: ولایت - ولسوالی - ناحیه - منطقه - سرک" required/></textarea>
                </div>

                <div class="form-group">
                    <label for="emp_biography">خلص سوانح کارمند</label>
                    <textarea class="form-control" rows="7" name="emp_biography" id="emp_biography" placeholder="خلص سوانح کارمند: تحصیلات - قابلیت ها - مهارت ها - اطلاعات شخصی ..." /></textarea>
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
