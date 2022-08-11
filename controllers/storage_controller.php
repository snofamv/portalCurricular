<?php
require_once "classes/storage.php";
class StorageController extends SessionController
{
    private $storage;
    private $cajas;
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
        $tamanio = sizeof($arrAux);
        return $arrAux[$tamanio - 1];
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


    public function render()
    {
        if ($this->existsGET(["buscarCaja"])) {
            $d = $this->separarCaracteres($this->storage->buscarCaja($this->getGET("buscarCaja")));
            if ($d != NULL) {
                $this->vista->render("admin/storage", $d);
            } else {
                $this->redirect("storage", ["error" => ErrorMessages::ERROR_STORAGE_BUSCAR_CAJA]);
            }
        } elseif ($this->existsGET(["buscarCarpeta"])) {
            $d = $this->separarCaracteres($this->storage->buscarCarpeta($this->getGET("buscarCarpeta")));
            if ($d != NULL) {
                $this->vista->render("admin/storage", $d);
            } else {
                $this->redirect("storage", ["error" => ErrorMessages::ERROR_STORAGE_BUSCAR_CARPETA]);
            }
        } elseif ($this->existsGET(["descargarArchivo"])) {
            $this->descargar();
        } else {

            $d["archivos"] = $this->separarCaracteres($this->storage->arrayDeCajas($this->paginaActual));
            $d["paginas"] = array("paginaActual" => $this->getPaginaActual(), "paginaAnterior" => $this->getPaginaAnterior(), "paginaSiguiente" => $this->getPaginaSiguiente(), "cantidadPaginas" => count($this->getCajas()), "numeroCajas" => $this->getCajas());
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
        $this->storage = new storage();
        $archivo = explode("/", $this->getGET("descargarArchivo"));
        if ($this->storage->descargarobjecto($archivo[0], $archivo[1], $archivo[2], "C:\\Users\\DESKTOP\\Downloads")) {
            $this->redirect("storage", ["success" => SuccessMessages::SUCCESS_STORAGE_DESCARGAR_DOCUMENTO]);
        } else {
            $this->redirect("storage", ["success" => ErrorMessages::ERROR_STORAGE_DESCARGAR_DOCUMENTO]);
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
