<div class="wrap">
    <h1><?php esc_html_e('Настройки доставки', 'mne-delivery'); ?></h1>

    <form method="post" action="">
        <?php wp_nonce_field('mne_delivery_settings_nonce');

        var_dump(WC()->countries->get_base_address());
        ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label for="mne_delivery_option"><?php esc_html_e('Опция доставки', 'mne-delivery'); ?></label>
                </th>
                <td>
                    <input type="text" id="mne_delivery_option" name="mne_delivery_option"
                        value="<?php echo esc_attr($option_value); ?>" />
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>
</div>