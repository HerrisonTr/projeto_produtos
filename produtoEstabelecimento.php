<!doctype html>
<?php
include "./config/config.php";
include "./config/conn.php";
include "./include/functions.php"
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
                <h1> Produtos X Estabelecimentos </h1>
            </div>

            <div class='row'> 
                <div class='col-lg-4 col-md-6 col-sm-12'> 
                    <div class='card shadow-sm border'> 
                        <div class='card-body'>
                            <div class='border-bottom'> 
                                <h6> Vincular produto ao estabelecimento </h6>
                            </div>

                            <div id="alert-cadastro"> 

                            </div>
                            <form action="cadastraProdutoEstabelecimento" method="post" id="form-cadastro"> 
                                <div class='mt-3'> 
                                    <label> Estabelecimento </label>
                                    <select class='form-select input-formulario' name='estabelecimento' id="estabelecimento"> 
                                        <option selected disabled> Selecione um estabelecimento </option>
                                        <?php
                                        $sqlEstabelecimento = "select id, nome_fantasia from estabelecimento";
                                        $resultEstabelecimento = mysqli_query($con, $sqlEstabelecimento);
                                        while ($rowEstabelecimento = mysqli_fetch_array($resultEstabelecimento)) {
                                            echo "<option value='$rowEstabelecimento[0]'> $rowEstabelecimento[1] </option>";
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                                </div>

                                <div class='mt-2'> 
                                    <label> Produto </label>
                                    <select class='form-select input-formulario' name='produto' id="produto"> 
                                        <option selected disabled> Selecione um produto </option>
                                        <?php
                                        $sqlProduto = "select id, nome from produto";
                                        $resultProduto = mysqli_query($con, $sqlProduto);
                                        while ($rowProduto = mysqli_fetch_array($resultProduto)) {
                                            echo "<option value='$rowProduto[0]'> $rowProduto[1] </option>";
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                                </div>

                                <div class='mt-2'> 
                                    <label for='valor'> Valor do Produto </label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"> R$ </span>
                                        <input class="form-control money input-formulario" placeholder="00,00" name="valor" id='valor'>
                                        <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                                    </div>
                                </div>


                                <div class='d-flex justify-content-end mt-3'> 
                                    <button class="btn btn-success"> Vincular  </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class='col-lg-8 col-md-6 col-sm-12'> 
                    <div class='card shadow-sm border'> 
                        <div class='card-body'>
                            <div class='border-bottom'> 
                                <h6> Produtos por empresa </h6>
                            </div>
                            <div id="alert-deleta"></div>
                            <div class="table-responsive mt-3"> 
                                <table class="table table-bordered table-striped table-dark text-center"> 
                                    <thead> 
                                        <tr> 
                                            <th> ESTABELECIMENTO </th>
                                            <th> PRODUTO </th>
                                            <th> VALOR </th>
                                            <th> EXCLUIR </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody"> 
                                        <?php
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
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://kit.fontawesome.com/26f2848625.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <script src="assets/js/jquery/jquery.min.js"></script>
        <script src="assets/js/jquery.mask/jquery.mask.min.js"></script>
        <script src="assets/js/produtoEstabelecimento.js"></script>
    </body>
</html>