<?php 
class SuccessMessages
{
    const SUCCESS_REGISTRO_NUEVOUSUARIO = "876b27d666f14de2bce4FF73dd7478cd" ;
    const SUCCESS_REGISTRO_NUEVOALUMNO = "876b27dkjh698de2bce4FF73dd7478cd" ;
    const SUCCESS_REGISTROELIMINADO_ALUMNO = "5845kkdkjh698de2bce4FF73dd7478cd" ;
    const SUCCESS_REGISTROACTUALIZADO_ALUMNO = "5845kkdkjh698dBJN777FF73dd7478cd" ;
    const SUCCESS_CIERREDESESION_CORRECTAMENTE = "5845kkdkjh698dkjHY798K73dd7478cd" ;
    const SUCCESS_ALUMNO_ENCONTADO_RUT= "5845kkdkjh698dkjHY98KKK0dd7478cd" ;
    const SUCCESS_ACCESO_CONCEDIDO = "5845kkdkj09888KKL6Y8KKK0dd7478cd" ;
    const SUCCESS_ACTIVACION_USUARIO = "5845kk10215LLLKKL6Y8KKK0dd7478cd" ;
    const SUCCESS_DESACTIVACION_USUARIO = "5845kk10215LLLKKL6Y09OOOOd7478cd" ;

    private $successList = array();
    function __construct()
    {
        $this->successList = [
            SuccessMessages::SUCCESS_REGISTRO_NUEVOUSUARIO => "Nuevo usuario registrado correctamente.",
            SuccessMessages::SUCCESS_REGISTRO_NUEVOALUMNO => "Nuevo alumno registrado correctamente.",
            SuccessMessages::SUCCESS_REGISTROELIMINADO_ALUMNO => "Alumno eliminado correctamente.",
            SuccessMessages::SUCCESS_REGISTROACTUALIZADO_ALUMNO => "Alumno modificado correctamente.",
            SuccessMessages::SUCCESS_CIERREDESESION_CORRECTAMENTE => "Sesion finalizada correctamente.",
            SuccessMessages::SUCCESS_ALUMNO_ENCONTADO_RUT => "Alumno encontrado con exito, cargando informacion.",
            SuccessMessages::SUCCESS_ACCESO_CONCEDIDO => "Credenciales autorizadas. Bienvenido!",
            SuccessMessages::SUCCESS_ACTIVACION_USUARIO => "Usuario activado correctamente!",
            SuccessMessages::SUCCESS_DESACTIVACION_USUARIO => "Usuario desactivado correctamente!"

        ];
    }
    public function get($hash){
        return $this->successList[$hash];
    }

    public function existsKey($key){
        if(array_key_exists($key, $this->successList)){
            return true;
        }else{
            return false;
        }
    }
}
