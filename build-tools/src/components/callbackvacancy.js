$(document).ready(function() {
    $('.button-vacancy').on('click', function() {
        $('.vacancy-callback.block-callback-form').show();
    });

    $('#closeCallbackFormVacancy').on('click', function() {
        $('.vacancy-callback.block-callback-form').hide();
    });
});
