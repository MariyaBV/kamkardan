<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kamkardan
 */

get_header();
?>

	<main id="primary" class="site-page">
		<div class="wrap">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</div>
		<?php if(is_product_category() || is_shop()): ?>
			<div class="block-search full-width-block">
				<?php echo do_shortcode('[search_block_custom]'); ?>
			</div>
		<?php endif; ?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
