<?php if( get_sub_field('quote') ): ?>
<style>
  .single section.quotes {
    padding: 20px 0 30px;
  }
</style>
<section class="quotes text-center bm-white <?php if( get_sub_field('white_or_grey') == 'grey'): ?> bm-beige<?php endif; ?>">
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