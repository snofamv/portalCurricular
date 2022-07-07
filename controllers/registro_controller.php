<?php
require_once "models/usuario_model.php";

class RegistroController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->vista->render("login/registro", []);
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
    function nuevoUsuario()
    {
        if ($this->existsPOST(["usuario", "contrasena"])) {
            $this->cargarModelo("usuario");

            $usuario = $this->validarCampo($this->getPOST("usuario"));
            $contrasena = $this->validarCampo($this->getPOST("contrasena"));
            //esto se debe validar aun mas desde elservidor y front con js
            if ($usuario == "" || empty($usuario) || $contrasena == "" || empty($contrasena)) {
                $this->redirect("registro", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_CAMPOS_VACIO]);
            } else if (strlen($usuario) < 4 || strlen($contrasena) < 4) {
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
