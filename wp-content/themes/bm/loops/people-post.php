<?php
/*
 * The Index Post (or excerpt)
 * ===========================
 * Used by index.php, category.php and author.php
 */
?>

<?php
  $person = get_field('contact_details');
  $link = get_permalink(); ?>

  <div class="col-md-5 col-lg-4 col-xl-3 mx-auto staff-contact details">
    <a href="<?php the_permalink(); ?>">
      <div class="img" style="background: url('<?php echo $person['img']; ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>
    </a>

    <div class="header">
      <a href="<?php the_permalink(); ?>" class="people-name">
        <h5><?php echo $person['first_name']; ?> <?php echo $person['last_name']; ?></h5>
      </a>

      <h6 class="dpurple"><?php echo $person['job_title']; ?></h6>


    </div>

    <div class="excerpt">
      <div class="contact-listing">
        <?php if( $person['mobile_number'] ): ?>
        <p class="mobile"><?php echo $person['mobile_number']; ?></p>
        <?php endif; ?>

        <?php if( $person['landline_number'] ): ?>
        <p class="phone"><?php echo $person['landline_number']; ?></p>
        <?php endif; ?>

        <?php if( $person['email_address'] ): ?>
        <a class="staff-email" href="mailto:<?php echo $person['email_address']; ?>?bcc=BD@blakemorgan.co.uk">
          <p class="email">Email me</p>
        </a>
        <?php endif; ?>

        <?php
        $post_object = $person['location'];
        if( $post_object ):
          $post = $post_object;
          setup_postdata( $post );
        ?>

          <p class="location">
            <a href="<?php the_permalink(); ?>"><?php echo get_the_title($post_object->ID); ?></a>
          </p>

          <?php wp_reset_postdata(); ?>

        <? else: ?>

         <p class="location" style="visibility: hidden;"></p>

        <?php endif; ?>
      </div>

      <?php
      if( $person['twitter_link'] && $person['linkedin_link'] ): ?>

        <div class="social">
          <?php if( $person['twitter_link'] ): ?>
            <a href="<?php echo $person['twitter_link']; ?>">
              <p class="twitter"></p>
            </a>
          <?php endif; ?>

          <?php if( $person['linkedin_link'] ): ?>
            <a href="<?php echo $person['linkedin_link']; ?>">
              <p class="linkedin"></p>
            </a>
          <?php endif; ?>
        </div>

      <? else : ?>
      <div class="social" style="visibility: hidden;">
        <p class="twitter"></p>
        <p class="linkedin"></p>
      </div>

      <?php endif; ?>

      <div class="view-profile">
        <a href="<?php echo $link; ?>" class="btn btn-purple">View Profile</a>
      </div>
    </div>
  </div>
