(function( $ ) {

  if (document.getElementById("retail")){
    document.getElementById("retail").onclick = function() {
      this.classList.add("is-active");
      document.getElementById("pro").classList.remove("is-active");
      document.getElementById("tab-container").classList.add("retail");
      document.getElementById("tab-container").classList.remove("custopro");
      document.getElementById("reg_role").value = "customer";
    }
   
    document.getElementById("pro").onclick = function() {
      this.classList.add("is-active");
      document.getElementById("retail").classList.remove("is-active");
      document.getElementById("tab-container").classList.remove("retail");
      document.getElementById("tab-container").classList.add("custopro");
      document.getElementById("reg_role").value = "client professionnel";
    }
  }
})( jQuery );