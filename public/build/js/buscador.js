document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
})

function iniciarApp() {
    buscarPorFecha();
}

function buscarPorFecha() {
    const inputFecha = document.querySelector('#fecha');
    
    inputFecha.addEventListener('input', function(e) {
        let fechaSeleccionada = e.target.value;
        
        window.location = `?fecha=${fechaSeleccionada}`;
    })
}

// TODO - Realizar la busqueda con una API (Solo para prácticar, no es tan conveniente hacerlo así)