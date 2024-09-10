// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      // Check if any required field is empty
      const requiredFields = form.querySelectorAll('[required]')
      Array.from(requiredFields).forEach(field => {
        if (field.value.trim() === '') {
          event.preventDefault()
          event.stopPropagation()
          field.classList.add('is-invalid')
        }
      })

      form.classList.add('was-validated')
    }, false)
  })
})()