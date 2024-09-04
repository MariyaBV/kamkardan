<div class="step-item">
    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); 
    ?>"  />
    <p class="step-subtitle"><?php the_title(); ?></p>
    <a href="<?php echo get_the_permalink(); ?>"></a>
</div>