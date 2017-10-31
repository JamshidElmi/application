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
                <h3 class="box-title">فرم ثبت مصارف روزانه</h3>
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
                                <label for="dex_shop">موجودی صندوق</label>
                                <input type="text" class="form-control" value="<?=$acc_amount; ?>" id="dex_shop" disabled />
                                <input type="hidden" name="acc_amount" value="<?=$acc_amount; ?>" id="acc_amount">
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- row[] -->
                    <div class="input_fields_wrap">
                    <!-- <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="dex_name">نام جنس</label>
                                <input type="text" class="form-control" name="dex_name[]" id="dex_name" placeholder="نام جنس" required/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dex_unit">واحد</label>
                                <select name="dex_unit[]" id="dex_unit" class="form-control" required>
                                    <option value="">واحدات</option>
                                    <?php //units(0) ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dex_count">تعداد</label>
                                <input type="number" class="form-control" name="dex_count_[]" id="dex_count" placeholder="مقدار اولیه به عدد " required/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dex_price">قیمت فی واحد</label>
                                <input type="number" class="form-control" name="dex_price_[]" id="dex_price" placeholder="مقدار اولیه به عدد " required/>
                            </div>
                        </div>
                         <div class="col-sm-3">
                            <div class="form-group">
                                <label for="dex_total_amount">هزینه کل</label>
                                <input type="number" class="form-control" id="dex_total_amount_alt_[]" placeholder="هزینه کل " disabled />
                                <input type="hidden" class="form-control" name="dex_total_amount_[]" id="dex_total_amount"  />
                            </div>
                        </div>
                    </div> -->

                    </div>
                    <!-- row[END] -->


                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-10">
                                <a class="btn btn-primary col-xs-12 add_field_button" id="add_new" data-toggle="tooltip" title="" data-original-title="Add New"><i class="ion-android-add-circle fa-lg"></i></a>
                            </div>
                            <div class="col-xs-2">
                                <a class="btn btn-warning col-xs-12" id="calcolate" data-toggle="tooltip" title="" data-original-title="Sum Total"><i class="ion-calculator fa-lg"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="acc_description">توضیحات / یادداشت</label>
                        <textarea type="number" rows="7" class="form-control" name="tr_desc" id="acc_description" placeholder="توضیحات / یادداشت" /></textarea>
                    </div>


                </div>
                <div class="box-footer">
                    <input type="text" id="sum" value="0" class="form-control col-xs-4 pull-left"><span class="pull-left">مجموع مصارف: </span>
                    <button type="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div> <!-- end col-sm-8 -->

    <div class="col-sm-4">
        <div class="info-box bg-orange">
            <span class="info-box-icon"><i class="ion ion-lock-combination fa-lg"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">صندوق اصلی</span>
                <span class="info-box-number"><?=$acc_amount; ?></span>

                <div class="progress">
                    <div class="progress-bar" style="width: 50%"></div>
                </div>
                <span class="progress-description">60 درصد کاهش</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>


</div>


<script>
// <select name="dex_unit[]" id="myselect[]"  class="form-control" required><option value="">واحدات</option>
//var select ='<div class="col-sm-2">   <div class="form-group">   <label for="dex_unit">واحد</label>   <select name="dex_unit[]" id="myselect[]"  class="form-control" required> <option value="">واحدات</option> <?php //foreach($units as $unit) { echo '<option value="'.$unit->unit_id.'">'.$unit->unit_name.'</option>'; } ?></select>   </div>   </div>';
// var select ='<select name="dex_unit[]" id="myselect[]"  class=" class="col-sm-2 form-control" required> <option value="">واحدات</option> <?php// foreach($units as $unit) { echo '<option value="'.$unit->unit_id.'">'.$unit->unit_name.'</option>'; } ?></select>  ';



$(document).ready(function() {
  var max_fields = 10; //maximum input boxes allowed
  var wrapper = $(".input_fields_wrap"); //Fields wrapper
  var add_button = $(".add_field_button"); //Add button ID
  var x = 0; //initlal text box count
  var sum = parseFloat(0);

  $(add_button).click(function(e) { //on add input button click
    e.preventDefault();
    if (x < max_fields) { //max input box allowed
      x++; //text box increment
    sum = parseFloat(sum) + parseFloat($('#dex_total_amount_alt_'+x).val());
        $(wrapper).append('<div class="row"><div class="col-sm-3">   <div class="form-group">   <label for="dex_name">نام جنس</label>     <input type="text" class="form-control" name="dex_name[]" id="dex_name" placeholder="نام جنس" required/>   </div>    </div>     <div class="col-sm-2">   <div class="form-group">   <label for="dex_unit">واحد</label>   <select name="dex_unit[]" id="myselect[]"  class="form-control" required> <option value="">واحدات</option> <?php foreach($units as $unit) { echo '<option value="'.$unit->unit_id.'">'.$unit->unit_name.'</option>'; } ?></select>   </div>   </div>    <div class="col-sm-2">   <div class="form-group">   <label for="dex_count">تعداد</label>   <input type="number" class="form-control" name="dex_count[]" id="dex_count_'+x+'" placeholder="مقدار اولیه به عدد " required/>   </div>   </div>  <div class="col-sm-2">   <div class="form-group">   <label for="dex_price">قیمت فی واحد</label>   <input type="number" class="form-control" name="dex_price[]" id="dex_price_'+x+'" placeholder="مقدار اولیه به عدد " required/>    </div>   </div>    <div class="col-sm-2">   <div class="form-group">   <label for="dex_total_amount">هزینه کل</label>   <input type="number" class="form-control" id="dex_total_amount_alt_'+x+'" placeholder="هزینه کل " disabled />   <input type="hidden" class="form-control" name="dex_total_amount[]" id="dex_total_amount_'+x+'"  />   </div>   </div>   <a href="#" style="padding-top:30px;" class="remove_field col-xs-1"><i class="ion ion-trash-b text-red fa-lg"></i></a></div>   </div></div>');
          }


      $('#dex_price_'+x).keyup(function(event) {
        var new_amm = $(this).val() * $('#dex_count_'+x).val();
        $('#dex_total_amount_'+x).val(new_amm);
        $('#dex_total_amount_alt_'+x).val(new_amm);


  });




        // sum = parseFloat(sum) + parseFloat($('#dex_total_amount_alt'+x).val());


  });
$('#calcolate').click(function(event) {
    alert(sum);
});


  $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  });


});





$(document).ready(function() {
    // Date Picker
    $('#tarikh').persianDatepicker({
        altField: '#tarikhAlt',
        altFormat: 'X',
        format: 'D/MMMM/YYYY',
        observer: true,
    });
}); // end document
</script>








