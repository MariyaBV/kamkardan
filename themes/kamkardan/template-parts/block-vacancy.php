<?php
  $fields = get_fields();
?>

<div class="vacancy-blocks">
    <div class="vacancy-blocks__items">
        <?php foreach ($fields['vacancy-block'] as $item): ?>
            <div class="vacancy-blocks__item">
                <p><?= $item['subtitle']; ?></p>
                <p><?= $item['text-about-vacancy']; ?></p>
            </div>
            <div class="vacancy-blocks__item">
                <p>Опыт работы</p>
                <p><?= $item['work_experience']; ?></p>
            </div>
            <div class="vacancy-blocks__item">
                <p>Заработная плата</p>
                <p><?= $item['Wages']; ?></p>
            </div>
            <button class="red-button-L" id="callbackButtonVacancy">Откликнуться</button>
        <?php endforeach; ?>
    </div>
    
    <div class="vacancy-callback block-callback-form" id="callbackFormVacancy" style="display:none;">
        <div class="callback-form-block">
            <form id="callback<?php echo $block['id']; ?>">
                <button class="callback-form-block__close" id="closeCallbackFormVacancy"><span class="icon-Close-3"></span></button>
                <h3 class="callback-form-block__title">Откликнуться на вакансию</h3>
                <input type="hidden" id="callback-type-<?php echo $block['id']; ?>" value="callback_request" />
                <div class="callback-form-block__block-input">
                    <label class="txt-normal" for="callback-name-<?php echo $block['id']; ?>">Имя <span class="red-text">*</span></label>
                    <input type="text" id="callback-name-<?php echo $block['id']; ?>" name="name" required>
                </div>
                <div class="callback-form-block__block-input">
                    <label class="txt-normal" for="callback-phone-<?php echo $block['id']; ?>">Телефон <span class="red-text">*</span></label>
                    <input type="text" id="callback-phone-<?php echo $block['id']; ?>" name="phone" required>
                </div>
                <div class="callback-form-block__block-input">
                    <label class="txt-normal" for="callback-comment-<?php echo $block['id']; ?>">Комментарий <span class="red-text">*</span></label>
                    <textarea type="text" id="callback-comment-<?php echo $block['id']; ?>" name="phone" required></textarea>
                </div>
                <button class="red-button-medium mrg-0-auto mrg-top-32" type="submit">Откликнуться</button>
            </form>
        </div>
    </div>
</div>