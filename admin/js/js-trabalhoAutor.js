function exibeLivro(num){
	$('.cd0').hide(1000);
	$('.in0').attr('required', false);
	setTimeout(1000);
	if(num != ''){
		$('.cdAll').show(1000);
		$('.cd'+num).show(1000);
		$('.inAll').attr('required', true);
		$('.in'+num).attr('required', true);
	}
}

$(document).ready(function () {
    //Exibir ou esconder as infprmações para livro
    exibeLivro($('#cmbTipoTrabalho').val());
    $('#cmbTipoTrabalho').change(function(){
        exibeLivro(this.value);
    });
    $('#cmbNaoSelec').change(function(){
        var idChave = this.value;
        var chave = $(this).find('option').filter(':selected').text();
        //Se ainda não exixtir no combo ele é adicionado
        if(!$("#chkChave"+idChave).length){
            $("#divChkChave").append(
            "<div class='form-check'>"
                +"<input class='form-check-input' type='checkbox' value='"+idChave+"' name='chkChave[]' id='chkChave"+idChave+"' checked>"
                +"<label class='form-check-label' for='chkChave"+idChave+"'>"+chave+"</label></div>");
        }
        $("#cmbNaoSelec").val("0");
    });
    $('#url').on('keypress', function(e){
        if (e.keyCode == 13) {
            e.preventDefault();
            $("#btnBuscaUrl").click();
        }
    });
    $('#doi').on('keypress', function(e){
        if (e.keyCode == 13) {
            e.preventDefault();
            $("#btnBuscaDoi").click();
        }
    });
    $('#btnRecusar').click(function () {
        //iniciando um dialog confirm
        swalWithBootstrapButtons.fire({
            text: "Deseja recusar este trabalho?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim, recusar!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            //se confirmado
            if (result.isConfirmed) {
                //desabilitar os botões
                $('#btnVoltar').attr("disabled", true);
                $('#btnRecusar').attr("disabled", true);
                $('#btnEnviaForm').attr("disabled", true);
                //Alterar o texto do botão
                $('#btnRecusar').val("Atualizando...");
                let cdTrabalho = $("#cdTrabalho").val();
                $.post("trabalhoAutor.php",
                {
                    recusarTrabalho: "recusa",
                    cdTrabalho: cdTrabalho
                },
                function (data) {
                    //console.log(data);
                    let arr = data.split('|');
                    //console.log(arr[0] + ' . ' + arr[1]);
                    if (arr[0] == arr[1]){
                        okNewPage('O trabalho foi recusado!','trabalhoAutor.php');
                    }
                    else if (arr[0] == '0' && arr[1] != '0'){
                        alertNewPage('O trabalho foi recusado! Mas não foi possível enviar e-mail! Erro '+arr[1],'trabalhoAutor.php');
                    }
                    else{
                        erroOk('Não foi possível recusar o trabalho! Erro: '+arr[0]);
                    } 
                });
            }
        });
    });
    $('#newProd').on('submit', function(event) {
		event.preventDefault();
	    var formData = new FormData($('form')[0]);
        $.ajax({
            type : 'POST',
            url : 'trabalhoAutor.php',
            data : formData,
            processData : false,
            contentType : false,
            success : function(data) {
				//console.log(data);
                if(data == 'ok'){
                    okNewPage('Produção gravada com sucesso!','trabalhoAutor.php');
                }    
				else{
					erroOk('Não foi possível gravar a Produção! Erro: '+data);
				}
			}
        });
	});
});