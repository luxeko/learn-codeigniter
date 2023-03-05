<div class="container mt-3">
    <div class="fs-2 mb-4 text-primary text">
        <a class="text-decoration-none text-dark" href="<?php echo base_url('/cms/categories') ?>">Danh mục /</a>
        Thêm danh mục
    </div>
    <form action="<?php echo base_url('cms/categories/create') ?>" method="POST">
        <div class="mb-3">
            <label for="categoryName" class="form-label">Tên danh mục</label>
            <input type="text" name="categoryName" class="form-control" id="categoryName">
            <span class="text-danger text d-flex">
                <?php if (form_error('categoryName')) {
                    echo '<span class="me-1">*</span>' . form_error('categoryName');
                } ?>
                <?php if ($this->session->flashdata('existsName')) {
                    echo $this->session->flashdata('existsName');
                } ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="categoryCode" class="form-label">Mã danh mục</label>
            <input type="text" class="form-control" name="categoryCode" id="categoryCode">
            <span class="text-danger text d-flex">
                <?php if (form_error('categoryCode')) {
                    echo '<span class="me-1">*</span>' . form_error('categoryCode');
                } ?>
				<?php if ($this->session->flashdata('existsCode')) {
					echo $this->session->flashdata('existsCode');
				} ?>
            </span>
        </div>
        <div class="mb-3">
            <label for="parentId" class="form-label">Danh mục cha</label>
            <select class="form-select" name="parentId" id="parentId">
                <option selected value="0">Chọn danh mục cha</option>
				<?php
					echo $data.$htmlOption;
				?>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-select" name="status" id="status">
                <option selected>Chọn trạng thái</option>
                <option value="Active">Active</option>
                <option value="Disable" selected>Disable</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" id="slug">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Miêu tả</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <button type="submit" class="btn btn-success me-3"><i class="bi bi-plus-lg"></i> Thêm</button>
            <button type="reset" class="btn btn-light"><i class="bi bi-arrow-clockwise"></i> Đặt lại</button>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>/application/javascript/slug.js"></script>
<script>
    const categoryName = document.getElementById('categoryName')
    const categoryCode = document.getElementById('categoryCode')
    const slug = document.getElementById('slug')
	renderSlug(categoryName, categoryCode, slug);
</script>
