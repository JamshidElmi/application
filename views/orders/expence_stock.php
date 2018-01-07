<div class="row">
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">فرم ثبت مصارف از گدام</h3>
                <?php ($this->uri->segment(3))? $this->uri->segment(3) : ''; ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="myform" method="POST" action="<?=site_url('order/insert_stock_expence/'); ?>">

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
                    <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'warning'); }  ?>

                    <div class="row">
                        <div id="kitchen_fields">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="">نام مشتری</label>
                                    <input type="text" class="form-control" id="cus_name" value="<?=($this->uri->segment(4)) ? urldecode($this->uri->segment(4)) : '' ?>" readonly>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="">تخلص مشتری</label>
                                    <input type="text" class="form-control" value="<?=($this->uri->segment(4)) ? urldecode($this->uri->segment(5)) : '' ?>" id="cus_lname" readonly>
                                </div>
                            </div>
                        </div>
                        <div id="resturant_fields" hidden>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>تاریخ</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                                        <input type="hidden" id="dateAlt" name="stock_date" class="form-control pull-right" style="z-index: 0;" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="">هزینه کلی</label>
                                <input type="text" class="form-control" id="ord_price" readonly>
                                <input type="hidden" class="form-control" name="stock_ord_id" value="<?=($this->uri->segment(3)) ?$this->uri->segment(3):'' ?>" id="ord_id" readonly>
                            </div>
                        </div>
                    </div>
                    <br>

                    <!-- row[] -->
                    <div class="input_fields_wrap">
                        <!-- Fields Dynamicly will Added Here -->
                    </div>
                    <!-- row[END] -->

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-10">
                                <button class="btn btn-primary col-xs-12 add_field_button" disabled id="add_new" data-toggle="tooltip" title="" data-original-title="Add New"><i class="ion-android-add-circle fa-lg"></i></button>
                            </div>
                            <div class="col-xs-2">
                                <button  type=button class="btn btn-warning col-xs-12" disabled id="calcolate"  data-toggle="tooltip" title="" data-original-title="Sum Total"><i class="ion-calculator fa-lg"></i></button>
                            </div>
                        </div>
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
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title" style="font-size: 14px" id="list_title"></h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-primary btn-box-tool" id="ketchin" data-toggle="tooltip" data-original-title="Click and Select an Order from list for Kitchen">مصارف آشپزخانه</button>
                    <button class="btn btn-primary btn-box-tool" id="resturant" data-toggle="tooltip" data-original-title="Click Select Stock's Expences for Restuaran">مصارف رستورانت</button>
                    <button class="btn btn-primary btn-box-tool" id="fast_food" data-toggle="tooltip" data-original-title="Click Select Stock's Expences for Fast Food">مصارف فست فود</button>
                </div>

                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" hidden id="box_body">
                <div class="progress active" style="background-color: #e6e6e6;">
                    <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" style="width: 0%"><b></b></div>
                </div>
                <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>


                    <table id="example2" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>تخلص</th>
                            <th>کد اشتراک</th>
                            <th>هزینه کلی</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; foreach ($orders as $customer): ?>
                            <tr>
                                <td><?=$i++;  ?></td>
                                <td><?=$customer->cus_name ?></td>
                                <td><?=$customer->cus_lname ?></td>
                                <td><?=$customer->cus_unique_id ?></td>
                                <td class="text-center"><b><?=$customer->ord_price ?></b> افغانی </td>
                                <td class="text-center">
                                    <a href="#"><span class="label label-success select_order" ord-id="<?=$customer->ord_id ?>" cus-name="<?=$customer->cus_name ?>" cus-lname="<?=$customer->cus_lname ?>" ord-price="<?=$customer->ord_price ?>" data-toggle="tooltip" title="" data-original-title="Use Order"><i class="fa ion-forward fa-lg"></i></span></a>
                                    <a href="<?=site_url('order/stock_expences/'.$customer->ord_id); ?>"><span class="label label-default" data-toggle="tooltip" data-original-title="Stock Expences for this Order"><i class="fa fa-list fa-lg"></i></span></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>تخلص</th>
                            <th>کد اشتراک</th>
                            <th>هزینه کلی</th>
                            <th>عملیات</th>
                        </tr>
                        </tfoot>
                    </table>


                </div>
                <!-- /.box-body -->


            <div class="overlay" id="overlay" style="display: none">
                <i class="fa ion-load-d fa-spin"></i>
            </div>
            <div class="overlay" id="overlay_alt" <?=($this->uri->segment(3)) ? 'style="display:block"' : 'style="display:none"'; ?>>
                <i class="fa fa-exclamation text-gray"></i>
            </div>
        </div>
    </div>
</div>

