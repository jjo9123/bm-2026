<?php
if( have_rows('options') ):
  while ( have_rows('options') ) : the_row();
    if( get_row_layout() == 'contact' ):
      get_template_part('modules/ppc-content/contact');

    elseif( get_row_layout() == 'highlights' ):
      get_template_part('modules/ppc-content/highlights');

    elseif( get_row_layout() == 'gallery' ):
      get_template_part('modules/ppc-content/gallery');

    elseif( get_row_layout() == 'offices' ):
      get_template_part('modules/ppc-content/offices');

    elseif( get_row_layout() == 'accordion' ):
      get_template_part('modules/ppc-content/accordion');

    elseif( get_row_layout() == 'accordion_seo' ):
      get_template_part('modules/ppc-content/accordion-seo');

    elseif( get_row_layout() == 'cta' ):
      get_template_part('modules/ppc-content/cta');

    elseif ( get_row_layout() == 'infographic' ):
      get_template_part('modules/ppc-content/infographic');

    elseif( get_row_layout() == 'image_text_row'):
        get_template_part('modules/ppc-content/image-text-row');

    elseif( get_row_layout() == 'site_map' ):
        get_template_part('modules/ppc-content/sitemap');

    elseif( get_row_layout() == 'careers_image_text_row'):
        get_template_part('modules/ppc-content/careers_image-text-row');

    elseif( get_row_layout() == 'community'):
        get_template_part('modules/ppc-content/community');

    elseif( get_row_layout() == 'clients_workwith' ):
      get_template_part('modules/ppc-content/clientsworkwith');

    elseif( get_row_layout() == 'txt_block' ):
      get_template_part('modules/ppc-content/txt_block');

    elseif( get_row_layout() == 'pull_out' ):
      get_template_part('modules/ppc-content/txt_block-pullout');

    elseif( get_row_layout() == 'recent' ):
      get_template_part('modules/ppc-content/recent');

    elseif( get_row_layout() == 'recent_press' ):
      get_template_part('modules/ppc-content/recent_press');

    elseif( get_row_layout() == 'ourexperts' ):
      get_template_part('modules/ppc-content/ourexperts');

    elseif( get_row_layout() == 'practice' ):
      get_template_part('modules/ppc-content/practice');

    elseif( get_row_layout() == 'docs' ):
      get_template_part('modules/ppc-content/docs');

    elseif( get_row_layout() == 'related_expertise' ):
      get_template_part('modules/ppc-content/related_expertise');

    elseif( get_row_layout() == 'services' ):
      get_template_part('modules/ppc-content/services');

    elseif( get_row_layout() == 'quotes' ):
      get_template_part('modules/ppc-content/quotes');

    elseif( get_row_layout() == 'video' ):
      get_template_part('modules/ppc-content/video');

    elseif( get_row_layout() == 'careers_txt' ):
      get_template_part('modules/ppc-content/careers-txt');

    elseif( get_row_layout() == 'careers-info' ):
      get_template_part('modules/ppc-content/careers-info');

    elseif( get_row_layout() == 'careers_equality' ):
      get_template_part('modules/ppc-content/careers-equality');

    elseif( get_row_layout() == 'careers_docs' ):
      get_template_part('modules/ppc-content/careers-docs');

    elseif( get_row_layout() == 'careers_points' ):
      get_template_part('modules/ppc-content/careers-points');

    elseif( get_row_layout() == 'pricing_docs' ):
      get_template_part('modules/ppc-content/pricing_docs');

    elseif( get_row_layout() == 'cta_test' ):
      get_template_part('modules/ppc-content/cta-test');

    elseif( get_row_layout() == 'sos' ):
      get_template_part('modules/ppc-content/sos');
      
    elseif( get_row_layout() == 'recent_blogs' ):
      get_template_part('modules/ppc-content/recent_blogs');
      
    elseif( get_row_layout() == 'cta_banner' ):
      get_template_part('modules/ppc-content/cta_banner');

    endif;
  endwhile;
endif; ?>
