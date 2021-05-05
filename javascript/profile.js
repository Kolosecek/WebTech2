function logout(){
    let url = "backend/controller_logout.php?type=logout";
    $.ajax({
        type: "GET",
        url: url,
        success: function(data) {
            window.location.href = data;
        }
        }
    );
};

function newExam(){
    let url = "new_exam.php";
    window.location.href = url;
};

function newQuestion(){
    let url = "new_question.php";
    window.location.href = url;
}

function profile(){
    let url = "profile.php";
    window.location.href = url;
}

function allExams(){
    let url = "exams.php";
    window.location.href = url;
}