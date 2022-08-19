<?php
require_once "classes/storage.php";
class StorageController extends SessionController
{
    private $storage;
    private $cajas;
    private $caja;
    private $paginaActual;
    private $paginaSiguiente;
    private $paginaAnterior;
    //Variables de la paginacion

    public function __construct()
    {

        parent::__construct();

        $this->storage = new storage();
        $this->paginaActual = isset($_GET["pagina"]) ? $_GET["pagina"] : "033";
        $this->total_paginas = 0;
        $this->cajas = $this->paginacionPorCajas();
        $this->paginaAnterior = $this->antPag();
        $this->paginaSiguiente = $this->sigPag();
    }

    public function render()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        $d["archivos"] = $this->separarCaracteres($this->storage->arrayDeCajas($this->paginaActual));
        $d["bucketBase"] = "pdf-curricular";
        $d["paginas"] = array("paginaActual" => $this->getPaginaActual(), "paginaAnterior" => $this->getPaginaAnterior(), "paginaSiguiente" => $this->getPaginaSiguiente(), "cantidadPaginas" => count($this->getCajas()), "numeroCajas" => $this->getCajas());
        $this->vista->render("admin/storage", $d);
    }
    public function caja()
    {
        if ($this->existsGET(["caja"])) {
            $d["archivos"] = $this->separarCaracteres($this->storage->buscarCaja($this->getGET("caja")));
            $this->vista->render("admin/storage", $d);
        } else {
            $this->redirect("storage", ["error" => ErrorMessages::ERROR_STORAGE_BUSCAR_CAJA]);
        }
    }
    public function carpeta()
    {
        if ($this->existsGET(["carpeta"])) {
            $d["archivos"] = $this->separarCaracteres($this->storage->buscarCarpeta($this->getGET("carpeta")));
            if ($d != NULL) {
                $this->vista->render("admin/storage", $d);
            } else {
                $this->redirect("storage", ["error" => ErrorMessages::ERROR_STORAGE_BUSCAR_CARPETA]);
            }
        }
    }
    private function sigPag()
    {
        $pagActual = intval($this->getPaginaActual());
        foreach ($this->getCajas() as $caja) {
            if (intval($caja) > $pagActual) {
                return $caja;
            }
        }
    }
    private function antPag()
    {
        $paginaActual = $this->paginaActual; //pagina actual 046
        $arrAux = array();
        $aux = 0;
        foreach ($this->cajas as $nCaja) { //todas las cajas
            $aux = intval($nCaja); //numero de la caja 046
            if (intval($nCaja) < intval($paginaActual)) { //? 033 > 046 ? FALSE
                array_push($arrAux, $nCaja); //guarda el valor si es menor a la pagina actual 
            }
        }
        //Una vez guardados las paginas menores se evaluara cual es la anterior
        return $arrAux[sizeof($arrAux) - 1];
    }
    private function paginacionPorCajas()
    {
        $arrCajas = array();
        foreach ($this->storage->listaNombreObjetos() as $dato) {
            $aux = NULL; //aqui va el valor anterior
            $palabras = explode("/", $dato);

            if (intval($palabras[0]) > $this->caja) {
                $aux = $this->caja; //valor anterior al auxiliar 033
                $this->caja = $palabras[0]; //valor nuevo 035
                array_push($arrCajas, $palabras[0]);
            }
        }

        return $arrCajas;
    }

    private function separarCaracteres($arr)
    {
        $lista = array();
        foreach ($arr as $d) {
            $letras = explode("/", $d->name());
            array_push($lista, $letras);
        }
        return $lista;
    }

    public function descargar2(){

        if($this->storage->descargarobjecto($this->getPOST("archivo"), "C:\Users\DESKTOP\Downloads")){
            echo "si";
        }else{
            echo "no";
        }
    }



    // METODOS

    /**
     * Get the value of cajas
     */
    public function getCajas()
    {
        return $this->cajas;
    }

    /**
     * Set the value of cajas
     */
    public function setCajas($cajas): self
    {
        $this->cajas = $cajas;

        return $this;
    }

    /**
     * Get the value of paginaActual
     */
    public function getPaginaActual()
    {
        return $this->paginaActual;
    }

    /**
     * Set the value of paginaActual
     */
    public function setPaginaActual($paginaActual): self
    {
        $this->paginaActual = $paginaActual;

        return $this;
    }

    /**
     * Get the value of paginaSiguiente
     */
    public function getPaginaSiguiente()
    {
        return $this->paginaSiguiente;
    }

    /**
     * Set the value of paginaSiguiente
     */
    public function setPaginaSiguiente($paginaSiguiente): self
    {
        $this->paginaSiguiente = $paginaSiguiente;

        return $this;
    }

    /**
     * Get the value of paginaAnterior
     */
    public function getPaginaAnterior()
    {
        return $this->paginaAnterior;
    }

    /**
     * Set the value of paginaAnterior
     */
    public function setPaginaAnterior($paginaAnterior): self
    {
        $this->paginaAnterior = $paginaAnterior;

        return $this;
    }
}
