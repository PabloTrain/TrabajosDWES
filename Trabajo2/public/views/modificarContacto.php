<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar contacto</title>
</head>
<body>
  <h1>Modificar contacto</h1>
  <h2>Personas</h2>
  <form action="?method=modificarPersona" method="post">

  <p>Introduce el nombre y apellidos de la persona que quieras modificar.</p>  
    <p>
      <label for="">Nombre</label>
      <input type="text" name="nombre" required>
    </p> 
    <p> 
      <label for="">Apellidos</label>
      <input type="text" name="apellidos" required>
    </p>
    <br>
    <p>Introduce los datos nuevos del usuario.</p>  
    <p>
      <label for="">Nombre</label>
      <input type="text" name="nombreNuevo" required>
    </p> 
    <p> 
      <label for="">Apellidos</label>
      <input type="text" name="apellidosNuevos" required>
    </p> 
    <p>
      <label for="">Dirección</label>
      <input type="text" name="direccionNueva" required>
    </p>
    <p>
      <label for="">Telefono</label>
      <input type="number" name="telefonoNuevo" min="111111111" max="999999999" required>
    </p>
    <p><?= $resultadoModificarPersona ?></p>
    <input type="submit" name="modificarPersona" value="Modificar Persona">
  </form>

  <hr>
  <h2>Empresas</h2>
  <form action="?method=modificarEmpresa" method="post">
  <p>Introduce el nombre de la empresa que quieras modificar.</p>     
    <p>
      <label for="">Nombre de la empresa</label>
      <input type="text" name="nombre" required>
    </p> 

  <br>
  <p>Introduce los datos nuevos de la empresa.</p>  
    <p>
      <label for="">Nombre de la empresa</label>
      <input type="text" name="nombreNuevo" required>
    </p> 
    <p>
        <label for="">Dirección</label>
      <input type="text" name="direccionNueva" required>
    </p>
    <p>
      <label for="">Telefono</label>
      <input type="number" name="telefonoNuevo" min="111111111" max="999999999" required>
    </p>
    <p>
      <label for="">Email</label>
      <input type="email" name="emailNuevo" required>
    </p>
    <p><?= $resultadoModificarEmpresa ?></p>
    <input type="submit" name="modificarEmpresa" value="Modificar Empresa" required>

  <br><br><a href="?method=home">Volver al home</a>
</body>
</html>