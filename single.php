<!-- The single post template is used when a visitor request a single post --> 
<?php get_header(); ?>
<div id="page" class="single">
  <div class="container">
    <div class="row">
      <div class="offset-md-2 col-md-8 mt-5">
        <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        ?>
        <div class="img-thumbnail text-center">
          <?php if (has_post_thumbnail() ) {
            the_post_thumbnail();
          }
          ?>
        </div>
        <h1 class="blog-post-title"><?php the_title(); ?></h2>
        <p class="blog-post-meta"><?php the_date(); ?> </p>
        <?php
        get_template_part( 'content', get_post_format() );
        endwhile; endif;
        ?>
      </div> <!-- /.col -->
    </div> <!-- /.row -->
  </div>
</div>
<?php get_footer(); ?>