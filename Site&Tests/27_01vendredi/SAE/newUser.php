
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$file = fopen('password_file.txt', 'r');
$password = trim(fread($file, filesize('password_file.txt')));
fclose($file);
$host = "51.38.52.224";
$username = "saeS3";
$database = "saeS3";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}



$str = $_POST['email'];
$pattern = " /^[A-Za-z0-9._%+-]+@(univ-tlse2.fr|etu.univ-tlse2.fr)$/";
if (preg_match($pattern, $str) == 1) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $mysqli->real_escape_string($_POST['email']);
        $username = $mysqli->real_escape_string($_POST['txt']);
        $password = $mysqli->real_escape_string($_POST['pswd']);

        
        $password = hash("sha256", $password);
        
        
        $query = "INSERT INTO USERS (email, username, hashed_password) VALUES ('$email', '$username', '$password')";
        try {
            $mysqli->query($query);
            echo "New user added successfully";
            session_start();
            $_SESSION['identifie']='OK';
            // si l'utilisateur a cliqué sur la case à cocher "se souvenir de moi" alors on lui envoie un cookie 
            // qui permettra un pré-remplissage du champ login dans le formulaire de connexion
            header('location: index.php');
            exit();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "Invalid e-mail";
}

$mysqli->close();






?>