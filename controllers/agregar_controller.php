<?php
class AgregarController extends SessionController
{
    function __construct()
    {
        parent::__construct();
        $this->cargarModelo("alumno");
    }

    public function render()
    {

        $this->vista->render("panel/agregar", []);
    }


    public function nuevoAlumno()
    {
        if (!empty($this->getPOST("rut")) && !empty($this->getPOST("codigo")) && !empty($this->getPOST("nombres") && !empty($this->getPOST("apellidos") && !empty($this->getPOST("sedes") && !empty($this->getPOST("carreras")))))) {
            $this->modelo->setCodigo($this->getPOST("codigo"));
            $this->modelo->setRut($this->getPOST("rut"));
            $this->modelo->setNombres($this->getPOST("nombres"));
            $this->modelo->setApellidos($this->getPOST("apellidos"));
            $this->modelo->setSede($this->getPOST("sedes"));
            $this->modelo->setCarrera($this->getPOST("carreras"));
            if ($this->modelo->existeAlumno($this->getPOST("rut")) == false) {
                if ($this->modelo->save()) {
                    $this->redirect("agregar", ["success" => SuccessMessages::SUCCESS_REGISTRO_NUEVOALUMNO]);
                } else {
                    $this->redirect("agregar", ["error" => ErrorMessages::ERROR_REGISTRAR_NUEVOALUMNO]);
                }
            } else {
                $this->redirect("agregar", ["error" => ErrorMessages::ERROR_REGISTRAR_YA_EXISTE_ALUMNO]);
            }
        }
    }
}
