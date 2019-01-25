document.addEventListener("DOMContentLoaded", function(){
    document.getElementById('file-upload').addEventListener("submit", function(e){
        e.preventDefault();
        var form = e.target;
        var data = new FormData(form);

        var request = new XMLHttpRequest();

        request.onreadystatechange = function(){
            document.getElementById("result").innerText = request.response.error
        };

        request.open(form.method, form.action);
        request.send(data);
    })
});