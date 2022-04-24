<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/index.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="./javascript/index.js" type="text/javascript"></script>
</head>

<body>

    <h2>Index</h2>

    <button onclick="document.getElementById('id01').style.display='block'">Login</button>
    <button id="klingen" onclick="window.location.href = './client/klingen.php';">Klingen</button>
    <button id="Firmas" onclick="window.location.href = './client/kunden.php';">Firmas</button>
    <div id="id01" class="modal">

        <form class="modal-content animate" action="./client/controlLogin.php" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

            </div>

            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" id="uname"required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="password" required>

                <button id="login">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember" id="remember"> Remember me
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>


    </div>
</body>

</html>