const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
	  confirmButton: 'btn btn-success btnJS',
	  cancelButton: 'btn btn-danger btnJS'
	},
	buttonsStyling: false
});
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
function lingua(lang){
    $.post("config/lingua.php",
    {
        lang: lang
    },
    function () {
        location.reload(true);
    });
}
$(document).ready(function () {
    $.post("visita.php",
    {
        visita: "true"
    },
    function (data) {
        //console.log(data);
    });
});