// Article 1
const alertBtn = document.querySelector('#alertBtn');

document.addEventListener('DOMContentLoaded', function() {
    alertBtn?.addEventListener('click', function() {
        alert('Hello World!');
    });
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

document.addEventListener('DOMContentLoaded', function() {
    btnsUpperLower.forEach(btn => {
        btn.addEventListener('click', (event) => {
            let inpValue = inpTxtUpperLower.value;
            let btnType = event.target.dataset.btn;
    
            inpTxtUpperLower.value = changeStr(inpValue, btnType);
        });
    });
});



// Article 3
const btnSaveEmailPhone = document.querySelector('#btn-save-email-phone');
const inpEmail = document.querySelector('#email');
const inpPhone = document.querySelector('#phone-number');
const errDivEmail = document.querySelector('#err-div-email');
const errDivPhone = document.querySelector('#err-div-phone');
const successDivEmailPhone = document.querySelector('#success-div-email-phone');

function validateEmail(email) {
    const regExp = /^[A-Z][0-9A-Z_.-]+@[0-9A-Z_-]+\.[A-Z]+$/i;

    return regExp.test(email);
}

function validatePhoneNumber(number) {
    const regExp = /^\+[0-9]{5,12}$/;
    
    return regExp.test(number);
}

function showElement(element) {
    if (element) {
        element.classList.remove('d-none');
        element.classList.add('d-block');
        
        return true;
    }
    return false;
}

function hideElement(element) {
    if (element) {
        element.classList.remove('d-block');
        element.classList.add('d-none');
        
        return true;
    }
    return false;
}

document.addEventListener('DOMContentLoaded', function() {
    btnSaveEmailPhone?.addEventListener('click', () => {
        let inpEmailVal = inpEmail.value;
        let inpPhoneVal = inpPhone.value;
        
        let checkEmailRes = validateEmail(inpEmailVal);
        let checkPhoneRes = validatePhoneNumber(inpPhoneVal);
    
        if (!checkEmailRes) {
            showElement(errDivEmail);
            inpEmail.classList.add('border-danger');
        } else {
            hideElement(errDivEmail);
            inpEmail.classList.remove('border-danger');
        }
    
        if (!checkPhoneRes) {
            showElement(errDivPhone);
            inpPhone.classList.add('border-danger');
        } else {
            hideElement(errDivPhone);
            inpPhone.classList.remove('border-danger');
        }
    
        if (checkEmailRes && checkPhoneRes) {
            inpEmail.value = '';
            inpPhone.value = '';
            showElement(successDivEmailPhone);
    
            setTimeout(() => {
                hideElement(successDivEmailPhone);
    
            }, 5000);
        }
    });
});



// Article 4
const inpBlockUnblock = document.querySelector('#inp-block-unblock');
const btnsBlockUnblock = document.querySelectorAll('#art-4 button[data-btn]');

document.addEventListener('DOMContentLoaded', function() {
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
});



// Article 5
const imgElement = document.querySelector('#art-5 img');
const imgElements = document.querySelectorAll('#art-5 img');
const imgSrcs = [
    'https://picsum.photos/id/239/300',
    'https://picsum.photos/id/238/300',
];

document.addEventListener('DOMContentLoaded', function() {
    imgElement?.addEventListener('mouseenter', () => {
        imgElement.src = imgSrcs[0];

    });
    imgElement?.addEventListener('mouseleave', () => {
        imgElement.src = imgSrcs[1];

    });
});



// Article 6
const txtDiv = document.querySelector('#txt-div-in-art-6');
const smallTxt = txtDiv?.querySelector('small');
const allLinks = document.querySelectorAll('#art-6 a');
const resetBtn = document.querySelector('#reset-all');
const btnGroupIDs = ['cursors', 'colors', 'borders'];
// const btnGroupDivs = document.querySelectorAll('#art-6 .btn-group');

document.addEventListener('DOMContentLoaded', function() {
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
    
    });
});