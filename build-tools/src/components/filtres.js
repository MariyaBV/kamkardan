$(document).ready(function () {
    // Открытие/закрытие кастомного выпадающего списка внутри custom-ordering
    $('.custom-ordering .custom-ordering-trigger').on('click', function () {
        $(this).closest('.custom-ordering-select').toggleClass('opened');
    });

    // Выбор варианта сортировки
    $('.custom-ordering-option').on('click', function () {
        var $option = $(this);
        var value = $option.data('value');
        var label = $option.text().trim();

        // Обновляем текст триггера
        var $trigger = $option.closest('.custom-ordering-select').find('.custom-ordering-trigger');
        $trigger.text(label);

        // Обновляем скрытое поле
        var $form = $option.closest('form');
        $form.find('input[name="orderby"]').val(value);

        // Удаляем класс "selected" у всех опций и добавляем только к выбранной
        $('.custom-ordering-option').removeClass('selected');
        $option.addClass('selected');

        // Добавляем или удаляем класс "selected" у триггера в зависимости от выбранного значения
        if (value === '' || label === 'Сортировать') {
            // Если выбран пункт "Сортировать", убираем класс "selected" у триггера
            $trigger.removeClass('selected');
        } else {
            // Если выбран любой другой пункт, добавляем класс "selected" к триггеру
            $trigger.addClass('selected');
        }

        // Отправляем форму
        $form.submit();
    });

    // Закрытие списка при клике вне его
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.custom-ordering-select').length) {
            $('.custom-ordering-select').removeClass('opened');
        }
    });

    // Инициализация состояния при загрузке страницы
    function initOrderingState() {
        var selectedOrderBy = $('.custom-ordering').find('input[name="orderby"]').val();
        var $trigger = $('.custom-ordering-trigger');

        // Проверка состояния при загрузке страницы
        if (selectedOrderBy === '' || $trigger.text().trim() === 'Сортировать') {
            // Если текущее значение пустое (т.е. выбран пункт "Сортировать") или текст триггера равен "Сортировать", убираем класс "selected"
            $trigger.removeClass('selected');
        } else {
            // Если есть значение (т.е. выбран другой пункт), добавляем класс "selected"
            $trigger.addClass('selected');
        }
    }

    // Инициализация состояния при загрузке страницы
    initOrderingState();
});


$(document).ready(function () {
    // Открытие/закрытие кастомного выпадающего списка
    $('.custom-select-trigger').on('click', function () {
        $(this).parents('.custom-select').toggleClass('opened');
    });

    // Закрытие выпадающего списка при клике вне его
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.custom-select').length) {
            $('.custom-select').removeClass('opened');
        }
    });

    // Выбор элемента из кастомного списка
    $('.custom-option').on('click', function () {
        var $option = $(this);
        var $selectContainer = $option.closest('.attribute-filters__select');
        var value = $option.data('value');
        var label = $option.text().trim();

        // Обновление выбранного значения
        $selectContainer.find('.custom-select-trigger').text(label);
        $selectContainer.find('input[type="hidden"]').val(value);

        // Пометка выбранного элемента
        $option.addClass('selected').siblings().removeClass('selected');

        // Закрытие списка
        $selectContainer.find('.custom-select').removeClass('opened');

        // Обновление стилизации
        checkSelectValues();
    });

    // Инициализация: проверка текущих значений
    function checkSelectValues() {
        $('.attribute-filters__select').each(function () {
            const $selectContainer = $(this);
            const $resetButton = $selectContainer.find('.reset-button');
            const $verticalLine = $selectContainer.find('.vertical-line');
            const $icon = $selectContainer.find('.icon-Down-3');
            const $selectTrigger = $selectContainer.find('.custom-select-trigger');
            const selectedOptionValue = $selectContainer.find('input[type="hidden"]').val().trim();

            if (selectedOptionValue !== '') {
                $selectContainer.addClass('option-selected');
                $resetButton.css('display', 'block');
                $verticalLine.css('display', 'block');
                $icon.css('display', 'none');
                $selectTrigger.addClass('selected-item-menu');
            } else {
                $selectContainer.removeClass('option-selected');
                $resetButton.css('display', 'none');
                $verticalLine.css('display', 'none');
                $icon.css('display', 'block');
                $selectTrigger.removeClass('selected-item-menu');
            }
        });
    }

    checkSelectValues();

    // Сброс выбранного фильтра
    $('.reset-button').on('click', function () {
        const $selectContainer = $(this).closest('.attribute-filters__select');
        const attributeLabel = $selectContainer.find('.custom-select-trigger').data('attribute-label');
        
        $selectContainer.find('input[type="hidden"]').val('');
        $selectContainer.find('.custom-select-trigger').text(attributeLabel);
        $selectContainer.find('.custom-option').removeClass('selected');
        checkSelectValues();
    });

    // Отслеживание изменений URL
    function observeURLChanges(callback) {
        let lastUrl = window.location.href;
        new MutationObserver(() => {
            const currentUrl = window.location.href;
            if (currentUrl !== lastUrl) {
                lastUrl = currentUrl;
                callback();
            }
        }).observe(document, { subtree: true, childList: true });
    }

    observeURLChanges(checkSelectValues);
});