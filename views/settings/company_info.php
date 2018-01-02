<?php
/**
 * Created by PhpStorm.
 * User: Eng-Elmi
 * Date: 14/12/2017
 * Time: 11:08 AM
 */
?>
<div class="row">
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">فرم ویرایش اطلاعات</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?= site_url('setting/update_info/'); ?>" enctype="multipart/form-data">
                <div class="box-body">
                    <?php if ($this->session->form_errors) {
                        echo alert($this->session->form_errors, 'danger');
                    } ?>
                    <?php if ($this->session->file_errors) {
                        echo alert($this->session->file_errors, 'danger');
                    } ?>
                    <?php if ($this->session->form_success) {
                        echo alert($this->session->form_success, 'success');
                    } ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ci_full_name">نام کامل رستورانت
                                    <span class="text-sm text-blue">(دری)</span></label>
                                <input type="text" value="<?=$info->ci_full_name ?>" class="form-control" name="ci_full_name" id="ci_full_name" placeholder="نام کامل رستورانت" required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ci_full_name_en">نام کامل رستورانت
                                    <span class="text-sm text-blue">(انگلیسی)</span></label>
                                <input type="text" value="<?=$info->ci_full_name_en ?>" class="form-control text-left" name="ci_full_name_en" id="ci_full_name_en" placeholder="Full Name Of Restuarant" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ci_boss_name">نام کامل رئیس</label>
                                <input type="text" value="<?=$info->ci_boss_name ?>" class="form-control" name="ci_boss_name" id="ci_boss_name" placeholder="نام کامل رئیس" required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ci_manager_name">نام کامل معاون </label>
                                <input type="text" value="<?=$info->ci_manager_name ?>" class="form-control" name="ci_manager_name" id="ci_manager_name" placeholder="نام کامل معاون " required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ci_website">آدرس سایت </label>
                                <input type="url" value="<?=$info->ci_website ?>" class="form-control text-left" name="ci_website" id="ci_website" placeholder="http://www.domain.com" required />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ci_emails">آدرس ایمیل </label>
                                <input type="email" value="<?=$info->ci_emails ?>" class="form-control text-left" name="ci_emails" id="ci_emails" placeholder="ایمیل آدرس: email@domain.com" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>تاریخ تاسیس</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="tarikh" value="" class="form-control pull-right" style="z-index: 0;" readonly>
                                    <input type="hidden" id="tarikhAlt" value="<?= $info->ci_constitute_date ?>" name="ci_constitute_date" class="form-control pull-right" style="z-index: 0;">
                                </div>
                                <!-- /.input group -->
                                <br>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ci_phones">شماره های تماس </label>
                                <input type="text" value="<?= $info->ci_phones ?>" class="form-control" name="ci_phones" id="ci_phones" placeholder="شماره های تماس (جدا کننده -)" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ci_address">آدرس کامل رستورانت</label>
                        <textarea class="form-control" rows="7" name="ci_address" id="ci_address" placeholder="آدرس کامل : ولایت - ولسوالی - ناحیه - منطقه - سرک" required><?= $info->ci_address ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div id="img_here"></div>
                        </div>
                        <div class="col-sm-6 text-left">
                            <?php if ($info->ci_logo != ""): ?>
                                <img src="<?= base_url('assets/img/info/' . $info->ci_logo); ?>" width="120" class="img-thumbnail" id="img" alt="Logo Picture" data-toggle="tooltip" data-original-title="Click For Change">
                            <?php endif ?>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success  read-only">ذخیره <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        $('#tarikh').persianDatepicker({
            altField: '#tarikhAlt',
            format: 'D MMMM YYYY ساعت  HH:mm a',
            altFormat: 'YYYY-MM-DD',
            observer: true,
            position: [-67, 200],
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

    $('#img').click(function () {
        $('#img_here').html('<div class="form-group">\n' +
            '                                <label for="ci_logo">لوگو / نماد</label>\n' +
            '                                <input type="file" name="ci_logo" id="ci_logo" required/>\n' +
            '                                <p class="small">حجم فایل باید کمتر از 400 کیلوبایت و ابعاد آن از 400 پیکسل کوچکتر\n' +
            '                                    باشد.</p>\n' +
            '                            </div>');
    });

</script>