<script>

    <?php if (($this->uri->segment(3))): ?>
    $('#add_new').attr('disabled', false);
    $('#calcolate').attr('disabled', false);
    <?php endif ?>


    // Generate Dynamic Fields
    $(document).ready(function() {
        var max_fields = 30; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $("#add_new"); //Add button ID
        var x = 0; //initlal text box count
        var sum = parseFloat(0);

        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row"><div class="col-sm-4">   <div class="form-group">   <label for="dex_unit">انتخاب جنس</label>   <select name="stock_st_id[]" id="st_unit_'+x+'"  class="form-control" required> <option value="">انتخاب جنس</option> <?php foreach ($stocks as $stock): ?><option st-price="<?=$stock->st_price ?>" value="<?=$stock->st_id ?>" st_price="<?=$stock->st_price ?>"><?=$stock->st_name?></option><?php endforeach ?></select>   </div>   </div>    <div class="col-sm-3">   <div class="form-group">   <label for="dex_count">تعداد</label>   <input type="number" class="form-control" name="stock_count[]" disabled id="st_count_'+x+'" placeholder="تعداد عدد " required/>   </div>   </div>      <div class="col-sm-3">   <div class="form-group">   <label for="dex_total_amount">هزینه کل</label>   <input type="number" class="form-control" name="stock_total_price[]" id="st_total_price_'+x+'" placeholder="هزینه کل " readonly />     </div>   </div>   <a href="#" style="padding-top:30px;" class="remove_field col-xs-1" ><i class="ion ion-trash-b text-red fa-lg" data-toggle="tooltip" title="" data-original-title="Remove"></i></a></div>   </div></div>');
            }
            $('#st_unit_'+x).change(function () {
                // alert($('#st_unit_'+x+' :selected').attr('st-price'));
                $('#st_count_'+x).attr('disabled', false);
                var st_price = $('#st_unit_'+x+' :selected').attr('st-price');

                $('#st_count_'+x).keyup(function () {
                    var st_total_price = $(this).val() * st_price;
                    $('#st_total_price_'+x).val(st_total_price);
                });

            });
        });

        $('#calcolate').click(function () {
            for(var i=1; i<=x; i++)
            {
                sum +=  parseFloat($('#st_total_price_'+i).val());
            }
//            parseFloat(sum)*parseFloat(100)/parseFloat(acc_amount);
            var persent = parseFloat(sum)*parseFloat(100)/parseFloat($('#ord_price').val());
            $('.progress-bar').css('width',100-Math.round(persent)+'%');
            $('.progress-bar>b').text($('#ord_price').val() - sum+' افغانی ');
            $('#submit').attr('disabled', false);
            $(this).attr('disabled', true);
            $('#add_new').attr('disabled', true);
            $('#ord_price').val(sum);
            $('#ord_price').css('background', '#EFFFB2');
        });


        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    });


    // buttons for inserting detect stock's expences

    /* kitchen Expences */
    $('#ketchin').click(function () {
        $('#box_body').attr('hidden', false);
        $('#list_title').text('لطفاً مصارف گدام را برای آشپزخانه وارد نمائید');

        $('#kitchen_fields').attr('hidden', false);
        $('#resturant_fields').attr('hidden', true);

        $('#add_new').attr('disabled', true);
        $('#calcolate').attr('disabled', true);

        $('#myform').attr('action', '<?= site_url('order/insert_stock_expence/'); ?>');
    });
    /* Resturant Expences */
    $('#resturant').click(function () {
        $('#box_body').attr('hidden', true);
        $('#list_title').text('لطفاً مصارف گدام را برای رستورانت وارد نمائید');

        $('#kitchen_fields').attr('hidden', true);
        $('#resturant_fields').attr('hidden', false);
        $('#ord_price').val('');

        $('#add_new').attr('disabled', false);
        $('#calcolate').attr('disabled', false);

        $('#myform').attr('action', '<?= site_url('order/insert_stock_expence_resturant/resturant'); ?>');
    });
    /* FastFood Expences */
    $('#fast_food').click(function () {
        $('#box_body').attr('hidden', true);
        $('#list_title').text('لطفاً مصارف گدام را برای فست فود وارد نمائید');

        $('#kitchen_fields').attr('hidden', true);
        $('#resturant_fields').attr('hidden', false);
        $('#ord_price').val('');

        $('#add_new').attr('disabled', false);
        $('#calcolate').attr('disabled', false);

        $('#myform').attr('action', '<?= site_url('order/insert_stock_expence_resturant/fast_food'); ?>');
    });



$(document).ready(function() {
    // data table
    $(function () {
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
        })
    });

    $('.select_order').click(function () {
        var ord_id = $(this).attr('ord-id');
        var cus_name = $(this).attr('cus-name');
        var cus_lname = $(this).attr('cus-lname');
        var ord_price = $(this).attr('ord-price');

        $('#ord_id').val(ord_id);
        $('#cus_name').val(cus_name);
        $('#cus_lname').val(cus_lname);
        $('#ord_price').val(ord_price);
        $('.progress-bar>b').text(ord_price+' افغانی');
        $('.progress-bar').css('width', '100%');

        $('#add_new').attr('disabled', false);
        $('#calcolate').attr('disabled', false);
    });

    // date
    $('#tarikh').persianDatepicker({
        altField: '#dateAlt',
        format: 'D MMMM YYYY',
        observer: true,
        altFormat: 'YYYY-MM-DD',
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

}); // end document

</script>