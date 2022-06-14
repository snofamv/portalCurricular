<?php
class Login extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function login($rut, $clave)
    {
        try {
            $query = $this->prepare("select * from usuarios where rut=:rut");
            $query->execute([":rut" => $rut]);

            if($query->rowCount() > 0){
                $item = $query->fetch(PDO::FETCH_ASSOC);
                $usuario = new Usuario();
                $usuario->__setDatosDesdeArray($item);

                if(password_verify($clave, $usuario->getClave())){
                    error_log("LoginModel::Login -> credenciales validadas  .");
                    return $usuario;
                }else{
                    error_log("LoginModel::Login -> Password incorrecto.");
                    return NULL;
                }
            }
        } catch (PDOException $th) {
           error_log("LoginModelo:: Login-> ". $th->getMessage());
           return NULL;
        }
    }
}
