<?php
require_once "classes/storage.php";
class StorageController extends SessionController
{
    private $caja;
    private $carpeta;

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        if ($this->existsGET(["buscarCaja"])) {
            $storage = new storage();
            $d = $this->separarCaracteres($storage->buscarCaja($this->getGET("buscarCaja")));
            if ($d != NULL) {
                $this->vista->render("admin/storage", $d);
            } else {
                $this->redirect("storage", ["error" => ErrorMessages::ERROR_STORAGE_BUSCAR_CAJA]);
            }
        } elseif ($this->existsGET(["buscarCarpeta"])) {
            $storage = new storage();
            $d = $this->separarCaracteres($storage->buscarCarpeta($this->getGET("buscarCarpeta")));
            if ($d != NULL) {
                $this->vista->render("admin/storage", $d);
            } else {
                $this->redirect("storage", ["error" => ErrorMessages::ERROR_STORAGE_BUSCAR_CARPETA]);
            }
        } elseif ($this->existsGET(["descargarArchivo"])) {
            $this->descargar();
        } else {
            $storage = new storage();
            $d = $this->separarCaracteres($storage->arrObjetos());
            $this->vista->render("admin/storage", $d);
        }
    }
    private function separarCaracteres($arr)
    {
        if (isset($arr["error"])) {
            return null;
        }
        $lista = array();
        foreach ($arr as $d) {
            $letras = explode("/", $d->name());
            array_push($lista, $letras);
        }
        return $lista;
    }
    public function descargar()
    {
        $storage = new storage();
        $archivo = explode("/", $this->getGET("descargarArchivo"));
        if ($storage->descargarobjecto($archivo[0], $archivo[1], $archivo[2], "C:\\Users\\DESKTOP\\Downloads")) {
            $this->redirect("storage", ["success" => SuccessMessages::SUCCESS_STORAGE_DESCARGAR_DOCUMENTO]);
        } else {
            $this->redirect("storage", ["success" => ErrorMessages::ERROR_STORAGE_DESCARGAR_DOCUMENTO]);
        }
    }
}
