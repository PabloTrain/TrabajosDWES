<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subir fichero</title>
</head>
<body>
  <h1>Subir fichero</h1>

  <form action="?method=subirFichero" method="post" enctype="multipart/form-data">
  
    Añadir imagen: <input name="archivo" id="archivo" type="file"/>
    <input type="submit" name="subir" value="Subir imagen"/>
    <p><?= $resultadoSubirFichero ?></p>

  </form> 

  <br><a href='?method=home'>Volver al home</a>
</body>
</html>