<div class="row">
    <div class="col-lg-5 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ثبت مصرف جدید</h3>
                <div class="box-tools pull-right">
                    <a href="<?= site_url('finance/extra_expences'); ?>" class="btn btn-box-tool bg-gray" data-toggle="tooltip" data-original-title="Expences List"><i class="fa fa-list-ul fa-lg"></i></a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?= base_url('finance/update_extra_expence/'.$extra_expence->exp_id) ?>" method="POST">
                <div class="box-body">
                    <?php if ($this->session->form_errors) {
                        echo alert($this->session->form_errors, 'danger');
                    } ?>
                    <?php if ($this->session->form_success) {
                        echo alert($this->session->form_success, 'success');
                    } ?>

                    <div class="form-group">
                        <label for="category">نوع مصرف</label>
                        <select name="exp_cat_id" id="category" class="form-control" required>
                            <option value="<?=$extra_expence->exp_cat_id ?>" selected><?=$extra_expence->exp_cat_name ?></option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->exp_cat_id ?>"><?= $category->exp_cat_name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">هزینه</label>
                        <input type="number" class="form-control" value="<?=$extra_expence->exp_amount ?>" name="exp_amount" id="amount" placeholder="هزینه را وارد کنید" required>
                    </div>

                    <div class="form-group">
                        <label>تاریخ ثبت</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="tarikh" value="<?=$extra_expence->exp_date ?>" class="form-control pull-right" style="z-index: 0;" readonly>
                            <input type="hidden" id="tarikhAlt" value="<?=$extra_expence->exp_date ?>" name="exp_date" class="form-control pull-right" style="z-index: 0;">
                        </div><!-- /.input group -->
                        <p class="text-sm text-gray">برای تغییر تاریخ دوبار کلیک کنید</p>
                    </div>

                    <div class="form-group">
                        <label for="disc">توضیحات / یادداشت</label>
                        <textarea name="exp_disc" class="form-control" rows="7" id="disc" placeholder="توضیحات / یادداشت"><?=$extra_expence->exp_disc ?></textarea>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">انصراف <i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Date Picker
        $('#tarikh').click(function () {
            this.removeAttribute('value');
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

    }); // end document
</script>