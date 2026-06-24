<section class="txt bm-beige">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-10 col-xl-12 mx-auto">
        <?php if( the_sub_field('heading') ): ?>
          <h2>
            <?php the_sub_field('heading'); ?>
          </h2>
        <?php endif; ?>

        <?php
          if( have_rows('bullet_points') ): ?>
            <ul class="styled">
              <?php  while ( have_rows('bullet_points') ) : the_row(); ?>
                <li>
                  <?php the_sub_field('bullet_point'); ?>
                </li>
              <?php endwhile; ?>
            </ul>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
