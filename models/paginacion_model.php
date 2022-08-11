<?php
require_once "models/alumno_model.php";
class PaginacionModel extends Model
{
    private $pagina_inicial;
    private $resultadosPorPagina  = 100;
    private $empezar_desde;
    private $total_datos;
    private $totalPaginas;

    public function __construct()
    {
        parent::__construct();
    }

    public function calcularPaginasLista()
    {
        $query = $this->query("SELECT COUNT(*) AS total FROM data");
        $this->total_datos = $query->fetch(PDO::FETCH_OBJ)->total;
        $this->totalPaginas = ceil($this->total_datos / $this->resultadosPorPagina)+2;
    }
    public function getDatos($empezar_desde, $resultadosPorPagina)
    {
        $items = array();
        try {
            $query = parent::query("SELECT carreras.carrera, sedes.sede, data.pre_cod, data.codigo, data.nom, data.ape, data.rut FROM data JOIN carreras ON carreras.id = data.carrera JOIN sedes ON sedes.id = data.sede ORDER BY codigo DESC LIMIT ". $empezar_desde.",". $resultadosPorPagina);
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $objeto = new AlumnoModel();
                $objeto->setRut($p["rut"]);
                $objeto->setCodigo($p["codigo"]);
                $objeto->setPreCodigo($p["pre_cod"]);
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
    




    /**
     * Get the value of empezar_desde
     */
    public function getEmpezarDesde()
    {
        return $this->empezar_desde;
    }

    /**
     * Set the value of empezar_desde
     */
    public function setEmpezarDesde($empezar_desde): self
    {
        $this->empezar_desde = $empezar_desde;

        return $this;
    }

    /**
     * Get the value of resultadosPorPagina
     */
    public function getResultadosPorPagina()
    {
        return $this->resultadosPorPagina;
    }

    /**
     * Set the value of resultadosPorPagina
     */
    public function setResultadosPorPagina($resultadosPorPagina): self
    {
        $this->resultadosPorPagina = $resultadosPorPagina;

        return $this;
    }

    /**
     * Get the value of total_datos
     */
 

    /**
     * Get the value of totalPaginas
     */
    public function getTotalPaginas()
    {
        return $this->totalPaginas;
    }

    /**
     * Set the value of totalPaginas
     */
    public function setTotalPaginas($totalPaginas): self
    {
        $this->totalPaginas = $totalPaginas;

        return $this;
    }

    /**
     * Get the value of pagina_inicial
     */
    public function getPaginaInicial()
    {
        return $this->pagina_inicial;
    }

    /**
     * Set the value of pagina_inicial
     */
    public function setPaginaInicial($pagina_inicial): self
    {
        $this->pagina_inicial = $pagina_inicial;

        return $this;
    }
}
