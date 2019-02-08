<script>
function fileUpload(type, callbackFrom_id){
	$('#filefrm_type').val(type);

	var formData = new FormData($("#fileFrm")[0]);
	formData.append('_token', "{{ csrf_token() }}" );
	formData.append('fileupload', $('#upload')[0].files[0] );
	$.ajax({
        url: '/api/fileUpload',
        data: formData, 
        processData: false, 
        contentType: false, 
        type: 'POST',
        success: function(result){
			console.log(result);
			
			$('#file_id').val(result.file_id);
			$('#'+callbackFrom_id).submit();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			var errJson = JSON.parse(xhr.responseText)
			// console.log(xhr.responseText);
			// console.log(ajaxOptions);
			// alert(xhr.status);
			// alert(thrownError);
			//
			$('#fileError').remove();
			$('body').append('<div id="fileError" class="message_box error"><span>'+errJson.err+'</span></div>');
			$('#fileError').click(function(){
				$(this).fadeOut('slow');
			});
		}
	
	});
}

$(function(){
	if($('.message_box')){
		$('.message_box').click(function(){
			$('.message_box').fadeOut('slow');
		})
	}
})
</script>

<form id="fileFrm" name="fileFrm" method="post" enctype="multipart/form-data">
	<input type="hidden" id="filefrm_type" name="type"/>
</form>