<div class="row">
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت زیرمنو برای آشپزخانه</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('menu/insert_sub_menu'); ?>" enctype="multipart/form-data">

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
                    <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'warning'); }  ?>

                    <div class="form-group">
                        <label for="bm_name">انتخاب منو اصلی</label>
                        <select class="form-control" name="sm_bm_id" id="sm_bm_id" required>
                            <option value="">انتخاب کنید</option>
                            <?php foreach ($base_menus as $base_menu): ?>
                                <option value="<?=$base_menu->bm_id ?>"><?=$base_menu->bm_name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sm_name">نام زیر منو</label>
                        <input type="text" class="form-control" name="sm_name" id="sm_name" placeholder="نام زیر منو" required/>
                    </div>

                    <div class="form-group">
                        <label for="sm_desc">توضیحات</label>
                        <textarea rows="5" class="form-control" name="sm_desc" id="sm_desc"  ></textarea>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" id="submit" disabled class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>


    <div class="col-sm-8">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست منو های اصلی و زیر منو </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>

                <table class="table">
                    <tbody>
                        <tr>
                            <th>#</th>
                            <th>منوی اصلی</th>
                            <th>منوی فرعی </th>
                            <th>توضیحات زیر منو</th>
                            <th>عملیات</th>
                        </tr>
                    <?php $i = 1; foreach ($sub_menus as $sub_menu): ?>
                        <tr id="res_<?=$sub_menu->sm_id?>">
                            <td><?=$i++ ?></td>
                            <td><b><?=$sub_menu->bm_name ?></b></td>
                            <td><?=$sub_menu->sm_name ?></td>
                            <td><?=$sub_menu->sm_desc ?></td>
                            <td>
                                <a href="#" class="cus_id_to_delete" id="<?php echo $sub_menu->sm_id; ?>"><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>

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
    // delete unit restuarant
    $('.cus_id_to_delete').confirm({
        title: 'حذف',
        content: 'آیا با حذف این زیرمنو موافق هستید؟',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var sm_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                        $("#overlay").css('display','block');
                    });
                      $.post("<?php echo site_url('menu/delete_sm'); ?>",{sm_id:sm_id},function(response){});
                    $(document).ajaxStop(function(){
                        $("#overlay").css('display','none');
                        $(".msg").css('display','block');
                        $("tr#res_"+sm_id).remove();
                    });
                }
            },
            cancel: {
                text: 'انصراف',
                action: function () {
                }
            }
        }
    });


    $('#sm_bm_id').change(function(event) {
        $('#submit').attr('disabled' , false);
    });




});

</script>