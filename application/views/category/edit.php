<?php
foreach ($category as $v) { ?>
    <div class="container mt-3">
        <div class="fs-2 mb-4 text-primary text">
            <a class="text-decoration-none text-dark" href="<?php echo base_url('/cms/categories') ?>">Danh mục /</a>
            Sửa danh mục
        </div>
        <form action="<?php echo base_url('cms/categories/update/' . $v->id) ?>" method="POST">
            <div class="mb-3">
                <label for="categoryName" class="form-label">Tên danh mục</label>
                <input type="text" name="categoryName" class="form-control" id="categoryName" value="<?php echo $v->categoryName ?>">
                <span class="text-danger text d-flex">
                    <?php if (form_error('categoryName')) {
                        echo '<span class="me-1">*</span>' . form_error('categoryName');
                    } ?>
                    <?php if ($this->session->flashdata('exists')) {
                        echo $this->session->flashdata('exists');
                    } ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="categoryCode" class="form-label">Mã danh mục</label>
                <input type="text" class="form-control" name="categoryCode" id="categoryCode" value="<?php echo
                                                                                                        $v->categoryCode ?>">
                <span class="text-danger text d-flex">
                    <?php if (form_error('categoryCode')) {
                        echo '<span class="me-1">*</span>' . form_error('categoryCode');
                    } ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="parentId" class="form-label">Danh mục cha</label>
                <select class="form-select" name="parentId" id="parentId">
                    <option selected>Chọn danh mục cha</option>
                    <option value="1">Nam</option>
                    <option value="2">Nữ</option>
                    <option value="3">Trẻ em</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-select" name="status" id="status">
                    <?php if ($v->status == 'Active') { ?>
                        <option>Chọn trạng thái</option>
                        <option value="Active" selected>Active</option>
                        <option value="Disable">Disable</option>
                    <?php } else if ($v->status == 'Disable') { ?>
                        <option>Chọn trạng thái</option>
                        <option value="Active">Active</option>
                        <option value="Disable" selected>Disable</option>
                    <?php } else { ?>
                        <option selected>Chọn trạng thái</option>
                        <option value="Active">Active</option>
                        <option value="Disable">Disable</option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" value="<?php echo $v->slug ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Miêu tả</label>
                <textarea class="form-control" name="description" id="description" rows="3"><?php echo $v->description ?>
				</textarea>
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-3"><i class="bi bi-plus-lg"></i> Cập nhật</button>
                <button type="reset" class="btn btn-light"><i class="bi bi-arrow-clockwise"></i> Đặt lại</button>
            </div>
        </form>
    </div>
<?php } ?>

<script>
    const toSlug = (str) => {
        // Chuyển hết sang chữ thường
        str = str.toLowerCase();

        // xóa dấu
        str = str
            .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
            .replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp

        // Thay ký tự đĐ
        str = str.replace(/[đĐ]/g, 'd');

        // Xóa ký tự đặc biệt
        str = str.replace(/([^0-9a-z-\s])/g, '');

        // Xóa khoảng trắng thay bằng ký tự -
        str = str.replace(/(\s+)/g, '-');

        // Xóa ký tự - liên tiếp
        str = str.replace(/-+/g, '-');

        // xóa phần dư - ở đầu & cuối
        str = str.replace(/^-+|-+$/g, '');

        // return
        return str;
    }

    const categoryName = document.getElementById('categoryName')
    const categoryCode = document.getElementById('categoryCode')
    const slug = document.getElementById('slug')
    categoryName.addEventListener('change', () => {
        slug.setAttribute('value', toSlug(categoryName.value) + '-' + categoryCode.value);
    })
    categoryCode.addEventListener('change', () => {
        slug.setAttribute('value', toSlug(categoryName.value) + '-' + categoryCode.value);
    })
</script>