<?php
require "views/includes/navbar.user.php";
?>
<style>
    .myInput {
        /* Add a search icon to input */
        background-position: 10px 12px;
        /* Position the search icon */
        background-repeat: no-repeat;
        /* Do not repeat the icon image */
        width: 25%;
        margin-right: 3rem;
        /* Full-width */
        font-size: 12px;
        /* Increase font-size */
        padding: 12px 20px 12px 15px;
        /* Add some padding */
        border: 1px solid #ddd;
        /* Add a grey border */
        margin-bottom: 12px;
        /* Add some space below the input */
    }
</style>

<span class="h3">
    <?php if (!empty($this->datos) && isset($this->datos["success"])) : ?>

        <div class="alert alert-success alert-dismissible d-flex justify-content-center mx-auto" style="width: 100%;">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" fill="currentColor" class="bi bi-information-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <p class="ps-4 font-monospace">
                <strong><?php $this->showMessages(); ?></strong>
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

    <?php elseif (!empty($this->datos) && isset($this->datos["error"])) : ?>
        <div class="alert alert-danger alert-dismissible d-flex justify-content-center mx-auto" style="width: 100%;">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <p class="ps-4 font-monospace">
                <strong><?php $this->showMessages(); ?></strong>
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
</span>


<!--  -->
<!-- Tabla de datos -->
<!--  -->
<div class="d-flex pt-5">

    <div class="container m-3" style="width: 170%;">

        <div class="">
            <div>
                <form class="d-flex pb-1" action="/buscar/alumnoSede" role="search" method="POST" target="_self">
                    <input class="form-control" type="search" placeholder="Buscar Sedes" aria-label="Buscar" name="sede">
                    <input class="btn btn-success ms-1" type="submit" name="btnBuscar" value="Buscar"></input>
                </form>
            </div>
            <div>
                <form class="d-flex pb-1 mb-5" action="/buscar/alumnoCarrera" role="search" method="POST" target="_self">
                    <input class="form-control" type="search" placeholder="Buscar Carreras" aria-label="Buscar" name="carrera">
                    <input class="btn btn-success ms-1" type="submit" name="btnBuscar" value="Buscar"></input>
                </form>
            </div>

            <!--  -->

            <div class="justify-content-md-center">
                <div class="d-flex justify-content-center">
                    <input class="myInput" type="text" id="myInput" onkeyup="buscarDatoCodigo();" placeholder="Buscar por documento">
                    <input class="myInput" type="text" id="myInput2" onkeyup="buscarDatoRut();" placeholder="Buscar por RUT">
                    <input class="myInput" type="text" id="myInput3" onkeyup="buscarDatoNom();" placeholder="Buscar por nombre">
                </div>
                <table id="myTable2" class="table table-success table-striped table-hover table-bordered border-primary">

                    <tr>
                        <th>Nro Documento</th>
                        <th>Rut</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Sede</th>
                        <th>Carrera</th>
                    </tr>
                    
                    <?php if (isset($d) && isset($_POST["sede"])) : ?>
                        <?php foreach ($d as  $alumno) : ?>
                            <tr>
                                <td> <?php echo $alumno->getCodigo(); ?></td>
                                <td> <?php echo $alumno->getRut(); ?></td>
                                <td> <?php echo $alumno->getNombres(); ?></td>
                                <td> <?php echo $alumno->getApellidos(); ?></td>
                                <td> <?php echo $alumno->getSede(); ?></td>
                                <td> <?php echo $alumno->getCarrera(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php elseif (isset($d) && isset($_POST["carrera"])) : ?>
                        <?php foreach ($d as  $alumno) : ?>
                            <tr>
                                <td> <?php echo $alumno->getCodigo(); ?></td>
                                <td> <?php echo $alumno->getRut(); ?></td>
                                <td> <?php echo $alumno->getNombres(); ?></td>
                                <td> <?php echo $alumno->getApellidos(); ?></td>
                                <td> <?php echo $alumno->getSede(); ?></td>
                                <td> <?php echo $alumno->getCarrera(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td>No hay datos</td>
                            <td>No hay datos</td>
                            <td>No hay datos</td>
                            <td>No hay datos</td>
                            <td>No hay datos</td>
                            <td>No hay datos</td>
                        </tr>
                    <?php endif; ?>
                </table>

            </div>

        </div>
    </div>

    <!--  -->
    <div class="container me-5">
        <div class="mx-auto rounded border-bottom border-end" style="width: 22rem;">

            <img src="https://www.svgrepo.com/show/281692/id-card.svg" height="250px;" class="card-img-top m-3" alt="carta alumno">

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