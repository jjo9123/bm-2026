<?php
/**
 * Social Share (single)
 */

$permalink = urlencode(get_permalink());
$title     = urlencode(get_the_title());
?>

<section class="social-share-section py-4">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-10 mx-auto">
        <div class="social-share d-flex align-items-center gap-3 flex-wrap">

          <span class="social-share__label">Share:</span>

          <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?>"
             target="_blank"
             rel="noopener"
             aria-label="Share on Facebook">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme/img/fb-purple-icon.svg" alt="Share on Facebook">
          </a>

          <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink; ?>&title=<?php echo $title; ?>"
             target="_blank"
             rel="noopener"
             aria-label="Share on LinkedIn">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme/img/linkedin-purple-icon.svg" alt="Share on LinkedIn">
          </a>

          <!--<a href="https://twitter.com/intent/tweet?url=<?php echo $permalink; ?>&text=<?php echo $title; ?>"
             target="_blank"
             rel="noopener"
             aria-label="Share on X">
            <img src="/wp-content/uploads/2020/09/twitter-icon.png" alt="">
          </a>-->

          <a href="mailto:?subject=<?php echo $title; ?>&body=<?php echo $permalink; ?>"
             aria-label="Share by email">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme/img/email-purple-icon.svg" alt="Share via Email">
          </a>

        </div>
      </div>
    </div>
  </div>
</section>
