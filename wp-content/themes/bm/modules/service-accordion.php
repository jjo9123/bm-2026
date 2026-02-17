<?php
$tabs_to_show = get_sub_field('show_tabs');

// Fallback to show both if nothing is selected
if ( ! is_array($tabs_to_show) ) {
  $tabs_to_show = ['organisations', 'individuals'];
}

// Separate counters so BOTH accordions can open their first item
$org_count = 0;
$ind_count = 0;
?>

<style>
.accordion-block h4 button, .accordion-block h4 a.expertise-link {
  color: #a395b7 !important;
  text-align: left;
  text-transform: none;
  font-weight: 600!important;
}
.tabbed-navigation .card-body li a, .tabbed-navigation .card-body p a, .accordion.accordion-block .card-body h5>a{
  color: #a395b7 !important;
}
</style>

<section class="tabbed-navigation faq-block">
  <div class="container">
    <div class="row">

      <div class="col-12 col-lg-10 mx-auto">
        <?php if ( get_field('heading', 'option') ) : ?>
          <h2 class="text-center purple"><?php the_field('heading', 'option'); ?></h2>
        <?php endif; ?>
      </div>

      <?php if ( in_array('organisations', $tabs_to_show, true) && have_rows('org_tabs', 'option') ) : ?>
        <div class="left-tab col-12 col-lg-10 mx-auto">
          <h3 class="green">For organisations</h3>

          <div class="accordion accordion-block" id="accordionNavOrg">
            <?php while ( have_rows('org_tabs', 'option') ) : the_row();

              $org_exp = get_sub_field('expertise');
              $ser_exp = get_sub_field('services');

              if ( $org_exp && get_post_status($org_exp) === 'publish' ) :
                $post = $org_exp;
                setup_postdata($post);

                $is_first = ($org_count === 0);
                $heading_id = 'orgHeading' . $org_count;
                $collapse_id = 'orgCollapse' . $org_count;
            ?>
              <div class="card">
                <div class="card-header" id="<?php echo esc_attr($heading_id); ?>">
                  <h4 class="mb-0">
                    <button class="btn btn-link <?php echo $is_first ? '' : 'collapsed'; ?>"
                            data-toggle="collapse"
                            data-target="#<?php echo esc_attr($collapse_id); ?>"
                            aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                            aria-controls="<?php echo esc_attr($collapse_id); ?>">
                      <?php the_title(); ?>
                      <i class="fas fa-chevron-up float-right"></i>
                    </button>
                  </h4>
                </div>

                <div id="<?php echo esc_attr($collapse_id); ?>"
                     class="collapse <?php echo $is_first ? 'show' : ''; ?>"
                     aria-labelledby="<?php echo esc_attr($heading_id); ?>"
                     data-parent="#accordionNavOrg">
                  <div class="card-body">
                    <?php if ( $ser_exp ) : ?>
                      <h5 class="pt-2">
                        <a href="<?php the_permalink(); ?>" class="expertise-link"><?php the_title(); ?></a>
                      </h5>
                      <ul>
                        <?php foreach ( $ser_exp as $post ) :
                          if ( get_post_status($post) === 'publish' ) :
                            setup_postdata($post); ?>
                            <li>
                              <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            </li>
                            <?php wp_reset_postdata(); ?>
                          <?php endif;
                        endforeach; ?>
                      </ul>
                    <?php else : ?>
                      <p><a href="<?php the_permalink(); ?>" class="expertise-link">Learn more about <?php the_title(); ?></a></p>
                    <?php endif; ?>
                  </div>
                </div>

                <?php wp_reset_postdata(); ?>
              </div>

            <?php
                $org_count++;
              endif;
            endwhile; ?>
          </div>
        </div>
      <?php endif; ?>


      <?php if ( in_array('individuals', $tabs_to_show, true) && have_rows('ind_tabs', 'option') ) : ?>
        <div class="right-tab col-12 col-lg-10 mx-auto">
          <div class="row">
            <div class="col-12">
              <h3 class="green">Our legal services for individuals</h3>

              <div class="accordion accordion-block" id="accordionNavInd">
                <?php while ( have_rows('ind_tabs', 'option') ) : the_row();

                  $ind_exp = get_sub_field('expertise');
                  $ser_exp = get_sub_field('services');

                  if ( $ind_exp && get_post_status($ind_exp) === 'publish' ) :
                    $post = $ind_exp;
                    setup_postdata($post);

                    $is_first = ($ind_count === 0);
                    $heading_id = 'indHeading' . $ind_count;
                    $collapse_id = 'indCollapse' . $ind_count;
                ?>
                  <div class="card">
                    <div class="card-header" id="<?php echo esc_attr($heading_id); ?>">
                      <h4 class="mb-0">
                        <button class="btn btn-link <?php echo $is_first ? '' : 'collapsed'; ?>"
                                data-toggle="collapse"
                                data-target="#<?php echo esc_attr($collapse_id); ?>"
                                aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                                aria-controls="<?php echo esc_attr($collapse_id); ?>">
                          <?php the_title(); ?>
                          <i class="fas fa-chevron-up float-right"></i>
                        </button>
                      </h4>
                    </div>

                    <div id="<?php echo esc_attr($collapse_id); ?>"
                         class="collapse <?php echo $is_first ? 'show' : ''; ?>"
                         aria-labelledby="<?php echo esc_attr($heading_id); ?>"
                         data-parent="#accordionNavInd">
                      <div class="card-body">
                        <?php if ( $ser_exp ) : ?>
                          <h4 class="pt-2">
                            <a href="<?php the_permalink(); ?>" class="expertise-link"><?php the_title(); ?></a>
                          </h4>
                          <ul>
                            <?php foreach ( $ser_exp as $post ) :
                              if ( get_post_status($post) === 'publish' ) :
                                setup_postdata($post); ?>
                                <li>
                                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                                <?php wp_reset_postdata(); ?>
                              <?php endif;
                            endforeach; ?>
                          </ul>
                        <?php else : ?>
                          <p><a href="<?php the_permalink(); ?>" class="expertise-link">Learn more about <?php the_title(); ?></a></p>
                        <?php endif; ?>
                      </div>
                    </div>

                    <?php wp_reset_postdata(); ?>
                  </div>

                <?php
                    $ind_count++;
                  endif;
                endwhile; ?>
              </div>

            </div>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
