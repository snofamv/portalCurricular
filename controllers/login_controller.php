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
        $this->vista->render("login/index", []);
        error_log("LOGIN::CONTROLLER -> VISTA CARGADA.");
    }

    public function autenticar()
    {
        $this->cargarModelo("login");
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
