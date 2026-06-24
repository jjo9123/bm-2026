<?php if( get_sub_field('quote') ): ?>
<style>
  .single section.quotes {
    padding: 20px 0 30px;
  }
</style>
<?php
$bg_class = (get_sub_field('white_or_grey') === 'grey')
  ? 'bm-beige'
  : 'bm-white';
?>

<section class="txt quotes text-center <?php echo esc_attr($bg_class); ?>">
  <div class="container">
    <div class="row">
      
      <div class="col-12 mx-auto quote">
           
                <p>
                  <?php the_sub_field('quote'); ?>
                </p>

      </div>

    </div>
  </div>
</section>
<?php endif; ?>