jQuery(document).ready(function($) {
    $('#callbackRequestForm').submit(function(e) {
        e.preventDefault();

        var name = $('#callback-name').val();
        var phone = $('#callback-phone').val();

        // Получаем данные корзины через Ajax
        $.ajax({
            url: custom_ajax_obj.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'get_cart_data',
            },
            success: function(response) {
                if (response.success) {
                    var cart_data = response.data;

                    // Отправляем данные формы и корзины на сервер для создания заказа
                    $.ajax({
                        url: custom_ajax_obj.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'submit_callback_order',
                            name: name,
                            phone: phone,
                            cart_data: cart_data
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Заказ успешно создан. ID: ' + response.data);
                                
                                // Очистить корзину
                                $.ajax({
                                    url: custom_ajax_obj.ajax_url,
                                    type: 'POST',
                                    data: {
                                        action: 'clear_cart'
                                    },
                                    success: function() {
                                        // Закрыть форму и перезагрузить страницу корзины
                                        $('#closeCallbackForm').trigger('click');
                                        location.reload();
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Ошибка при очистке корзины:', xhr.responseText);
                                    }
                                });
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
