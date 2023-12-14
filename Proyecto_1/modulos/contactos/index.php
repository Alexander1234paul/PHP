<?php
include("../../conexion.php");
$stm = $conexion->prepare("select * from contactos");
$stm->execute();
$contactos = $stm->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET["id"])) { // Use GET array for ID retrieval
    $txtId = $_GET['id']; // Retrieve ID from GET array directly
    // echo $txtId; // Optional: used for testing/debugging

    $stm = $conexion->prepare("DELETE FROM contactos where id=:txtId");
    $stm->bindParam(':txtId', $txtId);
    $stm->execute();
    header("location:index.php");
}


?>

<?php include("../../template/header.php"); ?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
    Nuevo
</button>
<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contactos as $contacto) { ?>
                <tr>
                    <td><?php echo $contacto['id']; ?></td>
                    <td><?php echo $contacto['nombre']; ?></td>
                    <td><?php echo $contacto['telefono']; ?></td>
                    <td><?php echo $contacto['fecha']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $contacto['id']; ?>" class="btn btn-success">Editar</a>
                        <a href="index.php?id=<?php echo $contacto['id']; ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include("create.php"); ?>
<?php include("../../template/footer.php"); ?>