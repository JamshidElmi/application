<style>
    /* permission access controlls */
    .read-only {
    <?php echo ($this->session->user_info->user_type == 2 || $this->session->user_info->user_type == 3) ? 'pointer-events: none;cursor: not-allowed;opacity: 0.6;' : ''; ?>
    }

    .only-admin {
    <?php echo ($this->session->user_info->user_type != 1 ) ? 'display: none !important' : ''; ?>
    }

    .no-garson {
    <?php echo ($this->session->user_info->user_type == 3 ) ?'display: none !important' : ''; ?>
    }

    .read-only-garson {
    <?php echo ($this->session->user_info->user_type == 3 ) ? 'pointer-events: none;cursor:not-allowed;opacity: 0.6;' : ''; ?>
    }

    .lock {
        pointer-events: none;
        cursor: not-allowed;
        opacity: 0.6;
    }
</style>
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini" style="font-size: 14px"><b>WRMIS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="font-size: 14px"><b><?= $this->session->general_info->ci_full_name ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="collapse navbar-collapse pull-right hidde-xs" id="navbar-collapse">
            <ul class="nav navbar-nav">
<!--                <li><a href="#">سفارش آشپزخانه</a></li>-->
                <li class="dropdown hidden">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">منوی آبشاری
                        <span class="caret"></span></a>
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


        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <!-- ============================================================================================================ -->
                <!-- ======================================= NOTIFICATIONS =========================================== -->
                <!-- ============================================================================================================ -->
                <li>
                    <a href="<?= site_url('order/garson_ordering') ?>" data-toggle="tooltip" data-original-title="Get Restaurant Oreder"><i class="fa ion-coffee fa-lg"></i></a>
                </li>

                <li class="dropdown messages-menu ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa fa-shopping-basket"></i>
                        <?php $time = (new \DateTime())->format('H:i:00'); ?>
                        <?php $date = mds_date("Y-m-d", "now", 1); ?>
                        <span class="label label-success"><?= $this->order_count ?>
              </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">  <?= $this->order_count ?> سفارش گرفته شده</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">


                                <!-- start message -->
                                <?php foreach ($this->order_list as $order): ?>
                                    <?php if ($date == $order->ord_date): ?>
                                        <?php if ($order->ord_time >= $time): ?>

                                            <li>
                                                <a href="<?= ($order->ord_type == 'resturant') ? ($order->cus_name) ? site_url('order/print_resturant_bill/' . $order->ord_id) : site_url('order/print_resturant_bill/' . $order->ord_id . '/no_customer') : site_url('order/print_order_bill/' . $order->ord_id) ?>">
                                                    <div class="pull-right">
                                                        <?php if ($order->cus_picture): ?>
                                                            <img src="<?= base_url('assets/img/customers/' . $order->cus_picture); ?>" class="img-circle" alt="IMG">
                                                        <?php else: ?>
                                                            <img src="<?= base_url('assets/img/info/' . $this->session->general_info->ci_logo); ?>" class="img-circle" alt="IMG">
                                                        <?php endif; ?>
                                                    </div>
                                                    <h4>
                                                        <?php if ($order->cus_name): ?>
                                                            <?= $order->cus_name . ' ' . $order->cus_lname ?>
                                                        <?php else: ?>
                                                            <?php if ($order->desk_name): ?>
                                                                <?= $order->desk_name ?>
                                                            <?php else: ?>
                                                                سفارش رستورانت
                                                            <?php endif ?>
                                                        <?php endif; ?>
                                                        <small><i class="fa fa-calendar"></i>
                                                            <?= show_date("j F Y", $order->ord_date); ?>
                                                        </small>
                                                        <small style="margin-top: 14px"><i class="fa fa-clock-o"></i>
                                                            <?php
                                                            $exp_time = explode(':', $order->ord_time);
                                                            echo $exp_time[0] . ':' . $exp_time[1];
                                                            //echo ($exp_time[0] > 11)? 'بعد از ظهر' : 'ثبل از ظهر';
                                                            ?>
                                                        </small>
                                                    </h4>
                                                    <p><?= ($order->ord_type == 'resturant') ? 'سفارش رستورانت' : 'سفارش آشپزخانه' ?></p>
                                                </a>
                                            </li>
                                        <?php endif ?>
                                    <?php else: ?>
                                        <li>
                                            <a href="<?= ($order->ord_type == 'resturant') ? ($order->cus_name) ? site_url('order/print_resturant_bill/' . $order->ord_id) : site_url('order/print_resturant_bill/' . $order->ord_id . '/no_customer') : site_url('order/print_order_bill/' . $order->ord_id) ?>">
                                                <div class="pull-right">
                                                    <?php if ($order->cus_picture): ?>
                                                        <img src="<?= base_url('assets/img/profiles/' . $order->cus_picture); ?>" class="img-circle" alt="IMG">
                                                    <?php else: ?>
                                                        <img src="<?= base_url('assets/img/info/' . $this->session->general_info->ci_logo); ?>" class="img-circle" alt="IMG">
                                                    <?php endif; ?>
                                                </div>
                                                <h4>
                                                    <?php if ($order->cus_name): ?>
                                                        <?= $order->cus_name . ' ' . $order->cus_lname ?>
                                                    <?php else: ?>
                                                        <?php if ($order->desk_name): ?>
                                                            <?= $order->desk_name ?>
                                                        <?php else: ?>
                                                            سفارش رستورانت
                                                        <?php endif ?>
                                                    <?php endif; ?>
                                                    <small><i class="fa fa-calendar"></i>
                                                        <?= show_date("j F Y", $order->ord_date); ?>
                                                    </small>
                                                    <small style="margin-top: 14px"><i class="fa fa-clock-o"></i>
                                                        <?php
                                                        $exp_time = explode(':', $order->ord_time);
                                                        echo $exp_time[0] . ':' . $exp_time[1];
                                                        //echo ($exp_time[0] > 11)? 'بعد از ظهر' : 'ثبل از ظهر';
                                                        ?>
                                                    </small>
                                                </h4>
                                                <p><?= ($order->ord_type == 'resturant') ? 'سفارش رستورانت' : 'سفارش آشپزخانه' ?></p>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <!-- end message -->


                            </ul>
                        </li>
                        <li class="footer"><a href="<?= site_url('order/resturant_orders') ?>"> سفارشات رستورانت</a>
                            <a href="<?= site_url('order/kitchen_orders') ?>"> سفارشات آشپزخانه</a></li>
                    </ul>
                </li>


                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu hidden">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa  fa-bell-o"></i>
                        <span class="label label-warning">۱۰</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">۱۰ اعلان جدید</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> ۵ کاربر جدید ثبت نام کردند
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> اخطار دقت کنید
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> ۴ کاربر جدید ثبت نام کردند
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> ۲۵ سفارش جدید
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> نام کاربریتان را تغییر دادید
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">نمایش همه</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->


                <li class="dropdown tasks-menu ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-database"></i>
                        <span class="label label-warning"><?= $this->stock_count ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><?= $this->stock_count ?> هشدار کمبود جنس در گدام</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <!-- Task item -->
                                <?php foreach ($this->stock_list as $stock): ?>

                                    <li>
                                        <a href="<?= site_url('setting/stock_units') ?>">
                                            <h3>
                                                <?php
                                                $max = $stock->st_max_count;
                                                $count = $stock->st_count;
                                                $persent = $count * 100 / $max;
                                                ?>
                                                <?=$stock->st_name ?>
                                                <small class="pull-left"> <?=$stock->st_count.' '.$stock->unit_name ?> </small> &nbsp;&nbsp;&nbsp; <?=($stock->st_count == 0) ? ' <i style="float: right;margin-left: 5px" class="fa fa-ban fa-lg text-red"></i> ': ' <i style="float: right;margin-left: 5px" class="fa fa-warning fa-lg text-yellow"></i> ' ?>
                                            </h3>

                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-<?=($stock->st_count == 0)?'red':'yellow' ?>" style="width: <?=$persent?>%" role="progressbar"
                                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% تکمیل شده</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>

                                <!-- end task item -->

                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="<?= site_url('setting/stock_units') ?>">نمایش همه</a>
                        </li>
                    </ul>
                </li>

                <!-- ============================================================================================================ -->
                <!-- ======================================= END NOTIFICATIONS =========================================== -->
                <!-- ============================================================================================================ -->


                <!-- ============================================================================================================ -->
                <!-- ============================================= USER ACCOUNT ================================================= -->
                <!-- ============================================================================================================ -->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url('assets/img/profiles/' . $this->session->emp_info->emp_picture); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs">مدیر عمومی</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= base_url('assets/img/profiles/' . $this->session->emp_info->emp_picture); ?>" class="img-circle" alt="User Image">

                            <p>
                                <?= $this->session->emp_info->emp_name ?> <?= $this->session->emp_info->emp_lname ?>
                                | <?= $this->session->emp_info->emp_position ?>
                                <small>مدیریت آشپزخانه</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="<?= site_url('employee/view/' . $this->session->emp_info->emp_id) ?>" class="btn btn-default btn-flat"><i class="fa fa-user"></i>
                                    پروفایل</a>
                            </div>
                            <div class="pull-left">
                                <a href="<?= site_url('login/logout') ?>" class="btn btn-danger btn-flat">
                                    <i class="fa  fa-power-off"></i> خروج </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- ============================================================================================================ -->
                <!-- =========================================== END USER ACCOUNT =============================================== -->
                <!-- ============================================================================================================ -->

                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>