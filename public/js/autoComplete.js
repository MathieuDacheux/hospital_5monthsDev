/************************************** *************************************/
/************* Auto complete on search bar inside Patients List *************/
/************************************** *************************************/

const searchInput = document.querySelector('.searchBar');

// Autocomplete on search bar inside Patients List with SQL ajax request
searchInput.addEventListener('input', function() {
    let inputValue = searchInput.value;
    let renderResult = document.querySelector('.containerContent');
    let tamponContainer = document.querySelector('.renderResult');

    if (inputValue.length > 0) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://hospital.localhost/patients?search=' + inputValue, true);
        xhr.onload = function() {
            if (this.status == 200) {
                tamponContainer.innerHTML = this.responseText;
                let searchResultContainer = tamponContainer.querySelectorAll('.listingRecap');
                let containerListingPages = document.querySelector('.containerListingPages');
                renderResult.innerHTML = '';
                searchResultContainer.forEach(element => {
                    renderResult.appendChild(element);
                });
            }
        }
        xhr.send();
    } else {
        renderResult.style.display = 'block';
    }
});