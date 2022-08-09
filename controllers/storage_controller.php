<?php
require_once "classes/storage.php";
class StorageController extends SessionController
{
    private $caja;
    private $carpeta;
    private $pagina_inicial;
    private $resultadosPorPagina  = 100;
    private $empezar_desde;
    private $total_datos;
    private $totalPaginas;

    public function __construct()
    {
        parent::__construct();
        $this->pagina_inicial = isset($_GET["pagina"]) ? $_GET["pagina"] : 1;
        $this->empezar_desde = ($this->pagina_inicial - 1) * $this->resultadosPorPagina;
    }

    public function calcularPaginasBuckets()
    {
        $this->total_datos = 1;
        $this->totalPaginas = ceil($this->total_datos / $this->resultadosPorPagina) + 2;
    }
    public function getDatos($empezar_desde, $resultadosPorPagina)
    {
       
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



    // METODOS
    /**
     * Get the value of caja
     */
    public function getCaja()
    {
        return $this->caja;
    }

    /**
     * Set the value of caja
     */
    public function setCaja($caja): self
    {
        $this->caja = $caja;

        return $this;
    }

    /**
     * Get the value of carpeta
     */
    public function getCarpeta()
    {
        return $this->carpeta;
    }

    /**
     * Set the value of carpeta
     */
    public function setCarpeta($carpeta): self
    {
        $this->carpeta = $carpeta;

        return $this;
    }

    /**
     * Get the value of pagina_inicial
     */
    public function getPaginaInicial()
    {
        return $this->pagina_inicial;
    }

    /**
     * Set the value of pagina_inicial
     */
    public function setPaginaInicial($pagina_inicial): self
    {
        $this->pagina_inicial = $pagina_inicial;

        return $this;
    }

    /**
     * Get the value of resultadosPorPagina
     */
    public function getResultadosPorPagina()
    {
        return $this->resultadosPorPagina;
    }

    /**
     * Set the value of resultadosPorPagina
     */
    public function setResultadosPorPagina($resultadosPorPagina): self
    {
        $this->resultadosPorPagina = $resultadosPorPagina;

        return $this;
    }

    /**
     * Get the value of empezar_desde
     */
    public function getEmpezarDesde()
    {
        return $this->empezar_desde;
    }

    /**
     * Set the value of empezar_desde
     */
    public function setEmpezarDesde($empezar_desde): self
    {
        $this->empezar_desde = $empezar_desde;

        return $this;
    }

    /**
     * Get the value of total_datos
     */
    public function getTotalDatos()
    {
        return $this->total_datos;
    }

    /**
     * Set the value of total_datos
     */
    public function setTotalDatos($total_datos): self
    {
        $this->total_datos = $total_datos;

        return $this;
    }

    /**
     * Get the value of totalPaginas
     */
    public function getTotalPaginas()
    {
        return $this->totalPaginas;
    }

    /**
     * Set the value of totalPaginas
     */
    public function setTotalPaginas($totalPaginas): self
    {
        $this->totalPaginas = $totalPaginas;

        return $this;
    }
}
