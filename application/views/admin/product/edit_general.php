<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Tên sản phẩm: * </label>
    <div class="col-sm-6">
        <input type="text" name="name" id="param_name" class="form-control" value="<?php echo $product->name; ?>">
    </div>
</div>
<div class="form-group row">
    <label for="image" class="col-sm-2 col-form-label">Ảnh minh họa: </label>
    <div class="col-sm-6">
        <input type="file" name="image" id="param_image" class="form-control-file">
    </div>
</div>
<div class="form-group row">
    <label for="image" class="col-sm-2 col-form-label">Ảnh minh họa đã tải lên: </label>
    <div class="col-sm-6">
    <img style="width: 200px; height: 200px;" src="<?php echo base_url().'upload/product/'.$product->image_link ?>" alt="Ảnh minh họa" class="img-thumbnail">
    </div>
</div>
<div class="form-group row">
    <label for="image_list" class="col-sm-2 col-form-label">Ảnh kèm theo: </label>
    <div class="col-sm-6">
        <input type="file" name="image_list[]" id="param_image_list" class="form-control-file" multiple>
    </div>
</div>
<div class="form-group row">
    <label for="image" class="col-sm-2 col-form-label">Ảnh kèm theo đã tải lên: </label>
    <div class="col-sm-6">
    <?php $image_list = json_decode($product->image_list); 
    foreach($image_list as $img): ?>
    <img style="width: 200px; height: 200px;" src="<?php echo base_url().'upload/product/'.$img ?>" alt="Ảnh kèm theo" class="img-thumbnail">
    <?php endforeach; ?>
    </div>
</div>
<hr class="my-4">
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label">Giá: * </label>
    <div class="col-sm-6">
        <input type="text" _autocheck="true" name="price" id="param_price" class="form-control format_number" value="<?php echo $product->price; ?>">
    </div>
</div>
<div class="form-group row">
    <label for="discount" class="col-sm-2 col-form-label">Giảm giá: </label>
    <div class="col-sm-6">
        <input type="text" _autocheck="true" name="discount" id="param_discount" class="form-control format_number" value="<?php echo $product->discount; ?>">
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
        <input type="text" name="warranty" id="param_warranty" class="form-control" value="<?php echo $product->warranty; ?>">
    </div>
</div>
<hr class="my-4">
<div class="form-group row">
    <label for="warranty" class="col-sm-2 col-form-label">Quà tặng:</label>
    <div class="col-sm-6">
        <textarea class="form-control" name="gifts" id="param_gifts" cols="30" rows="10"><?php echo $product->gifts; ?></textarea>
    </div>
</div>