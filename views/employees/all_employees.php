
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">لیست کارمندان </h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input name="table_search" class="form-control pull-right" placeholder="جستجو" type="text">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
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
                                <a href="<?=site_url('employee/view/'.$employee->emp_id); ?>"><span class="label label-default"><i class="fa fa-folder-open"></i></span></a>
                                <a href="<?=site_url('employee/edit/'.$employee->emp_id); ?>"><span class="label label-default"><i class="fa fa-edit"></i></span></a>
                                <a href="#" class="emp_id_to_delete" id="<?php echo $employee->emp_id; ?>" data-container="body" data-placement="top" data-original-title="Delete"><span class="label label-danger"><i class="fa fa-trash"></i></span></a>
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
                $("tr#emp_"+emp_id).remove();
            });
        };
    });
});

</script>