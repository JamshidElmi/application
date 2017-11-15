<!doctype html>
<html>
    <head>
        <title><?php echo $this->template->title->default("سیستم مدیریت رستورانت"); ?></title>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="<?php echo $this->template->description; ?>">
        <meta name="author" content="Jamshid Elmi">
        <?php echo $this->template->meta; ?>

        <!-- Exretnal Links -->
        <?php $styles = array(
              'bootstrap'       => 'assets/css/bootstrap-theme.css',
              'normalize'       => 'assets/css/rtl.css',
              'font-awesome'    => 'components/font-awesome/css/font-awesome.min.css',
              'ionicons'        => 'components/Ionicons/css/ionicons.min.css',
              'AdminLTE'        => 'assets/css/AdminLTE.css',
              'daterangepicker' => 'components/bootstrap-daterangepicker/daterangepicker.css',
              'style'           => 'assets/css/style.css'

        ); ?>
        <!-- Exretnal Scripts -->
        <?php $scripts = array(
            'jquery' => 'components/jquery/dist/jquery.min.js' ,

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
    <body onload="window.print();">
        <div class="wrapper">
                <section class="content-header">
                    <h1>
                        <?=$this->template->title; ?>
                        <small><?=$this->template->description; ?></small>
                    </h1>
                </section>
                <section class="content">
                    <!-- This is the main content partial -->
                    <?php echo $this->template->content; ?>
                </section>
                <!-- /.content -->
            <!-- </div> -->
        <?php
        ?>
        </div> <!-- wrapper -->

        <!-- Exretnal Scripts -->
        <?php
            $script = array(

            );
         ?>
        <?php echo $this->template->javascript->add($script); ?>
        <!-- Public Custom Scripts -->

    </body>
</html>