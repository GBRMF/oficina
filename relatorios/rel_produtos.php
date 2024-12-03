<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Relatório de Produtos</title>
    <link rel="stylesheet" href="../css/index.css">
</head>

  <body>
    <?php include '../menu.html'; ?>

    <h1>Relatório de Produtos</h1>

    <?php
    include '../conexao.php';

    $sql = "SELECT prod_nome, prod_valor, prod_qtde FROM tb_produtos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                  <th>Nome do Produto</th>
                  <th>Preço</th>
                  <th>Quantidade</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["prod_nome"]. "</td>
                    <td>" . $row["prod_valor"]. "</td>
                    <td>" . $row["prod_qtde"]. "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "0 resultados";
    }

    $conn->close();
    ?>
  </body>
</html>


