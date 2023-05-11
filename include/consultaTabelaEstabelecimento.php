<?php
include "../config/config.php";
include "../config/conn.php";

$sql = "select id, nome_fantasia, total_lojas, cep, estado, cidade, bairro, logradouro, numero from estabelecimento order by id desc";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        $endereco = [];
        $tempEndereco = [$row[3], $row[4], $row[5], $row[6]];
        foreach ($tempEndereco as $e) {
            if (!empty(trim($e))) {
                $endereco[] = $e;
            }
        }
        ?>

        <tr>
            <td> <?= $row[0] ?> </td>
            <td> <?= $row[1] ?> </td>
            <td> <?= $row[2] ?> </td>
            <td> <?= implode(", ", $endereco) ?> </td>
            <td> 
                <button class="btn btn-warning edita-estabelecimentos" data-id="<?= $row[0] ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvas_editaProduto" aria-controls="offCanvas_editaProduto"> 
                    <i class="fa fa-edit"></i>
                </button>
            </td>
        </tr>

        <?php
    }
} else {
    echo "<tr> <td colspan='4'> Nenhum estabelecimento até o momento <td> </tr>";
}