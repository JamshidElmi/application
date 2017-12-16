<?php
/**
 * Created by PhpStorm.
 * User: Jamshid Elmi
 * Date: 12/14/2017
 * Time: 8:13 PM
 */
?>


<form action="" method="post">

    <div class="col-md-6">
        <div class="form-group">
            <label>چند انتخابی</label>
            <select class="form-control select2" name="menus[]" multiple="multiple" data-placeholder="Select a State">
                <option value="1">تهران</option>
                <option>مشهد</option>
                <option>اصفهان</option>
                <option>شیراز</option>
                <option>اهواز</option>
                <option>تبریز</option>
                <option>کرج</option>
            </select>
        </div>
    </div>
    <input type="submit" value="Go" class="btn btn-success" />

</form>


<script>

    $('.select2').select2();

</script>
