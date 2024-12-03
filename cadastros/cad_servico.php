<?php
include '../conexao.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];

    $sql = "INSERT INTO tb_servicos (serv_nome, serv_valor) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sd", $nome, $valor);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }

    $stmt->close();
    $conn->close();
}
?>
