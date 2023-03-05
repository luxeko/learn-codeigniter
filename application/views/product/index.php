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
			<th scope="col">Giá</th>
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
				<td class="align-middle">
					<div class="d-flex align-items-center">
						<img style="aspect-ratio: 3/4; width: 120px"
							 src="<?php echo base_url('') . $v->imageProductPath ?>"
							 alt="<?php echo $v->imageProductName ?>">
						<div class="d-flex flex-column ms-1">
							<p>
								<span class="fw-bold">Tên:</span> <?php echo $v->productName ?>
							</p>
							<p>
								<span class="fw-bold">Mã:</span> <?php echo $v->productCode ?>
							</p>
						</div>
					</div>
				</td>
				<td class="text text-success fw-bold align-middle">400000 VND</td>
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
						<a href="<?php echo base_url('/cms/products/preview/' . $v->id . '/' . $v->slug) ?>"
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
</div>
