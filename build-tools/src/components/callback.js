$(document).ready(function() {
    $('.block-callback-form').each(function() {
        const $callBackBlock = $(this);
        const callBackBlockID = $callBackBlock.attr('id');

        $callBackBlock.on('submit', function(event) {
            event.preventDefault();

            const name = $(`#callback-name-${callBackBlockID}`).val();
            const phone = $(`#callback-phone-${callBackBlockID}`).val();
            const type = $(`#callback-type-${callBackBlockID}`).val();
            const commentElement = $(`#callback-comment-${callBackBlockID}`);
            const comment = commentElement.length ? commentElement.val() : '';
            
            const data = new FormData();
            data.append('name', name);
            data.append('phone', phone);
            data.append('type', type);
            if (comment.trim()) {
                data.append('comment', comment);
            }
            data.append('action', 'callback_request');
            
            fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(text => {
                try {
                    const result = JSON.parse(text);  // Попробуем распарсить как JSON
                    if (result.success) {
                        $('.block-callback-form__thanks').addClass('active');
                        $('.block-callback-form__block form').hide();
                        $('.vacancy-callback.block-callback-form').hide();
                        $('#callbackFormThanks').show();
                    } else {
                        throw new Error(result.data);  // Выводим ошибку сервера
                    }
                } catch (e) {
                    console.error('Ошибка при парсинге JSON:', e);
                    alert('Ошибка при обработке ответа от сервера.');
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Произошла ошибка при отправке заявки.');
            });
        });
    });
});
