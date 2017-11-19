<div class="row">
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت سفارش برای آشپزخانه</h3>
                <div class="box-tools pull-right">
                    <a href="<?=site_url('menu/resturant_menus'); ?>" class="btn btn-box-tool"  data-toggle="tooltip" title="" data-original-title="Add New"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $bm_id = (isset($bm->bm_id))?$bm->bm_id:'' ?>
            <form role="form" method="POST" action="<?=site_url('menu/insert_resturant_menu/'.$bm_id); ?>" enctype="multipart/form-data">

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
                    <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'warning'); }  ?>

                    <div class="form-group">
                        <label for="emp_phone">روش پرداخت</label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary active" id="order_type01">
                                <input type="radio" name="order_type" id="order_type1" value="1" checked=""> نقد
                            </label>
                            <label class="btn btn-primary " id="order_type02">
                                <input type="radio" name="order_type" id="order_type2" value="2"> مشتری
                            </label>
                        </div>
                    </div>

                    <div id="cus_list"></div>

                    <div class="form-group">
                        <label for="bm_name">نام منو</label>
                        <input type="text" class="form-control" value="<?=(isset($bm->bm_name))?$bm->bm_name:''?>" name="bm_name" id="bm_name" placeholder="کباب، قابلی، نوشیدنی" required/>
                    </div>

                    <div class="form-group">
                        <label for="bm_price">قیمت فی واحد</label>
                        <input type="number" class="form-control" value="<?=(isset($bm->bm_price))?$bm->bm_price:''?>" name="bm_price" id="bm_price" placeholder="اعشاری" required/>
                    </div>

                    <?php if (isset($bm->bm_picture)): ?>
                        <a href="#" id="choose_file" style="float: left" data-toggle="tooltip" title="" data-original-title="Click For Change Image"><img width="100" class="img-thumbnail" src="<?=site_url('assets/img/menus/'.$bm->bm_picture) ?>" alt=""></a>
                        <div class="clearfix"></div>
                        <div id="file"></div>
                    <?php else: ?>
                        <div class="form-group">
                            <label for="bm_picture">عکس</label>
                            <input type="file" name="bm_picture" id="bm_picture" required />
                            <p class="small">حجم فایل باید کمتر از 250 کیلوبایت و ابعاد آن از 400 پیکسل کوچکتر باشد.</p>
                        </div>
                    <?php endif ?>


                    <div class="form-group">
                        <label for="bm_desc">توضیحات</label>
                        <textarea rows="5" class="form-control" name="bm_desc" id="bm_desc"  ><?=(isset($bm->bm_desc))?$bm->bm_desc:''?></textarea>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>


    <div class="col-sm-8">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست منو های آشپزخانه </h3>
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

                        <?php foreach ($bm as $base_menu): ?>
                            <li id="bm_<?=$base_menu->bm_id ?>" >
                                <img width="100" class="img-thumbnail" src="<?=site_url('assets/img/menus/'.$base_menu->bm_picture); ?>" >
                                <a class="users-list-name" href="#" style="margin-bottom: 10px" data-toggle="tooltip" title="" data-original-title="<?=$base_menu->bm_desc ?>"><?=$base_menu->bm_name ?></a>
                                <a class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-<?=$base_menu->bm_id ?>" ><span id="<?=$base_menu->bm_id ?>"  title="" data-original-title="Use"><i class="fa fa-share fa-lg "></i></span></a>
                            </li>
                             <div class="modal fade " id="modal-<?=$base_menu->bm_id ?>">
                                  <div class="modal-dialog ">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><?php  ?></h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>محتوا</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">خروج</button>
                                        <button type="button" class="btn btn-primary">ذخیره</button>
                                      </div>
                                    </div>
                                    <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
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


$('#order_type02').click(function(event) {
    $('#cus_list').html('<div class="form-group"><label for="bm_cat_id">انتخاب مشتری</label><select name="bm_cat_id" id="bm_cat_id" class="form-control" required><option value="">انتخاب کنید</option><?php foreach ($customers as $customer): ?><option value="<?=$customer->cus_id ?>"><?=$customer->cus_name .' '.$customer->cus_lname ?></option><?php endforeach ?></select></div>');
});

$('#order_type01').click(function(event) {
    $('#cus_list>div').remove();
});







    // delete unit restuarant
    $('.base_manu_delete').confirm({
        title: 'حذف',
        content: 'آیا با حذف این منو موافق هستید؟',
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