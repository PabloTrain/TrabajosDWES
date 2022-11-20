<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
</head>
<body>
  <h1>INICIO</h1>
  <h2>Bienvenido <?php echo $_COOKIE["nombre"];?></h2>
  <h4>¿Qué quieres hacer?</h4>
  <ul>
      <a href="?method=crearContacto"><li>Crear contacto</li></a>
      <a href="?method=borrarContacto"><li>Eliminar contacto</li></a>
      <a href="?method=buscarContacto"><li>Buscar un contacto determinado</li></a>
      <a href="?method=mostrarTodosContactos"><li>Mostrar todos los contactos</li></a>
      <a href="?method=modificarContacto"><li>Actualizar un contacto</li></a>
      <a href="?method=importarDatosXML"><li>Importar datos del XML</li></a>
      <a href="?method=subirFichero"><li>Subir fichero con foto</li></a>
  </ul>

  <a href="?method=cerrarSesion"><li>Cerrar sesión</li></a>

</body>
</html>