<?php 
  // Get a unique ID for each instance of the accordion
  $row_id = get_row_index(); // Get the current ACF row index
  $faq_schema_data = [];
?>
<section class="tabbed-navigation faq-block <?php if( get_sub_field('white_or_grey') == 'grey'): ?> grey<?php endif; ?>">
  <div class="container">
    <div class="row">

      <?php if ( get_sub_field('heading') ) : ?>
        <div class="col-12 col-lg-12 mx-auto">
          <h2><?php echo esc_html( get_sub_field('heading') ); ?></h2>

        </div>
      <?php endif; ?>

      <?php if( have_rows('accordion') ): ?>
        <div class="left-tab col-12 col-lg-12">
          
          <div class="accordion accordion-block" id="accordionNav<?php echo $row_id; ?>">
            <?php $count = 0; ?>
            <?php while ( have_rows('accordion') ) : the_row();

              // Schema Markup 
              $question = get_sub_field('accordion_tab_title');
              $answer = get_sub_field('accordion_tab_body');
              if ($question && $answer) {
                $faq_schema_data[] = [
                  '@type' => 'Question',
                  'name' => wp_strip_all_tags($question),
                  'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => wp_strip_all_tags($answer)
                  ]
                ];
              }

              // Determine if this is the first item
              $is_first = ($count === 0);
            ?>
                        
              <div class="card">
                <div class="card-header" id="heading<?php echo $row_id . '-' . $count; ?>">
                  <div class="mb-3">
                    <button 
                      class="btn btn-link <?php echo $is_first ? '' : 'collapsed'; ?>" 
                      data-toggle="collapse" 
                      data-target="#collapse<?php echo $row_id . '-' . $count; ?>" 
                      aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>" 
                      aria-controls="collapse<?php echo $row_id . '-' . $count; ?>"
                    >
                      <h3 class="title-inline"><?php echo esc_html( get_sub_field('accordion_tab_title') ); ?></h3>
                      <i class="fas fa-chevron-up float-right"></i>
                    </button>
                  </div>
                </div>

                <div 
                  id="collapse<?php echo $row_id . '-' . $count; ?>" 
                  class="collapse <?php echo $is_first ? 'show' : ''; ?>" 
                  aria-labelledby="heading<?php echo $row_id . '-' . $count; ?>" 
                  data-parent="#accordionNav<?php echo $row_id; ?>"
                >
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


<?php
// Only proceed if we actually collected valid FAQ entries
if ( isset($faq_schema_data) && is_array($faq_schema_data) && !empty($faq_schema_data) ) {
    // Declare the global accumulator safely
    global $global_faq_schema_data;

    // Ensure it's initialized as an array
    if ( ! isset($global_faq_schema_data) || ! is_array($global_faq_schema_data) ) {
        $global_faq_schema_data = [];
    }

    // Merge this block's data into the global pool
    $global_faq_schema_data = array_merge($global_faq_schema_data, $faq_schema_data);
}
?>
