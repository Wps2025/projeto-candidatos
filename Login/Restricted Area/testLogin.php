<?php
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Conexão com o banco de dados
    include("./config.php");
    //Verificar a conexão 
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sql =  "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($senha, $row['senha'])) {  

           header("Location: Login/System/sistemaS.html");
           exit();

        } else {

            header("Location: /Loginn/login.html?erro=1");
            exit();
        }
    } else {
        echo "Usuário não encontrado!";
        header("Location: /Home/home.html?erro=1");
        exit();

    }

    $conn->close();
}

?>


