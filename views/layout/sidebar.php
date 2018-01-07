<?php $utype = $this->session->user_info->user_type; ?>
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
                <a href=""><i class="fa fa-circle text-success"></i> <?=$this->session->emp_info->emp_position ?></a>
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

        <li class="treeview" id="menu_dashboard">
            <a href="">
                <i class="fa fa-dashboard"></i> <span>صفحه نخست</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li id="menu1_resturant"><a href="<?=site_url('dashboard/') ?>"><i class="fa fa-circle-o"></i> رستورانت</a></li>
                <li id="menu1_kitchen"><a href="<?=site_url('dashboard/') ?>"><i class="fa fa-circle-o "></i> آشپزخانه</a></li>
            </ul>
        </li>

        <!-- menu header -->
        <li class="header no-garson">مدیریت</li>

        <li class="treeview no-garson" id="menu_employees">
            <a href="">
                <i class="fa ion-ios-people fa-lg"></i> <span>کارمندان</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li id="menu1_create_empployee"><a href="<?=site_url('employee/create'); ?>"><i class="fa fa-circle-o"></i> استخدام کارمند </a></li>
                <li id="menu1_create_empployee_list"><a href="<?=site_url('employee/'); ?>"><i class="fa fa-circle-o "></i> لیست کارمندان </a></li>
            </ul>
        </li>

        <li class="treeview no-garson" id="menu_customers">
            <a href="">
                <i class="fa ion-person-add fa-lg"></i> <span>مشتریان</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li id="menu1_create_cusomer"><a href="<?=site_url('customer/create'); ?>"><i class="fa fa-circle-o"></i> ثبت مشتری جدید </a></li>
                <li id="menu1_create_cusomer_list"><a href="<?=site_url('customer/'); ?>"><i class="fa fa-circle-o "></i> لیست مشتریان</a></li>
            </ul>
        </li>

        <li class="treeview no-garson only-admin" id="menu_permissions">
            <a href="">
                <i class="fa ion-android-unlock fa-lg"></i> <span>مدیریت دسترسی</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li id="menu1_create_user"><a href="<?=site_url('user/create'); ?>"><i class="fa fa-circle-o "></i> ثبت حساب کاربری </a></li>
                <li id="menu1_user_list"><a href="<?=site_url('user/'); ?>"><i class="fa fa-circle-o "></i> لیست حساب های کاربری </a></li>
            </ul>
        </li>

        <!-- menu header -->
        <li class="header no-garson">امور مالی</li>

        <li class="treeview no-garson" id="menu_finance">
            <a href="">
                <i class="fa  fa-dollar fa-lg"></i> <span>مدیریت مالی</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu ">
                <li class="treeview" id="menu1_accounts">
                    <a href=""><i class="fa fa-circle-o"></i>صندوق
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="menu2_create_account"><a href="<?=site_url('finance/accounts'); ?>"><i class="fa fa-circle-o "></i> ایجاد صندوق </a></li>
                        <li id="menu2_debit_credit"><a href="<?=site_url('finance/credit_debit/'.base_account()->acc_id); ?>"><i class="fa fa-circle-o"></i>جمع و برداشت</a></li>
                        <li id="menu2_partner_debit_credit" class="only-admin"><a href="<?=site_url('finance/partner_credit_debit/'.$this->session->partner_id); ?>"><i class="fa fa-circle-o"></i>سهام</a></li>
                    </ul>
                </li>
                <li class="treeview" id="menu1_expences">
                    <a href=""><i class="fa fa-circle-o"></i> مصارف
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="menu2_create_daily_expence"><a href="<?=site_url('finance/new_expence'); ?>"><i class="fa fa-circle-o"></i> ثبت مصارف روزانه</a></li>
                        <li id="menu2_daily_expences"><a href="<?=site_url('finance/expences/0'); ?>"><i class="fa fa-circle-o"></i> لیست مصارف روزانه</a></li>

                    </ul>
                </li>


                <li class="treeview" id="menu1_stock">
                    <a href=""><i class="fa fa-circle-o"></i> گدام
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="menu2_buy_for_stock"><a href="<?=site_url('finance/buy_stock'); ?>"><i class="fa fa-circle-o"></i> خریداری برای گدام</a></li>
                        <li id="menu2_buy_for_stock_list"><a href="<?=site_url('finance/expences/1'); ?>"><i class="fa fa-circle-o"></i> لیست خریداری گدام</a></li>
                        <li class="treeview" id="menu2_expence_from_stock">
                            <a href=""><i class="fa fa-circle-o"></i> مصارف از گدام
                                <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                            </a>
                            <ul class="treeview-menu">
                                <li id="menu3_create_expence_from_stock"><a href="<?=site_url('order/expence_stock'); ?>"><i class="fa fa-circle-o"></i>ثبت مصارف از گدام</a></li>
                                <li id="menu3_restirant_stock_expences"><a href="<?=site_url('order/stock_expence_resturant/resturant'); ?>"><i class="fa fa-circle-o"></i>  مصارف رستورانت</a></li>
                                <li id="menu3_fastfood_stock_expences"><a href="<?=site_url('order/stock_expence_resturant/fast_food'); ?>"><i class="fa fa-circle-o"></i>  مصارف فست فود</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>

                <li id="menu1_salary_payment" class="only-admin"><a href="<?=site_url('finance/salary_payment'); ?>"><i class="fa fa-circle-o "></i> پرداخت معاش کارمندان </a></li>
            </ul>
        </li>

         <!-- menu header -->
        <li class="header no-garson no-garson">گزارشات سیستم</li>

        <li class="treeview no-garson" id="menu_reports">
            <a href="">
                <i class="fa ion-pie-graph fa-lg"> </i> <span>گزارشات</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu" id="menu1_report_salary">
               <li class="treeview">
                    <a href=""><i class="fa fa-circle-o"></i> گزارش معاشات
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="menu2_resturant_salary"><a href="<?=site_url('reports/salaries/salary_monthly'); ?>"><i class="fa fa-circle-o"></i>کارمندان رستورانت</a></li>
                        <li id="menu2_kitchen_salary"><a href="<?=site_url('menu/sub_menus'); ?>"><i class="fa fa-circle-o"></i> کارمندان آشپزخانه</a></li>
                    </ul>
                </li>

            </ul>
        </li>


        <!-- menu header -->
        <li class="header">مدیریت منوها</li>

        <li class="treeview" id="menu_menus">
            <a href="">
                <i class="fa ion-ios-bookmarks-outline fa-lg"></i> <span>منوها</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu" >
               <li class="treeview" id="menu1_kitchen_menus">
                    <a href=""><i class="fa fa-circle-o"></i> منوی آشپزخانه
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="menu2_create_base_menu"><a class="read-only-garson" href="<?=site_url('menu/kitchen_menus'); ?>"><i class="fa fa-circle-o"></i>ثبت منو اصلی</a></li>
                        <li id="menu2_create_sub_menu"><a class="read-only-garson" href="<?=site_url('menu/sub_menus'); ?>"><i class="fa fa-circle-o"></i> ثبت زیر منو</a></li>
                    </ul>
                </li>

                <li class="treeview" id="menu1_resturant_menus">
                    <a href=""><i class="fa fa-circle-o"></i> منوی رستورانت
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="menu2_create_menu"><a class="read-only-garson" href="<?=site_url('menu/resturant_menus'); ?>"><i class="fa fa-circle-o"></i>ثبت منو</a></li>
                        <li id="menu2_create_menu_category"><a class="read-only-garson" href="<?=site_url('setting/menu_category'); ?>"><i class="fa fa-circle-o"></i> ثبت نوع منو</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="treeview" id="menu_orders">
            <a href="">
                <i class="fa fa-shopping-basket"></i> <span>سفارشات</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
               <li class="treeview" id="menu1_kitchen_orders">
                    <a href=""><i class="fa fa-circle-o"></i> سفارشات آشپزخانه
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="menu2_create_kitchen_order"><a href="<?=site_url('order/create_order'); ?>"><i class="fa fa-circle-o"></i>ثبت سفارش</a></li>
                        <li id="menu2_kitchen_order_list"><a href="<?=site_url('order/kitchen_orders'); ?>"><i class="fa fa-circle-o"></i>لیست سفارشات </a></li>
                    </ul>
                </li>

                <li class="treeview" id="menu1_resturant_orders">
                    <a href=""><i class="fa fa-circle-o"></i> سفارشات رستورانت
                        <span class="pull-left-container">
                            <i class="fa fa-angle-right pull-left"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="menu2_create_resturant_order"><a href="<?=site_url('order/create_resturant_order'); ?>"><i class="fa fa-circle-o"></i>ثبت سفارش</a></li>
                        <li id="menu2_resturant_order_list"><a href="<?=site_url('order/resturant_orders'); ?>"><i class="fa fa-circle-o"></i>لیست سفارشات</a></li>
                    </ul>
                </li>
            </ul>
        </li>



        <!-- menu header -->
        <li class="header">بخش تنظیمات</li>

        <li class="treeview" id="menu_settings">
            <a href="">
                <i class="fa fa-gear fa-lg"></i> <span>تنظیمات</span>
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li id="menu1_units" class=""><a href="<?=site_url('setting/units'); ?>"><i class="fa fa-circle-o "></i> واحدات مقیاسی </a></li>
                <li id="menu1_stock_units" class="no-garson"><a href="<?=site_url('setting/stock_units'); ?>"><i class="fa fa-circle-o "></i> واحدات گدام </a></li>
                <li id="menu1_jobs" class="no-garson only-admin"><a href="<?=site_url('setting/jobs'); ?>"><i class="fa fa-circle-o "></i> وظایف </a></li>
