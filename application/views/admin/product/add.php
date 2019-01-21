<div class="row">

<div class="col-xl-12 order-xl-1">
    <div class="card bg-secondary shadow">
    <div class="card-header bg-white border-0">
        <div class="row align-items-center">
        <div class="col-12">
            <h3 class="mb-0">Thêm mới sản phẩm</h3>
        </div>
        </div>
    </div>
    <div class="card-body bg-white">
        <form method="post" action="" enctype="multipart/form-data">
        <div class="pl-lg-4">
            <nav>
            <div class="nav nav-tabs mb-4" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Chung</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">SEO</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Bài viết</a>
            </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <?php $this->load->view('admin/product/add_general'); ?>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <?php $this->load->view('admin/product/add_seo'); ?>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <?php $this->load->view('admin/product/add_editor'); ?>
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