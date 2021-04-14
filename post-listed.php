
<?php if (!get_next_post_link()): ?>
  <div class="col-md-12 mb-5">
      <article class="mx-5 d-flex row">    
          <div class="col-md-6">
            <p class="px-3 img-blogpost">
              <?php if (has_post_thumbnail() ) {
                  the_post_thumbnail();
                }
              ?>
            </p>
          </div>
          <div class="article-desc col-md-6">
            <div class="px-3">
              <h2 class=""><?php the_title(); ?></h2>
              <div class="excerpt">
                <?php echo get_excerpt(get_the_excerpt(), 90); ?>
              </div>
              <div class="more pt-4 text-right">
                <a class="btn-kidimat" href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'bellevillebyboson'), the_title_attribute('echo=0')); ?>" rel="bookmark">Lire plus </a>
              </div>
            </div>
          </div>
        </article>
  </div>
<?php else: ?>
  <div class="col-md-4">
    
      <article class="mx-5">
        <div class="px-3 img-blogpost">
          <p>
            <?php if (has_post_thumbnail() ) {
                the_post_thumbnail();
              }
            ?>
          </p>
        </div>
        <div class="article-desc">
          <h3 class=""><?php the_title(); ?></h3>
          <div class="excerpt">
            <?php echo get_excerpt(get_the_excerpt(), 90); ?>
          </div>
          <div class="more pt-4 text-center">
            <a class="btn-kidimat" href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'bellevillebyboson'), the_title_attribute('echo=0')); ?>" rel="bookmark">Lire plus </a>
          </div>
        </div>
      </article>
    
  </div>
<?php endif; ?>