<?php 
class ErrorMessages
{
    //ERROR_CONTROLLER_METHOD_ACTION
    const ERROR_CONTROLADOR_NOENCONTRADO = "672b82d5bce44f26dd7768bjdh2478DC" ;
    const ERROR_REGISTRO_NUEVOUSUARIO = "672b82d511f14de2bce44f26dd7478cd" ;
    const ERROR_REGISTRO_NUEVOUSUARIO_CAMPOS_VACIO = "672b82d511f14de2bbc69f26dd7478cd" ;
    const ERROR_REGISTRO_NUEVOUSUARIO_CAMPOS_MINIMOS = "999b82d316f14de2bbc69f26dd7478cd" ;
    const ERROR_REGISTRO_NUEVOUSUARIO_EXISTE = "672b82d511f14de2vvc96f26ff702000" ;
    const ERROR_REGISTRO_NUEVOUSUARIO_ERROR = "672b82d511f14de2vvc96f26QQ7067672" ;
    const ERROR_AUTENTICACION_CAMPOS_VACIOS = "672b82d511f14de2BBC99f26QQ7067672" ;
    const ERROR_AUTENTICACION_LOGIN = "672b82d511f14de2BBC99f26QQKT76272" ;
    const ERROR_AUTENTICACION_LOGIN_INVALIDO = "672b82d511f14de2BBC99f26QQKT76272" ;
    const ERROR_ELIMINARALUMNO_ERROR = "986b82d511f14de2BBC99f26QQKT71576" ;
    const ERROR_REGISTRAR_NUEVOALUMNO = "986b82d511f14de2KKJ69f26QQKT71576" ;
    const ERROR_REGISTRAR_YA_EXISTE_ALUMNO = "986b82d511f14de2KKJ69f26QKK87LO089" ;
    const ERROR_ACTUALIZAR_ALUMNO = "986b82d511f14de2KKJKJI88YQKT71576" ;
    const ERROR_RUTA_NOENCONTRADA = "886b82d511f14de2LKPPI88YQKT71576" ;
    const ERROR_MODULO_DESHABILITADO = "886b82d511f14de2876JJK8YQKT71576" ;
    const ERROR_BUSCAR_ALUMNO_NOENCONTRADO_RUT = "886b82d511f14de2987JJK8YQKT71576" ;
    const ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_RUT = "886b82d511f1487KKy76LK8YQKT71576" ;
    const ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_SEDE = "886b82d511f1487KKy76LK8YLLL01576" ;
    const ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_CARRERA = "886987K511f1487KKy76LK8YLLL01576" ;
    const ERROR_BUSCAR_ALUMNO_SEDE_NOEXISTE = "886987K511172KKKKy76LK8YLLL01576" ;
    const ERROR_BUSCAR_ALUMNO_CARRERA_NOEXISTE = "886987K511172KKKLO00087p0LLL01576" ;
    private $errorList = array();

    function __construct()
    {
        $this->errorList = [
            ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO => "Hubo un error al registrarse, intenta nuevamente.",
            ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_CAMPOS_VACIO => "Llena los campos de usuario y/o contraseña.",
            ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_EXISTE => "Ya existe el nombre de usuario, elige otro.",
            ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_ERROR => "Hubo un error al registrar el nuevo usuario, intenta nuevamente.",
            ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_CAMPOS_MINIMOS => "Ingresa un rut valido y una contraseña mas larga.",
            ErrorMessages::ERROR_AUTENTICACION_CAMPOS_VACIOS => "Los campos rut y/o contraseña se encuentran vacios.",
            ErrorMessages::ERROR_AUTENTICACION_LOGIN => "No se puede procesar la solicitud, intenta nuevamente.",
            ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO => "Rut y/o contraseña invalidos. Intenta nuevamente.",
            ErrorMessages::ERROR_CONTROLADOR_NOENCONTRADO => "No se puede procesar la solicitud. Pagina no encontrada. >404<.",
            ErrorMessages::ERROR_ELIMINARALUMNO_ERROR => "No se puede procesar la solicitud. Alumno no eliminado.",
            ErrorMessages::ERROR_REGISTRAR_NUEVOALUMNO => "Error al ingresar un nuevo alumno.",
            ErrorMessages::ERROR_ACTUALIZAR_ALUMNO=> "No se puede actualizar informacion la informacion del alumno.",
            ErrorMessages::ERROR_RUTA_NOENCONTRADA=> "No se puede procesar la solicitud. Ruta o pagina no encontrada.",
            ErrorMessages::ERROR_MODULO_DESHABILITADO=> "Este modulo se encuentra temporalmente deshabilitado.",
            ErrorMessages::ERROR_BUSCAR_ALUMNO_NOENCONTRADO_RUT => "No se puede encontrar el rut ingresado o no existe.",
            ErrorMessages::ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_RUT => "No se encontraron datos en el campo RUT.",
            ErrorMessages::ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_SEDE => "No se encontraron datos en el campo SEDE.",
            ErrorMessages::ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_CARRERA => "No se encontraron datos en el campo CARRERA.",
            ErrorMessages::ERROR_BUSCAR_ALUMNO_SEDE_NOEXISTE => "No se pueden encontrar datos en la sede ingresada o no existe.",
            ErrorMessages::ERROR_BUSCAR_ALUMNO_CARRERA_NOEXISTE => "No se pueden encontrar datos en la carrera ingresada o no existe.",
            ErrorMessages::ERROR_REGISTRAR_YA_EXISTE_ALUMNO => "El alumno ya existe en nuestros registros.",
        ];
    }

    public function get($hash){
        return $this->errorList[$hash];
    }

    public function existsKey($key){
        if(array_key_exists($key, $this->errorList)){
            return true;
        }else{
            return false;
        }
    }
}

?>