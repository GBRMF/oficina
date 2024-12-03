<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Oficina</title>
  <link rel="stylesheet" href="./css/menu.css">
  <link rel="stylesheet" href="./css/index.css"> <!-- Adicione o link para o arquivo CSS -->
</head>

<body>
  <?php include "menu.html"; ?>

  <h1>Bem-vindo à Oficina</h1>

  <?php
  include 'conexao.php';

  // Contar o número de produtos
  $sql = "SELECT COUNT(*) AS total_produtos FROM tb_produtos";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $total_produtos = $row['total_produtos'];

  // Contar o número de itens (quantidade total de produtos)
  $sql = "SELECT SUM(prod_qtde) AS total_itens FROM tb_produtos";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $total_itens = $row['total_itens'];

  // Contar o número de serviços
  $sql = "SELECT COUNT(*) AS total_servicos FROM tb_servicos";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $total_servicos = $row['total_servicos'];

  echo "<div class='resultados'>";
  echo "<p class='resultado_prod'>Total de produtos cadastrados <br><br><span class='valor'>$total_produtos</span></p>";
  echo "<p class='resultado_sumprod'>Total de itens cadastrados <br><br><span class='valor'>$total_itens</span></p>";
  echo "<p class='resultado_serv'>Total de serviços cadastrados <br><br><span class='valor'>$total_servicos</span></p>";
  echo "</div>";

  $conn->close();
  ?>
</body>

</html>