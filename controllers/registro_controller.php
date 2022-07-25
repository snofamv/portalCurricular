<?php
require_once "models/usuario_model.php";

class RegistroController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->vista->render("panel/registro", []);
    }
    private function validarCampoUsuario($dato)
    {
        if (!preg_match("/^[0-9]*$/", $dato)) {
            return NULL;
        }
        $dato = rtrim($dato);
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return strlen($dato) < 4 || strlen($dato) > 9 ? NULL : $dato;
    }
    private function validarCampoClave($dato)
    {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $dato)) {
            return NULL;
        }

        $dato = rtrim($dato);
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return strlen($dato) < 4 || strlen($dato) > 16 ? NULL : $dato;
    }
    function nuevoUsuario()
    {
        if ($this->existsPOST(["usuario", "contrasena"])) {
            $this->cargarModelo("usuario");

            $usuario = $this->validarCampoUsuario($this->getPOST("usuario"));
            $contrasena = $this->validarCampoClave($this->getPOST("contrasena"));
            //esto se debe validar aun mas desde elservidor y front con js
            if ($usuario == "" || empty($usuario) || $contrasena == "" || empty($contrasena)) {
                $this->redirect("registro", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_CAMPOS_VACIO]);
            } else if (strlen($usuario) < 4 || strlen($contrasena) > 9) {
                $this->redirect("registro", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_CAMPOS_MINIMOS]);
            } else {
                $objUsuario = new UsuarioModel();
                $objUsuario->setUsuario($usuario);
                $objUsuario->setContrasena($contrasena);
                $objUsuario->setRol("user");
                //esto funciona correctamente al registrar un usuario pero no retorna el mensaje
                if ($objUsuario->existeUsuario($usuario)) {
                    $this->redirect("registro", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_EXISTE]);
                } else if ($objUsuario->save()) {
                    $this->redirect("", ["success" => SuccessMessages::SUCCESS_REGISTRO_NUEVOUSUARIO]);
                } else {
                    $this->redirect("registro", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_ERROR]);
                }
            }
        } else {
            $this->redirect("registro", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO]);
        }
    }
}
