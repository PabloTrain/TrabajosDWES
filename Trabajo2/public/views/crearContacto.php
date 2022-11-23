<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear contacto</title>
</head>
<body>
  <h1>Crear contacto nuevo</h1>
  <h2>Personas</h2>
  <form action="?method=crearPersona" method="post">
    <p>
      <label for="">Nombre</label>
      <input type="text" name="nombre">
    </p> 
    <p> 
      <label for="">Apellidos</label>
      <input type="text" name="apellidos">
    </p> 
    <p>
      <label for="">Dirección</label>
      <input type="text" name="direccion">
    </p>
    <p>
      <label for="">Telefono</label>
      <input type="number" name="telefono" min="111111111" max="999999999">
    </p>

    <input type="submit" name="anyadirPersona" value="Añadir Persona">
    <p><?= $mensajeAnyadirPersona?></p>
  </form>

  <hr>
  <h2>Empresas</h2>
  <form action="?method=crearEmpresa" method="post">
    <p>
      <label for="">Nombre de la empresa</label>
      <input type="text" name="nombre">
    </p> 
    <p>
        <label for="">Dirección</label>
      <input type="text" name="direccion">
    </p>
    <p>
      <label for="">Telefono</label>
      <input type="number" name="telefono" min="111111111" max="999999999">
    </p>
    <p>
      <label for="">Email</label>
      <input type="email" name="email">
    </p>

    <input type="submit" name="anyadirEmpresa" value="Añadir Empresa">
    <p><?= $mensajeAnyadirEmpresa?></p>
  </form>

  <br><a href="?method=home">Volver al home</a>
</body>
</html>