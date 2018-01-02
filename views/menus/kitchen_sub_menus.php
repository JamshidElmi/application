<div class="row">
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت زیرمنو برای آشپزخانه</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?= site_url('menu/insert_sub_menu'); ?>" enctype="multipart/form-data">

                <div class="box-body">
                    <?php if ($this->session->form_errors) {
                        echo alert($this->session->form_errors, 'danger');
                    } ?>
                    <?php if ($this->session->form_success) {
                        echo alert($this->session->form_success, 'success');
                    } ?>
                    <?php if ($this->session->file_errors) {
                        echo alert($this->session->file_errors, 'warning');
                    } ?>


                    <div class="form-group">
                        <label for="sm_name">نام زیر منو</label>
                        <input type="text" class="form-control" name="sm_name" id="sm_name" placeholder="نام زیر منو" required />
                    </div>

                    <div class="row">
                        <div class="col-xs-8">
                            <div class="form-group">
                                <label for="sm_unit_id">انتخاب واحد</label>
                                <select class="form-control" name="sm_unit_id" id="sm_unit_id" required>
                                    <option value="">انتخاب کنید</option>
                                    <?php units(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="sm_count">ضریب</label>
                                <input type="number" class="form-control" name="sm_count" value="1" step=".1" id="sm_count" placeholder="تعداد" required />
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>قیمت زیرمنو</label>
                        <input type="number" class="form-control" name="sm_price" id="sm_price" step="0.1" placeholder="قیمت زیرمنو (اعشار)" required />
                    </div>

                    <div class="form-group">
                        <label for="sm_desc">توضیحات</label>
                        <textarea rows="5" class="form-control" name="sm_desc" id="sm_desc"></textarea>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i>
                    </button>
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
                <div class="msg" hidden><?= alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>

                <table class="table">
                    <tbody>
                    <tr>
                        <th>#</th>
                        <th>نام زیر منو </th>
                        <th>واحد</th>
                        <th>قیمت </th>
                        <th>توضیحات زیر منو</th>
                        <th>عملیات</th>
                    </tr>
                    <?php $i = 1;
                    foreach ($sub_menus as $sub_menu): ?>
                        <tr id="res_<?= $sub_menu->sm_id ?>">
                            <td><?= $i++ ?></td>
                            <td><?= $sub_menu->sm_name; ?></td>
                            <td><?= $sub_menu->sm_count . ' ' . $sub_menu->unit_name; ?></td>
                            <td><b><?= $sub_menu->sm_price; ?></b> افغانی</td>
                            <td>
                                <span data-toggle="tooltip" data-original-title="<?= $sub_menu->sm_desc ?>"><?= substr_fa($sub_menu->sm_desc, 40); ?></span>
                            </td>
                            <td>
                                <a href="#modal-id" class="sm_id_to_edit" sm-id="<?php echo $sub_menu->sm_id; ?>" sm-name="<?php echo $sub_menu->sm_name; ?>" sm-count="<?php echo $sub_menu->sm_count; ?>" sm-price="<?php echo $sub_menu->sm_price; ?>" sm-desc="<?php echo $sub_menu->sm_desc; ?>" data-toggle="modal"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit fa-lg"></i></span></a>
                                <a href="#" class="cus_id_to_delete only-admin" id="<?php echo $sub_menu->sm_id; ?>"><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
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

<!-- Modal For Edit Sub Menus -->
<div class="modal fade modal-warning" id="modal-id">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">ویرایش زیر منو</h4>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('menu/update_sub_menu'); ?>" method="POST">

<!--                    <input type="text" name="sm_id" id="sm_id_alt">-->
                    <input type="hidden" class="form-control" name="sm_id" id="sm_id_alt">
                    <div class="form-group">
                        <label for="sm_name">نام زیر منو</label>
                        <input type="text" class="form-control" name="sm_name" id="sm_name_alt" placeholder="نام زیر منو" required="">
                    </div>

                    <div class="row">
                        <div class="col-xs-8">
                            <div class="form-group">
                                <label for="sm_unit_id">انتخاب واحد</label>
                                <select class="form-control" name="sm_unit_id" id="sm_unit_id_alt" required="">
                                    <option value="">انتخاب کنید</option>
                                    <?php units(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="sm_count">ضریب</label>
                                <input type="number" class="form-control" name="sm_count" value="1" step=".1" id="sm_count_alt" placeholder="تعداد" required="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>قیمت زیرمنو</label>
                        <input type="number" class="form-control" name="sm_price" id="sm_price_alt" step="0.1" placeholder="قیمت زیرمنو (اعشار)" required="">
                    </div>

                    <div class="form-group">
                        <label for="sm_desc">توضیحات</label>
                        <textarea rows="5" class="form-control" name="sm_desc" id="sm_desc_alt"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">صرف نظر</button>
                    </div>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    $(document).ready(function () {
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
                        $(document).ajaxStart(function () {
                            $("#overlay").css('display', 'block');
                        });
                        $.post("<?php echo site_url('menu/delete_sm'); ?>", {sm_id: sm_id}, function (response) {
                        });
                        $(document).ajaxStop(function () {
                            $("#overlay").css('display', 'none');
                            $(".msg").css('display', 'block');
                            $("tr#res_" + sm_id).remove();
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
        $('#sm_bm_id').change(function (event) {
            $('#submit').attr('disabled', false);
        });
    });


    $('.sm_id_to_edit').click(function (e) {
        var sm_id = $(this).attr('sm-id');
        var sm_name = $(this).attr('sm-name');
        var sm_count = $(this).attr('sm-count');
        var sm_price = $(this).attr('sm-price');
        var sm_desc = $(this).attr('sm-desc');

        $('#sm_id_alt').val(sm_id);
        $('#sm_name_alt').val(sm_name);
        $('#sm_count_alt').val(sm_count);
        $('#sm_price_alt').val(sm_price);
        $('#sm_desc_alt').val(sm_desc);
    });


</script>