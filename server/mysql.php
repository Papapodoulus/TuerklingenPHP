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
        $sql = 'SELECT * from firmas';
        foreach ($this->pdo->query($sql) as $row) {
            echo '<button type="button" id="' . $row['Firma'] . '" value="' . $row['Firma'] . '">' . $row['Firma'] . '</button>';
        }
    }

    public function getTablets()
    {
        $sql = 'SELECT * from tablets';
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
            echo $row[0];
        }
    }

    public function showInfo($info)
    {
        $gsent = $this->pdo->prepare("SELECT * FROM $info");
        $gsent->execute();

        $resultado = $gsent->fetchAll(PDO::FETCH_CLASS);
        return $resultado;
    }

    public function deteleRow($id, $sort)
    {
        $sql = "";

        switch ($sort) {
            case 'tablets':
                $sql = "DELETE FROM tablets WHERE Id=$id;";
                break;
            case 'raeume':
                if ($this->changeFKTablet($id)) {
                    $sql = "DELETE FROM raeume WHERE ID=$id;";
                } else {
                    echo "FATAL ERROR";
                }
                break;
            case 'firmas':
                if ($this->changeFKRaum($id)) {
                    $sql = "DELETE FROM firmas WHERE ID=$id;";
                } else {
                    echo 'FATAL ERROR';
                }
                break;
        }

        $statament = $this->pdo->prepare($sql);

        $statament->execute();

        $del = $statament->rowCount();

        if ($del == 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function updateFirmas($id, $firma)
    {
        $sql = "UPDATE firmas SET Firma='$firma' WHERE Id=$id;";
        $statament = $this->pdo->prepare($sql);

        $statament->execute();

        $del = $statament->rowCount();

        if ($del == 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function updateRaeume($id, $name, $idFirma){
        $sql = "UPDATE raeume SET Name='$name', Id_firma=$idFirma WHERE Id=$id;";
        $statament = $this->pdo->prepare($sql);

        $statament->execute();

        $del = $statament->rowCount();

        if ($del == 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function updateTablet($id, $tablet, $raum)
    {
        $sql = "UPDATE tablets SET Tablet='$tablet', Raum=$raum WHERE Id=$id;";
        $statament = $this->pdo->prepare($sql);

        $statament->execute();

        $del = $statament->rowCount();

        if ($del == 0) {
            return 'false';
        } else {
            return 'true';
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
