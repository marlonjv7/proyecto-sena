// const tabLinks = document.querySelectorAll('.tab-link');
// const tabContents = document.querySelectorAll('.tab-content');
// const doctorSearchForm = document.getElementById('doctorSearchForm');
// const patientInfo = document.getElementById('patientInfo');
// const saveChanges = document.getElementById('saveChanges');
// const loginForm = document.getElementById('loginForm');

document.addEventListener('DOMContentLoaded', event => {
    const roleSelect = document.getElementById('role');
    const patientFields = document.getElementById('patientFields');
    const doctorFields = document.getElementById('doctorFields');
    const doctorSearchForm = document.getElementById('doctorSearchForm');
    const patientInfo = document.getElementById('patientInfo');
    const saveChanges = document.getElementById('saveChanges');
    const loginForm = document.getElementById('loginForm');

    function toggleFields() {
        if (roleSelect.value === 'doctor') {
            doctorFields.classList.remove('d-none');
            doctorFields.classList.add('d-flex');
            patientFields.classList.add('d-none');
            patientFields.classList.remove('d-flex');
        } else {
            patientFields.classList.remove('d-none');
            patientFields.classList.add('d-flex');
            doctorFields.classList.add('d-none');
            doctorFields.classList.remove('d-flex');
        };
    };
    roleSelect.addEventListener('change', toggleFields);
    toggleFields(); // Ejecuta una vez para ocultar los campos al cargar la página


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

    // Validación de campos (puedes agregar más validaciones si es necesario)
    if (!name || !documento || !correo || !telefono || !contrasena || !role) {
        alert('Por favor complete todos los campos.');

        window.location.href = 'historialclinico.html'
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

// if (doctorSearchForm) {
//     doctorSearchForm.addEventListener('submit', (event) => {
//         event.preventDefault();
//         const searchDocument = document.getElementById('searchDocument').value;

//         // Simulación de datos de pacientes
//         const patients = {
//             "12345": { name: "Juan Pérez", email: "juan.perez@mail.com", diagnosis: "Gripe" },
//             "67890": { name: "Ana Gómez", email: "ana.gomez@mail.com", diagnosis: "Asma" }
//         };

//         if (patients[searchDocument]) {
//             const patient = patients[searchDocument];
//             document.getElementById('patientName').value = patient.name;
//             document.getElementById('patientDocument').value = searchDocument;
//             document.getElementById('patientEmail').value = patient.email;
//             document.getElementById('patientDiagnosis').value = patient.diagnosis;
//             if (patientInfo) patientInfo.classList.remove('hidden');
//         } else {
//             alert('No se encontró el paciente.');
//         }
//     });
// }

// if (saveChanges) {
//     saveChanges.addEventListener('click', () => {
//         const updatedEmail = document.getElementById('patientEmail').value;
//         const updatedDiagnosis = document.getElementById('patientDiagnosis').value;
//         alert(`Datos actualizados:\nCorreo: ${updatedEmail}\nDiagnóstico: ${updatedDiagnosis}`);
//     });
// }

// // Verificar si hay tabLinks y tabContents antes de agregar los event listeners
// if (tabLinks.length > 0 && tabContents.length > 0) {
//     tabLinks.forEach(link => {
//         link.addEventListener('click', (event) => {
//             event.preventDefault();
            
//             // Remover la clase 'active' de todos los links y contenidos
//             tabLinks.forEach(link => link.classList.remove('active'));
//             tabContents.forEach(content => content.classList.remove('active'));

//             // Agregar la clase 'active' al link y contenido correspondiente
//             link.classList.add('active');
//             const tabId = link.getAttribute('data-tab');
//             const targetTab = document.getElementById(tabId);

//             if (targetTab) {
//                 targetTab.classList.add('active');
//             } else {
//                 console.error(`No se encontró el contenido con el ID: ${tabId}`);
//             }
//         });
//     });
// } else {
//     console.error('No se encontraron tabLinks o tabContents en el DOM.');

// };
