// var elems = Array.from(document.getElementsByClassName('editAncTag'));
// var modalElem =document.getElementById("editModal");



// elems.forEach( elem => {
// 	elem.addEventListener('click', function(){
// 		var post_id = this.getAttribute("data-id");
// 		console.log(post_id);

// 	});
// });




$(".editAncTag").click(function(event){
	event.preventDefault();

	// var editposturl = "{{ route('editPostRoute'); }}";
	// var token = '{{ Session::token(); }}';
	var editposturl = '/editpost';
	var token = document.getElementById('edit_post_csrf').value;

	var post_id = this.getAttribute("data-id");
	var post_HTMLElem_id = this.parentElement.previousElementSibling.id;
	var post_body_old = document.getElementById(post_HTMLElem_id).textContent;
	
	document.getElementById('modalHeading').innerHTML = 'Edit Post';
	document.getElementById('modalBodyTextArea').value = post_body_old;
	$("#editModal").modal();

	// document.getElementById('save_modal').addEventListener('click', function(){
	// });

	$('#save_modal').click(function(){
		var post_body_new = document.getElementById('modalBodyTextArea').value;
		$.ajax({
			method: 'post',
			url: editposturl,
			data:{
				post_body: post_body_new,
				post_id: parseInt(post_id),
				_token: token
			}
		}).done( function( res){
			// console.log(res.post_body, res.post_id);
			// console.log(JSON.stringify(res));
			if( res.updated ){
				$("#editModal").modal('hide');
				document.getElementById(post_HTMLElem_id).innerText = post_body_new;
				
			}

		}).fail( function ( res){
			console.log(res, res.responseText);
		});

	});

});