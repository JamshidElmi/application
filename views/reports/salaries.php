<?php
/**
 * Created by PhpStorm.
 * User: Jamshid Elmi
 * Date: 1/7/2018
 * Time: 9:46 PM
 */
?>

<div class="box box-success">
    <div class="box-header with-border">
        <div class="box-tools pull-right">

            <div class="col-sm-5">
                <h3 class="box-title">لیست معاشات پرداخت شده</h3>
            </div>
            <form action="<?=site_url('reports/salaries/salary_monthly');?>" method="POST" >
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="input-group date">
                            <div class="input-group-addon">از</div>
                            <input type="text" id="tarikh1" class="form-control pull-right" style="z-index: 0;" readonly>
                            <input type="hidden" id="tarikh1Alt" name="tarikh1" class="form-control pull-right" style="z-index: 0;">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="input-group date">
                            <div class="input-group-addon">الی</div>
                            <input type="text" id="tarikh2" class="form-control pull-right" style="z-index: 0;" readonly>
                            <input type="hidden" id="tarikh2Alt" name="tarikh2" class="form-control pull-right" style="z-index: 0;">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary">جستجو</button>
                </div>
            </form>

        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php print_r($salaries); ?>
    </div>
    <!-- /.box-body -->
</div>


<script>
    // Year & Month Picker
    $('#tarikh1').persianDatepicker({
        altField: '#tarikh1Alt',
        altFormat: 'YYYY-M-D',
        format: 'D/MMMM/YYYY',
        observer: true,
        calendar: {
            persian: {
                enabled: true,
                locale: 'en',
                leapYearMode: "algorithmic" // "astronomical"
            },

            gregorian: {
                enabled: false,
                locale: 'fa'
            }
        },
        position: [-67, 200]
    });

    // Year & Month Picker
    $('#tarikh2').persianDatepicker({
        altField: '#tarikh2Alt',
        altFormat: 'YYYY-M-D',
        format: 'D/MMMM/YYYY',
        observer: true,
        calendar: {
            persian: {
                enabled: true,
                locale: 'en',
                leapYearMode: "algorithmic" // "astronomical"
            },

            gregorian: {
                enabled: false,
                locale: 'fa'
            }
        },
        position: [-67, 200]
    });
</script>
