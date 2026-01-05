


<section class="contact blog" style="background-color: #404040;">
  <div class="container">
    <div class="row">
      <div id="blogform" class="col-lg-8 mb-4 mx-auto">
        <h2 class="text-center">
          <?php the_field('heading'); ?>
        </h2>

        <hr class="heading green">

        <?php if( get_field('form_txt') ): ?>
          <p class="text-center"><?php the_field('form_txt'); ?></p>
        <?php endif; ?>
      </div>

      <div class="col-10 col-sm-10 col-md-6 mx-auto">
        <?php
          $form_object = get_field('form');
          gravity_form_enqueue_scripts($form_object['id'], true);
          gravity_form($form_object['id'], false, false, false, '', true, 1);
        ?>
        <?php if ( get_field('add_form_footer') == 'yes' ):
          if( get_field('form_footer') ): ?>
            <div class="form-footer" style="text-align: left!important;">
              <?php the_field('form_footer'); ?>
            </div>
         <?php endif;
        endif; ?>
        
      </div>
    </div>
  </div>
</section>
