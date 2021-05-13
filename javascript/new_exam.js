$("#formToSend3").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    let form = $(this);
    let url = form.attr('action');

    $.ajax({
        type: "GET",
        url: url,
        data: form.serialize(),
        success: function(data) {
            window.location.href = data;
        }
    });
});