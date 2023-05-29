$(document).ready(function () {

  $("#annonce_categorie").on("change", function () {
    var cat = $(this).val();
    $.ajax({
      url: "getSousCategorie",
      type: "POST",
      data: {
        cat: cat,
      },
    }).done(function (response) {
      $("#sous").html(response);
    });
  });

  // isActive ------------

  $(".checkboxIsActive").click(function () {
    if ($(this).prop("checked") == true) {
      var name = $(this).attr("name");
      var id = $(this).val();
      console.log(id);
      $.ajax({
        url: "setIsActive",
        type: "POST",
        data: {
          id: id,
          name: name,
        },
      });
    } else if ($(this).prop("checked") == false) {
      var name = $(".checkboxIsActive").attr("name");
      var id = $(this).val();
      console.log(id);
      $.ajax({
        url: "unSetIsActive",
        type: "POST",
        data: {
          id: id,
          name: name,
        },
      });
    }
  });

  // Dropdown Admin Search --------------
  $(".dropdown-search").hide();
  $(".filter-button").click(function () {
    $(this).siblings().toggle();
  });

  $(".search").keyup(function () {
    var input = $(this).val();
    var name = $(this).attr("name");
    if (input != "") {
      $.ajax({
        url: "/search",
        type: "POST",
        data: {
          value: input,
          name: name,
        },
      }).done(function (response) {
        $(".result").html(response);
        $(".ann-all").addClass("hidden");
      });
    } else {
      $(".result").html("");
      $(".ann-all").removeClass("hidden");
    }
  });

  // admin find non valid --------------
  $("#findNonValid").click(function () {
    if ($(this).prop("checked") == true) {
      $.ajax({
        url: "findNonValid",
      }).done(function (response) {
        $(".result").html(response);
        $(".ann-all").addClass("hidden");
      });
    } else if ($(this).prop("checked") == false) {
        $(".result").html('');
        $(".ann-all").removeClass("hidden");
    }
  });
});