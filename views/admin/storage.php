<?php

require_once "classes/storage.php";
require_once "views/includes/navbar.admin.php";
if ($_GET["carpeta"]) {
    $storage = new storage();
    $caja = $_GET["caja"];
    $subcarpeta = $_GET["carpeta"];
    $archivo = $_GET["archivo"];
    $storage->descargarobjecto($caja, $subcarpeta, $archivo, "C:\\Users\\DESKTOP\\Downloads");
}
?>

<div class="container mt-5">

    <form action="/admin/storage" method="get">
        <div class="d-inline">
            <label for="caja">N° Caja</label>
            <input type="text" name="caja" id="caja">
        </div>
        <div class="d-inline">
            <label for="carpeta">N° Carpeta</label>
            <input type="text" name="carpeta" id="carpeta">
        </div>
        <div class="d-inline">
            <label for="archivo">Archivo</label>
            <input list="archivos" name="archivo">
            <datalist id="archivos">
                <option value="Acta de Titulo"></option>
                <option value="Certificado de Nacimiento"></option>
                <option value="Concentracion de Notas"></option>
            </datalist>
        </div>

        <input type="submit" value="Descargar PDF">
    </form>
</div>


<?php require_once "views/includes/footer.template.php"; ?>