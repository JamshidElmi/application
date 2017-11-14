


























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
                    <tr>
                        <td><?=$i++;  ?></td>
                        <td><?=$customer->cus_name ?></td>
                        <td><?=$customer->cus_lname ?></td>
                        <td><?=$customer->cus_unique_id ?></td>
                        <td><?=$customer->cus_phones ?></td>
                        <td><?=$customer->cus_email ?></td>
                        <td class="text-center no-padding"><?=($customer->cus_gendar == 0) ? '<i style="font-size: 30px !important;" class="ion ion-woman fa-lg" data-toggle="tooltip" title="" data-original-title="Female"></i>' : '<i style="font-size: 30px !important;" class="ion ion-man fa-lg" data-toggle="tooltip" title="" data-original-title="Male"></i>' ?></td>
                        <td class="text-center"><?=($customer->cus_type == 0) ? '<span class="label label-warning">آشپزخانه</span>' : '<span class="label label-info">رستورات</span>' ?></td>
                        <td>
                            <a href="<?=site_url('customer/view/'.$customer->cus_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="View Profile"><i class="fa fa-folder-open"></i></span></a>
                            <a href="<?=site_url('customer/edit/'.$customer->cus_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit"></i></span></a>
                            <a href="#" class="cus_id_to_delete" id="<?php echo $customer->cus_id; ?>"><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-trash"></i></span></a>
                        </td>

                    </tr>
                    <?php endforeach ?>


                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>کد مشتری</th>
                        <th>نام</th>
                        <th>تخلص</th>
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
            <div class="overlay" style="display: none;">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>



<script>
  $(function () {
    // $('#example1').DataTable()
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












<script>
$(document).ready(function() {
    $('.cus_id_to_delete').click(function() {
        var cus_id = $(this).attr('id');
        if (confirm('آیا با حذف این کارمند موافق هستید؟'))
        {
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
        };
    });
});

</script>



















