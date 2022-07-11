<?php
require_once "controllers/lista_interface.php";
class ListaController extends SessionController implements ListaInterface
{
    private $pagina_inicial;
    private $resultadosPorPagina  = 100;
    private $empezar_desde;
    private $total_datos;
    private $totalPaginas;
    function __construct()
    {
        parent::__construct();
        
    }
    
    
    private function calcularPaginas()
    {
        $query = $this->modelo->query("SELECT COUNT(*) AS total FROM data");
        $this->total_datos = $query->fetch(PDO::FETCH_OBJ)->total;
        $this->totalPaginas = ceil($this->total_datos / $this->resultadosPorPagina)+1;
    }
    function render()
    {
        $this->cargarModelo("paginacion");
        $this->pagina_inicial = $_GET["pagina"] ?: 1;
        $this->empezar_desde = ($this->pagina_inicial - 1) * $this->resultadosPorPagina;
        $this->calcularPaginas();
        $d["datos"] = $this->modelo->getDatos($this->empezar_desde, $this->resultadosPorPagina);
        $d["nroDatos"] = $this->totalPaginas;
        $this->vista->render("panel/lista", $d);
    }

    public function modificarAlumno()
    {
        if ($this->existsPOST(['btnModificar'])) {
            $this->redirect("actualizar", ["rut" => !empty($this->getPOST("rut")) ? $this->getPOST("rut") : []]);
        }
    }
    public function eliminarAlumno()
    {
        if ($this->existsPOST(['btnEliminar'])) {
            $this->redirect("eliminar", ["rut" => !empty($this->getPOST("rut")) ? $this->getPOST("rut") : []]);
        }
    }
}
