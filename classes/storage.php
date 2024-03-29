<?php
require "classes/google/autoload.php";

use Google\Cloud\Storage\StorageClient;

class storage
{
    private $projectId = "archivoscurricular";
    private $bucketId = "67b8da2d3c54197788fe418dda2834fc";
    private $storage;
    private $arrayCajas;

    public function __construct()
    {
        putenv("GOOGLE_APPLICATION_CREDENTIALS=config/credencial.json");
        $this->storage = new StorageClient([
            'projectId' => $this->projectId,
            'keyFilePath' => 'config/credencial.json',
        ]);
        $this->storage->registerStreamWrapper();
    }

    public function crearBucket($bucketName)
    {
        try {
            $bucket = $this->storage->bucket($bucketName);
            if (!$bucket->exists()) {
                $this->projectId = $bucketName;
                $response = $this->storage->createBucket($this->projectId);
                echo "Your Bucket $bucketName is created successfully.";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function listarBuckets()
    {
        try {
            $buckets = $this->storage->buckets();

            foreach ($buckets as $bucket) {
                echo $bucket->name() . "<br>";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function subirArchivo($objectName, $source)
    {
        // $bucketName = 'my-bucket';
        // $objectName = 'my-object';
        // $source = '/path/to/your/file';

        $storage = new StorageClient();
        $file = fopen($source, 'r');
        $bucket = $storage->bucket($this->bucketId);

        if ($object = $bucket->upload($file, [
            'name' => "$objectName"
        ])) {
            return true;
        } else {
            return false;
        }
    }


    public function listaNombreObjetos()
    {
        $datos = array();
        $bucket = $this->storage->bucket($this->bucketId);
        foreach ($bucket->objects() as $object) {
            array_push($datos, $object->name());
        }
        return $datos;
    }
    public function contarDatosDelBucket()
    {

        $datos = array();
        $bucket = $this->storage->bucket($this->bucketId);
        $i = 0;
        foreach ($bucket->objects() as $object) {
            $i++;
        }
        return $i;
    }
    //////////////////////////////////

    public function arrayDeCajas($cajaParam)
    {

        $aux = array();
        foreach ($datos = $this->arrObjetos() as $dato) {
            $arr = explode("/", $dato->name());
            if ($cajaParam === $arr[0]) {
                array_push($aux, $dato);
            }
        }
        if (count($aux) === 0) {
            return NULL;
        }

        return $aux;
    }
    public function arrayDeCajasSiguiente($param)
    {
        $elementos = array();
        $buckets = $this->storage->bucket($this->bucketId)->objects();
        $cajaAnterior = intval($param);
        $aux = NULL;
        foreach ($buckets as $object) {

            $palabras = explode("/", $object->name());
            if ((intval($palabras[0]) > $cajaAnterior) && $aux === NULL) {
                $aux = $palabras[0];
            }

            if (intval($palabras[0]) > $cajaAnterior && intval($palabras[0]) < $aux) {
                array_push($elementos, $object);
            }
        }
        return $elementos;
    }
    public function arrObjetos()
    {
        $datos = array();
        $bucket = $this->storage->bucket($this->bucketId);
        foreach ($bucket->objects() as $object) {
            array_push($datos, $object);
        }
        return $datos;
    }


    public function buscarCarpeta($carpetaParam)
    {
        $aux = array();
        foreach ($datos = $this->arrObjetos() as $dato) {
            $arr = explode("/", $dato->name());
            if ($carpetaParam === $arr[1]) {
                array_push($aux, $dato);
            }
        }
        if (count($aux) === 0) {
            return NULL;
        }
        return $aux;
    }
    public function buscarCaja($cajaParam)
    {
        $aux = array();
        foreach ($datos = $this->arrObjetos() as $dato) {
            $arr = explode("/", $dato->name());
            if ($cajaParam === $arr[0]) {
                array_push($aux, $dato);
            }
        }
        if (count($aux) === 0) {
            return NULL;
        }

        return $aux;
    }
    public function eliminarObjeto($bucketName, $objectName, $options = [])
    {
        $bucket = $this->storage->bucket($bucketName);
        $object = $bucket->object($objectName);
        $object->delete();
        printf("Deleted object: gs//%s/%s" . PHP_EOL, $bucketName, $objectName);
    }

    public function eliminarBucket($bucketName)
    {
        $bucket = $this->storage->bucket($bucketName);
        $bucket->delete();
        printf("Bucket deleted: gc://%s", $bucketName);
    }

    public function descargarobjecto($texto, $destination)
    {
        $ex = explode("/", $texto);

        $bucket = $this->storage->bucket($this->bucketId);
        $object = $bucket->object("$ex[0]/$ex[1]/$ex[2]");
        if ($object->downloadToFile("$destination\\$ex[0]-$ex[1]-$ex[2]")) {
            return true;
        } else {
            return false;
        }
    }
    function make_public($bucketName, $objectName)
    {
        // $bucketName = 'my-bucket';
        // $objectName = 'my-object';
    
        $storage = new StorageClient();
        $bucket = $storage->bucket($this->bucketId);
        $object = $bucket->object($objectName);
        $object->update(['acl' => []], ['predefinedAcl' => 'PUBLICREAD']);
    }
    function set_bucket_public_iam()
{
    // $bucketName = 'my-bucket';

    $storage = new StorageClient();
    $bucket = $storage->bucket($this->bucketId);

    $policy = $bucket->iam()->policy(['requestedPolicyVersion' => 3]);
    $policy['version'] = 3;

    $role = 'roles/storage.objectViewer';
    $members = ['allUsers'];

    $policy['bindings'][] = [
        'role' => $role,
        'members' => $members
    ];

    $bucket->iam()->setPolicy($policy);

    printf('Bucket %s is now public');
}

    /**
     * Get the value of storage
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * Set the value of storage
     */
    public function setStorage($storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    /**
     * Get the value of bucketId
     */
    public function getBucketId()
    {
        return $this->bucketId;
    }

    /**
     * Set the value of bucketId
     */
    public function setBucketId($bucketId): self
    {
        $this->bucketId = $bucketId;

        return $this;
    }
}
