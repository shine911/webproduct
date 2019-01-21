<div class="row">
    <div class="col">
        <div class="card shadow">
        <div class="card-header border-0">
            <?php
                if($message != ''){
                    $this->load->view('admin/message', $this->data);
                }
            ?>
            <div class="row">
                <div class="col-md-6"><h3>Danh mục sản phẩm</h3></div>
                <div class="col-md-6"><h3 class="text-right">Tổng số: <?php echo $total; ?></h3></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form class="form mb-0" method="get" action="<?php echo admin_url('product/search/') ?>">
                    <div class="form-group mb-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                        </div>
                    <input name="name" id="param_name" class="form-control" placeholder="VD: TV Sony Bravia, TV LG,..." type="text" value="<?php echo $this->input->get('name'); ?>">
                        <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Lọc</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center">
            <thead class="thead-light">
                <tr>
                <th scope="col">Mã số</th>
                <th scope="col" class="text-left">Tên</th>
                <th scope="col" class="text-right">Giá</th>
                <th scope="col">Danh mục</th>
                <th scope="col" class="text-right">
                    <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(32px, 32px, 0px);">
                        <a class="dropdown-item" href="<?php echo admin_url('product/add');?>">Thêm</a>
                        <a class="dropdown-item" href="#" onclick="return confirm('Bạn có chắc xóa hết tất cả danh mục?');">Xóa tất cả</a>
                    </div>
                    </div>
                </th>
                </tr>
            </thead>
            <tbody>
            <form action="" method="post">
            <?php foreach($list as $row): ?>
                <tr>
                <td class="text-center">
                    <?php echo $row->id; ?>
                </td>
                <td class="text-left">
                    <span title="Đã bán: <?php echo $row->buyed; ?>| Đã xem: <?php echo $row->view; ?>" data-toggle="tooltip" data-placement="bottom"><?php echo $row->name?>
                    </span>
                </td>
                <td class="text-right">
                    <?php if($row->discount > 0):
                        $priceNow = $row->price - $row->discount;    
                    ?>
                    <?php echo number_format($priceNow); ?> đ <br>
                    <span style="text-decoration: line-through;"><?php echo number_format($row->price); ?> đ</span>
                    <?php else: ?>
                    <?php echo number_format($row->price) ?> đ
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <?php echo $row->catalog->name; ?>
                </td>
                <td class="text-right">
                    <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(32px, 32px, 0px);">
                        <a class="dropdown-item" href="<?php echo admin_url('catalog/edit/').$row->id; ?>"><i class="fas fa-edit"></i>Chỉnh sửa</a>
                        <a class="dropdown-item" href="<?php echo admin_url('catalog/delete/'.$row->id); ?>" onclick="return confirm('Bạn có muốn xóa danh mục này?');"><i class="fas fa-trash-alt"></i>Xóa</a>
                    </div>
                    </div>
                </td>
                </tr>
            <?php endforeach; ?>
            </form>
            </tbody>
            </table>
        </div>
        <div class="card-footer py-4">
            <nav aria-label="...">
                <?php echo $links; ?>
            </nav>
        </div>
        </div>
    </div>
    </div>
</div>