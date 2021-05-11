let canvas, ctx, flag = false;
let [currX, prevX, currY, prevY] = [0, 0, 0, 0];
let dot_flag = false;

let color = "black";
let width = 2;

function init() {
    canvas = document.getElementById('canvas');
    ctx = canvas.getContext("2d");
    $('#success-alert').hide();
    $('#error-alert').hide();

    canvas.addEventListener("mousemove", function (e) {
        findxy('move', e)
    }, false);
    canvas.addEventListener("mousedown", function (e) {
        findxy('down', e)
    }, false);
    canvas.addEventListener("mouseup", function (e) {
        findxy('up', e)
    }, false);
    canvas.addEventListener("mouseout", function (e) {
        findxy('out', e)
    }, false);
}

function switchColor(obj) {
    switch (obj.id) {
        case "green":
            color = "green";
            break;
        case "blue":
            color = "blue";
            break;
        case "red":
            color = "red";
            break;
        case "yellow":
            color = "yellow";
            break;
        case "orange":
            color = "orange";
            break;
        case "black":
            color = "black";
            break;
        case "white":
            color = "white";
            break;
    }
    if (color === "white") width = 14;
    else width = 2;

}

function draw() {
    ctx.beginPath();
    ctx.moveTo(prevX, prevY);
    ctx.lineTo(currX, currY);
    ctx.strokeStyle = color;
    ctx.lineWidth = width;
    ctx.stroke();
    ctx.closePath();
}

function erase() {
    const m = confirm("Do you want to delete the image?");
    if (m) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        document.getElementById("canvasimg").style.display = "none";
    }
}

function findxy(res, e) {
    if (res === 'down') {
        prevX = currX;
        prevY = currY;
        currX = e.pageX - canvas.offsetLeft;
        currY = e.pageY - canvas.offsetTop;

        flag = true;
        dot_flag = true;
        if (dot_flag) {
            ctx.beginPath();
            ctx.fillStyle = color;
            ctx.fillRect(currX, currY, 2, 2);
            ctx.closePath();
            dot_flag = false;
        }
    } else if (res === 'up' || res === "out") {
        flag = false;
    } else if (res === 'move' && flag) {
        prevX = currX;
        prevY = currY;
        currX = e.pageX - canvas.offsetLeft;
        currY = e.pageY - canvas.offsetTop;
        draw();
    }
}

function saveDrawing(event) {
    let canvas = document.getElementById('canvas');
    let dataURL = canvas.toDataURL();
    const success = document.querySelector("#success-alert");
    const error = document.querySelector("#error-alert");
    let QID = event.target.getAttribute("qId");
    let tID = event.target.getAttribute("tId");
    $.ajax({
        type: "POST",
        url: "backend/save_canvas.php",
        data: {
            imgBase64: dataURL,
            qID: QID,
            tID: tID
        },
        success: function(data) {
            let imgs = document.getElementsByTagName("img")
            for (let i = 0; i <  imgs.length; i++) {
                if(imgs[i].getAttribute("qId") == QID){
                    imgs[i].setAttribute("src","backend/"+data);
                }
            }

            //success.setAttribute('style', 'display: block');
            //error.setAttribute('style', 'display:none !important');
        },
        error: function() {
            alert(data);
            //success.setAttribute('style', 'display:none !important');
            //error.setAttribute('style', 'display: block');
        }
    });

}