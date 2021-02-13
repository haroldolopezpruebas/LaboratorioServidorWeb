<?php

// Modelo de usuario
class User {

    // Atributos del usuario
    private $user;
    private $password;

    // Constructor para iniciar valores del modelo
    public function __construct($user,$password) {
        $this->user = $user;
        $this->password = $password;
    }

    // Función utilizada para validar las credenciales y hacer login
    public function revCredenciales(){

        // Se inicializa la base de datos
        $con = DataBase::init();

        // Se realiza la consulta para obtener la contraseña almacenada
        $query = "SELECT password FROM user WHERE usuario LIKE ?";
        
        // Variable temporal para buscar contraseña del usuario
        $flag = false;

        // Si la consulta es posible se realiza
        if ($stmt = $con->prepare($query)) {
            // Se hace una inserción del nombre de usuario en la consulta
            $stmt->bind_param("s",$this->user);
            $stmt->execute();
            $result = $stmt->get_result();
            // Se obtiene el usuario a verificar si existe
            $usuario = $result->fetch_assoc();
            if($usuario) {
                // Se utiliza la función password_verify para verificar si el 
                // password ingresado es correcto
                if(password_verify($this->password,$usuario["password"])){
                    // Si la contraseña es correcta la bandera se hace verdadera
                    $flag = true;
                }
            }
        }
        // Si la bandera es verdadera se crea la sesión con la variable 
        // $_SESSION con indice usuario, se guarda el nombre de usuario y su 
        // Hash
        if($flag) $_SESSION["usuario"] = [$this->user,$usuario["password"]];

    }

    // Función utilizada para agregar un nuevo usuario
    public function add() {
        // Parámetros enviados por la vista para agregar al usuario
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        // Se inicializa la base de datos
        $con = DataBase::init();
        // Primero se verifica si existe usuario para no crearlo más de una vez
        $query = "SELECT count(*) as cont FROM user WHERE usuario LIKE ?";
        $flag = false;
        // Se ejecuta la consulta del usuario
        if ($stmt = $con->prepare($query)) {
            $stmt->bind_param("s",$usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            $cont = $result->fetch_assoc()["cont"];
            if($cont != 0) {
                // Si existe el usuario se muestra la vista de registro nuevamente
                // y se sale de la función
                view('register');
                return 0;
            }
        }
        // Si el usuario no existe se realiza el insert en la BD
        $query = "INSERT INTO user VALUE(null,?,?)";
        $flag = 0;
        // Se crea el Hash a partir de la contraseña ingresada
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        // Se ejecuta la consulta
        if ($stmt2 = $con->prepare($query)) {
            $stmt2->bind_param("ss",$usuario,$passwordHash);
            $stmt2->execute();
        }
        // Se retorna si fue posible crear el usuario
        return $flag;

    }


}