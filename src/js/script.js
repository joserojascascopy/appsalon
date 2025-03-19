let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    tabs();
    paginador(); // Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();
    
    consultarAPI();

    nombreCliente(); // Asigna el nombre del cliente al objeto de cita
    seleccionarFecha() // Asigna la fecha de la cita al objeto de cita
}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click', function(e) {
            paso = parseInt(e.target.dataset.paso);
            resaltarBoton();
            mostrarSeccion();
            paginador();
        })
    })
}

function mostrarSeccion() {
    // Ocultar la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');

    if(seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    // Seleccionar la seccion con el paso
    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add('mostrar');

    // // Quita la clase de actual al boton anterior
    // const botonAnterior = document.querySelector('.actual');

    // if(botonAnterior) {
    //     botonAnterior.classList.remove('actual');
    // }

    // // Resalta el boton actual

    // const botonActual = document.querySelector(`[data-paso="${paso}"]`);

    // botonActual.classList.add('actual');
}

function resaltarBoton() {
    // Quita la clase de actual al boton anterior
    const botonAnterior = document.querySelector('.actual');

    if(botonAnterior) {
        botonAnterior.classList.remove('actual');
    }
    // Resalta el boton actual
    const botonActual = document.querySelector(`[data-paso="${paso}"]`);

    botonActual.classList.add('actual');
}

// function resaltarBoton(e) {
//     let boton = e.target;
//     const botonAnterior = document.querySelector('.actual');

//     if(botonAnterior) {
//         botonAnterior.classList.remove('actual');
//     }

//     boton.classList.add('actual');
// }

function paginador() {
    const siguiente = document.querySelector('#siguiente');
    const anterior = document.querySelector('#anterior');

    if(paso === 1) {
        anterior.classList.add('ocultar');
        siguiente.classList.remove('ocultar');
    }else if(paso === 3) {
        anterior.classList.remove('ocultar');
        siguiente.classList.add('ocultar')
    }else {
        siguiente.classList.remove('ocultar');
        anterior.classList.remove('ocultar');
    }

    mostrarSeccion();
    resaltarBoton();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');

    paginaAnterior.addEventListener('click', function() {
        if(paso <= pasoInicial) return;

        paso--;

        paginador();
    })
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');

    paginaSiguiente.addEventListener('click', function() {
        if(paso >= pasoFinal) return;

        paso++;

        paginador();
    })
}

async function consultarAPI() {

    try {
        const url = 'http://localhost:3000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();

        mostrarServicios(servicios);

    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach(servicio => {
        const {id, nombre, precio} = servicio; // Destructuring

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = '$' + precio;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function() { // Al hacer click nos ejecuta la funcion seleccionarServicio(), y le pasamos el objeto del servicio clickeado
            seleccionarServicio(servicio);
        };

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);
    })
}

function seleccionarServicio(servicio) {
    const {id} = servicio;
    const {servicios} = cita;
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`)

    // Comprobar si un servicio ya fue agregado
    if(!servicios.some(servicioAgregado => servicioAgregado.id === id )) {
        // Agregarlo
        cita.servicios = [...servicios, servicio];
    
        divServicio.classList.add('seleccionado');
    
    }else {
        // Eliminarlo
        cita.servicios = servicios.filter(agregado => agregado.id !== id)
    
        divServicio.classList.remove('seleccionado');
    }
}

function nombreCliente() {
    const nombreCliente = document.querySelector('#nombre').value;

    cita.nombre = nombreCliente;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e) {
        const dia = new Date(e.target.value).getUTCDay();
        
        if(dia == 0 || dia == 6) {
            e.target.value = '';

            mostrarAlerta('Fines de semana no permito', 'error');
        }else {
            cita.fecha = e.target.value;
        }

        console.log(cita);
    })
}

function mostrarAlerta(mensaje, tipo) {
    const alerta = document.createElement('DIV');
    alerta.classList.add(`${tipo}`);
    alerta.classList.add('alerta');
    alerta.textContent = mensaje;

    const alertas = document.querySelector('.alertas');
    alertas.appendChild(alerta);

    setTimeout(() => {
        alerta.remove(); // alerta.remove(); es un método de JavaScript que elimina un elemento del DOM.
    }, 3000)
}