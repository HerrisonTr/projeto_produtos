$('.money').mask('000.000.000,00', {reverse: true});

$("#form-cadastro").submit(function (e) {
    if (validaCampos("#form-cadastro")) {
        cadastraEstabelecimento();
    }
    e.preventDefault();
});

function cadastraEstabelecimento() {
    let url = "include/cadastraProdutoEstabelecimento.php";

    //Campos do formulário
    let estabelecimento = $("#estabelecimento").val();
    let produto = $("#produto").val();
    let valor = $("#valor").val();

    $.ajax({
        url: url,
        type: "post",
        data: {estabelecimento, produto, valor},
        dataType: "json"
    }).done(function (data) {
        if (data.status) {
            $("input").val('');
            consultaProdutos();
        }

        $("#alert-cadastro").html(`
           <div class="alert alert-${data.alert} alert-dismissible fade show mt-2" role="alert">
                ${data.mensagem}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `);
    });
}

function consultaProdutos() {
    $.ajax({
        url: 'include/consultaTabelaProdutoEstabelecimento.php',
        dataType: "html"
    }).done(function (data) {
        $("tbody").html(data);

        //Atribuindo a função
        $(".deleta-produto").click(function () {
            let id = $(this).attr('data-id');
            deletaProduto(id);
        });
    });
}

$(".deleta-produto").click(function () {
    let id = $(this).attr('data-id');
    deletaProduto(id);
});

function deletaProduto(id) {
    let url = "include/deletaProdutoEstabelecimento.php";
    $.ajax({
        url: url,
        type: "post",
        data: {id},
        dataType: "json"
    }).done(function (data) {
        consultaProdutos();
        $("#alert-deleta").html(`
           <div class="alert alert-${data.alert} alert-dismissible fade show mt-2" role="alert">
                ${data.mensagem}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `);
    });
}

function validaCampos(formulario) {
    let status = true;
    $(formulario + " .input-formulario").each(function () {
        $(this).removeClass('is-invalid');
        if ($.trim($(this).val()) === "") {
            $(this).addClass('is-invalid');
            $(this).focus();
            status = false;
            return status;

        }
    });
    return status;
}