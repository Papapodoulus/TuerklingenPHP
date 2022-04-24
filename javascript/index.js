// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
window.addEventListener('load', () => {
    $("#login").click(function () {

        if ($('#uname').val() == "" || $('#password').val() == "") {
            console.log('rellena los campos');
        } else {
            var uname = $('#uname').val();
            var password = $('#password').val()
            var value;

            $.ajax({
                url: "./server/ajaxPetition.php",
                data: {
                    type: "istAdmin",
                    uname: uname,
                    password: password,
                },
                type: "post",
                async: false,
                success: function (json) {
                    value = json;
                },
                error: function (err) {
                    console.log('Error: ' + err);
                }
            });

            if (value == 1 && $("input:checked").length === 1) {
                setCookie('login', 'on', 30);
            } else if (value == 1) {
                setCookie('login', 'on', 0);
            } else {
                alert('gefälschter Benutzername oder Passwort');
            }
        }

    });
});

function setCookie(cname, cvalue, exdays) {
    if (exdays == 0) {
        document.cookie = cname + "=" + cvalue + ";";
    } else {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
}