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
            'Chart'             => 'components/Chart.js/Chart.min.js',
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
        <style>
            /* permission access controlls */
            .read-only{
            <?php echo ($this->session->user_info->user_type == 2 || $this->session->user_info->user_type == 3) ? 'pointer-events: none;cursor: not-allowed;opacity: 0.6;' : ''; ?>
            }
            .only-admin{
              <?php echo ($this->session->user_info->user_type != 1 ) ? 'display: none !important' : ''; ?>
            }
            .no-garson{
            <?php echo ($this->session->user_info->user_type == 3 ) ?'display: none !important' : ''; ?>
            }
             .read-only-garson{
            <?php echo ($this->session->user_info->user_type == 3 ) ? 'pointer-events: none;cursor:not-allowed;opacity: 0.6;' : ''; ?>
            }
            .lock{
              pointer-events: none;cursor:not-allowed;opacity: 0.6;
            }
        </style>
    </head>




    <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="<?=base_url('dashboard')?>" class="navbar-brand"><b><?=$this->session->general_info->ci_full_name ?></b></a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="<?=site_url('order/garson_ordering')?>">سفارش رستورانت<span class="sr-only">(current)</span></a></li>
<!--                            <li><a href="#">سفارش آشپزخانه</a></li>-->
                            <li class="dropdown hidden">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">منوی آبشاری <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">سطح ۱</a></li>
                                    <li><a href="#">سطح ۱</a></li>
                                    <li><a href="#">سطح ۱</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">بخش ۲</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">بخش ۳</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-left hidden" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" id="navbar-search-input" placeholder="جستجو">
                            </div>
                        </form>
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?=base_url('assets/img/profiles/'.$this->session->emp_info->emp_picture); ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?=$this->session->emp_info->emp_name ?> <?=$this->session->emp_info->emp_lname ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?=base_url('assets/img/profiles/'.$this->session->emp_info->emp_picture); ?>" class="img-circle" alt="User Image">

                                        <p>
                                            <?=$this->session->emp_info->emp_name ?> <?=$this->session->emp_info->emp_lname ?> | <?=$this->session->emp_info->emp_position ?>
                                            <small>مدیریت آشپزخانه</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-footer">
                                    <?php if ($this->session->user_info->user_type != 3): ?>
                                        <div class="pull-right">
                                            <a href="<?=site_url('dashboard') ?>" class="btn btn-default btn-flat"> <i class="fa  fa-dashboard"></i> مدیریت </a>
                                        </div>
                                    <?php endif ?>

                                        <div class="pull-left">
                                            <a href="<?=site_url('login/logout') ?>" class="btn btn-danger btn-flat"> <i class="fa  fa-power-off"></i> خروج </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                        </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <section class="content-header">
                    <h1>
                        <?= $this->template->title; ?>
                        <small><?= $this->template->description; ?></small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- This is the main content partial -->
                    <?php echo $this->template->content; ?>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <?= $this->template->widget("footer"); ?>
    </div>
    <!-- ./wrapper -->




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
    </body>

</html>