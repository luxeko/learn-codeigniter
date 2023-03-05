<div class="container mt-3">
	<div class="fs-2 mb-4 text-primary text">
		<a class="text-decoration-none text-dark" href="<?php echo base_url('/cms/products') ?>">Sản phẩm /</a>
		Thêm sản phẩm
	</div>
	<form action="<?php echo base_url('cms/products/create') ?>" method="POST" enctype="multipart/form-data">
		<div class="row mb-4">
			<div class="col-7">
				<div class="mb-3">
					<label for="productName" class="form-label">Tên sản phẩm</label>
					<input type="text" name="productName" class="form-control" id="productName">
					<span class="text-danger text d-flex">
						<?php if (form_error('productName')) {
							echo '<span class="me-1">*</span>' . form_error('productName');
						} ?>
					</span>
				</div>
				<div class="mb-3">
					<label for="productCode" class="form-label">Mã sản phẩm</label>
					<input type="text" class="form-control" name="productCode" id="productCode">
					<span class="text-danger text d-flex">
						<?php if (form_error('productCode')) {
							echo '<span class="me-1">*</span>' . form_error('productCode');
						} ?>
					</span>
				</div>
				<div class="mb-3">
					<label for="slug" class="form-label">Slug</label>
					<input type="text" name="slug" class="form-control" id="slug">
					<span class="text-danger text d-flex">
						<?php if (form_error('slug')) {
							echo '<span class="me-1">*</span>' . form_error('slug');
						} ?>
					</span>
				</div>
				<div class="mb-3">
					<label for="categoryId" class="form-label">Danh mục sản phẩm</label>
					<select class="form-select" name="categoryId" id="categoryId">
						<option selected>Chọn danh mục</option>
						<?php echo $data . $htmlOption; ?>
					</select>
					<span class="text-danger text d-flex">
						<?php if (form_error('categoryId')) {
							echo '<span class="me-1">*</span>' . form_error('categoryId');
						} ?>
					</span>
				</div>
				<div class="mb-3">
					<label for="description" class="form-label">Miêu tả</label>
					<input type="text" class="form-control" name="description" id="description">
				</div>

				<div class="mb-3">
					<label for="validationTags" class="form-label">Tags</label>
					<select class="form-select py-2 select2_tags" name="tag_id[]" id="validationTags"
							multiple="multiple">
						<?php
						foreach ($tags as $value) {
							echo "<option value=" . $value->id . ">" . $value->tagName . "</option>";
						}
						?>
					</select>
				</div>
				<div class="mb-3" id="list-items"></div>
				<div class="mb-3">
					<a class="btn btn-success me-3 text-white add-item"><i class="bi bi-plus-circle-fill me-2"></i> Add
						more</a>
				</div>
				<div class="mb-3">
					<label for="overview" class="form-label">Tổng quan (Overview)</label>
					<textarea class="form-control" name="overview" id="overview" rows="3"></textarea>
				</div>
				<div class="mb-3">
					<label for="status" class="form-label">Trạng thái</label>
					<select class="form-select" name="status" id="status">
						<option selected>Chọn trạng thái</option>
						<option value="Active">Active</option>
						<option value="Disable" selected>Disable</option>
					</select>
				</div>
			</div>
			<div class="col-5 sticky-top pt-2 pb-4"
				 style="height: 100%; top: 20px;box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);border-radius: 0.375rem;">
				<div class="form-group mb-4 d-flex flex-column">
					<label for="imageProductPath">Chọn ảnh chính (520px : 520px)</label>
					<input class="form-control-file" type="file" id="imageProductPath" name="imageProductPath">
					<?php
					if ($this->session->flashdata('error_file')) { ?>
						<small class="text text-danger mt-2 "><?php echo $this->session->flashdata('error_file')
							?></small>
					<?php } ?>
					<div hidden="hidden" class="my-3 ms-0 border-0 border border-light"
						 style="width:300px; height:300px" id="previewLayout">
						<img src="" alt="" style="width:100%; height: 100%" id="previewImage">
					</div>
				</div>
				<div class="form-group d-flex flex-column">
					<label for="thumbnailPath">Chọn các ảnh chi tiết</label>
					<input class="form-control-file" multiple="" type="file" id="thumbnailPath"
						   name="thumbnailPaths[]">
					<?php
					if ($this->session->flashdata('error_thumbnail')) { ?>
						<small class="text text-danger mt-2 "><?php echo $this->session->flashdata('error_thumbnail')
							?></small>
					<?php } ?>
					<div class="row" id="list-thumbnail"></div>
				</div>
			</div>
			<div class="col-7 d-flex justify-content-end">
				<button type="submit" class="btn btn-success me-3"><i class="bi bi-plus-lg"></i> Tạo sản
					phẩm
				</button>
				<button type="reset" class="btn btn-light"><i class="bi bi-arrow-clockwise"></i> Đặt lại</button>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript" src="<?php echo base_url() ?>/application/javascript/slug.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/application/javascript/renderPreviewImage.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/application/javascript/tags.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/application/javascript/Admin/product.js"></script>
<script>
	const name = document.getElementById('productName')
	const code = document.getElementById('productCode')
	const slug = document.getElementById('slug')
	const previewImage = document.getElementById('previewImage');
	const imageProductPath = document.getElementById('imageProductPath');
	const previewLayout = document.getElementById('previewLayout');
	const thumbnailPath = document.getElementById('thumbnailPath');
	const listThumbnail = document.getElementById('list-thumbnail');
	renderSlug(name, code, slug);
	renderImageProduct(previewImage, imageProductPath, previewLayout);
	handleAddThumbnail(thumbnailPath, listThumbnail);
</script>

