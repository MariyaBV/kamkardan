<?php

namespace mne\Admin;

class SettingsPage
{

    /**
     * Регистрируем страницу настроек в WooCommerce
     */
    public static function init()
    {
        add_submenu_page(
            'woocommerce',             // Родительская страница (WooCommerce)
            'Настройки доставки',      // Заголовок страницы
            'Доставка',                // Название в меню
            'manage_options',          // Разрешения
            'mne-delivery-settings',   // Слаг для страницы
            [__CLASS__, 'render']    // Метод для рендеринга страницы
        );
    }

    /**
     * Рендеринг страницы настроек
     */
    public static function render()
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        // Проверка и сохранение настроек
        if (isset($_POST['mne_delivery_settings'])) {
            check_admin_referer('mne_delivery_settings_nonce');
            update_option('mne_delivery_option', sanitize_text_field($_POST['mne_delivery_option']));
            echo '<div class="updated"><p>Настройки сохранены.</p></div>';
        }

        // Получаем сохраненные настройки
        $option_value = get_option('mne_delivery_option', '');

        // Подключаем шаблон страницы настроек
        require_once plugin_dir_path(__FILE__) . '../../templates/admin-settings.php';
    }
}