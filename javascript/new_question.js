let element = MathLive.makeMathField(document.getElementById("mathfield"), {
  virtualKeyboardMode: "manual",
  virtualKeyboards: "numeric functions symbols roman greek",
  smartMode: true,
});

$("#formToSend3").submit(function (e) {
  e.preventDefault(); // avoid to execute the actual submit of the form.
  let latex = document.getElementById("latex");
  latex.value = element.getValue("latex");
  let form = $(this);
  let url = form.attr("action");


  $.ajax({
    type: "GET",
    url: url,
    data: form.serialize(), // serializes the form's elements.
    success: function (data) {
      console.log(data);
      window.location.href = data;
    },
  });
});

function showField(event) {
  hideAllQuestions();
  const value = event.target.value;
  const id = "#" + value + "-question";
  if (value == "math") {
    $("#question").css("display","none");
  }
  else {
    $("#question").css("display","block");
  }
  w3.show(id);
}

function hideAllQuestions() {
  const ids = [
    "#short-question",
    "#multi-question",
    "#compare-question",
    "#draw-question",
    "#multi-question",
    "#math-question",
  ];
  ids.forEach(w3.hide);
}

document.querySelector("#type").addEventListener("change", showField);
