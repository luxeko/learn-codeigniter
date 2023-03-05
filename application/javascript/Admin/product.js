$(document).ready(function () {
	$(".add-item").click(() => {
		renderItem();
	})
	const renderItem = () => {
		const listItem = $('#list-items');
		let item = `
					<div class="row border-bottom mb-3 item">
						<div class="col-2">
							<label for="colorName" class="form-label">Tên màu</label>
							<input type="text" name="colorName[]" class="form-control" id="colorName">
						</div>
						<div class="col-2">
							<label for="colorCode" class="form-label">Mã màu</label>
							<input type="color" value="#4068DF" name="colorCode[]" class="form-control"
							id="colorCode">
						</div>
						<div class="col-2">
							<label for="quantity" class="form-label">Số lượng</label>
							<input type="text" name="quantity[]" class="form-control" id="quantity">
						</div>
						<div class="col-5">
							<label for="price" class="form-label">Giá tiền (VNĐ)</label>
							<input type="text" name="price[]" class="form-control " id="price">
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
								<input class="form-check-input size_check" name="" type="checkbox" id="inlineCheckbox1" value="XS">
								<label class="form-check-label" for="inlineCheckbox1">XS</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input size_check" name="" type="checkbox" id="inlineCheckbox1" value="S">
								<label class="form-check-label" for="inlineCheckbox1">S</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input size_check" name="" type="checkbox" id="inlineCheckbox1" value="M">
								<label class="form-check-label" for="inlineCheckbox1">M</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input size_check" name="" type="checkbox" id="inlineCheckbox1" value="L">
								<label class="form-check-label" for="inlineCheckbox1">L</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input size_check" name="" type="checkbox" id="inlineCheckbox1" value="XL">
								<label class="form-check-label" for="inlineCheckbox1">XL</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input size_check" name="" type="checkbox" id="inlineCheckbox1" value="XXL">
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
			$(`.item:eq(${i})`).find('.size_check').attr('name', `size${i}[]`);
		}

		$(document).on('click', '.removeItem', function () {
			$(this).closest('.item').remove();
			for (let i = 0; i < $('#list-items > div').length; i++) {
				$('.item .item-stt')[i].innerHTML = `STT: ${i + 1}`;
				$(`.item:eq(${i})`).find('.size_check').attr('name', `size${i}[]`);
			}
		});
	}
	renderItem();
	$('#colorCode').on("change paste keyup", (e) => {
		console.log(e.target.value);
	});
});
