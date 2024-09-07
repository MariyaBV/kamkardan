jQuery(document).ready(function($) {
    $('#callbackRequestForm').submit(function(e) {
        e.preventDefault();

        var name = $('#callback-name').val();
        var phone = $('#callback-phone').val();

        // Получаем данные корзины через Ajax
        $.ajax({
            url: custom_ajax_obj.ajax_url, // Используем переданный URL admin-ajax.php
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'get_cart_data', // Действие для получения данных корзины
            },
            success: function(response) {
                if (response.success) {
                    var cart_data = response.data; // Данные корзины

                    // Отправляем данные формы и корзины на сервер для создания заказа
                    $.ajax({
                        url: custom_ajax_obj.ajax_url, // Используем переданный URL admin-ajax.php
                        type: 'POST',
                        data: {
                            action: 'submit_callback_order',
                            name: name,
                            phone: phone,
                            cart_data: cart_data // Данные корзины
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.data); // Уведомляем пользователя об успехе
                                $('#closeCallbackForm').trigger('click'); // Закрыть форму
                            } else {
                                alert('Ошибка: ' + response.data);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Ошибка при отправке данных формы:', xhr.responseText);
                            alert('Ошибка при отправке данных формы.');
                        }
                    });
                } else {
                    alert('Ошибка при получении данных корзины.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ошибка при получении данных корзины:', xhr.responseText);
                alert('Ошибка при получении данных корзины.');
            }
        });
    });
});
