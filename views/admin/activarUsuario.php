<?php
require "views/includes/navbar.admin.php";

?>

<!-- CONTENIDO DE LA VISTA -->
<div class="container mx-auto mt-3 mb-5 text-center">
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
    </span>


    <div class="container">
        <div class="row">

            <table id="myTable2" class="table table-success table-striped table-hover table-bordered border-primary">

                <thead class="table-dark">
                    <th>ID Usuario <button id="orderCodigo" onclick="sortTable(0)">↓</button></th>
                    <th>Usuario <button id="orderRut" onclick="sortTable(1)">↓</button></th>
                    <th>Estado <button id="orderNom" onclick="sortTable(2)">↓</button></th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <?php if (isset($d["usuarios"])) : ?>
                        <?php foreach ($d["usuarios"] as  $usuario) : ?>
                            <tr class="tablaItem">
                                <td> <?php echo $usuario->getId(); ?></td>
                                <td> <?php echo $usuario->getUsuario(); ?></td>
                                <td> <?php echo $usuario->getEstado() == TRUE ? "Activado" : "Desactivado" ?></td>
                                <td>
                                    <?php if ($usuario->getEstado() == TRUE) : ?>
                                        <form action="/admin/desactivar" method="GET">
                                            <input type="boolval" name="estado" value="<?php echo 0; ?>" hidden>
                                            <input type="text" name="usuario" value="<?php echo $usuario->getUsuario() ?>" hidden>
                                            <input type="submit" value="Desactivar"></input>
                                        </form>
                                    <?php else : ?>
                                        <form action="/admin/activar" method="GET">
                                            <input type="boolval" name="estado" value="<?php echo 1; ?>" hidden>
                                            <input type="text" name="usuario" value="<?php echo $usuario->getUsuario(); ?>" hidden>
                                            <input type="submit" value="Activar"></input>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr class="tablaItem">
                            <td> <?php echo "No hay datos"; ?></td>
                            <td> <?php echo "No hay datos"; ?></td>
                            <td> <?php echo "No hay datos"; ?></td>
                            <td> <?php echo "No hay datos"; ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>


</div>

<?php
require "views/includes/footer.template.php";
?>