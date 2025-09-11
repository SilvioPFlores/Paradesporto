$(document).ready(function () {
    $('.trTitulo').click(function () {
        let id = $(this).closest('tr[data-id]').data('id');
        $.post("consulta.php",
            {
                formEditaTrabalho: "edita",
                cdTrabalho: id
            },
            function (data) {
                exibirConteudo(data);
            });
    });
})