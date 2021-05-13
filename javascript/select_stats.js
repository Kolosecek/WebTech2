document.querySelector("#submit-pdf-btn").addEventListener("click", function() {
    $.ajax({
        type: "GET",
        url: "download_pdf.php?code=" + document.querySelector("#tests").value,
        //data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            console.log(data);
            //document.querySelector("#result").innerHTML = data;
            //var blob = new Blob([data], {type: 'application/pdf'})
            //var url = URL.createObjectURL(blob);
            //location.assign(url);
        }
    });
});