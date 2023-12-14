<!-- Modal -->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : "");
    $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : "");
    $fecha = (isset($_POST['fecha']) ? $_POST['fecha'] : "");

    $stm = $conexion->prepare("INSERT INTO contactos (id, nombre, telefono, fecha) 
    values (null, :nombre, :telefono, :fecha)");
    $stm->bindParam(":nombre", $nombre);
    $stm->bindParam(":telefono", $telefono);
    $stm->bindParam(":fecha", $fecha);

    if ($stm->execute()) {
        echo "¡Inserción exitosa!";
    } else {
        echo "Error al insertar en la base de datos.";
    }

    header("Location: index.php");
    exit();
}
?>

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AGREGAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">

                <div class="modal-body">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" id="">

                    <label for="">Telefono</label>
                    <input type="text" name="telefono" id="">

                    <label for="">Fecha</label>
                    <input type="date" name="fecha" id="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>