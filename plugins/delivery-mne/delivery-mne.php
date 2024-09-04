<?php

/*
 * Plugin Name: Плагин доставки
 * Domain Path:       /languages
 * Text Domain:       delivery-mne
 */

defined('ABSPATH') || exit;
require_once __DIR__ . '/vendor/autoload.php';

register_activation_hook(__FILE__, 'delivery_mne_activate');

function delivery_mne_activate()
{
    if (!is_plugin_active('woocommerce/woocommerce.php')) {

        deactivate_plugins(plugin_basename(__FILE__));
        wp_die('Этот плагин требует активного плагина WooCommerce. Пожалуйста, установите и активируйте WooCommerce.');
    }
}


if (is_admin()) {

}