<?php
  $fields = get_fields();
  $options = get_fields('options');
?>
<?php //Заявка на ремонт ?> 

<div class="block-callback-form" id="<?php echo $block['id']; ?>">
    <div class="block-callback-form__block">
        <form id="callback<?php echo $block['id']; ?>">
            <h3 class="block-callback-form__title"><?= $fields['title'] ?></h3>

            <input type="hidden" id="callback-type-<?php echo $block['id']; ?>" value="repair_request" />

            <div class="block-callback-form__block-input">
                <label class="txt-normal" for="callback-name-<?php echo $block['id']; ?>">Имя <span class="red-text">*</span></label>
                <input placeholder="Иван" type="text" id="callback-name-<?php echo $block['id']; ?>" name="name" required/>
            </div>

            <div class="block-callback-form__block-input">
                <label class="txt-normal" for="callback-phone-<?php echo $block['id']; ?>">Телефон <span class="red-text">*</span></label>
                <input class="tel" placeholder="+x(ххх)ххх-хх-хх" type="text" id="callback-phone-<?php echo $block['id']; ?>" name="phone" required/>
            </div>
            
            <button class="red-button-medium mrg-top-32" type="submit"><?= $fields['title-button'] ?></button>
            <a class="block-callback-form__policy-link" href="<?= $fields['policy_link'] ?>"><?= $fields['text-policy-link'] ?></a>
        </form>
        <div class="block-callback-form__thanks">
            <img src="<?= $options['blok_otvety_na_formy']['otvet_na_stranicze']['kartinka'] ?>"/>
            <h3><?= $options['blok_otvety_na_formy']['otvet_na_stranicze']['zagolovok'] ?></h3>
            <p class="txt-normal"><?= $options['blok_otvety_na_formy']['otvet_na_stranicze']['tekst'] ?></p>
        </div>
    </div>
</div>
