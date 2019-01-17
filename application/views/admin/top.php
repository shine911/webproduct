<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
    <!-- Brand -->
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="<?php echo admin_url('home'); ?>"><?php echo substr($page_name, 2); ?></a>
    <!-- User -->
    <ul class="navbar-nav align-items-center d-none d-md-flex">
        <li class="nav-item dropdown">
        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
            <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold">Chào Admin</span>
            </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
            <h6 class="text-overflow m-0">Chúc ngày mới tốt lành!</h6>
            </div>
            <a href="<?php echo admin_url('profile'); ?>" class="dropdown-item">
            <i class="ni ni-single-02"></i>
            <span>Hồ sơ của tôi</span>
            </a>
            <a href="" class="dropdown-item">
            <i class="ni ni-support-16"></i>
            <span>Hỗ trợ</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo admin_url('admin/logout'); ?>" class="dropdown-item">
            <i class="ni ni-user-run"></i>
            <span>Thoát</span>
            </a>
        </div>
        </li>
    </ul>
    </div>
</nav>