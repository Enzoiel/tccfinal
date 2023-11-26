<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site";


// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['Nome']) OR empty($_POST['Senha']))) {
    header("Location: index.html"); exit;
}


$usuario = $_POST['Nome'];
$senha = $_POST['Senha'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db_site);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Validação do usuário/senha digitados

$sql = "SELECT Id, Nome, E-mail FROM login WHERE Nome ='$usuario' and Senha=$senha";
$result = mysqli_query($conn, $sql);
if  (mysqli_num_rows($result) != 1) {
    // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
    echo "Login inválido!"; 
    
} else {
    
    echo "entrou";

}
mysqli_close($conn);

?>