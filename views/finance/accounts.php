<style>
.small-box h3 {
    font-size: 30px;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
}
</style>
<div class="row">
    <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ایجاد صندوق جدید</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="<?=site_url('finance/insert_account'); ?>" >

                <div class="box-body">
                    <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                    <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); }  ?>

                    <div class="form-group">
                        <label for="acc_name">نام صندوق</label>
                        <input type="text" class="form-control" name="acc_name" id="acc_name" placeholder="نام صندوق" required/>
                    </div>

                    <div class="form-group">
                        <label for="emp_phone">نوعیت عملیات</label> &nbsp;&nbsp;&nbsp;
                        <div id="radios" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-warning btn-sm read-only">
                                <input type="radio" name="acc_type" id="acc_type1" value="1"  /> همکار
                            </label>
                            <label class="btn btn-warning btn-sm active">
                                <input type="radio" name="acc_type" id="acc_type2" value="2" checked /> مشتری
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="acc_amount">مقدار اولیه</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="acc_amount" value="0" id="acc_amount" placeholder="مقدار اولیه به عدد " required />
                            <div class="input-group-addon">افغانی</div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>تاریخ ایجاد</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="tarikh" class="form-control pull-right" style="z-index: 0;" readonly>
                            <input type="hidden" id="tarikhAlt" name="acc_date" class="form-control pull-right" style="z-index: 0;" >
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label for="acc_description">توضیحات / یادداشت</label>
                        <textarea type="number" rows="7" class="form-control" name="acc_description" id="acc_description" placeholder="توضیحات / یادداشت" /></textarea>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره  <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-8 hidden">
        <div class="box  box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">لیست صندوق های موجود در سیستم</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="msg" hidden><?=alert("عملیات حذف با موفقیت انجام شد.", 'success'); ?></div>
            <div class="row">
                <?php foreach ($accounts as $account): ?>
                    <div class="col-sm-4" id="acc_<?=$account->acc_id ?>">
                        <div class="small-box <?php if($account->acc_type == 0) echo 'bg-orange'; else if($account->acc_type == 1) echo 'bg-green'; else echo 'bg-blue'; ?>">
                            <div class="icon">
                                <i class="ion ion-lock-combination "></i>
                            </div>
                            <div class="inner">
                                <h3><?=round($account->acc_amount) ?><sup style="font-size: 20px;opacity: 0.5;direction: rtl; text-align: right" > افغانی </sup></h3>

                                <p><?=$account->acc_name ?></p>
                            </div>
                            <a href="<?=site_url('finance/credit_debit/'.$account->acc_id); ?>" class="small-box-footer" data-toggle="tooltip" title="" data-original-title="Credit & Debit List">
                لیست جمع و برداشت <i class="fa fa-line-chart fa-lg" ></i>
                            </a>
                            <?php if ($account->acc_type != 0): ?>
                                <a href="#" class="small-box-footer acc_id_to_delete only-admin" id="<?php echo $account->acc_id; ?>" data-toggle="tooltip" title="" data-original-title="Remove Account"><i class="ion ion-trash-b fa-lg" ></i></a>
                            <?php endif ?>

                        </div>
                    </div>
                <?php endforeach ?>
                </div>

            </div>
            <div class="box-footer">
                <span><i class="fa fa-circle text-orange"></i>   صندوق اصلی رستورانت </span>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <span><i class="fa fa-circle text-blue"></i>  حسابات مشتریان </span>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <span><i class="fa fa-circle text-green"></i> حسابات همکاران </span>
            </div>
            <!-- /.box-body -->
            <div class="overlay" id="overlay" hidden >
                <i class="fa ion ion-load-d fa-spin fa-lg" style="font-size: 40px;"></i>
            </div>
        </div>
    </div>
    
    
    <div class="col-md-8">
    <div class=" box box-gray">
    <div class="box-body no-padding">
    <div class=" nav-tabs-custom">
        <div class="pull-left box-tools" style="margin: 10px 0 0 10px">
            <a href="<?=site_url('finance/credit_debit/'.base_account()->acc_id); ?>" class="btn <?=(base_account()->acc_amount > 0 ) ? 'btn-success' : 'btn-danger' ?> btn-sm"  data-toggle="tooltip" title="" data-original-title="Credit & Debit">صندوق اصلی: <b><?=base_account()->acc_amount ?></b> افغانی </a>
        </div>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"> <i class="fa fa-circle text-blue"></i> صندوق مشتریان </a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">  <i class="fa fa-circle text-green"></i>  صندوق همکاران </a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <table id="acounts_table2" class="table table-bordered table-hover table-striped">
                    <thead class="bg-info">
                    <tr>
                        <th>#</th>
                        <th>نام حساب</th>
                        <th>مقدار موجود</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($accounts as $account): ?>
                        <?php if ($account->acc_type == 2): ?>
                            <tr id="acc_<?=$account->acc_id ?>">
                                <td><?=($account->acc_type == 0) ? '<i class="fa fa-circle text-orange"></i>' : ($account->acc_type == 1) ? '<i class="fa fa-circle text-green"></i>' : '<i class="fa fa-circle text-blue"></i>' ?></td>
                                <td><?=$account->acc_name ?></td>
                                <td><?=($account->acc_amount == 0 || $account->acc_amount > 0) ? '<strong><span class="text-success">'.$account->acc_amount.'</span></strong>' : '<strong><span class="text-danger">'.$account->acc_amount.'</span></strong>' ?> افغانی </td>
                                <td class="text-center"><?=($account->acc_amount < 0) ? '<i class="ion ion-android-remove-circle fa-lg text-danger"></i>' : '<i class="ion ion-android-add-circle fa-lg text-success"></i>' ?></td>
                                <td class="text-center">
