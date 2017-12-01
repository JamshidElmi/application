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



                    <!-- row[] -->
                    <div class="input_fields_wrap">
                    <div class="row">
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
                                    <?php units(0) ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dex_count">تعداد</label>
                                <input type="number" class="form-control" name="dex_count[]" id="dex_count" placeholder="مقدار اولیه به عدد " required/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dex_price">قیمت فی واحد</label>
                                <input type="number" class="form-control" name="dex_price[]" id="dex_price" placeholder="مقدار اولیه به عدد " required/>
                            </div>
                        </div>
                         <div class="col-sm-3">
                            <div class="form-group">
                                <label for="dex_total_amount">هزینه کل</label>
                                <input type="number" class="form-control" id="dex_total_amount_alt[]" placeholder="هزینه کل " disabled />
                                <input type="hidden" class="form-control" name="dex_total_amount[]" id="dex_total_amount"  />
                            </div>
                        </div>
                    </div>

                    </div>
                    <!-- row[END] -->


                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="btn btn-primary col-xs-12 add_field_button" id="add_new" data-toggle="tooltip" title="" data-original-title="Add New"><i class="ion-android-add-circle fa-lg"></i></a>
                            </div>
                        </div>
                    </div>





            </form>
        </div>
    </div> <!-- end col-sm-8 -->


</div>


<script>
// <select name="dex_unit[]" id="myselect[]"  class="form-control" required><option value="">واحدات</option>
// var select ='<select name="dex_unit[]" id="myselect[]"  class=" class="col-sm-2 form-control" required> <option value="">واحدات</option> <?php// foreach($units as $unit) { echo '<option value="'.$unit->unit_id.'">'.$unit->unit_name.'</option>'; } ?></select>  ';




$(document).ready(function() {
  var max_fields = 10; //maximum input boxes allowed
  var wrapper = $(".input_fields_wrap"); //Fields wrapper
  var add_button = $(".add_field_button"); //Add button ID

  var x = 1; //initlal text box count
  $(add_button).click(function(e) { //on add input button click
    e.preventDefault();
    if (x < max_fields) { //max input box allowed
      x++; //text box increment

        $(wrapper).append('<div class="row"><div class="col-sm-3">   <div class="form-group">   <label for="dex_name">نام جنس</label>     <input type="text" class="form-control" name="dex_name[]" id="dex_name" placeholder="نام جنس" required/>   </div>    </div>     <div class="col-sm-2">   <div class="form-group">   <label for="dex_unit">واحد</label>   <select name="dex_unit[]" id="myselect[]"  class="form-control" required> <option value="">واحدات</option> <?php foreach($units as $unit) { echo '<option value="'.$unit->unit_id.'">'.$unit->unit_name.'</option>'; } ?></select>   </div>   </div>    <div class="col-sm-2">   <div class="form-group">   <label for="dex_count">تعداد</label>   <input type="number" class="form-control" name="dex_count[]" id="dex_count" placeholder="مقدار اولیه به عدد " required/>   </div>   </div>  <div class="col-sm-2">   <div class="form-group">   <label for="dex_price">قیمت فی واحد</label>   <input type="number" class="form-control" name="dex_price[]" id="dex_price" placeholder="مقدار اولیه به عدد " required/>    </div>   </div>    <div class="col-sm-3">   <div class="form-group">   <label for="dex_total_amount">هزینه کل</label>   <input type="number" class="form-control" id="dex_total_amount_alt" placeholder="هزینه کل " disabled />   <input type="hidden" class="form-control" name="dex_total_amount[]" id="dex_total_amount"  />   </div>   </div>   <a href="#" class="remove_field">Remove</a></div>');
        // $(wrapper).append('<div>');
        // $(wrapper).append('');

        // var select ='';

        // $(wrapper).append(select);

        // $(wrapper).append(''); //add input box
        // $(wrapper).append('');
        // $(wrapper).append('');
        // $(wrapper).append('<a href="#" class="remove_field">Remove</a>');
        // $(wrapper).append('</div>');
        // $(wrapper).append('');






        // $(wrapper).append('<div class="row">');
        // $(wrapper).append('<div>');
        // $(wrapper).append('<div class="col-sm-3">   <div class="form-group">   <label for="dex_name">نام جنس</label>     <input type="text" class="form-control" name="dex_name[]" id="dex_name" placeholder="نام جنس" required/>   </div>    </div>');

        // var select ='<div class="col-sm-2">   <div class="form-group">   <label for="dex_unit">واحد</label>   <select name="dex_unit[]" id="myselect[]"  class="form-control" required> <option value="">واحدات</option> <?php //foreach($units as $unit) { echo '<option value="'.$unit->unit_id.'">'.$unit->unit_name.'</option>'; } ?></select>   </div>   </div>';

        // $(wrapper).append(select);

        // $(wrapper).append('<div class="col-sm-2">   <div class="form-group">   <label for="dex_count">تعداد</label>   <input type="number" class="form-control" name="dex_count[]" id="dex_count" placeholder="مقدار اولیه به عدد " required/>   </div>   </div>'); //add input box
        // $(wrapper).append('<div class="col-sm-2">   <div class="form-group">   <label for="dex_price">قیمت فی واحد</label>   <input type="number" class="form-control" name="dex_price[]" id="dex_price" placeholder="مقدار اولیه به عدد " required/>    </div>   </div>');
        // $(wrapper).append('<div class="col-sm-3">   <div class="form-group">   <label for="dex_total_amount">هزینه کل</label>   <input type="number" class="form-control" id="dex_total_amount_alt" placeholder="هزینه کل " disabled />   <input type="hidden" class="form-control" name="dex_total_amount[]" id="dex_total_amount"  />   </div>   </div>');
        // // $(wrapper).append('<a href="#" class="remove_field">Remove</a>');
        // $(wrapper).append('</div>');
        // $(wrapper).append('</div>');






          }
  });

  $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  });

  /* ADDED THIS */
  // $('.submit').click(function() {
  //   var list = wrapper.find('input').map(function() {
  //     return $(this).val();
  //   }).get();
  //   // send to server here
  //   console.log(list);
  // });




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








