jQuery(document).ready(function ($) {

    // Открытие формы по клику на кнопку callbackButton
    $('#callbackButton').on('click', function () {
        $('#callbackForm').show();
    });

    // Открытие формы по клику на кнопку callbackButtonCart
    $('#callbackButtonCart').on('click', function () {
        $('#callbackForm').show();
    });

    // Закрытие формы по клику на кнопку closeCallbackForm
    $('#closeCallbackForm').on('click', function () {
        $('#callbackForm').hide();
    });

    $(document).mouseup(function(e) {
        var $formContent = $('#callbackRequestForm');
    
        // Если клик не по форме и не по её дочерним элементам
        if (!$formContent.is(e.target) && $formContent.has(e.target).length === 0) {
            $('#callbackForm').hide(); // Скрываем фон с формой
        }
    });
    

    // Обработка отправки формы callbackRequestForm
    $('#callbackRequestForm').on('submit', function (event) {
        event.preventDefault();

        var name = $('#callback-name').val();
        var phone = $('#callback-phone').val();
        var type = $('#callback-type').val();

        var data = new FormData();
        data.append('name', name);
        data.append('phone', phone);
        data.append('type', type);
        data.append('action', 'callback_request');

        fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(result => {
            $('#callbackRequestFormThanks').show();
            $('#closeCallbackForm').trigger('click');
            $('#OKCallbackFormThanks').on('click', function () {
                $('#callbackRequestFormThanks').hide();
            });
            $('#callbackForm').hide();
        })
        .catch(error => {
            console.error('Ошибка:', error);
            //alert('Произошла ошибка при отправке запроса.');
        });
    });

});
