<?php
require_once "classes/storage.php";

$storage = new storage();
$storage->listarBuckets();
#$storage->listarObjetos("pdf-curricular");
#$storage->eliminarObjeto("pdf-curricular","BD_OK.sql");
#$storage->eliminarBucket("probando123kk");
$storage->descargarobjecto("pdf-curricular", "texto.txt","C:\\Users\\DESKTOP\\Downloads\\texto_new.txt");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <br>
    <form action="">
        <input type="file">
        <input type="submit" value="Subir">
    </form>
</body>
</html>