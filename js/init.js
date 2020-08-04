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
  
  if(document.getElementById("increment-btn")){
    document.getElementById("increment-btn").onclick = function() {
      var input = this.previousElementSibling
      var value = parseInt(input.value, 10);
      value++;
      input.value = value;
      document.getElementById("decrement-btn").disabled = false;
    }

    document.getElementById("decrement-btn").onclick = function() {
      var input = this.nextElementSibling;
      input.value -= 1;
      if (input.value == 1){
        this.disabled = true;
      }
    }
  }

  
})( jQuery );