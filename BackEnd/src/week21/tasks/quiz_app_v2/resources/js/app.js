document.addEventListener('DOMContentLoaded', () => {

    const btnStart = document.querySelector('#btnStart');

    btnStart.addEventListener('click', (ev) => {

        const quizName = document.querySelector('input[name="quiz_name"]').value;
        const quizAnswer = document.querySelector('#quizQuestion').querySelector('input:checked');
        let currQuestionNo = document.querySelector('input[name="curr_Q_No"]')?.value;

        currQuestionNo = currQuestionNo ?? 0; 

        if (currQuestionNo && !quizAnswer) {
            alert('Please select your answer.');
        } else {
            const formData = new FormData();
            if (quizAnswer) {
                formData.append(quizAnswer.name, quizAnswer.value);
            }
    
            const url = `/quizzes/${quizName}/${currQuestionNo}`;
    
            fetch(url, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                body: formData,
            })
            .then(response => response.text())
            .then(text => {
                const quizQuestion = document.querySelector('#quizQuestion');
                console.log();
    
                quizQuestion.innerHTML = text;
                quizQuestion.classList.remove('d-none');
                ev.target.textContent = 'Next';
                // ev.target.classList.add('float-end');
            });
        }
    });
});