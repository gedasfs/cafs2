document.addEventListener('DOMContentLoaded', () => {
    const urlInpt = document.querySelector('#urlInpt');
    const urlInpForm = document.querySelector('#urlInpForm');
    const msgDiv = document.querySelector('#messages');
    const linksDiv = document.querySelector('#links');

    
    urlInpForm?.addEventListener('submit', async ev => {
        try {
            ev.preventDefault();

            Array.from(document.querySelectorAll('.is-invalid')).forEach(el => {
                el.classList.remove('is-invalid');
            });
            Array.from(document.querySelectorAll('.is-invalid-helper')).forEach(el => {
                el.remove();
            });

            const formData = new FormData();

            formData.append(urlInpt.name, urlInpt.value);

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
                        inptEl.after(msgSpan); 
                    }                   
                }
            } else {
                console.log('Success:', response);
                urlInpt.value = '';
               
                if (linksDiv.classList.contains('d-none')) {
                    linksDiv.classList.remove('d-none');
                }

                let linksList = linksDiv.querySelector('ol');
                let linkItem = document.createElement('li');

                let link = document.createElement('a');
                link.textContent = response.content.redirectUrl;
                link.setAttribute('href', response.content.redirectUrl);
                link.setAttribute('title', `URL for ${response.content.userUrl}`);
                link.setAttribute('target', '_blank');
                link.classList.add('text-decoration-none');

                let par = document.createElement('p');
                par.textContent = response.content.userUrl;
                par.classList.add('ms-2', 'fw-light', 'fst-italic', 'linklist-span');

                linkItem.append(link);
                linkItem.append(par);
                linksList.prepend(linkItem);
            }
        } catch (error) {
            console.log('error: ', error);
        }
    });
});