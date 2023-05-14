$(document).ready(function(){
    $('.dropd-ul').hide();
    $(".nav-button").on("click", function(){
            $(this).find('ul').slideToggle(400); 
            $('.nav-button ul').not($(this).find('ul')).hide();
});

$("#annonce_categorie").on("change", function () {
    var cat = $(this).val();
    
console.log($("#annonce_categorie").val());
    $.ajax({
        url: 'getSousCategorie',
        type: 'POST',
        data: {
            'cat' : cat
        }
    }).done(function (response) {
        $("#sous").html(response);
    })
});
$("#sous").on("change", function () {
console.log($("#sous").val());
});

});