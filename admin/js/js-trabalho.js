function exibeLivro(num){
	if(num == 3){
		$('.divLivro').show();
		$('.divTrabalhos').hide();
	}
	else{
		$('.divLivro').hide();
		$('.divTrabalhos').show();
	}
}
$(document).ready(function () {
	exibeLivro($('#cmbTipoTrabalho').val());
	$('#cmbTipoTrabalho').change(function(){
		exibeLivro(this.value);
	});
	$('INPUT[type="file"]').change(function () {
		var id = this.id;
        var arq = this.value.split('.').pop();
        if(validaTipoArquivo(arq, 'pdf', id)){
			var file_size = this.files[0].size;
			if(file_size>300*1024*1024) {
				console.log(file_size);
				$('#btnEnviaForm').attr('disabled', true);
				$('#'+id).removeClass('is-valid').addClass('is-invalid');
				$('#'+id+'Size').show();
				$('#rdPublicoN').prop('checked', true);
			}
			else{
				$('#btnEnviaForm').attr('disabled', false);
				$('#'+id).removeClass('is-invalid').removeClass('is-valid');
				$('#'+id+'Size').hide();
				$('#rdPublicoS').prop('checked', true);
			}
		}
		else{
			$('#rdPublicoN').prop('checked', true);
		}
	});
    $('#formTrabalho').on('submit', function(event) {
		event.preventDefault();
		enviaFormFile('trabalhoPDF','alteraTrabalho.php');
	});
    $('#formNewTrabalho').on('submit', function(event) {
		event.preventDefault();
		enviaFormFile('trabalhoPDF','trabalho.php');
	});
	$('#cmbNaoSelec').change(function(){
		var idChave = this.value;
		var chave = $(this).find('option').filter(':selected').text();
		$("#divChkChave").append(
			"<div class='form-check'>"
				+"<input class='form-check-input' type='checkbox' value='"+idChave+"' name='chkChave[]' id='chkChave"+idChave+"' checked>"
				+"<label class='form-check-label' for='chkChave"+idChave+"'>"+chave+"</label></div>");
		$("#cmbNaoSelec").val("0");
	});
	$('#btnExcluir').click(function () {
		var cdTrabalho = $('#cdTrabalho').val();
		swalWithBootstrapButtons.fire({
			text: "Tem certeza que deseja excluir este trabalho?",
			icon: 'warning',
			showCancelButton: true,
			cancelButtonText: 'Não',
			confirmButtonText: 'Sim',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				swalWithBootstrapButtons.fire({
					title: 'Informe o motivo!',
					input: 'text',
					inputAttributes: {
					  autocapitalize: 'off'
					},
					showCancelButton: true,
					confirmButtonText: 'Excluir',
					reverseButtons: true,
					showLoaderOnConfirm: true,
					preConfirm: (motivo) => {
					  return fetch(`excluiTrabalho.php?motivo=${motivo}&cdTrabalho=${cdTrabalho}`)
						.then(response => {
						  if (!response.ok) {
							throw new Error(response.statusText)
						  }
						  return response.json()
						})
						.catch(error => {
						  Swal.showValidationMessage(
							`Request failed: ${error}`
						  )
						})
					},
					allowOutsideClick: () => !Swal.isLoading()
				  }).then((result) => {
					console.log(result);
					if (result.isConfirmed) {
						if(result.value.result == 'ok'){
							swalWithBootstrapButtons.fire({
								icon: 'success',
								title: `${result.value.ok}`
							}).then(function (isConfirm) {
								if (isConfirm) {
									window.location.replace('consulta.php');
								}
							});
						}
						else if(result.value.result == 'erro'){
							swalWithBootstrapButtons.fire({
								icon: 'error',
								title: `${result.value.erro}`,
								text: `${result.value.detalhe}`
							}).then(function (isConfirm) {
								if (isConfirm) {
									window.location.replace('consulta.php');
								}
							});
						}
					}
				});
			}
		});
    });
});