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
            echo "<table border='2'";
            echo "<tr>";
                echo "<td>Nombre</td>";
                echo "<td>Apellidos</td>";
                echo "<td>Dirección</td>";
                echo "<td>Telefono</td>";
            echo "</tr>";
            
            foreach ($registros as $fila){
                echo "<tr>";
                    //Muestra todos los datos de la/s persona/s
                    echo "<td>" . $fila["nombre"] . "</td>";
                    echo "<td>" . $fila["apellidos"] . "</td>";
                    echo "<td>" . $fila["direccion"] . "</td>";
                    echo "<td>" . $fila["telefono"] . "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
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
            echo "<table border='2'";
            echo "<tr>";
                echo "<td>Nombre</td>";
                echo "<td>Dirección</td>";
                echo "<td>Telefono</td>";
                echo "<td>Email</td>";
            echo "</tr>";
            foreach ($registros as $fila){
                //Muestra todos los datos de la/s empresa/s
                echo "<tr>";
                    echo "<td>" . $fila["nombre"] . "</td>";
                    echo "<td>" . $fila["direccion"] . "</td>";
                    echo "<td>" . $fila["telefono"] . "</td>";
                    echo "<td>" . $fila["email"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        //Si no hay lo indica
        }else{
            echo "No hay ninguna empresa agendada.";
        } 
    ?>
  
  <br><a href="?method=home">Volver al home</a>
</body>
</html>
