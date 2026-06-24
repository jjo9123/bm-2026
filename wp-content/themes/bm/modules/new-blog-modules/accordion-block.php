<?php 
  // Get a unique ID for each instance of the accordion
  $row_id = get_row_index(); // Get the current ACF row index
?>
<section class="tabbed-navigation <?php if( get_sub_field('white_or_grey') == 'grey'): ?> bm-beige<?php endif; ?>">
  <div class="container">
    <div class="row">

      <?php if ( get_sub_field('title') ) : ?>
        <div class="col-12 col-lg-12 mx-auto">
          <h2 class="text-left"><?php echo esc_html( get_sub_field('title') ); ?></h2>
        </div>
      <?php endif; ?>

      <?php if( have_rows('accordion') ): ?>
        <div class="left-tab col-12 col-lg-12">
          
          <div class="accordion accordion-block" id="accordionNav<?php echo $row_id; ?>">
            <?php $count = 0; ?>
            <?php while ( have_rows('accordion') ) : the_row(); ?>
                        
              <div class="card">
                <div class="card-header" id="heading<?php echo $row_id . '-' . $count; ?>">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $row_id . '-' . $count; ?>" aria-expanded="false" aria-controls="collapse<?php echo $row_id . '-' . $count; ?>">
                      <h4 class="title-inline"><?php echo esc_html( get_sub_field('accordion_tab_title') ); ?></h4>
                      <i class="fas fa-chevron-up float-right"></i>
                    </button>
                  </h5>
                </div>

                <div id="collapse<?php echo $row_id . '-' . $count; ?>" class="collapse" aria-labelledby="heading<?php echo $row_id . '-' . $count; ?>" data-parent="#accordionNav<?php echo $row_id; ?>">
                  <div class="card-body">
                    <?php echo get_sub_field('accordion_tab_body'); ?>
                  </div>
                </div>
              </div>

              <?php $count++; ?>
            <?php endwhile; ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
