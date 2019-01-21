<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Tên sản phẩm: * </label>
    <div class="col-sm-6">
        <input type="text" name="name" id="param_name" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="image" class="col-sm-2 col-form-label">Ảnh minh họa: </label>
    <div class="col-sm-6">
        <input type="file" name="image" id="param_image" class="form-control-file">
    </div>
</div>
<div class="form-group row">
    <label for="image" class="col-sm-2 col-form-label">Ảnh kèm theo: </label>
    <div class="col-sm-6">
        <input type="file" name="image_list[]" id="param_image_list" class="form-control-file" multiple>
    </div>
</div>
<hr class="my-4">
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label">Giá: * </label>
    <div class="col-sm-6">
        <input type="text" _autocheck="true" name="price" id="param_price" class="form-control format_number">
    </div>
</div>
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label">Giảm giá: </label>
    <div class="col-sm-6">
        <input type="text" _autocheck="true" name="price" id="param_discount" class="form-control format_number">
    </div>
</div>
<hr class="my-4">
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label">Thể loại: * </label>
    <div class="col-sm-6">
        <select name="catalog" id="param_catalog" class="custom-select">
            <?php foreach($catalogs as $row): 
                    if(count($row->subs)>0):
            ?>
                <optgroup label="<?php echo $row->name ?>">
                <?php foreach($row->subs as $sub): ?>
                    <option value="<?php echo $sub->id ?>" <?php echo $this->input->get('catalog') == $sub->id?'selected':'' ?> ><?php echo $sub->name; ?></option>
                <?php endforeach; 
                else:?>
                <option value="<?php echo $row->id ?>" <?php echo $this->input->get('catalog') == $row->id?'selected':'' ?> ><?php echo $row->name; ?></option>
            <?php   endif;
                    endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="warranty" class="col-sm-2 col-form-label">Bảo hành:</label>
    <div class="col-sm-6">
        <input type="text" name="warranty" id="param_warranty" class="form-control">
    </div>
</div>
<hr class="my-4">
<div class="form-group row">
    <label for="warranty" class="col-sm-2 col-form-label">Quà tặng:</label>
    <div class="col-sm-6">
        <textarea class="form-control" name="gift" id="param_gift" cols="30" rows="10"></textarea>
    </div>
</div>