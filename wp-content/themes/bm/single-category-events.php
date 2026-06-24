<?php
    get_header();
    b4st_main_before();

    // get variables
    $event_details = get_field('event_details');
?>

<style>
  .category-events .txt li {
    font-size: 1.1rem;
  }
  .category-events .txt h6 {
    padding-bottom: 1em;
  }
  .category-events .txt h2 {
    margin-top: 15px;
    margin-bottom: 30px;
  }
  .category-events .txt.hosts h2 {
    margin-bottom: 40px;
  }
  .category-events .txt h3, .category-events .txt h4, .category-events .txt h5 {
    text-transform: none;
    margin-bottom: 15px;
  }
  .category-events .txt.hosts .row.regional-info {
    padding-bottom: 20px;
  }
  .category-events .intro-text {
    font-size: 1.5rem;
    font-weight: 500;
    line-height: 1.8;
    padding: 30px;
    padding-left: 0;
    padding-right: 0;
  }
  body .category-events .single-content {
    padding-top: 0;
  }
  .category-events .info-box p {
    font-weight: 400;
  }
</style>

<main id="main" class="blog events">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php get_template_part('modules/parts/single-post/hero-events'); ?>

    <?php get_template_part('modules/parts/single-post/social-share'); ?>

    <?php get_template_part('modules/parts/single-post/events-modules'); ?>

    

    <?php if (get_field('form_show') === 'yes') : ?>
      <?php get_template_part('modules/blog-form'); ?>
    <?php endif; ?>

    <?php get_template_part('modules/parts/single-post/blog-cta'); ?>
    <?php get_template_part('modules/parts/single-post/related-posts'); ?>

  <?php endwhile; else : ?>
    <?php get_template_part('loops/404'); ?>
  <?php endif; ?>
</main>

<?php
    b4st_main_after();
    get_footer();
?>
