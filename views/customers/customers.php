<div class="box">
    <div class="box-header">
        <h3 class="box-title">لیست مشتریان </h3>
        <div class="pull-left box-tools">
            <a href="<?=site_url('customer/create'); ?>" class="btn btn-success btn-sm"  data-toggle="tooltip" title="" data-original-title="New Customer">
            <i class="fa fa-plus"></i></a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>
        <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
        <table id="example2" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>تخلص</th>
                    <th>کد مشتری</th>
                    <th>شماره تماس</th>
                    <th>ایمیل آدرس</th>
                    <th>جنسیت</th>
                    <th>نوعیت مشتری</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($customers as $customer): ?>
                <tr id="cus_<?=$customer->cus_id ?>">
                    <td><?=$i++;  ?></td>
                    <td><?=$customer->cus_name ?></td>
                    <td><?=$customer->cus_lname ?></td>
                    <td><?=$customer->cus_unique_id ?></td>
                    <td><?=$customer->cus_phones ?></td>
                    <td><?=$customer->cus_email ?></td>
                    <td class="text-center no-padding"><?=($customer->cus_gendar == 0) ? '<i style="font-size: 30px !important;" class="ion ion-woman fa-lg" data-toggle="tooltip" title="" data-original-title="Female"></i>' : '<i style="font-size: 30px !important;" class="ion ion-man fa-lg" data-toggle="tooltip" title="" data-original-title="Male"></i>' ?></td>
                    <td class="text-center"><?=($customer->cus_type == 0) ? '<span class="label label-warning">آشپزخانه</span>' : '<span class="label label-info">رستورات</span>' ?></td>
                    <td>
                        <a href="<?=site_url('customer/view/'.$customer->cus_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="View Profile"><i class="fa fa-folder-open fa-lg"></i></span></a>
                        <a href="<?=site_url('customer/edit/'.$customer->cus_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit fa-lg"></i></span></a>
                        <a href="#" class="cus_id_to_delete only-admin" id="<?php echo $customer->cus_id; ?>"><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa ion-android-delete fa-lg"></i></span></a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>تخلص</th>
                    <th>کد مشتری</th>
                    <th>شماره تماس</th>
                    <th>ایمیل آدرس</th>
                    <th>جنسیت</th>
                    <th>نوعیت مشتری</th>
                    <th>عملیات</th>
                </tr>
            </tfoot>
        </table>

    </div>
    <!-- /.box-body -->
    <div class="overlay" id="overlay" style="display: none;">
        <i class="fa ion-load-d fa-spin"></i>
    </div>
</div>

<script>
$(document).ready(function() {
    // delete job
    $('.cus_id_to_delete').confirm({
        title: 'حذف',
        content: 'آیا با حذف این مشتری موافق هستید؟',
        type: 'red',
        rtl: true,
        buttons: {
            confirm: {
                text: 'تایید',
                btnClass: 'btn-red',
                action: function () {
                    var cus_id = this.$target.attr('id');
                    $(document).ajaxStart(function(){
                    $(".overlay").css('display','block');
                    });
                      $.post("<?php echo site_url('customer/delete'); ?>",{cus_id:cus_id},function(response){

                      });
                    $(document).ajaxStop(function(){
                        $(".overlay").css('display','none');
                        $(".msg").css('display','block');
                        $("tr#cus_"+cus_id).remove();
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


$(function () {
    $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
    })
})

</script>