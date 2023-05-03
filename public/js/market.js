$(document).ready(function(){
    $('.dropd-ul').hide();
    $(".nav-button").on("click", function(){
            $(this).find('ul').slideToggle(400); 
            $('.nav-button ul').not($(this).find('ul')).hide();
});
});