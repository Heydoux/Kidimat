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
  if (document.getElementById("tab-title-description")){
    document.getElementById("tab-title-description").classList.add("active");
  }
  
  if($('.decrement-btn')){
    $(".increment-btn").on('click', function() {
      var input = this.previousElementSibling
      var value = parseInt(input.value, 10);
      value++;
      input.value = value;
      var decrement = this.previousElementSibling.previousElementSibling;
      decrement.disabled = false;
      document.getElementById("update-btn").disabled = false;
      
    });
   
    $('.decrement-btn').on('click', function(){
      var input = this.nextElementSibling;
      input.value -= 1;
      document.getElementById("update-btn").disabled = false;
      if (input.value == 1){
        this.disabled = true;
      }
    });
  }

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

  
})( jQuery );