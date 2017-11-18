<style>
    /*.bg-red{padding: 3px 4px 3px 4px;}*/
    .bg-red:hover {
    background-color: #8F2418 !important;
}
</style>
<div class="row">
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت منو برای آشپزخانه</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('menu/insert_kitchen_menu'); ?>" enctype="multipart/form-data">

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
                    <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'warning'); }  ?>

                    <div class="form-group">
                        <label for="bm_name">نام منوی اصلی</label>
                        <input type="text" class="form-control" name="bm_name" id="bm_name" placeholder="کباب، قابلی، نوشیدنی" required/>
                    </div>

                    <div class="form-group">
                        <label for="bm_price">قیمت فی خوراک</label>
                        <input type="number" class="form-control" name="bm_price" id="bm_price" placeholder="اعشاری" required/>
                    </div>

                    <div class="form-group">
                        <label for="bm_picture">عکس</label>
                        <input type="file" name="bm_picture" id="bm_picture" required />
                        <p class="small">حجم فایل باید کمتر از 250 کیلوبایت و ابعاد آن از 400 پیکسل کوچکتر باشد.</p>
                    </div>

                    <div class="form-group">
                        <label for="bm_desc">توضیحات</label>
                        <textarea rows="5" class="form-control" name="bm_desc" id="bm_desc"  ></textarea>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>


    <div class="col-sm-8">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست منو های اصلی </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>


                    <ul class="users-list clearfix">

                        <?php foreach ($base_menus as $base_menu): ?>
                            <li id="bm_<?=$base_menu->bm_id ?>" >
                                <img width="100" class="img-thumbnail" src="<?=site_url('assets/img/menus/'.$base_menu->bm_picture); ?>" >
                                <a class="users-list-name" href="#" data-toggle="tooltip" title="" data-original-title="<?=$base_menu->bm_desc ?>"><?=$base_menu->bm_name ?></a>
                                <span class=" base_manu_delete" id="<?=$base_menu->bm_id ?>" data-toggle="tooltip" title="" data-original-title="Remove"><i class="ion ion-trash-b fa-lg btn btn-danger btn-xs"></i></span>
                            </li>
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
    // delete unit restuarant
    $('.base_manu_delete').confirm({
        title: 'حذف',
        content: 'آیا با حذف این منو منو موافق هستید؟',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var bm_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                        $("#overlay").css('display','block');
                    });
                      $.post("<?php echo site_url('menu/delete_bm'); ?>",{bm_id:bm_id},function(response){});
                    $(document).ajaxStop(function(){
                        $("#overlay").css('display','none');
                        $(".msg").css('display','block');
                        $("li#bm_"+bm_id).remove();
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
});

</script>