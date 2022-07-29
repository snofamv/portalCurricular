<?php
require "classes/vendor/autoload.php";

use Google\Cloud\Storage\StorageClient;

class storage
{
    private $projectId;
    private $storage;

    public function __construct()
    {
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

    public function subirArchivo($bucketName, $objectName, $source)
    {
        $storage = new StorageClient();
        $file = fopen($source, "r");
        $bucket = $storage->bucket($bucketName);
        # $object = $bucket->uploadFile($file, ["name" => $objectName]);
        printf("Uploaded: %s to gs://%s/%s" . PHP_EOL, basename($source), $bucketName, $objectName);
    }

    public function listarObjetos($bucketName)
    {
        $bucket = $this->storage->bucket($bucketName);
        foreach ($bucket->objects() as $object) {
            # code...
            printf("Object: %s <br>", $object->name());
        }
    }
    public function listaNombreObjetos($bucketName)
    {
        $datos = array();
        $bucket = $this->storage->bucket($bucketName);
        foreach ($bucket->objects() as $object) {
            array_push($datos, $object->name());
        }
        return $datos;
    }
    public function tablaHTML()
    {
        $arr = array();
        $datos = $this->listaNombreObjetos("pdf-curricular");
        foreach ($datos as $dato) {
            $arr = explode("/", $dato);
            echo ("<tr class='tablaItem'>
                    <td>$arr[0]</td>
                    <td>$arr[1]</td>
                    <td>$arr[2]</td>
                    <td>
                    <form method='GET' action='/admin/storage'>
                        <button type='submit' value='$dato' name='descargarArchivo'>Descargar PDF</button>
                    </form>
                    </td>
                </tr>");
        }
    }
    public function buscarCarpeta($carpeta)
    {
        $arr = array();
        $datos = $this->listaNombreObjetos("pdf-curricular");
        foreach ($datos as $dato) {
            $arr = explode("/", $dato);
            if ($carpeta === $arr[1]) {
                echo ("<tr class='tablaItem'>
            <td>$arr[0]</td>
            <td>$arr[1]</td>
            <td>$arr[2]</td>
            <td>
            <form method='GET' action='/admin/storage'>
                <button type='submit' value='$dato' name='descargarArchivo'>Descargar PDF</button>
            </form>
            </td>
        </tr>");
            }
        }
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

    public function descargarobjecto($carpeta, $subcarpeta, $objectName, $destination)
    {
        $bucket = $this->storage->bucket("pdf-curricular");
        $object = $bucket->object("$carpeta/$subcarpeta/$objectName");
        if ($object->downloadToFile("$destination\\$objectName")) {
            return true;
        } else {
            return false;
        }
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
}
