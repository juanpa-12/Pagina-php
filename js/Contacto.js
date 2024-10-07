$(document).ready(function() {
    // Función para manejar el envío del formulario
    $('#contactForm').submit(function(event) {
        event.preventDefault(); // Evita que el formulario se envíe automáticamente

        // Aquí podrías agregar código para enviar los datos a través de AJAX

        // Simulando un envío exitoso (aquí puedes reemplazar con tu lógica real de envío)
        setTimeout(function() {
            $('.success-message').fadeIn(); // Mostrar mensaje de éxito
            $('#contactForm')[0].reset(); // Limpiar el formulario
        }, 1000);

        // Para mostrar mensaje de error, descomenta y utiliza según necesites
        /*
        setTimeout(function() {
            $('.error-message').fadeIn(); // Mostrar mensaje de error
        }, 1000);
        */
    });
});
