function showMessage(outputElement, messageInfo) {
    let msgPar = document.createElement('p');
    let parTxt = document.createTextNode(messageInfo.msgStr);

    msgPar.append(parTxt);
    outputElement.append(msgPar);

    if (messageInfo.error) {
        msgPar.classList.add('text-danger');
    } else {
        msgPar.classList.add('text-success');
    }
}

function showUserProfileImg(appendTo, imagePath) {
    const profileImg = document.createElement('img');
    profileImg.setAttribute('src', imagePath);
    profileImg.setAttribute('alt', 'userProfile');

    appendTo.appendChild(profileImg);
}

document.addEventListener('DOMContentLoaded', () => {
    const userProfileForm = document.querySelector('#userProfileForm');
    // const userRegistrationDiv = document.querySelector('#userRegistration');
    const userProfile = document.querySelector('#userProfile');
    
    userProfileForm.addEventListener('submit', async event => {
        event.preventDefault();

        const formData = new FormData(userProfileForm);
        formData.append('userForm', true);
        let response = await fetch(window.location.href, {
            method: 'POST',
            body: formData,
        });

        let result = await response.json();
        console.log(result);

        const messagesDiv = document.querySelector('.messages');
        messagesDiv.innerHTML = '';

        if (Object.keys(result).length !== 0) {
            showMessage(messagesDiv, result);

            if (!result.error) {
                userProfileForm.reset();
                userProfile.innerHTML = '';
                showUserProfileImg(userProfile, result.profilePNGPath);
                userProfile.style.display = 'block';
            }

        }
    });
    
});

