/********************************* ********************************/
/************** Show the result of adding a patient ***************/
/******************************** *********************************/

const containerContent = document.querySelector('.containerSubject');
const uriPatient = '/patients';
const uriAppointment = '/rendez-vous';

const showResult = () => {
    // If the uri equal /patients
    if (window.location.pathname === '/patients') {
        if (document.querySelector('.showResult')) {
            const showResult = document.querySelector('.showResult');
            const resultFormText = document.querySelector('.resultFormText');
            if (showResult.classList.contains('visible')) {
                containerContent.style.opacity = '0.5';
                setTimeout(() => {
                    showResult.classList.remove('visible');
                    showResult.classList.add('hidden');
                    containerContent.style.opacity = '1';
                }, 2000);
                if (resultFormText.textContent == 'Le données ont bien été ajoutées') {
                    setTimeout(() => {
                        window.location.href = uriPatient;
                    }, 2000);
                };
            };
        };
    } else {
        if (document.querySelector('.showResult')) {
            const showResult = document.querySelector('.showResult');
            const resultFormText = document.querySelector('.resultFormText');
            if (showResult.classList.contains('visible')) {
                containerContent.style.opacity = '0.5';
                setTimeout(() => {
                    showResult.classList.remove('visible');
                    showResult.classList.add('hidden');
                    containerContent.style.opacity = '1';
                }, 2000);
                if (resultFormText.textContent == 'Le données ont bien été ajoutées') {
                    setTimeout(() => {
                        window.location.href = uriAppointment;
                    }, 2000);
                };
            };
        };
    }
};

window.addEventListener('submit', showResult());