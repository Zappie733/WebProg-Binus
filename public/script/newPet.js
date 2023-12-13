function previewImage(event) {
  var reader = new FileReader();
  reader.onload = function() {
    var output = document.getElementById('uploadedImage');
    output.src = reader.result;
    console.log(output.src);
  };
  reader.readAsDataURL(event.target.files[0]);
}
