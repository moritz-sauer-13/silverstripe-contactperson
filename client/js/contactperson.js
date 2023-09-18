let contactperson = document.getElementById("contactperson");
let icon = contactperson.querySelector('.contactperson__icon');
let content = contactperson.querySelector('.contactperson__content');

icon.addEventListener('click', function () {
    content.classList.toggle('active');
});

let search = contactperson.querySelector('.search');
let searchResults = contactperson.querySelector('.search__results');
if(search){
    let input = search.querySelector('input');
    let url = input.getAttribute('data-url');
    let value = '';
    input.addEventListener('input', function (e) {
         value = e.target.value;
         getSearch(url, value);
    });
}

function getSearch(url, value) {
    if(value.length < 1){
        searchResults.innerHTML = '';
    } else if(url){
        fetch(url + '?value=' + value, {
            method: 'GET',
        }).then(response => response.text())
        .then(text => {
            searchResults.innerHTML = text;
        }).then(() => {
            handleAutoCompleteSelect(searchResults);
        });
    }
}

function handleAutoCompleteSelect(searchResults){
    if(searchResults){
        searchResults = searchResults.querySelectorAll('.search__result');
        searchResults.forEach((searchResult) => {
            searchResult.addEventListener('click', function (e) {
                loadContactPerson(searchResult.getAttribute('data-id'));
            });
        })
    }
}

function loadContactPerson(id){
    let url = search.getAttribute('data-url');
    if(url){
        fetch(url + '?id=' + id, {
            method: 'GET',
        }).then(response => response.json())
        .then(json => {
            content.querySelector('.content').innerHTML = json.html;
            let img = icon.querySelector('img');
            if(json.imageurl !== null){
                img.setAttribute('src', json.imageurl);
                img.setAttribute('alt', json.alt);
                img.classList.remove('d-none');
                let svg = icon.querySelector('svg');
                if(svg){
                    svg.classList.add('d-none');
                }
            } else {
                img.classList.add('d-none');
                let svg = icon.querySelector('svg');
                if(svg){
                    svg.classList.remove('d-none');
                }
            }
            searchResults.innerHTML = '';
        });
    }
}