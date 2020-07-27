<?php get_header(); ?>
<div class="row">
  <div class="col-md-8">
  <!-- S'il y a des articles, tant qu'il y ait des articles, afficher l'article. -->
    <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
      get_template_part( 'content', get_post_format() );
      endwhile; endif;
    ?>
  </div><!-- /.blog-main -->
  <?php get_sidebar(); ?>
</div> <!-- /.row -->
<?php get_footer(); ?>