function lingua(lang){
    $.post("../config/lingua.php",
    {
        lang: lang
    },
    function () {
        location.reload(true);
    });
}
function enableLink(span, link) {
    //Remove classe 'img-inativo' do span
    $(span).removeClass("img-inativo");
    //Remove 'aria-disabled', melhor do que definir como falso
    $(link).removeAttr('aria-disabled');
}
$(document).ready(function () {
    $.post("../visita.php",
    {
        visita: "true"
    },
    function (data) {
    });
    $('.contaDownload').click(function () {
        $.post("../visita.php",
        {
            download: $(this).attr('href')
        },
        function (data) {
        });
    });
    $('#mdlProducao').on('show.bs.modal', function (event) {
        var modal = $(this);
        var pdf = $(event.relatedTarget).data('pdf');
        var epub = $(event.relatedTarget).data('epub');
        var mp3 = $(event.relatedTarget).data('mp3');
        
        if(pdf != ''){
            modal.find('#aPdf').attr({'href': 'conteudo/'+pdf});
            enableLink('#spPdf', '#aPdf');
        }
        if(epub != ''){
            modal.find('#aEpub').attr({'href': 'conteudo/'+epub});
            enableLink('#spEpub', '#aEpub');
        }
        if(mp3 != ''){
            modal.find('#aMp3').attr({'href': 'baixarArquivo.php?arquivo='+mp3});
            enableLink('#spMp3', '#aMp3');
        }
    });
    $('#mdlProducao').on('hide.bs.modal', function () {
        var modal = $(this);
        modal.find('.mySpan').addClass('img-inativo');
        modal.find('.myHref').attr({'aria-disabled': true});
        modal.find('.myHref').attr({'href': ''});
    });
});