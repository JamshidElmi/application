<!-- right side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-right image">
                <img src="<?=base_url('assets/img/profiles/'.$this->session->emp_info->emp_picture); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-right info">
                <p><?=$this->session->emp_info->emp_name ?> <?=$this->session->emp_info->emp_lname ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?=$this->session->emp_info->emp_position ?></a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="جستجو">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- ========================= STR Menu ========================= -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

        <!-- menu header -->
        <li class="header">آمار سیستم</li>

        <li class="active treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>صفحه نخست</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> رستورانت</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o "></i> آشپزخانه</a></li>
            </ul>
        </li>

        <!-- menu header -->
        <li class="header">مدیریت</li>

        <li class="treeview">
            <a href="#">
                <i class="fa ion-ios-people fa-lg"></i> <span>کارمندان</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li class="active"><a href="<?=site_url('employee/create'); ?>"><i class="fa fa-circle-o"></i> استخدام کارمند </a></li>
                <li><a href="<?=site_url('employee/'); ?>"><i class="fa fa-circle-o "></i> لیست کارمندان </a></li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa ion-person-add fa-lg"></i> <span>مشتریان</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li class="active"><a href="<?=site_url('customer/create'); ?>"><i class="fa fa-circle-o"></i> ثبت مشتری جدید </a></li>
                <li><a href="<?=site_url('customer/'); ?>"><i class="fa fa-circle-o "></i> لیست مشتریان</a></li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa ion-key fa-lg"></i> <span>مدیریت دسترسی</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li><a href="<?=site_url('user/'); ?>"><i class="fa fa-circle-o "></i> لیست حساب های کاربری </a></li>
                <li><a href="<?=site_url('user/create'); ?>"><i class="fa fa-circle-o "></i> ثبت حساب کاربری </a></li>
            </ul>
        </li>

        <!-- menu header -->
        <li class="header">امور مالی</li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-money"></i> <span>مدیریت مالی</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li><a href="<?=site_url('finance/accounts'); ?>"><i class="fa fa-circle-o "></i> ایجاد صندوق </a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-circle-o"></i> مصارف
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?=site_url('finance/expences/0'); ?>"><i class="fa fa-circle-o"></i> لیست مصارف روزانه</a></li>
                        <li><a href="<?=site_url('finance/new_expence'); ?>"><i class="fa fa-circle-o"></i> ثبت مصارف روزانه</a></li>

                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-circle-o"></i> گدام
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?=site_url('finance/expences/1'); ?>"><i class="fa fa-circle-o"></i> لیست مصارف برای گدام</a></li>
                        <li><a href="<?=site_url('finance/buy_stock'); ?>"><i class="fa fa-circle-o"></i> خرید برای گدام</a></li>
                        <li><a href="<?=site_url('order/expence_stock'); ?>"><i class="fa fa-circle-o"></i> مصرف از گدام</a></li>
                    </ul>
                </li>

                <li><a href="<?=site_url('finance/salary_payment'); ?>"><i class="fa fa-circle-o "></i> پرداخت معاش کارمندان </a></li>
            </ul>
        </li>

        <!-- menu header -->
        <li class="header">مدیریت منوها</li>

        <li class="treeview">
            <a href="#">
                <i class="fa ion-ios-bookmarks-outline fa-lg"></i> <span>منوها</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
=               <li class="treeview">
                    <a href="#"><i class="fa fa-circle-o"></i> منوی آشپزخانه
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?=site_url('menu/kitchen_menus'); ?>"><i class="fa fa-circle-o"></i>ثبت منو اصلی</a></li>
                        <li><a href="<?=site_url('menu/sub_menus'); ?>"><i class="fa fa-circle-o"></i> ثبت زیر منو</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-circle-o"></i> منوی رستورانت
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?=site_url('menu/resturant_menus'); ?>"><i class="fa fa-circle-o"></i>ثبت منو</a></li>
                        <li><a href="<?=site_url('setting/menu_category'); ?>"><i class="fa fa-circle-o"></i> ثبت نوع منو</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa ion-ios-bell fa-lg"></i> <span>سفارشات</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
=               <li class="treeview">
                    <a href="#"><i class="fa fa-circle-o"></i> سفارشات آشپزخانه
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?=site_url('order/create_order'); ?>"><i class="fa fa-circle-o"></i>ثبت سفارش</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-circle-o"></i> سفارشات رستورانت
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?=site_url('order/create_resturant_order'); ?>"><i class="fa fa-circle-o"></i>ثبت سفارش</a></li>
                    </ul>
                </li>
            </ul>
        </li>



        <!-- menu header -->
        <li class="header">بخش تنظیمات</li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-gear"></i> <span>تنظیمات</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li><a href="<?=site_url('setting/units'); ?>"><i class="fa fa-circle-o "></i> ثبت واحدهای مقیاسی </a></li>
                <li><a href="<?=site_url('setting/jobs'); ?>"><i class="fa fa-circle-o "></i> ثبت وظیفه </a></li>
                <li><a href="<?=site_url('setting/stock_units'); ?>"><i class="fa fa-circle-o "></i> ثبت واحدهای گدام </a></li>
                <li><a href="<?=site_url('setting/menu_category'); ?>"><i class="fa fa-circle-o "></i> ثبت نوعیت منو </a></li>
                <li><a href="<?=site_url('setting/desks'); ?>"><i class="fa fa-circle-o "></i> ثبت میز </a></li>
                <li><a href="<?=site_url(''); ?>"><i class="fa fa-circle-o "></i> ویرایش معلومات سیستم </a></li>
                <li><a href="<?=site_url(''); ?>"><i class="fa fa-circle-o "></i> پشتیبان گیری</a></li>
            </ul>
        </li>

        </ul>

        <!-- ========================= END Menu ========================= -->

    </section>
<!-- /.sidebar -->
</aside>