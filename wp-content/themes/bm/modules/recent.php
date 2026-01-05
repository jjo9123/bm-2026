<?php
    $cat_id   = get_sub_field('category');
    $category = get_category($cat_id);

    // Safe access with checks
    $cat_slug = isset($category->slug) ? $category->slug : '';
    $cat_name = isset($category->name) ? $category->name : '';

    $number = get_sub_field('num');
    $bg     = get_sub_field('bg');

    if (is_page(6033)) {
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $number,
            'tag'            => 'brexit',
        );
    } else {
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $number,
            'tag__not_in'    => array(25061, 27061),
            'cat'            => '-27070',
        );
    }

    $query = new WP_Query($args);
?>

<?php if (get_sub_field('recent_choice') == 'recent'): ?>

    <section class="blog recent <?php echo esc_attr($bg); ?>"
             style="background: #404040 url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
        <div class="container-fluid <?php echo esc_attr($cat_slug); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">BM Insights</h2>
                        <hr class="heading green">
                    </div>

                    <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : $query->the_post(); ?>

                            <?php
                            // SAFE CATEGORY HANDLING
                            $categories = get_the_category();
                            $category_slug  = '';
                            $category_slug2 = '';
                            $category_name  = '';

                            if (!empty($categories)) {
                                $category_slug = esc_html($categories[0]->slug);
                                $category_name = esc_html($categories[0]->name);

                                if (isset($categories[1])) {
                                    $category_slug2 = esc_html($categories[1]->slug);
                                }
                            }

                            // Build class string safely
                            $item_classes = 'i' . $category_slug;
                            if (!empty($category_slug2)) {
                                $item_classes .= ' ' . $category_slug2;
                            }
                            ?>

                            <div class="col-sm-6 col-md-4 text-center item <?php echo esc_attr($item_classes); ?>">

                                <?php if ($category_slug === 'events'): ?>
                                    <div class="recent-event">
                                        <?php echo $category_name; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="title">
                                        <p><?php echo $category_name; ?></p>
                                    </div>
                                <?php endif; ?>

                                <div class="img"
                                     style="background: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'recent_fimg')); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                                <div class="header">
                                    <?php if ($category_slug === 'events'): ?>
                                        <div class="recent-event">
                                            <a href="<?php the_permalink(); ?>">
                                                <h3><?php the_title(); ?></h3>
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <h3><?php the_title(); ?></h3>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="excerpt">
                                    <?php
                                    if ($category_slug === 'events' || $category_slug === 'training') {
                                        $excerpt = get_field('intro_title');
                                    } elseif (get_field('new_blog_layout') === 'yes') {
                                        $excerpt = get_field('blog_intro');
                                    } else {
                                        $excerpt = get_the_content();
                                    }

                                    if (!is_string($excerpt)) {
                                        $excerpt = '';
                                    }
                                    ?>
                                    <p><?php echo wp_trim_words($excerpt, 30, '...'); ?></p>

                                    <a href="<?php the_permalink(); ?>" class="btn btn-purple" data-name="<?php the_title(); ?>">Read More</a>
                                </div>
                            </div>

                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>

                    <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
                        <a href="/blog" class="btn btn-green">Click here for more Insights</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php elseif (get_sub_field('recent_choice') == 'expertise'): ?>

    <?php
    $terms       = get_the_terms(get_the_ID(), 'expertise');
    $terms_array = array();

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $terms_array[] = $term->slug;
        }
    }

    $expertise = join(', ', $terms_array);

    $myposts = get_posts(array(
        'showposts' => $number,
        'post_type' => 'post',
        'tax_query' => array(
            array(
                'taxonomy' => 'expertise',
                'field'    => 'slug',
                'terms'    => $expertise,
            ),
        ),
    ));
    ?>

    <section class="blog recent <?php echo esc_attr($bg); ?>"
             style="background: #404040 url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
        <div class="container-fluid <?php echo esc_attr($cat_slug); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">BM Insights</h2>
                        <hr class="heading green">
                    </div>

                    <?php if (!empty($myposts)) : ?>
                        <?php foreach ($myposts as $mypost) : ?>

                            <?php
                            $categories = get_the_category($mypost->ID);

                            $category_slug  = '';
                            $category_slug2 = '';
                            $category_name  = '';

                            if (!empty($categories)) {
                                $category_slug = esc_html($categories[0]->slug);
                                $category_name = esc_html($categories[0]->name);

                                if (isset($categories[1])) {
                                    $category_slug2 = esc_html($categories[1]->slug);
                                }
                            }

                            $item_classes = 'i' . $category_slug;
                            if (!empty($category_slug2)) {
                                $item_classes .= ' ' . $category_slug2;
                            }
                            ?>

                            <div class="col-sm-6 col-md-4 text-center item <?php echo esc_attr($item_classes); ?>">

                                <?php if ($category_slug === 'events'): ?>
                                    <div class="recent-event">
                                        <?php echo $category_name; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="title">
                                        <p><?php echo $category_name; ?></p>
                                    </div>
                                <?php endif; ?>

                                <div class="img"
                                     style="background: url('<?php echo esc_url(wp_get_attachment_image_url(get_post_thumbnail_id($mypost->ID), 'recent_fimg')); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                                <div class="header">
                                    <?php if ($category_slug === 'events'): ?>
                                        <div class="recent-event">
                                            <a href="<?php echo esc_url(get_permalink($mypost->ID)); ?>">
                                                <h3>
                                                    <?php echo esc_html($mypost->post_title); ?>
                                                    - <?php echo esc_html(get_post_meta($mypost->ID, 'event_date', true)); ?>
                                                </h3>
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <a href="<?php echo esc_url(get_permalink($mypost->ID)); ?>">
                                            <h3><?php echo esc_html($mypost->post_title); ?></h3>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="excerpt">
                                    <?php
                                    if ($category_slug === 'events' || $category_slug === 'training') {
                                        $excerpt = get_field('intro_title', $mypost->ID);
                                    } elseif (get_field('new_blog_layout', $mypost->ID) === 'yes') {
                                        $excerpt = get_field('blog_intro', $mypost->ID);
                                    } else {
                                        $excerpt = $mypost->post_content;
                                    }

                                    if (!is_string($excerpt)) {
                                        $excerpt = '';
                                    }
                                    ?>
                                    <p><?php echo wp_trim_words($excerpt, 30, '...'); ?></p>

                                    <a href="<?php echo esc_url(get_permalink($mypost->ID)); ?>" class="btn btn-purple">Read More</a>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
                <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
                    <a href="/blog" class="btn btn-green">Click here for more Insights</a>
                </div>
            </div>
        </div>
    </section>

