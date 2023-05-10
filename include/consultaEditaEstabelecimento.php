<?php
include "../config/config.php";
include "../config/conn.php";

if (!isset($_GET['id'])) {
    header("../");
    return;
}

$id = (int) $_GET['id'];
$sql = "select id, nome_fantasia, total_lojas, cep, estado, cidade, bairro, logradouro, numero from estabelecimento where id = $id";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_array($result);
    ?>
    <h4 class="offcanvas-title" id="offcanvasExampleLabel"> Editar <?= $row[1] ?> </h4>
    <div id="alert-edita"> 

    </div>
    <form action="include/editaaEstabelecimento.php" autocomplete="off" id="form-edita">
        <input hidden value="<?= $id ?>" name="id" id='id_edita'>
        <div class="mt-3"> 
            <label for="nome_edita"> Nome Fantasia</label>
            <input class="form-control input-formulario" id="nome_edita" name="nome" value="<?= $row[1] ?>" placeholder="Informe o nome do produto">
            <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
        </div>
        <div class="mt-3"> 
            <label for="total_edita"> Total de Lojas </label>
            <input type="number" min='0' class="form-control" id="total_edita" name="total" value="<?= $row[2] ?>"" placeholder="Informe a quantidade de lojas">
            <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
        </div>

        <div class="text-center text-muted mt-3"> 
            <span> - ENDEREÇO - </span>
        </div>

        <div class="mt-2"> 
            <label for="cep_edita"> CEP </label>
            <input type="number" min='0' class="form-control" id="cep_edita" name="cep" value="<?= $row[3] ?>" placeholder="Preencha com um CEP válido">
            <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
        </div>

        <div class="mt-3"> 
            <label for="estado_edita"> Estado</label>
            <input class="form-control" id="estado_edita" name="estado" value="<?= $row[4] ?>" placeholder="Informe o estado do estabelecimento">
            <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
        </div>

        <div class="mt-3"> 
            <label for="cidade_edita"> Cidade </label>
            <input class="form-control" id="cidade_edita" name="cidade" value="<?= $row[5] ?>" placeholder="Informe a cidade do estabelecimento">
            <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
        </div>

        <div class="mt-3"> 
            <label for="nome_edita"> Bairro </label>
            <input class="form-control" id="bairro_edita" name="bairro" value="<?= $row[6] ?>" placeholder="Informe o bairro do estabelecimento"">
            <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
        </div>

        <div class="mt-3 mb-1 d-flex justify-content-end"> 
            <div> 
                <button class="btn btn-warning float-end"> Editar <i class="fa fa-edit"></i> </button>
            </div>
        </div>
    </form>

    <script>

        $("#cep_edita").blur(function () {
            pesquisarCep2();
        });

    //CONSULTA CEP
        const cepValido2 = (cep) => cep.length == 8;
        const pesquisarCep2 = async() => {
            let cep = $("#cep_edita").val();

            if (cepValido2(cep)) {
                cep = cep.replace('-', '');

                const url = "https://viacep.com.br/ws/" + cep + "/json/";
                let estado = $("#estado_edita");
                let cidade = $("#cidade_edita");
                let bairro = $("#bairro_edita");

                const dados = await fetch(url);
                const endereco = await dados.json();
                if (!endereco.hasOwnProperty('erro')) {
                    estado.val(endereco.uf);
                    cidade.val(endereco.localidade);
                    bairro.val(endereco.bairro);
                }
            }
        };
    </script>
    <?php
}
?>