<style>
.small-box h3 {
    font-size: 30px;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
}
</style>
<div class="row">
    <div class="col-md-8">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">فرم ثبت خریداری برای گدام</h3>
                <div class="box-tools pull-right">
                    <a href="<?=site_url('finance/expences'); ?>" class="btn btn-box-tool bg-gray" data-toggle="tooltip" title="" data-original-title="Expences List"><i class="ion-android-list fa-lg"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" id="myForm" action="<?=site_url('finance/insert_expence'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="dex_shop">نام دوکان</label>
                                <input type="text" class="form-control" name="dex_shop"  id="dex_shop" placeholder="نام دوکان"   />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="dex_bill_no">شماره فاکتور</label>
                                <input type="text" class="form-control" name="dex_bill_no"  id="dex_bill_no" placeholder="شماره فاکتور"   />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>تاریخ</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                                    <input type="hidden" id="tarikhAlt" name="dex_date" class="form-control pull-right" style="z-index: 0;" >
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <label>انتخاب همکار</label>
                            <select name="dex_name" id="dex_name" class="form-control">
                                <option value="">انتخاب کنید</option>
                                <?php foreach($accounts as $account)
                                { echo '<option value="'.$account->acc_id.'" acc-amount="'.$account->acc_amount.'">'.$account->acc_name.'</option>'; }
                                ?>
                            </select>
                        </div>
                        </div>

                        <div class="col-sm-3 hidden">
                            <div class="form-group">
                                <label for="dex_shop">موجودی صندوق</label>
                                <!-- <input type="text" class="form-control" value="<?//=$acc_amount; ?>" id="dex_shop" disabled /> -->
                                <input type="hidden" name="acc_amount" value="0" id="acc_amount">
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- row[] -->
                    <div class="input_fields_wrap">
                    <!-- Fields Dynamicly will Added -->
                    </div>
                    <!-- row[END] -->


                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-10">
                                <a class="btn btn-primary col-xs-12 add_field_button" id="add_new" data-toggle="tooltip" title="" data-original-title="Add New"><i class="ion-android-add-circle fa-lg"></i></a>
                            </div>
                            <div class="col-xs-2">
                                <button  type=button class="btn btn-warning col-xs-12" id="calcolate"  data-toggle="tooltip" title="" data-original-title="Sum Total"><i class="ion-calculator fa-lg"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="acc_description">توضیحات / یادداشت</label>
                        <textarea type="number" rows="7" class="form-control" name="dex_desc" id="acc_description" placeholder="توضیحات / یادداشت" /></textarea>
                    </div>


                </div>
                <div class="box-footer">
                    <input type="hidden" name=dex_sum id="sum" value="0" >
                    <input type="text" id="sum_alt" readonly value="0 افغانی" class="form-control col-xs-4 pull-left"><span class="pull-left">مجموع مصارف: </span>
                    <button type="submit" id="submit" disabled="disabled" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div> <!-- end col-sm-8 -->

    <div class="col-sm-4">
        <div id="partner-box" class="info-box bg-green ">
            <span class="info-box-icon"><i class="ion ion-lock-combination fa-lg"></i></span>

            <div class="info-box-content">
                <span class="info-box-text" id="box_acc_name">صندوق اصلی</span>
                <span class="info-box-number"><?//=$acc_amount; ?> افغانی</span>

                <div class="progress" style="height: 5px;">
                    <div id="progress-bar" class="progress-bar" style="width: 100%;"></div>
                </div>
                <span class="progress-description">مصرفی ثبت نشده است</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>


</div>
<!-- <label>واحد جنس</label> <select name="st_name" id="st_name" class="form-control"><option value="">انتخاب کنید</option><?php //foreach($stock_units as $stock_unit){ echo '<option value="'.$stock_unit->st_id.'" st-max-count="'.$stock_unit->st_max_count.'" st-min-count="'.$stock_unit->st_min_count.'" >'.$stock_unit->st_name.'</option>'; }?></select> -->





<script>
// Date Picker
$(document).ready(function() {
    $('#tarikh').persianDatepicker({
        altField: '#tarikhAlt',
        altFormat: 'X',
        format: 'D/MMMM/YYYY',
        observer: true,
    });
}); // end document

$('#dex_name').change(function(event) {
    var text = $("#dex_name option:selected" ).text();
    var value = $("#dex_name option:selected" ).val();
    var acc_amount = $("#dex_name option:selected" ).attr('acc-amount');
    if(acc_amount > 0){
        $('.info-box-number').html(acc_amount+' افغانی موجود');
    }else {
        $('#partner-box').addClass('bg-red').removeClass('bg-green');
        $('.info-box-number').html(acc_amount+' افغانی بدهکار');
    }
    $('#box_acc_name').html(text);

});




// Generate Synamic Fields
$(document).ready(function() {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID
    var x = 0; //initlal text box count
    // var acc_amount = <?php  // echo $acc_amount; ?>;
    var sum = parseFloat(0);

    $(add_button).click(function(e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row"><div class="col-sm-3">   <div class="form-group">   <label>واحد جنس</label> <select name="st_name[]" id="st_name[]" class="form-control"><option value="">انتخاب کنید</option><?php foreach($stock_units as $stock_unit){ echo '<option value="'.$stock_unit->st_id.'" st-unit="'.$stock_unit->st_unit.'" st-max-count="'.$stock_unit->st_max_count.'" st-min-count="'.$stock_unit->st_min_count.'" >'.$stock_unit->st_name.'</option>'; }?></select>   </div>    </div>     <div class="col-sm-2">   <div class="form-group">   <label for="dex_unit">واحد</label>   <input name="dex_unit[]" id="dex_unit[]"  class="form-control" required readonly />   </div>   </div>    <div class="col-sm-2">   <div class="form-group">   <label for="dex_count">تعداد</label>   <input type="number" class="form-control" name="dex_count[]" id="dex_count_'+x+'" placeholder="تعداد عدد " required/>   </div>   </div>  <div class="col-sm-2">   <div class="form-group">   <label for="dex_price">قیمت فی واحد</label>   <input type="number" class="form-control" name="dex_price[]" id="dex_price_'+x+'" placeholder="قیمت عدد" required/>    </div>   </div>    <div class="col-sm-2">   <div class="form-group">   <label for="dex_total_amount">هزینه کل</label>   <input type="number" class="form-control" id="dex_total_amount_alt_'+x+'" placeholder="هزینه کل " disabled />   <input type="hidden" class="form-control" name="dex_total_amount[]" id="dex_total_amount_'+x+'"  />   </div>   </div>   <a href="#" style="padding-top:30px;" class="remove_field col-xs-1" ><i class="ion ion-trash-b text-red fa-lg" data-toggle="tooltip" title="" data-original-title="Remove"></i></a></div>   </div></div>');
        }
        $('#dex_price_'+x).keyup(function(event) {
            var new_amm = $(this).val() * $('#dex_count_'+x).val();
            $('#dex_total_amount_'+x).val(new_amm);
            $('#dex_total_amount_alt_'+x).val(new_amm);
        });


        $('#st_name'+x).change(function(event) {
            alert('jimi');
        });








        $('#calcolate').attr('disabled', false);
    });
    $('#calcolate').click(function(event) {
        for(var i=1; i<=x; i++)
        {
            sum +=  parseFloat($('#dex_total_amount_'+i).val());
        }
        $('.remove_field').css('display', 'none');
        $('#sum').val(sum);
        $('#sum_alt').val(sum+' افغانی');
        $('#submit').attr('disabled', false);
        var persentage = parseFloat(sum)*parseFloat(100)/parseFloat(acc_amount);
        $('.info-box-number').html(acc_amount-sum+' افغانی باقیمانده');
        sum = 0;
        $('.progress-description').html(persentage+' درصد کاهش از صندوق');
        $('#progress-bar').css('width', 100-persentage+'%');
    });
    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
});


</script>