<?php elseif (get_sub_field('recent_choice') == 'service'): ?>

    <?php
    $terms       = get_the_terms(get_the_ID(), 'service');
    $terms_array = array();

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $terms_array[] = $term->slug;
        }
    }

    $service = join(', ', $terms_array);

    $myposts = get_posts(array(
        'showposts' => $number,
        'post_type' => 'post',
        'tax_query' => array(
            array(
                'taxonomy' => 'service',
                'field'    => 'slug',
                'terms'    => $service,
            ),
        ),
    ));
    ?>

    <section class="blog recent <?php echo esc_attr($bg); ?>"
             style="background: #404040 url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
        <div class="container-fluid <?php echo esc_attr($cat_slug); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">BM Insights</h2>
                        <hr class="heading green">
                    </div>

                    <?php if (!empty($myposts)) : ?>
                        <?php foreach ($myposts as $mypost) : ?>

                            <?php
                            $categories = get_the_category($mypost->ID);

                            $category_slug  = '';
                            $category_slug2 = '';
                            $category_name  = '';

                            if (!empty($categories)) {
                                $category_slug = esc_html($categories[0]->slug);
                                $category_name = esc_html($categories[0]->name);

                                if (isset($categories[1])) {
                                    $category_slug2 = esc_html($categories[1]->slug);
                                }
                            }

                            $item_classes = 'i' . $category_slug;
                            if (!empty($category_slug2)) {
                                $item_classes .= ' ' . $category_slug2;
                            }
                            ?>

                            <div class="col-sm-6 col-md-4 text-center item <?php echo esc_attr($item_classes); ?>">

                                <?php if ($category_slug === 'events'): ?>
                                    <div class="recent-event">
                                        <?php echo $category_name; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="title">
                                        <p><?php echo $category_name; ?></p>
                                    </div>
                                <?php endif; ?>

                                <div class="img"
                                     style="background: url('<?php echo esc_url(wp_get_attachment_image_url(get_post_thumbnail_id($mypost->ID), 'recent_fimg')); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                                <div class="header">
                                    <?php if ($category_slug === 'events'): ?>
                                        <div class="recent-event">
                                            <a href="<?php echo esc_url(get_permalink($mypost->ID)); ?>">
                                                <h3>
                                                    <?php echo esc_html($mypost->post_title); ?>
                                                    - <?php echo esc_html(get_post_meta($mypost->ID, 'event_date', true)); ?>
                                                </h3>
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <a href="<?php echo esc_url(get_permalink($mypost->ID)); ?>">
                                            <h3><?php echo esc_html($mypost->post_title); ?></h3>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="excerpt">
                                    <?php
                                    if ($category_slug === 'events' || $category_slug === 'training') {
                                        $excerpt = get_field('intro_title', $mypost->ID);
                                    } elseif (get_field('new_blog_layout', $mypost->ID) === 'yes') {
                                        $excerpt = get_field('blog_intro', $mypost->ID);
                                    } else {
                                        $excerpt = $mypost->post_content;
                                    }

                                    if (!is_string($excerpt)) {
                                        $excerpt = '';
                                    }
                                    ?>
                                    <p><?php echo wp_trim_words($excerpt, 30, '...'); ?></p>

                                    <a href="<?php echo esc_url(get_permalink($mypost->ID)); ?>" class="btn btn-purple">Read More</a>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
                <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
                    <a href="/blog" class="btn btn-green">Click here for more Insights</a>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>