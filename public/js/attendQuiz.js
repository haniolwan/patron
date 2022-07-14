let token = document.querySelector('meta[name="_token"]').content;
let attendButton = document.querySelectorAll('.attend');

attendButton.forEach((ele) => ele.addEventListener('click', (e) => {
    e.preventDefault();
    let quizId = e.target.getAttribute('quiz-id');
    const attend = confirm('are you sure you want to attend the quiz ?\nInstructions:\n1.Quiz is multiple choice questions, you have to select one answer for the question to move to the next question.\n2.Try to finish answering all questions before the timer ends.\n3.Do NOT reload the quiz page during quiz.\nWarning: By reloading the quiz page you can NOT return to the quiz again, and you will get marks for the only answered questions.');    // $.ajaxSetup({

    if (attend) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            },
        })

        $.ajax({
            url: '/student/attend-quiz/' + quizId,
            type: 'GET',
            success: function (response) {
                if (response.status === 400) {
                    alertMsg.textContent = response.message;
                } else {
                    window.localStorage.setItem('question_count', window.localStorage.getItem('question_count') + 1);
                    window.location.href = "/student/quiz-page/" + quizId + "/" + response.first_quesiton;
                }
            },
            error: function (result) {
                console.log(result)
            }
        });
    }
}
))