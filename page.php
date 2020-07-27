<!-- This template is used when visitors request individual pages -->

<?php get_header(); ?>

<div id="page" >
  <div class="container">
      <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
      get_template_part( 'content', get_post_format() );
      endwhile; endif;
      ?>
  </div> <!-- /.container -->
</div> <!-- ./page -->
<?php get_footer(); ?>
