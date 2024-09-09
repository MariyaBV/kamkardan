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
            .then(response => response.json())
            .then(result => {
                //alert('Заявка отправлена! Имя: ' + name + ', Телефон: ' + phone);
                $('.block-callback-form__thanks').addClass('active');
                $('.block-callback-form__block form').hide();
                $('.vacancy-callback.block-callback-form').hide();
                $('#callbackFormThanks').show();
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Произошла ошибка при отправке заявки.');
            });
        });
    });
});
