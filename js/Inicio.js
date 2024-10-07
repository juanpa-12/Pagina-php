function calculate() {
    // Obtener valores de los inputs
    const length = parseFloat(document.getElementById('length').value);
    const width = parseFloat(document.getElementById('width').value);
    const depth = parseFloat(document.getElementById('depth').value);

    // Verifica los valores ingresados
    console.log("Length:", length, "Width:", width, "Depth:", depth);

    // Validación de valores
    if (isNaN(length) || length <= 0 || isNaN(width) || width <= 0 || isNaN(depth) || depth <= 0) {
        alert("Por favor, ingrese valores válidos.");
        return;
    }

    // Calcular volumen
    const volume = length * width * depth;

    // Calcular AggreBind y agua necesarios por m3
    const aggreBindPerM3 = 4;
    const waterPerM3 = 1.3;

    // Calcular los litros totales de AggreBind y agua necesarios
    const totalAggreBind = aggreBindPerM3 * volume;
    const totalWater = waterPerM3 * volume;

    // Mostrar resultados
    document.getElementById('aggrebindResult').innerText = `AggreBind necesario: ${totalAggreBind.toFixed(2)} litros`;
    document.getElementById('waterResult').innerText = `Agua necesaria: ${totalWater.toFixed(2)} litros`;

    document.getElementById('result').style.display = 'block';

    // Calcular y mostrar el resultado total
    const total = totalAggreBind + totalWater;
    document.getElementById('totalResult').innerText = `Total: ${total.toFixed(2)} litros`;

    document.getElementById('summary').style.display = 'block';

    // Mostrar los botones "Enviar Cotización" y "Cerrar Cotización"
    document.querySelector('.buttons').style.display = 'flex';
}
document.addEventListener('DOMContentLoaded', function () {
    fetch('/php/notificaciones.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const notificacionesList = document.getElementById('notificacionesList');
                notificacionesList.innerHTML = ''; // Limpiar la lista actual

                data.notificaciones.forEach(notificacion => {
                    const li = document.createElement('li');
                    li.textContent = `${notificacion.fecha} - ${notificacion.tipo}: ${notificacion.descripcion}`;
                    notificacionesList.appendChild(li);
                });
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
});
document.addEventListener('DOMContentLoaded', function () {
    fetch('/php/notificaciones.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const notificacionesList = document.getElementById('notificacionesList');
                notificacionesList.innerHTML = ''; // Limpiar la lista actual

                data.notificaciones.forEach(notificacion => {
                    const li = document.createElement('li');
                    li.textContent = `${notificacion.fecha} - ${notificacion.tipo}: ${notificacion.descripcion}`;
                    notificacionesList.appendChild(li);
                });
            } else {
                console.error('Error:', data.message); // Agregar mensaje de error
            }
        })
        .catch(error => console.error('Error en la solicitud:', error)); // Agregar mensaje de error
});
