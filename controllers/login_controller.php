<?php
class LoginController extends SessionController
{

    function __construct()
    {
        error_log("LOGIN::CONTROLLER => CONTROLADOR INICIADO.");
        parent::__construct();
        $this->cargarModelo("login");

    }

    public function render()
    {
        error_log("LOGIN::CONTROLLER -> VISTA CARGADA.");
        $this->vista->render("login/index", []);
    }

    public function autenticar()
    {
        if ($this->existsPOST(["usuario", "contrasena"])) {
            $usuarioParam = $this->getPOST("usuario");
            $contrasenaParam = $this->getPOST("contrasena");
            $usuario = $this->modelo->login($usuarioParam, $contrasenaParam);
            if ($usuario != NULL) {
                $this->iniciar($usuario);
            } else {
                $this->redirect("", ["error" => ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO]);
            }
        }
    }

}
