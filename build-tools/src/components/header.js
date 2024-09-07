document.getElementById('callbackButton').addEventListener('click', function() {
    document.getElementById('callbackForm').style.display = 'block';
});

jQuery(document).ready(function($) {
    $('#callbackButtonCart').on('click', function() {
        $('#callbackForm').show();
    });
});


document.getElementById('closeCallbackForm').addEventListener('click', function() {
    document.getElementById('callbackForm').style.display = 'none';
});

document.getElementById('callbackRequestForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    var name = document.getElementById('callback-name').value;
    var phone = document.getElementById('callback-phone').value;
    var type = document.getElementById('callback-type').value;
    
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
        alert('Запрос на обратный звонок отправлен! Имя: ' + name + ', Телефон: ' + phone);
        document.getElementById('callbackForm').style.display = 'none';
    })
    .catch(error => {
        console.error('Ошибка:', error);
        //alert('Произошла ошибка при отправке запроса.');
    });
});
