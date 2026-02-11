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
            <img src="/wp-content/uploads/2020/09/fb-icon.png" alt="">
          </a>

          <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink; ?>&title=<?php echo $title; ?>"
             target="_blank"
             rel="noopener"
             aria-label="Share on LinkedIn">
            <img src="/wp-content/uploads/2020/09/linkedin-icon.png" alt="">
          </a>

          <a href="https://twitter.com/intent/tweet?url=<?php echo $permalink; ?>&text=<?php echo $title; ?>"
             target="_blank"
             rel="noopener"
             aria-label="Share on X">
            <img src="/wp-content/uploads/2020/09/twitter-icon.png" alt="">
          </a>

          <a href="mailto:?subject=<?php echo $title; ?>&body=<?php echo $permalink; ?>"
             aria-label="Share by email">
            <img src="/wp-content/uploads/2020/09/mail-icon1.png" alt="">
          </a>

        </div>
      </div>
    </div>
  </div>
</section>
