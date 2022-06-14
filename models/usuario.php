<?php
class Usuario extends Model implements IModel
{
    private $rut, $clave, $rol, $foto, $nombre;

    function __construct()
    {
        error_log("USER::MODELO => Cargada");
        parent::__construct();
        $this->rut = "";
        $this->clave = "";
        $this->rol = "user";
        $this->foto = "";
        $this->nombre = "";
    }

    public function __guardarDato()
    {
        try {
            $query = $this->prepare("INSERT INTO usuarios values(:rut, :clave, :rol, :foto, :nombre)");
            $query->execute([
                ":rut" => $this->rut,
                ":clave" => $this->clave,
                ":rol" => $this->rol,
                ":foto" => $this->foto,
                ":nombre" => $this->nombre,
            ]);
            return true;
        } catch (PDOException $th) {
            error_log("USER_MODELO::PDOException => " . $th->getMessage());
            return false;
        }
    }
    public function __getTodosLosDatos()
    {
        $items = array();
        try {
            $query = $this->query("SELECT * FROM usuarios");
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $objeto = new self();
                $objeto->setRut($p["rut"]);
                $objeto->setClave($p["clave"]);
                $objeto->setRol($p["rol"]);
                $objeto->setFoto($p["foto"]);
                $objeto->setNombre($p["nombre"]);

                array_push($items, $objeto);
            }
            return $items;
        } catch (PDOException $th) {
            error_log("USER_MODELO => METODO_GETALL::PDOException => " . $th->getMessage());
        }
    }
    public function __getDatoById($rut)
    {
        try {
            $query = $this->prepare("SELECT * FROM usuarios WHERE rut=:rut");
            $query->execute([":rut" => $rut]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            //set data object
            $this->setRut($user["rut"]);
            $this->setClave($user["clave"]);
            $this->setRol($user["rol"]);
            $this->setFoto($user["foto"]);
            $this->setNombre($user["nombre"]);
            return $this;
        } catch (PDOException $th) {
            error_log("USER_MODELO => METODO_GET::PDOException => " . $th->getMessage());
        }
    }
    public function __borrarDatoById($rut)
    {
        try {
            $query = $this->prepare("DELETE FROM usuarios WHERE rut=:rut");
            $query->execute([":rut" => $rut]);

            return true;
        } catch (PDOException $th) {
            error_log("USER_MODELO => METODO_DELETE::PDOException => " . $th->getMessage());
            return false;
        }
    }
    public function __actualizarDato(){
        try {
            $query = $this->prepare("UPDATE usuarios SET clave=:clave, rol=:rol, foto=:foto, nombre=:nombre WHERE rut=:rut");
            $query->execute([
                ":rut"=> $this->rut,
                ":clave" => $this->clave,
                ":rol" => $this->rol,
                ":foto" => $this->foto,
                ":nombre" => $this->nombre,
            ]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            //set data object
            $this->setRut($user["rut"]);
            $this->setClave($user["clave"]);
            $this->setRol($user["rol"]);
            $this->setFoto($user["foto"]);
            $this->setNombre($user["nombre"]);
            return true;
        } catch (PDOException $th) {
            error_log("USER_MODELO => METODO_GET::PDOException => " . $th->getMessage());
            return false;
        }
    }
    public function __setDatosDesdeArray($array)
    {
        $this->rut = $array["rut"];
        $this->clave = $array["clave"];
        $this->rol = $array["rol"];
        $this->foto = $array["foto"];
        $this->nombre = $array["nombre"];
    }

    private function getHashedPassword($clave)
    {
        //hasheo a nivel default con salt 10
        return password_hash($clave, PASSWORD_DEFAULT, ["cost" => "10"]);
    }



    public function existeUsuario($rut){
        try {
            $query = $this->prepare("SELECT * FROM usuarios WHERE rut=:rut");
            $query->execute([":rut"=>$rut]);
            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }
        } catch (PDOException $th) {
            error_log("USER_MODELO => METODO_EXISTS:: ".$th->getMessage());
            return false;
        }
    }
    public function comparePassword($clave, $rut){
        try {
            $usuario = $this->__getDatoById($rut);
            return password_verify($clave, "$usuario->getClave()");
        } catch (PDOException $th) {
            error_log("USER_MODELO => METODO_EXISTS:: ".$th->getMessage());
            return false;
        }
    }
    
    /********************GETTER SETTER*************************/
 


    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setClave($clave)
    {
        $this->clave = $this->getHashedPassword($clave);

        return $this;
    }
   

    /**
     * Get the value of rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get the value of photo
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */
    public function setFoto($photo)
    {
        $this->foto = $photo;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

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
