<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login agenda</title>
</head>
<body>
  <h1>Formulario de inico de sesión</h1>
  <form action="?method=auth" method="post">
    <p>
      <label for="">Nombre</label>
      <input type="text" name="nombre">
    </p>
    <p>
      <label for="">Contraseña</label>
      <input type="password" name="password">
    </p>
    <p><?= $mensajeError?></p>
    <input type="submit" name="iniciarsesion" value="Iniciar sesión">
  </form>
</body>
</html>