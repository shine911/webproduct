<html>
<head>
    <?php $this->load->view('admin/head'); ?>
</head>

<body>
<!-- Left Side Bar -->
<?php $this->load->view('admin/left'); ?>
<!-- Main content -->
<div class="main-content">
<!-- Top Nav -->
<?php $this->load->view('admin/top'); ?>
<!-- Header -->
<?php $this->load->view('admin/header'); ?>
<!-- Page content -->
<?php $this->load->view($temp, $this->data); ?>
<!-- Footer -->
<?php $this->load->view('admin/footer') ?>
</body>

</html>