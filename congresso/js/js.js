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