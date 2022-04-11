console.log('lo detecta un poco');
window.addEventListener('load', () => {
    var tablet = "";
    var firma = "";


    $('.boton').click(function selectTablet() {

        console.log('lo detecta');
        tablet = $(this).val();
        console.log(tablet);
        $.ajax({
            url: "../server/ajaxPetition.php",
            data: {
                type: "istMeinFirma",
                data: tablet
            },
            type: "post",
            success: function (json) {
                console.log(json);
                $('#firma').append(json);
                firma = json;
            },
            error: function (err) {
                console.log('Error: ' + err);
            }
        });

        $('#pannel').hide();
        $('#infoTablet').append('Sie sind verbunden wie das Tablet (' + tablet + ')');
        $('#infoTablet').show();
        console.log(tablet);
    });
    //create a new WebSocket object.
    var msgBox = $('#message-box');
    var wsUri = "ws://localhost:9000/timbrePHP/server/server.php";
    websocket = new WebSocket(wsUri);

    websocket.onopen = function (ev) { // connection is open 
        console.log('socket opened! :D') //notify user
    }
    // Message received from server
    websocket.onmessage = function (ev) {
        var response = JSON.parse(ev.data); //PHP sends Json data

        var res_type = response.type; //message type
        var user_message = response.message; //message text

        if (res_type == 'klingen') {
            ;
            console.log('000' + user_message);
            console.log('001' + firma);
            if (firma == user_message) {
                alert('Es klingelt! :D');
            }
        }

    };

    websocket.onerror = function (ev) {
        msgBox.append('<div class="system_error">Error Occurred - ' + ev.data + '</div>');
    };
    websocket.onclose = function (ev) {
        msgBox.append('<div class="system_msg">Connection Closed</div>');
    };
});