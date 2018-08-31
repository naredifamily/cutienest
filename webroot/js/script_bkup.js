$(document).ready(function(){
	$("#file").change(function(e){
		var img = e.target.files[0];

		if(!iEdit.open(img, true, function(res){

			var block = res.split(";");
// Get the content type of the image
var contentType = block[0].split(":")[1];// In this case "image/gif"
// get the real base64 content of the file
var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

// Convert it to a blob to upload
var blob = b64toBlob(realData, contentType);

// Create a FormData and append the file with "image" as parameter name
var form = document.getElementById("ProfileimageProfilePictureForm");
var formDataToUpload = new FormData(form);
formDataToUpload.append("image", blob);



//objectURL = URL.createObjectURL(file);
			$("#result").attr("src", res);	
			$("#image_encode").val(res);
			//alert(file);
			$('#ProfileimageProfilePictureForm').submit();
			
		})){
			alert("Whoops! That is not an image!");
		}

	});
	function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;

        var byteCharacters = atob(b64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

      var blob = new Blob(byteArrays, {type: contentType});
	  
      return blob;
}
});