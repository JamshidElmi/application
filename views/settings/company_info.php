<?php
/**
 * Created by PhpStorm.
 * User: Eng-Elmi
 * Date: 14/12/2017
 * Time: 11:08 AM
 */
?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">فرم ویرایش کارمند</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="<?=site_url('setting/update_info/'); ?>" enctype="multipart/form-data">

        <div class="box-body">
            <div class="col-md-6">
                <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'danger'); }  ?>

                <div class="form-group">
                    <label for="ci_full_name">نام کامل رستورانت</label>
                    <input type="text" value="<?=$info->ci_full_name ?>" class="form-control" name="ci_full_name" id="ci_full_name" placeholder="نام" required/>
                </div>

                <div class="form-group">
                    <label for="ci_boss_name">نام کامل رئیس</label>
                    <input type="text" value="<?=$info->ci_boss_name ?>" class="form-control" name="ci_boss_name" id="ci_boss_name" placeholder="تخلص" required/>
                </div>

                <div class="form-group">
                    <label for="ci_manager_name">نام کامل معاون </label>
                    <input type="number" value="<?=$info->ci_manager_name ?>" class="form-control" name="ci_manager_name" id="ci_manager_name" placeholder="شماره تذکره" />
                </div>

                <div class="form-group">
                    <label for="ci_phones">شماره های تماس </label>
                    <input type="text" value="<?=$info->ci_phones ?>" class="form-control" name="ci_phones" id="ci_phones" placeholder="شماره تذکره (جدا کننده -)" />
                </div>

                <div class="form-group">
                    <label for="ci_emails">ایمیل رستورانت</label>
                    <input type="email" value="<?=$info->ci_emails ?>" class="form-control" name="ci_emails" id="ci_emails" placeholder="ایمیل آدرس: email@domain.com" />
                </div>

                <div class="form-group">
                    <label for="ci_address">آدرس کامل رستورانت</label>
                    <textarea class="form-control" rows="7" name="ci_address" id="ci_address" placeholder="آدرس کامل کارمند: ولایت - ولسوالی - ناحیه - منطقه - سرک" required/><?=$info->ci_address ?></textarea>
                </div>


                <div class="form-group">
                    <label for="ci_website">آدرس سایت </label>
                    <input type="url" value="<?=$info->ci_website ?>" class="form-control" name="ci_website" id="ci_website" placeholder="http://www.domain.com" required/>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="ci_logo">لوگو / نماد</label>
                            <input type="file" name="ci_logo" id="ci_logo" />
                            <p class="small">حجم فایل باید کمتر از 250 کیلوبایت و ابعاد آن از 400 پیکسل کوچکتر باشد.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 text-left">
                        <?php if ($info->ci_logo != ""): ?>
                            <img src="<?=base_url('assets/img/info/'.$info->ci_logo); ?>" width="80" class="img-thumbnail" alt="Logo Picture">
                        <?php endif ?>
                    </div>
                </div>




            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label>تاریخ تاسیس</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                        <input type="hidden" id="tarikhAlt" value="<?=$info->ci_constitute ?>" name="emp_join_date" class="form-control pull-right" style="z-index: 0;" >
                    </div>
                    <!-- /.input group -->
                    <br>
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
            format: 'D MMMM YYYY ساعت  HH:mm a',
            observer: true,

            altFormat: 'YYYY-MM-DD',
            observer: true,
            position: [-65,0],
            calendar: {
                persian: {
                    enabled: true,
                    locale: 'en',
                    leapYearMode: "algorithmic" // "astronomical"
                },
                gregorian: {
                    enabled: false,
                    locale: 'en'
                }
            }

        });
    });


</script>
