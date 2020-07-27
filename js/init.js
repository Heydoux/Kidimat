(function( $ ) {
  
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
  
})( jQuery );