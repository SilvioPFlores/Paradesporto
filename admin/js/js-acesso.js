$(document).ready(function () {
    $('.trAcesso').click(function () {
        let id = $(this).closest('tr[data-id]').data('id');
        $.post("acesso.php",
            {
                formEditaUsuario: "edita",
                cdUsuario: id
            },
            function (data) {
                exibirConteudo(data);
            });
    });
})