<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Buscar Proyecto</title>
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
    <h1>Ingrese el nombre del proyecto</h1>



    <form action="buscarProyecto.php" method="POST">
        <input name="nombreProyecto" type="text" placeholder="">
        <input type="submit" value="Buscar">
    </form>

    <?php
    require 'database.php';
    if ((!empty($_POST['nombreProyecto']))) {
        $sql = "SELECT pro.nombre,pro.dni ,pro.fecha,eta.descripcion,ESTADOETAPA(etade.id_etapaadesarrollar),it.descripcion,it.dni,est.nombreDeEstado
            from TPBD_PARTICIPANTES par
            inner join TPBD_PROYECTO pro on pro.dni= par.dni
            inner join TPBD_ETAPAADSESARROLLAR etade on etade.id_proyecto=pro.id_proyecto
            inner join TPBD_ETAPA eta on eta.id_etapa=etade.id_etapa
            inner join TPBD_ITEMS it on it.id_etapa=etade.id_etapa and it.id_etapaADesarrollar=etade.id_etapaADesarrollar and it.id_proyecto=etade.id_proyecto
            inner join TPBD_ESTADO est on est.id_estado=it.id_estado where pro.nombre=:didbv";
        $unir = oci_parse($Oracle, $sql);
        $didbv = $_POST['nombreProyecto'];
        oci_bind_by_name($unir, ':didbv', $didbv);
        oci_execute($unir);
        
        if ($hola = oci_fetch_row ($unir)) {
            $message = '';
            print "<table border='1' class='contendor-tabla'> <br>\n";
            print "<tr>\n
                    <td> NOMBRE DEL PROYECTO </td>\n
                    <td> PROPIETARIO DEL PROYECTO </td>\n
                    <td> FECHA DEL PROYECTO </td>\n
                    <td> DESCRIPCION DE LA ETAPA </td>\n
                    <td> ESTADO DE LA ETAPA </td>\n
                    <td> DESCRIPCION DEL ITEM </td>\n
                    <td> RESPONSABLE DEL ITEM </td>\n
                    <td> ESTADO DEL ITEM </td>\n
                   </tr>\n";
        } else {
            $message = 'El nombre del proyecto es incorrecto';
        }
        oci_execute($unir);
        while ($fila = oci_fetch_array($unir, OCI_NUM + OCI_RETURN_NULLS)) {
            print "<tr>\n";
            foreach ($fila as $elemento) {
                print "<td>" . ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") . "</td>\n";
            }
            print "</tr>\n";
        }
        print "</table>\n";

        oci_free_statement($unir);
        require 'cerrarConexion.php';
    }
    ?>

    <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

</body>

</html>