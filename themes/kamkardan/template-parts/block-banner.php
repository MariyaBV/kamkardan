<?php
  $fields = get_fields();
  $options = get_fields('options');

  switch ( $fields['banner_choose'] ) : 
    case 'phone':  
?>
<div class="banner-block desktop">
    <img class="background-img" src="<?= $fields['img_background']; ?>">
    <div class="img-block">
        <img src="<?= $fields['dop_img']; ?>">
        <a class="phone" href="<?= $fields['phone']; ?>"><?= $fields['phone']; ?></a>
    </div>
    <img class="logo" src="<?= $options['logoes']['circle-logo']; ?>">
    <a class="link" href="<?= $fields['phone']; ?>"></a>
    <div class="content">
        <h2 class="subtitle"><?= $fields['subtitle']; ?></h2>
        <p class="text"><?= $fields['text']; ?></p>
    </div>
</div>
<?php break;
    case 'text':  
?>
<div class="banner-block desktop">
    <img class="background-img" src="<?= $fields['img_background']; ?>">
    <img class="img" src="<?= $fields['dop_img']; ?>">
    <img class="logo" src="<?= $options['logoes']['circle-logo']; ?>">
    <a class="link" href="<?= $fields['phone']; ?>"></a>
    <div class="content">
        <h2 class="subtitle"><?= $fields['subtitle']; ?></h2>
        <p class="text"><?= $fields['text']; ?></p>
        <p class="little-text"><?= $fields['text*']; ?></p>
    </div>
    <p class="phone"><?= $fields['phone']; ?></p>
</div>
<?php break;
    case 'main':
?>
<div class="banner-main desktop">
    <img class="background-img" src="<?= $fields['img_background']; ?>">
    <img class="img" src="<?= $fields['dop_img']; ?>">
    <img class="logo" src="<?= $options['logoes']['circle-logo']; ?>">
    <a class="link" href="<?= $fields['button']['url']; ?>"></a>
    <div class="content">
        <h2 class="title h1-banner"><?= $fields['title']; ?></h2>
        <a class="red-button-L button" href="<?= $fields['button']['url']; ?>"><p><?= $fields['button']['title']; ?></p></a>
    </div>
</div>
<?php break;
  endswitch;?>