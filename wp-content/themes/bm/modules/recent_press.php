<?php 
$tag_name   = get_sub_field('tag_name'); 
$post_count = get_sub_field('number_of_posts') ?: 3;

// Safely get terms for the current post
function bm_get_terms_slugs($post_id, $taxonomy) {
    $terms = get_the_terms($post_id, $taxonomy);
    $slugs = [];

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $slugs[] = $term->slug;
        }
    }

    return $slugs;
}

$current_id = get_the_ID();
?>

<?php
// Determine query based on context
$expertise_slugs = bm_get_terms_slugs($current_id, 'expertise');
$location_slugs  = bm_get_terms_slugs($current_id, 'location');

// Default args
$args = [
    'showposts' => $post_count,
    'post_type' => 'press'
];

if (is_front_page()) {
    $args['post_type'] = 'press';

} elseif (is_singular('location') && get_sub_field('filter_by_tag') === 'no') {

    if (!empty($location_slugs)) {
        $args['tax_query'] = [[
            'taxonomy' => 'location',
            'field'    => 'slug',
            'terms'    => $location_slugs,
        ]];
    }

} elseif (is_page() && get_sub_field('filter_by_tag') === 'no') {
    // No filter: just press posts

} elseif (get_sub_field('filter_by_tag') === 'yes') {

    $args['tag'] = $tag_name;

} else {

    if (!empty($expertise_slugs)) {
        $args['tax_query'] = [[
            'taxonomy' => 'expertise',
            'field'    => 'slug',
            'terms'    => $expertise_slugs,
        ]];
    }
}

$myposts = get_posts($args);
?>

<section class="blog recent" 
         style="background: #404040 url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
    <div class="container-fluid">
        <div class="container news">
            <div class="row">

                <div class="col-lg-12">
                    <h2 class="text-center"><?php echo esc_html(get_sub_field('heading')); ?></h2>
                    <hr class="heading green">
                </div>

                <?php foreach ($myposts as $mypost): ?>
                    <?php 
                    $post_id = $mypost->ID;

                    // Terms for tags display (safe)
                    $expertise_terms = get_the_term_list($post_id, 'expertise', '', ' | ', '');
                    $expertise_terms = $expertise_terms ? strip_tags($expertise_terms) : '';

                    // Excerpt logic
                    $excerpt = $mypost->post_content;

                    if (empty($excerpt)) {
                        $acf_intro = get_field('blog_intro', $post_id);
                        if (!empty($acf_intro)) {
                            $excerpt = $acf_intro;
                        }
                    }

                    if (!is_string($excerpt)) {
                        $excerpt = '';
                    }
                    ?>

                    <div class="col-sm-6 col-md-4 text-center item">
                        <div class="header">
                            <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                <h6><?php echo esc_html($mypost->post_title); ?></h6>
                            </a>
                        </div>

                        <div class="excerpt">
                            <div class="excerpt-top">

                                <div class="date"></div>

                                <div class="tags">
                                    <?php echo esc_html($expertise_terms); ?>
                                </div>

                                <p><?php echo esc_html(wp_trim_words($excerpt, 30, '...')); ?></p>
                            </div>

                            <div class="excerpt-bottom">
                                <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="btn btn-purple">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

                <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
                    <a href="/press" class="btn btn-green">Click here for more news features</a>
                </div>

            </div>
        </div>
    </div>
</section>