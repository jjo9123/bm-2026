<?php
/*
 * The Index Post (or excerpt)
 * ===========================
 * Used by index.php, category.php and author.php
 */

$post_id = get_the_ID();

// CATEGORY HANDLING (SAFE)
$categories = get_the_category($post_id);
$category_slug = '';
$category_name = '';
$category_slugs = [];

if (!empty($categories)) {
    $category_slug  = $categories[0]->slug ?? '';
    $category_name  = $categories[0]->name ?? '';
    $category_slugs = wp_list_pluck($categories, 'slug');
}

// AUTHOR HANDLING (SAFE)
$post_object = get_field('author');
$author = '';

if ($post_object) {
    $post = $post_object;
    setup_postdata($post);

    $details = get_field('contact_details', $post->ID);

    if (!empty($details['name'])) {
        $author = $details['name'];
    }

    wp_reset_postdata();
}

// DATE
$date = get_the_date('d F Y', $post_id);

// Hide date for guides, events and training
$hide_date = !empty(
    array_intersect(
        $category_slugs,
        ['guides', 'events', 'training']
    )
);
?>

<div class="col-12 search-results">
    <ul>
        <li>
            <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
            </a>

            <?php if (!$hide_date) : ?>
                <p class="search-results__date">
                    <?php echo esc_html($date); ?>

                    <?php if (!empty($author)) : ?>
                        - <?php echo esc_html($author); ?>
                    <?php endif; ?>
                </p>
            <?php endif; ?>

            <?php
            // SAFE EXCERPT HANDLING

            // Default post content
            $excerpt = get_post_field('post_content', $post_id);

            // New blog layout fallback
            if (empty($excerpt) && get_field('new_blog_layout', $post_id) === 'yes') {
                $excerpt = get_field('blog_intro', $post_id);
            }

            // Events / training override
            if (
                in_array('events', $category_slugs, true) ||
                in_array('training', $category_slugs, true)
            ) {
                $intro = get_field('intro_title', $post_id);

                if (!empty($intro)) {
                    $excerpt = $intro;
                }
            }

            // Ensure $excerpt is always a string
            if (!is_string($excerpt)) {
                $excerpt = '';
            }

            echo esc_html(
                wp_trim_words(
                    wp_strip_all_tags($excerpt),
                    30,
                    '...'
                )
            );
            ?>
        </li>
    </ul>
</div>