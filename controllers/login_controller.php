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
    private function validarCampoUsuario($dato)
    {
        if (!preg_match("/^[0-9]*$/", $dato)) {
            return NULL;
        } else {
            if (strlen($dato) != 0 || strlen($dato) >= 4 || strlen($dato) <= 9) {
                $dato = rtrim($dato);
                $dato = trim($dato);
                $dato = stripslashes($dato);
                $dato = htmlspecialchars($dato);
                return $dato;
            } else {
                return NULL;
            }
        }
    }
    private function validarCampoClave($dato)
    {
        if (!preg_match("/^[A-Za-z-0-9]*$/", $dato)) {
            return NULL;
        } else {
            if (strlen($dato) != 0 || strlen($dato) > 4 || strlen($dato) < 16) {
                $dato = rtrim($dato);
                $dato = trim($dato);
                $dato = stripslashes($dato);
                $dato = htmlspecialchars($dato);
                return $dato;
            } else {
                return NULL;
            }
        }
    }
    public function autenticar()
    {
        if ($this->existsPOST(["usuario", "contrasena"])) {
            $this->cargarModelo("login");
            $usuarioParam = $this->validarCampoUsuario($this->getPOST("usuario"));
            $contrasenaParam = $this->validarCampoClave($this->getPOST("contrasena"));
            $usuario = $this->modelo->login($usuarioParam, $contrasenaParam);
            if ($usuario != NULL) {
                $this->iniciar($usuario);
            } else {
                $this->redirect("", ["error" => ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO]);
            }
        }
    }
}
