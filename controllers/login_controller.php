<?php
class LoginController extends SessionController
{

    function __construct()
    {
        error_log("LOGIN::CONTROLLER => CONTROLADOR INICIADO.");
        parent::__construct();
    }

    public function render()
    {
        error_log("LOGIN::CONTROLLER -> VISTA CARGADA.");
        $this->cargarModelo("login");
        $this->vista->render("login/index", []);
    }

    public function autenticar()
    {
        $this->cargarModelo("login");
        if ($this->existsPOST(["usuario", "contrasena"])) {
            $usuario = $this->getPOST("usuario");
            $contrasena = $this->getPOST("contrasena");

            $obj = $this->modelo->login($usuario, $contrasena);

            if ($obj != NULL) {
                $this->initialize($obj);
            } else {
                $this->redirect("", ["error" => ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO]);
            }
        }
    }

}
