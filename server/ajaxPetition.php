<?php
require_once("mysql.php");
$conn = new ConnectionSQL;


switch ($_POST['type']) {
    case 'istMeinFirma':
        $json = $conn->istMeinFirma($_POST['data']);
        echo $json;
        break;
    case 'istAdmin':
        $json = $conn->istAdmin($_POST['uname'], $_POST['password']);
        echo $json;
        break;
    case 'delete':
        $conn->deteleRow($_POST['id'], $_POST['sort']);
        break;
    case 'update':
        $sort = $_POST['sort'];

        switch ($sort) {
            case 'tablets':
                $conn->updateTablet($_POST['id'], $_POST['tablet'], $_POST['raum']);
                break;
            case 'raeume':
                $conn->updateRaeume($_POST['id'], $_POST['raeume'], $_POST['idFirma']);
                break;
            case 'firmas':
                $conn->updateFirmas($_POST['id'], $_POST['firma']);
                break;
        }

        break;
};
