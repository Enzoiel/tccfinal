<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Dbauto";

$Nome=$_POST['Nome'];
$Email=$_POST['Email'];
$Senha=$_POST['Senha'];                      

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO login(Nome, Email,Senha )
VALUES ('$Email', '$Nome', '$Senha')";

if (mysqli_query($conn, $sql)) {
    echo "Registro Cadastrado";
    header("Location: ../index.html");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>