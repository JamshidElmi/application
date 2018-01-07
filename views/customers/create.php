<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">فرم ثبت اطلاعات مشتری</h3>
        <div class="box-tools pull-right">
            <a href="<?=site_url('finance/accounts'); ?>" class="btn btn-info btn-sm  bg-blue" data-toggle="tooltip" title="" data-original-title="New Account"><i class="ion-lock-combination fa-lg"></i></a>
            <a href="<?=site_url('customer/'); ?>" class="btn btn-info btn-sm  bg-info" data-toggle="tooltip" title="" data-original-title="Customers List"><i class="ion-android-list fa-lg"></i></a>
        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="<?=site_url('customer/insert'); ?>" enctype="multipart/form-data">

        <div class="box-body">
            <div class="col-md-6">
                <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'danger'); }  ?>

                <div class="row">
                    <div class="col-xs-9">
                         <div class="form-group">
                            <label for="cus_name">نام مشتری</label>
                            <input type="text" class="form-control" name="cus_name" id="cus_name" placeholder="نام" required/>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label for="cus_unique_id">کد اشتراک</label>
                            <?php $this->load->helper('string');?>
                            <input type="text" class="form-control text-center" style="font-family: Segoe; background-color: #FFF9A8;" name="cus_unique_id" value="<?=$uniqee_id ?>" id="cus_unique_id" placeholder="کد منحصر به فرد برای مشتری" required readonly />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cus_lname">تخلص مشتری</label>
                    <input type="text" class="form-control" name="cus_lname" id="cus_lname" placeholder="تخلص" required/>
                </div>

                <div class="form-group">
                    <label for="cus_acc_id">انتخاب صندوق برای مشتری</label>
                    <select name="cus_acc_id" id="cus_acc_id" class="form-control" required>
                        <option value="">انتخاب کنید</option>
                        <?php foreach ($accounts as $account ): ?>
                            <option value="<?=$account->acc_id ?>"><?=$account->acc_name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>


                <div class="form-group">
                    <label for="cus_national_id">شماره تذکره </label>
                    <input type="number" class="form-control" name="cus_national_id" id="cus_national_id" placeholder="شماره تذکره" />
                </div>

                <div class="form-group">
                    <label for="cus_job">وظیفه</label>
                    <input type="text" class="form-control" name="cus_job" id="cus_job" placeholder="وظیفه مشتری" />
                </div>

                 <div class="form-group">
                    <!-- join date -->
                </div>

                <div class="form-group">
                    <label for="cus_email">ایمیل آدرس</label>
                    <input type="email" class="form-control" name="cus_email" id="cus_email" placeholder="ایمیل آدرس: email@domain.com" />
                </div>

                <div class="form-group">
                    <label for="cus_phones">شماره تماس</label>
                    <input type="text" class="form-control" name="cus_phones" id="cus_phones" placeholder="شماره تماس: 0777181828#0785555555" required/>
                </div>

                <div class="form-group">
                    <label for="cus_site">آدرس وب سایت</label>
                    <input type="text" class="form-control" name="cus_site" id="cus_site" placeholder="وب سایت: www.domain.af" />
                </div>

                <div class="form-group">
                    <label for="cus_picture">عکس</label>
                    <input type="file" name="cus_picture" id="cus_picture"  />
                    <p class="small">حجم فایل باید کمتر از 250 کیلوبایت و ابعاد آن از 400 پیکسل کوچکتر باشد.</p>
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label>تاریخ ثبت</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                        <input type="hidden" id="tarikhAlt" name="cus_join_date" class="form-control pull-right" style="z-index: 0;" >
                    </div>
                    <!-- /.input group -->

                </div>

                <div class="form-group">
                    <label for="cus_org_name">نام شرکت / کمپنی / اداره</label>
                    <input type="text" class="form-control" name="cus_org_name" id="cus_org_name" placeholder="نام شرکت / ارگان / اداره / کمپنی" />
                </div>

                <div class="form-group">
                    <label for="cus_org_place">سکونت اصلی</label>
                    <input type="text" class="form-control" name="cus_org_place" id="cus_org_place" placeholder="محل سکونت اصلی مشتری: ولایت / ولسوالی" />
                </div>

                <div class="form-group">
                    <label for="cus_cur_place">سکونت فعلی</label>
                    <input type="text" class="form-control" name="cus_cur_place" id="cus_cur_place" placeholder="محل سکونت فعلی مشتری: ولایت / ولسوالی" />
                </div>

                <div class="row ">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cus_address">آدرس کامل مشتری</label>
                            <textarea class="form-control" rows="7" name="cus_address" id="cus_address" placeholder="آدرس دقیق و کامل مشتری: ولایت - ولسوالی - ناحیه - منطقه - سرک - کوچه" required/></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                         <div class="form-group">
                            <label for="cus_biography">درباره مشتری</label>
                            <textarea class="form-control" rows="7" name="cus_biography" id="cus_biography" placeholder="اطلاعات شخصی مشتری..." /></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cus_ref_full_name">نام کامل ضامن / معرف</label>
                            <input type="text" class="form-control" name="cus_ref_full_name" id="cus_ref_full_name" placeholder="نام کامل ضامن یا معرف" />
                        </div>

                        <div class="form-group">
                            <label for="cus_ref_phone">شماره تماس ضامن / معرف</label>
                            <input type="text" class="form-control" name="cus_ref_phone" id="cus_ref_phone" placeholder="شماره تماس ضامن یا معرف" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cus_ref_address">آدرس کامل ضامن / معرف</label>
                            <textarea class="form-control" rows="5" name="cus_ref_address" id="cus_ref_address" placeholder="آدرس دقیق ضامن یا معرف مشتری" /></textarea>
                        </div>
                    </div>
                </div>

                 <div class="row">
                     <div class="col-xs-5">
                        <label for="cus_phone">جنسیت: </label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary active">
                                <input type="radio" name="cus_gendar" id="cus_gendar1" value="1" checked /> ذکور
                            </label>
                            <label class="btn btn-primary ">
                                <input type="radio" name="cus_gendar" id="cus_gendar2" value="0" /> اناث
                            </label>
                        </div>
                    </div>

                    <div class="col-xs-7 text-right">
                        <label for="cus_phone">مشتری برای: </label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-warning active">
                                <input type="radio" name="cus_type" id="cus_type1" value="0" checked /> آشپزخانه
                            </label>
                            <label class="btn btn-warning ">
                                <input type="radio" name="cus_type" id="cus_type2" value="1" /> رستورانت
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


</script>
