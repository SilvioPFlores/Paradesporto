function exibeLivro(num){
	$('.cd0').hide(1000);
	$('.in0').attr('required', false);
	$('.in0').val('');
	setTimeout(1000);
	if(num != ''){
		$('.cdAll').show(1000);
		$('.cd'+num).show(1000);
		$('.inAll').attr('required', true);
		$('.in'+num).attr('required', true);
	}
}
$(document).ready(function () {

	try{
		var phoneInputID = "#phone";
		var input = document.querySelector(phoneInputID);
		var iti = window.intlTelInput(input, {
			formatOnDisplay: true,
			preferredCountries: ["br", "us", "es"],
			hiddenInput: "full_number",
			utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
		});
		$(phoneInputID).on("countrychange", function (event) {

			// Get the selected country data to know which country is selected.
			var selectedCountryData = iti.getSelectedCountryData();
			// Get an example number for the selected country to use as placeholder.
			newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
				// Reset the phone number input.
				iti.setNumber("");
			// Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
			mask = newPlaceholder.replace(/[1-9]/g, "0");
			// Apply the new mask for the input
			$(this).mask(mask);
		});
		// When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
		// but after making sure that the plugin is fully loaded by associating handler to the promise of the 
		// plugin instance.
		iti.promise.then(function () {
			$(phoneInputID).trigger("countrychange");
		});
	}
    catch(error){
		console.log(error);
	}

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

	$('INPUT[type="file"]').change(function () {
        var arq = this.value.split('.').pop();
        
		if ($('#trabalhoPDF')[0].files.length === 0) {
            $('#btnEnviaForm').attr('disabled', false);
			$('#trabalhoPDF').removeClass('is-invalid');
			$('#trabalhoFeedback').hide();
			$('#trabalhoFeedback').html('');
		} 
		else {
			if(arq.toLowerCase() == 'pdf'){
				var file_size = this.files[0].size;
				if(file_size < 300*1024*1024) {
					$('#trabalhoFeedback').hide();
					$('#trabalhoFeedback').html('');
					$('#trabalhoPDF').removeClass('is-invalid');
					$('#btnEnviaForm').attr('disabled', true);
					
					var formData = new FormData($('form')[0]);
					$.ajax({
						xhr : function() {
							$('.progress').show();
							var xhr = new window.XMLHttpRequest();
							xhr.upload.addEventListener('progress', function(e) {
								if (e.lengthComputable && $('#trabalhoPDF').val() != '') {
									var percent = Math.round((e.loaded / e.total) * 100);
									$('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
								}
							});
							return xhr;
						},
						type : 'POST',
						url : 'uploadMaterial.php',
						data : formData,
						processData : false,
						contentType : false,  
						beforeSend: function () {
							$('#trabalhoPDF').attr('disabled', true);
						},         
						success : function(data) {
							var objData = JSON.parse(data);
							if(objData['erro'] == ''){
								$('#divNomeTrabalho').show();
								$('#txtUpado').html(objData['original']);
								$('.progress').hide();
								$('#trabalhoPDF').val('');
								$('#hdnNameTrabalho').val(objData['novo']);
							}
							else{
								swalWithBootstrapButtons.fire({
									text: objData['erro'],
									icon: 'error',
									confirmButtonText: 'Ok',
								});
							}
							$('#btnEnviaForm').attr('disabled', false);
						}
					});
				}
				else{
					$('#btnEnviaForm').attr('disabled', true);
					$('#trabalhoPDF').addClass('is-invalid');
					$('#trabalhoFeedback').show();
					$('#trabalhoFeedback').html('Tamanho máximo para arquivo 300M.');
				}
			}
			else{
				$('#btnEnviaForm').attr('disabled', true);
				$('#trabalhoPDF').addClass('is-invalid');
				$('#trabalhoFeedback').show();
				$('#trabalhoFeedback').html('Somente arquivos no formato PDF.');
			}
		}
	});

	$('#btnExclui').click(function () {
		$('#btnEnviaForm').attr('disabled', true);
		let strNome = $('#hdnNameTrabalho').val();
		$.post("uploadMaterial.php",
            {
                excluiTrabalho: "exclui",
                nomeTrabalho: strNome 
            },
            function (data) {
                if(data == 1){
					$('#btnEnviaForm').attr('disabled', false);
					$('#trabalhoPDF').attr('disabled', false);
					$('#divNomeTrabalho').hide();
					$('#txtUpado').html('');
					$('#hdnNameTrabalho').val();
				}
            });
	});
});