<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Finalizar Proyecto</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <div class="contendor">
            <a href="/principal.php">Menu Principal</a>
            <a href="/VS CDE PHP">Cerrar Sesión</a>
        </div>
    </header>
    <h1>Ingrese el id del proyecto y el id del item</h1>
    <form action="finalizarItem.php" method="POST">
        <input name="nombreProyecto" type="text" placeholder="Ingrese el id del proyecto">
        <input name="idItem" type="text" placeholder="Ingrese el id del Item">
        <input type="submit" value="Buscar">
    </form>

    <?php
    require 'database.php';
    if ((!empty($_POST['nombreProyecto']) && !empty($_POST['idItem']))) {
        $unir = oci_parse($Oracle, 'begin ejercicio6(:nombreProyecto, :idItem); end;');
        $didbv = $_POST['nombreProyecto'];
        $didbv2 = $_POST['idItem'];
        oci_bind_by_name($unir, ':nombreProyecto', $didbv);
        oci_bind_by_name($unir, ':idItem', $didbv2);
        oci_execute($unir);

        oci_free_statement($unir);
        oci_close($Oracle);
    } 
    ?>

    <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?>
</body>

</html>