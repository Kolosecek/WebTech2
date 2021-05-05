<!DOCTYPE html>
<html>
<body>
<div id="mathfield" >x=\frac{-b\pm \sqrt{b^2-4ac}}{2a}
</div>
<button onclick="test()">Testing</button>
<script src='https://unpkg.com/mathlive/dist/mathlive.min.js'>

</script>
<script>
    var element = MathLive.makeMathField(document.getElementById('mathfield'),  {
        virtualKeyboardMode: "manual",
        virtualKeyboards: 'numeric symbols',
        smartMode: true
    });
    function test(){
        console.log(element.getValue("latex"));
    }
</script>
</body>
</html>