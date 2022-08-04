<?php

require_once "views/includes/navbar.admin.php";

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

        <form action="/storage" method="GET">
            <fieldset>
                <legend>Busqueda Caja</legend>
                <label for="">Caja <input type="text" placeholder="Ej: 0001" name="buscarCaja"> </label>
                <button class="btn btn-primary" type="submit">Buscar</button>
            </fieldset>
        </form>
        <form action="/storage" method="GET">
            <fieldset>
                <legend>Busqueda Carpeta</legend>
                <label for="">Carpeta <input type="text" placeholder="Ej: 0001-0001" name="buscarCarpeta"> </label>
                <button class="btn btn-primary" type="submit">Buscar</button>
            </fieldset>
        </form>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
        <input class="myInput" type="text" id="myInput" onkeyup="buscarCaja();" placeholder="Filtrar caja">
        <input class="myInput" type="text" id="myInput2" onkeyup="buscarCarpeta();" placeholder="Filtrar carpeta">
    </div>
    <table id='myTable2' class='table table-success table-striped table-hover table-bordered border-primary'>


        <thead class='table-dark'>
            <th>N° caja</th>
            <th>Carpeta</th>
            <th>Archivos</th>
            <th>Descarga</th>
        </thead>
        <tbody> 

            <?php if (isset($d)) : ?>
                <?php foreach ($d as $caja) : ?>
                    <tr class='tablaItem'>
                        <td><?php echo $caja[0] ?></td>
                        <td><?php echo $caja[1] ?></td>
                        <td><?php echo $caja[2] ?></td>
                        <td>
                            <form method='GET' action="/storage" target="_self">
                                <button type='submit' value='<?php printf("%s/%s/%s", $caja[0], $caja[1], $caja[2]) ?>' name='descargarArchivo'>Descargar PDF</button>
                            </form>
                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php endif; ?>




        </tbody>
    </table>
    <div class="d-flex justify-content-between mb-5">
        <?php $pagina_actual = isset($_GET["pagina"]) ? $_GET["pagina"] : 1; ?>

        <?php if ($pagina_actual < 20 && $pagina_actual > 1) : ?>
            <button><a href="/storage?pagina=<?php echo htmlspecialchars($pagina_actual - 1); ?>">←Anterior</a></button>
        <?php endif; ?>

        <div>
            <?php for ($i = 1; $i < 20; $i++) : ?>
                <button class='me-2'><a href='/storage?pagina=<?php echo $i; ?>' style='text-decoration:none;'><?php echo $i; ?></a></button>
            <?php endfor; ?>
        </div>

        <?php if ($pagina_actual < 20) : ?>
            <button><a href="/storage?pagina=<?php echo htmlspecialchars($pagina_actual + 1); ?>">Siguiente→ </a></button>
        <?php endif; ?>
    </div>
</div>
<script>
    function buscarCaja() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable2");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
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



    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable2");
        switching = true;
        // Seleccionar una direccion a ordenar: asc:
        dir = "asc";
        /* Loop hasta que el switch se apague */
        while (switching) {
            // iniciando el validador en false para el bucle
            switching = false;
            rows = table.rows;
            /*Se busca en todas las filas de las tablas exepto en la priemera que es la thead o cabezera */
            for (i = 1; i < (rows.length - 1); i++) {
                // Se inicializa el switch apagado nuevamente
                shouldSwitch = false;
                /* Se recojen los elementos a comparar para ir iterando */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* se valida la direccion de ordenamiento de las tablas segun asc o desc */
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        //Se activa el switch y se apaga el bucle con el ordenamiento finalizado
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount++;
            } else {
                /* If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>

<?php require_once "views/includes/footer.template.php"; ?>