<?php
include "../config/config.php";
include "../config/conn.php";

$sql = "select id, nome, marca, tamanho from produto order by id desc";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_array($result)) {
        ?>

        <tr>
            <td> <?= $row[0] ?> </td>
            <td> <?= $row[1] ?> </td>
            <td> <?= $row[2] ?> </td>
            <td> <?= $row[3] ?> </td>
            <td>
                <button class="btn btn-warning edita-produto" data-id="<?= $row[0] ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvas_editaProduto" aria-controls="offCanvas_editaProduto"> 
                    <i class="fa fa-edit"></i>
                </button>
            </td>
        </tr>

        <?php
    }
} else {
    echo "<tr> <td colspan='4'> Nenhum item cadastrado até o momento <td> </tr>";
}