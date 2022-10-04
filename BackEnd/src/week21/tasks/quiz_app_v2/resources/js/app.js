document.addEventListener('DOMContentLoaded', () => {

    const btnStart = document.querySelector('#btnStart');

    btnStart?.addEventListener('click', (ev) => {

        const quizName = document.querySelector('input[name="quiz_name"]').value;
        const quizAnswerElem = document.querySelector('#quizQuestion').querySelector('input:checked');
        let currQuestionNo = document.querySelector('input[name="curr_Q_No"]')?.value;

        currQuestionNo = currQuestionNo ?? 0; 

        if (currQuestionNo && !quizAnswerElem) {
            alert('Please select your answer.');
        } else {
            const formData = new FormData();

            if (quizAnswerElem) {
                formData.append(quizAnswerElem.name, quizAnswerElem.value);
            }

            const url = `/quizzes/${quizName}/${currQuestionNo}`;
    
            fetch(url, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                const quizQuestion = document.querySelector('#quizQuestion');
                console.log(data);
    
                ev.target.textContent = 'Next';
                quizQuestion.innerHTML = data.html;
                quizQuestion.classList.remove('d-none');
                if ((data.totalQCount - 1) == currQuestionNo) {
                    ev.target.textContent = 'Finish';
                } else if ((data.totalQCount) == currQuestionNo)
                ev.target.classList.add('d-none');
            });
        }
    });
});