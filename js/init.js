(function( $ ) {
  /*
  document.getElementById("hamburger-menu").onclick = function(e){
    
    e.preventDefault();
    if(document.getElementById("navigation-principale").classList.contains("d-none")){
      document.getElementById("navigation-principale").classList.remove("d-none");
      document.getElementById("navigation-principale").classList.add("d-block");
    }else{
      document.getElementById("navigation-principale").classList.remove("d-block");
      document.getElementById("navigation-principale").classList.add("d-none");
    }
    
  }
  */
  /* Delete if we activate client reviews */
  
  
  if($('.decrement-btn')){
    
    $(".increment-btn").on('click', function() {
      var input = this.previousElementSibling
      var value = parseInt(input.value, 10);
      value++;
      input.value = value;
      var decrement = this.previousElementSibling.previousElementSibling;
      decrement.disabled = false;
      if($("#update-btn").length){
        document.getElementById("update-btn").disabled = false;
      }
    });
   
    $('.decrement-btn').on('click', function(){
      var input = this.nextElementSibling;
      input.value -= 1;
      if($("#update-btn").length){
        document.getElementById("update-btn").disabled = false;
      }
      if (input.value == 1){
        $(this)[0].disabled = true;        
      }
    });
  }

  $("#burger-btn").on("click", function() {
    console.log("menu mobile click");
    $("#navigation-principale-mobile").toggleClass("d-none");
    if (!$("#navigation-principale-mobile").hasClass("d-none")){
      $("#header-menu").css("height", "100vh");
    } else {
      $("#header-menu").css("height", "unset");
    }
  });

  $(document).ready(function(){
    if(document.getElementsByClassName("increment-btn")){
      var decrements = document.getElementsByClassName("decrement-btn");
      for (var i = 0; i < decrements.length; i++)
      {
        var input = decrements[i].nextElementSibling;
        if (input.value > 1){
          decrements[i].disabled = false;
        }
      }
    }
  });

  $('form.checkout').on('change', 'input[name^="shipping_method"]', function(){
    var inputs = $('.shipping_method');
    for (var i = 0; i < inputs.length; i++){
      var value = inputs[i].value;
      if (value.indexOf('flat_rate') >= 0){
        console.log('toto');
      }
    }
  });

})( jQuery );