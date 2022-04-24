window.addEventListener('load', () => {

    //create a new WebSocket object.
    var msgBox = $('#message-box');
    var wsUri = "ws://localhost:9000/timbrePHP/server/server.php";
    websocket = new WebSocket(wsUri);

    websocket.onopen = function (ev) { // connection is open 
        console.log('socket opened! :D') //notify user
    }

    websocket.onerror = function (ev) {
        msgBox.append('<div class="system_error">Error Occurred - ' + ev.data + '</div>');
    };
    websocket.onclose = function (ev) {
        msgBox.append('<div class="system_msg">Connection Closed</div>');
    };

    //Message send button
    $('button').click(function(ev){
        send_message(ev.target.value);
    });

    //Send message
    function send_message(firma) {
        var valueButton = firma //firma value
        //prepare json data
        var msg = {
            message: valueButton,
        };

        if (websocket.readyState === WebSocket.OPEN) {
            //convert and send data to server
            websocket.send(JSON.stringify(msg))
        } else {
            // Queue a retry
            setTimeout(() => {
                handleSend()
            }, 1000)
        }

    }

    function handleSend() {
        if (websocket.readyState === WebSocket.OPEN) {
            websocket.send()
        } else if (websocket.readyState == WebSocket.CONNECTING) {
            websocket.addEventListener('open', () => handleSend())
        }
    }

});