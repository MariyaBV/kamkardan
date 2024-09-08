<?php
/**
 * Plugin Name: Delivery_MNE
 * Description: Расчет доставки.
 * Version: 1.0.0
 * Text Domain:       delivery-mne
 * Domain Path: /languages
 */

// Проверяем, что файл не вызывается напрямую
if (!defined('ABSPATH')) {
    exit; // Завершаем выполнение скрипта
}
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
function mne_check_woocommerce()
{
    // Проверяем, активен ли плагин WooCommerce
    if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        // WooCommerce не активен, выводим сообщение и деактивируем плагин
        add_action('admin_notices', 'mne_woocommerce_not_active_notice');
        deactivate_plugins(plugin_basename(__FILE__));
    }
}

function mne_woocommerce_not_active_notice()
{
    echo '<div class="notice notice-error"><p>';
    _e('Плагин требует активный WooCommerce для работы.', 'delivery-mne');
    echo '</p></div>';
}

add_action('admin_menu', ['mne\\Admin\\SettingsPage', 'init']);