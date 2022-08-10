<?php
class AlumnoModel extends Model
{
    //class atributos
    private $codigo;
    private $pre_codigo;
    private $nombres;
    private $apellidos;
    private $sede;
    private $carrera;
    private $rut;

    public function __construct()
    {
        parent::__construct();
        $this->codigo = 0;
        $this->pre_codigo = 0;
        $this->rut = "";
        $this->nombres = "";
        $this->apellidos = "";
        $this->sede = 0;
        $this->carrera = 0;
    }

    public function getCarreras()
    {
        $items = array();
        try {
            $query = parent::query("SELECT * FROM carreras");
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                array_push($items, $p);
            }
            return $items;
        } catch (PDOException $th) {
            error_log("ALUMNO::MODELO => METODO_GETCARRERAS::PDOException => " . $th->getMessage());
        }
    }
    public function getSedes()
    {
        $items = array();
        try {
            $query = parent::query("SELECT * FROM sedes");
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                array_push($items, $p);
            }
            return $items;
        } catch (PDOException $th) {
            error_log("ALUMNO::MODELO => METODO_GETSEDES::PDOException => " . $th->getMessage());
        }
    }
    public function getAll()
    {
        $items = array();
        try {
            $query = parent::query("SELECT  (carreras.carrera, sedes.sede, data.pre_cod, data.codigo, data.nom, data.ape, data.rut) FROM data JOIN carreras ON carreras.id = data.carrera JOIN sedes ON sedes.id = data.sede ORDER BY codigo DESC");
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $objeto = new AlumnoModel();
                $objeto->setRut($p["rut"]);
                $objeto->setCodigo($p["codigo"]);
                $objeto->setPreCodigo($p["pre_cod"]);
                $objeto->setNombres($p["nom"]);
                $objeto->setApellidos($p["ape"]);
                $objeto->setSede($p["sede"]);
                $objeto->setCarrera($p["carrera"]);

                array_push($items, $objeto);
            }
            return $items;
        } catch (PDOException $th) {
            error_log("ALUMNO::MODELO => METODO_GETALL::PDOException => " . $th->getMessage());
        }
    }
    public function getTituladoRut($rut)
    {
        try {
            $query = $this->prepare("SELECT data.pre_cod, data.codigo, data.nom, data.ape, carreras.carrera, sedes.sede, data.rut FROM data JOIN carreras ON carreras.id = data.carrera JOIN sedes ON sedes.id = data.sede WHERE rut=:rut");
            $query->bindParam(":rut", $rut);
            $query->execute();
            $alumno = $query->fetch(PDO::FETCH_ASSOC);
            //set data object
            $this->setCodigo($alumno["codigo"]);
            $this->setPreCodigo($alumno["pre_cod"]);
            $this->setRut($alumno["rut"]);
            $this->setNombres($alumno["nom"]);
            $this->setApellidos($alumno["ape"]);
            $this->setSede($alumno["sede"]);
            $this->setCarrera($alumno["carrera"]);
            return $this;
        } catch (PDOException $th) {
            error_log("ALUMNO::MODELO => METODO_GetByRut::PDOException => " . $th->getMessage());
        }
    }
    public function get($rut)
    {
        try {
            $query = $this->prepare("SELECT data.pre_cod, data.codigo, data.nom, data.ape, data.carrera, data.sede, data.rut FROM data WHERE rut=:rut");
            $query->bindParam(":rut", $rut);
            $query->execute();
            $alumno = $query->fetch(PDO::FETCH_ASSOC);
            //set data object
            $this->setCodigo($alumno["codigo"]);
            $this->setPreCodigo($alumno["pre_cod"]);
            $this->setRut($alumno["rut"]);
            $this->setNombres($alumno["nom"]);
            $this->setApellidos($alumno["ape"]);
            $this->setSede($alumno["sede"]);
            $this->setCarrera($alumno["carrera"]);
            return $this;
        } catch (PDOException $th) {
            error_log("ALUMNO::MODELO => METODO_GetByRut::PDOException => " . $th->getMessage());
        }
    }
    public function __getAlumnosBySede($sede)
    {
        $items = array();
        try {
            $query = $this->query("SELECT data.pre_cod, data.codigo, data.nom, data.ape, carreras.carrera, sedes.sede, data.rut FROM data 
            JOIN carreras ON carreras.id = data.carrera 
            JOIN sedes ON sedes.id = data.sede 
            WHERE sedes.sede LIKE '%$sede%'");
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $objeto = new AlumnoModel();
                $objeto->setRut($p["rut"]);
                $objeto->setCodigo($p["codigo"]);
                $objeto->setPreCodigo($p["pre_cod"]);
                $objeto->setNombres($p["nom"]);
                $objeto->setApellidos($p["ape"]);
                $objeto->setSede($p["sede"]);
                $objeto->setCarrera($p["carrera"]);

                array_push($items, $objeto);
            }
            return $items;
        } catch (PDOException $th) {
            error_log("ALUMNO::MODELO => METODO_GetBySede::PDOException => " . $th->getMessage());
        }
    }
    public function __getAlumnosByCarrera($carrera)
    {
        $items = array();
        try {
            $query = $this->query("SELECT data.pre_cod, data.codigo, data.nom, data.ape, carreras.carrera, sedes.sede, data.rut FROM data 
            JOIN carreras ON carreras.id = data.carrera 
            JOIN sedes ON sedes.id = data.sede
            WHERE carreras.carrera LIKE '%$carrera%'");
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $objeto = new AlumnoModel();
                $objeto->setRut($p["rut"]);
                $objeto->setCodigo($p["codigo"]);
                $objeto->setPreCodigo($p["pre_cod"]);
                $objeto->setNombres($p["nom"]);
                $objeto->setApellidos($p["ape"]);
                $objeto->setSede($p["sede"]);
                $objeto->setCarrera($p["carrera"]);

                array_push($items, $objeto);
            }
            return $items;
        } catch (PDOException $th) {
            error_log("ALUMNO::MODELO => METODO_GetByCarrera::PDOException => " . $th->getMessage());
        }
    }
    //antes de utilizar esta funcion se debe crear previamente el objeto
    public function save()
    {
        try {
            $query = $this->prepare("INSERT INTO data (codigo, rut, pre_cod, nom, ape, sede, carrera) VALUES(:codigo, :rut ,:precod, :nom, :ape, :sede, :carrera);");
            $query->execute([
                ":precod" => $this->getPreCodigo(),
                ":codigo" => $this->getCodigo(),
                ":rut" => $this->getRut(),
                ":nom" => $this->getNombres(),
                ":ape" => $this->getApellidos(),
                ":sede" => $this->getSede(),
                ":carrera" => $this->getCarrera()
            ]);
            return true;
        } catch (PDOException $th) {
            error_log("ALUMNO::MODELO::GuardarDato -> PDOException => " . $th->getMessage());
            return false;
        }
    }
    public function update($rutParam = null)
    {
        try {
            if(isset($rutParam)){

            $query = $this->prepare("UPDATE data SET pre_cod=:precodigo, rut=:newRut, codigo=:codigo, nom=:nom, ape=:ape, sede=:sede, carrera=:carrera WHERE rut=:oldRut");
            $query->bindParam(":oldRut",  $this->rut);
            $query->bindParam(":newRut",  $rutParam);
            $query->bindParam(":precodigo",  $this->pre_codigo);
            $query->bindParam(":codigo",  $this->codigo);
            $query->bindParam(":nom",  $this->nombres);
            $query->bindParam(":ape",  $this->apellidos);
            $query->bindParam(":sede",  $this->sede);
            $query->bindParam(":carrera",  $this->carrera);
            $query->execute();
            return true;
        }else{
            $query = $this->prepare("UPDATE data SET pre_cod=:precodigo, codigo=:codigo, nom=:nom, ape=:ape, sede=:sede, carrera=:carrera WHERE rut=:rut");
            $query->bindParam(":rut",  $this->rut);
            $query->bindParam(":precodigo",  $this->pre_codigo);
            $query->bindParam(":codigo",  $this->codigo);
            $query->bindParam(":nom",  $this->nombres);
            $query->bindParam(":ape",  $this->apellidos);
            $query->bindParam(":sede",  $this->sede);
            $query->bindParam(":carrera",  $this->carrera);
            $query->execute();
            return true;
        }

        } catch (PDOException $th) {
            error_log("ALUMNO::MODELO => METODO_GETActualizarDato::PDOException => " . $th->getMessage());
            return false;
        }
    }
    public function delete($rut)
    {
        try {
            $query = $this->prepare("DELETE FROM data WHERE rut=:rut");
            $query->bindParam("rut", $rut, PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $th) {
            error_log("ALUMNO::MODELO => METODO_DELETE::PDOException => " . $th->getMessage());
            return false;
        }
    }
    public function from($array)
    {
        $this->setCodigo($array[0]);
        $this->setRut($array[1]);
        $this->setNombres($array[2]);
        $this->setApellidos($array[3]);
        $this->setSede($array[4]);
        $this->setCarrera($array[5]);
    }
    public function __getDatosToArray()
    {
        return array(
            "codigo" => $this->getCodigo(),
            "rut" => $this->getRut(),
            "nombres" => $this->getNombres(),
            "apellidos" => $this->getApellidos(),
            "sede" => $this->getSede(),
            "carrera" => $this->getCarrera()
        );
    }
    public function existeAlumno($rut, $codigo)
    {
        try {
            $query = $this->prepare("SELECT * FROM data WHERE rut=:rut and codigo=:codigo");
            $query->bindParam(":rut",$rut);
            $query->bindParam(":codigo", $codigo);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_EXISTS:: " . $th->getMessage());
            return false;
        }
    }

    /*          getter y setters        */

    /**
     * Get the value of codigo
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of nombres
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set the value of nombres
     *
     * @return  self
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get the value of apellidos
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of sede
     */
    public function getSede()
    {
        return $this->sede;
    }

    /**
     * Set the value of sede
     *
     * @return  self
     */
    public function setSede($sede)
    {
        $this->sede = $sede;

        return $this;
    }

    /**
     * Get the value of carrera
     */
    public function getCarrera()
    {
        return $this->carrera;
    }

    /**
     * Set the value of carrera
     *
     * @return  self
     */
    public function setCarrera($carrera)
    {
        $this->carrera = $carrera;

        return $this;
    }

    /**
     * Get the value of rut
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set the value of rut
     *
     * @return  self
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get the value of pre_codigo
     */
    public function getPreCodigo()
    {
        return $this->pre_codigo;
    }

    /**
     * Set the value of pre_codigo
     */
    public function setPreCodigo($pre_codigo): self
    {
        $this->pre_codigo = $pre_codigo;

        return $this;
    }
}
