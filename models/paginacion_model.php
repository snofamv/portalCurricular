<?php
require_once "models/alumno_model.php";
class PaginacionModel extends Model
{


    public function __construct()
    {
        parent::__construct();

    }
    public function getDatos($empezar_desde, $resultadosPorPagina)
    {
        $items = array();
        try {
            $query = parent::query("SELECT * FROM data ORDER BY codigo DESC LIMIT ". $empezar_desde.",". $resultadosPorPagina);
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $objeto = new AlumnoModel();
                $objeto->setRut($p["rut"]);
                $objeto->setCodigo($p["codigo"]);
                $objeto->setNombres($p["nom"]);
                $objeto->setApellidos($p["ape"]);
                $objeto->setSede($p["sede"]);
                $objeto->setCarrera($p["carrera"]);
                array_push($items, $objeto);
            }
            return $items;
        } catch (PDOException $th) {
            error_log("ALUMNO::MODELO => METODO_GETPAGINACION::PDOException => " . $th->getMessage());
        }
    }
    



}
