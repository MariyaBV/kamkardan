const callBackBlocks = document.querySelectorAll('.block-callback-form');

callBackBlocks.forEach(callBackBlock => {
    const callBackBlockID = callBackBlock.getAttribute('id');

    document.getElementById(callBackBlockID).addEventListener('submit', function(event) {
        event.preventDefault();
        
        var name = document.getElementById('callback-name-'+callBackBlockID).value;
        var phone = document.getElementById('callback-phone-'+callBackBlockID).value;
        var type = document.getElementById('callback-type-'+callBackBlockID).value;
        
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
            alert('Заявка отправлена! Имя: ' + name + ', Телефон: ' + phone);
            document.getElementById('callbackForm').style.display = 'none';
        })
        .catch(error => {
            console.error('Ошибка:', error);
            alert('Произошла ошибка при отправке заявки.');
        });
    });
});
