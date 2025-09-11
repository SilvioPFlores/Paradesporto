$(document).ready(function () {
    $('INPUT[type="file"]').change(function () {
        var id = this.id;
        var arq = this.value.split('.').pop();
        if(validaTipoArquivo(arq, 'csv', id)){
            var file_size = this.files[0].size;
            //limita o tamanho em 100M
            if(file_size>100*1024*1024) {
                console.log(file_size);
                $('#btnEnviaForm').attr('disabled', true);
                $('#'+id).removeClass('is-valid').addClass('is-invalid');
                $('#'+id+'Size').show();
            }
            else{
                $('#btnEnviaForm').attr('disabled', false);
                $('#'+id).removeClass('is-invalid').removeClass('is-valid');
                $('#'+id+'Size').hide();
            }
        }
    });
    $('#cadCsv').on('submit', function(event) {
        event.preventDefault();
        $('#btnEnviaForm').attr('disabled', true);
        var formData = new FormData($('form')[0]);
        $.ajax({
            xhr : function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable && $('#arqCSV').val() != '') {
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    }
                });
                return xhr;
            },
            type : 'POST',
            url : 'csv.php',
            data : formData,
            processData : false,
            contentType : false,
            // exibe gif enquanto carrega os trabalhos
            beforeSend : function () {
                $( "#divLoad" ).show();
            },
            success : function(data) {
                $('#divLoad').hide();
                var obj = JSON.parse(data);
                var txt = '';
                var booOk = false;
                var booErro = false;
                //var booDuplicado = false;
                if(obj['novo'] != '0'){
                    txt = 'Foram adicionados ' + obj['novo'] + ' titulos novos!\n\r';
                    booOk = true;
                }
                if(obj['erro'] > 0){
                    txt += 'Ocorreram '+ obj['erro'] + ' erros ao adicioanar os trabalhos!';
                    var booErro = true;
                }/*
                if(obj['duplicado'] != '0'){
                    txt += 'Encontramos '+ obj['duplicado'] + ' titulos duplicados!\n\rDeseja verificar?';
                    //var booDuplicado = true;
                }
                if(booDuplicado){
                    alertConfirmNewPage(txt,'consulta.php','duplicados.php');
                }
                else */if(booErro){
                    alertNewPage(txt,'consulta.php');
                }
                else if(booOk){
                    okNewPage(txt,'consulta.php');
                }
                else{
                    erroNewPage('Não foram adicionados nenhum novo trabalho!', 'consulta.php')
                }
            }
        });
    });
})