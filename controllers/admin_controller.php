<?php
class AdminController extends SessionController
{
   
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->vista->render("admin/index", []);
    }
      
    public function googledrive()
    {

        $this->vista->render("admin/gdrive/googledrive", []);
    }
    public function opciones()
    {
        $this->vista->render("admin/opciones", []);
    }
    
    public function pdf()
    {
        $this->vista->render("admin/pdf", []);
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
