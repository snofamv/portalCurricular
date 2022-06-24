<?php
class LoginModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function login($usuario, $clave)
    {
        error_log("LoginModel::Login -> 1.");
        try {
            $query = $this->prepare("select * from usuarios where usuario=:usuario");
            $query->execute([":usuario" => $usuario]);

            if($query->rowCount() == 1){
                $item = $query->fetch(PDO::FETCH_ASSOC);
                $usuario = new UsuarioModel();
                $usuario->from($item);

                if(password_verify($clave, $usuario->getContrasena())){
                    error_log("LoginModel::Login -> credenciales validadas.");
                    return $usuario;
                }else{
                    error_log("LoginModel::Login -> Password incorrecto.");
                    return NULL;
                }
            }
        } catch (PDOException $th) {
           error_log("LoginModelo:: Login-> ". $th->getMessage());
        }
    }
}
