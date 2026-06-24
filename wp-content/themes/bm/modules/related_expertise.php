<section class="txt services bm-purple">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-10 col-xl-12 mx-auto">

        <h2>Related expertise</h2>

        <?php
        $expertises = get_sub_field('expertise');
        if ( $expertises ) :
        ?>
          <ul class="row g-3 list-unstyled mb-0 services-list">
            <?php foreach ( $expertises as $post ) : setup_postdata($post); ?>

              <?php if ( get_post_status() === 'publish' ) : ?>
                <li class="col-12 col-md-6 col-lg-4">
                  <a class="services-link d-block py-2" href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </li>
              <?php endif; ?>

            <?php endforeach; ?>
          </ul>

          <?php wp_reset_postdata(); ?>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>
