<?php
/**
 * Blog CTA (single)
*/

if ( get_field('add_blog_cta') !== 'yes' ) return;

$cta_post_object = get_field('choose_cta');
if ( ! $cta_post_object ) return;

// Preserve original post object + setup CTA post
$original_post = $post;
$post = $cta_post_object;
setup_postdata($post);

$cta_id = get_the_ID();

// Only render if set to blog
if ( get_field('blog_or_page', $cta_id) !== 'blog' ) {
  wp_reset_postdata();
  $post = $original_post;
  return;
}

// Background colour from selected CTA post
$bg_class = get_field('bg_colour', $cta_id) ?: 'bm-pink';

// Old background image option kept in case needed later.
// $bg = get_field('background_image', $cta_id);
?>

<section class="cta-banner text-center <?php echo esc_attr($bg_class); ?>">
  <div class="container">
    <div class="row">

      <?php if ( get_field('add_image') === 'yes' ) : ?>
        <div class="col-8 col-md-6 ml-auto">
          <?php
            $image = get_field('image');
            if ( ! empty($image) ) :
          ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
          <?php endif; ?>
        </div>

        <div class="col-12 w-image col-md-6" style="text-align: left;">
          <div>
            <h2 class="header"><?php the_field('title'); ?></h2>
            <p class="regular"><?php the_field('sub_title'); ?></p>

            <?php if ( get_field('add_button') === 'yes' ) : ?>
              <?php if ( get_field('popup_or_pagelink') === 'pagelink' ) : ?>

                <a href="<?php the_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_field('button_text'); ?></a>

              <?php elseif ( get_field('popup_or_pagelink') === 'external' ) : ?>

                <a href="<?php the_field('external_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_field('button_text'); ?></a>

              <?php elseif ( get_field('popup_or_pagelink') === 'popup' ) : ?>

                <a href="javascript:void(0)"
                   class="btn btn-green header"
                   data-toggle="modal"
                   data-name="<?php echo esc_attr(get_the_title()); ?>"
                   data-target="#btn-customcta-modal-<?php echo esc_attr(get_the_ID()); ?>145">
                  <?php the_field('button_text'); ?>
                </a>

                <?php get_template_part('modules/modal-cta'); ?>

              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>

      <?php else : ?>
        <!-- Full width text CTA -->
        <div class="col-12">
          <h2 class="header"><?php the_field('title'); ?></h2>
          <p class="regular"><?php the_field('sub_title'); ?></p>

          <?php if ( get_field('add_button') === 'yes' ) : ?>
            <?php if ( get_field('popup_or_pagelink') === 'pagelink' ) : ?>

              <a href="<?php the_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_field('button_text'); ?></a>

            <?php elseif ( get_field('popup_or_pagelink') === 'external' ) : ?>

              <a href="<?php the_field('external_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_field('button_text'); ?></a>

            <?php elseif ( get_field('popup_or_pagelink') === 'popup' ) : ?>

              <a href="javascript:void(0)"
                 class="btn btn-green header"
                 data-toggle="modal"
                 data-name="<?php echo esc_attr(get_the_title()); ?>"
                 data-target="#btn-customcta-modal-<?php echo esc_attr(get_the_ID()); ?>145">
                <?php the_field('button_text'); ?>
              </a>

              <?php get_template_part('modules/modal-cta'); ?>

            <?php endif; ?>
          <?php endif; ?>
        </div>

      <?php endif; ?>

    </div>
  </div>
</section>

<?php
wp_reset_postdata();
$post = $original_post;
?>
