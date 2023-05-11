<!doctype html>
<?php
include "./config/config.php";
include "./config/conn.php"
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Estabelecimento </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        include "menu.php";
        ?>

        <div class="container"> 
            <div class="titulo">
                <h1> ESTABELECIMENTO </h1>
            </div>

            <div class='card shadow-sm border'> 
                <div class='card-body'>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvas_novo" aria-controls="offCanvas_novo">
                        <i class="fa-solid fa-building"></i> Cadastrar novo estabelecimento
                    </button>

                    <div class="table-responsive mt-3"> 
                        <table class="table table-bordered table-striped table-dark text-center"> 
                            <thead> 
                                <tr> 
                                    <th> # </th>
                                    <th> NOME FANTASIA </th>
                                    <th> QTD LOJAS </th>
                                    <th> ENDEREÇO </th>
                                    <th> EDITAR </th>
                                </tr>
                            </thead>
                            <tbody id="tbody-produtos"> 
                                <?php
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
                                                <button class="btn btn-warning edita-estabelecimento" data-id="<?= $row[0] ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvas_editaProduto" aria-controls="offCanvas_editaProduto"> 
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                } else {
                                    echo "<tr> <td colspan='4'> Nenhum estabelecimento até o momento <td> </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!--OFF CANVAS (BOOSTRAT)-->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offCanvas_novo" aria-labelledby="offCanvas_novo">
            <div class="offcanvas-header">
                <h4 class="offcanvas-title" id="offcanvasExampleLabel"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div id="alert-cadastro"> 

                </div>
                <form action="include/cadastraEstabelecimento.php" autocomplete="off" id="form-cadastro"> 
                    <h4 class="offcanvas-title" id="offcanvasExampleLabel"> Cadastro de estabelecimento</h4>
                    <div class="mt-3"> 
                        <label for="nome"> Nome Fantasia</label>
                        <input class="form-control input-formulario" id="nome" name="nome" placeholder="Informe o nome do produto">
                        <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                    </div>
                    <div class="mt-3"> 
                        <label for="total"> Total de Lojas </label>
                        <input type="number" min='0' class="form-control" id="total" name="total" placeholder="Informe a quantidade de lojas">
                        <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                    </div>

                    <div class="text-center text-muted mt-3"> 
                        <span> - ENDEREÇO - </span>
                    </div>

                    <div class="mt-2"> 
                        <label for="cep"> CEP </label>
                        <input type="number" min='0' class="form-control" id="cep" name="cep" placeholder="Preencha com um CEP válido">
                        <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                    </div>

                    <div class="mt-3"> 
                        <label for="estado"> Estado</label>
                        <input class="form-control" id="estado" name="estado" placeholder="Informe o estado do estabelecimento">
                        <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                    </div>

                    <div class="mt-3"> 
                        <label for="cidade"> Cidade </label>
                        <input class="form-control" id="cidade" name="cidade" placeholder="Informe a cidade do estabelecimento">
                        <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                    </div>

                    <div class="mt-3"> 
                        <label for="nome"> Bairro </label>
                        <input class="form-control" id="bairro" name="bairro" placeholder="Informe o bairro do estabelecimento"">
                        <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                    </div>

                    <div class="mt-3 mb-1 d-flex justify-content-end"> 
                        <div> 
                            <button class="btn btn-success float-end"> Cadastrar <i class="fa fa-save"></i> </button>
                        </div>
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
        <script src="assets/js/estabelecimento.js"></script>
    </body>
</html>