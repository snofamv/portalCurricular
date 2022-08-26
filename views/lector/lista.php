<?php

require "views/includes/navbar.user.php";
?>

<style>
    .myInput {
        background-image: url('/css/searchicon.png');
        /* Add a search icon to input */
        background-position: 10px 12px;
        /* Position the search icon */
        background-repeat: no-repeat;
        /* Do not repeat the icon image */
        width: 20%;
        margin-right: 3rem;
        /* Full-width */
        font-size: 16px;
        /* Increase font-size */
        padding: 12px 20px 12px 40px;
        /* Add some padding */
        border: 1px solid #ddd;
        /* Add a grey border */
        margin-bottom: 12px;
        /* Add some space below the input */
    }
</style>
<!-- Tabla de datos -->
<div class="mt-3 ">

    <div>
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
    </div>
    <div class="container">
        <div class="row">

            <div class="d-flex justify-content-between">
                <input class="myInput" type="text" id="myInput" onkeyup="buscarDatoCodigo();" placeholder="Buscar por documento">
                <input class="myInput" type="text" id="myInput2" onkeyup="buscarDatoRut();" placeholder="Buscar por RUT">
                <input class="myInput" type="text" id="myInput3" onkeyup="buscarDatoNom();" placeholder="Buscar por nombre">
            </div>

            <table id="myTable2" class="table table-success table-striped table-hover table-bordered border-primary">

                <thead class="table-dark">
                    <th>Nro Documento <button id="orderCodigo" onclick="sortTable(0)">↓</button></th>
                    <th>Rut <button id="orderRut" onclick="sortTable(1)">↓</button></th>
                    <th>Nombres <button id="orderNom" onclick="sortTable(2)">↓</button></th>
                    <th>Apellidos <button id="orderApe" onclick="sortTable(3)">↓</button></th>
                    <th>Sede <button id="orderSede" onclick="sortTable(4)">↓</button></th>
                    <th>Carrera <button id="orderCarrera" onclick="sortTable(5)">↓</button></th>
                </thead>
                <tbody>
                    <?php foreach ($d["datos"] as  $alumno) : ?>
                        <tr class="tablaItem">
                            <td> <?php echo $alumno->getPreCodigo() . "-" .$alumno->getCodigo(); ?></td>
                            <td> <?php echo $alumno->getRut(); ?></td>
                            <td> <?php echo $alumno->getNombres(); ?></td>
                            <td> <?php echo $alumno->getApellidos(); ?></td>
                            <td> <?php echo $alumno->getCarrera(); ?></td>
                            <td> <?php echo $alumno->getSede(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-between mb-5">
                <?php $pagina_actual = isset($_GET["pagina"]) ? $_GET["pagina"] : 1; ?>

                <?php if ($pagina_actual < $d["nroDatos"] && $pagina_actual > 1) : ?>
                    <button><a href="/lista?pagina=<?php echo htmlspecialchars($pagina_actual-1); ?>">←Anterior</a></button>
                <?php endif; ?>

                <div>
                    <?php for ($i = 1; $i < $d["nroDatos"]; $i++) : ?>
                        <button class='me-2'><a href='/lista?pagina=<?php echo $i; ?>' style='text-decoration:none;'><?php echo $i; ?></a></button>
                    <?php endfor; ?>
                </div>

                <?php if ($pagina_actual < $d["nroDatos"]-1) : ?>
                    <button><a href="/lista?pagina=<?php echo htmlspecialchars($pagina_actual+1); ?>">Siguiente→ </a></button>
                <?php endif ;?>
            </div>
        </div>
    </div>
</div>


<script>
    function buscarDatoCodigo() {
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

    function buscarDatoRut() {
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

    function buscarDatoNom() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput3");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable2");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
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
<?php
require "views/includes/footer.template.php";
?>
