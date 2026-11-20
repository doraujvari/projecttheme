<?php
/**
 * Partial: Landing Page Hero
 * Figma reference: node 17:733 — SIMK Website
 */

$image_id = get_sub_field('image');
$local_asset = get_theme_file_uri('/assets/images/simk-landing-detail.svg');
?>
<div class="projecttheme-landing-page projecttheme-landing-page--figma">
  <?php if ($image_id): ?>
    <?php
    echo wp_get_attachment_image($image_id, 'full', false, [
      'class'    => 'projecttheme-landing-page__image',
      'loading'  => 'eager',
      'fetchpriority' => 'high',
      'decoding' => 'async',
      'width'    => 1509,
      'height'   => 1095,
      'alt'      => '',
    ]);
    ?>
  <?php else: ?>
    <img
      class="projecttheme-landing-page__image projecttheme-landing-page__image--figma"
      src="<?php echo esc_url($local_asset); ?>"
      width="1509"
      height="1095"
      alt=""
      loading="eager"
      fetchpriority="high"
      decoding="async"
    >
  <?php endif; ?>
</div>
