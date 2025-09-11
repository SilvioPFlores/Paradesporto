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
    $('#pcdS').click(function(){
        $('.classePcd').show(700);
		$('#cmbPcd').attr('required', true);
    });
    $('#pcdN').click(function(){
        $('.classePcd').hide(400);
        $('#cmbPcd').val('');
        $('#txtApoio').val('');
		$('#cmbPcd').attr('required', false);
    });
});