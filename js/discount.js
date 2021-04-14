(function( $ ) {
  
  if (document.getElementById("discount-manager")){
    $("#modify-discount").click(function() {
      $("#discount-detail input").prop("disabled", false);
      $("#save-discount").removeClass("d-none");
      $("#modify-discount").addClass("d-none");
    });
   
    document.getElementById("save-discount").onclick = function() {
      $("#discount-detail input").prop("disabled", true);
      $("#save-discount").addClass("d-none");
      $("#modify-discount").removeClass("d-none");
    }

    $(".company-btn").click(function() {
      $("#discount-detail input").prop("disabled", true);
      $(".company-name h3")[0].id = $(this)[0].id;
      $(".company-name h3")[0].innerHTML = $(this)[0].outerText;
      $(".company-btn").parent().removeClass("active");
      $(this).parent().addClass("active");
      $.ajax({
        url: ajaxurl,
        data: {
          action: "get_pro_discounts",
          company_id: $(this)[0].id
        },
        type: "POST",
        beforeSend: function(xhr) {
        },
        success: function(data) {
          data = JSON.parse(data);
          $("#percent_discount_pro")[0].value = data[0].discount_rate;
          for (var i = 0; i < $(".check-cat").length; i++){
            $(".check-cat")[i].checked = false;
          }
          for(var i = 0; i < data.length; i++){
            $("#category-" + data[i].category_id)[0].checked = true;
          }
        }
      });
      return false;
    });

    $("#save-discount").click(function() {
      var percentvalue = $("#percent_discount_pro")[0].value;
      var cat_inputs = $("#save-discounts .cat_discount input");
      var company_name = $(".company-name h3")[0].outerText;
      var company_id = $(".company-name h3")[0].id;
      var cat_list = [];
      for (var i = 0; i < cat_inputs.length; i++){
        if (cat_inputs[i].checked){
          var catId = cat_inputs[i].id;
          catId = catId.substring(9, catId.lenght);
          cat_list.push(catId);
        }
      }
      $.ajax({
        url: ajaxurl,
        data: {
          action: "save_pro_discounts",
          company_id: company_id,
          company_name: company_name,
          percent_value: percentvalue,
          cat_list_id: cat_list
        },
        type: "POST",
        beforeSend: function(xhr) {

        },
        success: function(data) {
          console.log("Enregistré");
        }
      });
      return false;
    });
    
  }
})( jQuery );