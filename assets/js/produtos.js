
$("#form-cadastro").submit(function (e) {
    if (validaCampos("#form-cadastro")) {
        cadastraProdutos();
    }
    e.preventDefault();
});

$(".edita-produto").click(function () {
    let id = $(this).attr('data-id');
    consultaEditarProduto(id);
});

function cadastraProdutos() {
    let url = "include/cadastraProduto.php";

    //Campos do formulário
    let nome = $("#nome").val();
    let marca = $("#marca").val();
    let tamanho = $("#tamanho").val();

    $.ajax({
        url: url,
        type: "post",
        data: {nome, marca, tamanho},
        dataType: "json"
    }).done(function (data) {
        if (data.status) {
            limpaFormulario("#form-cadastro");
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

function editaProduto() {
    let url = "include/editaProduto.php";

    //Campos do formulário
    let id = $("#id_edita").val();
    let nome = $("#nome_edita").val();
    let marca = $("#marca_edita").val();
    let tamanho = $("#tamanho_edita").val();

    $.ajax({
        url: url,
        type: "post",
        data: {id, nome, marca, tamanho},
        dataType: "json"
    }).done(function (data) {
        if (data.status) {
            consultaProdutos();
        }

        $("#alert-edita").html(`
           <div class="alert alert-${data.alert} alert-dismissible fade show mt-2" role="alert">
                ${data.mensagem}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `);
    });
}

function consultaEditarProduto(id) {
    if (id) {
        $.ajax({
            url: 'include/consultaEditaProduto.php',
            data: {id},
            dataType: "html"
        }).done(function (data) {
            $("#offcanvas-edita").html(data);
            $("#form-edita").submit(function (e) {
                if (validaCampos("#form-edita")) {
                    editaProduto();
                }
                e.preventDefault();
            });
        });
    }
}

function consultaProdutos() {
    $.ajax({
        url: 'include/consultaTabelaProdutos.php',
        dataType: "html"
    }).done(function (data) {
        $("#tbody-produtos").html(data);

        //Atribuindo a função
        $(".edita-produto").click(function () {
            let id = $(this).attr('data-id');
            consultaEditarProduto(id);
        });

    });
}

function validaCampos(formulario) {
    let status = true;
    $(formulario + " input").each(function () {
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

function limpaFormulario(formulario) {
    $(formulario + " input").val('');
}

