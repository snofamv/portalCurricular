<?php
class AdminController extends SessionController
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
        $this->vista->render("admin/index", []);
    }
    public function agregar()
    {
        $this->vista->render("admin/agregar", []);
    }
    public function registro()
    {
        $this->vista->render("admin/registro", []);
    }
    public function buscar()
    {
        $this->vista->render("admin/buscar", []);
    }
    public function googledrive()
    {

        $this->vista->render("admin/gdrive/googledrive", []);
    }
    public function opciones()
    {
        $this->vista->render("admin/opciones", []);
    }
    private function calcularPaginas()
    {
        $query = $this->modelo->query("SELECT COUNT(*) AS total FROM data");
        $this->total_datos = $query->fetch(PDO::FETCH_OBJ)->total;
        $this->totalPaginas = ceil($this->total_datos / $this->resultadosPorPagina)+2;
    }
    public function lista()
    {
        $this->cargarModelo("paginacion");
        $this->pagina_inicial = $_GET["pagina"] ?: 1;
        $this->empezar_desde = ($this->pagina_inicial - 1) * $this->resultadosPorPagina;
        $this->calcularPaginas();
        $d["datos"] = $this->modelo->getDatos($this->empezar_desde, $this->resultadosPorPagina);
        $d["nroDatos"] = $this->totalPaginas;
        $this->vista->render("admin/lista", $d);
    }
    public function pdf()
    {
        $this->cargarModelo("paginacion");
        $this->pagina_inicial = $_GET["pagina"] ?: 1;
        $this->empezar_desde = ($this->pagina_inicial - 1) * $this->resultadosPorPagina;
        $this->calcularPaginas();
        $d["datos"] = $this->modelo->getDatos($this->empezar_desde, $this->resultadosPorPagina);
        $d["nroDatos"] = $this->totalPaginas;
        $this->vista->render("admin/pdf", $d);
    }
    public function activarUsuario()
    {
        $this->cargarModelo("usuario");
        $d["usuarios"] = $this->modelo->getAll();
        $this->vista->render("admin/activarUsuario", $d);
    }
    public function activar()
    {
        if ($this->existsGET(["estado", "usuario"])) {
            $this->cargarModelo("usuario");
            $this->modelo->get($this->getGET("usuario"));
            if ($this->modelo->activarUsuario()) {
                $this->redirect("panelAdmin", ["success" => SuccessMessages::SUCCESS_ACTIVACION_USUARIO]);
            } else {
                $this->redirect("panelAdmin", ["error" => ErrorMessages::ERROR_DESACTIVACION_USUARIO]);
            }
        }
    }
    public function desactivar()
    {
        if ($this->existsGET(["estado", "usuario"])) {
            $this->cargarModelo("usuario");
            $this->modelo->get($this->getGET("usuario"));
            if ($this->modelo->desactivarUsuario()) {
                $this->redirect("panelAdmin", ["success" => SuccessMessages::SUCCESS_DESACTIVACION_USUARIO]);
            } else {
                $this->redirect("panelAdmin", ["error" => ErrorMessages::ERROR_DESACTIVACION_USUARIO]);
            }
        }
    }
    public function rol()
    {
        if ($this->existsGET(["usuario", "rol"])) {
            $rol = $this->getGET("rol");
            $this->cargarModelo("usuario");
            $this->modelo->get($this->getGET("usuario"));
            if ($this->modelo->cambiarRol($rol)) {
                $this->redirect("panelAdmin", ["success" => SuccessMessages::SUCCESS_CAMBIO_ROL]);
            } else {
                $this->redirect("panelAdmin", ["error" => ErrorMessages::ERROR_CAMBIO_USUARIO_ROL]);
            }
        }
    }

    public function salir()
    {
        error_log("AdminController::Salir()");
        parent::salir();
        $this->redirect("", ["success" => SuccessMessages::SUCCESS_CIERREDESESION_CORRECTAMENTE]);
    }
}
