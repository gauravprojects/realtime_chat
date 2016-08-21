var chat= document.getElementById("chat_window");
var msg= document.getElementById("messagebox");


var socket= new WebSocket("ws://localhost:8000");

var open= false;

function addMessage(msg) {
    chat.innerHTML += "<p>" + msg + "</p>";

}

if(msg)
{
    msg.addEventListener("keydown",function(event) {

        var key = event.which || event.keyCode;
        if(key != 13 || !open )
        {
            return;
        }

        event.preventDefault();
        socket.send(JSON.stringify({
            msg: msg.value
        }));

        addMessage(msg.value);
        msg.value="";

    });

}

socket.onopen = function () {
    open = true;
    addMessage("Connected");
}

socket.onmessage= function (event) {
    var data= JSON.parse(event.data);
    addMessage(data.msg);

}

socket.onclose = function () {
    open= false;
    addMessage("Disconnected");
}
