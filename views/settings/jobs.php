<style>
    /*.bg-red{padding: 3px 4px 3px 4px;}*/
    .bg-red:hover {
    background-color: #8F2418 !important;
}
</style>
<div class="row">
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت وظیفه جدید</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('setting/insert_job'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="form-group">
                        <label for="job_name">عنوان وظیفه</label>
                        <input type="text" class="form-control" name="job_name" id="job_name" placeholder="عنوان وظیفه" required/>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-sm-7">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست وظایف ثبت شده</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="msg_coo" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
            <?php foreach ($jobs as $job): ?>
                <a class="btn btn-app" id="coo_<?=$job->job_id ?>">
                    <span class="badge bg-red job_delete" id="<?=$job->job_id ?>" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-trash fa-lg"></i></span>
                    <i class="fa fa-user-secret"></i><?php echo $job->job_name ?>
                </a>
            <?php endforeach ?>

            </div>
            <!-- /.box-body -->
            <div class="overlay" id="overlay" style="display: none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </div>


</div>

<script>
$(document).ready(function() {
    $('.job_delete').click(function() {
        var job_id = $(this).attr('id');
        if (confirm('آیا با حذف این وظیفه موافق هستید؟'))
        {
            $(document).ajaxStart(function(){
                $("#overlay").css('display','block');
            });
              $.post("<?php echo site_url('setting/delete_job'); ?>",{job_id:job_id},function(response){});
            $(document).ajaxStop(function(){
                $("#overlay").css('display','none');
                $(".msg_coo").css('display','block');
                $("a#coo_"+job_id).remove();
            });
        };
    });
});

</script>