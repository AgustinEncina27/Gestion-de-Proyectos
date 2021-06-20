<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Menu Principal</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <a href="/VS CDE PHP">Cerrar Sesión</a>
    </header>
    <h1>Bienvenido</h1>
    <input type="submit" value="Buscar Proyecto" onclick="window.location.href='buscarProyecto.php'">
    <input type="submit" value="Proyectos terminados" onclick="window.location.href='listarTerminados.php'">
    <input type="submit" value="Proyectos en curso" onclick="window.location.href='proyectosEnCurso.php'">
    <input type="submit" value="Proyectos retrasados" onclick="window.location.href='proyectosAtrasados.php'">
    <input type="submit" value="Finalizar Item" onclick="window.location.href='finalizarItem.php'">
    
</body>

</html>