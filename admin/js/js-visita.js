$(document).ready(function () {
    $('#btnPeriodo').click(function() {
        let dtInicio = $("#dataInicio").val();
        let dtFim = $("#dataFim").val();
        $.post("infoVisitas.php",
            {
                buscaPeriodo: "true",
                dtInicio: dtInicio,
                dtFim: dtFim
            },
            function (data) {
                var obj = JSON.parse(data);
                $("#divPeriodo").removeClass("d-none").addClass("d-block");
                $("#titPeriodo").html("De " + obj[2] + " a " + obj[3]);
                $("#spTotVisitas").html(obj[0]);
                $("#spTotIps").html(obj[1]);
                $("#spTotIps").focus();
            });
    });
})