    </div>
    <footer id="blog-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 ">
            <div class="mb-4">
              <h5>KIDIMAT</h5>
            </div>
            <p>Z.A. du Pré Barreau <br>49630 Mazé-Milon</p>
            <p>contact@kidimat.com</p>
            <ul class="social-media-icons d-flex pt-2">
              <li class="m-1">
                <a class="facebook-icons" href="https://fr-fr.facebook.com/kidimat49/" target="_blank">
                  <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/images/facebook-logo.jpg">
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="mb-4">
              <h5>INFORMATION</h5>
            </div>
            <?php wp_nav_menu( array ("theme_location" => "footer") ); ?>
          </div>
          <div class="col-md-4">
            <div class="mb-4">
              <h5>HORAIRES</h5>
            </div>
            <p>Du lundi au vendredi de 8h00 à 12h00 et de 13h30 à 18h00</p>
            <p>Et le samedi de 8h00 à 12h00 et de 14h00 à 17h00</p>
          </div>
        </div>
        <p class="text-center mt-3">Par <a class="wap-footer" href="https://www.webagenceparis.com/">WAP Web Agence Paris</a>.</p>
      </div>
    </footer>    
    <?php wp_footer(); ?>
  </body>
</html>