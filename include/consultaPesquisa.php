<?php
include "../config/config.php";
include "../config/conn.php";
include "./functions.php";
 
$id = (int) $_GET['produto'];
$sql = "select pe.id,
            e.nome_fantasia, 
            p.nome,
            p.marca,
            pe.valor
     from produto_estabelecimento pe
     inner join estabelecimento e on (e.id = pe.estabelecimento)
     inner join produto p on (p.id = pe.produto)
     where p.id = $id
     order by pe.valor asc";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td> <?= $row[1] ?> </td>
            <td> <?= $row[2] ?> - <?= $row[3] ?></td>
            <td> R$ <?= converteReal($row[4]) ?> </td>
        </tr>
        <?php
    }
} else {
    echo "<tr> <td colspan='3'> Esse item ainda não foi cadastrado em nenhum estabelecimento </td> </tr>";
}