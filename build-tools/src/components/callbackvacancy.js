$(document).ready(function() {
    $('.button-vacancy').on('click', function() {
        $('.vacancy-callback.block-callback-form').show();
    });

    $('#closeCallbackFormVacancy').on('click', function() {
        $('.vacancy-callback.block-callback-form').hide();
    });

    $(document).mouseup(function(e) {
        var $formContent = $('.vacancy-callback.block-callback-form .callback-form-block form');
    
        // Если клик не по форме и не по её дочерним элементам
        if (!$formContent.is(e.target) && $formContent.has(e.target).length === 0) {
            $('.vacancy-callback.block-callback-form').hide(); // Скрываем фон с формой
        }
    });
});
