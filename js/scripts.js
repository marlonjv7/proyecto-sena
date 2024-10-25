/*!
* Start Bootstrap - Creative v7.0.7 (https://startbootstrap.com/theme/creative)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-creative/blob/master/LICENSE)
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });
});

// Selecciona el formulario
const form = document.getElementById('registrationForm');
const submitButton = document.getElementById('submitButton');

// Deshabilita el botón de envío por defecto hasta que todos los campos sean válidos
form.addEventListener('input', function () {
    // Verifica si todos los campos obligatorios están llenos
    const isValid = form.checkValidity();
    submitButton.disabled = !isValid;
});

// Escucha el evento de envío del formulario
form.addEventListener('submit', function (event) {
    event.preventDefault(); // Evita el envío predeterminado del formulario

    // Obtiene los valores de los campos
    const name = document.getElementById('name').value.trim();
    const documento = document.getElementById('documento').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('contrasena').value.trim();
    const role = document.getElementById('role').value;

    // Validación de campos (puedes agregar más validaciones si es necesario)
    if (!name || !documento || !email || !telefono || !password || !role) {
        alert('Por favor complete todos los campos.');
        return;
    }

    // Crea el objeto de datos a enviar
    const formData = {
        name: name,
        documento: documento,
        email: email,
        telefono: telefono,
        password: password,
        role: role
    };

    // Enviar los datos a la API mediante fetch
    fetch('https://tuservidor.com/api/register', { // Cambia 'tuservidor.com' por la URL de tu servidor
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Si la solicitud fue exitosa
            alert('Registro exitoso');
            form.reset(); // Limpia el formulario
        } else {
            // Si hubo un error
            alert('Hubo un error al registrar: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un problema con el servidor. Inténtelo más tarde.');
    });
});
