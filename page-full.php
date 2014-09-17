<?php
/*
Template Name: Full-width page
*/

get_header();
?>


<div class="row-fluid wpPage">

  <div class="span12">
      <div class="card">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>



          <div class="card-header">
            <div class="row-fluid">
              <div class="span6">
                <h1><?php the_title(); ?></h1>
                <hr class="short">
              </div>
              <div class="span6">
                <!-- FB -->
                <iframe class="pull-right" src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;width=95&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21&amp;appId=586697874712018" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px; width:95px" allowTransparency="true"></iframe>
                <!-- TW -->
                <a href="//twitter.com/share" class="twitter-share-button pull-right" data-hashtags="EmbassyEnglish">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                <!-- G+ -->
                <div class="pull-right"><div class="g-plusone" data-size="medium"></div></div>
                <script type="text/javascript">
                  (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/platform.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                  })();
                </script>
              </div>
            </div>
          </div>

          <div class="card-body">
            <?php the_content(); ?>
          </div>




       

        <?php endwhile; else: ?>
              <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>

      </div> <!-- card -->
      
  

    </div><!-- span12 -->

 <!-- Close row-fluid wpPage div -->
</div>
  
<?php get_footer(); ?>


