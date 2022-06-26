<?php
class UsuarioModel extends Model implements IModel
{
    private $id, $usuario, $contrasena, $rol, $nombre, $foto;

    function __construct()
    {
        error_log("UserModel => Cargado.");
        parent::__construct();
        $this->id = "";
        $this->usuario = "";
        $this->contrasena = "";
        $this->rol = "user";
        $this->foto = "";
        $this->nombre = "";
    }

    public function save()
    {
        try {
            $query = $this->prepare("INSERT INTO usuarios values (null, :usuario, :contrasena, :rol, :foto, :nombre)");
            $query->execute([

                ":usuario" => $this->usuario,
                ":contrasena" => $this->contrasena,
                ":rol" => $this->rol,
                ":foto" => $this->foto,
                ":nombre" => $this->nombre
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
                array_push($items, $objeto);
            }
            return $items;
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_GETALL::PDOException => " . $th->getMessage());
        }
    }
    public function get($usuario)
    {
        try {
            $query = $this->prepare("SELECT * FROM usuarios WHERE usuario=:usuario");
            $query->execute([":usuario" => $usuario]);
            $res = $query->fetch(PDO::FETCH_ASSOC);
            //set data object
            $this->setId($res["id"]);
            $this->setUsuario($res["usuario"]);
            $this->setContrasena($res["contrasena"]);
            $this->setRol($res["rol"]);
            $this->setFoto($res["foto"]);
            $this->setNombre($res["nombre"]);
            return $this;
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_GET_ID::PDOException -> " . $th->getMessage());
        }
        // try {
        //     $query = $this->prepare("SELECT * FROM usuarios WHERE usuario=:usuario");
        //     $query->execute([":usuario" => $usuario]);
        //     $res = $query->fetch(PDO::FETCH_ASSOC);
        //     $usuario = new UsuarioModel();
        //     //set data object
        //     $usuario->setId($res["id"]);
        //     $usuario->setUsuario($res["usuario"]);
        //     $usuario->setContrasena($res["contrasena"]);
        //     $usuario->setRol($res["rol"]);
        //     $usuario->setFoto($res["foto"]);
        //     $usuario->setNombre($res["nombre"]);
        //     return $usuario;
        // } catch (PDOException $th) {
        //     error_log("UsuarioModelo => METODO_GET_ID::PDOException -> " . $th->getMessage());
        // }
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
            $query = $this->prepare("UPDATE usuarios SET usuario=:usuario, contrasena=:contrasena, rol=:rol, foto=:foto, nombre=:nombre WHERE id=:id");
            $query->execute([
                ":id" => $this->id,
                ":usuario" => $this->usuario,
                ":contrasena" => $this->contrasena,
                ":rol" => $this->rol,
                ":foto" => $this->foto,
                ":nombre" => $this->nombre
            ]);

            return true;
        } catch (PDOException $th) {
            error_log("UsuarioModelo => METODO_GET::PDOException => " . $th->getMessage());
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
}
