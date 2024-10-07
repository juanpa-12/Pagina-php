document.getElementById('formNotificacion').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío del formulario inmediatamente

    const clienteId = document.getElementById('cliente').value;
    const tipoNotificacion = document.getElementById('tipoNotificacion').value;
    const descripcion = document.getElementById('descripcion').value;

    // Validar que se haya seleccionado un cliente y tipo de notificación
    if (!clienteId || !tipoNotificacion) {
        alert("Por favor, seleccione un cliente y un tipo de notificación antes de enviar.");
        return;
    }

    // Crear objeto de datos
    const data = {
        cliente_id: clienteId,
        tipo: tipoNotificacion,
        descripcion: descripcion // Puede estar vacío
    };

    // Enviar los datos a enviar_notificacion.php
    fetch('php/enviar_notificacion.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Notificación enviada con éxito.");
            document.getElementById('formNotificacion').reset(); // Reiniciar el formulario
        } else {
            alert("Error al enviar la notificación: " + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});
