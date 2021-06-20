<?php
session_start();
require 'database.php';
if ((!empty($_POST['user']) && !empty($_POST['password']))) {
  $sql = "SELECT dni,usuario,contrasenia FROM TPBD_PARTICIPANTES WHERE usuario=:didbv AND contrasenia=:didbv2";
  $unir = oci_parse($Oracle, $sql);
  $didbv = $_POST['user'];
  $didbv2 = $_POST['password'];
  oci_bind_by_name($unir, ':didbv', $didbv);
  oci_bind_by_name($unir, ':didbv2', $didbv2);
  oci_execute($unir);
  if (($row = oci_fetch_array($unir, OCI_ASSOC)) != false) {
    $_SESSION['usuario_id'] = $row['DNI'];
    header("Location: /principal.php");
  } else {
    $message = 'El nombre de usuario o la contraseña son incorrectos';
  }
  oci_free_statement($unir);
  require 'cerrarConexion.php';
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <?php require 'partial/header.php' ?>

  <?php if (!empty($message)) : ?>
    <p> <?= $message ?></p>
  <?php endif; ?>

  <h1>Login</h1>

  <form action="login.php" method="POST">
    <input name="user" type="text" placeholder="Coloca el usuario">
    <input name="password" type="password" placeholder="Coloca la contraseña">
    <input type="submit" value="Enviar">
  </form>
</body>

</html>