$(document).ready(function () {
  
  // CK editor
  ClassicEditor
    .create(document.querySelector('#content'))
    .catch(error => {
      console.error(error)
    });
})