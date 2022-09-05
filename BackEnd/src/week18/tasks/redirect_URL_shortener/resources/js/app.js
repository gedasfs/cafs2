document.addEventListener('DOMContentLoaded', () => {
    const searchBtn = document.querySelector('#searchBtn');
    const searchInpt = document.querySelector('#searchBarInpt');
    const msgDiv = document.querySelector('#messages');
    const linksDiv = document.querySelector('#links');

    
    searchBtn?.addEventListener('click', async ev => {
        try {
            Array.from(document.querySelectorAll('.is-invalid')).forEach(el => {
                el.classList.remove('is-invalid');
            });
            Array.from(document.querySelectorAll('.is-invalid-helper')).forEach(el => {
                el.remove();
            });

            const formData = new FormData();

            formData.append(searchInpt.name, searchInpt.value);

            let response = await fetch('?module=generate', {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest', },
                body: formData,
            });
            response = await response.json();


            if (!response.status) {
                if (response.httpResponseCode >= 400 && response.httpResponseCode < 500 && Object.keys(response.content.length > 0)) {
                    for (let error in response.content) {
                        console.log('Fail: ', response);

                        let msgSpan = document.createElement('span');
                        let inptEl = document.querySelector(`[name=${error}]`);
                        inptEl?.classList.add('is-invalid');

                        msgSpan.classList.add('mt-2', 'text-danger', 'is-invalid-helper');
						msgSpan.textContent = response.content[error];
                        msgDiv.prepend(msgSpan); 
                    }                   
                }
            } else {
                console.log('Success:', response);
                searchInpt.value = '';
               
                if (linksDiv.classList.contains('d-none')) {
                    linksDiv.classList.remove('d-none');
                }

                let linksList = linksDiv.querySelector('ol');
                let linkItem = document.createElement('li');

                linkItem.innerHTML = `<a title="URL for ${response.content.userUrl}" href="${response.content.redirectUrl}" target="_blank">${response.content.redirectUrl}</a>`;
                linksList.prepend(linkItem);
            }
        } catch (error) {
            console.log('error: ', error);
        }
    });
});