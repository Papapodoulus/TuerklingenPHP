<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Control Login</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../javascript/controlLogin.js" type="text/javascript"></script>
</head>

<body>
    <?php
    require_once('../server/mysql.php');

    $conn = new ConnectionSQL;
    $username = "";
    $password = "";
    $result = "";
    $id = "";


    if (!isset($_GET['id']) && isset($_POST['uname']) && isset($_POST['password'])) {
        $username = $_POST['uname'];
        $password = $_POST['password'];

        $result = (int) $conn->istAdmin($username, $password);
    } else if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    if ($result == 0 && $id == "") {
        echo 'wer bist du?';
    } else {
    ?>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <h1>Guten Tag <?php echo $username ?></h1>
        <h2>Bearbeiten</h2>

        <button id="firmas" value="firmas" onclick="location.replace('/timbrePHP/client/controlLogin.php?id=firmas')">Firmas</button>
        <button id="raeume" value="raeume" onclick="location.replace('/timbrePHP/client/controlLogin.php?id=raeume')">Räume</button>
        <button id="tablets" value="tablets" onclick="location.replace('/timbrePHP/client/controlLogin.php?id=tablets')">Tablets</button>

        <?php
        if (!$id == "") {
            $array = $conn->showInfo($id);
            $newarray = array();
            foreach ($array as $item) {
                array_push($newarray, json_decode(json_encode($item), true));
            }

            if (count($newarray) > 0) { ?>
                <table style="border: 1px black solid">
                    <thead>
                        <tr id="trhead">
                            <th><?php echo implode('</th><th>', array_keys(current($newarray)));
                                echo "<th>Edit</th>"; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($newarray as $row) : array_map('htmlentities', $row); ?>
                            <tr>
                                <td><?php echo implode('</td><td>', $row) ?></td>
                                <?php echo "<td><button class='boton'>Edit</button></td>" ?>
                            </tr>
                    <?php
                        endforeach;
                    } ?>
                    </tbody>
                </table>


                <div id="info" style="display:none">
                    <?php


                    $tmp = getKeys($newarray);
                    foreach ($tmp as $key) {
                        echo $key;
                        echo "<input type='text' id='$key' required></input> <br>";
                    }

                    ?>
                    <button id="alter">ALTER</button>
                    <button id="delete">DELETE</button>
                </div>
        <?php
        }
    }
    function getKeys($array)
    {
        $resultArr = array();
        foreach ($array as $subArr) {
            $resultArr = array_merge($resultArr, $subArr);
        }
        return array_keys($resultArr);
    }

        ?>
</body>

</html>