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

    public function salir()
    {
        error_log("AdminController::Salir()");
        parent::salir();
        $this->redirect("", ["success"=> SuccessMessages::SUCCESS_CIERREDESESION_CORRECTAMENTE]);
    }
    public function config()
    {
        $this->vista->render("admin/configuracion", []);
    }
}
