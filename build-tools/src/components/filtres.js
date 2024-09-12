$(document).ready(function () {
    $('.custom-ordering .custom-ordering-trigger').on('click', function () {
        $(this).closest('.custom-ordering-select').toggleClass('opened');
    });

    $('.custom-ordering-option').on('click', function () {
        var $option = $(this);
        var value = $option.data('value');
        var label = $option.text().trim();

        var $trigger = $option.closest('.custom-ordering-select').find('.custom-ordering-trigger');
        $trigger.text(label);

        var $form = $option.closest('form');
        $form.find('input[name="orderby"]').val(value);

        $('.custom-ordering-option').removeClass('selected');
        $option.addClass('selected');

        if (value === '' || label === 'Сортировать') {
            $trigger.removeClass('selected');
        } else {
            $trigger.addClass('selected');
        }

        $form.submit();
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('.custom-ordering-select').length) {
            $('.custom-ordering-select').removeClass('opened');
        }
    });

    function initOrderingState() {
        var selectedOrderBy = $('.custom-ordering').find('input[name="orderby"]').val();
        var $trigger = $('.custom-ordering-trigger');

        if (selectedOrderBy === '' || $trigger.text().trim() === 'Сортировать') {
            $trigger.removeClass('selected');
        } else {
            $trigger.addClass('selected');
        }
    }

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

        $selectContainer.find('.custom-select-trigger').text(label);
        $selectContainer.find('input[type="hidden"]').val(value);

        $option.addClass('selected').siblings().removeClass('selected');

        $selectContainer.find('.custom-select').removeClass('opened');

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

$(document).ready(function() {
    // получаем все параметры из URL
    function getUrlParams() {
        const params = new URLSearchParams(window.location.search);
        return params;
    }

    // считаем количество активных фильтров
    function countFilters() {
        const params = getUrlParams();
        let filterCount = 0;

        // Перебираем параметры и считаем только те, которые являются фильтрами
        params.forEach(function(value, key) {
            if (key.startsWith('attribute_') || key === 'min_length' || key === 'max_length') {
                if (value !== '') {
                    filterCount++;
                }
            }
        });

        return filterCount;
    }

    // Обновляем счётчик фильтров на странице
    function updateFilterCount() {
        const filterCount = countFilters();
        $('.fillters-count').text(filterCount); // Обновляем цифру в блоке
    }

    // Обновляем счётчик при загрузке страницы
    updateFilterCount();

    // Отслеживаем изменение URL при применении фильтров
    window.addEventListener('popstate', function() {
        updateFilterCount();
    });

    // Опционально: если фильтры применяются через AJAX
    $(document).ajaxComplete(function() {
        updateFilterCount();
    });
});
