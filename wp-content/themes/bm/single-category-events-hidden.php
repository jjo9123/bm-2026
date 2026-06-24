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
  .category-events .txt ul li:before {
    border-color: transparent #8ed300;
    border-style: solid;
    border-width: 0.65em 0 0.65em 0.75em;
    content: "";
    display: block;
    height: 0;
    width: 0;
    position: relative;
    left: -1.4em;
    top: 1.4em;
  }
  
  .category-events .txt ul {
    font-weight: 400;
    list-style: none;
    margin: 0.75em 0;
    padding: 0 2em;
    padding-bottom: 2em;
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
    color: #8ed300;
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
    /*-ms-flex-flow: wrap;
        flex-flow: wrap;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
        -ms-flex-direction: row;
            flex-direction: row;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
    -ms-flex-line-pack: center;
        align-content: center;*/
    padding: 30px;
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

    <?php get_template_part('modules/parts/single-post/events-modules'); ?>

    <?php get_template_part('modules/parts/single-post/social-share'); ?>

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
