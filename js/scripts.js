document.addEventListener('DOMContentLoaded', event => {
    const roleSelect = document.getElementById('role');
    const patientFields = document.getElementById('patientFields');
    const doctorFields = document.getElementById('doctorFields');
    const form = document.getElementById('registrationForm');
    const submitButton = document.getElementById('submitButton');

    // Función para alternar campos visibles según el rol seleccionado
    function toggleFields() {
        if (roleSelect.value === 'doctor') {
            doctorFields.classList.remove('d-none');
            doctorFields.classList.add('d-flex');
            patientFields.classList.add('d-none');
            patientFields.classList.remove('d-flex');
        } else if (roleSelect.value === 'paciente') {
            patientFields.classList.remove('d-none');
            patientFields.classList.add('d-flex');
            doctorFields.classList.add('d-none');
            doctorFields.classList.remove('d-flex');
        } else {
            doctorFields.classList.add('d-none');
            patientFields.classList.add('d-none');
        }
    }

    roleSelect.addEventListener('change', toggleFields);
    toggleFields(); // Ejecuta una vez para ocultar los campos al cargar la página

    // Verifica si todos los campos obligatorios están llenos
    form.addEventListener('input', function () {
        submitButton.disabled = !form.checkValidity();
    });

    // Enviar datos de registro usando fetch
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('formulario.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Mostrar mensaje de éxito o error
            form.reset(); // Limpia el formulario después del registro
            toggleFields(); // Vuelve a ocultar los campos
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un problema con el servidor. Inténtelo más tarde.');
        });
    });
});