<?php
/**
 * Blog Hero (single)
 * Expects to run inside The Loop / single context.
 */

$thumb_url  = get_the_post_thumbnail_url(get_the_ID(), 'blog-hero');
$categories = get_the_category();
$slug       = ! empty($categories) ? $categories[0]->slug : '';
?>

<section class="hero py-5 bm-beige">
  <div class="container">
    <div class="row align-items-stretch g-4">

      <!-- Text column -->
      <div class="col-12 col-lg-6 d-flex align-items-center">
        <div>
          <?php if ( $post_type === 'press' ) : ?>

          <span class="latest-card__label blog-header mb-0">
            News
          </span>

        <?php elseif ( ! empty( $categories ) ) : ?>

          <?php
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

          <?php if ( $slug !== 'guides' ) : ?>
            <time class="post-date" datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
              <?php echo esc_html(get_the_date('jS F Y')); ?>
            </time>
          <?php endif; ?>

          
          <?php $featured_authors = get_field('author');
            if( $featured_authors ): ?>

            <p class="s-txt mb-1 mt-2 bm-purple-txt">Written by</p>

            <?php 
            $authors_output = [];

            foreach ($featured_authors as $post) {
                setup_postdata($post);
                $details_post = get_field('contact_details');

                if (!empty($details_post['first_name']) || !empty($details_post['last_name'])) {
                    $name = trim($details_post['first_name'] . ' ' . $details_post['last_name']);
                    $url = get_permalink();

                    $authors_output[] = '<a href="' . esc_url($url) . '" class="author-name">' . esc_html($name) . '</a>';
                }
            }

            echo implode(', ', $authors_output);

            wp_reset_postdata();
            ?>

        <?php endif; ?>
                        
        </div>
      </div>

      <!-- Decorative image column -->
      <div class="col-12 col-lg-6">
        <?php if ( $thumb_url ) : ?>
          <?php echo wp_get_attachment_image(
              get_post_thumbnail_id(),
              'blog-hero',
              false,
              [
                  'class' => 'hero-media img-fluid',
                  'loading' => 'eager'
              ]
          ); ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
