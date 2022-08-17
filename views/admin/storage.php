<?php
require_once "views/includes/navbar.admin.php";
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}
?>

<div class="container mt-5">
    <span class="h3">

        <?php if (!empty($this->datos) && isset($this->datos["success"])) : ?>

            <div class="alert alert-success alert-dismissible d-flex justify-content-center mx-auto" style="width: 70%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <p class="ps-4 font-monospace">
                    <strong><?php $this->showMessages(); ?></strong>
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>

        <?php elseif (!empty($this->datos) && isset($this->datos["error"])) : ?>
            <div class="alert alert-danger alert-dismissible d-flex justify-content-center mx-auto" style="width: 70%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <p class="ps-4 font-monospace">
                    <strong><?php $this->showMessages(); ?></strong>
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

    </span class="h3">

    <div class="d-flex">

        <form action="/storage/caja" method="GET">
            <fieldset>
                <legend>Busqueda Caja</legend>
                <label for="">Caja <input type="text" placeholder="Ej: 0001" name="caja"> </label>
                <button class="btn btn-primary" type="submit">Buscar</button>
            </fieldset>
        </form>
        <form action="/storage/carpeta" method="GET">
            <fieldset>
                <legend>Busqueda Carpeta</legend>
                <label for="">Carpeta <input type="text" placeholder="Ej: 0001-0001" name="carpeta"> </label>
                <button class="btn btn-primary" type="submit">Buscar</button>
            </fieldset>
        </form>
    </div>

    <hr>
    <?php if ($d["paginas"]["paginaActual"] != $d["paginas"]["numeroCajas"][0]) : ?>
        <div class="d-flex justify-content-end">
            <a class="btn btn-danger" href="/storage">Volver</a>
        </div>
    <?php endif; ?>
    <table id='myTable2' class='table table-success table-striped table-hover table-bordered border-primary'>


        <thead class='table-dark'>

            <th>N° caja</th>
            <th><input class="myInput" type="text" id="myInput2" onkeyup="buscarCarpeta();" placeholder="Filtrar carpeta"><br>Carpeta</th>
            <th>Archivos</th>
            <th>Descarga</th>
        </thead>
        <tbody>

            <?php if (isset($d["archivos"])) : ?>
                <?php foreach ($d["archivos"] as $caja) : ?>
                    <tr class='tablaItem'>
                        <td><?php echo $caja[0] ?></td>
                        <td><?php echo $caja[1] ?></td>
                        <td><?php echo $caja[2] ?></td>
                        <td>
                            <a class="btn btn-primary" href="https://<?php echo $d["bucketBase"] ?>.storage.googleapis.com/<?php echo "$caja[0]/$caja[1]/$caja[2]"; ?>" target="_blank">Descargar PDF</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php endif; ?>




        </tbody>
    </table>
    <div class="d-flex justify-content-between mb-5">
        <?php if (isset($d["paginas"])) : ?>
            <?php if ($d["paginas"]["paginaActual"] != $d["paginas"]["numeroCajas"][0]) : ?>
                <button><a href="/storage?pagina=<?php echo htmlspecialchars($d["paginas"]["paginaAnterior"]); ?>">←Anterior</a></button>
            <?php endif; ?>

            <div>
                <?php
                for ($i = 0; $i < $d["paginas"]["cantidadPaginas"]; $i++) : ?>
                    <button class='me-2'><a href='/storage?pagina=<?php echo $d["paginas"]["numeroCajas"][$i]; ?>' style='text-decoration:none;'><?php echo $i + 1; ?></a></button>
                <?php endfor; ?>
            </div>
            <?php if ($d["paginas"]["paginaActual"] != $d["paginas"]["numeroCajas"][$d["paginas"]["cantidadPaginas"] - 1]) : ?>
                <button><a href="/storage?pagina=<?php echo htmlspecialchars($d["paginas"]["paginaSiguiente"]); ?>">Siguiente→ </a></button>
            <?php endif; ?>
        <?php endif; ?>



    </div>
</div>
<script>
    function buscarCarpeta() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable2");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<?php require_once "views/includes/footer.template.php"; ?>