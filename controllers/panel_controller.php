<?php
class PanelController extends SessionController 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->vista->render("panel/index", []);
    }
    public function actualizar()
    {
        $this->vista->render("panel/actualizar", []);
    }
    public function buscar()
    {
        $this->vista->render("panel/buscar", []);
    }
    public function agregar()
    {
        $this->vista->render("panel/agregar", []);
    }
    public function lista()
    {
        $this->vista->render("panel/lista", []);
    }
    
    public function salir()
    {
        error_log("PanelController::Salir()->cerrando sesion.");
        parent::salir();
        $this->redirect("", ["success"=> SuccessMessages::SUCCESS_CIERREDESESION_CORRECTAMENTE]);
    }
}
