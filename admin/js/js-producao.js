function valida(tipo = ''){
	$('#btnEnvia').attr('disabled', false);
	$('#arquivo').removeClass('is-invalid');
	$('#arquivoFeedback').hide();
	$('#arquivoFeedback').html('');
	if(tipo != ''){
		$('#arquivo').addClass('is-valid');
	}
}
function naoValida(str){
	$('#btnEnvia').attr('disabled', true);
	$('#arquivo').addClass('is-invalid');
	$('#arquivoFeedback').show();
	$('#arquivoFeedback').html(str);
}
$(document).ready(function () {
	$('#arqPdf').change(function () {
		var id = this.id;
		try{
			var ext = this.value.split('.').pop();
			switch (ext.toLowerCase()) {//.toLowerCase() sempre minusculo
				case '':
					$('#btnEnviaForm').attr('disabled', false);
					$('#'+id).removeClass('is-invalid').removeClass('is-valid');
					$('#'+id+'Feedback').hide();
					break;
				case 'pdf':
					$('#btnEnviaForm').attr('disabled', false);
					$('#'+id).removeClass('is-invalid').addClass('is-valid');
					$('#'+id+'Feedback').hide();
					break;
				default:
					$('#btnEnviaForm').attr('disabled', true);
					$('#'+id).removeClass('is-valid').addClass('is-invalid');
					$('#'+id+'Feedback').show();
			}
		}
		catch{
			$('#'+id).removeClass('is-valid').removeClass('is-invalid');
		}
		var file_size = this.files[0].size;
		if(file_size>300*1024*1024) {
			console.log(file_size);
			$('#btnEnviaForm').attr('disabled', true);
			$('#'+id).removeClass('is-valid').addClass('is-invalid');
			$('#'+id+'Size').show();
			return false;
		}
	});
	$('#arqEpub').change(function () {
		var id = this.id;
		try{
			var ext = this.value.split('.').pop();
			switch (ext.toLowerCase()) {//.toLowerCase() sempre minusculo
				case '':
					$('#btnEnviaForm').attr('disabled', false);
					$('#'+id).removeClass('is-invalid').removeClass('is-valid');
					$('#'+id+'Feedback').hide();
					break;
				case 'epub':
					$('#btnEnviaForm').attr('disabled', false);
					$('#'+id).removeClass('is-invalid').addClass('is-valid');
					$('#'+id+'Feedback').hide();
					break;
				default:
					$('#btnEnviaForm').attr('disabled', true);
					$('#'+id).removeClass('is-valid').addClass('is-invalid');
					$('#'+id+'Feedback').show();
			}
		}
		catch{
			$('#'+id).removeClass('is-valid').removeClass('is-invalid');
		}
		var file_size = this.files[0].size;
		if(file_size>100*1024*1024) {
			console.log(file_size);
			$('#btnEnviaForm').attr('disabled', true);
			$('#'+id).removeClass('is-valid').addClass('is-invalid');
			$('#'+id+'Size').show();
			return false;
		}
	});
	$('#arqImg').change(function () {
		var id = this.id;
		try{
			var ext = this.value.split('.').pop();
			switch (ext.toLowerCase()) {//.toLowerCase() sempre minusculo
				case '':
					$('#btnEnviaForm').attr('disabled', false);
					$('#'+id).removeClass('is-invalid').removeClass('is-valid');
					$('#'+id+'Feedback').hide();
					break;
				case 'jpg':
				case 'jpeg':
				case 'png':
                case 'gif':
					$('#btnEnviaForm').attr('disabled', false);
					$('#'+id).removeClass('is-invalid').addClass('is-valid');
					$('#'+id+'Feedback').hide();
					break;
				default:
					$('#btnEnviaForm').attr('disabled', true);
					$('#'+id).removeClass('is-valid').addClass('is-invalid');
					$('#'+id+'Feedback').show();
			}
		}
		catch{
			$('#'+id).removeClass('is-valid').removeClass('is-invalid');
		}
		var file_size = this.files[0].size;
		if(file_size>2*1024*1024) {
			console.log(file_size);
			$('#btnEnviaForm').attr('disabled', true);
			$('#'+id).removeClass('is-valid').addClass('is-invalid');
			$('#'+id+'Size').show();
			return false;
		}
	});
	$('#arqMp3').change(function () {
		var id = this.id;
		try{
			var ext = this.value.split('.').pop();
			switch (ext.toLowerCase()) {//.toLowerCase() sempre minusculo
				case '':
					$('#btnEnviaForm').attr('disabled', false);
					$('#'+id).removeClass('is-invalid').removeClass('is-valid');
					$('#'+id+'Feedback').hide();
					break;
				case 'mp3':
					$('#btnEnviaForm').attr('disabled', false);
					$('#'+id).removeClass('is-invalid').addClass('is-valid');
					$('#'+id+'Feedback').hide();
					break;
				default:
					$('#btnEnviaForm').attr('disabled', true);
					$('#'+id).removeClass('is-valid').addClass('is-invalid');
					$('#'+id+'Feedback').show();
			}
		}
		catch{
			$('#'+id).removeClass('is-valid').removeClass('is-invalid');
		}
		var file_size = this.files[0].size;
		if(file_size>100*1024*1024) {
			console.log(file_size);
			$('#btnEnviaForm').attr('disabled', true);
			$('#'+id).removeClass('is-valid').addClass('is-invalid');
			$('#'+id+'Size').show();
			return false;
		}
	});
    $('#newProd').on('submit', function(event) {
		event.preventDefault();
        $('#btnEnviaForm').attr('disabled', true);
	    var formData = new FormData($('form')[0]);
        $.ajax({
            xhr : function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable && $('#arqPdf').val() != '') {
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    }
                }),
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable && $('#arqEpub').val() != '') {
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    }
                });
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable && $('#arqImg').val() != '') {
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    }
                });
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable && $('#arqMp3').val() != '') {
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    }
                });
                return xhr;
            },
            type : 'POST',
            url : 'producao.php',
            data : formData,
            processData : false,
            contentType : false,
            success : function(data) {
				console.log(data);
                if(data == 'ok'){
                    okNewPage('Produção gravada com sucesso!','producao.php');
                }    
				else{
					erroOk('Não foi possível gravar a Produção! Erro: '+data);
				}
			}
        });
	});	
	$('#cmbTipoArquivo').change(function () {
		var id = this.value;
		if(id != ''){
			$('#arquivo').attr('disabled', false);
		}
		else{
			$('#arquivo').attr('disabled', true);
		}
	});
	$('#arquivo').change(function () {
		var tipo = $('#cmbTipoArquivo').val();
		var arq = this.value.split('.').pop();
		var file_size = this.files[0].size;
		if ($('#arquivo')[0].files.length === 0) {
			if(file_size>100*1024*1024) {
				valida();
			}
		} 
		else {
			if(arq.toLowerCase() == 'pdf' & tipo == 1){
				if(file_size<300*1024*1024) {
					valida(tipo);
				}
				else{
					naoValida('Tamanho máximo para arquivo 300M.');
				}
			}
			else if(arq.toLowerCase() == 'epub' & tipo == 2){
				if(file_size<100*1024*1024) {
					valida(tipo);
				}
				else{
					naoValida('Tamanho máximo para arquivo 100M.');
				}
			}
			else if(arq.toLowerCase() == 'mp3' & tipo == 4){
				if(file_size<100*1024*1024) {
					valida(tipo);
				}
				else{
					naoValida('Tamanho máximo para arquivo 100M.');
				}
			}
			else if(tipo == 3 && (arq.toLowerCase() == 'jpg' || arq.toLowerCase() == 'jpeg' || arq.toLowerCase() == 'png' || arq.toLowerCase() == 'gif')){
				if(file_size<2*1024*1024) {
					valida(tipo);
				}
				else{
					naoValida('Tamanho máximo para arquivo 2M.');
				}
			}
			else{
				switch (tipo){
					case '1': naoValida('Somente arquivos no formato PDF.'); break;
					case '2': naoValida('Somente arquivos no formato ePub.'); break;
					case '3': naoValida('Somente arquivos no formato jpg, jpeg, png ou gif.'); break;
					case '4': naoValida('Somente arquivos no formato mp3.'); break;
				}
			}			
		}
	});
    $('#docEstrang').on('submit', function(event) {
		event.preventDefault();
        $('#btnEnvia').attr('disabled', true);
        $('#btnEnvia').val('Adicionando...');
		$('.progress').show();
	    var formData = new FormData($('form')[0]);
        $.ajax({
            xhr : function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable && $('#arquivo').val() != '') {
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    }
                });
                return xhr;
            },
            type : 'POST',
            url : 'producao.php',
            data : formData,
            processData : false,
            contentType : false,
            success : function(data) {
				console.log(data);
                if(data == 'ok'){
                    okNewPage('Arquivo adicionado a produção com sucesso!','producao.php');
                }    
				else{
					erroOk('Erro: '+data);
				}
			}
        });
	});	
});