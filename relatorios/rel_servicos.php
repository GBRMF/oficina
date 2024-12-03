<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/index.css">    
  </head>
    <body>
    <?php include "../menu.html"; ?>

    <h1>Relatório de Produtos</h1>

    <?php
    include '../conexao.php';

    $sql = "SELECT serv_nome, serv_valor FROM tb_servicos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Nome do Serviço</th>
                  <th>Preço</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["serv_nome"]. "</td>
                    <td>" . $row["serv_valor"]. "</td>
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


