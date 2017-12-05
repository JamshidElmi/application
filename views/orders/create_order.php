<div class="row">
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت سفارش برای آشپزخانه</h3>
                <div class="box-tools pull-right">
                    <a href="<?=site_url('order/kitchen_orders'); ?>" class="btn btn-box-tool bg-gray"  data-toggle="tooltip" title="" data-original-title="Order List"><i class="fa fa-list-ul fa-lg"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $bm_id = (isset($bm->bm_id))?$bm->bm_id:'' ?>
            <form role="form" method="POST" action="<?=site_url('order/insert_kitchen_order/'); ?>">

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
                    <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'warning'); }  ?>

                    <div class="form-group"><label for="bm_cat_id">انتخاب مشتری</label><select name="bm_cat_id" id="bm_cat_id" class="form-control" required><option value="">انتخاب کنید</option><?php foreach ($customers as $customer): ?><option cus-acc-id="<?=$customer->cus_acc_id ?>" value="<?=$customer->cus_id ?>"><?=$customer->cus_name .' '.$customer->cus_lname ?></option><?php endforeach ?></select></div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>تاریخ</label>
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                                    <input type="hidden" id="dateAlt" name="ord_date" class="form-control pull-right" style="z-index: 0;" >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>زمان</label>
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa ion-clock fa-lg"></i></div>
                                    <input type="text" id="time" class="form-control pull-right" style="z-index: 0;" readonly>
                                    <input type="hidden" id="timeAlt" name="ord_time" class="form-control pull-right" style="z-index: 0;" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>قیمت فی خوراک</label>
                                <div class="input-group date">
                                    <input type="text" id="bm_price" name="bm_price" class="form-control" readonly/>
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>تعداد</label>
                                <div class="input-group date">
                                    <input type="number" name="sord_count" id="ord_count" class="form-control" readonly />
                                    <div class="input-group-addon">سرویس</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>قیمت مجموعی </label>
                                <div class="input-group date">
                                    <input type="text" id="ord_price" name="ord_price" class="form-control" readonly/>
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>تخفیف </label>
                                <select name="ord_discount" id="ord_discount" class="form-control" ord-price="">
                                    <?php foreach ($discounts as $discount) : ?>
                                        <option value="<?=$discount->disc_persent ?>"><?=$discount->disc_name ?> (<?=round($discount->disc_persent) ?>%)</option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>مقدار پرداختی</label>
                                <div class="input-group date">
                                    <input type="number" id="tr_amount" name="tr_amount" class="form-control" readonly />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>باقیمانده</label>
                                <div class="input-group date">
                                    <input type="number"  id="remain" class="form-control" readonly />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="ord_desc">توضیحات</label>
                        <textarea rows="5" class="form-control" name="ord_desc" id="ord_desc"  ></textarea>
                    </div>

                    <div class="">
                        <input type="hidden" name="ord_cus_id" id="ord_cus_id">
                        <input type="hidden" name="sord_bm_id" id="ord_bm_id">
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-success" disabled>ذخیره <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>


    <div class="col-sm-7">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست منو های آشپزخانه </h3>
                <div class="box-tools pull-right">
                    <a href="<?=site_url('menu/kitchen_menus'); ?>" class="btn btn-box-tool"  data-toggle="tooltip" title="" data-original-title="Add or Edit  Menu"><i class="fa fa-plus"></i></a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>


                    <ul class="users-list clearfix">

                        <?php foreach ($bm as $base_menu): ?>
                            <li id="bm_<?=$base_menu->bm_id ?>" >
                                <img width="100" class="img-thumbnail" src="<?=site_url('assets/img/menus/'.$base_menu->bm_picture); ?>" >
                                <a class="users-list-name" href="#" style="margin-bottom: 10px" data-toggle="tooltip" title="" data-original-title="<?=$base_menu->bm_desc ?>"><?=$base_menu->bm_name ?></a>
                                <!-- <a class="btn bg-gray btn-xs select-menu-disabled" disabled><span  data-toggle="tooltip" title="" data-original-title="Use"><i class="fa ion-ios-redo fa-lg fa-lg"></i></span></a> -->
                                <a class="btn bg-green btn-xs select-menu" id="<?=$base_menu->bm_id ?>" bm-price="<?=$base_menu->bm_price ?>" ><span title="" data-original-title="Use"><i class="fa ion-ios-redo fa-lg fa-lg"></i></span></a>
                                <a class="btn bg-orange btn-xs" data-toggle="modal" data-target="#modal-<?=$base_menu->bm_id ?>" ><span id="<?=$base_menu->bm_id ?>"  title="" data-original-title="choose"><i class="fa ion-clipboard fa-lg"></i></span></a>
                            </li>
                            <div class="modal fade" id="modal-<?=$base_menu->bm_id ?>">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><?=$base_menu->bm_name ?></h4>
                                        </div>
                                        <div class="modal-body">

                                            <table class="table">
                                                <tbody>
                                                    <tr class="bg-gray">
                                                        <th>#</th>
                                                        <th>زیر منو </th>
                                                        <th>توضیحات</th>
                                                    </tr>
                                                    <?php $i = 1; foreach ($base_sub_menu as $sub_menu): ?>
                                                        <?php  if ($sub_menu->sm_bm_id == $base_menu->bm_id): ?>
                                                             <tr>
                                                                <td><?=$i++ ?></td>
                                                                <td><strong><?=$sub_menu->sm_name ?></strong></td>
                                                                <td><?=$sub_menu->sm_desc ?></td>
                                                            </tr>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger " data-dismiss="modal">بستن</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        <?php endforeach ?>
                    </ul>


                </div>
                <!-- /.box-body -->
            <div class="overlay" id="overlay" style="display: none;">
                <i class="fa ion-load-d fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $('.set_menu').click(function(event) {
        var menu_id = $(this).attr('id');
        var menu_peice = $(this).attr('id');
        }
    );

    $('#bm_cat_id').change(function () {
        var cus_acc_id = $('#bm_cat_id :selected').attr('cus-acc-id');
        var cus_id = $('#bm_cat_id :selected').val();
        $('#ord_cus_id').val(cus_id);
        $('#ord_count').attr('readonly', false);
        $('#tr_amount').attr('readonly', false);
    });

    $('#ord_count').keyup(function(event) {
        var ord_count = $(this).val();
        var bm_price = $('#bm_price').val();
        var ord_price = parseFloat(ord_count) * parseFloat(bm_price);
        $('#ord_price').val(ord_price);
        $('#ord_discount').attr('ord-price', ord_price);
    });

    $('.select-menu').click(function(event) {
       $('#ord_bm_id').val($(this).attr('id'));
       $('#bm_price').val($(this).attr('bm-price'));
       $('#submit').attr('disabled', false);

    });

    $('#tr_amount').keyup(function(event) {
        var ord_price = $('#ord_price').val();
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
    });



    // date
    $('#tarikh').persianDatepicker({
        altField: '#dateAlt',
        format: 'D MMMM YYYY',
        observer: true,

        altFormat: 'YYYY-MM-DD',
        observer: true,
        position: [-67,200],
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

    // time
    $('#time').persianDatepicker({
        altField: '#timeAlt',
        format: 'HH:mm',
        observer: true,

        altFormat: 'HH:mm',
        observer: true,
        position: [-67,200],
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
        onlyTimePicker: true,
    });



});

</script>