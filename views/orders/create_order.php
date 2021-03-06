<div class="row">
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت سفارش برای آشپزخانه</h3>
                <div class="box-tools pull-right">
                    <a href="<?= site_url('order/kitchen_orders'); ?>" class="btn btn-box-tool bg-gray" data-toggle="tooltip" title="" data-original-title="Order List"><i class="fa fa-list-ul fa-lg"></i></a>
                    <a href="" data-toggle="modal" data-target="#create_account" class="btn btn-box-tool bg-green" data-toggle="tooltip" title="" data-original-title="Create Customer"><i class="fa ion-person-add fa-lg"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $bm_id = (isset($bm->bm_id)) ? $bm->bm_id : '' ?>
            <form role="form" method="POST" action="<?= site_url('order/insert_kitchen_order/'); ?>">

                <div class="box-body">
                    <?php if ($this->session->form_errors) {
                        echo alert($this->session->form_errors, 'danger');
                    } ?>
                    <?php if ($this->session->form_success) {
                        echo alert($this->session->form_success, 'success');
                    } ?>
                    <?php if ($this->session->file_errors) {
                        echo alert($this->session->file_errors, 'warning');
                    } ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <label>انتخاب مشتری</label>
                            <div class="form-group">
                                <select name="bm_cat_id" id="bm_cat_id" class="form-control select2" style="width: 100%;border-radius: 0" required>
                                    <option value="">انتخاب کنید</option><?php foreach ($customers as $customer): ?>
                                        <option cus-acc-id="<?= $customer->cus_acc_id ?>" value="<?= $customer->cus_id ?>"><?= $customer->cus_name . ' ' . $customer->cus_lname ?>
                                        <span>(<?= $customer->cus_unique_id ?>)</span></option><?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>تاریخ</label>
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;width: 100%" readonly>
                                    <input type="hidden" id="dateAlt" name="ord_date" class="form-control pull-right" style="z-index: 0;">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>زمان</label>
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa ion-clock fa-lg"></i></div>
                                    <input type="text" id="time" class="form-control pull-right" style="z-index: 0;" readonly>
                                    <input type="hidden" id="timeAlt" name="ord_time" class="form-control pull-right" style="z-index: 0;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>قیمت فی غوری</label>
                                <div class="input-group date">
                                    <input type="text" id="bm_price" name="bm_price" class="form-control" readonly />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>تعداد</label>
                                <div class="input-group date">
                                    <input type="number" name="sord_count" id="ord_count" class="form-control" readonly required />
                                    <div class="input-group-addon">نفر</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>قیمت مجموعی </label>
                                <div class="input-group date">
                                    <input type="text" id="ord_price" name="ord_price" class="form-control" style="display: none" readonly  />
                                    <input type="number" id="total_ext_charges" class="form-control" readonly required value="0" />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>تخفیف </label>
                                <select name="ord_discount" id="ord_discount" class="form-control" ord-price="">
                                    <option value="">انتخاب تخفیف</option>
                                    <?php foreach ($discounts as $discount) : ?>
                                        <option value="<?= $discount->disc_persent ?>"><?= $discount->disc_name ?>
                                            (<?= round($discount->disc_persent) ?>%)
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>مصارف متفرقه </label>
                        <div class="input-group date">

                            <input type="number" step="0.1" id="ord_ext_charges" name="ord_ext_charges" class="form-control" value="0" />
                            <div class="input-group-addon">افغانی</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>مقدار پرداختی</label>
                                <div class="input-group date">
                                    <input type="number" id="tr_amount" name="tr_amount" class="form-control" readonly required />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>باقیمانده</label>
                                <div class="input-group date">
                                    <input type="number" id="remain" name="tr_remain" class="form-control" readonly />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="ord_desc">توضیحات</label>
                        <textarea rows="5" class="form-control" name="ord_desc" id="ord_desc"></textarea>
                    </div>

                    <div class=" hidden">
                        <input type="text" name="ord_cus_id" id="ord_cus_id" placeholder="ord_cus_id">
                        <input type="text" name="sord_bm_id" id="sord_bm_id" placeholder="sord_bm_id">
                        <input type="text" name="ord_created_date" id="ord_created_date" placeholder="ord_created_date">
                        <div id="sm_order"></div>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-success" disabled>ذخیره <i class="fa fa-save"></i></button>
                    <button type="submit" name="submit_print" id="submit_print" class="btn btn-info" disabled><i class="fa fa-save"></i> ذخیره و چاپ <i class="fa fa-print"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>





















    <!-- Modal -->
    <div id="create_account" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title no-margin">ثبت مشتری جدید</h4>
                </div>
                <form role="form" method="POST" action="<?=site_url('customer/ordering_insert/create_order'); ?>" enctype="multipart/form-data" >
                    <div class="modal-body">


                    <div class="row">
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-xs-7">
                                    <div class="form-group">
                                        <label for="cus_name">نام مشتری</label>
                                        <input type="text" class="form-control" name="cus_name" id="cus_name" placeholder="نام" required/>
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="form-group">
                                        <label for="cus_unique_id">کد اشتراک</label>
                                        <input type="text" class="form-control text-center" style="font-family: Segoe; background-color: #FFF9A8;" name="cus_unique_id" value="<?=$uniqee_id ?>" id="cus_unique_id" placeholder="کد منحصر به فرد برای مشتری" required readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cus_lname">تخلص مشتری</label>
                                <input type="text" class="form-control" name="cus_lname" id="cus_lname" placeholder="تخلص" required/>
                            </div>


                            <div class="form-group">
                                <label for="cus_phones">شماره تماس</label>
                                <input type="text" class="form-control" name="cus_phones" id="cus_phones" placeholder="شماره تماس: 0777181828#0785555555" required/>
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
                                    <input type="text" id="tarikh_acc" class="form-control pull-right" style="z-index: 0;" readonly>
                                    <input type="hidden" id="tarikh_accAlt" name="cus_join_date" class="form-control pull-right" style="z-index: 0;" >
                                </div>
                                <!-- /.input group -->

                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="cus_address">آدرس کامل مشتری</label>
                                        <textarea class="form-control" rows="5" name="cus_address" id="cus_address" placeholder="آدرس دقیق و کامل مشتری: ولایت - ولسوالی - ناحیه - منطقه - سرک - کوچه" required/></textarea>
                                    </div>
                                </div>
                            </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="cus_phone">جنسیت: </label> &nbsp;
                                    <div id="radios" class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" name="cus_gendar" id="cus_gendar1" value="1" checked /> ذکور
                                        </label>
                                        <label class="btn btn-primary ">
                                            <input type="radio" name="cus_gendar" id="cus_gendar2" value="0" /> اناث
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <label for="cus_phone">مشتری برای: </label> &nbsp;
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
                        </div>




                        </div> <!--div.col-6-->

                    </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">بستن <i class="fa fa-close"></i></button>
                    </div>
                </form>

            </div>
        </div>
    </div>





















    <div class="col-sm-7">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست منو های آشپزخانه </h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-box-tool" data-toggle="modal" data-target="#choose_menu_modal">منوی انتخابی</a>
                    <a href="<?= site_url('menu/kitchen_menus'); ?>" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Add or Edit  Menu"><i class="fa fa-plus"></i></a>

                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg" hidden><?= alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>


                <ul class="users-list clearfix">

                    <?php foreach ($bm as $base_menu): ?>
                        <li id="bm_<?= $base_menu->bm_id ?>">
                            <img width="100" class="img-thumbnail" src="<?= site_url('assets/img/menus/' . $base_menu->bm_picture); ?>">
                            <a class="users-list-name" href="#" style="margin-bottom: 10px" data-toggle="tooltip" title="" data-original-title="<?= $base_menu->bm_desc ?>"><?= $base_menu->bm_name ?></a>
                            <!-- <a class="btn bg-gray btn-xs select-menu-disabled" disabled><span  data-toggle="tooltip" title="" data-original-title="Use"><i class="fa ion-ios-redo fa-lg fa-lg"></i></span></a> -->
                            <a class="btn bg-orange btn-xs" data-toggle="modal" data-target="#modal-<?= $base_menu->bm_id ?>"><span data-toggle="tooltip" data-original-title="Show Sub Menus" id="<?= $base_menu->bm_id ?>" title="" data-original-title="choose">&nbsp;&nbsp;&nbsp;<i class="fa ion-clipboard fa-lg"></i>&nbsp;&nbsp;&nbsp;</span></a>
                        </li>
                        <div class="modal fade modal-warning" id="modal-<?= $base_menu->bm_id ?>">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><?= $base_menu->bm_name ?></h4>
                                    </div>
                                    <div class="modal-body">

                                        <table class="table table-bordered table-responsive">
                                            <tbody>
                                            <tr class="bg-primary">
                                                <th>#</th>
                                                <th>زیر منو</th>
                                                <th> قیمت</th>
                                                <th>توضیحات</th>
                                                <th>عملیات</th>
                                            </tr>
                                            <?php $i = 1;
                                            $sm_total_price = 0;
                                            foreach ($base_sub_menu as $sub_menu): ?>
                                                <?php if ($sub_menu->sbm_bm_id == $base_menu->bm_id): ?>
                                                    <tr class="tr_sm_id<?= $base_menu->bm_id ?>" id="sm_<?= $sub_menu->sbm_id ?>" sm-id="<?= $sub_menu->sm_id ?>">

                                                        <td><?= $i++ ?></td>
                                                        <td><strong><?= $sub_menu->sm_name ?></strong></td>
                                                        <td><strong><?= $sub_menu->sm_price ?> افغانی </strong></td>
                                                        <td><?= $sub_menu->sm_desc ?></td>
                                                        <td class="text-center">
                                                            <a href="#" data-toggle="tooltip" data-original-title="Remove" onclick="
                                                                    $('#total_<?= $base_menu->bm_id ?>').val($('#total_<?= $base_menu->bm_id ?>').val() - $(this).attr('price-sm'));
                                                                    $('#sm_<?= $sub_menu->sbm_id ?>').remove();
                                                                    "
                                                               id="sm_id_<?= $sub_menu->sm_id ?> " price-sm="<?= $sub_menu->sm_price ?>"><span class="ion-android-delete fa-lg text-red remove-sm"></span></a>
                                                        </td>
                                                    </tr>

                                                    <?php $sm_total_price += $sub_menu->sm_price ?>

                                                <?php endif ?>
                                            <?php endforeach ?>
                                            </tbody>
                                        </table>


                                    </div>
                                    <div class="modal-footer">
                                        <div class="col-xs-6 pull-left">
                                            مجموعه:
                                            <input type="text" id="total_<?= $base_menu->bm_id ?>" value="<?= $sm_total_price ?>" class="form-control input-sm col-xs-8 pull-left" readonly>
                                        </div>
                                        <button type="button" class="btn btn-success select-menu" data-dismiss="modal" onclick="$('.tr_sm_id<?= $base_menu->bm_id ?>').each(function() { var id = $(this).attr('sm-id');  $('#sm_order').append('<input type=text name=sord_sm_id[] value='+id+' />'); }); $('#sord_bm_id').val(<?= $base_menu->bm_id ?>); $('#overlay_alt').css('display', 'block'); $('#bm_price').val($('#total_<?= $base_menu->bm_id ?>').val()); " bm-price="<?= $sm_total_price ?>">
                                            انتخاب منو <i class="fa ion-ios-redo fa-lg fa-lg"></i></button>
                                        <button type="button" class="btn btn-danger " data-dismiss="modal">بستن
                                            <i class="fa fa-close"></i></button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    <?php endforeach ?>
                </ul>
    
    
    
    
                <div class="modal fade modal-warning" id="choose_menu_modal">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">منوی انتخابی</h4>
                            </div>
                            <div class="modal-body">
                    
                                <table class="table table-bordered table-responsive">
                                    <tbody>
                                    <tr class="bg-primary">
                                        <th>#</th>
                                        <th>زیر منو</th>
                                        <th> قیمت</th>
                                        <th>توضیحات</th>
                                        <th>عملیات</th>
                                    </tr>
                                    <?php $i = 1;
                                    $sm_total_price = 0;
                                    foreach ($all_sub_menus as $sub_menu): ?>
                                        
                                        <tr class="tr_sm_id<?//= $base_menu->bm_id ?>" id="sm_<?//= $sub_menu->sbm_id ?>" sm-id="<?= $sub_menu->sm_id ?>">
                                
                                            <td><?= $i++ ?></td>
                                            <td><strong><?= $sub_menu->sm_name ?></strong></td>
                                            <td><strong><?= $sub_menu->sm_price ?> افغانی </strong></td>
                                            <td><?= $sub_menu->sm_desc ?></td>
                                            <td class="text-center"><input type="checkbox" id="sm_check_<?=$sub_menu->sm_id?>" sm-price="<?=$sub_menu->sm_price?>" onclick="
                                                $('#sm_order').append('<input type=text name=sord_sm_id[] value=<?=$sub_menu->sm_id?> />');
                                                var total = parseFloat($('#total_choose_input').val()) + parseFloat($(this).attr('sm-price'));
                                                $('#total_choose_input').val(total);
                                                $('#sm_check_<?=$sub_menu->sm_id?>').attr('disabled', true);
                                              
                                            " /></td>
                                        </tr>
                            
                                        <?php //$sm_total_price += $sub_menu->sm_price ?>
                                        
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                
                
                            </div>
                            <div class="modal-footer">
                                <div class="col-xs-6 pull-left">
                                    مجموعه:
                                    <input type="text" id="total_choose_input" value="<?= $sm_total_price ?>" class="form-control input-sm col-xs-8 pull-left" readonly>
                                </div>
                                <button type="button" class="btn btn-success select-menu" data-dismiss="modal" onclick=" $('#sord_bm_id').val(<?= $base_menu->bm_id ?>); $('#overlay_alt').css('display', 'block'); $('#bm_price').val($('#total_choose_input').val()); " bm-price="<?= $sm_total_price ?>">
                                    انتخاب منو <i class="fa ion-ios-redo fa-lg fa-lg"></i></button>
                                <button type="button" class="btn btn-danger " data-dismiss="modal">بستن
                                    <i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                
                
                
                
                

            </div>
            <!-- /.box-body -->
            <div class="overlay" id="overlay" style="display: none;">
                <i class="fa ion-load-d fa-spin"></i>
            </div>
            <div class="overlay" id="overlay_alt" style="display: none;">
                <i class="fa fa-check-square-o text-green" style="font-size: 80px;opacity: .4;"></i>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('.set_menu').click(function (event) {
            var menu_id = $(this).attr('id');
            var menu_peice = $(this).attr('id');
        });

        $('#ord_count').keyup(function (event) {
            var ord_count = $(this).val();
            var bm_price = $('#bm_price').val();
            var ord_price = parseFloat(ord_count) * parseFloat(bm_price);
            $('#ord_price').val(ord_price);
            $('#total_ext_charges').val(ord_price);
            $('#ord_discount').attr('ord-price', ord_price);
        });

        $('#ord_ext_charges').keyup(function (event) {
            var ord_ext_charges = $(this).val();
            var ord_price = parseFloat($('#ord_price').val()) + parseFloat(ord_ext_charges);
            $('#total_ext_charges').val(ord_price);
            if(ord_ext_charges == 0 || ord_ext_charges == '')
            {
                $('#total_ext_charges').val($('#ord_price').val());
            }
        });

        $('.select-menu').click(function (event) {
            $('#submit').attr('disabled', false);
            $('#submit_print').attr('disabled', false);
        });

        $('#tr_amount').keyup(function (event) {
            var ord_price = $('#total_ext_charges').val();
            var tr_amount = $(this).val();
            var remain = parseFloat(ord_price) - parseFloat(tr_amount);
            $('#remain').val(remain);
        });

        $('#ord_discount').change(function () {
            var ord_discount = $('#ord_discount :selected').val();
            var ord_price = $('#ord_discount').attr('ord-price');
            var discount = ord_discount / 100 * ord_price;
            var ord_price = ord_price - discount;
            $('#ord_price').val(ord_price);
            $('#total_ext_charges').val(ord_price);
            $('#ord_count').attr('readonly', true);

        });

        // date
        $('#tarikh').persianDatepicker({
            altField: '#dateAlt',
            format: 'D MMMM YYYY',
            observer: true,
            altFormat: 'YYYY-MM-DD',
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
        // Genrate Created Date
        $('#ord_created_date').val($('#dateAlt').val());

        // time
        $('#time').persianDatepicker({
            altField: '#timeAlt',
            format: 'HH:mm',
            observer: true,
            altFormat: 'HH:mm',
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
            },
            onlyTimePicker: true
        });
    });

    // account date
    $('#tarikh_acc').persianDatepicker({
        altField: '#tarikh_accAlt',
        format: 'D/MMMM/YYYY',
        observer: true,
        altFormat: 'YYYY-MM-DD',
        position: [-65,200],
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

    $('.select2').select2();

    $('#bm_cat_id').change(function () {
//        var cus_acc_id = $('#bm_cat_id :selected').attr('cus-acc-id');
        var cus_id = $('#bm_cat_id :selected').val();
        $('#ord_cus_id').val(cus_id);
        $('#ord_count').attr('readonly', false);
        $('#tr_amount').attr('readonly', false);
    });


</script>