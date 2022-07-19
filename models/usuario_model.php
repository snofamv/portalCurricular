<?php
class UsuarioModel extends Model implements IModel
{
    private $id, $usuario, $contrasena, $rol, $nombre, $foto, $estado;

    function __construct()
    {
        parent::__construct();
        $this->id = "";
        $this->usuario = "";
        $this->contrasena = "";
        $this->rol = "lector";
        $this->foto = "";
        $this->nombre = "";
        $this->estado = 0;
    }

    public function desactivarUsuario(){
        try {
            $query = $this->prepare("UPDATE usuarios SET estado=0 WHERE id=:id");
            $query->bindParam(":id",$this->id);
            $query->execute();
            return true;
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_UPDATE::PDOException => " . $th->getMessage());
            return false;
        }
    }
    public function activarUsuario(){
        try {
            $query = $this->prepare("UPDATE usuarios SET estado=1 WHERE id=:id");
            $query->bindParam(":id",$this->id);
            $query->execute();
            return true;
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_UPDATE::PDOException => " . $th->getMessage());
            return false;
        }
    }
    public function cambiarRol($rol){
        try {
            $query = $this->prepare("UPDATE usuarios SET rol=:rol WHERE id=:id");
            $query->bindParam(":id",$this->id);
            $query->bindParam(":rol",$rol);
            $query->execute();
            return true;
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_UPDATE::PDOException => " . $th->getMessage());
            return false;
        }
    }
    public function save()
    {
        try {
            
            $query = $this->prepare("INSERT INTO usuarios values (null, :usuario, :contrasena, :rol, :foto, :nombre, :estado)");
            $query->execute([

                ":usuario" => $this->usuario,
                ":contrasena" => $this->contrasena,
                ":rol" => $this->rol,
                ":foto" => $this->foto,
                ":nombre" => $this->nombre,
                ":estado" => $this->estado
            ]);
            return true;
        } catch (PDOException $th) {
            error_log("UsuarioModelo::PDOException -> " . $th->getMessage());
            return false;
        }
    }
    public function getAll()
    {
        $items = array();
        try {
            $query = $this->query("SELECT * FROM usuarios");
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $objeto = new self();
                $objeto->setId($p["id"]);
                $objeto->setUsuario($p["usuario"]);
                $objeto->setContrasena($p["contrasena"]);
                $objeto->setRol($p["rol"]);
                $objeto->setFoto($p["foto"]);
                $objeto->setNombre($p["nombre"]);
                $objeto->setEstado($p["estado"]);
                array_push($items, $objeto);
            }
            return $items;
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_GETALL::PDOException => " . $th->getMessage());
        }
    }
    public function get($param)
    {
        try {
            $query = $this->prepare("SELECT * FROM usuarios WHERE usuario=:param");
            $query->execute([":param" => $param]);
            $usuario = $query->fetch(PDO::FETCH_ASSOC);
            //set data object
            $this->setId($usuario["id"]);
            $this->setUsuario($usuario["usuario"]);
            $this->setContrasena($usuario["contrasena"]);
            $this->setRol($usuario["rol"]);
            $this->setFoto($usuario["foto"]);
            $this->setNombre($usuario["nombre"]);
            $this->setEstado($usuario["estado"]);
            return $this;
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_GET::PDOException -> " . $th->getMessage());
            return NULL;
        }
    }
    public function getById($param)
    {
        try {
            $query = $this->prepare("SELECT * FROM usuarios WHERE id=:param");
            $query->execute([":param" => $param]);
            $usuario = $query->fetch(PDO::FETCH_ASSOC);
            //set data object
            $this->setId($usuario["id"]);
            $this->setUsuario($usuario["usuario"]);
            $this->setContrasena($usuario["contrasena"]);
            $this->setRol($usuario["rol"]);
            $this->setFoto($usuario["foto"]);
            $this->setNombre($usuario["nombre"]);
            $this->setEstado($usuario["estado"]);
            return $this;
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_GET_ID::PDOException -> " . $th->getMessage());
            return NULL;
        }
    }
    public function delete($usuario)
    {
        try {
            $query = $this->prepare("DELETE FROM usuarios WHERE usuario=:usuario");
            $query->execute([":usuario" => $usuario]);

            return true;
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_DELETE::PDOException => " . $th->getMessage());
            return false;
        }
    }

    public function update()
    {
        #para usar el update primero se utiliza el GET para crear un objeto en el propio modelo
        try {
            $query = $this->prepare("UPDATE usuarios SET usuario=:usuario, contrasena=:contrasena, rol=:rol, foto=:foto, nombre=:nombre, estado=:estado WHERE id=:id");
            $query->execute([
                ":id" => $this->id,
                ":usuario" => $this->usuario,
                ":contrasena" => $this->contrasena,
                ":rol" => $this->rol,
                ":foto" => $this->foto,
                ":estado" => $this->estado
            ]);

            return true;
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_UPDATE::PDOException => " . $th->getMessage());
            return false;
        }
    }
    public function from($array)
    {
        $this->id = $array["id"];
        $this->usuario = $array["usuario"];
        $this->contrasena = $array["contrasena"];
        $this->rol = $array["rol"];
        $this->foto = $array["foto"];
        $this->nombre = $array["nombre"];
    }

    private function getHashedPassword($clave)
    {
        //hasheo a nivel default con salt 10
        return password_hash($clave, PASSWORD_DEFAULT, ["cost" => "10"]);
    }



    public function existeUsuario($usuario)
    {
        try {
            $query = $this->prepare("SELECT * FROM usuarios WHERE usuario=:usuario");
            $query->execute([":usuario" => $usuario]);
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
    public function comparePassword($clave, $usuario)
    {
        try {
            $usr = $this->get($usuario);
            return password_verify($clave, $usr->getContrasena());
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_EXISTS:: " . $th->getMessage());
            return false;
        }
    }

    /********************GETTER SETTER*************************/




    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of contrasena
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }

    /**
     * Set the value of contrasena
     *
     * @return  self
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $this->getHashedPassword($contrasena);

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
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of foto
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of estado
     */


    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

    }
}
