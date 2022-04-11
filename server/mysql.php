<?php

class ConnectionSQL
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=timbrephp', 'timbrephp', 'timbrephp');
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
}
