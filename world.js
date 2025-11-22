document.addEventListener('DOMContentLoaded', function() {
    //create button event listener
    const lookupBtn = document.getElementById('lookup');
    const lookupcitiesBtn = document.getElementById('lookup_city');
    const resultDiv = document.getElementById('result');

// add click to lokup
    lookupBtn.addEventListener('click', function() {
        const countryInput = document.getElementById('country');
        const country = countryInput.value;

        const xhr = new XMLHttpRequest();

        //create URL
        let url = 'world.php';
        if (country) {
            url += '?country=' + encodeURIComponent(country);
        }
        url += (country ? '&' : '?') + 'lookup=countries';

        xhr.open('GET', url, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
               resultDiv.innerHTML = xhr.responseText;
            }
        };

        xhr.send();

    });

    // add click to lookup cities
    lookupcitiesBtn.addEventListener('click', function() {
        const countryInput = document.getElementById('country');
        const country = countryInput.value;

        const xhr = new XMLHttpRequest();

        //create URL
        let url = 'world.php';
        if (country) {
            url += '?country=' + encodeURIComponent(country);
        }
        url += (country ? '&' : '?') + 'lookup=cities';

        xhr.open('GET', url, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
               resultDiv.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
        
    });

});