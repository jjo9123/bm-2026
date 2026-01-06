<section class="txt">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-10 mx-auto">

        <?php if( have_rows('pages') ): ?>

          <?php while( have_rows('pages') ) : the_row();
            $parent = get_sub_field('parent_page');
            $child = get_sub_field('child_pages', false, false); ?>

            <h3 class="green">
              <?php if( $parent ): ?>
                <a href="<?php echo $parent; ?>">
              <?php endif; ?>
              <?php echo the_sub_field('parent_page_name'); ?>
              <?php if( $parent ): ?></a><?php endif; ?>
            </h3>

            <?php if( $child ): ?>
              <ul>
                <?php foreach( $child as $post ): ?>
                  <?php if ( get_post_status( $post ) === 'publish' ) :
                    setup_postdata( $post ); ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php wp_reset_postdata(); ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

          <?php endwhile; ?>

        <?php endif; ?>

      </div>

      <div class="col-12 col-lg-10 mx-auto">

        <?php if( have_rows('org_tabs', 'option') ): ?>
          <h2 class="purple">For Organisations</h2>
          <?php while ( have_rows('org_tabs', 'option') ) : the_row();
            $org_exp = get_sub_field('expertise');
            $ser_exp = get_sub_field('services');

            if ( $org_exp && get_post_status( $org_exp ) === 'publish' ) :
              $post = $org_exp;
              setup_postdata( $post ); ?>
              <h5 class="green"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <?php wp_reset_postdata(); ?>

              <?php if( $ser_exp ): ?>
                <ul>
                  <?php foreach( $ser_exp as $post ): ?>
                    <?php if ( get_post_status( $post ) === 'publish' ) :
                      setup_postdata( $post ); ?>
                      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                      <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>

      </div>

      <div class="col-12 col-lg-10 mx-auto">

        <?php if( have_rows('ind_tabs', 'option') ): ?>
          <h2 class="purple">For Individuals</h2>
          <?php while ( have_rows('ind_tabs', 'option') ) : the_row();
            $ind_exp = get_sub_field('expertise');
            $ser_exp = get_sub_field('services');

            if ( $ind_exp && get_post_status( $ind_exp ) === 'publish' ) :
              $post = $ind_exp;
              setup_postdata( $post ); ?>
              <h5 class="green"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <?php wp_reset_postdata(); ?>

              <?php if( $ser_exp ): ?>
                <ul>
                  <?php foreach( $ser_exp as $post ): ?>
                    <?php if ( get_post_status( $post ) === 'publish' ) :
                      setup_postdata( $post ); ?>
                      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                      <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>

      </div>

    </div>
  </div>
</section>