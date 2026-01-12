<?php
// modules/insights/insights-grid.php

$bg        = isset($bg) ? $bg : '';
$cat_slug  = isset($cat_slug) ? $cat_slug : '';
$title     = isset($title) && $title ? $title : 'BM Insights';
$more_link = isset($more_link) && $more_link ? $more_link : '/blog';

// Normalise to an array of posts
$grid_posts = [];

if (isset($query) && $query instanceof WP_Query) {
  $grid_posts = $query->posts;
} elseif (isset($posts) && is_array($posts)) {
  $grid_posts = $posts;
}
?>

<section class="blog recent <?php echo esc_attr($bg); ?>"
         style="background: #404040 url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
  <div class="container-fluid <?php echo esc_attr($cat_slug); ?>">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-center"><?php echo esc_html($title); ?></h2>
          <hr class="heading green">
        </div>

        <?php if (!empty($grid_posts)) : ?>
          <?php foreach ($grid_posts as $p) : ?>
            <?php
              $post_id = $p->ID;

              // Category badges/classes (safe)
              $categories = get_the_category($post_id);
              $category_slug  = '';
              $category_slug2 = '';
              $category_name  = '';

              if (!empty($categories)) {
                $category_slug = $categories[0]->slug ?? '';
                $category_name = $categories[0]->name ?? '';

                if (isset($categories[1])) {
                  $category_slug2 = $categories[1]->slug ?? '';
                }
              }

              $item_classes = 'i' . sanitize_html_class($category_slug);
              if (!empty($category_slug2)) {
                $item_classes .= ' ' . sanitize_html_class($category_slug2);
              }

              $thumb = get_the_post_thumbnail_url($post_id, 'recent_fimg');
              $permalink = get_permalink($post_id);
              $post_title = get_the_title($post_id);

              // Excerpt logic preserved
              if ($category_slug === 'events' || $category_slug === 'training') {
                $excerpt = get_field('intro_title', $post_id);
              } elseif (get_field('new_blog_layout', $post_id) === 'yes') {
                $excerpt = get_field('blog_intro', $post_id);
              } else {
                $excerpt = get_post_field('post_content', $post_id);
              }
              if (!is_string($excerpt)) $excerpt = '';
            ?>

            <div class="col-sm-6 col-md-4 text-center item <?php echo esc_attr($item_classes); ?>">

              <?php if ($category_slug === 'events') : ?>
                <div class="recent-event"><?php echo esc_html($category_name); ?></div>
              <?php else : ?>
                <div class="title"><p><?php echo esc_html($category_name); ?></p></div>
              <?php endif; ?>

              <div class="img"
                   style="background: url('<?php echo esc_url($thumb); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <?php if ($category_slug === 'events') : ?>
                  <div class="recent-event">
                    <a href="<?php echo esc_url($permalink); ?>">
                      <h3><?php echo esc_html($post_title); ?></h3>
                    </a>
                  </div>
                <?php else : ?>
                  <a href="<?php echo esc_url($permalink); ?>">
                    <h3><?php echo esc_html($post_title); ?></h3>
                  </a>
                <?php endif; ?>
              </div>

              <div class="excerpt">
                <p><?php echo esc_html( wp_trim_words($excerpt, 30, '...') ); ?></p>
                <a href="<?php echo esc_url($permalink); ?>" class="btn btn-purple" data-name="<?php echo esc_attr($post_title); ?>">Read More</a>
              </div>
            </div>

          <?php endforeach; ?>
        <?php endif; ?>

        <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
          <a href="<?php echo esc_url($more_link); ?>" class="btn btn-green">Click here for more Insights</a>
        </div>

      </div>
    </div>
  </div>
</section>
