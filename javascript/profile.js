function logout(){
    var url = "backend/controller_logout.php?type=logout";
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
    var url = "exam.php";
    window.location.href = url;
};

function newQuestion(){
    var url = "new_question.php";
    window.location.href = url;
}

function profile(){
    var url = "profile.php";
    window.location.href = url;
}