<!--                                    <a href="#" class="acc_id_to_delete only-admin" id="--><?php //echo $account->acc_id; ?><!--" data-toggle="tooltip" title="" data-original-title="Remove Account"><i class="ion ion-trash-b fa-lg text-danger" ></i></a> &nbsp;&nbsp;&nbsp;-->
                                    <a href="<?=site_url('finance/credit_debit/'.$account->acc_id); ?>" class="small-box-footer" data-toggle="tooltip" title="" data-original-title="Credit & Debit List"><i class="fa fa-line-chart fa-lg" ></i></a>
                                </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            
            <div class="tab-pane" id="tab_2" >
                <table id="acounts_table" class="table table-bordered table-hover table-striped">
                    <thead class="bg-info">
                    <tr>
                        <th>#</th>
                        <th>نام حساب</th>
                        <th>مقدار موجود</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($accounts as $account): ?>
                        <?php if ($account->acc_type == 1): ?>
                            <tr id="acc_<?=$account->acc_id ?>">
                                <td><?=($account->acc_type == 0) ? '<i class="fa fa-circle text-orange"></i>' : ($account->acc_type == 1) ? '<i class="fa fa-circle text-green"></i>' : '<i class="fa fa-circle text-blue"></i>' ?></td>
                                <td><?=$account->acc_name ?></td>
                                <td><?=($account->acc_amount == 0 || $account->acc_amount > 0) ? '<strong><span class="text-success">'.$account->acc_amount.'</span></strong>' : '<strong><span class="text-danger">'.$account->acc_amount.'</span></strong>' ?> افغانی </td>
                                <td class="text-center"><?=($account->acc_amount < 0) ? '<i class="ion ion-android-remove-circle fa-lg text-danger"></i>' : '<i class="ion ion-android-add-circle fa-lg text-success"></i>' ?></td>
                                <td class="text-center">
<!--                                    <a href="#" class="acc_id_to_delete only-admin" id="--><?php //echo $account->acc_id; ?><!--" data-toggle="tooltip" title="" data-original-title="Remove Account"><i class="ion ion-trash-b fa-lg text-danger" ></i></a> &nbsp;&nbsp;&nbsp;-->
                                    <a href="<?=site_url('finance/credit_debit/'.$account->acc_id); ?>" class="small-box-footer" data-toggle="tooltip" title="" data-original-title="Credit & Debit List"><i class="fa fa-line-chart fa-lg" ></i></a>
                                </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                    </tbody>
                </table>
                
            </div>
            
        </div>
        
    </div>
    
    </div>
    <div class="overlay" id="overlay" hidden >
        <i class="fa ion ion-load-d fa-spin fa-lg" style="font-size: 40px;"></i>
    </div>
    </div>
    </div>
    
    
    
    
    

</div>

<script>
$(document).ready(function() {
    // Date Picker
    $('#tarikh').persianDatepicker({
        altField: '#tarikhAlt',
        format: 'D/MMMM/YYYY',
        observer: true,
        altFormat: 'YYYY-MM-DD',
        position: [-65,200],
        calendar: {
            persian: {
                enabled: true,
                locale: 'en',
                leapYearMode: "algorithmic" // "astronomical"
            },
            gregorian: {
                enabled: false,
                locale: 'en'
            }
        }
    });
});

// remove account
$('.acc_id_to_delete').click(function() {
    var acc_id = $(this).attr('id');
    if (confirm('آیا با حذف این صندوق و تمام معاملات آن موافق هستید؟'))
    {
        $(document).ajaxStart(function(){
            $(".overlay").css('display','block');
        });
          $.post("<?php echo site_url('finance/delete_account'); ?>",{acc_id:acc_id},function(response){});
        $(document).ajaxStop(function(){
            $(".overlay").css('display','none');
            $(".msg").css('display','block');
            $("tr#acc_"+acc_id).remove();
        });
    }
});

$(function () {
    $('#acounts_table').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
    })
});

$(function () {
    $('#acounts_table2').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
    })
});
</script>