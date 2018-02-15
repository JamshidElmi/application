<!doctype html>
<html>
    <head>
        <title><?php echo $this->template->title->default("سیستم مدیریت رستورانت"); ?></title>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" type="image/png" href="<?php echo site_url('assets/img/favicon.png') ?>">
        <meta name="description" content="<?php echo $this->template->description; ?>">
        <meta name="author" content="Jamshid Elmi">
        <?php echo $this->template->meta; ?>

        <!-- Exretnal Links -->
        <?php $styles = array(
              'bootstrap'       => 'assets/css/bootstrap-theme.css',
              'normalize'       => 'assets/css/rtl.css',
              'datepicker'      => 'assets/css/persian-datepicker-0.4.5.min.css',
              'font-awesome'    => 'components/font-awesome/css/font-awesome.min.css',
              'ionicons'        => 'components/Ionicons/css/ionicons.min.css',
              'AdminLTE'        => 'assets/css/AdminLTE.css',
              'skins'           => 'assets/css/skins/_all-skins.min.css',
//              'morris'          => 'components/morris.js/morris.css',
//              'jvectormap'      => 'components/jvectormap/jquery-jvectormap.css',
              'select2'         => 'components/select2/dist/css/select2.css',
              'timepicker'      => 'plugins/persian-datepicker/persian-datepicker.css',
              'data-table-bs'   => 'components/datatables.net-bs/css/dataTables.bootstrap.css' ,
              'wysihtml5'       => 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
              'jquery-confirm'  => 'plugins/jquery-confirm/jquery-confirm.min.css',
              'style'           => 'assets/css/style.css'
        ); ?>
        <!-- Exretnal Scripts -->
        <?php $scripts = array(
            'jquery'            => 'components/jquery/dist/jquery.min.js' ,
            'jquery-confirm'    => 'plugins/jquery-confirm/jquery-confirm.min.js' ,
            'persian-date'      => 'plugins/persian-datepicker/persian-date.js' ,
            'datepicker'        => 'plugins/persian-datepicker/persian-datepicker.js' ,
            'Chart'             => 'components/chart.js/Chart.min.js',
            'select2'           => 'components/select2/dist/js/select2.full.min.js' ,
        ); ?>

        <?php echo $this->template->stylesheet->add($styles); ?>

        <?php echo $this->template->javascript->add($scripts); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


          <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php
            // This is an example to show that you can load stuff from inside the template file
            /* Header Layout */
            echo $this->template->widget("header");
            /* Right Sidebar Layout */
            echo $this->template->widget("sidebar");
            ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                    <div class="row" style="margin: 0;padding: 0;">
                        <div class="col-sm-9" style="margin: 0;padding: 0;">
                            <section class="content-header" style="margin: 5px 10px 0 10px;padding: 5px 10px 0 10px;">
                            <h1>
                                <?= $this->template->title; ?>
                                <small><?= $this->template->description; ?></small>
                            </h1>
                            </section>
                        </div>
                        <div class="col-sm-3 text-center" style="margin: 0;padding: 0;">
                            <section class="content-header" style="margin: 5px 10px 0 10px;padding: 5px 10px 0 10px;">
                                <div class="clock" style="border: 1px dashed #cacaca; border-radius: 5px; background: #e1e1e1">
                                    <ul>
                                        <li id="sec"> </li>
                                        <li id="point">:</li>
                                        <li id="min"> </li>
                                        <li id="point">:</li>
                                        <li id="hours"> </li>
                                    </ul>
                                </div>
                            </section>
                        </div>
                    </div>


                <section class="content">
                    <!-- This is the main content partial -->
                    <?php echo $this->template->content; ?>
                </section>
                <!-- /.content -->
            </div>
            <?php
            /* Footer Layout */
            echo $this->template->widget("footer");
            /* Left Control Panel Layout */
            echo $this->template->widget("controlsidebar");
            ?>

            <div class="control-sidebar-bg"></div>
        </div> <!-- wrapper -->

        <!-- Exretnal Scripts -->
        <?php
            $script = array(
                'jquery-ui'         => 'components/jquery-ui/jquery-ui.min.js' ,
                'bootstrap'         => 'components/bootstrap/dist/js/bootstrap.min.js' ,
                'data-table'        => 'components/datatables.net/js/jquery.dataTables.js' ,
                'data-table-bs'     => 'components/datatables.net-bs/js/dataTables.bootstrap.js' ,
//                'raphael'           => 'components/raphael/raphael.min.js' ,
//                'morris'            => 'components/morris.js/morris.min.js' ,
//                'sparkline'         => 'components/jquery-sparkline/dist/jquery.sparkline.min.js' ,
//                'vectormap-1'       => 'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' ,
//                'jvectormap-world'  => 'plugins/jvectormap/jquery-jvectormap-world-mill-en.js' ,
//                'jquery.knob'       => 'components/jquery-knob/dist/jquery.knob.min.js' ,
                'bootstrap3-wysihtml5' => 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js' ,
//                'jquery.slimscroll' => 'components/jquery-slimscroll/jquery.slimscroll.min.js' ,
//                'fastclick'         => 'components/fastclick/lib/fastclick.js' ,
                'adminlte'          => 'assets/js/adminlte.min.js' ,
//                'dashboard'         => 'assets/js/pages/dashboard.js' ,
                'demo'              => 'assets/js/demo.js',
            );
         ?>
        <?php echo $this->template->javascript->add($script); ?>
        <!-- Public Custom Scripts -->
        <script>
            $('#<?php echo $this->template->menu;  ?>').addClass('active');
            $('#<?php echo $this->template->menu1; ?>').addClass('active');
            $('#<?php echo $this->template->menu2; ?>').addClass('active');
            $('#<?php echo $this->template->menu3; ?>').addClass('active');







        </script>
        <script>
            $(document).ready(function() {
                // Create two variable with the names of the months and days in an array
                var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
                var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

                // Create a newDate() object
                var newDate = new Date();
                // Extract the current date from Date object
                newDate.setDate(newDate.getDate());
                // Output the day, date, month and year
                $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

                setInterval( function() {
                    // Create a newDate() object and extract the seconds of the current time on the visitor's
                    var seconds = new Date().getSeconds();
                    // Add a leading zero to seconds value
                    $("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
                },1000);

                setInterval( function() {
                    // Create a newDate() object and extract the minutes of the current time on the visitor's
                    var minutes = new Date().getMinutes();
                    // Add a leading zero to the minutes value
                    $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
                },1000);

                setInterval( function() {
                    // Create a newDate() object and extract the hours of the current time on the visitor's
                    var hours = new Date().getHours();
                    // Add a leading zero to the hours value
                    $("#hours").html(( hours < 10 ? "0" : "" ) + hours);
                }, 1000);

            });
        </script>
    </body>
</html>