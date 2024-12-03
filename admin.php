<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include 'conexao.php';

// Adicionar novo usuário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO tb_usuarios (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Usuário adicionado com sucesso.";
    } else {
        echo "Erro ao adicionar usuário: " . $stmt->error;
    }

    $stmt->close();
}

// Listar usuários existentes
$sql = "SELECT id, username FROM tb_usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Usuários</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <?php include "menu.html"; ?>

    <h2>Administração de Usuários</h2>

    <form action="admin.php" method="post">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Adicionar Usuário</button>
    </form>

    <h3>Usuários Existentes</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Ações</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["username"]. "</td>
                        <td>
                            <a href='delete_user.php?id=" . $row["id"] . "'>Excluir</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhum usuário encontrado</td></tr>";
        }
        ?>
    </table>

    <?php $conn->close(); ?>
</body>
</html>