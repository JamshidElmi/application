<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ورود | رستورانت هرات</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap-theme.css'); ?>">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo site_url('assets/img/favicon.png') ?>">
    <!-- Bootstrap rtl -->
    <link rel="stylesheet" href="<?=base_url('assets/css/rtl.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('components/font-awesome/css/font-awesome.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/css/AdminLTE.css'); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
.form-control {
    border-radius: 5px;
    /* box-shadow: none; */
    border-color: rgba(60, 60, 60, 0);
    box-shadow: inset 0 0 5px 1px rgba(0, 0, 0, 0.74);
    background-color: rgba(74, 74, 74, 0.53);
    height: 40px;
    color: #eaeae9;
}
.btn-primary {
    background-color: #1a5e86;
    border-color: rgba(54, 127, 169, 0);
    height: 40px;
    border-radius: 5px !important;
}
html{
    background-image: url(../../assets/img/BG.jpg);
}
body {
    /*background-color: transparent;*/
    background: rgba(239, 239, 239, 0.66);
    height: 100%;
    width: 100%;
    padding: 100px 0 14%;
    padding-top: 100px;
}


</style>
</head>
<?php
$user_name = array(
        'name'          => 'user_name',
        'id'            => 'user_name',
        'class'         => 'form-control',
        'placeholder'   => 'نام کاربری',
        'required'      => 'required',
);
$user_pass = array(
        'type'          => 'password',
        'name'          => 'user_pass',
        'id'            => 'user_pass',
        'class'         => 'form-control',
        'placeholder'   => 'رمز عبور',
        'required'      => 'required',
);
 ?>
<body class="hold-transition " >
    <div class="login-box " >
        <div class="login-logo">
            <b style="color:#5B5B5B">ورود به سیستم</b>
        </div>
        <!-- /.login-logo -->
            <div class="login-box-body" style="background: rgba(255, 255, 255, 0);">
            <p class="login-box-msg">ورود به سیستم مدیریت رستورانت و آشپزخانه</p>
            <?php $this->load->helper('form'); ?>
            <?=form_open('login/check_login');  ?>
                <div class="form-group has-feedback">
                    <?=form_input($user_name); ?>
                    <span class="fa fa-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <?=form_input($user_pass); ?>
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">ورود </i></button>
                    </div>
                <!-- /.col -->
                </div>
            <?=form_close(); ?>

        </div>
        <!-- /.login-box-body -->
        </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="<?=base_url('components/jquery/dist/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?=base_url('components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

    </body>
</html>
