document.addEventListener('DOMContentLoaded', () => {
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');
    const roleSelect = document.getElementById('role');
    const patientFields = document.getElementById('patientFields');
    const doctorFields = document.getElementById('doctorFields');
    const doctorSearchForm = document.getElementById('doctorSearchForm');
    const patientInfo = document.getElementById('patientInfo');
    const saveChanges = document.getElementById('saveChanges');

    tabLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            tabLinks.forEach(link => link.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            link.classList.add('active');
            document.getElementById(link.getAttribute('data-tab')).classList.add('active');
        });
    });

    // // Mostrar/ocultar campos de acuerdo al rol seleccionado
    // roleSelect.addEventListener('change', () => {
    //     if (roleSelect.value === 'doctor') {
    //         patientFields.classList.add('hidden');
    //         doctorFields.classList.remove('hidden');
    //     } else {
    //         patientFields.classList.remove('hidden');
    //         doctorFields.classList.add('hidden');
    //     }
    // });

    // Inicio de sesión
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const loginDocument = document.getElementById('loginDocument').value;
        const loginPassword = document.getElementById('loginPassword').value;

    //     // Simulación de inicio de sesión
    //     if (loginDocument === '12345' && loginPassword === 'password') {
    //         alert('Inicio de sesión exitoso. Rol: Paciente');
    //         showPatientData();
    //     } else if (loginDocument === '67890' && loginPassword === 'password') {
    //         alert('Inicio de sesión exitoso. Rol: Médico');
    //         document.getElementById('doctorSearch').classList.add('active');
    //     } else {
    //         alert('Documento o contraseña incorrectos.');
    //     }
    });

    // Búsqueda de paciente
    doctorSearchForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const searchDocument = document.getElementById('searchDocument').value;

        // Simulación de datos de pacientes
        const patients = {
            "12345": { name: "Juan Pérez", email: "juan.perez@mail.com", diagnosis: "Gripe" },
            "67890": { name: "Ana Gómez", email: "ana.gomez@mail.com", diagnosis: "Asma" }
        };

        if (patients[searchDocument]) {
            const patient = patients[searchDocument];
            document.getElementById('patientName').value = patient.name;
            document.getElementById('patientDocument').value = searchDocument;
            document.getElementById('patientEmail').value = patient.email;
            document.getElementById('patientDiagnosis').value = patient.diagnosis;
            patientInfo.classList.remove('hidden');
        } else {
            alert('No se encontró el paciente.');
        }
    });

    // Guardar cambios del paciente
    saveChanges.addEventListener('click', () => {
        const updatedEmail = document.getElementById('patientEmail').value;
        const updatedDiagnosis = document.getElementById('patientDiagnosis').value;
        alert(`Datos actualizados:\nCorreo: ${updatedEmail}\nDiagnóstico: ${updatedDiagnosis}`);
    });
});
