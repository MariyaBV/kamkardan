<?php
$r = get_fields();
?>

<div class="steps">
    <?php foreach ($r['img-text'] as $item): ?>
        <div class="step-item">
            <img src="<?php echo $item['img']; ?>"  />
            <p class="step-subtitle"><?php echo $item['text']; ?></p>
            <a href="<?php echo $item['link']; ?>"></a>
        </div>
    <?php endforeach; ?>
</div>