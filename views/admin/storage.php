<?php

require_once "views/includes/navbar.admin.php";

?>

<div class="container mt-5">
    <div class="d-flex">

        <form action="/admin/storage" method="GET">
            <fieldset>
                <legend>Busqueda Caja</legend>
                <label for="">Caja <input type="text" placeholder="Ej: 0001" name="buscarCaja"> </label>
                <button class="btn btn-primary" type="submit">Buscar</button>
            </fieldset>
        </form>
        <form action="/admin/storage" method="GET">
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
            <?php if (isset($d["caja"])) {
                
                $d["objeto"]->buscarCaja();
            } elseif (isset($d["carpeta"])) {
                $d["objeto"]->buscarCarpeta($d["carpeta"]);
            } else {
                $d["objeto"]->tablaHTML();
            } ?>

        </tbody>
    </table>
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