<?php
class App{

    //Método main que llamamos desde el index
    public function run(){
        if (isset($_GET["method"])) {
            //recoge el método
            $method = $_GET["method"];
        } else {
            //Se carga el método login por defecto
            $method = "login";
        }
        //Nos lleva al método
        $this->$method();      
    }

    //Función para mostrar el formulario de iniciar sesión
    public function login(){
        //Crea una sesion si no esta creada o se una a una si ya esta creada
        session_start();
        //Si ya existe la sesion con el nombre de usuario nos lleva al método home
        if (isset($_SESSION["usuario"])) {
        header("Location: ?method=home");
        
        }else{
        //Si no existe la sesion con el nombre de usuario, 
        //nos muestra el formulario e inicio de sesión
        include('views/login.php');
        }
    }

    //Método para comprobar credenciales con la base de datos
    public function auth(){
        //Recoge el nombre y la contraseña
        if (isset($_POST["nombre"]) && isset($_POST["password"])) {
            $nombre = $_POST["nombre"];
            $password = $_POST["password"];
            $mensajeError = "";
        }else{
        header("Location: ?method=login");
        }
        //Añade el archivo que contiene información necesaria para conectar con la base de datos
        require "../bbddcon.php";

        //Formula el SQl filtrando por el usuario
        $sql = "SELECT usuario, password from credenciales WHERE usuario = '" . $nombre . "'";
        $registros = $bd->query($sql);
        //Comprueba si devuelve resultados
        if($registros->rowCount()>0){

            foreach ($registros as $fila){
                //Recupera la contraseña de la base de datos
                $passwordbd = $fila["password"];

                //Verifica la contraseña introducida con la contraseña encriptada que recupera de la base de datos
                if(password_verify($password, $passwordbd)){
                    //Crea una sesion si no esta creada o se una a una si ya esta creada
                    session_start();
                    //Crea la sesión y redirige al método home
                    $_SESSION["usuario"] = $nombre;
                    header("Location: ?method=home");
                }else{
                    $mensajeError = "Credenciales no válidas.";
                    //Incluye la vista
                    include('views/login.php');
                }
            }
        //Muestra mensaje de error si las credenciales no son válidas
        }else{
            $mensajeError = "Credenciales no válidas.";
            //Incluye la vista
            include('views/login.php');
        }
    }

    //Función home incluye la vista de la lista si existe la sesion nombre
    //Si no existe te redirige al login
    public function home(){
        //Crea una sesion si no esta creada o se una a una si ya esta creada
        session_start();
        //Comprueba si existe la sesion usuario, si no existe te reenvia al login
        if (!isset($_SESSION["usuario"])) {
            header("Location: ?method=login");
        }
        //Incluye la vista de inicio
        include("views/home.php");
    }

    //Método para mostrar la vista de crear contacto
    public function crearContacto(){
        include("views/crearContacto.php");
    }

