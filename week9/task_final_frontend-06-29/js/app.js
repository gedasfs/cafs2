// Article 1
const alertBtn = document.querySelector('#alertBtn');

alertBtn?.addEventListener('click', () => {
    alert('Hello World!');
});



// Article 2 
const inpTxtUpperLower = document.querySelector('#inp-txt-upp-low');
const btnsUpperLower = document.querySelectorAll('#art-2 button[data-btn]');

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

btnsUpperLower?.forEach(btn => {
    btn.addEventListener('click', (event) => {
        let inpValue = inpTxtUpperLower.value;
        let btnType = event.target.dataset.btn;

        inpTxtUpperLower.value = changeStr(inpValue, btnType);
    });
});



// Article 3
const btnSaveEmailPhone = document.querySelector('#btn-save-email-phone');
const inpEmail = document.querySelector('#email');
const inpPhone = document.querySelector('#phoneNumber');
const errDivEmail = document.querySelector('#err-div-email');
const errDivPhone = document.querySelector('#err-div-phone');
const emailPhoneDivSucces = document.querySelector('#email-phone-div-success');

function checkEmail(email) {
    const regExp = /^[0-9A-Z_.-]+@[0-9A-Z_-]+\.[A-Z]+$/i;

    return (regExp.test(email) ? true : false);
}

function checkPhoneNumber(number) {
    const regExp = /^\+[0-9]+$/;
    
    return (regExp.test(number) ? true : false);
}

btnSaveEmailPhone?.addEventListener('click', () => {
    let inpEmailVal = inpEmail.value;
    let inpPhoneVal = inpPhone.value;
    
    let checkEmailRes = checkEmail(inpEmailVal);
    let checkPhoneRes = checkPhoneNumber(inpPhoneVal);

    if (!checkEmailRes) {
        errDivEmail.textContent = 'Please check email';
        inpEmail.classList.add('border-danger');
    } else {
        errDivEmail.textContent = '';
        inpEmail.classList.remove('border-danger');
    }

    if (!checkPhoneRes) {
        errDivPhone.textContent = 'Please check phone number';
        inpPhone.classList.add('border-danger');
    } else {
        errDivPhone.textContent = '';
        inpPhone.classList.remove('border-danger');
    }

    if (checkEmailRes && checkPhoneRes) {
        inpEmail.value = '';
        inpPhone.value = '';
        emailPhoneDivSucces.textContent = 'Your information has been saved.'

        setTimeout(() => {
            emailPhoneDivSucces.textContent = '';
        }, 5000);
    }
});



// Article 4
const inpBlockUnblock = document.querySelector('#inp-block-unblock');
const btnsBlockUnblock = document.querySelectorAll('#art-4 button[data-btn]');

btnsBlockUnblock?.forEach(btn =>  {
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



// Article 5
const imgElement = document.querySelector('#art-5 img');
const imgScrs = [
    'https://picsum.photos/id/239/300',
    'https://picsum.photos/id/238/300',
];

imgElement?.addEventListener('mouseenter', () => {
    imgElement.src = imgScrs[0];
});
imgElement?.addEventListener('mouseleave', () => {
    imgElement.src = imgScrs[1];
});



// Article 6
const txtDiv = document.querySelector('#txt-div-in-art-6');
const smallTxt = document.querySelector('small');
const allLinks = document.querySelectorAll('#art-6 a');
const resetBtn = document.querySelector('#reset-all');
// const btnGroupDivs = document.querySelectorAll('#art-6 .btn-group');
const btnGroupIDs = ['cursors', 'colors', 'borders'];

allLinks?.forEach(link => {
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
    txtDiv.removeAttribute('style');
    smallTxt.removeAttribute('style');

    // only working on chrome
    // txtDiv.attributeStyleMap.clear();
    // smallTxt.attributeStyleMap.clear();
});