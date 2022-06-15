<?php
class Buscar extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->cargarModelo("alumno");
    }

    public function render()
    {
        $this->vista->render("panel/buscar", $d = []);
    }

    public function alumnoRut()
    {
        #fix this, mas eficiente, menoscodigo ensalada
        if ($_GET && $rut = $this->getGET("rut")) {
            $alumno = new Alumno();
            $alumno->__getDatoById($rut);
            $d = $alumno->__getDatosToArray();
            if ($d["codigo"] != NULL) {
                $this->vista->render("panel/buscar", $d);
            } else {
                $this->redirect("buscar", ["error" => ErrorMessages::ERROR_BUSCAR_ALUMNO_NOENCONTRADO_RUT]);
            }
        } else {
            $this->redirect("buscar", ["error" => ErrorMessages::ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_RUT]);
        }
    }
    public function alumnoSede()
    {
        if ($_GET && $sede = $this->getGET("sede")) {
            $alumno = new Alumno();
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
            $alumno = new Alumno();
            if ($d = $alumno->__getAlumnosByCarrera($carrera)) {
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
