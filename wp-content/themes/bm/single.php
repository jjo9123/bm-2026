<?php
  get_header();
  b4st_main_before();

  $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
  $categories = get_the_category();
  $slug = ! empty($categories) ? $categories[0]->slug : '';

?>

<main id="main" class="blog">
  <section class="hero py-5 bm-beige">
    <div class="container">
      <div class="row align-items-stretch g-4">

        <!-- Text column -->
        <div class="col-12 col-lg-6 d-flex align-items-center">
          <div>
            <?php
            if ( ! empty( $categories ) ) :
              $name = $categories[0]->name;

              $no_trim = ['News', 'Press', 'Case Studies'];

              if ( ! in_array( $name, $no_trim, true ) ) {
                $name = preg_replace('/s$/', '', $name);
              }
            ?>
              <span class="latest-card__label blog-header mb-0">
                <?php echo esc_html( $name ); ?>
              </span>
            <?php endif; ?>

            <h1 class="mb-3 bm-purple-txt"><?php the_title(); ?></h1>
            <?php if ($slug !== 'guides') : ?>
              <time
                class="post-date"
                datetime="<?php echo get_the_date('Y-m-d'); ?>"
              >
                <?php echo get_the_date('jS F Y'); ?>
              </time>
            <?php endif; ?>
          </div>
        </div>

        <!-- Decorative image column -->
        <div class="col-12 col-lg-6">
          <?php if ($thumb_url) : ?>
            <div
              class="hero-media"
              style="background-image:url('<?php echo esc_url($thumb_url); ?>');"
              aria-hidden="true"
            ></div>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </section>

  <section class="single">
    <div id="content" role="main">
      <?php get_template_part('loops/single-post', get_post_format()); ?>
    </div>
  </section>
</main>

<?php
  b4st_main_after();
  get_footer();
?>
