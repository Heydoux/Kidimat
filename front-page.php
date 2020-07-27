<!-- This is the website homepage template like landing page 
    If nothing set on settings => reading, this will be the front-page website --> 
<?php get_header(); ?>
  <div id="front-page" class="">
    <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
      get_template_part( 'content', get_post_format() );
      endwhile; endif;
      ?>
  </div>

<?php get_footer(); ?>