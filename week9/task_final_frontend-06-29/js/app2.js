
function changeStr(str, changeToWhat) {
    if (str === '' || changeToWhat === '') {
        return '';
    }

    if (changeToWhat === 'upper') {
        str = str.toUpperCase();
    }
    if (changeToWhat === 'lower') {
        str = str.toLowerCase();
    }
    if (changeToWhat === 'upperFirst') {
        str =  str[0].toUpperCase() + str.substring(1);
    }
    if (changeToWhat === 'lowerFirst') {
        str = str[0].toLowerCase() + str.substring(1);
    }

    return str;
}

function validateEmail(email) {
    const regExp = /^[A-Z][0-9A-Z_.-]+@[0-9A-Z_-]+\.[A-Z]+$/i;

    return regExp.test(email);
}

function validatePhoneNumber(number) {
    const regExp = /^\+[0-9]{5,}$/;
    
    return regExp.test(number);
}


function sendToServer(data) {
    const errors = {};
    const response = {
        status: 202,
    };

    if ('email' in data === false || !validateEmail(data.email)) {
        errors['email'] = 'Please check the email';
    }

    if ('phone_number' in data === false || !validatePhoneNumber(data.phone_number)) {
        errors['phone_number'] = 'Please check the phone number';
    }

    if (Object.keys(errors).length > 0) {
        response.status = 422;
        response.errors = errors;
    }
    console.log(data);
    console.log(errors);
    
    return response;
}

function init() {
    // Art 1
    document.querySelector('#alertBtn')?.addEventListener('click', () => alert('Hello World.'));

    // Art 2
    const inpTxtUpperLower = document.querySelector('#inp-txt-upp-low');
    const btnsUpperLower = document.querySelectorAll('#art-2 button[data-btn]');

    btnsUpperLower.forEach(btn => {
        btn.addEventListener('click', (event) => {
            let inpValue = inpTxtUpperLower.value;
            let btnType = event.target.dataset.btn;
    
            inpTxtUpperLower.value = changeStr(inpValue, btnType);
        });
    });

    // Art 3
    const divToValidate = document.querySelector('#to-validate');
    
    divToValidate.querySelector('button')?.addEventListener('click', () => {
        divToValidate.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        divToValidate.querySelectorAll('.invalid-feedback').forEach(el => el.remove());

        const data = {};

        divToValidate?.querySelectorAll('input[name]').forEach(element => {
            data[element.name] = element.value;
        });

        const response = sendToServer(data);
        console.log(response);

        if (response.status == 422) {
            for (let errName in response.errors) {
                let inputEl = divToValidate?.querySelector(`input[name="${errName}"]`);

                if (inputEl) {
                    inputEl.classList.add('is-invalid');

                    const errDiv = document.createElement('div');

                    errDiv.classList.add('invalid-feedback');
                    errDiv.textContent = response.errors[errName];
                    inputEl.parentNode.appendChild(errDiv);
                } 
            }
        } else {
            let successDiv = document.querySelector('#success-div-email-phone');

            successDiv.classList.remove('d-none');
            successDiv.classList.add('d-block');

            divToValidate?.querySelectorAll('input[name]').forEach(el => el.value = '');

            setTimeout(() => {
                successDiv.classList.remove('d-block');
                successDiv.classList.add('d-none');
            }, 5000);
        }
    });


    // Art 4
    const inpBlockUnblock = document.querySelector('#inp-block-unblock');
    const btnsBlockUnblock = document.querySelectorAll('#art-4 button[data-btn]');

    btnsBlockUnblock.forEach(btn =>  {
        btn.addEventListener('click', (event) => {
            let btnType = event.target.dataset.btn;
    
            if (btnType === 'block') {
                inpBlockUnblock.disabled = true;
            }
            if (btnType === 'unblock') {
                inpBlockUnblock.disabled = false;
            }
        });
    });

    // Art 5
    const imgElement = document.querySelector('#art-5 img');
    const imgElements = document.querySelectorAll('#art-5 img');
    const imgSrcs = [
        'https://picsum.photos/id/239/300',
        'https://picsum.photos/id/238/300',
    ];

    imgElement?.addEventListener('mouseenter', () => {
        imgElement.src = imgSrcs[0];
    });
    imgElement?.addEventListener('mouseleave', () => {
        imgElement.src = imgSrcs[1];
    });

    // Art 6
    const txtDiv = document.querySelector('#txt-div-in-art-6');
    const smallTxt = txtDiv?.querySelector('small');
    const allLinks = document.querySelectorAll('#art-6 a');
    const resetBtn = document.querySelector('#reset-all');
    const btnGroupIDs = ['cursors', 'colors', 'borders'];

    allLinks.forEach(link => {
        link.addEventListener('click', event => {
            event.preventDefault();
    
            let btnGrpID = event.target.parentElement.parentElement.parentElement.id;   // div id
            
            if (btnGrpID === btnGroupIDs[0]) {  
                let cursorType = event.target.dataset.cursorType;
                
                txtDiv.style.cursor = cursorType;
            }
    
            if (btnGrpID === btnGroupIDs[1]) {
                let color = event.target.dataset.color;
                
                txtDiv.style.color = color;
                smallTxt.setAttribute('style', `color:${color} !important`);
            }
    
            if (btnGrpID === btnGroupIDs[2]) {
                let borderColor = event.target.dataset.borderColor;
    
                txtDiv.style.setProperty('border', `1px solid ${borderColor}`);
            }
    
        });
    });

    resetBtn?.addEventListener('click', event => {
        txtDiv.style.cursor = 'default';
        txtDiv.style.color = '';
        smallTxt.style.color = '';
        txtDiv.style.border = 'none';
    
        // removes all inline style
        // txtDiv.removeAttribute('style');
        // smallTxt.removeAttribute('style');
    
        // currently only works on chrome, edge and opera:
        // txtDiv.attributeStyleMap.clear();
        // smallTxt.attributeStyleMap.clear();
    });
}

document.addEventListener('DOMContentLoaded', init);