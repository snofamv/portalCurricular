<?php
class AgregarController extends Controller
{
    function __construct()
    {
        $this->cargarModelo("alumno");
        parent::__construct();
    }

    public function render()
    {

        $this->vista->render("panel/agregar", []);
    }

    public function nuevoAlumno(){
        if(!empty($this->getPOST("rut")) && !empty($this->getPOST("codigo")) && !empty($this->getPOST("nombres"))){
            $this->modelo->setCodigo($this->getPOST("codigo"));
            $this->modelo->setRut($this->getPOST("rut"));
            $this->modelo->setNombres($this->getPOST("nombres"));
            $this->modelo->setApellidos($this->getPOST("apellidos"));
            $this->modelo->setSede($this->getPOST("sedes"));
            $this->modelo->setCarrera($this->getPOST("carreras"));
            if($this->modelo->__guardarDato()){
                $this->redirect("agregar", ["success" => SuccessMessages::SUCCESS_REGISTRO_NUEVOALUMNO]);
            }else{
                $this->redirect("lista", ["error" => ErrorMessages::ERROR_REGISTRAR_NUEVOALUMNO]);
            }
        }
    }
}
