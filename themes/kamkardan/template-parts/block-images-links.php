<?php
  $fields = get_fields();
?>

<div class="images-links">
    <div class="images-links__items">
        <?php foreach ($fields['images-links-block'] as $item): ?>
            <div class="images-links__item">
                <img src="<?= $item['img']; ?>">
                <a href="<?= $item['link']; ?>"></a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
