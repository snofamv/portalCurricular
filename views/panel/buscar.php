<?php
    require "views/includes/navbar.admin.php";
    ?>

    <!-- Tabla de datos -->
    <div class="m-2 ">
        <div>
            <h1 class="text-center mb-3">Buscar titulado</h1>
        </div>
        <div class="container">

            <form class="d-flex pb-1" role="search">
                <input class="form-control" type="search" placeholder="Buscar RUT" aria-label="Buscar" name="rut">
                <button class="btn btn-outline-success m-1" type="submit">Buscar</button>
            </form>
            <form class="d-flex pb-1">
                <input class="form-control" type="search" placeholder="Buscar Nombre y apellido" aria-label="Buscar" name="nombres">
                <button class="btn btn-outline-success m-1" type="submit">Buscar</button>
            </form>
            <form class="d-flex pb-1">
                <input class="form-control" type="search" placeholder="Buscar Sedes" aria-label="Buscar" name="sede">
                <button class="btn btn-outline-success m-1" type="submit">Buscar</button>
            </form>
            <form class="d-flex mb-3 pb-1 ">
                <input class="form-control" type="search" placeholder="Buscar Carreras" aria-label="Buscar" name="carrera">
                <button class="btn btn-outline-success m-1" type="submit">Buscar</button>
            </form>
        </div>
        <div class="container center">
            <div class="row justify-content-md-center">

                <table class="table table-success table-striped table-hover table-bordered border-primary ">

                    <tr>
                        <th>Nro Documento</th>
                        <th>Rut</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Sede</th>
                        <th>Carrera</th>
                    </tr>
                    <?php
                    //Lista::renderTablas();
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php
    require "views/includes/footer.template.php";
    ?>
