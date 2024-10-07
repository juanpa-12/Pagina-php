document.addEventListener('DOMContentLoaded', function () {
    // Validación del formulario
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        const correo = document.getElementById('correo').value;
        const contrasena = document.getElementById('contrasena').value;
        const errorMessage = document.getElementById('error-message');
        
        let isValid = true;
        let errorText = '';

        // Validación de correo
        if (!validateEmail(correo)) {
            isValid = false;
            errorText += 'El correo electrónico no es válido.<br>';
        }

        // Validación de contraseña
        if (contrasena.length < 6) {
            isValid = false;
            errorText += 'La contraseña debe tener al menos 6 caracteres.<br>';
        }

        if (isValid) {
            // Si todo es válido, se permite el envío del formulario
            return true;
        } else {
            // Mostrar mensaje de error y prevenir el envío
            errorMessage.innerHTML = errorText;
            errorMessage.style.display = 'block';
            event.preventDefault();
        }
    });

    function validateEmail(email) {
        // Expresión regular para validar el formato del correo electrónico
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
