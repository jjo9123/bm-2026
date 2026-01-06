<section class="tabbed-navigation" style="background-color: #404040;">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-10 mx-auto">
        <?php if (get_field('heading', 'option')) : ?>
            <h2 class="text-center purple"><?php the_field('heading', 'option'); ?></h2>
            <hr class="heading green">
        <?php endif; ?>

      </div>

      <?php if( have_rows('org_tabs', 'option') ): ?>
        <div class="left-tab col-12 col-lg-10 col-xl-6">
          <h3 class="green">For Organisations</h3>

          <div class="accordion" id="accordionNav">
            <?php $count = 0; ?>
            <?php while ( have_rows('org_tabs', 'option') ) : the_row();
              $org_exp = get_sub_field('expertise');
              $ser_exp = get_sub_field('services');

              if ( $org_exp && get_post_status( $org_exp ) === 'publish' ) :
                $post = $org_exp;
                setup_postdata( $post );
            ?>
              <div class="card">
                <div class="card-header" id="heading<?php echo $count; ?>">
                  <h4 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $count; ?>" aria-expanded="false" aria-controls="collapse<?php echo $count; ?>">
                      <?php the_title(); ?>
                      <i class="fas fa-chevron-up float-right"></i>
                    </button>
                  </h4>
                </div>
                <?php if( $ser_exp ): ?>
                  <div id="collapse<?php echo $count; ?>" class="collapse" aria-labelledby="heading<?php echo $count; ?>" data-parent="#accordionNav">
                    <div class="card-body">
                      <h5 class="pt-2"><a href="<?php the_permalink(); ?>" class="expertise-link"><?php the_title(); ?></a></h5>
                      <ul>
                        <?php foreach( $ser_exp as $post ): ?>
                          <?php if ( get_post_status( $post ) === 'publish' ) :
                            setup_postdata( $post ); ?>
                            <li>
                              <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            </li>
                            <?php wp_reset_postdata(); ?>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  </div>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
              </div>
              <?php $count++; ?>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if( have_rows('ind_tabs', 'option') ): ?>
        <div class="right-tab col-12 col-lg-10 col-xl-6">
          <div class="row">
            <div class="col-12">
              <h3 class="green">For Individuals</h3>

              <div class="accordion" id="accordionNav1">
                <?php while ( have_rows('ind_tabs', 'option') ) : the_row();
                  $ind_exp = get_sub_field('expertise');
                  $ser_exp = get_sub_field('services');

                  if ( $ind_exp && get_post_status( $ind_exp ) === 'publish' ) :
                    $post = $ind_exp;
                    setup_postdata( $post );
                ?>
                  <div class="card">
                    <div class="card-header" id="heading<?php echo $count; ?>">
                      <h4 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $count; ?>" aria-expanded="false" aria-controls="collapse<?php echo $count; ?>">
                          <?php the_title(); ?>
                          <i class="fas fa-chevron-up float-right"></i>
                        </button>
                      </h4>
                    </div>
                    <?php if( $ser_exp ): ?>
                      <div id="collapse<?php echo $count; ?>" class="collapse" aria-labelledby="heading<?php echo $count; ?>" data-parent="#accordionNav1">
                        <div class="card-body">
                        <h4 class="pt-2"><a href="<?php the_permalink(); ?>" class="expertise-link"><?php the_title(); ?></a></h4>
                          <ul>
                            <?php foreach( $ser_exp as $post ): ?>
                              <?php if ( get_post_status( $post ) === 'publish' ) :
                                setup_postdata( $post ); ?>
                                <li>
                                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                                <?php wp_reset_postdata(); ?>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                  </div>
                  <?php $count++; ?>
                  <?php endif; ?>
                <?php endwhile; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
