<?php
  $fields = get_fields();
?>

<div class="vacancy-blocks">
    <?php foreach ($fields['vacancy-block'] as $item): ?>
        <div class="vacancy-blocks__items">
            <div class="vacancy-blocks__item">
                <p class="vacancy-blocks__subtitle-big"><?= $item['subtitle']; ?></p>
                <p class="txt-normal"><?= $item['text-about-vacancy']; ?></p>
            </div>
            <div class="vacancy-blocks__item">
                <p class="vacancy-blocks__subtitle">Опыт работы</p>
                <p class="txt-normal"><?= $item['work_experience']; ?></p>
            </div>
            <div class="vacancy-blocks__item">
                <p class="vacancy-blocks__subtitle">Заработная плата</p>
                <p class="txt-normal"><?= $item['Wages']; ?></p>
            </div>
            <a class="red-border-button button-vacancy">Откликнуться</a>
        </div>
    <?php endforeach; ?>

    
    <div class="vacancy-callback block-callback-form" id="<?php echo $block['id']; ?>" style="display:none;">
        <div class="callback-form-block">
            <form id="callback<?php echo $block['id']; ?>">
                <a class="callback-form-block__close" id="closeCallbackFormVacancy"><span class="icon-Close-3"></span></a>
                <h3 class="callback-form-block__title">Откликнуться на вакансию</h3>
                <input type="hidden" id="callback-type-<?php echo $block['id']; ?>" value="job_application" />
                <div class="callback-form-block__block-input">
                    <label class="txt-normal" for="callback-name-<?php echo $block['id']; ?>">Имя <span class="red-text">*</span></label>
                    <input placeholder="Иван" type="text" id="callback-name-<?php echo $block['id']; ?>" name="name" required>
                </div>
                <div class="callback-form-block__block-input">
                    <label class="txt-normal" for="callback-phone-<?php echo $block['id']; ?>">Телефон <span class="red-text">*</span></label>
                    <input class="tel" placeholder="+x(ххх)ххх-хх-хх" type="text" id="callback-phone-<?php echo $block['id']; ?>" name="phone" required>
                </div>
                <div class="callback-form-block__block-input">
                    <label class="txt-normal" for="callback-comment-<?php echo $block['id']; ?>">Комментарий <span class="red-text">*</span></label>
                    <textarea placeholder="Комментарий" type="text" id="callback-comment-<?php echo $block['id']; ?>" name="phone" required></textarea>
                </div>
                <button class="red-button-medium mrg-0-auto mrg-top-32" type="submit">Откликнуться</button>
            </form>
        </div>
    </div>

    <div class="header-block-contacts__callback-form" id="callbackFormThanks" style="display:none;">
        <div class="callback-form-block">
            <form id="callbackFormThanksForm">
                <?php /*<a class="callback-form-block__close" id="closeCallbackForm"><span class="icon-Close-3"></span></a>*/ ?>
                <img src="<?= $options['blok_otvety_na_formy']['otvet_vsplyvashka']['kartinka'] ?>"/>
                <h3 class="callback-form-block__title">Спасибо!</h3>
                <p class="txt-normal">Мы перезвоним вам в рабочее время, чтобы уточнить детали</p>
                <button id="OKCallbackFormThanks" class="red-button-medium mrg-0-auto mrg-top-32" type="submit">OK</button>
            </form>
        </div>
    </div>
</div>