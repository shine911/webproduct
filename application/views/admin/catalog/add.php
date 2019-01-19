<div class="row">

<div class="col-xl-12 order-xl-1">
    <div class="card bg-secondary shadow">
    <div class="card-header bg-white border-0">
        <div class="row align-items-center">
        <div class="col-12">
            <h3 class="mb-0">Thêm mới danh mục</h3>
        </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="">
        <div class="pl-lg-4">
            <div class="row">
            <div class="col-lg-6">
                <div class="form-group focused">
                <label class="form-control-label" for="input-username">Tên danh mục <span>*</span> :</label>
                <input type="text" name="name" id="param_name" class="form-control form-control-alternative" placeholder="VD: Máy giặt, Tủ Lạnh, Tivi,..." value="<?php echo set_value('name')?>">
                <?php echo form_error('name')?>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-6">
                <div class="form-group focused">
                <label class="form-control-label" for="input-first-name">Danh mục cha:</label>
                <select class="custom-select form-control form-control-alternative" name="parent_id" id="param_parent_id">
                        <option value="0">Là danh mục cha</option>
                        <?php foreach($parent as $row):?>
                        <option value="<?php echo $row->parent_id; ?>"><?php echo $row->name; ?></option>
                        <?php endforeach; ?>
                </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group focused">
                <label class="form-control-label" for="slt">Thứ tự hiển thị:</label>
                <input type="text" name="sort_order" id="param_sort_order" class="form-control form-control-alternative" placeholder="VD: 1, 2, 3..." value="<?php echo set_value('sort_order')?>">
                </div>
            </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-right">
            <button class="btn btn-primary btn-icon-only" title="Thêm mới" type="submit"><i class="fas fa-check"></i></button>
            <button class="btn btn-danger btn-icon-only" type="reset"><i class="fas fa-ban"></i></button>
        </div>
        </form>
    </div>
    </div>
</div>
</div>