<?php
/*
 * The Index Post (or excerpt)
 * ===========================
 * Used by index.php, category.php and author.php
 */

$post_id = get_the_ID();

// CATEGORY HANDLING
$categories = get_the_category($post_id);
$category_slugs = [];

if (!empty($categories)) {
    $category_slugs = wp_list_pluck($categories, 'slug');
}

// AUTHOR HANDLING
$post_object = get_field('author', $post_id);
$author = '';
$author_id = 0;

if (!empty($post_object)) {
    if ($post_object instanceof WP_Post) {
        $author_id = $post_object->ID;
    } elseif (is_array($post_object) && !empty($post_object['ID'])) {
        $author_id = (int) $post_object['ID'];
    } elseif (is_numeric($post_object)) {
        $author_id = (int) $post_object;
    }

    if ($author_id) {
        $details = get_field('contact_details', $author_id);

        if (is_array($details) && !empty($details['name'])) {
            $author = $details['name'];
        }
    }
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

// EXCERPT HANDLING

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

// Ensure excerpt is always a string
if (!is_string($excerpt)) {
    $excerpt = '';
}
?>

<div class="col-12 search-results">
    <ul>
        <li>
            <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                <h2><?php echo esc_html(get_the_title($post_id)); ?></h2>
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