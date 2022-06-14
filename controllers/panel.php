<?php
class Panel extends Controller 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->vista->render("panel/index", []);
    }

    public function salir()
    {
        error_log("PanelController::Salir()->cerrando sesion.");
        session_unset();
        session_destroy();
        $_SESSION["usuario_id"] = null;
        $_SESSION["usuario_rol"] = null;
        $_SESSION = null;
        header("Location: /login", 301);
        exit();
    }
}
