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
    seleccionarFecha(); // Asigna la fecha de la cita al objeto de cita
    seleccionarHora(); // Asigna la hora de la cita al objeto de cita
    
    // mostrarResumen(); // Muestra el resumen de la cita
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

        mostrarResumen();
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

            mostrarAlerta('Fines de semana no permito', 'error', 'alertas');
        }else {
            cita.fecha = e.target.value;
        }
    })
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e) {
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0]; // Nos permite seprar una cadena de texto, en este caso nos devuelve un array con dos elementos
        
        if(hora < 8 || hora >= 20) {
            e.target.value = '';
            mostrarAlerta('Horario No Válida', 'error', 'alertas');
        }else {
            cita.hora = e.target.value;
        }
    })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
    // Evita la creacion de varias alertas
    const alertaPrevia = document.querySelector('.alerta');
    
    if(alertaPrevia) {
        alertaPrevia.remove();
    }

    // Si no hay alertaPrevia, se crea la alerta
    const alerta = document.createElement('DIV');
    alerta.classList.add(`${tipo}`);
    alerta.classList.add('alerta');
    alerta.textContent = mensaje;

    const referencia = document.querySelector(`.${elemento}`);
    referencia.appendChild(alerta);

    // Se elimina la alerta luego de los 3000ms
    if(desaparece) {
        setTimeout(() => {
            alerta.remove(); // alerta.remove(); es un método de JavaScript que elimina un elemento del DOM.
        }, 3000)
    }
}

function mostrarResumen() {
    const resumen = document.querySelector('.contenido-resumen');

    if(Object.values(cita).includes('') || cita.servicios.length === 0) { // Object.values, metodo especificos para objetos, itera sobre el objeto que se le pasa como argumento
        mostrarAlerta('Debes completar todos los datos', 'error', 'alerta-resumen', false);

        return;
    }

    // Eliminar la alerta dentro de resumen, se le paso false al parametro de "desaparece"
    const alertaAnterior = document.querySelector('.alerta');

    if(alertaAnterior) {
        alertaAnterior.remove();
    }

    const {nombre, fecha, hora, servicios} = cita;

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fecha}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora}`;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    const contenedorServicios = document.createElement('DIV');
    contenedorServicios.classList.add('contenedor-servicios');
    contenedorServicios.innerHTML = '<p>Servicios:</p>';
    resumen.appendChild(contenedorServicios);

    servicios.forEach(servicio => {
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');
        contenedorServicios.appendChild(contenedorServicio);

        const servicioCita = document.createElement('P');
        servicioCita.innerHTML = `${servicio.nombre}`;
        contenedorServicio.appendChild(servicioCita);

        const precioCita = document.createElement('P');
        precioCita.innerHTML = `$${servicio.precio}`;
        contenedorServicio.appendChild(precioCita)
    })
}