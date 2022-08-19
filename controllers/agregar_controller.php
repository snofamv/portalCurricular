<?php
require_once "classes/storage.php";
class AgregarController extends SessionController
{
    private $storage;
    function __construct()
    {
        $this->storage = new storage();
        parent::__construct();
    }

    public function render()
    {
        $this->cargarModelo("alumno");
        $d["carreras"] = $this->modelo->getCarreras();
        $d["sedes"] = $this->modelo->getSedes();
        $this->vista->render("panel/agregar", $d);
    }

    public function subirPDF()
    {
        if ($this->existsPOST(["nroFolioDoc", "nroCajaDoc"])) {

            foreach ($_FILES["archivos"]["tmp_name"] as $key => $tmp_name) {
                if ($_FILES["archivos"]["name"][$key]) {
                    $filename = $this->getPOST("nroCajaDoc") . "/" . $this->getPOST("nroFolioDoc") . "/" . $_FILES["archivos"]["name"][$key];
                    $temporal = $_FILES["archivos"]["tmp_name"][$key];
                    $this->storage->subirArchivo($filename, $temporal);
                }
            }

            $this->redirect("agregar", ["success"=>SuccessMessages::SUCCESS_STORAGE_SUBIR_DOCUMENTOS]);
            
        } else {
            $this->redirect("agregar", ["error"=>ErrorMessages::ERROR_STORAGE_SUBIR_DOCUMENTO]);
        }
    }
    public function nuevoAlumno()
    {

        $this->cargarModelo("alumno");

        if ($this->existsPOST(['codigo', 'rut', 'nombres', 'apellidos', 'sedes', 'carreras'])) {
            $codigos = explode("-", $this->getPOST("codigo"));
            $precodigo = $codigos[0];
            $codigo = $codigos[1];
            if ($this->modelo->existeAlumno($this->getPOST("rut"), $codigo) === FALSE) {
                $this->modelo->setCodigo($codigo);
                $this->modelo->setPreCodigo($precodigo);
                $this->modelo->setRut($this->getPOST("rut"));
                $this->modelo->setNombres($this->getPOST("nombres"));
                $this->modelo->setApellidos($this->getPOST("apellidos"));
                $this->modelo->setSede($this->getPOST("sedes"));
                $this->modelo->setCarrera($this->getPOST("carreras"));
                if ($this->modelo->save()) {
                    $this->redirect("agregar", ["success" => SuccessMessages::SUCCESS_REGISTRO_NUEVOALUMNO]);
                } else {
                    $this->redirect("agregar", ["error" => ErrorMessages::ERROR_REGISTRAR_NUEVOALUMNO]);
                }
            } else {
                $this->redirect("agregar", ["error" => ErrorMessages::ERROR_REGISTRAR_YA_EXISTE_ALUMNO]);
            }
        } else {
            $this->redirect("agregar", ["error" => ErrorMessages::ERROR_REGISTRAR_ALUMNO_CAMPOS_VACIOS]);
        }
    }
}
