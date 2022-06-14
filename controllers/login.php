<?php
class Login extends Controller
{

    function __construct()
    {
        parent::__construct();
        error_log("LOGIN::CONTROLLER => CONTROLADOR INICIADO.");
    }

    public function render()
    {
        //render puede incluir como segundo parametro un array de datos
        error_log("LOGIN::CONTROLLER -> VISTA CARGADA.");
        $this->vista->render("login/index", []);
    }
}
