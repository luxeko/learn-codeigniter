<div class="container mt-3">
	<?php if ($this->session->flashdata('success_create')) { ?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('success_create') ?></div>
	<?php } elseif ($this->session->flashdata('success_update')) { ?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('success_update') ?></div>
	<?php } elseif ($this->session->flashdata('success_delete')) { ?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('success_delete') ?></div>
	<?php } ?>
	<div class="mb-3">
		<a href="<?php echo base_url('/cms/products/add') ?>" class="btn btn-success"><i class="bi
		bi-plus-lg"></i> Thêm sản phẩm</a>
	</div>
	<table class="table table-bordered">
		<thead class="table-secondary">
		<tr>
			<th scope="col">#</th>
			<th scope="col" class="text-center">Ảnh</th>
			<th scope="col">Mã sản phẩm</th>
			<th scope="col">Tên sản phẩm</th>
			<th scope="col">Danh mục</th>
			<th scope="col">Viewer</th>
			<th scope="col">Trạng thái</th>
			<th scope="col">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($products as $k => $v) { ?>
			<tr>
				<th scope="row" class="align-middle"><?php echo $k + 1 ?></th>
				<td class="align-middle" style="width: 120px">
					<img style="aspect-ratio: 3/4; width: 100%"
						 src="<?php echo base_url('') . $v->imageProductPath ?>"
						 alt="<?php echo $v->imageProductName ?>">
				</td>
				<td class="align-middle"><?php echo $v->productCode ?></td>
				<td class="align-middle"><?php echo $v->productName ?></td>
				<td class="align-middle"><?php echo $v->categoryName ?></td>
				<td class="align-middle"><?php echo $v->viewCount ?></td>
				<td class="text-success align-middle">
					<?php if ($v->status == 'Active') {
						echo '<span class="text text-success fw-bold">Active</span>';
					} else {
						echo '<span class="text text-danger fw-bold">Disable</span>';
					} ?>
				</td>
				<td class="align-middle">
					<div class="d-flex justify-content-center align-items-center">
						<a type="button"
						   onclick="getPreviewProduct(<?php echo $v->id ?>)"
						   data-bs-toggle="modal"
						   data-bs-target="#modalDetailProduct"
						   class="btn btn-warning text-white me-2"><i class="bi bi-eye-fill"></i></a>
						<a href="<?php echo base_url('/cms/products/edit/' . $v->id . '/' . $v->slug) ?>"
						   class="btn btn-primary me-2"><i class="bi bi-pencil"></i></a>
						<a onclick="return confirm('Bạn có chắc chắn muốn xóa <?php echo $v->productName ?> không?')"
						   href="<?php
						   echo base_url('/cms/products/delete/' . $v->id) ?>" class="btn
						btn-danger"><i class="bi bi-trash"></i></a>
					</div>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<!-- Modal -->
	<div class="modal fade" id="modalDetailProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Chi tiết sản phẩm</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" >
	const groupBy = (objectArray, key) => {
		return objectArray.reduce((output, currentValue) => {
			let groupKey = currentValue[key];
			if (!output[groupKey]) {
				output[groupKey] = [];
			}
			output[groupKey].push(currentValue);
			return output;
		}, {});
	}
	const getPreviewProduct = (productId) => {
		$.ajax({
			url: `/cms/products/preview/${productId}`,
			method: 'POST',
			success: (data) => {
				const listItemInProduct = JSON.parse(data)
				const result = groupBy(listItemInProduct.productPrice, 'colorName')
				console.log(listItemInProduct.productThumbnail);
			}
		})
	}
</script>
