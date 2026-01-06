<?php
/*
 * The Index Post (or excerpt)
 * ===========================
 * Used by index.php, category.php and author.php
 */

$categories = get_the_category();
$category = $category1 = $name = '';
if (!empty($categories)) {
  $category = esc_html($categories[0]->slug);
  if (isset($categories[1])) {
    $category1 = esc_html($categories[1]->slug);
  }
  $name = esc_html($categories[0]->name);
}

$post_object = get_field('author');
$details = null;
if ($post_object) {
  $post = $post_object;
  setup_postdata($post);
  $details = get_field('contact_details');
  wp_reset_postdata();
}
?>

<div class="col-md-6 col-lg-4 text-center item i<?php echo $category; ?><?php if (!empty($category1)) echo ' ' . $category1; ?>">
  <div class="title">
    <p>
      <?php if (!empty($name)) echo mb_strtolower($name, 'utf8'); ?>
    </p>
  </div>

  <div class="img" style="background: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'recent_fimg')); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

  <div class="header">
    <?php if (!empty($categories) && $categories[0]->slug === 'events'): ?>
      <a href="<?php the_permalink(); ?>">
        <h6><?php echo esc_html(get_the_title()); ?> - <?php echo esc_html(get_field('event_date')); ?></h6>
      </a>
    <?php else: ?>
      <a href="<?php the_permalink(); ?>" data-name="<?php echo esc_attr(get_the_title()); ?>">
        <h6><?php echo esc_html(get_the_title()); ?></h6>
      </a>
    <?php endif; ?>
  </div>

  <div class="excerpt">
    <p class="date">
      <?php if (!in_array($category, ['guides', 'events', 'training'])): ?>
        <?php the_time('j F'); ?>
        <?php if (!empty($details['first_name']) || !empty($details['last_name'])): ?>
          - <?php echo esc_html(trim($details['first_name'] . ' ' . $details['last_name'])); ?>
        <?php endif; ?>
      <?php endif; ?>
    </p>

    <?php
      $getpost = get_post(get_the_ID());
      $excerpt = $getpost ? $getpost->post_content : '';

      if (empty($excerpt) && get_field('new_blog_layout') == 'yes') {
        $excerpt = get_field('blog_intro');
      } elseif ($category === 'events' || $category === 'training') {
        $excerpt = get_field('intro_title');
      }

      echo wp_trim_words($excerpt, 30, '...');
    ?>

    <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-purple test" data-name="<?php echo esc_attr(get_the_title()); ?>">Read More</a>
  </div>
</div>