<?php
if( have_rows('options') ):
  while ( have_rows('options') ) : the_row();
    if( get_row_layout() == 'contact' ):
      get_template_part('modules/contact');

    elseif( get_row_layout() == 'stacked_form' ):
      get_template_part('modules/stacked-form');

    elseif( get_row_layout() == 'form' ):
      get_template_part('modules/new-form');

    elseif( get_row_layout() == 'faq_block' ):
      get_template_part('modules/faq-block');

    elseif( get_row_layout() == 'highlights' ):
      get_template_part('modules/highlights');

    elseif( get_row_layout() == 'gallery' ):
      get_template_part('modules/gallery');

    elseif( get_row_layout() == 'offices' ):
      get_template_part('modules/offices');

    elseif( get_row_layout() == 'twocol_block' ):
      get_template_part('modules/2col-block');

    elseif( get_row_layout() == 'four_col_row' ):
      get_template_part('modules/four-col-row');

    elseif ( get_row_layout() === 'latest_content' ) :
      get_template_part('modules/latest-content/latest-content');

    elseif ( get_row_layout() === 'latest_events' ) :
      get_template_part('modules/latest-events/latest-events');

    elseif( get_row_layout() == 'accordion' ):
      get_template_part('modules/accordion');

    elseif( get_row_layout() == 'latest_news' ):
      get_template_part('modules/latest-press');

    elseif( get_row_layout() == 'service_accordion' ):
      get_template_part('modules/service-accordion');

    elseif( get_row_layout() == 'accordion_seo' ):
      get_template_part('modules/accordion-seo');

    elseif( get_row_layout() == 'cta' ):
      get_template_part('modules/cta');

    elseif( get_row_layout() == 'awards_gallery' ):
        get_template_part('modules/awards-gallery');

    elseif ( get_row_layout() == 'infographic' ):
      get_template_part('modules/infographic');

    elseif( get_row_layout() == 'image_text_row'):
        get_template_part('modules/image-text-row');

    elseif( get_row_layout() == 'site_map' ):
        get_template_part('modules/sitemap');

    elseif( get_row_layout() == 'map' ):
        get_template_part('modules/map');

    elseif( get_row_layout() == 'careers_image_text_row'):
        get_template_part('modules/careers_image-text-row');

    elseif( get_row_layout() == 'community'):
        get_template_part('modules/community');

    elseif( get_row_layout() == 'clients_workwith' ):
      get_template_part('modules/clientsworkwith');

    elseif( get_row_layout() == 'txt_block' ):
      get_template_part('modules/txt_block');

    elseif( get_row_layout() == 'pull_out' ):
      get_template_part('modules/txt_block-pullout');

    elseif( get_row_layout() == 'recent' ):
      get_template_part('modules/recent');

    elseif( get_row_layout() == 'script_block' ):
      get_template_part('modules/script_block');

    elseif( get_row_layout() == 'recent_press' ):
      get_template_part('modules/recent_press');

    elseif( get_row_layout() == 'ourexperts' ):
      get_template_part('modules/ourexperts');

    elseif( get_row_layout() == 'practice' ):
      get_template_part('modules/practice');

    elseif( get_row_layout() == 'docs' ):
      get_template_part('modules/docs');

    elseif( get_row_layout() == 'related_expertise' ):
      get_template_part('modules/related_expertise');

    elseif( get_row_layout() == 'services' ):
      get_template_part('modules/services');

    elseif( get_row_layout() == 'quotes' ):
      get_template_part('modules/quotes');

    elseif( get_row_layout() == 'video' ):
      get_template_part('modules/video');

    elseif( get_row_layout() == 'video_self' ):
      get_template_part('modules/video_self');

    elseif( get_row_layout() == 'careers_txt' ):
      get_template_part('modules/careers-txt');

    elseif( get_row_layout() == 'careers-info' ):
      get_template_part('modules/careers-info');

    elseif( get_row_layout() == 'careers_equality' ):
      get_template_part('modules/careers-equality');

    elseif( get_row_layout() == 'careers_docs' ):
      get_template_part('modules/careers-docs');

    elseif( get_row_layout() == 'careers_points' ):
      get_template_part('modules/careers-points');

    elseif( get_row_layout() == 'table' ):
      get_template_part('modules/table_block');

    elseif( get_row_layout() == 'pricing_docs' ):
      get_template_part('modules/pricing_docs');

    elseif( get_row_layout() == 'cta_test' ):
      get_template_part('modules/cta-test');

    elseif( get_row_layout() == 'sos' ):
      get_template_part('modules/sos');

    elseif( get_row_layout() == 'recent_blogs' ):
      get_template_part('modules/recent_blogs');

    elseif( get_row_layout() == 'cta_banner' ):
      get_template_part('modules/cta_banner');

    endif;
  endwhile;
endif; ?>
