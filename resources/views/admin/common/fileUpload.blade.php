<script>
function fileUpload(name, path, target, imgid , value){
	
	// $('#filetype').val(name);
	// $('#filepath').val(path);
	// $('#target_file').val(target);
    // var formData = new FormData($("#fileFrm")[0]);
	// formData.append('fileupload', $('#'+target)[0].files[0] );
	// formData.append('_token', "{{ csrf_token() }}" );
	// $.ajax({
    //     url: 'http://cdn.carrotenglish.com/bhappy/upload_bhappy.php',
    //     data: formData, 
    //     processData: false, 
    //     contentType: false, 
    //     type: 'POST',
    //     success: function(result){
    //        // alert("업로드 성공!!");
    //      var json = jQuery.parseJSON(result);
    //      if(json.CODE == '00'){
    //      	//$('#filename').val(json.FILE_NAME);
    //      	//$('#orgfname').val(json.ORG_FILE_NAME);
    //      	//$('#fileurl').val(json.URL);
    //      	$.ajax({
	// 		        url: '/fileupload',
	// 		        data: {
	// 		        	fileurl : json.URL,
	// 		        	filename : json.FILE_NAME,
	// 		        	orgfname : json.ORG_FILE_NAME,
	// 		        	filepath : path,
	// 		        	_token : '{{ csrf_token() }}'
	// 		        }, 
	// 		        type: 'POST',
	// 		        success: function(json){
	// 		           // alert("업로드 성공!!");
	// 		         //  var json = jQuery.parseJSON(result);
	// 		           if(json.code == 200){
	// 		           		if(imgid != null){
	// 			           		$('#'+imgid).attr('src', json.filePath);
	// 		           		}
			           		
	// 		           		if(imgid != value){
	// 			           		$('#'+value).val( json.filePath );
	// 		           		}
			           		
	// 		           		$('#'+name).val(json.file_id);
	// 		           }
	// 		           else{
	// 		           		alert(json.msg);
	// 		           		if(json.Exception != null){
	// 		           			console.log(json.Exception);
	// 		           		}
	// 		           }
	// 		        }
	// 		    });
         	
    //      }
    //      else {
    //      	alert(json.MSG);
    //      }
          
    //     }
    });

</script>

<form id="fileFrm" name="fileFrm" method="post" enctype="multipart/form-data">
	<input type="hidden" name="t_id" id="filetype" />
	<input type="hidden" name="file_table" id="filepath" />
	<input type="hidden" name="file_name" id="filename" />
</form>