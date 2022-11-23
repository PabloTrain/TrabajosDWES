<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Borrar contacto</title>
</head>
<body>
  <h1>Borrar contacto</h1>
  <h2>Personas</h2>
  <form action="?method=borrarPersona" method="post">
  <p>Introduce el nombre y apellidos de la persona que quieras borrar.</p>  
    <p>
      <label for="">Nombre</label>
      <input type="text" name="nombre" required>
    </p> 
    <p> 
      <label for="">Apellidos</label>
      <input type="text" name="apellidos" required>
    </p> 

    <input type="submit" name="borrarPersona" value="Borrar Persona">
    <p><?= $mensajeborrarPersona ?></p>
  </form>

  <hr>
  <h2>Empresas</h2>
  <form action="?method=borrarEmpresa" method="post">
    <p>Introduce el nombre de la empresa que quieras borrar.</p>     
    <p>
      <label for="">Nombre de la empresa</label>
      <input type="text" name="nombre" required>
    </p> 


    <input type="submit" name="borrarEmpresa" value="Borrar Empresa">
    <p><?= $mensajeBorrarEmpresa ?></p>
  </form>

  <br><a href="?method=home">Volver al home</a>
</body>
</html>