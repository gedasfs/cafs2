document.addEventListener('DOMContentLoaded', () => {
    const searchBtn = document.querySelector('#searchBtn');
    const searchInpt = document.querySelector('#searchBarInpt');
    const msgDiv = document.querySelector('.messages');

    
    searchBtn?.addEventListener('click', async ev => {
        try {
            // console.log(searchInpt.name, searchInpt.value);

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

            let msgSpan = document.createElement('span');

            if (!response.status) {
                if (response.httpResponseCode >= 400 && response.httpResponseCode < 500 && Object.keys(response.content.length > 0)) {
                    for (let error in response.content) {
                        let inptEl = document.querySelector(`[name=${error}]`);
                        inptEl?.classList.add('is-invalid');

                        msgSpan.classList.add('mt-2', 'text-danger', 'is-invalid-helper');
						msgSpan.textContent = response.content[error];
                        msgDiv.prepend(msgSpan); 
                    }


                    // if (response.httpResponseCode == 422 && Object.keys(response.content.length > 0)) {
                    //     for (let inputName in response.content) {
                    //         let inptEl = document.querySelector(`[name=${inputName}]`);
                    //         inptEl.classList.add('is-invalid');

                    //         msgSpan.classList.add('ms-2', 'text-danger', 'is-invalid-helper');
					// 		msgSpan.textContent = response.content[inputName];

                    //         inptEl.parentElement.after(msgSpan);
                    //     }
                    // }
                    
                }
            } 
            // Request OK
            else {
                console.log('Success:', response);
                searchInpt.value = ''

                msgSpan.classList.add('mt-2', 'd-block');
                msgSpan.textContent = response.msg;

                msgDiv.prepend(msgSpan); 
            }
        } catch (error) {
            console.log('error: ', error);
        }
    });
});