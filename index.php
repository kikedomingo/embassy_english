<?php get_header(); ?>



<div class="row-fluid wpPage">

  <div class="span8">

      <?php if ( is_category() ) { ?>
        <div class="card taxonomy_title">
          <h2><?php single_cat_title('Category "'); ?>"</h2>
        </div>
      <?php } elseif ( is_tag() ) { ?>
        <div class="card taxonomy_title">
          <h2><?php single_cat_title('Tag "'); ?>"</h2>
        </div>
      <?php } elseif ( is_search() ) { ?>
        <div class="card taxonomy_title">
          <h2>Search "<?php echo get_search_query(); ?>"</h2>
        </div>
      <?php } ?>


      <!-- Loop through individual news articles -->
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


          <div id="post-<?php the_ID(); ?>" <?php post_class('row-fluid card'); ?>>

            <div class="<?php if ( has_post_thumbnail() ) { echo "span8"; } else { echo "span12"; } ?>">
              <div class="card-header">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <span class="cat-container"><?php $category = get_the_category(); echo  $category[0]->cat_name;?></span>
                </a>
                
                <span class="date"><?php the_time('j F Y'); ?></span>
              </div>
              <div class="card-body">
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                <hr class="short">
                <?php the_excerpt(); ?>
              </div>
            </div>

            <?php
              if ( has_post_thumbnail() ) {
            ?>

                <div class="span4">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="featured">
                    <?php echo get_the_post_thumbnail($post->ID, 'homepage-thumb' );  ?>
                    
                  </a>
                </div>
                
            <?php
              }
            ?>

          </div>

                 
      <?php endwhile; else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
      <?php endif; ?>
      



  </div>
  <div class="span4">
    <?php get_sidebar(); ?>
  </div>

 <!-- Close row div -->
</div>



<?php get_footer(); ?>