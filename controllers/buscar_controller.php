<?php
class BuscarController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->cargarModelo("alumno");
        $this->vista->render("panel/buscar", $d = []);
    }
    
    public function alumnoSede()
    {
        if ($_GET && $sede = $this->getGET("sede")) {
            $alumno = new AlumnoModel();
            if ($d = $alumno->__getAlumnosBySede($sede)) {
                $this->vista->render("panel/buscar", $d);
            } else {
                $this->redirect("buscar", ["error" => ErrorMessages::ERROR_BUSCAR_ALUMNO_SEDE_NOEXISTE]);
            }

            //var_dump($d);
        } else {
            $this->redirect("buscar", ["error" => ErrorMessages::ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_SEDE]);
        }
    }
    public function alumnoCarrera()
    {
        if ($_GET && $carrera = $this->getGET("carrera")) {
            $alumno = new AlumnoModel();
            $d = $alumno->__getAlumnosByCarrera($carrera);
            #var_dump($d);
            if (count($d) > 0) {
                $this->vista->render("panel/buscar", $d);
            } else {
                $this->redirect("buscar", ["error" => ErrorMessages::ERROR_BUSCAR_ALUMNO_CARRERA_NOEXISTE]);
            }

            //var_dump($d);
        } else {
            $this->redirect("buscar", ["error" => ErrorMessages::ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_CARRERA]);
        }
    }
}