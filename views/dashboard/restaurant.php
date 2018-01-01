<?php
/**
 * Created by PhpStorm.
 * User: Jamshid Elmi
 * Date: 1/1/2018
 * Time: 8:11 PM
 */
?>


<!-- Main content -->
<section class="content">

    <div class="row">

        <div class="col-sm-4"><!-- Info Boxes Style 2 -->
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">سفارشات</span>
                    <span class="info-box-number">5,200 افغانی</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                    <span class="progress-description">
                                ۵۰ درصد افزایش در ۳۰ روز گذشته
                              </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-sm-4"><!-- /.info-box -->
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">مصارف گدام</span>
                    <span class="info-box-number">92,050 افغانی</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 20%"></div>
                    </div>
                    <span class="progress-description">
                                 ۲۰ درصد افزایش در ۳۰ روز گذشته
                             </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-sm-4">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">مصارف روزانه </span>
                    <span class="info-box-number">163,921 افغانی</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 40%"></div>
                    </div>
                    <span class="progress-description">
                                  ۴۰ درصد کاهش در ۳۰ روز گذشته
                              </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>



    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- DONUT CHART -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">سهامداران</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-md-3">
                        <ul class="chart-legend clearfix">
                            <li><i class="fa fa-circle-o text-red"></i> احمد</li>
                            <li><i class="fa fa-circle-o text-green"></i> علی رضا</li>
                            <li><i class="fa fa-circle-o text-aqua"></i> کاظم</li>
                            <li><i class="fa fa-circle-o text-yellow"></i> میرزائی</li>
                            <li><i class="fa fa-circle-o text-light-blue"></i> شایان</li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <canvas id="pieChart" style="height:250px"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
            <!-- BAR CHART -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">مصارف و عواید</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col (RIGHT) -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->







<script>
    $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        var areaChartData = {
            labels: ['حمل', 'ثور', 'جوزا', 'سرطان', 'اسد', 'سنبله', 'میزان'],
            datasets: [
                {
                    label: 'عواید',
                    fillColor: 'rgb(245, 105, 84)',
                    strokeColor: 'rgb(245, 105, 84)',
                    pointColor: 'rgb(245, 105, 84)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgb(245, 105, 84)',
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
                {
                    label: 'مصارف',
                    fillColor: 'rgba(60,141,188,0.6)',
                    strokeColor: 'rgba(60,141,188,0.6)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
            ]
        };

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            {
                value: 700,
                color: '#f56954',
                highlight: '#f56954',
                label: 'احمد'
            },
            {
                value: 500,
                color: '#00a65a',
                highlight: '#00a65a',
                label: 'علی رضا'
            },
            {
                value: 400,
                color: '#f39c12',
                highlight: '#f39c12',
                label: 'کاظم'
            },
            {
                value: 600,
                color: '#00c0ef',
                highlight: '#00c0ef',
                label: 'میرزائی'
            },
            {
                value: 300,
                color: '#3c8dbc',
                highlight: '#3c8dbc',
                label: 'شایان'
            }
        ];
        var pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: '#fff',
            //Number - The width of each segment stroke
            segmentStrokeWidth: 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
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

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d');
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = '#00a65a';
        barChartData.datasets[1].pointColor = '#00a65a';
        barChartData.datasets[1].strokeColor = '#00a65a';

        var barChartOptions = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - If there is a stroke on each bar
            barShowStroke: true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth: 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing: 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing: 1,
            //String - A legend template
            legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to make the chart responsive
            responsive: true,
            maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
    });
</script>