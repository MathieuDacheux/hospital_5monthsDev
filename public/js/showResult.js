/********************************* ********************************/
/************** Show the result of adding a patient ***************/
/******************************** *********************************/

const containerContent = document.querySelector('.containerSubject');

const showResult = () => {
    
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
            if (resultFormText.textContent == 'Le patient a bien été ajouté') {
                setTimeout(() => {
                    window.location.href = '/patients';
                }, 2000);
            }
        }
    };
};

window.addEventListener('submit', showResult());