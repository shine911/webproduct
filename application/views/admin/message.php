<?php
    if($type == 0):
    ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--text"><strong>Thông báo: </strong> <?php echo $message; ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
</div>
<?php 
    endif;
    if($type == 1):
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-inner--text"><strong>Lỗi: </strong> <?php echo $message; ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
</div>
<?php 
    endif;
?>