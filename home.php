<!-- This is the home page template for the blogposts how will last blog posts will be displayed, 
    If nothing set on settings => reading, this will be the front-page website --> 
<?php get_header(); ?>
<div id="page">
  <div class="container">
    <div class="row">
      <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
          include( 'post-listed.php' );
        endwhile; endif;
      ?>
    </div> <!-- /.row -->
  </div> <!-- /.container -->
</div> <!-- /.page -->
<?php get_footer(); ?>