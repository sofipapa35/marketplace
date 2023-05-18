$(document).ready(function(){
//     $('.dropd-ul').hide();
//     $(".nav-button").on("click", function(){
//             $(this).find('ul').slideToggle(400); 
//             $('.nav-button ul').not($(this).find('ul')).hide();
// });

$("#annonce_categorie").on("change", function () {
    var cat = $(this).val();
    console.log(cat);
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

// isActive ------------

$('.checkboxIsActive').click(function(){
    if($(this).prop("checked") == true){
        var name = $(this).attr('name');
        console.log(name)
        var id = $(this).val();
        console.log(id);
        $.ajax({
            url: 'setIsActive',
            type: 'POST',
            data: {
                'id' : id,
                'name' : name
            }
        })
    }
    else if($(this).prop("checked") == false){
        var name = $('.checkboxIsActive').attr('name');
        console.log(name)
        var id = $(this).val();
        console.log(id);
        $.ajax({
            url: 'unSetIsActive',
            type: 'POST',
            data: {
                'id' : id,
                'name' : name
            }
        })
    }
});

// ----------------------- Dropdown Admin Search --------------
$('.dropdown-menu').hide();
$('.filter-button').clicl(function(){
$('.dropdown-menu').show();
})

});