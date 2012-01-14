$(function() {
	$('#tags').tagit({tagSource: SITE_URL+"tags", select: true, initialTags: initialTags});
	$('#dependencies').tagit({tagSource: SITE_URL+"dependencies", select: true, initialTags: initialDependenciesTags});
	$('#repo').change(function(){
		var id = $(this).find("option:selected").text();
		$.ajax({
			beforeSend: function() {
				$('.info').fadeOut();
				$('.bundle_extras').fadeOut();
			},
			type: "POST",
			url: SITE_URL+'bundle/repo',
			data: "repo="+id,
			dataType: "json",
			success: function(resp) {
				$('#title').val(id);
				$('#location').val(resp.url);
				$('#summary').val(resp.description);
				$('#website').val(resp.homepage);
				$('.bundle_extras').fadeIn();
			}
		});
	});
});
