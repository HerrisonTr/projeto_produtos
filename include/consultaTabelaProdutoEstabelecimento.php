<?php
include "../config/config.php";
include "../config/conn.php";
include "./functions.php";

$sql = "select pe.id,
            e.nome_fantasia, 
            p.nome,
            p.marca,
            pe.valor
     from produto_estabelecimento pe
     inner join estabelecimento e on (e.id = pe.estabelecimento)
     inner join produto p on (p.id = pe.produto)
     order by e.id";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td> <?= $row[1] ?> </td>
            <td> <?= $row[2] ?> - <?= $row[3] ?></td>
            <td> R$ <?= converteReal($row[4]) ?> </td>
            <td> 
                <button class="btn btn-danger deleta-produto" data-id="<?= $row[0] ?>"> 
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        <?php
    }
} else {
    echo "<tr> <td colspan='4'> Nenhum item cadastrado até o momento </td> </tr>";
}