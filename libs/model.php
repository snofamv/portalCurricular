<?php
//el modelo es una base que extiende a cada moledo
//este contiene la conexion a la base de datos en un objeto
//contiene las configuraciones para PDO y queryes heredadas para cada moledo.
include_once "libs/imodel.php";
class Model
{

    function __construct()
    {

        $this->db = new Database();
    }

    function query($query)
    {
        return $this->db->conectar()->query($query);
        $this->db->conectar->closeCursor();
    }

    function prepare($query)
    {
        return $this->db->conectar()->prepare($query);
    }
}

?>
