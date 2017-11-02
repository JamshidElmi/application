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
                <h3 class="box-title">فرم ویرایش مصارف روزانه</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" id="myForm" action="<?=site_url('finance/update_expence/'.$expence->dex_id); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <!-- row[] -->
                    <div class="input_fields_wrap">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="dex_name">نام جنس</label>
                                <input type="text" class="form-control" value="<?=$expence->dex_name; ?>" name="dex_name" id="dex_name" placeholder="نام جنس" required/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dex_unit">واحد</label>
                                <select name="dex_unit" id="dex_unit" class="form-control" required>
                                    <?php units(0, $expence->dex_unit); ?>
                                    <?php units(0); ?>
                                </select>
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








