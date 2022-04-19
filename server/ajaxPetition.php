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
        $sort = $_POST['sort'];

        if ($sort == 'tablets') {
            $id = $_POST['id'];
            $tablet = $_POST['tablet'];
            $raum = $_POST['raum'];
            $json = $conn->deleteTablet($id, $tablet, $raum);
            print_r($json);
        } else if ($sort == 'raeume') {
            $id = $_POST['id'];
            $idFirma = $_POST['idFirma'];
            $raeume = $_POST['raeume'];
            $json = $conn->deleteRaum($id, $raeume, $idFirma);
            print_r($json);
        } else if ($sort == 'firmas') {
            $id = $_POST['id'];
            $firma = $_POST['firma'];
            $json = $conn->deleteFirma($id, $firma);
            print_r($json);
        } else {
            return false;
        }

        break;
    case 'alter':
        echo 'alter';
        break;
};
