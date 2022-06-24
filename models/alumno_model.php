<?php
require_once "models/alumno_interface.php";
class AlumnoModel extends Model implements AlumnoInterface
{
    //class atributos
    private $codigo;
    private $nombres;
    private $apellidos;
    private $sede;
    private $carrera;
    private $rut;

    public function __construct()
    {
        error_log("Alumno::Modelo Alumno Instanciado.");
        parent::__construct();

        $this->codigo = "";
        $this->nombres = "";
        $this->apellidos = "";
        $this->sede = "";
        $this->carrera = "";
        $this->rut = "";
    }

    public function getAll()
    {
        $items = array();
        try {
            $query = parent::query("SELECT * FROM data");
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $objeto = new AlumnoModel();
                $objeto->setRut($p["rut"]);
                $objeto->setCodigo($p["codigo"]);
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
    public function get($rut)
    {
        try {
            $query = $this->prepare("SELECT * FROM data WHERE rut=:rut");
            $query->bindParam(":rut", $rut);
            $query->execute();
            $alumno = $query->fetch(PDO::FETCH_ASSOC);
            //set data object
            $this->setCodigo($alumno["codigo"]);
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
            $query = $this->query("SELECT * FROM data WHERE sede LIKE '%$sede%'");
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $objeto = new AlumnoModel();
                $objeto->setRut($p["rut"]);
                $objeto->setCodigo($p["codigo"]);
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
            $query = $this->query("SELECT * FROM data WHERE carrera LIKE '%$carrera%'");
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $objeto = new AlumnoModel();
                $objeto->setRut($p["rut"]);
                $objeto->setCodigo($p["codigo"]);
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
            $query = $this->prepare("INSERT INTO data values(:codigo, :nom, :ape, :sede, :carrera, :rut)");
            $query->execute([
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
    public function update()
    {
        try {
            $query = $this->prepare("UPDATE data SET codigo=:codigo, nom=:nom, ape=:ape, sede=:sede, carrera=:carrera WHERE rut=:rut");
            $query->bindParam(":rut",  $this->rut);
            $query->bindParam(":codigo",  $this->codigo);
            $query->bindParam(":nom",  $this->nombres);
            $query->bindParam(":ape",  $this->apellidos);
            $query->bindParam(":sede",  $this->sede);
            $query->bindParam(":carrera",  $this->carrera);
            $query->execute();
            // $alumno = $query->fetch(PDO::FETCH_ASSOC);
            // //set data object
            // $this->setRut($alumno["rut"]);
            // $this->setCodigo($alumno["codigo"]);
            // $this->setNombres($alumno["nombres"]);
            // $this->setApellidos($alumno["apellidos"]);
            // $this->setSede($alumno["sede"]);
            // $this->setCarrera($alumno["carrera"]);
            return true;
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
}
