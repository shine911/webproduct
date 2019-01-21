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

<!-- Page content -->
<div class="container-fluid mt--7">
<?php $this->load->view($temp, $this->data); ?>
</div>
<!-- Footer -->
<?php $this->load->view('admin/footer') ?>
</body>

</html>