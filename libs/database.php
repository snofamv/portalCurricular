<?php
class Database
{
    private $host;
    private $db;
    private $pass;
    private $user;
    private $charset;

    public function __construct()
    {
        $this->host = constant('HOSTDB');
        $this->db = constant('NAMEDB');
        $this->pass = constant('PASSDB');
        $this->user = constant('USERDB');
        $this->charset = constant('CHARSETDB');
    }


    public function conectar()
    {
        try {
            //code...
            $conexionPDO = "mysql:host={$this->host};dbname={$this->db}";
            $opciones = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false,];
            $pdo = new PDO($conexionPDO, $this->user, $this->pass, $opciones);
            error_log("Conexion a BD Exitosa.");
            return $pdo;
        } catch (PDOException $err) {
            //throw $th;
            error_log($err->getMessage());
        }
    }
}
