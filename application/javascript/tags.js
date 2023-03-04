$(document).ready(function(){
	$('.select2_tags').select2({
		// 'placeholder': 'Chọn thẻ tag',
		tags: true,
		tokenSeparators: [',', ' ']
	})
});
