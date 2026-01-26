<?php
$banner = get_field('banner_section');
if ( empty($banner) || ($banner['add_button'] ?? '') !== 'yes' ) return;

$text = $banner['btn_txt'] ?? '';
if ( ! $text ) return;

if ( ($banner['jump_to_bottom'] ?? '') === 'yes' ) : ?>
  <a class="btn btn-green header" href="#contact-footer"><?php echo esc_html($text); ?></a>
  <?php return; ?>
<?php endif; ?>

<?php
$choice = $banner['btn_choice'] ?? '';

if ( $choice === 'embed' ) : ?>
  <a class="btn btn-herovid btn-green header" href="javascript:void(0)" data-toggle="modal" data-target="#myModalvideo">
    <?php echo esc_html($text); ?>
  </a>
<?php elseif ( $choice === 'link' ) :
  $link = $banner['btn_link'] ?? '';
  if ( $link ) : ?>
    <a class="btn btn-hero btn-green header" href="<?php echo esc_url($link); ?>">
      <?php echo esc_html($text); ?>
    </a>
  <?php endif; ?>
<?php elseif ( $choice === 'external' ) :
  $ext = $banner['external_link'] ?? '';
  if ( $ext ) : ?>
    <a class="btn btn-hero btn-green header" href="<?php echo esc_url($ext); ?>" rel="noopener">
      <?php echo esc_html($text); ?>
    </a>
  <?php endif; ?>
<?php endif; ?>