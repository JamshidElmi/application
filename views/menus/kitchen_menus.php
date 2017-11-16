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
        <div class="box box-info box-solid">
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
                <div class="msg_res" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>


                <ul class="users-list clearfix">
                    <li>
                        <img width="90" class="img-thumbnail" src="<?=site_url('assets/img/menus/avatar.png'); ?>" >
                        <a class="users-list-name" href="#">الکساندر گراهامبل</a>
                        <span class="users-list-date">امروز</span>
                    </li>
                </ul>



            </div>
            <!-- /.box-body -->
            <div class="overlay" id="overlay_res" style="display: none;">
                <i class="fa ion-load-d fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // delete unit restuarant
    $('.mc_res_delete').confirm({
        title: 'حذف',
        content: 'آیا با حذف این نوعیت منو موافق هستید؟',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var mc_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                        $("#overlay_res").css('display','block');
                    });
                      $.post("<?php echo site_url('setting/delete_mc'); ?>",{mc_id:mc_id},function(response){});
                    $(document).ajaxStop(function(){
                        $("#overlay_res").css('display','none');
                        $(".msg_res").css('display','block');
                        $("a#res_"+mc_id).remove();
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