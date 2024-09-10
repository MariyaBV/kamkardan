<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kamkardan
 */

$options = get_fields('options');
?>
	<footer>
		<div class="footer-content">
			<div class="custom wrap">
				<div class="footer-left">
					<a class="logo-container" href="<?= home_url(); ?>">
						<img src="<?= $options['logoes']['logo-big-white']; ?>" alt="Тульский карданный завод" class="footer-logo" />
					</a>

					<p class="txt-company-name">© 2013–2024 <br>
					<?= $options['company-name']; ?></p>
				</div>

				<div class="footer-center txt-normal">
					<?php wp_nav_menu('menu=bottom-menu');?>
				</div>

				<div class="footer-right txt">
					<div class="footer-contacts">
						<a href="tel:<?= $options['phone']; ?>" class="icon-container">
							<span class="icon-phone-3"></span>
							<div>
								<p class="txt-s"><?= $options['phone']; ?></p>
								<p class="subtitle-xs">
									<?= $options['operating_mode']; ?>
								</p>
							</div>
						</a>
						<a class="icon-container" href= "mailto: <?= $options['email']; ?>">
							<span class="icon-Frame-44"></span>
							<p><?= $options['email']; ?></p>
						</a>
						<a href="/contacts/" class="icon-container">
							<span class="icon-Frame-43"></span>
							<p><?= $options['address']; ?></p>
						</a>
					</div>
					<a class="footer-made-in" href="https://ars-creative.com/" class="txt-company-name">"Сделано в  ARS CREATIVE"</a>
				</div>
			</div>
			<div class="made-in-mobile">
				<a class="footer-made-in" href="https://ars-creative.com/" class="txt-company-name">"Сделано в  ARS CREATIVE"</a>
				<p class="txt-company-name">© 2013–2024 <br>
				<?= $options['company-name']; ?></p>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>
