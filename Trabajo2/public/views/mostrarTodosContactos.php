<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mostrar todos los contacto</title>
</head>
<body>
    <h1>Mostrar contactos de la agenda</h1>
    <h2>Personas</h2>
     
    <?php
        //SQL
        $sql = "SELECT `nombre`, `apellidos`, `direccion`, `telefono` FROM `persona`";
        $registros = $bd->query($sql);
        //Comprueba si hay filas
        if($registros->rowCount()>0){
            //Si hay muestra el número de personas
            echo "Personas agendadas: " . $registros->rowCount() .".<br>";
            foreach ($registros as $fila){
                //Muestra todos los datos de la/s persona/s
                echo "Nombre: " . $fila["nombre"]. " ,apellidos: " . $fila["apellidos"] . " ,dirección: " . $fila["direccion"] . " ,telefono: " . $fila["telefono"] . ".<br>";
            }
        //Si no hay lo indica
        }else{
            echo "No hay ninguna persona agendada.";
        } 
    ?>
    
    <h2>Empresas</h2>

    <?php
        //SQl
        $sql = "SELECT `nombre`, `direccion`, `telefono`, `email` FROM `empresa` ";
        $registros = $bd->query($sql);
        //Comprueba si hay filas
        if($registros->rowCount()>0){
            //Si hay muestra el número de empresas
            echo "Empresas agendadas: " . $registros->rowCount() .".<br>";
            foreach ($registros as $fila){
                //Muestra todos los datos de la/s empresa/s
                echo "Nombre: " . $fila["nombre"]. " ,dirección: " . $fila["direccion"] . " ,telefono: " . $fila["telefono"] . " ,email: " . $fila["email"] . ".<br>";
            }
        //Si no hay lo indica
        }else{
            echo "No hay ninguna empresa agendada.";
        } 
    ?>
  
  <br><a href="?method=home">Volver al home</a>
</body>
</html>