<!--                <li id="menu1_menu_category" class=""><a href="--><?//=site_url('setting/menu_category'); ?><!--"><i class="fa fa-circle-o "></i> نوعیت منو </a></li>-->
                <li id="menu1_desks" class="no-garson "><a href="<?=site_url('setting/desks'); ?>"><i class="fa fa-circle-o "></i> ثبت میز </a></li>
                <li id="menu1_discounts" class="no-garson only-admin"><a href="<?=site_url('setting/discounts'); ?>"><i class="fa fa-circle-o "></i> تخفیفات </a></li>
                <li id="menu1_partners" class="no-garson only-admin"><a href="<?=site_url('setting/partners'); ?>"><i class="fa fa-circle-o "></i> سهامداران </a></li>
                <li id="menu1_edit_info" class="no-garson only-admin"><a href="<?=site_url('setting/edit_info'); ?>"><i class="fa fa-circle-o "></i> ویرایش معلومات سیستم </a></li>
                <li id="menu1_backup" class="no-garson only-admin"><a href="<?=site_url('setting/backup'); ?>"><i class="fa fa-circle-o "></i> پشتیبان گیری</a></li>
            </ul>
        </li>

        </ul>

        <!-- ========================= END Menu ========================= -->

    </section>
<!-- /.sidebar -->
</aside>