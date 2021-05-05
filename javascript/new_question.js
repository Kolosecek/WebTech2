

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

