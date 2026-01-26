<?php $seo_title = get_field("seo_title"); ?>
<section class="tabbed-navigation" style="background-color: #404040;">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-10 mx-auto">
        <h2 class="text-center purple"><?php the_sub_field('heading'); ?></h2>
        
       </div>
      <?php if( have_rows('org_tabs') ): ?>
        <div class="left-tab col-12 col-lg-10 col-xl-6">
          <h3 class="green">For Organisations</h3>

          <div class="accordion" id="accordionNav">
            <?php $count = 0; ?>
            <?php while ( have_rows('org_tabs') ) : the_row();
                        $org_exp = get_sub_field('expertise');
                        $ser_exp = get_sub_field('services');
                        $post = $org_exp;
                        setup_postdata( $post );?>
              <div class="card">
                <div class="card-header" id="heading<?php echo $count; ?>">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $count; ?>" aria-expanded="false" aria-controls="collapse<?php echo $count; ?>">
                      <a href="<?php the_permalink(); ?>" class="expertise-link"><?php the_title(); ?></a>
                      <i class="fas fa-chevron-up float-right"></i>
                    </button>
                  </h5>
                </div>
                <?php wp_reset_postdata(); ?>

                <?php if( $ser_exp ): ?>
                  <div id="collapse<?php echo $count; ?>" class="collapse" aria-labelledby="heading<?php echo $count; ?>" data-parent="#accordionNav">
                    <div class="card-body">
                      <ul>
                        <?php foreach( $ser_exp as $post ): ?>
                        <li>
                          <a href="<?php the_permalink(); ?>">
                          <?php if ( has_term( 'seo', 'seo' ) ) { ?>
                              Yes
                          <?php } else { ?>
                             <?php the_title(); ?>
                          <?php } ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  </div>
              </div>
                  <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                <?php $count++; ?>
              <?php endwhile; ?>
            </div>
          </div>


      <?php endif; ?>

    <?php if( have_rows('ind_tabs') ): ?>
    <div class="right-tab col-12 col-lg-10 col-xl-6">
      <div class="row">
        <div class="col-12">
          <h3 class="green">For Individuals</h3>

          <div class="accordion" id="accordionNav1">
            <?php while ( have_rows('ind_tabs') ) : the_row();
                  $ind_exp = get_sub_field('expertise');
                  $ser_exp = get_sub_field('services');
                  $post = $ind_exp;
                  setup_postdata($post);?>

            <div class="card">
              <div class="card-header" id="heading<?php echo $count; ?>">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $count; ?>" aria-expanded="false" aria-controls="collapse<?php echo $count; ?>">
                    <a href="<?php the_permalink(); ?>" class="expertise-link"><?php the_title(); ?></a>
                    <i class="fas fa-chevron-up float-right"></i>
                  </button>
                </h5>
              </div>

              <?php if( $ser_exp ): ?>
              <div id="collapse<?php echo $count; ?>" class="collapse" aria-labelledby="heading<?php echo $count; ?>" data-parent="#accordionNav1">
                <div class="card-body">
                  <ul>
                    <?php foreach( $ser_exp as $post ): ?>
                    <li>
                      <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                      </a>
                    </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
              <?php wp_reset_postdata(); ?>
              <?php endif; ?>

              <?php $count++; ?>
              <?php endwhile; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
  </div>
  </div>
</section>
