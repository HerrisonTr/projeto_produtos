<!doctype html>
<?php
include "./config/config.php";
include "./config/conn.php"
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Pesquisa </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        include "menu.php";
        ?>

        <div class="container"> 
            <div class="titulo">
                <h1> PESQUISAR PREÇOS </h1>
            </div>


            <div class='card shadow-sm border'> 
                <div class='card-body'>
                    <div class='row'> 
                        <div class='col-md-4'> 
                            <label> Produto </label>
                            <select class='form-select input-formulario' name='produto' id="produto"> 
                                <option selected disabled> Selecione um produto </option>
                                <?php
                                $sqlProduto = "select id, nome, marca from produto";
                                $resultProduto = mysqli_query($con, $sqlProduto);
                                while ($rowProduto = mysqli_fetch_array($resultProduto)) {
                                    echo "<option value='$rowProduto[0]'> $rowProduto[1] - $rowProduto[2] </option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
                        </div>
                        <div class='col-md-4'> 
                            <label class='d-block'> &nbsp </label>
                            <button class='btn btn-success' id='btn-busca'> Buscar  <i class='fa fa-search'></i></button>
                        </div>
                    </div>

                    <div class="table-responsive mt-3"> 
                        <table class="table table-bordered table-striped table-dark text-center"> 
                            <thead> 
                                <tr> 
                                    <th> ESTABELECIMENTO </th>
                                    <th> PRODUTO </th>
                                    <th> VALOR </th>
                                </tr>
                            </thead>
                            <tbody id="tbody"> 
                                <tr> 
                                    <td colspan="3"> Selecione um produto para filtrar  </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://kit.fontawesome.com/26f2848625.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <script src="assets/js/jquery/jquery.min.js"></script>
        <script>
            $("#btn-busca").click(function () {
                let produto = $("#produto").val();
                
                if (produto != "") {
                    $.ajax({
                        url: 'include/consultaPesquisa.php',
                        data: {produto},
                        dataType: "html"
                    }).done(function (data) {
                        $("tbody").html(data);
                    });
                }
            });
        </script>
    </body>
</html>