    //Método para crear una persona nueva
    public function crearPersona(){
        $mensajeAnyadirPersona = "";
        //Comprueba que haya pulsado el botón
        if(isset($_POST["anyadirPersona"])){
            //Añade el archivo que contiene información necesaria para conectar con la base de datos
            require "../bbddcon.php";
            //recupera la información del formulario
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];

            //Formula el SQl insertando la persona
            $sql = "INSERT INTO `persona`(`nombre`, `apellidos`, `direccion`, `telefono`) VALUES ('" . $nombre . "','" . $apellidos ."','" . $direccion . "','" . $telefono . "')";

            //Carga un mensaje distinto si se ha podido añadir o no
            if($bd->query($sql) == true){
                $mensajeAnyadirPersona = "Has añadido una persona con éxito.";
            }else{
                $mensajeAnyadirPersona = "No se ha podido añadir la persona.";
            }
        }
    //Incluye la vista
        include("views/crearContacto.php");
    }

    //Método para crear una empresa nueva
    public function crearEmpresa(){
        $mensajeAnyadirEmpresa = "";
        //Comprueba que haya pulsado el botón
        if(isset($_POST["anyadirEmpresa"])){
            //Añade el archivo que contiene información necesaria para conectar con la base de datos
            require "../bbddcon.php";
            //Recupera la información del formulario
            $nombre = $_POST["nombre"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];
            $email = $_POST["email"];

            //Formula el SQl insertando la empresa
            $sql = "INSERT INTO `empresa`(`nombre`, `direccion`, `telefono`, `email`) VALUES ('". $nombre . "','" . $direccion . "','" . $telefono . "','" . $email . "')";
            
            //Carga un mensaje distinto si se ha podido añadir o no
            if($bd->query($sql) == true){
                $mensajeAnyadirEmpresa = "Has añadido una empresa con éxito.";
            }else{
                $mensajeAnyadirEmpresa = "No se ha podido añadir la empresa.";
            }
        }
        //Incluye la vista
        include("views/crearContacto.php");
    }

    //Método para mostrar la vista de borrar contacto
    public function borrarContacto(){
        include("views/borrarContacto.php");
    }

    //Método para borrar una persona específica 
    public function borrarPersona(){
        $mensajeborrarPersona = "";  
        //Comprueba que haya pulsado el botón
        if(isset($_POST["borrarPersona"])){
            //Añade el archivo que contiene información necesaria para conectar con la base de datos
            require "../bbddcon.php";

            //Recupera la información del formulario
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];

            //Formula el SQl buscando a la persona específica
            $sqlBuscar = "SELECT `nombre`, `apellidos`, `direccion`, `telefono` FROM `persona` WHERE `nombre` = '" . $nombre . "'  && `apellidos` = '" . $apellidos . "'";
            $registros = $bd->query($sqlBuscar);
            //Comprueba si devuelve alguna fila
            if($registros->rowCount()>0){
                //Si encuentra crea SQL para borrar
                $sql = "DELETE FROM `persona` WHERE `nombre` = '" . $nombre ."' && `apellidos` = '" . $apellidos ."'";
                $bd->query($sql);
                $mensajeborrarPersona = "Persona borrada con éxito.";
            }else{
                //Si no encuentra guarda mensaje
                $mensajeborrarPersona = "Persona no encontrada, no se ha podido borrar.";
            }            
        }
        //Incluye la vista
        include("views/borrarContacto.php");
    }

    //Método para borrar una empresa específica
    public function borrarEmpresa(){
        $mensajeBorrarEmpresa = "";
        //Comprueba que haya pulsado el botón
        if(isset($_POST["borrarEmpresa"])){
            //Añade el archivo que contiene información necesaria para conectar con la base de datos
            require "../bbddcon.php";

            //Recupera la información del formulario
            $nombre = $_POST["nombre"];

            //Formula el SQl buscando a la empresa específica
            $sqlBuscar = "SELECT `nombre`, `direccion`, `telefono`, `email` FROM `empresa` WHERE `nombre` = '" . $nombre . "'";
            $registros = $bd->query($sqlBuscar);
            //Comprueba si devuelve alguna fila
            if($registros->rowCount()>0){
                //Si encuentra crea SQL para borrar
                $sql = "DELETE FROM `empresa` WHERE `nombre` = '" . $nombre . "'" ;
                $bd->query($sql);
                $mensajeBorrarEmpresa = "Empresa borrada con éxito.";
            }else{
                //Si no encuentra guarda mensaje
                $mensajeBorrarEmpresa = "Empresa no encontrada, no se ha podido borrar.";
            }
            
        }
        //Incluye la vista
        include("views/borrarContacto.php");
    }
    //Método para mostrar la vista de buscar contacto
    public function buscarContacto(){
        include("views/buscarContacto.php");
    }

    //Método para buscar una persona específica
    public function buscarPersona(){
        //Comprueba que haya pulsado el botón  
        if(isset($_POST["buscarPersona"])){
            //Añade el archivo que contiene información necesaria para conectar con la base de datos
            require "../bbddcon.php";

            //Recupera la información del formulario
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];

            //Formula el SQl buscando a la persona específica
            $sql = "SELECT `nombre`, `apellidos`, `direccion`, `telefono` FROM `persona` WHERE `nombre` = '" . $nombre . "'  && `apellidos` = '" . $apellidos . "'";
            $registros = $bd->query($sql);
            //Comprueba si devuelve alguna fila
            if($registros->rowCount()>0){
                foreach ($registros as $fila){
                    //mensaje con la información de la persona
                    $resultadoBuscarContacto = "<br>Nombre: " . $fila["nombre"]. " ,apellidos: " . $fila["apellidos"] . " ,dirección: " . $fila["direccion"] . " ,telefono: " . $fila["telefono"] . ".";
                }
            }else{
                //Si no encuentra guarda mensaje
                $resultadoBuscarContacto = "<br>No se ha encontrado el contacto.";
            }
        }
        //Incluye la vista
        include("views/buscarContacto.php");
    }

    //Método para buscar una empresa específica
    public function buscarEmpresa(){
        //Comprueba que haya pulsado el botón
        if(isset($_POST["buscarEmpresa"])){
            //Añade el archivo que contiene información necesaria para conectar con la base de datos
            require "../bbddcon.php";

            //Recupera la información del formulario
            $nombre = $_POST["nombre"];

            //Formula el SQl buscando a la empresa específica
            $sql = "SELECT `nombre`, `direccion`, `telefono`, `email` FROM `empresa` WHERE `nombre` = '" . $nombre . "'";
            $registros = $bd->query($sql);
            //Comprueba si devuelve alguna fila
            if($registros->rowCount()>0){
                foreach ($registros as $fila){
                    //Mensaje con la información de la empresa
                    $resultadoBuscarEmpresa = "<br>Nombre: " . $fila["nombre"]. " ,dirección: " . $fila["direccion"] . " ,telefono: " . $fila["telefono"] . " ,email: " . $fila["email"] . ".";
                }
            
            }else{
                //Si no encuentra guarda mensaje
                $resultadoBuscarEmpresa = "<br>No se ha encontrado el contacto.";
            } 
        }
        //Incluye la vista
        include("views/buscarContacto.php");
    }

    //Método para mostrar todos los contactos de las tablas de base de datos agenda
    public function mostrarTodosContactos(){
        //Añade el archivo que contiene información necesaria para conectar con la base de datos
        require "../bbddcon.php";
        //Incluye la vista
        include("views/mostrarTodosContactos.php");
    }
  
    //Método para mostrar la vista de modificar contacto
    public function modificarContacto(){
        include("views/modificarContacto.php");
    }

    //Método para modificar una persona
    public function modificarPersona(){
        //Comprueba que haya pulsado el botón
        if(isset($_POST["modificarPersona"])){
            //Añade el archivo que contiene información necesaria para conectar con la base de datos
            require "../bbddcon.php";

            //Recupera la información del formulario
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];

            $nombreNuevo = $_POST["nombreNuevo"];
            $apellidosNuevos = $_POST["apellidosNuevos"];
            $direccionNueva = $_POST["direccionNueva"];
            $telefonoNuevo = $_POST["telefonoNuevo"];

            //Formula el SQl buscando a la persona específica
            $sqlBusqueda = "SELECT `nombre`, `apellidos`, `direccion`, `telefono` FROM `persona` WHERE `nombre` = '" . $nombre . "'  && `apellidos` = '" . $apellidos . "'";
            $registros = $bd->query($sqlBusqueda);
            //Comprueba si devuelve alguna fila
            if($registros->rowCount()>0){
                //SQL para actualiza la persona
                $sql = "UPDATE `persona` SET `nombre`='" . $nombreNuevo ."',`apellidos`='" . $apellidosNuevos ."',`direccion`='" . $direccionNueva ."',`telefono`='" . $telefonoNuevo . "' WHERE `nombre` = '" . $nombre . "'  && `apellidos` = '" . $apellidos . "'";
                $bd->query($sql);
                $resultadoModificarPersona = "<br>Persona modificada con éxito.";
            
            }else{
                //Si no encuentra guarda mensaje
                $resultadoModificarPersona = "<br>No se ha encontrado la persona agendada.";
            }
        }
        //Incluye la vista
        include("views/modificarContacto.php");
    }

    //Método para modificar una empresa
    public function modificarEmpresa(){
        //Comprueba que haya pulsado el botón
        if(isset($_POST["modificarEmpresa"])){
            //Añade el archivo que contiene información necesaria para conectar con la base de datos
            require "../bbddcon.php";

            //Recupera la información del formulario
            $nombre = $_POST["nombre"];

            $nombreNuevo = $_POST["nombreNuevo"];
            $direccionNueva = $_POST["direccionNueva"];
            $telefonoNuevo = $_POST["telefonoNuevo"];
            $emailNuevo = $_POST["emailNuevo"];

            //Formula el SQl buscando a la empresa específica
            $sqlBuscar = "SELECT `nombre`, `direccion`, `telefono`, `email` FROM `empresa` WHERE `nombre` = '" . $nombre . "'";
            $registros = $bd->query($sqlBuscar);
            //Comprueba si devuelve alguna fila
            if($registros->rowCount()>0){
                //SQL para actualizar la empresa
                $sql = "UPDATE `empresa` SET `nombre`='" . $nombreNuevo ."',`direccion`='" . $direccionNueva ."',`telefono`='" . $telefonoNuevo ."',`email`='" . $emailNuevo . "' WHERE `nombre` ='" . $nombre ."'";
                $bd->query($sql);
                $resultadoModificarEmpresa = "<br>Empresa modificada con éxito.";
            
            }else{
                //Si no encuentra guarda mensaje
                $resultadoModificarEmpresa = "<br>No se ha encontrado la empresa agendada.";
            } 
        }
        //Incluye la vista
        include("views/modificarContacto.php");
    }

    //Método para subir ficheros a la carpeta uploads.
    public function subirFichero(){
        //Comprueba que haya pulsado el botón
        if (isset($_POST['subir'])) {
            //Guarda el nombre del archivo seleccionado
            $nombre=$_FILES['archivo']['name'];
            $guardado=$_FILES["archivo"]["tmp_name"];

            //Recoge el tamaño del archivo seleccionado
            $tamanyo = $_FILES["arhivo"]["size"];

            //Guarda en el array laa extensiones permitida
            $permitidos = array("png", "jpg", "pdf");
            //Divide el nombre
            $arrayArchivo = explode(".", $nombre);
            //Recogemos el tipo de fichero que es -> xml, pdf, html...
            $extension = strtolower(end($arrayArchivo));

            //Comprobamos si es una extensión permitida
            if(in_array($extension, $permitidos)){

                //COmprobamos si el tamaño es válido
                if(($tamanyo < 5000)){
            
                    //Subimos el fichero a la carpeta que queremos
                    if(move_uploaded_file($guardado, "uploads/" . $nombre)){
                        $resultadoSubirFichero = "<br>Archivo subido con éxito.";
                        
                    }else{
                        //Mensaje al subir el fichero
                        $resultadoSubirFichero =  "<br>No se ha podido subir el archivo.";
                    }
                }else{
                    //Mensaje si supera 5MB
                    $resultadoSubirFichero =  "<br>Tamaño superior al admitido, máximo 5MB.";
                }
                
            }else{
                //Mensaje si no es png, jpg o pdf
                $resultadoSubirFichero =  "<br>Extensión no permitida, solo se permite png, jpg o pdf.";
            } 
        }
        //Incluye la vista
        include("views/subirFichero.php");
    }

    //Método para insertar los datos del xml
    public function importarDatosXML(){
        //Incluye el fichero xml  
        include("views/importarDatosXML.php");
        //Añade el archivo que contiene información necesaria para conectar con la base de datos
        require "../bbddcon.php";
        //Carga el fichero xml
        $xml = simplexml_load_file("agenda.xml");
        //Toma la ruta contacto
        $contacto = $xml->xpath("//contacto");

        //lo recorre
        foreach($contacto as $contact){
            //Carga todos los atributos
            $atributes = $contact->attributes();
            //Filtra por el tipo
            if($atributes["tipo"] == "persona"){
                //Guarda los datos del xml
                $nombreContacto = $contact->nombre;
                $apellidosContacto = $contact->apellidos;
                $direccionContacto = $contact->direccion;
                $telefonoContacto = $contact->telefono;
            
                //SQL
                $sql = "INSERT INTO `persona`(`nombre`, `apellidos`, `direccion`, `telefono`) VALUES ('" . $nombreContacto . "','" . $apellidosContacto ."','" . $direccionContacto . "','" . $telefonoContacto . "')";
                
                //Comprueba si se ha podido realizar
                if($bd->query($sql) == true){
                    echo "<br>Persona añadida con éxito";
                }else{
                    echo "<br>Error al añadir una persona";
                }
                
            //Filtra por el tipo    
            }else if($atributes["tipo"] == "empresa"){
                //Guarda los datos del xml
                $nombreEmpresa = $contact->nombre;
                $direccionEmpresa = $contact->direccion;
                $telefonoEmpresa = $contact->telefono;
                $emailEmpresa = $contact->email;
                
                //SQL
                $sql = "INSERT INTO `empresa`(`nombre`, `direccion`, `telefono`, `email`) VALUES ('". $nombreEmpresa . "','" . $direccionEmpresa . "','" . $telefonoEmpresa . "','" . $emailEmpresa . "')";
                
                //Comprueba si se ha podido realizar
                if($bd->query($sql) == true){
                    echo "<br>Empresa añadida con éxito";
                }else{
                    echo "<br>Error al añadir una empresa";
                }
                
            }
        }
        //Imprime el botón para volver al home
        echo "<br><br><a href='?method=home'>Volver al home</a>";
    }

    //Método para cerrar sesión
    public function cerrarSesion(){
        //Crea una sesion si no esta creada o se una a una si ya esta creada
        session_start();

        //Caduca la sesion del usuario de inicio de sesión  
        $_SESSION = array();//Asigna la sesión a un array vacío
        session_destroy();//Destruimos
        setcookie(session_name(), "", time()-7200);//caducamos
        //Redirige a la página de inicio
        header("Location: ?method=home");
    }

}