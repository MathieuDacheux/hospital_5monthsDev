/********************************* ********************************/
/************** Show the result of adding a patient ***************/
/******************************** *********************************/

const containerContent = document.querySelector('.containerSubject');
const uriPatient = '/patients';
const uriAppointment = '/rendez-vous';

const showResultUri = (URI) => {
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
                    window.location.href = URI;
                }, 2000);
            };
        };
    };
}

const showResult = () => {
    // If the uri equal /patients
    if (window.location.pathname === '/patients') {
        showResultUri(uriPatient);
    } else {
        showResultUri(uriAppointment);
    }
};

window.addEventListener('submit', showResult());