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

function showField(event) {
    hideAllQuestions();
    const value = event.target.value;
    const id = "#" + value + "-question";
    w3.show(id);
}

function hideAllQuestions() {
    const ids = ["#short-question", "#multi-question", "#compare-question", "#draw-question", "#multi-question", "#math-question"];
    ids.forEach(w3.hide);
}

document.querySelector("#type").addEventListener("change", showField);