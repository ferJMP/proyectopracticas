<?php
include "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])) {
    $alert = '<div class="alert alert-primary" role="alert">
                     Todo los campos son obligatorios </div>';
  } else {
    $idusuario = $_GET['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $rol = $_POST['rol'];

    $sql_update = mysqli_query($conexion, "UPDATE usuario SET nombre = '$nombre', correo = '$correo' , usuario = '$usuario', rol = $rol WHERE idusuario = $idusuario");
    $alert =  '<div class="alert alert-primary" role="alert">
                           Usuario Actualizado</div>';
  }
}

// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_usuarios.php");
}
$idusuario = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = $idusuario");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_usuarios.php");
} else {
  if ($data = mysqli_fetch_array($sql)) {
    $idcliente = $data['idusuario'];
    $nombre = $data['nombre'];
    $correo = $data['correo'];
    $usuario = $data['usuario'];
    $rol = $data['rol'];
  }
}
?>


<!-- Begin Page Content -->
<div class="container-fluid">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i>PANEL EDITAR USUARIOS</i></h1>
        <a href="lista_usuarios.php" class="btn btn-primary">Lista Usuarios</a>
      </div>
  <div class="row">
    <div class="col-lg-6 m-auto">
            <div class="card-header bg-primary text-white">
                MODIFICAR USUARIO
            </div>
    <div class="card">
      <form action="" method="post" class="card-body p-2">
        <?php echo isset($alert) ? $alert : ''; ?>
        <input type="hidden" name="id" value="<?php echo $idusuario; ?>">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" placeholder="Ingrese nombre" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>">

        </div>
        <div class="form-group">
          <label for="correo">Correo</label>
          <input type="text" placeholder="Ingrese correo" class="form-control" name="correo" id="correo" value="<?php echo $correo; ?>">

        </div>
        <div class="form-group">
          <label for="usuario">Usuario</label>
          <input type="text" placeholder="Ingrese usuario" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario; ?>">

        </div>
        <div class="form-group">
          <label for="rol">Rol</label>
          <select name="rol" id="rol" class="form-control">
            <option value="1" <?php
                              if ($rol == 1) {
                                echo "selected";
                              }
                              ?>>Administrador</option>
            <option value="2" <?php
                              if ($rol == 2) {
                                echo "selected";
                              }
                              ?>>Asesor</option>
            <option value="3" <?php
                              if ($rol == 3) {
                                echo "selected";
                              }
                              ?>>Supervisor</option>
          </select>
        </div>
        </div>
                            </br>
        <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Editar Usuario</button>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
                            </br>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>