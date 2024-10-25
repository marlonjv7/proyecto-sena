document.addEventListener('DOMContentLoaded', () => {
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');
    const roleSelect = document.getElementById('role');
    const patientFields = document.getElementById('patientFields');
    const doctorFields = document.getElementById('doctorFields');
    const doctorSearchForm = document.getElementById('doctorSearchForm');
    const patientInfo = document.getElementById('patientInfo');
    const saveChanges = document.getElementById('saveChanges');
    const loginForm = document.getElementById('loginForm');

    // Verificar si los elementos existen antes de interactuar con ellos
    if (loginForm) {
        loginForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const loginDocument = document.getElementById('loginDocument').value;
            const loginPassword = document.getElementById('loginPassword').value;
            // Aquí puedes agregar la lógica de inicio de sesión
        });
    }

    if (doctorSearchForm) {
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
                if (patientInfo) patientInfo.classList.remove('hidden');
            } else {
                alert('No se encontró el paciente.');
            }
        });
    }

    if (saveChanges) {
        saveChanges.addEventListener('click', () => {
            const updatedEmail = document.getElementById('patientEmail').value;
            const updatedDiagnosis = document.getElementById('patientDiagnosis').value;
            alert(`Datos actualizados:\nCorreo: ${updatedEmail}\nDiagnóstico: ${updatedDiagnosis}`);
        });
    }

    // Verificar si hay tabLinks y tabContents antes de agregar los event listeners
    if (tabLinks.length > 0 && tabContents.length > 0) {
        tabLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                
                // Remover la clase 'active' de todos los links y contenidos
                tabLinks.forEach(link => link.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Agregar la clase 'active' al link y contenido correspondiente
                link.classList.add('active');
                const tabId = link.getAttribute('data-tab');
                const targetTab = document.getElementById(tabId);

                if (targetTab) {
                    targetTab.classList.add('active');
                } else {
                    console.error(`No se encontró el contenido con el ID: ${tabId}`);
                }
            });
        });
    } else {
        console.error('No se encontraron tabLinks o tabContents en el DOM.');
    }
});
