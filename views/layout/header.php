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
<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"  style="font-size: 14px"><b>WRMIS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="font-size: 14px"><b><?=$this->session->general_info->ci_full_name ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>


      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
<!-- ============================================================================================================ -->
<!-- ======================================= NOTIFICATIONS =========================================== -->
<!-- ============================================================================================================ -->

          <li class="dropdown messages-menu hidden">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">۴ پیام خوانده نشده</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-right">
                        <img src="<?=base_url('assets/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        علیرضا
                        <small><i class="fa fa-clock-o"></i> ۵ دقیقه پیش</small>
                      </h4>
                      <p>متن پیام</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-right">
                        <img src="<?=base_url('assets/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        نگین
                        <small><i class="fa fa-clock-o"></i> ۲ ساعت پیش</small>
                      </h4>
                      <p>متن پیام</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-right">
                        <img src="<?=base_url('assets/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        نسترن
                        <small><i class="fa fa-clock-o"></i> امروز</small>
                      </h4>
                      <p>متن پیام</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-right">
                        <img src="<?=base_url('assets/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        نگین
                        <small><i class="fa fa-clock-o"></i> دیروز</small>
                      </h4>
                      <p>متن پیام</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-right">
                        <img src="<?=base_url('assets/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        نسترن
                        <small><i class="fa fa-clock-o"></i> ۲ روز پیش</small>
                      </h4>
                      <p>متن پیام</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">نمایش تمام پیام ها</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu hidden">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
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
          <li class="dropdown tasks-menu hidden">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">۹</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">۹ کار برای انجام دارید</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        ساخت دکمه
                        <small class="pull-left">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% تکمیل شده</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        ساخت قالب جدید
                        <small class="pull-left">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% تکمیل شده</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        تبلیغات
                        <small class="pull-left">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% تکمیل شده</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        ساخت صفحه فرود
                        <small class="pull-left">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% تکمیل شده</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">نمایش همه</a>
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
              <img src="<?=base_url('assets/img/profiles/'.$this->session->emp_info->emp_picture); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs">مدیر عمومی</span>
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
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?=site_url('employee/view/'.$this->session->emp_info->emp_id) ?>" class="btn btn-default btn-flat">پروفایل</a>
                </div>
                <div class="pull-left">
                  <a href="<?=site_url('login/logout') ?>" class="btn btn-danger btn-flat">خروج</a>
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