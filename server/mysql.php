<?php

require_once '../.data.php';

class ConnectionSQL
{
    protected $pdo;

    public function __construct()
    {
        $data = new Data;
        $username = $data->dataPDO['USER_NAME_SQL'];
        $password = $data->dataPDO['PASSWORD'];
        $this->pdo = new PDO('mysql:host=localhost;dbname=timbrephp', $username, $password);
    }

    public function getFirmas()
    {
        $sql = 'SELECT * 
        from firmas';
        foreach ($this->pdo->query($sql) as $row) {

            echo '<button type="button" id="' . $row['Firma'] . '" value="' . $row['Firma'] . '">' . $row['Firma'] . '</button>';
        }
    }

    public function getTablets()
    {
        $sql = 'SELECT * 
        from tablets';
        foreach ($this->pdo->query($sql) as $row) {

            echo '<button type="button" class="boton" id="' . $row['Tablet'] . '" value="' . $row['Tablet'] . '">' . $row['Tablet'] . '</button>';
        }
    }

    public function istMeinFirma($raum)
    {
        $sql = "SELECT firmas.Firma 
        from `firmas` 
        join raeume on raeume.ID_firma = firmas.ID
        join tablets on tablets.Raum = raeume.ID
        where tablets.Tablet='$raum';";
        foreach ($this->pdo->query($sql) as $row) {
            echo $row['Firma'];
        }
    }

    public function istAdmin($uname, $password)
    {
        $sql = "SELECT EXISTS (
        SELECT * 
        from admin 
        where username='$uname' and password='$password');";

        foreach ($this->pdo->query($sql) as $row) {
            return $row[0];
        }
    }

    public function showInfo($info)
    {
        $gsent = $this->pdo->prepare("SELECT * FROM $info");
        $gsent->execute();

        $resultado = $gsent->fetchAll(PDO::FETCH_CLASS);
        return $resultado;
    }

    public function deleteTablet($id, $tablet, $raum)
    {
        $sql = "DELETE FROM tablets WHERE Id=$id AND Tablet='$tablet' AND Raum=$raum;";
        $statament = $this->pdo->prepare($sql);

        $statament->execute();

        $del = $statament->rowCount();

        if ($del == 0) {
            return 'false';
        } else {
            return 'true';
        }
    }
    public function deleteRaum($id, $raeume, $idFirma)
    {

        if ($this->changeFKTablet($id)) {
            $sql = "DELETE FROM raeume WHERE ID=$id AND Name='$raeume' AND Id_firma=$idFirma;";
            $statament = $this->pdo->prepare($sql);

            $statament->execute();

            $del = $statament->rowCount();

            if ($del == 0) {
                return 'false';
            } else {
                return 'true';
            }
        } else {
            echo 'FATAL ERROR';
        }
    }
    public function deleteFirma($id, $firma)
    {
        if ($this->changeFKRaum($id)) {
            $sql = "DELETE FROM firmas WHERE ID=$id AND Firma='$firma';";
            $statament = $this->pdo->prepare($sql);

            $statament->execute();

            $del = $statament->rowCount();

            if ($del == 0) {
                return 'false';
            } else {
                return 'true';
            }
        } else {
            echo 'FATAL ERROR';
        }
    }

    private function changeFKTablet($idRaume)
    {
        try {
            $sql = "UPDATE tablets SET Raum = NULL WHERE Raum = $idRaume;";
            $statament = $this->pdo->prepare($sql);
            $statament->execute();
            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }
    private function changeFKRaum($idFirma)
    {
        try {
            $sql = "UPDATE raeume SET Id_firma = NULL WHERE Id_firma = $idFirma;";
            $statament = $this->pdo->prepare($sql);
            $statament->execute();
            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }

}
