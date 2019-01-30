$(document).ready(function () {
    
  // CK editor
  ClassicEditor
    .create(document.querySelector('#content'))
    .catch(error => {
      console.error(error)
    });

    
  $('#selectAllBoxes').click(function(event) {
    if(this.checked) {
      $('.checkBoxes').each(function() {
        this.checked = true;
      })
    } else {
      $('.checkBoxes').each(function() {
        this.checked = false;
      })
    }
  })

  $('#load-screen').delay(400).fadeOut(600, function() {
    $(this).remove();
  })

})