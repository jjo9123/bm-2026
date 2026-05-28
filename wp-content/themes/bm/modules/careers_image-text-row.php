<section class="img-txt-cards bm-pink">
  <div class="container">

    <?php if ( get_sub_field('title') ) : ?>
      <div class="row">
        <div class="col-12">
          <h2><?php the_sub_field('title'); ?></h2>
        </div>
      </div>
    <?php endif; ?>

    <?php if ( have_rows('content_row') ) : ?>
      <div class="row g-4 pt-5 pb-5">

        <?php while ( have_rows('content_row') ) : the_row(); ?>
          <div class="col-md-6 col-lg-4 pt-4">

            <div class="info-card h-100">

              <?php
              $image = get_sub_field('image');
              if ( $image ) :
              ?>
                <img
                  src="<?php echo esc_url( $image['url'] ); ?>"
                  alt="<?php echo esc_attr( $image['alt'] ); ?>"
                  class="card-logo-img"
                  loading="lazy"
                >
              <?php endif; ?>

              <h3><?php the_sub_field('title'); ?></h3>

              <div class="card-content is-collapsed">
                <?php the_sub_field('content'); ?>
              </div>

              <button class="btn btn-green mt-2 card-toggle"
                      type="button"
                      aria-expanded="false">
                Read more
              </button>

              <!-- BUTTON LOGIC -->
              <?php
              if ( get_sub_field('btn_show') === 'yes' && get_sub_field('btn_modal') === 'no' ) :
                $link = get_sub_field('btn_link');
                if ( $link ) :
              ?>
                  <a href="<?php echo esc_url( $link['url'] ); ?>"
                     class="btn btn-green mt-3">
                    <?php echo esc_html( $link['title'] ); ?>
                  </a>
              <?php
                endif;

              elseif ( get_sub_field('btn_show') === 'yes' && get_sub_field('btn_modal') === 'yes' ) :
                $post_object = get_sub_field('modal');
                if ( $post_object ) :
                  $post = $post_object;
                  setup_postdata( $post );
              ?>
                  <a href="javascript:void(0)"
                     class="btn btn-green mt-3"
                     data-toggle="modal"
                     data-target="#btn-cta-modal-<?php echo get_the_ID(); ?>">
                    <?php the_sub_field('btn_text'); ?>
                  </a>

                  <?php get_template_part( 'modules/modal' ); ?>

              <?php
                  wp_reset_postdata();
                endif;
              endif;
              ?>
              <!-- BUTTON END -->

            </div>
          </div>
        <?php endwhile; ?>

      </div>
    <?php endif; ?>

  </div>
</section>

<style>
.img-txt-cards .info-card {
  background: #fff;
  padding: 1.5rem;
  border-radius: 6px;
  height: 100%;
}

.card-logo-img {
  max-height: 120px;
  min-height: 120px;
  width: auto;
  margin-bottom: 1rem;
  display: block;
  object-fit: contain;
}

.card-content {
  overflow: hidden;
}

.card-content.is-collapsed {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.card-content.is-expanded {
  display: block;
  overflow: visible;
}

.card-toggle {
  margin-top: 20px !important;
  font-weight: 600;
  text-decoration: none;
}
</style>

<script>
(function () {
  if (window.imgTxtCardsInitialised) return;
  window.imgTxtCardsInitialised = true;

  function initCardToggles() {
    var cards = document.querySelectorAll('.img-txt-cards .info-card');

    for (var i = 0; i < cards.length; i++) {
      var card = cards[i];
      var content = card.querySelector('.card-content');
      var btn = card.querySelector('.card-toggle');

      if (!content || !btn) continue;

      btn.onclick = function (e) {
        e.preventDefault();

        var thisCard = this.closest('.info-card');
        var thisContent = thisCard.querySelector('.card-content');
        var expanded = this.getAttribute('aria-expanded') === 'true';

        if (expanded) {
          thisContent.classList.add('is-collapsed');
          thisContent.classList.remove('is-expanded');
          this.setAttribute('aria-expanded', 'false');
          this.innerHTML = 'Read more';
        } else {
          thisContent.classList.remove('is-collapsed');
          thisContent.classList.add('is-expanded');
          this.setAttribute('aria-expanded', 'true');
          this.innerHTML = 'Read less';
        }
      };
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCardToggles);
  } else {
    initCardToggles();
  }
})();
</script>