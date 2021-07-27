(function( $ ) {

  if (document.getElementById("retail")){
    document.getElementById("retail").onclick = function() {
      $(this).addClass("is-active");
      $("#pro").removeClass("is-active");
      $("#reg_role").value = "customer";
      $("#tab-pro").toggle("d-none");
      $("#tab-retail").toggle("d-none");
    }
   
    document.getElementById("pro").onclick = function() {
      $(this).addClass("is-active");
      $("#retail").removeClass("is-active");
      $("#tab-pro").toggle("d-none");
      $("#tab-retail").toggle("d-none");
      
    }
  }
})( jQuery );