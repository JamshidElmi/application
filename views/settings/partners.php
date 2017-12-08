<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">فرم ثبت سهامدار</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('user/insert'); ?>" method='POST' >

                <div class="box-body">
                        <?php if($this->session->form_errors) { echo alert($this->session->form_errors,'danger'); }  ?>
                        <?php if($this->session->form_success) { echo alert($this->session->form_success,'success'); } ?>

                    <input type="hidden" name="emp_id" class="form-control"   id="emp_id" />


                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="user_name">نام و تخلص کارمند</label>
                                <input type="text" class="form-control" id="emp_full_name" placeholder="نام و تخلص" required disabled>
                            </div>

                            <div class="form-group">
                                <label for="user_name">عنوان پست کارمند</label>
                                <input type="text" class="form-control"  id="emp_position" placeholder="پست" disabled required>
                            </div>

                            <div class="form-group">
                                <label for="part_persent">مقدار فیصدی</label>
                                <input type="text" name="part_persent" class="form-control" id="part_persent" placeholder="نام کاربری" pattern="[A-Za-z]+" required>
                                <small class="help" > برای نام کاربری از کلمات انگلیسی استفاده کنید</small>
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <h4 class="text-center"><strong>نمودار سهامداران</strong></h4> <br>
                            <canvas id="pieChart" style="height:500px"></canvas>
                        </div>

                    </div>





                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" id="submit" disabled="disabled" class="btn btn-primary">ذخیره <i class="fa fa-save"></i></button>
                    <button type="reset" class="btn btn-default">صرف نظر <i class="fa fa-refresh"></i></button>
                    <br>
                    <small>لطفاً قبل از فشردن دکمه ذخیره یکی از کارمندان را انتخاب کنید. </small>
                </div>

            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">لیست کارمندان</h3>
            </div>
            <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-hover table-warning">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام و تخلص</th>
                                <th>ایمیل آدرس</th>
                                <th>نوعیت حساب</th>
                                <th>حساب کاربری</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($employees as $employee): ?>
                                <tr>
                                    <td><?=$i++ ?></td>
                                    <td><?=$employee->emp_name. ' ' . $employee->emp_lname?></td>
                                    <td><?=$employee->emp_email?></td>
                                    <td class="text-center"><span class="badge bg-yellow"><?=$employee->emp_position?></span></td>
                                    <td class="text-center"><a class="label bg-gray" onclick="select_emp(<?=$employee->emp_id?>,'<?=$employee->emp_name?>','<?=$employee->emp_lname?>','<?=$employee->emp_position?>');"><i class="fa fa-lock fa-lg"></i></a></td>
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


</script>

<script>
    $(function () {

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            {
                value: 20,
                color: '#f56954',
                highlight: '#f56954',
                label: 'احمد %'
            },
            {
                value: 40,
                color: '#00a65a',
                highlight: '#00a65a',
                label: 'محمود %'
            },
            {
                value: 30,
                color: '#f39c12',
                highlight: '#f39c12',
                label: 'امیر %'
            }
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