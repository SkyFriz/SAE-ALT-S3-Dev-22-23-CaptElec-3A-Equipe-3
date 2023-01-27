
<?php
$file = fopen('password_file.txt', 'r');
$password = trim(fread($file, filesize('path/to/password_file.txt')));
fclose($file);
$host = "51.38.52.224";
$username = "saeS3";
$password = "$password";
$database = "saeS3";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected successfully";




mydb = mysql.connector.connect(
    host="51.38.52.224",
    user="saeS3",
    password="unMotDePasseIUT12",
    database="saeS3"
  )
$str=$_POST['email'];
$pattern=" /^[A-Za-z0-9._%+-]+@univ-tlse2.fr$/";
if(preg_match($pattern,$str)==1){
    
}
else{
    header("Location: connexionTest.php");
}

?>