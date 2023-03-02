<div class="container mt-3">
	<?php if ($this->session->flashdata('success_create')) { ?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('success_create') ?></div>
	<?php } elseif ($this->session->flashdata('success_update')) { ?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('success_update') ?></div>
	<?php } elseif ($this->session->flashdata('success_delete')) { ?>
		<div class="alert alert-danger"><?php echo $this->session->flashdata('success_delete') ?></div>
	<?php } ?>
	<div class="mb-3">
		<a href="<?php echo base_url('/cms/categories/add') ?>" class="btn btn-success"><i class="bi
		bi-plus-lg"></i> Thêm danh mục</a>
	</div>
	<table class="table table-hover table-bordered">
		<thead class="table-secondary">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Mã danh mục</th>
			<th scope="col">Tên danh mục</th>
			<th scope="col">Miêu tả</th>
			<th scope="col">Danh mục cha</th>
			<th scope="col">Trạng thái</th>
			<th scope="col">Created at</th>
			<th scope="col">Updated at</th>
			<th scope="col">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($categories as $k => $v) { ?>
			<tr>
				<th scope="row"><?php echo $k + 1 ?></th>
				<td><?php echo $v->categoryName ?></td>
				<td><?php echo $v->categoryCode ?></td>
				<td><?php echo $v->description ?></td>
				<td><?php echo $v->parentName ?></td>
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
						<a href="<?php echo base_url('/cms/categories/edit/' . $v->id . '/' . $v->slug) ?>"
						   class="btn
						btn-primary
						me-2"><i class="bi
						bi-pencil"></i></a>
						<a onclick="return confirm('Bạn có chắc chắn muốn xóa <?php echo $v->categoryName ?> không?')"
						   href="<?php
						   echo base_url('/cms/categories/delete/' . $v->id) ?>" class="btn
						btn-danger"><i class="bi bi-trash"></i></a>
					</div>
				</td>

			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
