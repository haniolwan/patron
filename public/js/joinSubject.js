let token = document.querySelector('meta[name="_token"]').content;
let joinButtons = document.querySelectorAll('.join');
let alertMsg = document.querySelector('.display_text');
subjectCode = "";

joinButtons.forEach((ele) => ele.addEventListener('click', (e) => {
    e.preventDefault();
    let subjectId = e.target.getAttribute('subject-id');
    let subjectStatus = e.target.getAttribute('data-status');
    let role = e.target.getAttribute('role');

    if (role !== 'student') {
        if (subjectStatus == 1) {
            subjectCode = prompt("Enter subject code", "");
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        },
    });
    $.ajax({
        url: '/' + role + '/join-subject/' + subjectId,
        type: 'POST',
        data: {
            role,
            code: subjectCode,
            status: subjectStatus == 1 ? "private" : 'public'
        },
        success: function (response) {
            if (response.status === 400) {
                alertMsg.textContent = response.message;
            } else {
                if (role === 'student') {
                    window.location.href = "/student/subject/" + subjectId;
                } else {
                    window.location.href = "/subject/" + subjectId;
                }
            }
        },
        error: function (result) {
            console.log(result)
        }
    });
}
))