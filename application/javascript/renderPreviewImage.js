const renderImageProduct = (previewImage, inputImage, previewLayout) => {
	const reader = new FileReader();
	inputImage.addEventListener('change', (item) => {
		previewLayout.removeAttribute("hidden")
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

const handleAddThumbnail = (inputThumbnail, listThumbnail) => {
	inputThumbnail.addEventListener('change', (item) => {
		let thumbnailLayout = '';
		const length = item.target.files.length
		for (let i = 0; i < length; i++) {
			const reader = new FileReader();
			if (item.target.files && item.target.files[i]) {
				thumbnailLayout += `
				<div class="col-4">
					<div class="my-3 ms-0 border-0 border border-light col-6" style="width:150px;height:150px">
						<img src=${item.target.files[i]} alt="" style="width:100%; height: 100%" class="previewThumbnail">
					</div>
				</div>
				`
				reader.onloadend = () => {
					document.getElementsByClassName('previewThumbnail')[i].src = reader.result;
				}
				reader.readAsDataURL(item.target.files[i]);
			} else {
				previewImage.src = ' ';
			}
		}
		listThumbnail.innerHTML = thumbnailLayout
	})
}
