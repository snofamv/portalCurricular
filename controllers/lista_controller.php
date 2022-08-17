<?php
class ListaController extends SessionController
{

    function __construct()
    {
        parent::__construct();
    }
    function render()
    {
        $this->cargarModelo("paginacion");
        $this->modelo->setPaginaInicial(isset($_GET["pagina"]) ? $_GET["pagina"] : 1);
        $this->modelo->setEmpezarDesde(($this->modelo->getPaginaInicial() - 1) * $this->modelo->getResultadosPorPagina());
        $this->modelo->calcularPaginasLista();
        $d["datos"] = $this->modelo->getDatos($this->modelo->getEmpezarDesde(), $this->modelo->getResultadosPorPagina());
        $d["nroDatos"] = $this->modelo->getTotalPaginas();
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
