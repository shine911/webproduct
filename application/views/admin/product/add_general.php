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
        <input type="file" name="images[]" id="param_images" class="form-control-file">
    </div>
</div>
<hr class="my-4">
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label">Giá: * </label>
    <div class="col-sm-6">
        <input type="text" name="price" id="param_price" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label">Giảm giá: </label>
    <div class="col-sm-6">
        <input type="text" name="price" id="param_discount" class="form-control">
    </div>
</div>
<hr class="my-4">
<div class="form-group row">
    <label for="price" class="col-sm-2 col-form-label">Thể loại: * </label>
    <div class="col-sm-6">
        <select name="catalog" id="param_catalog" class="custom-select">
            <option value="1">Ex1</option>
            <option value="2">Ex2</option>
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