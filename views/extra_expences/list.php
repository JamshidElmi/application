        <div class="box">
            <div class="box-header">
                <h3 class="box-title">لیست مصارف ثابت </h3>
                <div class="pull-left box-tools no-print">
<!--                    <a target="_blank" href="--><?//=site_url('employee/print_employees'); ?><!--" class="btn btn-default btn-sm"  data-toggle="tooltip"  data-original-title="Print"><i class="fa fa-print fa-lg"></i></a>-->
                    <a href="<?=site_url('finance/new_extra_expence'); ?>" class="btn btn-success btn-sm"  data-toggle="tooltip"  data-original-title="New Expence"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="row ">
                <div class="col-sm-6">
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); } ?>
                    <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
                </div>
            </div>
            <div class="box-body table-responsive">

                <table id="example2" class="table table-hover table-bordered table-striped">
                    <thead  class="bg-info">
                        <tr>
                            <th>شماره</th>
                            <th>نوع مصرف</th>
                            <th>هزینه</th>
                            <th>تاریخ</th>
                            <th>توضیحات</th>
                            <th class="no-print">ویرایش</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($extra_expences as $expence): ?>
                        <tr id="exp_<?php echo $expence->exp_id; ?>">
                            <td class="text-center"><?=$i++ ?></td>
                            <td class="text-center"><?=$expence->exp_cat_name ?></td>
                            <td class="text-center"><b><?=$expence->exp_amount ?> </b> افغانی</td>
                            <td class="text-center"><?=show_date('l d/F/Y', $expence->exp_date); ?></td>
                            <td><span data-toggle="tooltip" data-original-title="<?=$expence->exp_disc ?>"><?= substr_fa($expence->exp_disc, 50) ?></span></td>
                            <td class="no-print text-center">
                                <a href="<?=site_url('finance/edit_extra_expence/'.$expence->exp_id); ?>"><span class="label label-default" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></span></a>
                                <a class="ext_id_to_delete only-admin" id="<?=$expence->exp_id; ?>"><span class="label label-danger" data-toggle="tooltip" data-original-title="Remove"><i class="fa fa-trash"></i></span></a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="overlay" style="display: none;">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>


<script>
$(document).ready(function() {
    // delete extra expence
    $('.ext_id_to_delete').confirm({
        title: 'حذف',
        content: 'آیا با حذف این مصرف موافق هستید؟',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var exp_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                        $("#overlay_res").css('display','block');
                    });
                    $.post("<?php echo site_url('finance/delete_extra_expence'); ?>",{exp_id:exp_id},function(response){});
                    $(document).ajaxStop(function(){
                        $("#overlay").css('display','none');
                        $(".msg").css('display','block');
                        $("tr#exp_"+exp_id).remove();
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

// Ganerate Data Table
$(function () {
    $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
    })
});

</script>