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
    <div class="col-md-10">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">فرم ویرایش مصارف </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" id="myForm" action="<?=site_url('finance/update_expence/'.$expence->dex_id.'/'.$expence->dex_bill_id); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <!-- row[] -->
                    <div class="input_fields_wrap">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="dex_name">نام جنس</label>
                                <?php if ($expence->dex_st_unit == null): ?>
                                    <input type="text" class="form-control" value="<?=$expence->dex_name; ?>" name="dex_name" id="dex_name" placeholder="نام جنس" required/>
                                <?php else: ?>
                                    <select name="dex_name" id="dex_st_unit" class="form-control" >
                                        <option value="<?=$expence->dex_st_unit; ?>" st-unit-name="<?php foreach ($stock_units as $stock_unit){ if($stock_unit->st_id == $expence->dex_st_unit) {echo $stock_unit->unit_name;} } ?>"
                                        st-unit="<?=$expence->dex_unit ?>" ><?=$expence->dex_name; ?></option>
                                        <?php foreach ($stock_units as $stock_unit): ?>
                                                <option value="<?=$stock_unit->st_id ?>" st-max-count="<?=$stock_unit->st_max_count ?>" st-unit-name="<?=$stock_unit->unit_name ?>" st-unit="<?=$stock_unit->st_unit ?>"><?=$stock_unit->st_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dex_unit">واحد</label>
                                <?php if ($expence->dex_st_unit == null): ?>
                                    <select name="dex_unit" id="dex_unit" class="form-control" required>
                                        <option selected value="<?=$expence->dex_unit ?>">واحد فعلی</option>
                                        <?php units(0, $expence->dex_unit); ?>
                                        <?php //units(0); ?>
                                    </select>
                                <?php else: ?>
                                    <input type="text" name="dex_unit_name" id="dex_unit_name" class="form-control" readonly>
                                    <input type="hidden" name="dex_unit" id="dex_unit" class="form-control" readonly>
                                    <input type="hidden" name="dex_unit_id" id="dex_unit_id" class="form-control" readonly>
                                    <input type="hidden" name="dex_st_name" id="dex_st_name" class="form-control" readonly>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dex_count">تعداد</label>
                                <input type="number" class="form-control" value="<?=$expence->dex_count; ?>" name="dex_count" id="dex_count" placeholder="مقدار اولیه به عدد " required/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dex_price">قیمت فی واحد</label>
                                <input type="number" class="form-control" value="<?=$expence->dex_price; ?>" name="dex_price" id="dex_price" placeholder="مقدار اولیه به عدد " required/>
                            </div>
                        </div>
                         <div class="col-sm-3">
                            <div class="form-group">
                                <label for="dex_total_amount">هزینه کل</label>
                                <input type="number" class="form-control" value="<?=$expence->dex_total_amount; ?>" id="dex_total_amount_alt" placeholder="هزینه کل " disabled />
                                <input type="hidden" class="form-control" value="<?=$expence->dex_total_amount; ?>" name="dex_total_amount" id="dex_total_amount"  />
                            </div>
                        </div>
                    </div>

                    </div>
                    <!-- row[END] -->

                    <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>

            </form>
        </div>
    </div> <!-- end col-sm-8 -->


</div>


<script>


$(document).ready(function() {

$('#dex_price').keyup(function(event) {
    var new_amm = $(this).val() * $('#dex_count').val();
    $('#dex_total_amount').val(new_amm);
    $('#dex_total_amount_alt').val(new_amm);
});

$('#dex_count').keyup(function(event) {
    var new_amm = $(this).val() * $('#dex_price').val();
    $('#dex_total_amount').val(new_amm);
    $('#dex_total_amount_alt').val(new_amm);
});


var id      = $('#dex_st_unit option:selected').val();
var unit    = $("#dex_st_unit option:selected").attr('st-unit');
var dex_st_name    = $("#dex_st_unit option:selected").text();
var unit_name = $("#dex_st_unit option:selected").attr('st-unit-name');
var max     = $("#dex_st_unit option:selected").attr('st-max-count');
// alert(unit);
$('#dex_unit_name').val(unit_name); //
$('#dex_st_name').val(dex_st_name); //
//$('#dex_unit').val(unit); //
$('#dex_count').attr('max', max); //
$('#dex_unit_id').val(id); //

// set max count and unit
$('#dex_st_unit').change(function(event) {
    var id      = $(this).val();
    var unit    = $("#dex_st_unit option:selected").attr('st-unit');
    var dex_st_name    = $("#dex_st_unit option:selected").text();
    var unit_name = $("#dex_st_unit option:selected").attr('st-unit-name');
    var max     = $("#dex_st_unit option:selected").attr('st-max-count');
    // alert(unit_name);
    $('#dex_unit_name').val(unit_name); //
    $('#dex_st_name').val(dex_st_name); //
    $('#dex_unit').val(unit); //
    $('#dex_count').attr('max', max); //
    $('#dex_unit_id').val(id); //
});

}); // end document

</script>