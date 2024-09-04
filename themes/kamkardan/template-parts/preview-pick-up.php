<div class="step-item pick-up">
    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); 
    ?>"  />
    <hr>
    <h3 class="step-subtitle"><?php the_title(); ?></h3>
    <a href="<?php echo get_the_permalink(); ?>"></a>
</div>