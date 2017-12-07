<div class="row">
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت سفارش برای رستورانت</h3>
                <div class="box-tools pull-right">
                    <a href="<?=site_url('order/resturant_orders'); ?>" class="btn btn-box-tool bg-gray"  data-toggle="tooltip" title="" data-original-title="Order List"><i class="fa fa-list-ul fa-lg"></i></a>
                </div>

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $bm_id = (isset($bm->bm_id))?$bm->bm_id:'' ?>
            <form role="form" method="POST" action="<?=site_url('order/insert_resturant_order/'); ?>">

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
                    <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'warning'); }  ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group"><label for="ord_cus_id">انتخاب مشتری</label><select name="ord_cus_id" id="ord_cus_id" class="form-control"><option value="<?=base_account()->acc_id ?>_">انتخاب کنید</option><?php foreach ($customers as $customer): ?><option cus-acc-id="<?=$customer->cus_acc_id ?>" value="<?=$customer->cus_id ?>"><?=$customer->cus_name .' '.$customer->cus_lname ?></option><?php endforeach ?></select></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="bm_cat_id">انتخاب میز</label>
                                <select name="ord_desk_id" id="ord_desk_id" class="form-control">
                                    <option>انتخاب کنید</option>
                                    <?php foreach ($desks as $desk): ?>
                                        <option value="<?=$desk->desk_id ?>"><?=$desk->desk_name .' ('.$desk->desk_capacity.')' ?></option>
                                    <?php endforeach ?>
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
                                <label>هزینه کلی</label>
                                <div class="input-group date">
                                    <input type="number" name="ord_price" type="text" class="form-control" id="total_amount" value="0" readonly />
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
                                    <input type="number" type="text" name="tr_amount" id="tr_amount" class="form-control" />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>باقیمانده</label>
                                <div class="input-group date">
                                    <input type="number" name="remain" id="remain" class="form-control"  value="0" readonly />
                                    <div class="input-group-addon">افغانی</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ord_desc">توضیحات</label>
                        <textarea rows="5" class="form-control" name="ord_desc" id="ord_desc"  ></textarea>
                    </div>

                    <div id="order_list" class="text-muted text-center well well-sm"><b>از لیست منو انتخاب نمائید.</b></div>
                    <div id="order_inputs"></div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>


    <div class="col-sm-7">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست منو های رستورانت </h3>
                <div class="box-tools pull-right">
                    <select name="menu_category" id="menu_category" class="form-control input-sm" style="border-radius: 3px; box-shadow: inset 0 0 6px 0px #616161;">
                        <option value="0">انتخاب نوعیت منو</option>
                        <?php foreach ($menu_categories as $menu_category): ?>
                            <option value="<?=$menu_category->mc_id ?>"><?=$menu_category->mc_name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="selection-msg" class="well text-warning well-sm text-center"><p><i class="ion ion-clipboard " style="font-size: 35px"></i></p>لطفاً یکی از نوعیت منو را انتخاب کنید.</div>
                <div class="msg" hidden><?=alert("برای این نوع منو زیر منوئی ثبت نشده است.", 'warning'); ?></div>
                <ul class="users-list clearfix" id="menu_list"></ul>
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

    $('#tr_amount').keyup(function(event) {
        var ord_price = $('#total_amount').val();
        var tr_amount = $(this).val();
        var remain = parseFloat(ord_price) - parseFloat(tr_amount);
        $('#remain').val(remain);
    });


    $('#menu_category').change(function(event) {
        // alert($('#menu_category :selected').text());
        var mc_id = $('#menu_category :selected').val();
        var urls = '<?php echo base_url().'order/jq_menu_list/' ?>' + mc_id;

        $(document).ajaxStart(function(){
            $(".overlay").css('display','block');
        });
        $.ajax({
            type: "POST",
            url: urls,
            dataType: "html",
            success: function(response){
                $("#menu_list").html(response);
                $('.msg').attr('hidden', true);


                // btn add(+) is clicked
                $('.btn_add').click(function(event) {
                    var id = $(this).attr('bm-id');
                    var price = $(this).attr('bm-price');
                    var pic = $(this).attr('menu-pic');

                    // create input or sum input value
                    if ($("#order_"+id).length) {
                         // alert('order_'+id);
                         var value = $("#order_"+id).val();
                         var new_val = parseInt(value) + 1;
                         $("#order_"+id).val(new_val);
                         $('#count_'+id).html(new_val);

                        var v_count = $('#order_'+id).val();
                        var v_price = $('#price_'+id).val();


                        var sord_total = v_count * v_price ;
                        var total = 1 * v_price ;
                        var curr_total = $('#total_amount').val();
                        // alert(curr_total);

                        total = total + parseFloat(curr_total);
                        $('#sord_price_'+id).val(sord_total);
                        $('#total_amount').val(total);
                        $('#ord_discount').attr('ord-price',total); //

                    }
                    else{
                        $('#order_inputs').append('<input type="hidden" name="sord_count[]" id="order_'+id+'" value="1"/>');
                        $('#order_inputs').append('<input type="hidden" name="sord_bm_id[]" value="'+id+'" id="id_'+id+'" />');
                        $('#order_inputs').append('<input type="hidden" name="sord_price[]" value="0" id="sord_price_'+id+'" />');
                        $('#order_inputs').append('<input type="hidden" name="bm_price[]" value="'+price+'" id="price_'+id+'" /><div class="clear-fix">');
                        $('#order_list').append('<a href="" class="btn-app" style="border: 0; background: none;"><span class="badge bg-green" id="count_'+id+'">1</span><img width="40" id="pic_'+id+'" class="img-thumbnail" src="<?php echo site_url().'assets/img/menus/' ?>'+pic+' " alt=""></a>');
                        $('#order_list>b').remove();

                        var v_count = $('#order_'+id).val();
                        var v_price = $('#price_'+id).val();

                        var curr_total = $('#total_amount').val();
                        // alert(curr_total);
                        var total = v_count * v_price;
                        var sord_total = v_count * v_price ;
                        total = parseFloat(total) + parseFloat(curr_total);
                        $('#sord_price_'+id).val(sord_total);
                        $('#total_amount').val(total);
                    }


                });

                // btn minus(-) is clicked
                $('.btn_minus').click(function(event) {
                    var id = $(this).attr('bm-id');
                    var price = $(this).attr('bm-price');
                    var pic = $(this).attr('menu-pic');


                    if ($("#order_"+id).length) {
                        // alert('order_'+id);
                        var value = $("#order_"+id).val();
                        var new_val = parseInt(value) - 1;
                        $("#order_"+id).val(new_val);
                        $('#count_'+id).html(new_val);


                        var v_count = $('#order_'+id).val();
                        var v_price = $('#price_'+id).val();

                        var sord_total = $('#sord_price_'+id).val() - v_price ;
                        var total = $('#total_amount').val() - v_price ;
                        var curr_total = $('#total_amount').val();
                        // alert(curr_total);

                        $('#sord_price_'+id).val(sord_total);
                        $('#total_amount').val(total);
                        $('#ord_discount').attr('ord-price',total); //

                        if(new_val == 0)
                        {
                            $("#order_"+id).remove();
                            $('#count_'+id).remove();
                            $('#price_'+id).remove();
                            $('#id_'+id).remove();
                            $('#pic_'+id).remove();
                            $('#sord_price_'+id).remove();
                        }
                    }
                });

                // alert(response);
                if(response == ''){
                    $('.msg').attr('hidden', false);
                }
            }
        });
        $(document).ajaxStop(function(){
            $(".overlay").css('display','none');
            $('#selection-msg').attr('hidden', true);
        });

    });

    $('#ord_discount').change(function () {
        var ord_discount = $('#ord_discount :selected').val();
        var ord_price = $('#ord_discount').attr('ord-price');
        var discount = ord_discount / 100 * ord_price;
        var ord_price = ord_price - discount;
        $('#total_amount').val(ord_price);
        $('#menu_list').html('');
        $('#selection-msg').attr('hidden', false);
        $('#menu_category').attr('disabled', true);


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
        }
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
        onlyTimePicker: true
    });

});

</script>