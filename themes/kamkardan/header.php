<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kamkardan
 */
$options = get_fields('option');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'kamkardan' ); ?></a>

	<header id="main-header" class="site-header">
		<div class="header-top">
			<div class="wrap-header header-top__block">
				
				<?php if (!empty($options['logoes']['logo-big-black'])): ?>
					<a class="header-block-logo" href="<?php echo esc_url(home_url()); ?>">
						<img src="<?php echo esc_url($options['logoes']['logo-big-black']); ?>" alt="<?php esc_attr_e('Site Logo', 'kamkardan'); ?>" />
					</a>
				<?php endif; ?>
				<div class="header-block-search">
					<form role="search" method="get" class="woocommerce-product-search header-search" action="<?php echo esc_url(home_url('/')); ?>">
						<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="Поиск вала по номеру" value="<?php echo get_search_query(); ?>" name="s" />
						<button class="header-search__button" type="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'woocommerce'); ?>"><span class="icon-Search-3"></span></button>
						<input type="hidden" name="post_type" value="product" />
					</form>
				</div>
				<div class="header-block-contacts">
					<?php if (!empty($options['phone'])): ?>
						<p class="header-block-contacts__phone"><?php echo esc_html($options['phone']); ?></p>
					<?php endif; ?>
					<?php if (!empty($options['operating_mode'])): ?>
						<p class="header-block-contacts__operating-mode">
							<?php echo esc_html($options['operating_mode']); ?>
						</p>
					<?php endif; ?>
				</div>
				<button class="red-button-L" id="callbackButton">Обратный звонок</button>
				<div class="header-block-contacts__callback-form" id="callbackForm" style="display:none;">
					<div class="callback-form-block">
						<form id="callbackRequestForm">
							<a class="callback-form-block__close" id="closeCallbackForm"><span class="icon-Close-3"></span></a>
							<h3 class="callback-form-block__title">Оформление заказа</h3>
							<input type="hidden" id="callback-type" value="callback_request" />
							<div class="callback-form-block__block-input">
								<label class="txt-normal" for="callback-name">Имя <span class="red-text">*</span></label>
								<input placeholder="Иван" type="text" id="callback-name" name="name" required>
							</div>
							<div class="callback-form-block__block-input">
								<label class="txt-normal" for="callback-phone">Телефон <span class="red-text">*</span></label>
								<input placeholder="+7(ххх)ххх-хх-хх" type="text" id="callback-phone" name="phone" required>
							</div>
							<button class="red-button-medium mrg-0-auto mrg-top-32" type="submit">Оставить заявку</button>
							<a class="block-callback-form__policy-link callback-form-block__policy-link" href="/privacy-policy/">Нажимая кнопку «Оформить заявку», вы&nbsp;соглашаетесь с&nbsp;обработкой своих персональных данных в&nbsp;соответствии с&nbsp;нашей Политикой конфиденциальности.</a>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="header-bottom">
			<div class="wrap-header header-bottom__block">
				<div class="header-block-menu">
				<div class="menu-top-menu-container">
						<?php
						$menu_name = 'top-menu';
						$menu_items = get_menu_items_with_classes($menu_name);
						$menu_tree = array();
						
						// Строим дерево меню
						foreach ($menu_items as $menu_item) {
							if (!$menu_item->menu_item_parent) {
								$menu_tree[$menu_item->ID] = array(
									'item' => $menu_item,
									'children' => array()
								);
							} else {
								$menu_tree[$menu_item->menu_item_parent]['children'][] = $menu_item;
							}
						}

						// Выводим дерево меню
						echo '<ul id="menu-top-menu" class="menu">';
						foreach ($menu_tree as $node) {
							$menu_item = $node['item'];
							$classes = implode(' ', $menu_item->classes);
							
							if (!empty($node['children'])) {
								// Если есть дочерние элементы, добавляем класс для выпадающего списка
								echo '<li class="menu-item-has-children ' . esc_attr($classes) . '">';
							} else {
								echo '<li class="' . esc_attr($classes) . '">';
							}

							echo '<a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a>';

							// Если есть дети, создаем подменю
							if (!empty($node['children'])) {
								echo '<ul class="sub-menu">';
								foreach ($node['children'] as $child) {
									$child_classes = implode(' ', $child->classes);
									echo '<li class="' . esc_attr($child_classes) . '">';
									echo '<a href="' . esc_url($child->url) . '">' . esc_html($child->title) . '</a>';
									echo '</li>';
								}
								echo '</ul>';
							}

							echo '</li>';
						}
						echo '</ul>';
						?>
				</div>
				<?php if (function_exists('custom_woocommerce_header_cart')) {
					custom_woocommerce_header_cart();
				} ?>
			</div>
		</div>
		</div>

		<div class="header-block-menu-mobile">
			<div class="header-block-contacts">
				<?php if (!empty($options['logoes']['logo-gorizontal-little'])): ?>
					<a class="header-block-logo" href="<?php echo esc_url(home_url()); ?>">
						<img src="<?php echo esc_url($options['logoes']['logo-gorizontal-little']); ?>" alt="<?php esc_attr_e('Site Logo', 'kamkardan'); ?>" />
					</a>
				<?php endif; ?>
				<div class="header-block-contacts__block-phone">
				<span class="icon-phone-3"></span>
					<a href="tel:<?= $options['phone']; ?>" class="header-block-contacts__phone">
						<?= $options['phone']; ?>
					</a>
					<p class="header-block-contacts__operating-mode">
						<?php echo esc_html($options['operating_mode']); ?>
					</p>
				</div>
				<?php if (function_exists('custom_woocommerce_header_cart')) {
					custom_woocommerce_header_cart();
				} ?>
			</div>
			<div class="header-block-search-mobile">
				<div class="header-block-search">
					<form role="search" method="get" class="woocommerce-product-search header-search" action="<?php echo esc_url(home_url('/')); ?>">
						<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="Поиск вала по номеру" value="<?php echo get_search_query(); ?>" name="s" />
						<button class="header-search__button" type="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'woocommerce'); ?>"><span class="icon-Search-3"></span></button>
						<input type="hidden" name="post_type" value="product" />
					</form>
				</div>
				<button class="menu-burger" id="burger-menu"><span class="middle"></span></button>
				<nav id="site-navigation" class="header-block-nav">
					<?php wp_nav_menu('menu=top-menu');?>
				</nav>
			</div>
		</div>

		<div id="block-catalog" class="block-catalog">
			<div class="wrap-header block-catalog__block">
				<a id="close-catalog-menu-back" class="block-catalog__mobile-button-back"><span class="icon-Left-2"></span><p class="txt-normal">Назад</p></a>
				<div class="block-categories">
					<?php echo do_shortcode('[kardany_all_subcategories_and_tags]'); ?>
				</div>
				<a href="" id="close-catalog-menu"><span class="icon-Close-1 close-catalog-menu"></span></a>
			</div>
		</div>
	</header><!-- #masthead -->

	<?php if (!is_front_page() && !is_cart() && !is_checkout() && !is_account_page() && !is_singular('product')) : ?>
		<div class="wrap-breadcrumbs">
			<?php if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
			} ?>
		</div>
	<?php endif; ?>