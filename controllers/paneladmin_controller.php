<?php
class PanelAdminController extends SessionController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->vista->render("panel-admin/index", []);
    }
    public function registro()
    {
        $this->redirect("registro", []);
    }
    public function opciones()
    {
        $this->vista->render("panel-admin/opciones", []);
    }
    public function activarUsuario()
    {
        $this->cargarModelo("usuario");
        $d["usuarios"] = $this->modelo->getAll();
        $this->vista->render("panel-admin/activarUsuario", $d);
    }
    public function activar()
    {
        if ($this->existsGET(["estado", "usuario"])) {
            $this->cargarModelo("usuario");
            $this->modelo->get($this->getGET("usuario"));
            if ($this->modelo->activarUsuario()) {
                $this->redirect("panel-admin", ["success" => SuccessMessages::SUCCESS_ACTIVACION_USUARIO]);
            } else {
                $this->redirect("panel-admin", ["error" => ErrorMessages::ERROR_DESACTIVACION_USUARIO]);
            }
        }
    }
    public function desactivar()
    {
        if ($this->existsGET(["estado", "usuario"])) {
            $this->cargarModelo("usuario");
            $this->modelo->get($this->getGET("usuario"));
            if ($this->modelo->desactivarUsuario()) {
                $this->redirect("panel-admin", ["success" => SuccessMessages::SUCCESS_DESACTIVACION_USUARIO]);
            } else {
                $this->redirect("panel-admin", ["error" => ErrorMessages::ERROR_DESACTIVACION_USUARIO]);
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
