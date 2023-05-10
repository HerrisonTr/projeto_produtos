
$("#form-cadastro").submit(function (e) {
    if (validaCampos("#form-cadastro")) {
        cadastraEstabelecimento();
    }
    e.preventDefault();
});

$(".edita-estabelecimento").click(function () {
    let id = $(this).attr('data-id');
    consultaEditarEstabelecimento(id);
});

$("#cep").blur(function () {
    pesquisarCep();
});

//CONSULTA CEP
const cepValido = (cep) => cep.length == 8;
const pesquisarCep = async() => {
    let cep = $("#cep").val();

    if (cepValido(cep)) {
        cep = cep.replace('-', '');

        const url = "https://viacep.com.br/ws/" + cep + "/json/";
        let estado = $("#estado");
        let cidade = $("#cidade");
        let bairro = $("#bairro");

        const dados = await fetch(url);
        const endereco = await dados.json();
        if (!endereco.hasOwnProperty('erro')) {
            $('#cep_invalido').hide();
            $('#btn_endereco').prop('disabled', false);

            estado.val(endereco.uf);
            cidade.val(endereco.localidade);
            bairro.val(endereco.bairro);
        }
    }
};

function cadastraEstabelecimento() {
    let url = "include/cadastraEstabelecimento.php";

    //Campos do formulário
    let nome = $("#nome").val();
    let total = $("#total").val();
    let cep = $("#cep").val();
    let estado = $("#estado").val();
    let cidade = $("#cidade").val();
    let bairro = $("#bairro").val();

    $.ajax({
        url: url,
        type: "post",
        data: {nome, total, cep, estado, cidade, bairro},
        dataType: "json"
    }).done(function (data) {
        if (data.status) {
            limpaFormulario("#form-cadastro");
            consultaEstabelecimentos();
        }
        $("#alert-cadastro").html(`
           <div class="alert alert-${data.alert} alert-dismissible fade show mt-2" role="alert">
                ${data.mensagem}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `);
    });
}

function editaEstabelecimento() {
    let url = "include/editaEstabelecimento.php";

    //Campos do formulário
    let id = $("#id_edita").val();
    let nome = $("#nome_edita").val();
    let total = $("#total_edita").val();
    let cep = $("#cep_edita").val();
    let estado = $("#estado_edita").val();
    let cidade = $("#cidade_edita").val();
    let bairro = $("#bairro_edita").val();

    $.ajax({
        url: url,
        type: "post",
        data: {id, nome, total, cep, estado, cidade, bairro},
        dataType: "json"
    }).done(function (data) {
        if (data.status) {
            consultaEstabelecimentos();
        }

        $("#alert-edita").html(`
           <div class="alert alert-${data.alert} alert-dismissible fade show mt-2" role="alert">
                ${data.mensagem}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `);
    });
}

function consultaEditarEstabelecimento(id) {
    if (id) {
        $.ajax({
            url: 'include/consultaEditaEstabelecimento.php',
            data: {id},
            dataType: "html"
        }).done(function (data) {
            $("#offcanvas-edita").html(data);
            $("#form-edita").submit(function (e) {
                if (validaCampos("#form-edita")) {
                    editaEstabelecimento();
                }
                e.preventDefault();
            });
        });
    }
}

function consultaEstabelecimentos() {
    $.ajax({
        url: 'include/consultaTabelaEstabelecimento.php',
        dataType: "html"
    }).done(function (data) {
        $("tbody").html(data);

        //Atribuindo a função
        $(".edita-estabelecimentos").click(function () {
            let id = $(this).attr('data-id');
            consultaEditarEstabelecimento(id);
        });
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

function limpaFormulario(formulario) {
    $(formulario + " input").val('');
}

