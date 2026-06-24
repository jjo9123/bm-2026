<section class="tabbed-navigation py-4 bm-dark-grey">
  <div class="container">
    <div class="row">

      <div class="col-12 col-lg-10 mx-auto">
        <?php if ( get_field('heading', 'option') ) : ?>
          <h2><?php the_field('heading', 'option'); ?></h2>
        <?php endif; ?>
      </div>

      <?php
      // Helpers
      $to_id = function ($val) {
        if (is_object($val) && isset($val->ID)) return (int) $val->ID;
        if (is_numeric($val)) return (int) $val;
        return 0;
      };

      $build_items = function ($rows) use ($to_id) {
        $items = [];
        if (!is_array($rows)) return $items;

        foreach ($rows as $row) {
          $exp_id = $to_id($row['expertise'] ?? null);
          if (!$exp_id || get_post_status($exp_id) !== 'publish') continue;

          $services = $row['services'] ?? [];
          $items[] = [
            'exp_id'   => $exp_id,
            'services' => is_array($services) ? $services : [],
          ];
        }
        return $items;
      };

      $chunk3 = function (array $items) {
        $per_col = max(1, (int) ceil(count($items) / 3));
        return array_chunk($items, $per_col);
      };

      // Data
      $org_rows = get_field('org_tabs', 'option');
      $ind_rows = get_field('ind_tabs', 'option');

      $org_items = $build_items($org_rows);
      $ind_items = $build_items($ind_rows);

      $org_cols = $chunk3($org_items);
      $ind_cols = $chunk3($ind_items);
      ?>

      <?php if (!empty($org_items)) : ?>
        <div class="left-tab col-12 col-lg-12 mx-auto">
          <h3 class="pb-3">For organisations</h3>
          <hr class="bm-white">

          <div class="row">
            <?php for ($c = 0; $c < 3; $c++) :
              $col_items = $org_cols[$c] ?? [];
              if (empty($col_items)) continue;

              $acc_id = 'accordionNav-org-' . ($c + 1);
            ?>
              <div class="col-12 col-lg-4">
                <div class="accordion" id="<?php echo esc_attr($acc_id); ?>">
                  <?php foreach ($col_items as $i => $item) :
                    $exp_id   = $item['exp_id'];
                    $services = $item['services'];

                    $heading_id  = 'org-heading-' . $c . '-' . $i;
                    $collapse_id = 'org-collapse-' . $c . '-' . $i;
                  ?>
                    <div class="card">
                      <div class="card-header" id="<?php echo esc_attr($heading_id); ?>">
                        <h4 class="mb-0">
                          <button
                            class="btn btn-link collapsed d-flex align-items-start text-left"
                            type="button"
                            data-toggle="collapse"
                            data-target="#<?php echo esc_attr($collapse_id); ?>"
                            aria-expanded="false"
                            aria-controls="<?php echo esc_attr($collapse_id); ?>"
                          >
                            <i class="fas fa-chevron-up mr-2 flex-shrink-0"></i>
                            <span class="flex-fill">
                              <?php echo esc_html(get_the_title($exp_id)); ?>
                            </span>
                          </button>
                        </h4>
                      </div>

                      
                        <div
                          id="<?php echo esc_attr($collapse_id); ?>"
                          class="collapse"
                          aria-labelledby="<?php echo esc_attr($heading_id); ?>"
                          data-parent="#<?php echo esc_attr($acc_id); ?>"
                        >
                          <div class="card-body">
                            <h5 class="pt-2">
                              <a href="<?php echo esc_url(get_permalink($exp_id)); ?>" class="expertise-link">
                                <?php echo esc_html(get_the_title($exp_id)); ?>
                              </a>
                            </h5>
                            <?php if (!empty($services)) : ?>
                            <ul>
                              <?php foreach ($services as $svc) :
                                $svc_id = $to_id($svc);
                                if (!$svc_id || get_post_status($svc_id) !== 'publish') continue;
                              ?>
                                <li>
                                  <h5 class="mb-0">
                                    <a href="<?php echo esc_url(get_permalink($svc_id)); ?>">
                                      <?php echo esc_html(get_the_title($svc_id)); ?>
                                    </a>
                                  </h5>
                                </li>
                              <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                          </div>
                        </div>
                      
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endfor; ?>
          </div>
        </div>
      <?php endif; ?>


      <?php if (!empty($ind_items)) : ?>
        <div class="right-tab col-12 col-lg-12 mx-auto">
          <h3 class="pb-3">For individuals</h3>
          <hr class="bm-white">
          <div class="row">
            <?php for ($c = 0; $c < 3; $c++) :
              $col_items = $ind_cols[$c] ?? [];
              if (empty($col_items)) continue;

              $acc_id = 'accordionNav-ind-' . ($c + 1);
            ?>
              <div class="col-12 col-lg-4">
                <div class="accordion" id="<?php echo esc_attr($acc_id); ?>">
                  <?php foreach ($col_items as $i => $item) :
                    $exp_id   = $item['exp_id'];
                    $services = $item['services'];

                    $heading_id  = 'ind-heading-' . $c . '-' . $i;
                    $collapse_id = 'ind-collapse-' . $c . '-' . $i;
                  ?>
                    <div class="card">
                      <div class="card-header" id="<?php echo esc_attr($heading_id); ?>">
                        <h4 class="mb-0">
                          <button
                            class="btn btn-link collapsed d-flex align-items-start text-left w-100"
                            type="button"
                            data-toggle="collapse"
                            data-target="#<?php echo esc_attr($collapse_id); ?>"
                            aria-expanded="false"
                            aria-controls="<?php echo esc_attr($collapse_id); ?>"
                          >
                            <i class="fas fa-chevron-up mr-2 flex-shrink-0"></i>
                            <span class="flex-fill">
                              <?php echo esc_html(get_the_title($exp_id)); ?>
                            </span>
                          </button>
                        </h4>
                      </div>

                      
                        <div
                          id="<?php echo esc_attr($collapse_id); ?>"
                          class="collapse"
                          aria-labelledby="<?php echo esc_attr($heading_id); ?>"
                          data-parent="#<?php echo esc_attr($acc_id); ?>"
                        >
                          <div class="card-body">
                            <h5 class="pt-2">
                              <a href="<?php echo esc_url(get_permalink($exp_id)); ?>" class="expertise-link">
                                <?php echo esc_html(get_the_title($exp_id)); ?>
                              </a>
                            </h5>
                            <?php if (!empty($services)) : ?>
                            <ul>
                              <?php foreach ($services as $svc) :
                                $svc_id = $to_id($svc);
                                if (!$svc_id || get_post_status($svc_id) !== 'publish') continue;
                              ?>
                                <li>
                                  <a href="<?php echo esc_url(get_permalink($svc_id)); ?>">
                                    <?php echo esc_html(get_the_title($svc_id)); ?>
                                  </a>
                                </li>
                              <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                          </div>
                        </div>
                      
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endfor; ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
