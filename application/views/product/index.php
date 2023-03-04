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
	<table class="table table-hover table-bordered">
		<thead class="table-secondary">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Mã sản phẩm</th>
			<th scope="col">Ảnh</th>
			<th scope="col">Giá</th>
			<th scope="col">Danh mục</th>
			<th scope="col">Viewer</th>
			<th scope="col">Trạng thái</th>
			<th scope="col">Created at</th>
			<th scope="col">Updated at</th>
			<th scope="col">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($products as $k => $v) { ?>
			<tr>
				<th scope="row"><?php echo $k + 1 ?></th>
				<td><?php echo $v->productCode ?></td>
				<td>
					<div>
						<img src="<?php echo $v->imageProductPath ?>" alt="<?php echo $v->imageProductName ?>">
					</div>
					<div>
						<?php echo $v->productName ?>
					</div>
				</td>
				<td><?php echo $v->price ?></td>
				<td><?php echo $v->categoryName ?></td>
				<td><?php echo $v->viewCount ?></td>
				<td class="text-success">
					<?php if ($v->status == 'Active') {
						echo '<p class="text text-success fw-bold">Active</p>';
					} else {
						echo '<p class="text text-danger fw-bold">Disable</p>';
					} ?>
				</td>
				<td><?php echo $v->createdAt ?></td>
				<td><?php echo $v->updatedAt ?></td>
				<td>
					<div class="d-flex justify-content-center align-items-center">
						<a href="<?php echo base_url('/cms/products/edit/' . $v->id . '/' . $v->slug) ?>"
						   class="btn
						btn-primary
						me-2"><i class="bi
						bi-pencil"></i></a>
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
