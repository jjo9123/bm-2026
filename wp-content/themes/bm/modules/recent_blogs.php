<?php
    $cat_id   = get_sub_field('category');
    $category = get_category($cat_id);

    // Safe access
    $cat_slug = isset($category->slug) ? $category->slug : '';
    $cat_name = isset($category->name) ? $category->name : '';

    $number   = get_sub_field('num');
    $tag_name = get_sub_field('tag');
    $bg       = get_sub_field('bg');
?>

<?php if (get_sub_field('events_or_blogs') == 'blogs'): ?>

    <?php
    $args  = array(
        'post_type'        => 'post',
        'posts_per_page'   => $number,
        'tag'              => $tag_name,
        'category__not_in' => array(5),
        'cat'              => '-27070',
    );
    $query = new WP_Query($args);
    ?>

    <?php if ($query->have_posts()) : ?>
        <section class="blog recent <?php echo esc_attr($bg); ?>" id="blogs-section"
                 style="background: #404040 url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
            <div class="container-fluid <?php echo esc_attr($cat_slug); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-center"><?php the_sub_field('title'); ?></h2>
                            <hr class="heading green">
                        </div>

                        <?php while ($query->have_posts()) : $query->the_post(); ?>

                            <?php
                            $post_id    = get_the_ID();
                            $categories = get_the_category($post_id);

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
                                        <p><?php echo esc_html(get_field('event_date', $post_id)); ?></p>
                                    </div>
                                <?php else: ?>
                                    <div class="title">
                                        <p><?php echo $category_name; ?></p>
                                    </div>
                                <?php endif; ?>

                                <div class="img"
                                     style="background: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'recent_fimg')); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                                <div class="header">
                                    <a href="<?php the_permalink(); ?>">
                                        <h6><?php the_title(); ?></h6>
                                    </a>
                                </div>

                                <div class="excerpt">
                                    <?php
                                    // Excerpt fallback logic
                                    if ($category_slug === 'events' || $category_slug === 'training') {
                                        $excerpt = get_field('intro_title', $post_id);
                                    } elseif (get_field('new_blog_layout', $post_id) === 'yes') {
                                        $excerpt = get_field('blog_intro', $post_id);
                                    } else {
                                        $excerpt = get_post_field('post_content', $post_id);
                                    }

                                    if (!is_string($excerpt)) {
                                        $excerpt = '';
                                    }

                                    echo wp_kses_post(wp_trim_words($excerpt, 30, '...'));
                                    ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
                                </div>
                            </div>

                        <?php endwhile; ?>

                        <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
                            <a href="<?php echo esc_url('https://www.blakemorgan.co.uk/tag/' . $tag_name . '/'); ?>" class="btn btn-green">
                                Click here for more Insights
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    <?php endif; wp_reset_postdata(); ?>


<?php elseif (get_sub_field('events_or_blogs') == 'events'): ?>

    <?php
    $args  = array(
        'post_type'      => 'post',
        'posts_per_page' => $number,
        'tag'            => $tag_name,
        'category__in'   => array(5),
    );
    $query = new WP_Query($args);
    ?>

    <?php if ($query->have_posts()) : ?>
        <section class="blog recent <?php echo esc_attr($bg); ?>" id="events-section"
                 style="background: #404040 url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
            <div class="container-fluid <?php echo esc_attr($cat_slug); ?>">
                <div class="container" style="padding-bottom: 40px;">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-center"><?php the_sub_field('title'); ?></h2>
                            <hr class="heading green">
                        </div>

                        <?php while ($query->have_posts()) : $query->the_post(); ?>

                            <?php
                            $post_id    = get_the_ID();
                            $categories = get_the_category($post_id);

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
                                        <p><?php echo esc_html(get_field('event_date', $post_id)); ?></p>
                                    </div>
                                <?php else: ?>
                                    <div class="title">
                                        <p><?php echo $category_name; ?></p>
                                    </div>
                                <?php endif; ?>

                                <div class="img"
                                     style="background: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'recent_fimg')); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                                <div class="header">
                                    <a href="<?php the_permalink(); ?>">
                                        <h6><?php the_title(); ?></h6>
                                    </a>
                                </div>

                                <div class="excerpt">
                                    <?php
                                    // Events-specific fallback: intro_title preferred
                                    if ($category_slug === 'events' || $category_slug === 'training') {
                                        $excerpt = get_field('intro_title', $post_id);
                                    } elseif (get_field('new_blog_layout', $post_id) === 'yes') {
                                        $excerpt = get_field('blog_intro', $post_id);
                                    } else {
                                        $excerpt = get_post_field('post_content', $post_id);
                                    }

                                    if (!is_string($excerpt)) {
                                        $excerpt = '';
                                    }

                                    echo wp_kses_post(wp_trim_words($excerpt, 30, '...'));
                                    ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
                                </div>
                            </div>

                        <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </section>
    <?php endif; wp_reset_postdata(); ?>


<?php elseif (get_sub_field('events_or_blogs') == 'both'): ?>

    <?php
    $args  = array(
        'post_type'      => 'post',
        'posts_per_page' => $number,
        'tag'            => $tag_name,
    );
    $query = new WP_Query($args);
    ?>

    <?php if ($query->have_posts()) : ?>
        <section class="blog recent <?php echo esc_attr($bg); ?>" id="blogs-section"
                 style="background: #404040 url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
            <div class="container-fluid <?php echo esc_attr($cat_slug); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-center"><?php the_sub_field('title'); ?></h2>
                            <hr class="heading green">
                        </div>

                        <?php while ($query->have_posts()) : $query->the_post(); ?>

                            <?php
                            $post_id    = get_the_ID();
                            $categories = get_the_category($post_id);

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
                                        <p><?php echo esc_html(get_field('event_date', $post_id)); ?></p>
                                    </div>
                                <?php else: ?>
                                    <div class="title">
                                        <p><?php echo $category_name; ?></p>
                                    </div>
                                <?php endif; ?>

                                <div class="img"
                                     style="background: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'recent_fimg')); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                                <div class="header">
                                    <a href="<?php the_permalink(); ?>">
                                        <h6><?php the_title(); ?></h6>
                                    </a>
                                </div>

                                <div class="excerpt">
                                    <?php
                                    if ($category_slug === 'events' || $category_slug === 'training') {
                                        $excerpt = get_field('intro_title', $post_id);
                                    } elseif (get_field('new_blog_layout', $post_id) === 'yes') {
                                        $excerpt = get_field('blog_intro', $post_id);
                                    } else {
                                        $excerpt = get_post_field('post_content', $post_id);
                                    }

                                    if (!is_string($excerpt)) {
                                        $excerpt = '';
                                    }

                                    echo wp_kses_post(wp_trim_words($excerpt, 30, '...'));
                                    ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
                                </div>
                            </div>

                        <?php endwhile; ?>

                        <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
                            <a href="<?php echo esc_url('https://www.blakemorgan.co.uk/tag/' . $tag_name . '/'); ?>" class="btn btn-green">
                                Click here for more Insights
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    <?php endif; wp_reset_postdata(); ?>

<?php endif; ?>
