<?php get_header(); ?>

<div class="row-fluid wpPage">
  <?php 
        if ( have_posts() ) : while ( have_posts() ) : the_post();
      ?>

  <div class="span8">
    <div <?php post_class('card'); ?>>

      <div class="card-header">
        <div class="row-fluid">
          <?php 
            $category = get_the_category();
          ?>
          <div class="span10">
            <a href="<?php echo get_category_link($category[0]->term_id );?>" title="<?php the_title(); ?>" class="">
              <span class="cat-container" data-hover="<?php echo $category[0]->cat_name;?>"><?php echo $category[0]->cat_name;?></span>
            </a>
            <span class="date"><?php the_time('j F Y'); ?></span>
          </div>
          <div class="span2">
            <!-- FB -->
            <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;width=95&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21&amp;appId=586697874712018" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px; width:95px" allowTransparency="true" class="pull-right"></iframe>
          </div>
        </div>
        
        
      
      </div>

      <div class="card-body">
        <h1><?php the_title(); ?></h1>
        <hr class="short">
        <?php if ( has_post_thumbnail() ) { echo get_the_post_thumbnail($post->ID, 'single-full' ); } ?>
        <?php the_content(); ?>
      </div>


    </div> <!--card-->
    <div class="card meta">
      <h2>Share This</h2>
      <hr class="short">
      
      <!-- FB -->
      <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;width=135&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21&amp;appId=586697874712018" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px; width:145px" allowTransparency="true"></iframe>
      <!-- TW -->
      <a href="//twitter.com/share" class="twitter-share-button" data-hashtags="EmbassyEnglish">Tweet</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
      <!-- G+ -->
      <div class="g-plusone" data-size="medium"></div>
      <script type="text/javascript">
        (function() {
          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
          po.src = 'https://apis.google.com/js/platform.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
      </script>



    </div> 
    <div class="card comments">
      <h2>Comments</h2>
      <hr class="short">
      <?php comments_template(); ?>    
    </div> 
  </div> <!--span8-->


  <?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  <?php endif; ?>

  <div class="span4">
    <?php get_sidebar(); ?>
  </div>

 <!-- Close row div -->
</div>
  
<?php get_footer(); ?>