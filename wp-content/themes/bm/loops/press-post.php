<?php
$post_id = get_the_ID();

// Label (category name)
$label = 'News';

// Image
$thumb = get_the_post_thumbnail_url($post_id, 'large');

// Date
$date = get_the_time('j F Y');

// Expertise tags (plain text)
$tags = get_the_term_list($post_id, 'expertise', '', ' | ', '');
$tags = $tags ? wp_strip_all_tags($tags) : '';

// Excerpt logic (blog_intro preferred)
$post_intro = get_field('blog_intro', $post_id);
$snippet_src = $post_intro ? $post_intro : get_post_field('post_content', $post_id);
$snippet_src = is_string($snippet_src) ? $snippet_src : '';
$excerpt     = wp_trim_words(wp_strip_all_tags($snippet_src), 18, '…');
?>

<div class="col-12 col-md-6 col-lg-4 pb-5">
  <article class="latest-card h-100 d-flex flex-column">

    <a class="latest-card__image-wrap position-relative d-block mb-3" href="<?php the_permalink(); ?>">
      <?php if ($thumb) : ?>
        <img
          class="latest-card__image w-100"
          src="<?php echo esc_url($thumb); ?>"
          alt="<?php echo esc_attr(get_the_title($post_id)); ?>"
          loading="lazy"
        >
      <?php endif; ?>

      <?php if ($label) : ?>
        <span class="latest-card__label position-absolute">
          <?php echo esc_html($label); ?>
        </span>
      <?php endif; ?>
    </a>

    <p class="latest-card__date mb-2">
      Posted on <?php echo esc_html($date); ?>
    </p>

    <?php
    // if ($tags) :
    //   echo '<p class="latest-card__tags mb-2">';
    //   echo esc_html($tags);
    //   echo '</p>';
    // endif;
    ?>


    <h3 class="latest-card__title mb-3">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>

    <?php if ($excerpt) : ?>
      <p class="latest-card__excerpt mb-4">
        <?php echo esc_html($excerpt); ?>
      </p>
    <?php endif; ?>

    <div class="mt-auto">
      <a href="<?php the_permalink(); ?>" class="btn btn-green">More</a>
    </div>

  </article>
</div>
