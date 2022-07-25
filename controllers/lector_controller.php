<?php
class LectorController extends SessionController
{
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
    }
    public function lista()
    {
        $this->vista->render("lector/lista", []);
    }
    
    public function salir()
    {
        parent::salir();
        $this->redirect("", ["success" => SuccessMessages::SUCCESS_CIERREDESESION_CORRECTAMENTE]);
    }
}
