<div class="row ">

    <div class="col-sm-4">
        <div class="box box-info">
            <div class="box-header text-center">
                <h3 class="box-title text-center">نمودار سهام</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <canvas id="pieChart" style="height:500px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">فرم ثبت سهامدار</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('setting/insert_partner'); ?>" method='POST' >

                <div class="box-body">
                        <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                        <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); } ?>

                    <input type="hidden" name="part_emp_id" id="emp_id" />

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="user_name">نام و تخلص </label>
                                <input type="text" class="form-control" id="emp_full_name" placeholder="نام و تخلص" required disabled>
                            </div>

                            <div class="form-group">
                                <label for="user_name">وظیفه</label>
                                <input type="text" class="form-control"  id="emp_position" placeholder="پست" disabled required>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" id="submit" disabled="disabled" class="btn btn-success">ذخیره <i class="fa fa-save"></i></button>
                    <br>
                    <br>
                    <small>لطفاً یکی از کارمندان را انتخاب کنید. </small>
                </div>

            </form>
        </div>
    </div>

    <div class="col-md-5">

        <div class="box box-primary">
            <div class="box-header ">
                <h3 class="box-title">لیست سهامداران</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding table-responsive">
                <?php if($this->session->partner_errors) { echo alert($this->session->partner_errors,'danger'); }  ?>
                <?php if($this->session->partner_success) { echo alert($this->session->partner_success,'success'); }  ?>
                <table class="table table-hover table-warning">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام و تخلص</th>
                        <th>فیصدی</th>
                        <th class="text-center">سهم</th>
                        <th class="text-center">علمیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($partners as $partner): ?>
                        <tr>
                            <td><?=$i++ ?></td>
                            <td><?=$partner->emp_name. ' ' . $partner->emp_lname?></td>
                            <td class="text-center"><span class="badge bg-green"><?=round($partner->part_persent,1)?> %</span></td>
                            <td class="text-center "><strong><?=$partner->part_amount ?></strong> افغانی </td>
                            <td class="text-center ">
                                <a data-toggle="tooltip" data-original-title="Debit & Cridet" href="<?=base_url('finance/partner_credit_debit/'.$partner->part_id) ?>" class="label bg-orange part_id_to_delete"><i class="fa fa-pie-chart fa-lg"></i></a>
                                <a data-toggle="tooltip" data-original-title="Remove" href="<?=base_url('setting/delete_partner/'.$partner->part_id) ?>" onclick="return confirm('آیا با حذف این سهامدار موافق هستید؟')" class="label bg-red part_id_to_delete  only-admin" id="<?=$partner->part_id ?>" ><i class="fa ion-android-delete fa-lg"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <!-- /.box-body -->
        </div>


        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title">لیست کارمندان</h3>
                <span class="text-mute text-sm">انتخاب یکی از کارمندان برای شراکت</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding table-responsive">
                <table class="table table-hover table-warning">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام و تخلص</th>
                        <th>ایمیل آدرس</th>
                        <th class="text-center">وظیفه</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($employees as $employee): ?>
                        <tr>
                            <td><?=$i++ ?></td>
                            <td><?=$employee->emp_name. ' ' . $employee->emp_lname?></td>
                            <td><?=$employee->emp_email?></td>
                            <td class="text-center"><span class="badge bg-yellow"><?=$employee->emp_position?></span></td>
                            <td class="text-center"><a class="label bg-gray read-only" data-toggle="tooltip" data-original-title="Use" onclick="select_emp(<?=$employee->emp_id?>,'<?=$employee->emp_name?>','<?=$employee->emp_lname?>','<?=$employee->emp_position?>');"><i class="fa fa-chain fa-lg"></i></a></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <!-- /.box-body -->
        </div>

    </div>


</div>


<script>
    function select_emp(id, name, lname, position) {
        $("#emp_id").val(id);
        $("#emp_full_name").val(name + ' ' + lname);
        $("#emp_position").val(position);
        $("#submit").attr('disabled', false);
    }

    $(function () {
        var colors = ['#E84E5B','#F9DC5C','#3185FC','#2FEDDA','#5DAD4E','#D86C24','#4B4A59'];
        var colors_hover = ['#E86F79','#F9E484','#64A4FC','#8DF5EA','#99D18E','#E09562','#817E99'];
        //------------------
        //- PARTNERS CHART -
        //------------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            <?php $i=0; foreach ($partners as $partner) : ?>
                {
                    value: <?=$partner->part_persent ?>,
                    color: colors_hover[<?=$i ?>],
                    highlight: colors[<?=$i ?>],
                    label: '<?=$partner->emp_name .' '.$partner->emp_lname ?> %'
                },
                <?php $i++ ?>
            <?php endforeach ?>
        ];
        var pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: '#fff',
            //Number - The width of each segment stroke
            segmentStrokeWidth: 1,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 130,
            //String - Animation easing effect
            animationEasing: 'easeOutBounce',
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //String - A legend template
            legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);
    });
</script>