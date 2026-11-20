<?php
/**
 * Bild links – Text rechts
 * Felder: image (ID), headline (text), text (wysiwyg)
 */
$img_id   = get_sub_field('image');
$titel = get_sub_field('titel');
$text     = get_sub_field('text');
$summary  = get_sub_field('summary');
?>
<div class="row align-items-center g-5">
  <div class="col-md-6">
    <?php
    if ($img_id) {
      echo wp_get_attachment_image($img_id, 'large', false, [
        'class'    => 'img-fluid rounded',
        'loading'  => 'lazy',
        'decoding' => 'async',
      ]);
    }
    ?>
  </div>
  <div class="col-md-6">
     <?php if ($summary): ?><p class="lead"><?php echo esc_html($summary); ?></p><?php endif; ?>
    <?php if ($titel): ?><p class="lead"><?php echo esc_html($titel); ?></p><?php endif; ?>
    <?php if ($text): ?><div class="rte"><?php echo wp_kses_post($text); ?></div><?php endif; ?>
    <?php if ($img_id): ?><p class="lead"><?php echo esc_html($img_id); ?></p><?php endif; ?>
  </div>
</div>