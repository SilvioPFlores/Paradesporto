const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
	  confirmButton: 'btn btn-success btnJS',
	  cancelButton: 'btn btn-danger btnJS'
	},
	buttonsStyling: false
});
function newAlert(texto) {
    swalWithBootstrapButtons.fire({
        text: texto,
        icon: 'success',
        confirmButtonText: 'Ok'
    });
}
function erroOk(texto) {
    swalWithBootstrapButtons.fire({
        text: texto,
        icon: 'error',
        confirmButtonText: 'Ok'
    });
}
function erroNewPage(texto, page) {
    swalWithBootstrapButtons.fire({
        text: texto,
        icon: 'error',
        confirmButtonText: 'Ok',
    }).then(function (isConfirm) {
        if (isConfirm) {
            window.location.replace(page);
        }
    });
}
function alertNewPage(texto, page) {
    swalWithBootstrapButtons.fire({
        text: texto,
        icon: 'warning',
        confirmButtonText: 'Ok',
		reverseButtons: true
	}).then(function (isConfirm) {
        if (isConfirm) {
            window.location.replace(page);
        }
    });
}
function alertConfirmNewPage(texto, pageOk, pageCanc) {
    swalWithBootstrapButtons.fire({
        text: texto,
        icon: 'warning',
		showCancelButton: true,
		cancelButtonText: 'Visualizar',
        confirmButtonText: 'Não, obrigado',
		reverseButtons: true
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.replace(pageOk);
		} else if (result.dismiss === Swal.DismissReason.cancel) {
			window.location.replace(pageCanc);
		}
	  });
}
function okNewPage(texto, page) {
    swalWithBootstrapButtons.fire({
        text: texto,
        icon: 'success',
        confirmButtonText: 'Ok',
    }).then(function (isConfirm) {
        if (isConfirm) {
            window.location.replace(page);
        }
    });
}
function exibirConteudo(data) {
    if (data != '') {
        $(".divConteudo").html(data);
    }
    else {
        erroNewPage('Página não encontrada!', 'index.php');
    }
}
function validaTipoArquivo(arquivoRecebido, arquivoEsperado, id){
	try{
		switch (arquivoRecebido.toLowerCase()) {//.toLowerCase() sempre minusculo
			case '':
				$('#btnEnviaForm').attr('disabled', false);
				$('#'+id).removeClass('is-invalid').removeClass('is-valid');
				$('#'+id+'Feedback').hide();
				return false;
				break;
			case arquivoEsperado:
				$('#btnEnviaForm').attr('disabled', false);
				$('#'+id).removeClass('is-invalid').addClass('is-valid');
				$('#'+id+'Feedback').hide();
				return true;
				break;
			default:
				$('#btnEnviaForm').attr('disabled', true);
				$('#'+id).removeClass('is-valid').addClass('is-invalid');
				$('#'+id+'Feedback').show();
				return false;
		}
	}
	catch{
		$('#'+id).removeClass('is-valid').removeClass('is-invalid');
		return false;
	}
}
function enviaFormFile(id,page){
	$('#btnEnviaForm').attr('disabled', true);
	var formData = new FormData($('form')[0]);
	$.ajax({
		xhr : function() {
			var xhr = new window.XMLHttpRequest();
			xhr.upload.addEventListener('progress', function(e) {
				if (e.lengthComputable && $('#'+id).val() != '') {
					var percent = Math.round((e.loaded / e.total) * 100);
					$('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
				}
			});
			return xhr;
		},
		type : 'POST',
		url : page,
		data : formData,
		processData : false,
		contentType : false,
		success : function(data) {
			$('#divLoad').hide();
			if(page == 'alteraTrabalho.php'){
				arrData = data.split('|');
				if(arrData[0] == '000'){
					console.dir(arrData[1]);
					okNewPage('Trabalho alterado com sucesso!','consulta.php');
				}
				else{
					erroOk('Não foi possível alterar o trabalho! Erro: '+data);
				}
			}
			else if(page == 'trabalho.php'){
				arrData = data.split('|');
				if(arrData[0] == '000'){
					console.dir(arrData[1]);
					okNewPage('Trabalho cadastrado com sucesso!','consulta.php');
				}
				else{
					erroOk('Não foi possível cadastrar novo trabalho! Erro: '+data);
				}
			}
			else{
				$(".divConteudo").html(data);
			}
		}
	});
}