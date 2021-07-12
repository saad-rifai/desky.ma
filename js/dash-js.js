function toggel_side_bar() {
    $("#toggel-check").click();
      var tgval = $("#toggel-check").val();
      //alert(tgval);
      if($("#toggel-check").is(':checked')){
          $(".side-bar").css("right", "-0px");
          $("main").css("margin-right", "18%");

      }else{
          $(".side-bar").css("right", "-295px");
          $("main").css("margin-right", "0px");

      }

  }
