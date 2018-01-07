<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">فرم ویرایش اطلاعات مشتری</h3>
        <div class="box-tools pull-right">
            <a href="<?=site_url('finance/accounts'); ?>" class="btn btn-info btn-sm  bg-blue" data-toggle="tooltip" title="" data-original-title="New Account"><i class="ion-lock-combination fa-lg"></i></a>
            <a href="<?=site_url('customer/'); ?>" class="btn btn-info btn-sm  bg-info" data-toggle="tooltip" title="" data-original-title="Customers List"><i class="ion-android-list fa-lg"></i></a>
        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="<?=site_url('customer/update/'.$customer->cus_id); ?>" enctype="multipart/form-data">
        <div class="box-body">
            <div class="col-md-6">
                <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'danger'); }  ?>

                <div class="row">
                    <div class="col-xs-9">
                         <div class="form-group">
                            <label for="cus_name">نام مشتری</label>
                            <input type="text" class="form-control" value="<?=$customer->cus_name ?>" name="cus_name" id="cus_name" placeholder="نام" required/>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label for="cus_unique_id">کد اشتراک</label>
                            <input type="text" class="form-control text-center" style="font-family: Segoe; " value="<?=$customer->cus_unique_id ?>" id="cus_unique_id" placeholder="کد منحصر به فرد برای مشتری" required readonly />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cus_lname">تخلص مشتری</label>
                    <input type="text" class="form-control" name="cus_lname" id="cus_lname" value="<?=$customer->cus_lname ?>" placeholder="تخلص" required/>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="form-group">
                            <label for="cus_acc_id">انتخاب صندوق برای مشتری</label>
                            <select name="cus_acc_id" id="cus_acc_id" class="form-control" required>
                                <option value="<?=$customer->cus_acc_id ?>">صندوق انتخاب شده است</option>
                                <?php foreach ($accounts as $account ): ?>
                                    <option value="<?=$account->acc_id ?>"><?=$account->acc_name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="cus_acc_id">جمع و برداشت</label>
                            <a class="btn btn-primary col-xs-12" href="<?=site_url('finance/credit_debit/'.$customer->cus_acc_id); ?>">مدیریت صندوق</a>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="cus_national_id">شماره تذکره </label>
                    <input type="number" class="form-control" value="<?=$customer->cus_national_id ?>" name="cus_national_id" id="cus_national_id" placeholder="شماره تذکره" />
                </div>

                <div class="form-group">
                    <label for="cus_job">وظیفه</label>
                    <input type="text" class="form-control" value="<?=$customer->cus_job ?>" name="cus_job" id="cus_job" placeholder="وظیفه مشتری" />
                </div>

                 <div class="form-group">
                    <!-- join date -->
                </div>

                <div class="form-group">
                    <label for="cus_email">ایمیل آدرس</label>
                    <input type="email" class="form-control" value="<?=$customer->cus_email ?>" name="cus_email" id="cus_email" placeholder="ایمیل آدرس: email@domain.com" />
                </div>

                <div class="form-group">
                    <label for="cus_phones">شماره تماس</label>
                    <input type="text" class="form-control" value="<?=$customer->cus_phones ?>" name="cus_phones" id="cus_phones" placeholder="شماره تماس: 0777181828#0785555555" required/>
                </div>

                <div class="form-group">
                    <label for="cus_site">آدرس وب سایت</label>
                    <input type="text" class="form-control" value="<?=$customer->cus_site ?>" name="cus_site" id="cus_site" placeholder="وب سایت: www.domain.af" />
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cus_picture">عکس</label>
                            <input type="file" name="cus_picture" id="cus_picture"  />
                            <p class="small">حجم فایل باید کمتر از 250 کیلوبایت و ابعاد آن از 400 پیکسل کوچکتر باشد.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 text-left">
                            <?php if ($customer->cus_picture != ""): ?>
                                <img src="<?=base_url('assets/img/customers/'.$customer->cus_picture); ?>" width="80" class="img-thumbnail" alt="Profile Picture">
                            <?php endif ?>
                    </div>
                </div>


            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label>تاریخ ثبت</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="tarikh" value="<?=show_date('l d/F/Y', $customer->cus_join_date); ?>" class="form-control pull-right" style="z-index: 0;" readonly>
                        <input type="hidden" id="tarikhAlt" value="<?=$customer->cus_join_date ?>" name="cus_join_date" class="form-control pull-right" style="z-index: 0;" >
                    </div>
                    <!-- /.input group -->

                </div>

                <div class="form-group">
                    <label for="cus_org_name">نام شرکت / کمپنی / اداره</label>
                    <input type="text" class="form-control" value="<?=$customer->cus_org_name ?>" name="cus_org_name" id="cus_org_name" placeholder="نام شرکت / ارگان / اداره / کمپنی" />
                </div>

                <div class="form-group">
                    <label for="cus_org_place">سکونت اصلی</label>
                    <input type="text" class="form-control" value="<?=$customer->cus_org_place ?>" name="cus_org_place" id="cus_org_place" placeholder="محل سکونت اصلی مشتری: ولایت / ولسوالی" />
                </div>

                <div class="form-group">
                    <label for="cus_cur_place">سکونت فعلی</label>
                    <input type="text" class="form-control" value="<?=$customer->cus_cur_place ?>" name="cus_cur_place" id="cus_cur_place" placeholder="محل سکونت فعلی مشتری: ولایت / ولسوالی" />
                </div>

                <div class="row ">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cus_address">آدرس کامل مشتری</label>
                            <textarea class="form-control" rows="7"  name="cus_address" id="cus_address" placeholder="آدرس دقیق و کامل مشتری: ولایت - ولسوالی - ناحیه - منطقه - سرک - کوچه" required/> <?=$customer->cus_address ?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                         <div class="form-group">
                            <label for="cus_biography">درباره مشتری</label>
                            <textarea class="form-control" rows="7" name="cus_biography" id="cus_biography" placeholder="اطلاعات شخصی مشتری..." /><?=$customer->cus_biography ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cus_ref_full_name">نام کامل ضامن / معرف</label>
                            <input type="text" class="form-control" value="<?=$customer->cus_ref_full_name ?>" name="cus_ref_full_name" id="cus_ref_full_name" placeholder="نام کامل ضامن یا معرف" />
                        </div>

                        <div class="form-group">
                            <label for="cus_ref_phone">شماره تماس ضامن / معرف</label>
                            <input type="text" class="form-control" value="<?=$customer->cus_ref_phone ?>" name="cus_ref_phone" id="cus_ref_phone" placeholder="شماره تماس ضامن یا معرف" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cus_ref_address">آدرس کامل ضامن / معرف</label>
                            <textarea class="form-control" rows="5" value="<?=$customer->cus_ref_address ?>" name="cus_ref_address" id="cus_ref_address" placeholder="آدرس دقیق ضامن یا معرف مشتری" /></textarea>
                        </div>
                    </div>
                </div>

                 <div class="row">
                     <div class="col-xs-5">
                        <label for="cus_phone">جنسیت: </label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                        <?php $male = NULL; $fmale = NULL; $male_a = NULL; $fmale_a = NULL;
                                if($customer->cus_gendar == 1) { $male = 'checked' ; $male_a = 'active' ; }else { $fmale = 'checked'; $fmale_a = 'active'; } ?>
                            <label class="btn btn-primary <?=$male_a ?>">
                                <input type="radio" name="cus_gendar" id="cus_gendar1" value="1" <?=$male ?> /> ذکور
                            </label>
                            <label class="btn btn-primary <?=$fmale_a ?> ">
                                <input type="radio" name="cus_gendar" id="cus_gendar2" value="0" <?=$fmale ?> /> اناث
                            </label>
                        </div>
                    </div>

                    <div class="col-xs-7 text-right">
                        <label for="cus_phone">مشتری برای: </label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                            <?php $cook = NULL;$restur = NULL; $cook_a = NULL;$restur_a = NULL;
                                if($customer->cus_type == 0) { $cook = 'checked' ; $cook_a = 'active' ; }else {$restur = 'checked';$restur_a = 'active'; } ?>
                            <label class="btn btn-warning <?=$cook_a?>">
                                <input type="radio" name="cus_type" id="cus_type1" value="0" <?=$cook?> /> آشپزخانه
                            </label>
                            <label class="btn btn-warning <?=$restur_a?>">
                                <input type="radio" name="cus_type" id="cus_type2" value="1" <?=$restur?> /> رستورانت
                            </label>
                        </div>
                    </div>
                </div>




            </div> <!--div.col-6-->
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
    $('#tarikh').click(function(event) {
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
            },
        });
    });
});


</script>
