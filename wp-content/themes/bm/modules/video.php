<?php
$bg_class = get_sub_field('bg_colour') ?: 'bm-beige';
?>
<section class="video text-center pt-5 pb-5 <?php echo esc_attr($bg_class); ?>">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-10 mx-auto">
        <h2 class="header"><?php echo the_sub_field('heading'); ?></h2>
        
        <div class="cookieconsent-optout-marketing" style="text-align: center; padding-top: 15px;">
            <p>Please <a href="javascript:Cookiebot.renew()">accept marketing-cookies</a> to watch this video.</p>
        </div>
        <?php echo the_sub_field('embed'); ?>
      </div>
    </div>
  </div>
</section>
