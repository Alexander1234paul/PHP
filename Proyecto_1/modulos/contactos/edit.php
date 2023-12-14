<?php
include("../../conexion.php");

$txtId = null;

if (isset($_GET["id"])) {
    $txtId = $_GET['id'];
    $stm = $conexion->prepare("SELECT * FROM contactos WHERE id=:txtId");
    $stm->bindParam(':txtId', $txtId);
    $stm->execute();
    $registro = $stm->fetch(PDO::FETCH_ASSOC);

    $nombre = $registro['nombre'];
    $telefono = $registro['telefono'];
    $fecha = $registro['fecha'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $txtId = (isset($_POST['txtId']) ? $_POST['txtId'] : "");
    $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : "");
    $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : "");
    $fecha = (isset($_POST['fecha']) ? $_POST['fecha'] : "");

    $stm = $conexion->prepare("UPDATE contactos SET nombre=:nombre, telefono=:telefono, fecha=:fecha WHERE id=:txtId");
    $stm->bindParam(":nombre", $nombre);
    $stm->bindParam(":telefono", $telefono);
    $stm->bindParam(":fecha", $fecha);
    $stm->bindParam(":txtId", $txtId);

    if ($stm->execute()) {
        header("location:index.php");
        exit();
    } else {
        $error_info = $stm->errorInfo();
        echo "Error al actualizar: " . $error_info[2];
    }
}
?>
<?php include("../../template/header.php"); ?>

<form method="post" action="edit.php">
    <div class="modal-body">
        <input type="hidden" name="txtId" value="<?php echo $txtId; ?>" id="txtId">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>">

        <label for="telefono">Telefono</label>
        <input type="text" name="telefono" id="telefono" value="<?php echo isset($telefono) ? $telefono : ''; ?>">

        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" value="<?php echo isset($fecha) ? $fecha : ''; ?>">
    </div>
    <div class="modal-footer">
        <a href="index.php" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
<?php include("../../template/footer.php"); ?>