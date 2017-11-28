<div class="row">
    <div class="col-sm-4">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش سفارش</h3>
                <div class="box-tools pull-right">
                    <a href="<?=site_url('menu/kitchen_menus'); ?>" class="btn btn-box-tool"  data-toggle="tooltip" title="" data-original-title="Add New"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('menu/insert_kitchen_menu/'); ?>" enctype="multipart/form-data">

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
                    <?php if($this->session->file_errors) { echo alert($this->session->file_errors,'warning'); }  ?>

                    <div class="row">
                        <div class="col-xs-8">
                            <div class="form-group">
                                <label for="bm_name">نام منوی اصلی</label>
                                <input type="text" class="form-control" name="bm_name" id="bm_name" placeholder="کباب، قابلی، نوشیدنی" readonly />
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <img width="100" class="img-thumbnail" id="img" >
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="bm_price">قیمت فی خوراک</label>
                                <input type="number" class="form-control" id="bm_price" placeholder="اعشاری" required readonly />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="sord_count">تعداد</label>
                                <input type="number" class="form-control" name="sord_count" id="sord_count"  required/>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="sord_price">هزینه کلی</label>
                        <input type="number" class="form-control" id="sord_price" placeholder="اعشاری" required readonly />
                    </div>





                <input type="text" class="form-control" name="sord_bm_id" id="sord_bm_id" placeholder="اعشاری" required readonly />
                <input type="text" class="form-control" name="sord_id" id="sord_id" placeholder="اعشاری" required readonly />



                </div>
                <div class="box-footer">
                    <button type="submit" disabled id="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>


    <div class="col-sm-8">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست منوی انتخاب شده </h3>
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

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>نام منو</th>
                                        <th>نوعیت</th>
                                        <th>قیمت فی واحد</th>
                                        <th>تعداد</th>
                                        <th>هزینه کلی</th>
                                        <th>عملیات</th>
                                    </tr>
                                    <?php $i=1; foreach ($sub_orders as $sub_order): ?>
                                    <tr id="res_1">
                                        <td><?=$i++ ?></td>
                                        <td><b><?=$sub_order->bm_name ?></b></td>
                                        <td><?=$sub_order->mc_name ?> </td>
                                        <td><b><?=round($sub_order->bm_price) ?></b> افغانی</td>
                                        <td><span class="badge bg-info"><?=$sub_order->sord_count ?> </span></td>
                                        <td><b><?=$sub_order->sord_price ?></b> افغانی</td>
                                        <td>
                                            <a href="#" class="edit_sord_id" id="<?=$sub_order->sord_id ?>" bm-name="<?=$sub_order->bm_name ?>" sord-count="<?=$sub_order->sord_count ?>" sord-price="<?=$sub_order->sord_price ?>" sord-bm-id="<?=$sub_order->sord_bm_id ?>"  bm-price="<?=$sub_order->bm_price ?>" bm-picture="<?=$sub_order->bm_picture ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit fa-lg"></i></span></a>
                                            <a href="#" class="sord_id_to_delete" ><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>

                                </tbody>
                            </table>
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

    $('.edit_sord_id').click(function(event) {
        var sord_id = $(this).attr('id');
        var bm_name = $(this).attr('bm-name');
        var sord_count = $(this).attr('sord-count');
        var sord_price = $(this).attr('sord-price');
        var bm_price = $(this).attr('bm-price');
        var sord_bm_id = $(this).attr('sord-bm-id');
        var bm_picture = $(this).attr('bm-picture');
        $('#bm_name').val(bm_name);
        $('#sord_count').val(sord_count);
        $('#sord_price').val(sord_price);
        $('#bm_price').val(bm_price);
        $('#sord_bm_id').val(sord_bm_id);
        $('#sord_id').val(sord_id);
        $('#img').attr('src','<?=site_url('assets/img/menus/') ?>'+bm_picture);
        $('#submit').attr('disabled', false);

        $('#sord_count').keyup(function(event) {
            var count = $(this).val();
            var price = $('#bm_price').val();
            var total = count * price;
            $('#sord_price').val(total);
        });


    });


    // delete unit restuarant
    $('.sord_id_to_delete').confirm({
        title: 'حذف',
        content: 'آیا با حذف این ایتم سفارش موافق هستید؟',
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