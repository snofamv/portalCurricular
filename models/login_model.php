<?php
class LoginModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function login($usuario, $clave)
    {
        try {
            $query = $this->prepare("select * from usuarios where usuario=:usuario and estado=:estado");
            $query->execute([":usuario" => $usuario, ":estado"=>1]);

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
           error_log("LoginModelo:: Error -> ". $th->getMessage());
        }
    }
}
