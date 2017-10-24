
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">لیست کارمندان </h3>
                <div class="pull-left box-tools">
                    <a href="<?=site_url('employee/create'); ?>" class="btn btn-info btn-sm"  data-toggle="tooltip" title="" data-original-title="New Employee">
                    <i class="fa fa-plus"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <div class="col-sm-6">
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); } ?>
                <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
                </div>


                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>شماره</th>
                            <th>نام</th>
                            <th>تخلص</th>
                            <th>وظیفه</th>
                            <th>معاش</th>
                            <th>تاریخ استخدام</th>
                            <th>شماره تماس</th>
                            <th>بخش کاری</th>
                            <th>ویرایش</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($employees as $employee): ?>
                        <tr id="emp_<?php echo $employee->emp_id; ?>">
                            <td><?=$i++ ?></td>
                            <td><?=$employee->emp_name ?></td>
                            <td><?=$employee->emp_lname ?></td>
                            <td><?=$employee->emp_position ?></td>
                            <td><?=$employee->emp_salary ?></td>
                            <td><?=$employee->emp_join_date ?></td>
                            <td><?=$employee->emp_phone ?></td>
                            <td><?php echo ($employee->emp_type == 0) ? '<span class="label label-warning">آشپزخانه</span>' : '<span class="label label-info">رستورات</span>' ?></td>
                            <td>
                                <a href="<?=site_url('employee/view/'.$employee->emp_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="View Profile"><i class="fa fa-folder-open"></i></span></a>
                                <a href="<?=site_url('employee/edit/'.$employee->emp_id); ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit"></i></span></a>
                                <a href="#" class="emp_id_to_delete" id="<?php echo $employee->emp_id; ?>"><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-trash"></i></span></a>
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
    $('.emp_id_to_delete').click(function() {
        var emp_id = $(this).attr('id');
        if (confirm('آیا با حذف این کارمند موافق هستید؟'))
        {
            $(document).ajaxStart(function(){
                $(".overlay").css('display','block');
            });
              $.post("<?php echo site_url('employee/delete'); ?>",{emp_id:emp_id},function(response){

              });
            $(document).ajaxStop(function(){
                $(".overlay").css('display','none');
                $(".msg").css('display','block');
                $("tr#emp_"+emp_id).remove();
            });
        };
    });
});

</script>