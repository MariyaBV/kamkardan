<?php
/*
Template Name: шаблон для страницы подобрать
*/
get_header();
?>

<main id="primary" class="site-page">
		<div class="wrap">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

                <?php
                // Получаем текущий ID страницы
                $parent_id = get_the_ID();

                // Параметры для получения дочерних страниц
                $args = array(
                    'post_type'      => 'page',
                    'parent'    => $parent_id,
                    'post_status'  => 'publish',
                );

                // Получаем дочерние страницы
                $child_pages = get_pages($args);

                if (!empty($child_pages)) {
                    echo '<div class="steps bottom">';

                    foreach ($child_pages as $itm) {
                        $GLOBALS['post'] = $itm;
                        setup_postdata($itm);
                        get_template_part( 'template-parts/preview', 'pick-up' );
                    }
                    wp_reset_postdata();
                    echo '</div>';
                } else {
                    echo 'У этой страницы нет дочерних страниц.';
                }
                ?>

		</div>
		
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
