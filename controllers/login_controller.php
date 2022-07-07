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
    }
    private function validarCampo($dato)
    {
        if (!preg_match("/^[0-9]*$/", $dato)) {
            return NULL;
        }
        $dato = rtrim($dato);
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }
    public function autenticar()
    {
        if ($this->existsPOST(["usuario", "contrasena"])) {
            $this->cargarModelo("login");
            $usuarioParam = $this->validarCampo($this->getPOST("usuario"));
            $contrasenaParam = $this->validarCampo($this->getPOST("contrasena"));
            $usuario = $this->modelo->login($usuarioParam, $contrasenaParam);
            if ($usuario != NULL) {
                $this->iniciar($usuario);
            } else {
                $this->redirect("", ["error" => ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO]);
            }
        }
    }
}
