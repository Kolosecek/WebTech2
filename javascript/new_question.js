$("#formToSend2").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    let form = $(this);
    let url = form.attr('action');

    $.ajax({
        type: "GET",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
                    console.log(data);
                    //window.location.href = data;
        }
    });
});

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