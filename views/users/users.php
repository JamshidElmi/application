
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">لیست حسب های کاربری</h3>
                <div class="pull-left box-tools">
                    <a href="<?=site_url('user/create'); ?>" class="btn btn-info btn-sm"  data-toggle="tooltip" title="" data-original-title="New User">
                    <i class="fa fa-plus"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <div class="col-sm-6">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
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
                            <th>نام کاربری</th>
                            <th>تاریخ استخدام</th>
                            <th>شماره تماس</th>
                            <th>بخش کاری</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($users as $user): ?>
                        <tr id="user_<?php echo $user->user_id; ?>">
                            <td><?=$i++ ?></td>
                            <td><?=$user->emp_name ?></td>
                            <td><?=$user->emp_lname ?></td>
                            <td><?=$user->emp_position ?></td>
                            <td><?=$user->user_name ?></td>
                            <td><?=$user->emp_join_date ?></td>
                            <td><?=$user->emp_phone ?></td>
                            <td><?php echo ($user->emp_type == 0) ? '<span class="label label-warning">آشپزخانه</span>' : '<span class="label label-info">رستورات</span>' ?></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#<?=$user->user_id; ?>"><span class="label label-default" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit"></i></span></a>
                                <a href="#" class="user_id_to_delete" id="<?php echo $user->user_id; ?>" data-container="body" data-placement="top" data-original-title="Delete"><span class="label label-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash"></i></span></a>
                            </td>
                        </tr>




                        <!-- Modal -->
                        <div id="<?=$user->user_id; ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-sm ">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">ویرایش حساب کاربری</h4>
                                    </div>
                                    <form action="<?=site_url('user/edit/'.$user->user_id); ?>" method="POST">
                                        <div class="modal-body">

                                             <div class="form-group">
                                                <label for="user_name">نام کاربری</label>
                                                <input type="text" name="user_name" value="<?=$user->user_name ?>" class="form-control" id="user_name" placeholder="نام کاربری" pattern="[A-Za-z]+" required>
                                                <small class="help" > برای نام کاربری از کلمات انگلیسی استفاده کنید</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="old_pass">رمز عبور قبلی</label>
                                                <input type="password" name="old_pass" class="form-control" id="old_pass" placeholder="رمز عبور قبلی کاربر مذکور" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="user_pass">رمز عبور جدید</label>
                                                <input type="password" name="user_pass" class="form-control" id="user_pass" placeholder="رمز عبور جدید" required>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">بستن <i class="fa fa-close"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
    $('.user_id_to_delete').click(function() {
        var user_id = $(this).attr('id');
        if (confirm('آیا با حذف این حساب کاربری موافق هستید؟'))
        {
            $(document).ajaxStart(function(){
                $(".overlay").css('display','block');
            });
              $.post("<?php echo site_url('user/delete'); ?>",{user_id:user_id},function(response){});
            $(document).ajaxStop(function(){
                $(".overlay").css('display','none');
                $(".msg").css('display','block');
                $("tr#user_"+user_id).remove();
            });
        };
    });
});

</script>