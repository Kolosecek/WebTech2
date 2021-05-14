document.querySelector("#submit-pdf-btn").addEventListener("click", function() {
    fetch("download_pdf.php?code=" + document.querySelector("#tests").value, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json; charset=utf-8'
        },
    })
    .then(response => response.blob())
    .then(response => {
        const blob = new Blob([response], {type: 'application/pdf'});
        const downloadUrl = URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = downloadUrl;
        a.download = 'exam_' + document.querySelector("#tests").value + '.pdf';
        document.body.appendChild(a);
        a.click();
    })
});