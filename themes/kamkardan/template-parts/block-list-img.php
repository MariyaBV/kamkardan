<?php
  $fields = get_fields();
  $options = get_fields('options');
?>

<div class="list-img">
    <div class="list-img__items">
        <div class="list-img__info">
            <?php foreach ($fields['items'] as $item): ?>
                <div class="list-img__item">
                    <div class="list-img__subtitle-img">
                        <img src="<?= $item['img']; ?>">
                        <p><?= $item['subtitle']; ?></p>
                    </div>
                    <p><?= $item['text']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="block-callback-form contacts" id="<?php echo $block['id']; ?>">
            <div class="block-callback-form__block">
                <form id="callback<?php echo $block['id']; ?>">
                    <h3 class="block-callback-form__title"><?= $fields['blok_obratnaya_svyaz']['zagolovok'] ?></h3>

                    <input type="hidden" id="callback-type-<?php echo $block['id']; ?>" value="repair_request" />

                    <div class="block-callback-form__block-input">
                        <label class="txt-normal" for="callback-name-<?php echo $block['id']; ?>">Ваше имя <span class="red-text">*</span></label>
                        <input placeholder="Иван" type="text" id="callback-name-<?php echo $block['id']; ?>" name="name" required/>
                    </div>

                    <div class="block-callback-form__block-input">
                        <label class="txt-normal" for="callback-phone-<?php echo $block['id']; ?>">Телефон <span class="red-text">*</span></label>
                        <input class="tel" placeholder="+x(ххх)ххх-хх-хх" type="text" id="callback-phone-<?php echo $block['id']; ?>" name="phone" required/>
                    </div>

                    <div class="block-callback-form__block-input">
                        <label class="txt-normal" for="callback-email-<?php echo $block['id']; ?>">e-mail</label>
                        <input placeholder="your@email.ru" type="email" id="callback-email-<?php echo $block['id']; ?>" name="phone"/>
                    </div>

                    <div class="callback-form-block__block-input">
                        <label class="txt-normal" for="callback-comment-<?php echo $block['id']; ?>">Ваше сообщение <span class="red-text">*</span></label>
                        <textarea type="text" id="callback-comment-<?php echo $block['id']; ?>" name="phone" required></textarea>
                    </div>

                    <button class="red-button-medium margin-top-16" type="submit"><?= $fields['blok_obratnaya_svyaz']['nazvanie_knopki'] ?></button>
                    <a class="block-callback-form__policy-link" href="<?= $fields['blok_obratnaya_svyaz']['ssylka_na_politiku_konfidiczialnosti'] ?>"><?= $fields['blok_obratnaya_svyaz']['tekst_politiki_konfidiczialnosti'] ?></a>
                </form>
                <div class="block-callback-form__thanks">
                    <img src="<?= $options['blok_otvety_na_formy']['otvet_na_stranicze']['kartinka'] ?>"/>
                    <h3><?= $options['blok_otvety_na_formy']['otvet_na_stranicze']['zagolovok'] ?></h3>
                    <p class="txt-normal"><?= $options['blok_otvety_na_formy']['otvet_na_stranicze']['tekst'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="map">
        <img src="<?= $fields['img']; ?>" alt="Карта">
    </div>
</div>
