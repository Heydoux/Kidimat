<!-- This template is used when visitors request individual pages -->

<?php get_header(); ?>


<div id="page" >
<?php the_post_thumbnail(); ?>
<div class="container <?php if (is_account_page()): ?>account-page<?php endif; ?>">

    <?php
      if (is_account_page() || is_checkout() || is_cart()) :
    ?>
    <div class="position-relative ">
      <h2 class="page-single-title text-uppercase"><?php the_title(); ?></h3>
    </div>

    <?php endif; ?>
      <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
      get_template_part( 'content', get_post_format() );
      endwhile; endif;
      ?>
  </div> <!-- /.container -->
</div> <!-- ./page -->
<?php get_footer(); ?>
