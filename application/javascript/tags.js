$(document).ready(function(){
	$('.select2_tags').select2({
		createTag: (params) => {
			let term = $.trim(params.term);

			if (term === '') {
				return null;
			}

			return {
				id: term,
				text: term,
				newTag: true // add additional parameters
			}
		}
	})
});
