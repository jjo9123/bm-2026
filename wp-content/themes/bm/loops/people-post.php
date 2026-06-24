<?php
/*
 * The Index Post (or excerpt)
 * ===========================
 * Used by index.php, category.php and author.php
 */
?>

<?php
$details = get_field('contact_details');
$link    = get_permalink();

// image (field storing a URL)
$img_url = !empty($details['img']) ? $details['img'] : '';

// location title (if location is a post object)
$location_title = '';
$post_object = $details['location'] ?? null;
if ( $post_object ) {
  $location_title = get_the_title( $post_object->ID );
}

// label (optional) – using location if present, otherwise “Expert”
$label = $location_title ? $location_title : 'Expert';

// name for alt text
$full_name = trim(($details['first_name'] ?? '') . ' ' . ($details['last_name'] ?? ''));
?>

<div class="col-sm-6 col-md-3 mb-4">
  <a class="expert-card" href="<?php echo esc_url($link); ?>">

    <div class="expert-card__image-wrap position-relative">
      <?php if ( $img_url ): ?>
        <img
          class="expert-card__image"
          src="<?php echo esc_url($img_url); ?>"
          alt="<?php echo esc_attr($full_name); ?>"
          loading="lazy"
        >
      <?php endif; ?>
    </div>

    <div class="expert-card__body">
      <h3 class="expert-card__name">
        <?php echo esc_html($details['first_name'] ?? ''); ?>
        <?php if (!empty($details['last_name'])): ?> <?php endif; ?>
        <?php echo esc_html($details['last_name'] ?? ''); ?>
      </h3>

      <?php if (!empty($details['job_title'])): ?>
        <p class="expert-card__role"><?php echo esc_html($details['job_title']); ?></p>
      <?php endif; ?>

      <p class="expert-card__role"><?php echo esc_html($label); ?></p>

      <div class="expert-card__cta">
        <span class="btn btn-green">View profile</span>
      </div>
    </div>

  </a>
</div>