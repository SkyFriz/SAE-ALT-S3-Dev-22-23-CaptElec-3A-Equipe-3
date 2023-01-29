<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$file = fopen('password_file.txt', 'r');
$password_db = trim(fread($file, filesize('password_file.txt')));
fclose($file);
$host = "51.38.52.224";
$username_db = "saeS3";
$database = "saeS3";

$mysqli = new mysqli($host, $username_db, $password_db, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$password = $mysqli->real_escape_string($_POST['pswd']);
echo "$password <br>";
$username = $mysqli->real_escape_string($_POST['txt']);

$password = hash("sha256", $password);


$query = "SELECT * FROM USERS WHERE (username='$username') AND hashed_password ='" . $password. "'";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    echo "Login successful";
    session_start();
    $_SESSION['identifie']='OK';
    // si l'utilisateur a cliqué sur la case à cocher "se souvenir de moi" alors on lui envoie un cookie 
    // qui permettra un pré-remplissage du champ login dans le formulaire de connexion
    header('location: index.php');
    exit();

} else {
    echo "Login failed: invalid username or password";
}




$mysqli->close();
?>
