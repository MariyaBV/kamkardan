<?php
$r = get_fields();

$classBottom = '';
if ( $r['block_img_text'] == '1' ) {
    $classBottom = 'bottom';
}


?> 

<div class="steps <?php echo $classBottom; ?>">
    <?php foreach ($r['img-text'] as $item): ?>
        <div class="step-item">
            <img src="<?php echo $item['img']; ?>"  />
            <p class="step-subtitle"><?php echo $item['text']; ?></p>
            <a href="<?php echo $item['link']; ?>"></a>
        </div>
    <?php endforeach; ?>
</div>