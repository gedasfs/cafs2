
function proccessQuestion(ev) {

    const divQuizzQuestion = document.querySelector('#quizzQuestion');
    const radioChecked = divQuizzQuestion.querySelectorAll('input:checked');

    if (radioChecked.length == 0) {
        alert('Please select your answer.');
    } else {
        const radioCheckedVal = radioChecked[0].value;
        const radioCheckedName = radioChecked[0].name;
        const hiddenInputs = document.querySelectorAll('input[type="hidden"]');
        
        const inputQuizzName = [...hiddenInputs].filter(input => input.name == 'quizz_name');
        const quizzName = inputQuizzName[0].value;

        const currQInp = [...hiddenInputs].filter(input => input.name == 'currQNo');
        const currQNo = +currQInp[0].value
        const nextQNo = currQNo + 1;

        const totalQsInp = [...hiddenInputs].filter(input => input.name == 'totalQs');
        const totalQs = +totalQsInp[0].value;


        const formData = new FormData();
        formData.append(radioCheckedName, radioCheckedVal);
        
        [...hiddenInputs].forEach(input => {
            formData.append(input.name, input.value);
        });

        let nextUrl = ''
        if (currQNo == totalQs) {
            nextUrl = `/quizzes/${quizzName}/finish`;

            fetch(nextUrl, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            }).then(response => response.text())
            .then(text => window.location.replace(text));

        } else {
            nextUrl = `/quizzes/${quizzName}/${nextQNo}`;

            fetch(nextUrl, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            }).then(response => response.text())
            .then(text => divQuizzQuestion.innerHTML = text);
        }
        
    }
}

function proccessFirst(ev) {
    const quizzName = document.querySelector('input[name="quizz_name"]').value;
    const divQuizzQuestion = document.querySelector('#quizzQuestion');
    

    console.log(quizzName);
    console.log(divQuizzQuestion);


    const nextUrl = `/quizzes/${quizzName}/1`;

        fetch(nextUrl, {
			method: 'POST',
			headers: {
				'X-Requested-With': 'XMLHttpRequest'
			},
		}).then(response => response.text())
        .then(text => {
            divQuizzQuestion.innerHTML = text;
            divQuizzQuestion.classList.remove('d-none');
            ev.target.classList.add('d-none');
            btnNext.classList.remove('d-none');
        });

}

function processContinue(ev) {
    const quizzName = document.querySelector('input[name="quizz_name"]').value;
    const nextQuizzQNo = document.querySelector('input[name="next_q_no"]').value;
    const divQuizzQuestion = document.querySelector('#quizzQuestion');
    const divContinue = document.querySelector('#divContinue');

    

    console.log(quizzName);
    console.log(nextQuizzQNo);
    console.log(divQuizzQuestion);


    const nextUrl = `/quizzes/${quizzName}/${nextQuizzQNo}`;

    const formData = new FormData();
    formData.append('continue', true);

        fetch(nextUrl, {
			method: 'POST',
			headers: {
				'X-Requested-With': 'XMLHttpRequest'
			},
            body: formData
		}).then(response => response.text())
        .then(text => {
            divQuizzQuestion.innerHTML = text;
            divQuizzQuestion.classList.remove('d-none');
            divContinue.classList.add('d-none');
            btnNext.classList.remove('d-none');
        });

}


document.addEventListener('DOMContentLoaded', ev => {

    const btnNext = document.querySelector('#btnNext');
    const btnStart = document.querySelector('#btnStart');
    const btnContinue = document.querySelector('#btnContinue');

    btnNext?.addEventListener('click', proccessQuestion);
    btnStart?.addEventListener('click', proccessFirst);
    btnContinue?.addEventListener('click', processContinue);
});