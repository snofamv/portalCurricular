<?php
require "views/includes/navbar.admin.php";
?>
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
    <div class="container center">
        <div class="row justify-content-md-center">
            <div>

            </div>

            <table class="table table-success table-striped table-hover table-bordered border-primary ">

                <thead class="table-dark">
                    <th>Nro Documento</th>
                    <th>Rut</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Sede</th>
                    <th>Carrera</th>
                    <th>Opciones</th>
                </thead>

                <tbody>
                    <?php foreach ($d as  $alumno) : ?>
                        <tr>
                            <td> <?php echo $alumno->getCodigo(); ?></td>
                            <td> <?php echo $alumno->getRut(); ?></td>
                            <td> <?php echo $alumno->getNombres(); ?></td>
                            <td> <?php echo $alumno->getApellidos(); ?></td>
                            <td> <?php echo $alumno->getCarrera(); ?></td>
                            <td> <?php echo $alumno->getSede(); ?></td>
                            <td>
                                <form action="/lista/modificarAlumno" method="post">
                                    <input type="text" name="rut" id="rut" value="<?php echo $alumno->getRut(); ?>" hidden>
                                    <input type="submit" value="Modificar" name="btnModificar"></input>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?php
require "views/includes/footer.template.php";
?>