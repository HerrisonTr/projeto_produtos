<!doctype html>
<?php
include "./config/config.php";
include "./config/conn.php"
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Inicio </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        include "menu.php";
        ?>

        <div class="container"> 
            <div class="titulo">
                <h1> PRODUTOS </h1>
            </div>

            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvas_novoProduto" aria-controls="offCanvas_novoProduto">
                <i class="fa-solid fa-cart-plus"></i> Cadastrar novo produto
            </button>

            <div class="table-responsive mt-3"> 
                <table class="table table-bordered table-striped table-dark text-center"> 
                    <thead> 
                        <tr> 
                            <th> # </th>
                            <th> NOME </th>
                            <th> MARCA </th>
                            <th> TAMANHO </th>
                            <th> EDITAR </th>
                        </tr>
                    </thead>
                    <tbody id="tbody-produtos"> 
                        <?php
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
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!--OFF CANVAS (BOOSTRAT)-->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offCanvas_novoProduto" aria-labelledby="offCanvas_novoProduto">
            <div class="offcanvas-header">
                <h4 class="offcanvas-title" id="offcanvasExampleLabel"> </h4>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <h4 class="offcanvas-title" id="offcanvasExampleLabel"> Cadastro de produto</h4>
                <div id="alert-cadastro"> 

                </div>
                <form action="include/cadastraProduto.php" autocomplete="off" id="form-cadastro"> 
                    <div class="mt-3"> 
                        <label for="nome"> Nome </label>
                        <input class="form-control input-formulario" id="nome" name="nome" placeholder="Informe o nome do produto">
                        <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                    </div>
                    <div class="mt-3"> 
                        <label for="nome"> Marca </label>
                        <input class="form-control input-formulario" id="marca" name="marca" placeholder="Informe a marca do produto">
                        <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                    </div>
                    <div class="mt-3"> 
                        <label for="tamanho"> Tamanho / Quantidade </label>
                        <input class="form-control input-formulario" id="tamanho" name="tamanho" placeholder="Ex: 200g ou 260ml">
                        <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                    </div>

                    <div class="mt-3"> 
                        <button class="btn btn-success float-end"> Cadastrar <i class="fa fa-save"></i> </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offCanvas_editaProduto" aria-labelledby="offCanvas_editaProduto">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body" id="offcanvas-edita">
                ...
            </div>
        </div>

        <script src="https://kit.fontawesome.com/26f2848625.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <script src="assets/js/jquery/jquery.min.js"></script>
        <script src="assets/js/produtos.js"></script>
    </body>
</html>