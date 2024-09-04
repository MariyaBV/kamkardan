var callbackVacancyButtons = document.querySelectorAll('.button-vacancy');

callbackVacancyButtons.forEach(callbackVacancyButton => { 
    callbackVacancyButton.addEventListener('click', function() {
        document.querySelector(`.vacancy-callback.block-callback-form`).style.display = 'block';
    });

    const closeButton = document.getElementById('closeCallbackFormVacancy');
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            document.querySelector(`.vacancy-callback.block-callback-form`).style.display = 'none';
        });
    }
});
