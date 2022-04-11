<?php
require_once("mysql.php");
$conn = new ConnectionSQL;


switch ($_POST['type']) {
    case 'istMeinFirma':
        $raum = $_POST['data'];
        $json = $conn->istMeinFirma($raum);
        echo $json;
        break;
    case 'delete':
        echo 'delete';
        break;
    case 'alter':
        echo 'alter';
        break;
};
