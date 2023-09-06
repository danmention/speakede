
var SITE_URL = window.location.origin;

$(function () {
    count = 0;
    wordsArray = ["Yoruba", "Pidgin", "Ibo", "Hausa"];
    setInterval(function () {
        count++;
        $("#word").fadeOut(400, function () {
            $(this).text(wordsArray[count % wordsArray.length]).fadeIn(400);
        });
    }, 2000);
});


$(document).ready(function(){
    $("#group_class").click(function(event){
        $("#private_class_view").hide();
        $("#group_class_view").show();
    });
    $("#private_class").click(function(event){
        $("#private_class_view").show();
        $("#group_class_view").hide();
    });
});




$("#checkbox1").on("change", function() {
    var href = SITE_URL, params = $(this).serialize();
    if (params.length > 0) { href += "/all-course?" + params; }
    window.location.href= href;
});

$("#checkbox2").on("change", function() {
    var href = SITE_URL, params = $(this).serialize();
    if (params.length > 0) { href += "/all-course?" + params; }
    window.location.href= href;
});

$("#checkbox_group1").on("change", function() {
    var href = SITE_URL, params = $(this).serialize();
    if (params.length > 0) { href += "/group/online/class?" + params; }
    window.location.href= href;
});

$("#checkbox_group2").on("change", function() {
    var href = SITE_URL, params = $(this).serialize();
    if (params.length > 0) { href += "/group/online/class?" + params; }
    window.location.href= href;
});


function CheckedBox(url) {
    window.location.href= (SITE_URL += "theme?link=" + url.value);
}


