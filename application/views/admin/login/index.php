<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('admin/head'); ?>
</head>

<body class="bg-default">
<div class="main-content">
<!-- Header -->
<div class="header bg-gradient-primary py-7 py-lg-8">
</div>
<!-- Page content -->
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary shadow border-0">
        <div class="card-body px-lg-5 py-lg-5">
            <div class="text-center text-muted mb-4">
            <small>Ban Quản Trị</small>
            </div>
            <form role="form" id="form" action="" method="post">
            <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                </div>
                <input class="form-control" placeholder="Username" type="text" name="username" id="param_username">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" placeholder="Password" type="password" name="password" id="param_password">
                </div>
            </div>
            <?php echo form_error('login'); ?>
            <div class="text-center">
                <input type="submit" value="Đăng nhập" class="btn btn-primary my-4">
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
</div>
</div>
<!-- Footer -->
<footer class="py-5">
<div class="container">
    <div class="row align-items-center justify-content-xl-between">
    <div class="col-xl-6">
        <div class="copyright text-center text-xl-left text-muted">
        &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
        </div>
    </div>
    <div class="col-xl-6">
        <ul class="nav nav-footer justify-content-center justify-content-xl-end">
        <li class="nav-item">
            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
        </li>
        <li class="nav-item">
            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
        </li>
        <li class="nav-item">
            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
        </li>
        <li class="nav-item">
            <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
        </li>
        </ul>
    </div>
    </div>
</div>
</footer>
<!-- Argon Scripts -->
<!-- Core -->
<script src="<?php echo public_url('admin/argon'); ?>/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?php echo public_url('admin/argon'); ?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Argon JS -->
<script src="<?php echo public_url('admin/argon'); ?>/assets/js/argon.js?v=1.0.0"></script>
</body>

</html>