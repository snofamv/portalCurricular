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
        $object = $bucket->uploadFile($file, ["name" => $objectName]);
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
    public function eliminarObjeto($bucketName, $objectName, $options = [])
    {
        $bucket = $this->storage->bucket($bucketName);
        $object = $bucket->object($objectName);
        $object->delete();
        printf("Deleted object: gs//%s/%s" . PHP_EOL, $bucketName, $objectName);
    }

    public function eliminarBucket($bucketName){
        $bucket = $this->storage->bucket($bucketName);
        $bucket->delete();
        printf("Bucket deleted: gc://%s", $bucketName);
    }

    public function descargarobjecto($carpeta, $subcarpeta, $objectName, $destination){
        $bucket = $this->storage->bucket("pdf-curricular");
        $object = $bucket->object("$carpeta/$subcarpeta/$objectName.pdf");
        if($object->downloadToFile("$destination\\$objectName.pdf")){
            echo "Archivo descargado.";
        }else{
            echo "Error al descargar el archivo.";
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
