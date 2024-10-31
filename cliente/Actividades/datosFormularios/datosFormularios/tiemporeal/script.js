document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById('miFormulario');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const errorUsername = document.getElementById('errorUsername');
    const errorEmail = document.getElementById('errorEmail');
  
    // Validar el campo de nombre de usuario en tiempo real con el evento 'input'
    username.addEventListener('input', function() {
      if (username.value.length < 5) {
        errorUsername.textContent = 'El nombre de usuario debe tener al menos 5 caracteres.';
      } else {
        errorUsername.textContent = '';  // Borrar el mensaje de error si es válido
      }
    });
  
    // Validar el campo de correo electrónico con el evento 'change' al perder el foco
    email.addEventListener('change', function() {
      if (!email.validity.valid) {
        errorEmail.textContent = 'Por favor, introduce un correo electrónico válido.';
      } else {
        errorEmail.textContent = '';  // Borrar el mensaje de error si es válido
      }
    });
  
    // Al hacer foco en el campo de nombre de usuario, resaltar el campo
    username.addEventListener('focus', function() {
      username.style.backgroundColor = '#e0f7fa';  // Cambiar el color de fondo
    });
  
    // Al perder el foco en el campo de nombre de usuario, restaurar el fondo
    username.addEventListener('blur', function() {
      username.style.backgroundColor = '';  // Restaurar el color de fondo
    });
  
    // Controlar el envío del formulario con el evento 'submit'
    formulario.addEventListener('submit', function(event) {
      let formularioValido = true;
  
      // Validar nuevamente el campo de nombre de usuario antes del envío
      if (username.value.length < 5) {
        errorUsername.textContent = 'El nombre de usuario debe tener al menos 5 caracteres.';
        formularioValido = false;
      }
  
      // Validar nuevamente el campo de correo electrónico antes del envío
      if (!email.validity.valid) {
        errorEmail.textContent = 'Por favor, introduce un correo electrónico válido.';
        formularioValido = false;
      }
  
      // Si algún campo es inválido, evitar el envío del formulario
      if (!formularioValido) {
        event.preventDefault();  // Detener el envío del formulario
      }
    });
  });
  