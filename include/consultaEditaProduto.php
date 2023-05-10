<?php
include "../config/config.php";
include "../config/conn.php";

if (!isset($_GET['id'])) {
    header("../");
    return;
}

$id = (int) $_GET['id'];
$sql = "select id, nome, marca, tamanho from produto where id = $id";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_array($result);
    ?>
    <h4 class="offcanvas-title" id="offcanvasExampleLabel"> Editar <?= $row[1] ?> </h4>
    <div id="alert-edita"> 

    </div>
    <form autocomplete="off" id="form-edita" action="./"> 
        <input hidden id="id_edita" value="<?= $id ?>">
        <div class="mt-3"> 
            <label for="nome_edita"> Nome </label>
            <input class="form-control input-formulario" id="nome_edita" name="nome" value="<?= $row[1] ?>" placeholder="Informe o nome do produto">
            <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
        </div>
        <div class="mt-3"> 
            <label for="marca_edita"> Marca </label>
            <input class="form-control input-formulario" id="marca_edita" name="marca" value="<?= $row[2] ?>" placeholder="Informe a marca do produto">
            <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
        </div>
        <div class="mt-3"> 
            <label for="tamanho_edita"> Tamanho / Quantidade </label>
            <input class="form-control input-formulario" id="tamanho_edita" name="tamanho" value="<?= $row[3] ?>" placeholder="Ex: 200g ou 260ml">
            <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
        </div>

        <div class="mt-3"> 
            <button class="btn btn-warning float-end"> Editar <i class="fa fa-edit"></i> </button>
        </div>
    </form>

    <?php
}
?>