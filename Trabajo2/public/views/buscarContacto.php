<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buscar contacto</title>
</head>
<body>
  <h1>Buscar contacto</h1>
  <h2>Personas</h2>
  <form action="?method=buscarPersona" method="post">
  <p>Introduce el nombre y apellidos de la persona que quieras buscar.</p>  
    <p>
      <label for="">Nombre</label>
      <input type="text" name="nombre" required>
    </p> 
    <p> 
      <label for="">Apellidos</label>
      <input type="text" name="apellidos" required>
    </p> 

    <input type="submit" name="buscarPersona" value="Buscar Persona">
  </form>
  <p><?= $resultadoBuscarContacto ?></p>
  <hr>
  <h2>Empresas</h2>
  <form action="?method=buscarEmpresa" method="post">
    <p>Introduce el nombre de la empresa que quieras buscar.</p>     
    <p>
      <label for="">Nombre de la empresa</label>
      <input type="text" name="nombre" required>
    </p> 


    <input type="submit" name="buscarEmpresa" value="Buscar Empresa">
  </form>
  <p><?= $resultadoBuscarEmpresa ?></p>
  <br><a href="?method=home">Volver al home</a>
</body>
</html>