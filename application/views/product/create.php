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
				</div>
				<div class="mb-3">
					<label for="parentId" class="form-label">Danh mục sản phẩm</label>
					<select class="form-select" name="parentId" id="parentId">
						<option selected value="0">Chọn danh mục</option>
						<?php echo $data . $htmlOption; ?>
					</select>
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
							echo "<option value=" . $value->id . ">" . $text . ' ' . $value->tagName . "</option>";
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
			<div class="col-5 sticky-top" style="height: 500px; top: 50px">
				<div class="form-group mb-4 d-flex flex-column">
					<label for="imageProductPath">Chọn ảnh chính (520px : 520px)</label>
					<input class="form-control-file" type="file" id="imageProductPath" name="imageProductPath">
					<div class="rounded-lg shadow-sm my-3 ms-0 border-0 border border-light"
						 style="width:300px; height:300px">
						<img src=" " style="width:100%; height: 100%" id="previewImage">
					</div>
				</div>
				<div class="form-group d-flex flex-column">
					<label for="thumbnailPath">Chọn các ảnh chi tiết</label>
					<input class="form-control-file" multiple="multiple" type="file" id="thumbnailPath"
						   name="thumbnail_path[]">
					<div class="row">
						<div class="col-4">
							<div class="rounded-lg shadow-sm my-3 ms-0 border-0 border border-light col-6" style="width:150px;
					height:150px">
								<img src=" " style="width:100%; height: 100%" id="previewThumbnail">
							</div>
						</div>
						<div class="col-4">
							<div class="rounded-lg shadow-sm my-3 ms-0 border-0 border border-light col-6" style="width:150px;
					height:150px">
								<img src=" " style="width:100%; height: 100%" id="previewThumbnail">
							</div>
						</div>
						<div class="col-4">
							<div class="rounded-lg shadow-sm my-3 ms-0 border-0 border border-light col-6" style="width:150px;
					height:150px">
								<img src=" " style="width:100%; height: 100%" id="previewThumbnail">
							</div>
						</div>
						<div class="col-4">
							<div class="rounded-lg shadow-sm my-3 ms-0 border-0 border border-light col-6" style="width:150px;
					height:150px">
								<img src=" " style="width:100%; height: 100%" id="previewThumbnail">
							</div>
						</div>
						<div class="col-4">
							<div class="rounded-lg shadow-sm my-3 ms-0 border-0 border border-light col-6" style="width:150px;
					height:150px">
								<img src=" " style="width:100%; height: 100%" id="previewThumbnail">
							</div>
						</div>
					</div>
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
<script>
	const start = () => {
		renderSlug();
		renderImageProduct();
	}
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
	const renderSlug = () => {
		const productName = document.getElementById('productName')
		const productCode = document.getElementById('productCode')
		const slug = document.getElementById('slug')
		productName.addEventListener('change', () => {
			slug.setAttribute('value', toSlug(productName.value) + '-' + productCode.value);
		})
		productCode.addEventListener('change', () => {
			slug.setAttribute('value', toSlug(productName.value) + '-' + productCode.value);
		})
	}
	const renderImageProduct = () => {
		const previewImage = document.getElementById('previewImage');
		const inputImage = document.getElementById('imageProductPath');
		const reader = new FileReader();
		inputImage.addEventListener('change', (item) => {
			reader.onloadend = () => {
				previewImage.src = reader.result;
			}
			if (item.target.files && item.target.files[0]) {
				reader.readAsDataURL(item.target.files[0]);
			} else {
				previewImage.src = ' ';
			}
		})
		previewImage.addEventListener('click', () => {
			inputImage.click();
		})
	}
	start();
</script>
<script>
	$(document).ready(function () {
		$(".add-item").click(() => {
			renderItem();
		})
		const renderItem = () => {
			const listItem = $('#list-items');
			let item = `
					<div class="row border-bottom mb-3 item">
						<div class="col-2">
							<label for="colorName" class="form-label">Màu sắc (ENG)</label>
							<input type="text" name="colorName" class="form-control" id="colorName">
						</div>
						<div class="col-2">
							<label for="colorCode" class="form-label">Mã màu (Hex)</label>
							<input type="color" value="#4068DF" name="colorCode" class="h-50 form-control" id="colorCode">
						</div>
						<div class="col-2">
							<label for="price" class="form-label">Số lượng</label>
							<input type="text" name="price" class="form-control" id="price">
						</div>
						<div class="col-5">
							<label for="price" class="form-label">Giá tiền (VNĐ)</label>
							<input type="text" name="price" class="form-control " id="price">
						</div>
						<div class="col-1 d-flex align-items-end justify-content-end">
							<a class="btn btn-danger text-white d-flex align-items-center
							justify-content-center w-100 p-2
							rounded removeItem"><i class="bi bi-trash"></i></a>
						</div>
						<div class="col-12 mt-3">
							<div class="mb-2">
								<span class="me-2">Size: </span>
								<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
								<label class="form-check-label" for="inlineCheckbox1">Check all</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
								<label class="form-check-label" for="inlineCheckbox1">XS</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
								<label class="form-check-label" for="inlineCheckbox1">S</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
								<label class="form-check-label" for="inlineCheckbox1">M</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
								<label class="form-check-label" for="inlineCheckbox1">L</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
								<label class="form-check-label" for="inlineCheckbox1">XL</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
								<label class="form-check-label" for="inlineCheckbox1">XXL</label>
							</div>
						</div>
						<div class="col-12 d-flex align-items-end justify-content-end">
							<strong class="item-stt"></strong>
						</div>
					</div>`

			listItem.append(item);

			for (let i = 0; i < $('#list-items > div').length; i++) {
				$('.item .item-stt')[i].innerHTML = `STT: ${i + 1}`;
			}

			$(document).on('click', '.removeItem', function () {
				$(this).closest('.item').remove();
				for (let i = 0; i < $('#list-items > div').length; i++) {
					$('.item .item-stt')[i].innerHTML = `STT: ${i + 1}`;
				}
			});
		}
		renderItem();
	});

</script>
<script type="text/javascript" src="<?php echo base_url() ?>/application/javascript/tags.js"></script>

