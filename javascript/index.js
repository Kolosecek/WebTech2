$("#formToSend").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    let form = $(this);
    let url = form.attr('action');

    $.ajax({
        type: "GET",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            if (data == 0) {
                alert("User not found, please check your login info")
            } else {
                if (data == 0) {
                    alert("Email address not found");
                } else if (data == 1) {
                    alert("Wrong password");
                } else if (data == 2) {
                    alert("Wrong 2FA code")
                } else {
                    //console.log(data);
                    window.location.href = data;
                }
            }
        }
    });
});

$("#formToSend2").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    let form = $(this);
    let url = form.attr('action');

    $.ajax({
        type: "GET",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data) {
            if(data == 0) {
                alert("User not found, please check your login info")
            } else {
                if (data == 0) {
                    alert("Email address not found");
                } else if (data == 1) {
                    alert("Wrong password");
                } else if (data == 2) {
                    alert("Wrong 2FA code")
                } else {
                    //console.log(data);
                    window.location.href = data;
                }
            }
        }
    });
});