$('.like_action').click(function(event){
	event.preventDefault();
	var clicked_anctag = this;
	var is_like = this.previousElementSibling == null;
	var post_id = this.getAttribute("data-post_id");
	var likeURL = "/likepost";
	var csrftoken_value = document.getElementById('edit_post_csrf').value;

	$.ajax({
		method: 'post',
		url: likeURL,
		data: {
			is_like: is_like,
			post_id : post_id,
			_token : csrftoken_value
		}
	}).done( function(){
		if (is_like){
			clicked_anctag.innerText == 'Like' ? clicked_anctag.innerText = 'Liked Already' : clicked_anctag.innerText = 'Like';
		} else {
			clicked_anctag.innerText == 'Dislike' ? clicked_anctag.innerText = 'Disliked Already' : clicked_anctag.innerText = 'Dislike';
		}

		// clicked_anctag.innerText == is_like ? this.innerText == 'Like' ? this.innerText = 'Liked Already' : 'Like' :  this.innerText == 'Dislike' ? this.innerText = 'Disliked Already' : 'Dislike';
	}).fail( function(res){
		console.log(res);
	});

});
