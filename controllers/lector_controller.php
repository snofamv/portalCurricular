<?php
class LectorController extends SessionController
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

    public function render()
    {
        $this->vista->render("lector/index", []);
    }
    public function buscar()
    {
        $this->vista->render("lector/buscar", []);
        #$this->redirect("buscar", []);
    }
    private function calcularPaginas()
    {
        $query = $this->modelo->query("SELECT COUNT(*) AS total FROM data");
        $this->total_datos = $query->fetch(PDO::FETCH_OBJ)->total;
        $this->totalPaginas = ceil($this->total_datos / $this->resultadosPorPagina) + 2;
    }
    public function lista()
    {
        $this->cargarModelo("paginacion");
        $this->pagina_inicial = $_GET["pagina"] ?: 1;
        $this->empezar_desde = ($this->pagina_inicial - 1) * $this->resultadosPorPagina;
        $this->calcularPaginas();
        $d["datos"] = $this->modelo->getDatos($this->empezar_desde, $this->resultadosPorPagina);
        $d["nroDatos"] = $this->totalPaginas;
        $this->vista->render("lector/lista", $d);
    }
    public function salir()
    {
        parent::salir();
        $this->redirect("", ["success" => SuccessMessages::SUCCESS_CIERREDESESION_CORRECTAMENTE]);
    }
}
